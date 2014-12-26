<?php
class DianyingAction extends WapAction{
	
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}		
		$info=M('Dianying')->where(array('token'=>$token))->find();
		$zjdp=M('Dianyingcom')->where(array('token'=>$token))->find();
		$lp_zjdp=M('Dianyingcom')->where(array('token'=>$token,'status'=>1,'subestatename'=>$this->_get('title')))->order('sort desc')->select();
		$lp=M('Dianying')->where(array('token'=>$token,'status'=>1,'id'=>$this->_get('id')))->order('id desc')->select();
	
		$this->assign('zjdp',$zjdp);
		$this->assign('lp_zjdp',$lp_zjdp);
		$this->assign('lp',$lp);
		$this->assign('info',$info);
		$this->display();
	}
	

		public function shouye(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		
		$info=M('Dianying')->where(array('token'=>$token))->find();
		$lp=M('Dianying')->where(array('token'=>$token,'status'=>1))->order('id desc')->select();
		
		$this->assign('info',$info);
		$this->assign('lp',$lp);
		$this->display();	
	}
	
		public function Dianyingcom_index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$info1=M('Dianying')->where(array('token'=>$token))->find();
		$info=M('Dianyingcom')->where(array('token'=>$token))->find();
		$lp=M('Dianyingcom')->where(array('token'=>$token,'status'=>1))->order('id desc')->select();
		
		$this->assign('info1',$info1);
		$this->assign('info',$info);
		$this->assign('lp',$lp);
		$this->display();	
	}
	
	public function subestate(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}		
		$info=M('Dianyingunits')->where(array('token'=>$token))->find();
		$lp=M('Dianyingunits')->where(array('token'=>$token,'status'=>1,'sub'=>$this->_get('name')))->order('sort desc')->select();
		$toppic=M('Dianying')->where(array('token'=>$token))->find();
	
		$this->assign('toppic',$toppic);
		$this->assign('info',$info);
		$this->assign('lp',$lp);
		$this->display();	
	}
	
	public function subestate_index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}	
		$info=M('Dianyingsub')->where(array('token'=>$token))->find();
		$lp1=M('Dianying')->where(array('token'=>$token,'status'=>1,'title'=>$this->_get('title')))->order('id desc')->select();
		$lp=M('Dianyingsub')->where(array('token'=>$token,'status'=>1,'title'=>$this->_get('title')))->order('sort desc')->select();
		$toppic=M('Dianying')->where(array('token'=>$token))->find();
		$this->assign('lp1',$lp1);
		$this->assign('toppic',$toppic);
		$this->assign('info',$info);
		$this->assign('lp',$lp);
		$this->display();	
	}
	
		public function jianjie(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}	
		$info=M('Dianyingsub')->where(array('token'=>$token,'status'=>1,'name'=>$this->_get('name')))->find();
		$this->assign('info',$info);
		$this->display();	
	}	
		public function houseunits(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}		
		$info=M('Dianyingunits')->where(array('token'=>$token,'id'=>$this->_get('id')))->find();
		$lp_elist=M('Dianyingunits')->where(array('token'=>$token,'id'=>$this->_get('id'),'status'=>1))->select();
		
		
		$this->assign('info',$info);
		$this->assign('elist',$lp_elist);
		$this->display();
		
	
	}
	
		public function poster(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
        $info=M('Dianyingposter')->where(array('token'=>$token))->find();
		$this->assign('info',$info);
		$this->display();
		
	
	}
	public function comments(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$zjdp=M('Dianyingcom')->where($where)->select();
		$count=count($zjdp);
		$this->assign('zjdp',$zjdp);
		$this->display();
	}
	public function photo(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$xc=M('Dianyingphoto')->where($where)->select();
		$count=count($xc);
		$this->assign('xc',$xc);
		$this->display();
	}
	public function photo_list(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token=$this->_get('token');
		if($token==false){
			echo '数据不存在';exit;
		}
		$xc=M('Dianyingphoto')->where($where)->select();
		$count=count($xc);
		$this->assign('xc',$xc);
		$this->display();
	}
}
?>
