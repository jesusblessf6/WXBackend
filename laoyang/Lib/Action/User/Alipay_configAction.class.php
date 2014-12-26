<?php
class Alipay_configAction extends UserAction{
	public $Payment_db;
	public function _initialize() {
		parent::_initialize();
		$this->Payment_db=M('payment');
		if (!$this->token){
			exit();
		}
	}
	//老杨免签支付宝
	public function index(){
		$payset = $this->Payment_db->where(array('token'=>$this->token,'pay_code'=>'bwalipay'))->find();
		$pay_config = unserialize($payset['pay_config']);
		$config=array();
		if(IS_POST){
			$config['account']=$this->_post('account','trim');
			
			$row['enabled']= $this->_post('enabled');
			$row['pay_config']= serialize($config);
			if ($payset){
				$where=array('id'=>$payset['id']);
				$this->Payment_db->where($where)->save($row);
			}else {
				$row['pay_code']= 'bwalipay';
				$row['pay_name']= "支付宝";
				$row['token']= $this->token;
				$this->Payment_db->add($row);
			}
			$this->success('设置成功',U('Alipay_config/index',array('token'=>$this->token)));
		}else{
			$this->assign('payset',$payset);
			$this->assign('pay_config',$pay_config);
			$this->display();
		}
	}
}
?>