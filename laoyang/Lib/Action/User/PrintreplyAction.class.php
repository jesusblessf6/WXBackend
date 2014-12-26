<?php
class PrintreplyAction extends BaseAction{
	public $token;
	public function __construct(){
		$this->token = $this->_get('token');
		if (!$this->token){
			//
			$product_cart_model=M('product_cart');
			$out_trade_no = $this->_get('out_trade_no');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no,'token'=>$this->token))->find();
			if (!$order){
				$order=$product_cart_model->where(array('id'=>intval($this->_get('out_trade_no'))))->find();
			}
			$this->token=$order['token'];
		}
	}

	//同步数据处理
	public function return_url (){
			$out_trade_no = $this->_get('out_trade_no');

			//交易状态
			$product_cart_model=M('product_cart');
			$order=$product_cart_model->where(array('orderid'=>$out_trade_no,'token'=>$this->token))->find();
			$sepOrder=0;
			if (!$order){
				$order=$product_cart_model->where(array('id'=>$out_trade_no))->find();
				$sepOrder=1;
			}
			if($order){
				if($order['printed']==1){exit('该订单已经打印');}
				if (!$sepOrder){
					$product_cart_model->where(array('orderid'=>$out_trade_no,'token'=>$this->token))->setField('printed',1);
				}else {
					$product_cart_model->where(array('id'=>$out_trade_no))->setField('printed',1);
				}
			}else{						
				exit('订单不存在：'.$out_trade_no);
			}
	}
}
?>