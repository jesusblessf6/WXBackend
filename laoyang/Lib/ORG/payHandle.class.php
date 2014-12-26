<?php
final class payHandle{
    public $from;
    public $db;
    public $payType;
    public $token;
    public function __construct($token, $from, $paytype = 'tenpay'){
        $this -> from = $from;
        $this -> from = $from?$from:'Groupon';
        $this -> from = $this -> from != 'groupon'?$this -> from:'Groupon';
        switch (strtolower($this -> from)){
        default: 
		case 'groupon': 
		case 'store': $this -> db = M('Product_cart');
            break;
		case 'dining': $this -> db = M('Product_cart');
            break;
        case 'repast': $this -> db = M('Dish_order');
            break;
        case 'hotels': $this -> db = M('Hotels_order');
            break;
        case 'business': $this -> db = M('Reservebook');
            break;
        case 'card': $this -> db = M('Member_card_pay_record');
            break;
        case 'baoxiu': $this -> db = M('Yuyue_order_pay_record');
            break;
        case 'jiudian': $this -> db = M('Yuyue_order');
            break;			
        }
        $this -> token = $token;
        $this -> payType = $paytype;
    }
    public function getFrom(){
        return $this -> from;
    }
    public function beforePay($id){
        $thisOrder = $this -> db -> where(array('token' => $this -> token, 'orderid' => $id)) -> find();
        switch (strtolower($this -> from)){
        default: $price = $thisOrder['price'];
            break;
        case 'business': $price = $thisOrder['payprice'];
            break;
        }
        return $thisOrder;
    }
    public function afterPay($id, $transaction_id = null,$paidprice){
        $thisOrder = $this -> beforePay($id);
        $wecha_id = $thisOrder['wecha_id'];
        $member_card_create_db = M('Member_card_create');
        $userCard = $member_card_create_db -> where(array('token' => $this -> token, 'wecha_id' => $wecha_id)) -> find();
        $userinfo_db = M('Userinfo');
		if(!$transaction_id)
		{
			$transaction_id=$thisOrder['orderid'];
		}
		if(!$paidprice)
		{
			$paidprice=$thisOrder['price'];
		}		
        if ($userCard){

            $member_card_set_db = M('Member_card_set');
            $thisCard = $member_card_set_db -> where(array('id' => intval($userCard['cardid']))) -> find();
            if ($thisCard){
                $set_exchange = M('Member_card_exchange') -> where(array('cardid' => intval($thisCard['id']))) -> find();	
				$reward=intval($set_exchange['reward']);
                $arr['token'] = $this -> token;
                $arr['wecha_id'] = $wecha_id;
                $arr['expense'] = $paidprice;
                $arr['time'] = time();
                $arr['cat'] = 99;
                $arr['staffid'] = 0;
				if($thisOrder['type'] == 1)
				{
					$reward=intval($set_exchange['czreward']);
					$arr['cat'] = 88;
				}				
                $arr['score'] = $reward * $arr['expense'];
                if(isset($_GET['redirect'])){
                    $infoArr = explode('|', $_GET['redirect']);
                    $param = explode(',', $infoArr[1]);
                    if($param){
                        foreach ($param as $pa){
                            $pas = explode(':', $pa);
                            if($pas[0] == 'itemid'){
                                $arr['itemid'] = $pas[1];
                            }
                        }
                    }
                }
				if($reward > 0)
				{
					M('Member_card_use_record') -> add($arr);
				}					

				$thisUser = $userinfo_db -> where(array('token' => $thisCard['token'], 'wecha_id' => $arr['wecha_id'])) -> find();
				$userArr = array();
				if($thisOrder['type'] != 1)
				{
					$userArr['expensetotal'] = $thisUser['expensetotal'] + $arr['expense'];
				}
				$userArr['total_score'] = $thisUser['total_score'] + $arr['score'];
				$userinfo_db -> where(array('token' => $this -> token, 'wecha_id' => $arr['wecha_id'])) -> save($userArr);

            }
        }
        $order_model = $this -> db;
        $order_model -> where(array('orderid' => $id)) -> setField('paid', 1);
        if (strtolower($this -> getFrom()) == 'groupon'){
			//保存交易号和支付方式
            $order_model -> where(array('orderid' => $id)) -> save(array('transactionid' => $transaction_id, 'paytype' => $this -> payType,'paidprice'=>$paidprice));
        }
        if (strtolower($this -> getFrom()) == 'store'){
			//保存交易号和支付方式
            $order_model -> where(array('orderid' => $id)) -> save(array('transactionid' => $transaction_id, 'paytype' => $this -> payType,'paidprice'=>$paidprice));

        }
        if (strtolower($this -> getFrom()) == 'dining'){
			//保存交易号和支付方式
            $order_model -> where(array('orderid' => $id)) -> save(array('transactionid' => $transaction_id, 'paytype' => $this -> payType,'paidprice'=>$paidprice));
        } 
        if (strtolower($this -> getFrom()) == 'repast'){
			//保存交易号和支付方式
            $order_model -> where(array('orderid' => $id)) -> save(array('transactionid' => $transaction_id, 'paytype' => $this -> payType,'paidprice'=>$paidprice));
        } 
        if (strtolower($this -> getFrom()) == 'jiudian'){
			//保存交易号和支付方式
            $order_model -> where(array('orderid' => $id)) -> save(array('transactionid' => $transaction_id, 'paytype' => $this -> payType,'paidprice'=>$paidprice,'type'=>3));
        } 		
	   return $thisOrder;
    }
}
?>