<?php
class OfflinepayAction extends BaseAction{

	public $token;
	public $wecha_id;
	public $order;
	public $from;
	public $id;	

	public function __construct(){
		parent::_initialize();
		$this->token = $this->_get('token');
		$this->from = $this->_get('from');
		$this->id = $this->_get('id');
		$this->wecha_id	= $this->_get('wecha_id');
		$orderid=$this->_get('orderid');
		if (!$orderid){
			$orderid=$_GET['single_orderid'];//单个订单
		}
		//before
		$payHandel=new payHandle($this->token,$this->from,'offlinepay');
		$order=$payHandel->beforePay($orderid);
		$orderName=$this->_get('orderName');
		if ($order){
			if(!$order['ordername'])
			{
				$order['ordername']=$orderName." 订单号：".$order['orderid'];
			}
			$this->order=$order;
		}
	}

	public function pay(){
		$order = $this->order;
		$order['from']=$this->from;
		$order['id']=$this->id;
		$thisStaff=M('Company_staff')->where(array('token'=>$this->token))->select();
		$this->assign('thisStaff',$thisStaff);
		$this->assign('token',$this->token);
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('order',$order);
		$this->display();
	}
			
			
	public function payAction(){
		$staff_db=M('Company_staff');
		$token=$this->_post('token');
		$wecha_id=$this->_post('wecha_id');
		$orderid=$this->_post('orderid');
		$from=$this->_post('from');
		$id=$this->_post('id');
		$db=M('Product_cart');
        switch (strtolower($from)){
        default: 
		case 'groupon': 
		case 'store': $db = M('Product_cart');
            break;
		case 'dining': $db = M('Product_cart');
            break;
        case 'repast': $db = M('Dish_order');
            break;
        case 'hotels': $db = M('Hotels_order');
            break;
        case 'business': $db = M('Reservebook');
            break;
        case 'card': $db = M('Member_card_pay_record');
            break;
        case 'baoxiu': $db = M('Yuyue_order_pay_record');
            break;
        case 'jiudian': $db = M('Yuyue_order');
            break;			
        }
		$thisStaff=$staff_db->where(array('username'=>$this->_post('username'),'token'=>$token))->find();
		if (!$thisStaff){
			$this->error('用户名和密码不匹配');
		}else {
			if (md5($this->_post('password'))!=$thisStaff['password']){
				$this->error('用户名和密码不匹配');
			}else {
				$order = $db->where("orderid = '$orderid' AND token = '$token' AND wecha_id = '$wecha_id'")->find();
				if($order)
				{
					if($order['paid'] == 0){
						//记录操作员
						if(strtolower($from)=="card")
						{
							$db->where("orderid = '$orderid'")->setField('operator',$this->_post('username'));
						}
						$payHandel=new payHandle($token,$from,'offlinepay');
						$orderInfo=$payHandel->afterPay($orderid,$orderid);
						$from=$payHandel->getFrom();
						$this->redirect('/index.php?g=Wap&m='.$from.'&a=payReturn&token='.$orderInfo['token'].'&wecha_id='.$orderInfo['wecha_id'].'&orderid='.$orderInfo['orderid'].'&id='.$id);
					}else{
						$this->error('您已经支付过了，请勿重复提交！');
					}				
				}else{
					$this->error('订单不存在！');
				}	
			}
		}
	}
}
?>