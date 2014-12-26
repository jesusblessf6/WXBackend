<?php
class WapalipayAction extends UserAction{
	public $Payment_db;
	public function _initialize() {
		parent::_initialize();
		$this->Payment_db=M('payment');
		if (!$this->token){
			exit();
		}
	}
	//手机支付宝
	public function index(){
		$payset = $this->Payment_db->where(array('token'=>$this->token,'pay_code'=>'wapalipay'))->find();
		$pay_config = unserialize($payset['pay_config']);
		$config=array();
		if(IS_POST){
			$config['pid']=$this->_post('pid');
			$config['key']=$this->_post('key');
			$config['account']=$this->_post('account','trim');
			
			$row['enabled']= $this->_post('enabled');
			$row['pay_config']= serialize($config);
			if ($payset){
				$where=array('id'=>$payset['id']);
				$this->Payment_db->where($where)->save($row);
			}else {
				$row['pay_code']= 'wapalipay';
				$row['pay_name']= "手机支付宝";
				$row['token']= $this->token;
				$this->Payment_db->add($row);
			}
			$this->success('设置成功',U('Wapalipay/index',array('token'=>$this->token)));
		}else{
			$this->assign('payset',$payset);
			$this->assign('pay_config',$pay_config);
			$this->display();
		}
	}
}
?>