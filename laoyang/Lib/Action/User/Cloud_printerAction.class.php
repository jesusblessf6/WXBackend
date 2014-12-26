<?php
class Cloud_printerAction extends UserAction{
	public $Cloud_printer_db;
	public function _initialize() {
		parent::_initialize();
		$this->Cloud_printer_db=M('cloud_printer');
		if (!$this->token){
			exit();
		}
	}
	//微信打印
	public function index(){
		$printerset = $this->Cloud_printer_db->where(array('token'=>$this->token))->find();
		
		if(IS_POST){
			$row['token']=$this->_post('token');
			$row['url']=$this->_post('url');
			$row['key']=$this->_post('key');
			$row['type']=$this->_post('type');
			$row['enable']=$this->_post('enable');
			$row['payon']=$this->_post('payon');
			if ($printerset){
				$where=array('token'=>$this->token);
				$this->Cloud_printer_db->where($where)->save($row);
			}else {
				$this->Cloud_printer_db->add($row);
			}
			$this->success('设置成功',U('Cloud_printer/index',$where));
		}else{
			$this->assign('printerset',$printerset);
			$this->display();
		}
	}
}


?>