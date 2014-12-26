<?php
class AlipayAction extends BaseAction{
	public $token;
	public $wecha_id;
	public $alipayConfig;
	public function __construct(){
		$this->token = $this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
		//读取配置
		$alipay_config_db=M('payment');
		$this->alipayConfig=$alipay_config_db->where(array('token'=>$this->token,'enabled'=>1))->find();
	}
	public function pay(){
		//参数数据
		$orderName=$_GET['orderName'];
		$orderid=$_GET['orderid'];
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//before
		
		$payHandel=new payHandle($this->token,$_GET['from']);
		$orderInfo=$payHandel->beforePay($orderid);
		$price=$orderInfo['price'];
		//
		$from=isset($_GET['from'])?$_GET['from']:'shop';
		//
		$alipayConfig=$this->alipayConfig;
		//
		if(!$price)exit('必须有价格才能支付');
		if ($alipayConfig['pay_code']){
			header('Location:/index.php?g=Wap&m=Pay&a='.$alipayConfig['pay_code'].'&price='.$price.'&orderName='.$orderName.'&single_orderid='.$orderid.'&from='.$from.'&token='.$this->token.'&wecha_id='.$this->wecha_id);
		}else{
			exit('商家未开启在线支付功能');
		};
	}
}
?>