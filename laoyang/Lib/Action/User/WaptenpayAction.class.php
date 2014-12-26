<?php
class WaptenpayAction extends UserAction{
	public $Payment_db;
	public function _initialize() {
		parent::_initialize();
		$this->Payment_db=M('payment');
		if (!$this->token){
			exit();
		}
	}
		//wap财付通
	public function index(){
		$payset = $this->Payment_db->where(array('token'=>$this->token,'pay_code'=>'waptenpay'))->find();
		$pay_config = unserialize($payset['pay_config']);
		$config=array();
		if(IS_POST){
			$config['partnerId']=$this->_post('partnerId','trim');
			$config['partnerKey']=$this->_post('partnerKey','trim');
			
			$row['enabled']= $this->_post('enabled');
			$row['pay_config']= serialize($config);
			if ($payset){
				$where=array('id'=>$payset['id']);
				$this->Payment_db->where($where)->save($row);
			}else {
				$row['pay_code']= 'waptenpay';
				$row['pay_name']= "手机财付通";
				$row['token']= $this->token;
				$this->Payment_db->add($row);
			}
			$this->success('设置成功',U('Waptenpay/index',$where));
		}else{
			$this->assign('payset',$payset);
			$this->assign('pay_config',$pay_config);
			$this->display();
		}
	}
}
?>