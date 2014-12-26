<?php
class WxpayAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $payConfig;
	public $company_name;
	public $company_site_url;
	public $order;
	public $from;
	public $id;	
	public $orders_url;
	public function _initialize() {
		parent::_initialize();
		$this->token = $this->_get('token');
		$this->from = $this->_get('from');
		$this->id = $this->_get('id');
		$this->wecha_id	= $this->_get('wecha_id');
		$company_db = M('company') -> where(array('token' => $this -> token, 'isbranch' == 0)) -> find();
		$this->company_site_url = $company_db['site_url'];
		if($this->company_site_url == '')
		$this->company_site_url = C('site_url');
		$orderid=$_GET['orderid'];
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//before
		$payHandel=new payHandle($this->token,$this->from,'weixin');
		$order=$payHandel->beforePay($orderid);
		$orderName=$this->_get('orderName');
		if ($order){
			if(!$order['ordername'])
			{
				$order['ordername']=$orderName." 订单号：".$order['orderid'];
			}
			$this->order=$order;
		}
		//跳转地址
        switch (strtolower($this->from)){
        default: 
		case 'store':
			$this->orders_url = C('site_url').'/index.php?g=Wap&m=Store&a=my&token='.$this->token.'&wecha_id='.$this->wecha_id;
            break;
        case 'card':
			$this -> orders_url = C('site_url').'/index.php?g=Wap&m=Card&a=index&token='.$this->token.'&wecha_id='.$this->wecha_id;
            break;
        case 'repast':
			$this -> orders_url = C('site_url').'/index.php?g=Wap&m=Repast&a=myOrder&token='.$this->token.'&wecha_id='.$this->wecha_id;
            break;
        case 'groupon':
			$this -> orders_url = C('site_url').'/index.php?g=Wap&m=Groupon&a=my&token='.$this->token.'&wecha_id='.$this->wecha_id;
            break;	
        case 'dining':
			$this -> orders_url = C('site_url').'/index.php?g=Wap&m=Dining&a=my&token='.$this->token.'&wecha_id='.$this->wecha_id;
            break;		
        case 'jiudian':
			$this -> orders_url = C('site_url').'/index.php?g=Wap&m=Jiudian&a=order&token='.$this->token.'&id='.$this->id.'&wecha_id='.$this->wecha_id;
            break;				
        }

		//微信支付
		$pay_config =M('payment')->where(array('token'=>$this->token,'pay_code'=>'Wxpay'))->find();
		$pay_config = unserialize($pay_config['pay_config']);
		$wxpay_config['appId']=$pay_config['appId'];
		$wxpay_config['appKey']=$pay_config['appKey'];
		$wxpay_config['appSecret']=$pay_config['appSecret'];
		$wxpay_config['partnerId']=$pay_config['partnerId'];
		$this->wxpay_config = $wxpay_config;
	}
	public function pay(){
		//import("@.ORG.Weixinpay.CommonUtil");
		import("@.ORG.Weixinpay.WxPayPubHelper");
		//使用jsapi接口
		$wxpay_config = $this->wxpay_config;
		$jsApi = new JsApi_pub($this->wxpay_config['appId'],$this->wxpay_config['appKey'],$this->wxpay_config['partnerId'],$this->wxpay_config['appSecret']);
		//通过code获得openid
		$customeUrl = C('site_url') . $_SERVER['REQUEST_URI'];
		if (!isset($_GET['code']))
		{
			//触发微信返回code码
			$url = $jsApi->createOauthUrlForCode(urlencode($customeUrl));
			Header("Location: $url"); 
		}else
		{
			//获取code码，以获取openid
			$code = $_GET['code'];
			$jsApi->setCode($code);
			$openid = $jsApi->getOpenId();
		}
		//使用统一支付接口
		$unifiedOrder = new UnifiedOrder_pub($this->wxpay_config['appId'],$this->wxpay_config['appKey'],$this->wxpay_config['partnerId'],$this->wxpay_config['appSecret']);
		$order = $this->order;
		$notify_url = $this->company_site_url.'/wxpay/index.php/Wap/Wxpay/notify_url';
		$unifiedOrder->setParameter("openid","$openid");//商品描述
		$unifiedOrder->setParameter("body",$order['ordername']);//商品描述
		$unifiedOrder->setParameter("out_trade_no",$order['orderid']);//商户订单号 
		$unifiedOrder->setParameter("total_fee",floatval($order['price'])*100);//总金额
		$unifiedOrder->setParameter("notify_url","$notify_url");//通知地址 
		$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
		$unifiedOrder->setParameter("attach","array('token'=>".$_GET['token'].",'wecha_id'=>".$_GET['wecha_id'].",'from'=>".$_GET['from'].")");//附加数据

		$prepay_id = $unifiedOrder->getPrepayId();

		$jsApi->setPrepayId($prepay_id);

		$payurl = $jsApi->getParameters();
		
		$this->assign('payurl',$payurl);
		$this->assign('returnUrl',$this->orders_url);
		$this->assign('order',$order);
		$this->display();
	}
	//同步数据处理
	public function notify_url (){
	/**
	 * 通用通知接口demo
	 * ====================================================
	 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
	 * 商户接收回调信息后，根据需要设定相应的处理流程。
	 * 
	 * 这里举例使用log文件形式记录回调信息。
	*/
		import("@.ORG.Weixinpay.WxPayPubHelper");

		$wxpay_config = $this->wxpay_config;
		//使用通用通知接口
		$notify = new Notify_pub($this->wxpay_config['appId'],$this->wxpay_config['appKey'],$this->wxpay_config['partnerId'],$this->wxpay_config['appSecret']);

		//存储微信的回调
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
		$notify->saveData($xml);
		
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		$returnXml = $notify->returnXml();
		//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
		
		//以log文件形式记录回调信息
		$log_ = new Log_();
		$log_name="./notify_url.log";//log文件路径

		if ($notify->data["return_code"] == "FAIL") {
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
		}
		elseif($notify->data["result_code"] == "FAIL"){
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
		}
		else{
			$attach=$notify->data["attach"];
			$out_trade_no = $notify->data["out_trade_no"];
			$transaction_id = $notify->data["transaction_id"];
			$openid = $notify->data["openid"];			
			$payHandel=new payHandle($attach['token'],$attach['from'],'weixin');
			$orderInfo=$payHandel->afterPay($out_trade_no,$transaction_id);
			//save openid
			M('userinfo')->where(array('token'=>$attach['token'],'wecha_id'=>$attach['wecha_id']))->setField('openid',$openid);		
			echo $returnXml;
		}

	}
	
}
?>