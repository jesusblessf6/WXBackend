<?php
class GamettAction extends WapAction{
    public function index(){
       
        
        $token      = $this->_get('token'); 
		$gametreply_info_db=M('gamettreply_info');
		$info=$gametreply_info_db->where(array('token'=>$token))->find();
		//dump($info);exit;
		$this->assign('info',$info);

      //  $this->assign('isAndroid',isAndroid());
        $this->display();
    }
    
}
    
?>