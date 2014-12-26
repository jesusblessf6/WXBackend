<?php

class KefuonlineAction extends WapAction{

	public function index(){

		$token	  =  $this->_get('token');

		$id 	  = $this->_get('id');

		$kefuonline = M('kefuonline')->where(array('token'=>$token))->find(); 

		$this->assign('kefuonline',$kefuonline);

		$this->display();

	}
}
?>