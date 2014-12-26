<?php
class KefuonlineAction extends UserAction{
	//配置
	public function index(){
		$kefuonline=M('kefuonline')->where(array('token'=>session('token')))->find();
		if(IS_POST){
			if($kefuonline==false){				
				$this->all_insert('kefuonline','/index');
			}else{
				$_POST['id']=$kefuonline['id'];
				$this->all_save('kefuonline','/index');				
			}
		}else{
			//dump($kefuonline);
			$this->assign('kefuonline',$kefuonline);
			$this->display();
		}
	}
	
}



?>