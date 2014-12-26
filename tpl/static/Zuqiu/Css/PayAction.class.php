<?php
class PayAction extends WapAction{
	public $token;
	public $wecha_id;
	public $pay_config;
	public $orders_url;
	public $wappayment;
	public $lypayment;
	public $tenpay_config;
	public $waptenpay_config;
	public $orderid;
	public $wxpay_config;
	public $order;
	public $company_name;
	public $company_site_url;
	public function _initialize() {
		parent::_initialize();
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		$company_db = M('company') -> where(array('token' => $this -> token, 'isbranch' == 0)) -> find();
		$this->company_site_url = $company_db['site_url'];
		if($this->company_site_url == '')
		$this->company_site_url = C('site_url');
		$this->orderid= $this->_get('orderid');
		$payHandel=new payHandle($this->token,$_GET['from']);
		$order=$payHandel->beforePay($this->orderid);
		if ($order){
			$order['ordername']="订单号：".$order['orderid'];
			$this->order=$order;
		}
		//手机支付配置
		$pay_config =M('payment')->where(array('token'=>$this->token,'pay_code'=>'wapalipay'))->find();
		$pay_config = unserialize($pay_config['pay_config']);
		$wappayment['seller_email'] = trim($pay_config['account']);
		$wappayment['partner']		= trim($pay_config['pid']);
		$wappayment['key']			= trim($pay_config['key']);
		$wappayment['sign_type']    = strtoupper('MD5');
		$wappayment['input_charset']= strtolower('utf-8');
		$wappayment['cacert']    = EXTEND_PATH.'Vendor\\Malipay\\cacert.pem';
		$wappayment['transport']    = 'http';
		$this->wappayment = $wappayment;
		//免签支付宝配置
		$pay_config =M('payment')->where(array('token'=>$this->token,'pay_code'=>'lyalipay'))->find();
		$pay_config = unserialize($pay_config['pay_config']);
		$bwpayment['seller_email'] = C('alipay_name');
		$bwpayment['partner']		= C('alipay_pid');
		$bwpayment['key']			= C('alipay_key');
		$bwpayment['sign_type']    = strtoupper('MD5');
		$bwpayment['input_charset']= strtolower('utf-8');
		$bwpayment['cacert']    = getcwd().'\\laoyang\\Lib\\ORG\\Alipay\\cacert.pem';
		$bwpayment['transport']    = 'http';
		$bwpayment['royalty_email'] = trim($pay_config['account']);
		$this->bwpayment = $bwpayment;
		//财付通配置
		$pay_config =M('payment')->where(array('token'=>$this->token,'pay_code'=>'tenpay'))->find();
		$pay_config = unserialize($pay_config['pay_config']);
		$tenpay_config['partnerId']=trim($pay_config['partnerId']);
		$tenpay_config['partnerKey']=trim($pay_config['partnerKey']);
		$tenpay_config['sign_type']=strtoupper('MD5');
		$tenpay_config['service_version']='1.0';
		$tenpay_config['input_charset']=strtolower('utf-8');
		$this->tenpay_config=$tenpay_config;
		//手机财付通配置
		$pay_config =M('payment')->where(array('token'=>$this->token,'pay_code'=>'waptenpay'))->find();
		$pay_config = unserialize($pay_config['pay_config']);
		$waptenpay_config['partnerId']=trim($pay_config['partnerId']);
		$waptenpay_config['partnerKey']=trim($pay_config['partnerKey']);
		$this->waptenpay_config=$waptenpay_config;
	}
	//手机支付宝
	public function wapalipay(){
        vendor('Malipay.alipay_submit','','.class.php');

		$payment=$this->wappayment;
		$order = $this->order;
		//返回格式
		$format = "xml";
		$v = "2.0";
		$req_id = date('Ymdhis');

		$notify_url= $this->company_site_url.'/index.php/Wap/Pay/notify_url';
		$call_back_url= $this->company_site_url.'/index.php/Wap/Pay/wapalipay_call_back_url?from='.$_GET['from'].'|'.$_GET['token'];
		
		$seller_email = $payment['seller_email'];
		$out_trade_no = $order['orderid'];
		$subject = $order['ordername'];
		$total_fee = $order['price'];
		
		//请求业务参数详细
		$req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee></direct_trade_create_req>';
		
		//构造要请求的参数数组，无需改动
		$para_token = array(
				"service" => "alipay.wap.trade.create.direct",
				"partner" => trim($payment['partner']),
				"sec_id" => trim($payment['sign_type']),
				"format"	=> $format,
				"v"	=> $v,
				"req_id"	=> $req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($payment['input_charset']))
		);

