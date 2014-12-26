<?php
class OfflinepayAction extends UserAction{
	public function _initialize() {
		parent::_initialize();
		if (!$this->token||!isset($_SESSION['gid'])){
			exit();
		}
	}

	public function index(){
		$Payment_db=M('payment');
		$payset = $Payment_db->where(array('token'=>$this->token,'pay_code'=>'offlinepay'))->find();
		if(IS_POST){
			$row['enabled']= $this->_post('enabled');
			if ($payset){
				$where=array('id'=>$payset['id']);
				$Payment_db->where($where)->save($row);
			}else {
				$row['pay_code']= 'offlinepay';
				$row['pay_name']= "线下支付";
				$row['token']= $this->token;
				$Payment_db->add($row);
			}
			$this->success('设置成功',U('Offlinepay/index',array('token'=>$this->token)));
		}else{
			$this->assign('payset',$payset);
			$this->display();
		}
	}
	public function cashrecord(){
		$cashrecord_db=M('cashrecord');
		$count	= $cashrecord_db->where(array('token'=>$this->token))->count();
		$Page	= new Page($count,20);
		$show	= $Page->show();
		$Cashrecord=$cashrecord_db->where(array('token'=>$this->token))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();	
		$this->assign('page',$show);
		$this->assign('Cashrecord',$Cashrecord);
		$this->display();
	}
}
?>