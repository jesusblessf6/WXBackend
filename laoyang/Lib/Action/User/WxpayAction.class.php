<?php
class WxpayAction extends UserAction{
	public $Payment_db;
	public function _initialize() {
		parent::_initialize();
		$this->Payment_db=M('payment');
		if (!$this->token){
			exit();
		}
	}
	//微信支付
	public function index(){
		$payset = $this->Payment_db->where(array('token'=>$this->token,'pay_code'=>'wxpay'))->find();
		$pay_config = unserialize($payset['pay_config']);
		$config=array();
		if(IS_POST){
			$config['appId']=$this->_post('appId','trim');
			$config['appKey']=$this->_post('appKey','trim');
			$config['appSecret']=$this->_post('appSecret','trim');
			$config['partnerId']=$this->_post('partnerId','trim');
			$config['partnerKey']=$this->_post('partnerKey','trim');
			
			$row['enabled']= $this->_post('enabled');
			$row['pay_config']= serialize($config);
			if ($payset){
				$where=array('id'=>$payset['id']);
				$this->Payment_db->where($where)->save($row);
			}else {
				$row['pay_code']= 'wxpay';
				$row['pay_name']= "微信支付";
				$row['token']= $this->token;
				$this->Payment_db->add($row);
			}
			$this->success('设置成功',U('Wxpay/index',array('token'=>$this->token)));
		}else{
			$this->assign('payset',$payset);
			$this->assign('pay_config',$pay_config);
			$this->display();
		}
	}
}
?>