		//建立请求
		
		$alipaySubmit = new AlipaySubmit($payment);
		$html_text = $alipaySubmit->buildRequestHttp($para_token);

		//URLDECODE返回的信息
		$html_text = urldecode($html_text);

		//解析远程模拟提交后返回的信息
		$para_html_text = $alipaySubmit->parseResponse($html_text);

		//获取request_token
		$request_token = $para_html_text['request_token'];


		/**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

		//业务详细
		$req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
		//必填

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "alipay.wap.auth.authAndExecute",
				"partner" => trim($payment['partner']),
				"sec_id" => trim($payment['sign_type']),
				"format"	=> $format,
				"v"	=> $v,
				"req_id"	=> $req_id,
				"req_data"	=> $req_data,
				"_input_charset"	=> trim(strtolower($payment['input_charset']))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($payment);

		$html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '正确为您跳转到支付宝支付界面!');
		echo $html_text;	
	}
	public function notify_url(){
		echo "success"; 
		eixt();
	}
	//免签支付宝
	public function lyalipay(){
		import("@.ORG.Alipay.AlipaySubmit");
		$payment=$this->bwpayment;
		$order = $this->order;
		
		//即时到帐支付类型
		$payment_type = "1";
		$notify_url = $this->company_site_url.'/index.php?g=Wap&m=Pay&a=notify_url';
		$return_url= $this->company_site_url.'/index.php?g=Wap&m=Pay&a=lyalipay_return_url&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from'];
		//付款金额
		$total_fee =floatval($order['price']);
		//计算分润
		$royalty_money= round($total_fee*0.985,2);
		$royalty_type = "10";
		$royalty_parameters = $payment['royalty_email']."^".$royalty_money."^".$order['ordername'];
		
		$seller_email = $payment['seller_email'];
		$out_trade_no = $order['orderid'];
		$subject = $order['ordername'];
		$partner	=  $payment['partner'];
		$body = $order['ordername'];
		//商品展示地址
		$show_url = 'http://'.$_SERVER['HTTP_HOST'].U('Wap/index',array('token'=>$this->token,'wecha_id'=>$this->wecha_id));
		$anti_phishing_key = "";
		$exter_invoke_ip = "";

		//构造要请求的参数数组，无需改动
		$parameter = array(
			"service" => "create_direct_pay_by_user",
			"partner" =>$partner,
			"payment_type"	=> $payment_type,
			"notify_url"	=> $notify_url,
			"return_url"	=> $return_url,
			"royalty_type"=> $royalty_type,
			"royalty_parameters"=>$royalty_parameters,
			"seller_email"	=> $seller_email,
			"out_trade_no"	=> $out_trade_no,
			"subject"	=> $subject,
			"total_fee"	=> $total_fee,
			"body"	=> $body,
			"show_url"	=> $show_url,
			"anti_phishing_key"	=> $anti_phishing_key,
			"exter_invoke_ip"	=> $exter_invoke_ip,
			"_input_charset"	=>trim(strtolower('utf-8'))
		);

		//建立请求
		$alipaySubmit = new AlipaySubmit($payment);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "进行支付");
				print_r($html_text);exit;
		echo '正在跳转到支付宝进行支付...<div style="display:none">'.$html_text.'</div>';
	}
	//微信支付
	public function wxpay(){
		$pay_url= $this->company_site_url."/wxpay/?g=Wap&m=Wxpay&a=pay&token=".$this->token."&wecha_id=".$this->wecha_id."&orderid=".$this->orderid."&from=".$_GET['from'];
		header("location:".$pay_url);
	}

	public function wapalipay_call_back_url()
	{	
		vendor('Malipay.alipay_notify','','.class.php');
		$payment=$this->wappayment;
		$alipayNotify = new AlipayNotify($payment);
		$verify_result = $alipayNotify->verifyNotify();
		//if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');//商户订单号
			$trade_no = $this->_get('trade_no');//支付宝交易号
			$result = $this->_get('result');//交易状态
			$str = $this->_get('from');
			$arr =explode("|",$str);
			if($result == "success") {
				//after
				$payHandel=new payHandle($arr[1],$arr[0]);
				$orderInfo=$payHandel->afterPay($out_trade_no);
				$from=$payHandel->getFrom();
				$this->redirect('/index.php?g=Wap&m='.$from.'&a=payReturn&token='.$orderInfo['token'].'&wecha_id='.$orderInfo['wecha_id'].'&orderid='.$out_trade_no);
			}else {
			  exit('付款失败');
			}
		//}else {
			//exit('不存在的订单');
		//}
	}

	public function lyalipay_return_url(){	
		import("@.ORG.Alipay.AlipayNotify");
		$payment=$this->bwpayment;
		$alipayNotify = new AlipayNotify($payment);
		$verify_result = $alipayNotify->verifyNotify();
		//if($verify_result) {
			$out_trade_no = $this->_get('out_trade_no');
			//支付宝交易号
			$trade_no =  $this->_get('trade_no');
			//交易状态
			$trade_status =  $this->_get('trade_status');
			if( $this->_get('trade_status') == 'TRADE_FINISHED' ||  $this->_get('trade_status') == 'TRADE_SUCCESS') {
				//after
				$payHandel=new payHandle($_GET['token'],$_GET['from']);
				$orderInfo=$payHandel->afterPay($out_trade_no);
				$from=$payHandel->getFrom();
				$this->redirect('/index.php?g=Wap&m='.$from.'&a=payReturn&token='.$orderInfo['token'].'&wecha_id='.$orderInfo['wecha_id'].'&orderid='.$out_trade_no);
			}else {
			  exit('付款失败');
			}
		//}else {
			//exit('不存在的订单');
		//}
	}
	
	public function yuepay(){
		$token=$this->token;
		$wecha_id=$this->wecha_id;
		$order = $this->order;
		//付款金额
		$total_fee =floatval($order['price']);
		$userInfo= M('Userinfo')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
		$useryue=$userInfo['account']-$total_fee;
		
		if($useryue<0){
			$this->error('余额不足,请充值',$this->orders_url);
			//$this->error('余额不足,请充值',U('Card/recherge',array('token'=>$this->token,'wecha_id'=>$this->wecha_id)));
		}else{
			$useInfo['account']=$useryue;
			
			$trade_status=M('Userinfo')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->save($useInfo);
			if($trade_status){
					$payHandel=new payHandle($_GET['token'],$_GET['from']);
					$orderInfo=$payHandel->afterPay($order['orderid']);
					$from=$payHandel->getFrom();
					$backurl='/index.php?g=Wap&m='.$from.'&a=payReturn&token='.$orderInfo['token'].'&wecha_id='.$orderInfo['wecha_id'].'&orderid='.$orderInfo['orderid'];
					//消费记录
					// $accountlog['token']=$token;
					// $accountlog['wecha_id']=$wecha_id;
					// $accountlog['price']=$total_fee;
					// $accountlog['retype']=3;
					// $accountlog['reuser']='会员购物';
					// $accountlog['info']='订单号'.$order['orderid'];
					// $accountlog['time']=time();
					// M('member_accountlog')->add($accountlog);
					$this->success('支付成功',$backurl);
			}else{
				$this->error('支付失败，请重试',$this->orders_url);
			}
		}
	}
	public function tenpay(){
		import("@.ORG.Tenpay.RequestHandler");
		$tenpay_config=$this->tenpay_config;
		$order = $this->order;
		$orderName =  $order['ordername'];
        if(!floatval($order['price']))exit('必须有价格才能支付');
        $total_fee = floatval($order['price']);		
        $out_trade_no = $order['orderid'];		
		$notify_url = $this->company_site_url.'/index.php?g=Wap&m=Pay&a=tenpayshare_notify_url';
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径

		$return_url= $this->company_site_url.'/index.php?g=Wap&m=Pay&a=tenpayshare_return_url&token='.$_GET['token'].'&wecha_id='.$_GET['wecha_id'].'&from='.$_GET['from'];

		$reqHandler = new RequestHandler();
		$reqHandler->init();
		$key=$tenpay_config['partnerKey'];
		$partner=$tenpay_config['partnerId'];
		$reqHandler->setKey($key);
		$reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");

		//----------------------------------------
		//设置支付参数
		//----------------------------------------
		$reqHandler->setParameter("partner", $partner);
		$reqHandler->setParameter("out_trade_no", $out_trade_no);
		$reqHandler->setParameter("total_fee", $total_fee * 100);  //总金额
		$reqHandler->setParameter("return_url", $return_url);
		$reqHandler->setParameter("notify_url", $notify_url);
		$reqHandler->setParameter("body", $orderName);
		$reqHandler->setParameter("bank_type", "DEFAULT");  	  //银行类型，默认为财付通
		//用户ip
		$reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//客户端IP
		$reqHandler->setParameter("fee_type", "1");               //币种
		$reqHandler->setParameter("subject",'weixin');          //商品名称，（中介交易时必填）

		//系统可选参数
		$reqHandler->setParameter("sign_type", "MD5");  	 	  //签名方式，默认为MD5，可选RSA
		$reqHandler->setParameter("service_version", "1.0"); 	  //接口版本号
		$reqHandler->setParameter("input_charset", "utf-8");   	  //字符集
		$reqHandler->setParameter("sign_key_index", "1");    	  //密钥序号

		//业务可选参数
		$reqHandler->setParameter("attach", "");             	  //附件数据，原样返回就可以了
		$reqHandler->setParameter("product_fee", "");        	  //商品费用
		$reqHandler->setParameter("transport_fee", "0");      	  //物流费用
		$reqHandler->setParameter("time_start", date("YmdHis"));  //订单生成时间
		$reqHandler->setParameter("time_expire", "");             //订单失效时间
		$reqHandler->setParameter("buyer_id", "");                //买方财付通帐号
		$reqHandler->setParameter("goods_tag", "");               //商品标记
		$reqHandler->setParameter("trade_mode",1);              //交易模式（1.即时到帐模式，2.中介担保模式，3.后台选择（卖家进入支付中心列表选择））
		$reqHandler->setParameter("transport_desc","");              //物流说明
		$reqHandler->setParameter("trans_type","1");              //交易类型
		$reqHandler->setParameter("agentid","");                  //平台ID
		$reqHandler->setParameter("agent_type","");               //代理模式（0.无代理，1.表示卡易售模式，2.表示网店模式）
		$reqHandler->setParameter("seller_id","");                //卖家的商户号



		//请求的URL
		$reqUrl = $reqHandler->getRequestURL();

		//获取debug信息,建议把请求和debug信息写入日志，方便定位问题
		/**/
		$debugInfo = $reqHandler->getDebugInfo();
		header('Location:'.$reqUrl);
		//echo "<br/>" . $reqUrl . "<br/>";
		//echo "<br/>" . $debugInfo . "<br/>";
	}
	public function waptenpay(){	
		import("@.ORG.Tenpay.RequestHandler");
		import("@.ORG.Tenpay.client.ClientResponseHandler");
		import("@.ORG.Tenpay.client.TenpayHttpClient");
		$partner = $this->waptenpay_config['partnerid'];
		$key = $this->waptenpay_config['partnerkey'];
		$order = $this->order;
		$orderid=$order['orderid'];
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		$out_trade_no = $orderid;
		$price=$order['price'];
		if(!$price)exit('必须有价格才能支付');
		$orderName=$order['orderName'];
		$total_fee =floatval($price);
		/* 创建支付请求对象 */
		$reqHandler = new RequestHandler();
		$reqHandler->init();
		$reqHandler->setKey($key);
		$reqHandler->setGateUrl("http://wap.tenpay.com/cgi-bin/wappayv2.0/wappay_init.cgi");
		$httpClient = new TenpayHttpClient();
		//应答对象
		$resHandler = new ClientResponseHandler();
		//----------------------------------------
		//设置支付参数
		//----------------------------------------
		$reqHandler->setParameter("total_fee",$total_fee*100);  //总金额
		//用户ip
		$reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//客户端IP
		$reqHandler->setParameter("ver", "2.0");//版本类型
		$reqHandler->setParameter("bank_type", "0"); //银行类型，财付通填写0
		$return_url = $this->company_site_url.'/index.php?g=Wap&m=Pay&a=return_url&token='.$this->token.'&wecha_id='.$this->wecha_id.'&from='.$_GET['from'];
		$reqHandler->setParameter("callback_url", $return_url);//交易完成后跳转的URL
		$reqHandler->setParameter("bargainor_id", $partner); //商户号
		$reqHandler->setParameter("sp_billno", $out_trade_no); //商户订单号
		
		$notify_url = $this->company_site_url.'/index.php?g=Wap&m=Pay&a=notify_url';
		$reqHandler->setParameter("notify_url", $notify_url);//接收财付通通知的URL，需绝对路径
		$reqHandler->setParameter("desc",$orderName?$orderName:'wechat');
		$reqHandler->setParameter("attach", "");


		$httpClient->setReqContent($reqHandler->getRequestURL());

		//后台调用
		if($httpClient->call()) {

			$resHandler->setContent($httpClient->getResContent());
			//获得的token_id，用于支付请求
			$token_id = $resHandler->getParameter('token_id');
			$reqHandler->setParameter("token_id", $token_id);

			//请求的URL
			//$reqHandler->setGateUrl("https://wap.tenpay.com/cgi-bin/wappayv2.0/wappay_gate.cgi");
			//此次请求只需带上参数token_id就可以了，$reqUrl和$reqUrl2效果是一样的
			//$reqUrl = $reqHandler->getRequestURL();
			$reqUrl = "http://wap.tenpay.com/cgi-bin/wappayv2.0/wappay_gate.cgi?token_id=".$token_id;

		}
		header('Location:'.$reqUrl);
	}
	
	//同步数据处理
	public function tenpayshare_return_url (){
		import("@.ORG.Tenpay.ResponseHandler");
		
		if($resHandler->isTenpaySign()) {
			$notify_id = $resHandler->getParameter("notify_id");
			//商户订单号
			$out_trade_no = $resHandler->getParameter("out_trade_no");
			//财付通订单号
			$transaction_id = $resHandler->getParameter("transaction_id");
			//金额,以分为单位
			$total_fee = $resHandler->getParameter("total_fee");
			//如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
			$discount = $resHandler->getParameter("discount");
			//支付结果
			$trade_state = $resHandler->getParameter("trade_state");
			//交易模式,1即时到账
			$trade_mode = $resHandler->getParameter("trade_mode");
			
			if("0" == $trade_state) {
				$payHandel=new payHandle($_GET['token'],$_GET['from']);
				$orderInfo=$payHandel->afterPay($out_trade_no);
				$from=$payHandel->getFrom();
				$this->redirect('/index.php?g=Wap&m='.$from.'&a=payReturn&token='.$orderInfo['token'].'&wecha_id='.$orderInfo['wecha_id'].'&orderid='.$out_trade_no);
			}else{$this->error('支付失败', $back_url);}
		}else {
			exit('sign error');
        }
    }
	//财付通同意异步处理url
	 public function tenpayshare_notify_url(){
        echo "success";
        eixt();
    }
	//同步数据处理
	public function return_url (){

		import("@.ORG.Tenpay.ResponseHandler");
		import("@.ORG.Tenpay.WapResponseHandler");

		/* 密钥 */
		$partner = $this->waptenpay_config['partnerid'];
		$key = $this->waptenpay_config['partnerkey'];

		/* 创建支付应答对象 */
		$resHandler = new WapResponseHandler();
		$resHandler->setKey($key);

		//判断签名
		if($resHandler->isTenpaySign()) {
			//商户订单号
			$out_trade_no = $resHandler->getParameter("sp_billno");
			//财付通交易单号
			$transaction_id = $resHandler->getParameter("transaction_id");
			//金额,以分为单位
			$total_fee = $resHandler->getParameter("total_fee");
			//支付结果
			$pay_result = $resHandler->getParameter("pay_result");

			if( "0" == $pay_result  ) {
				$member_card_create_db=M('Member_card_create');
				$userCard=$member_card_create_db->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
				$member_card_set_db=M('Member_card_set');
				$thisCard=$member_card_set_db->where(array('id'=>intval($userCard['cardid'])))->find();
				$set_exchange = M('Member_card_exchange')->where(array('cardid'=>intval($thisCard['id'])))->find();
				//
				$arr['token']=$this->token;
				$arr['wecha_id']=$this->wecha_id;
				$arr['expense']=intval($total_fee/100);
				$arr['time']=time();
				$arr['cat']=99;
				$arr['staffid']=0;
				$arr['score']=intval($set_exchange['reward'])*$arr['expense'];
				M('Member_card_use_record')->add($arr);
				$userinfo_db=M('Userinfo');
				$thisUser = $userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->find();
				$userArr=array();
				$userArr['total_score']=$thisUser['total_score']+$arr['score'];
				$userArr['expensetotal']=$thisUser['expensetotal']+$arr['expense'];
				$userinfo_db->where(array('token'=>$thisCard['token'],'wecha_id'=>$arr['wecha_id']))->save($userArr);
				//
				$from=$_GET['from'];
				$from=$from?$from:'Groupon';
				$from=$from!='groupon'?$from:'Groupon';
				switch (strtolower($from)){
					default:
					case 'groupon':
					case 'store':
						$order_model=M('product_cart');
						break;
					case 'repast':
						$order_model=M('Dish_order');
						break;
					case 'hotels':
						$order_model=M('Hotels_order');
						break;
					case 'business':
						$order_model=M('Reservebook');
						break;
					case 'dining': 
						$order_model = M('Product_cart');
						break;
					case 'card': 
						$order_model = M('Member_card_pay_record');
						break;
					case 'baoxiu': 
						$order_model = M('Yuyue_order_pay_record');
						break;
				}
				
				$thisOrder=$order_model->where(array('orderid'=>$out_trade_no,'token'=>$this->token))->find();
				$order_model->where(array('orderid'=>$out_trade_no))->setField('paid',1);
				$this->redirect('?g=Wap&m='.$from.'&a=payReturn&token='.$_GET['token'].'&wecha_id='.$thisOrder['wecha_id'].'&orderid='.$out_trade_no);
			} else {
				//当做不成功处理
				$string =  "<br/>" . "支付失败" . "<br/>";
				echo $string;
			}

		} else {
			$string =  "<br/>" . "认证签名失败" . "<br/>";
			echo $string;
		}
	}
}
?>