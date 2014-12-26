<?php
class KefuonlineModel extends Model{
	protected $_validate = array(
			array('info2','require','直接聊天代码必须填写',1),
			array('id','checkid','非法操作',2,'callback',2),
	);
	protected $_auto = array (		
		array('token','getToken',Model:: MODEL_BOTH,'callback'),
	);
	function checkid(){
		$dataid=$this->field('id')->where(array('id'=>$_POST['id'],'token'=>session('token')))->find();
		if($dataid==false){
			return false;
		}else{
			return true;
		}
	}
	function getToken(){	
		return $_SESSION['token'];
	}
}
?>
