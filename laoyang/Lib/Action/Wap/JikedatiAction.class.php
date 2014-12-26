<?php

//wap

class JikedatiAction extends WapAction{

	public $token;

	public $wecha_id;


	public function __construct(){

		

		parent::__construct();

		$this->token=$this->_get('token');

		// $this->token = $this->_get('token');

		$this->assign('token',$this->token);

		$this->wecha_id	= $this->_get('wecha_id');

		if (!$this->wecha_id){

			$this->wecha_id='null';

		}
			$where['token']=$this->token;
		$kefu=M('kefuonline')->where($where)->find();
		$this->assign('kefu',$kefu);

		$this->assign('wecha_id',$this->wecha_id);

		$this->Fenlei_model=M('Fenlei');
     



	}
	//答题个人信息获取
	public function name(){
		$wecha_id	= $this->_get('wecha_id');
		$this->assign('wecha_id', $wecha_id);
		
		$info = M('jikedati_user')->where(array('wecha_id'=> $this->_get('wecha_id'),'token'=> $this->_get('token')))->find();
		if(!empty($info)){
			$this->redirect(U('Jikedati/index',array('token' => $this->token, 'wecha_id' => $this->wecha_id)));
			}
		if(IS_POST){
			
             $_POST['date']= date("Y-m-d H:i:s",time());
			if($user_id = M('jikedati_user')->add($_POST)){
				
				$url = U('Jikedati/index',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id']));
				
				$json = array(
					'success'=> true,
					'url'=> $url 
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'success'=> false,
				);
				echo  json_encode($json);
			}
		}else{
			$this->display();
		}
		
	}



	

	

	//预约列表
	public function index(){
		$pid = $this->_get('id');
		$wecha_id = $this->_get('wecha_id');
		$info = M('Jikedati')->where(array('token'=> $this->_get('token')))->select();
		$flash=M('Jikedati_flash')->where(array('token'=> $this->_get('token')))->find();
        $count      = M('Jikedati')->where(array('token'=> $this->_get('token')))->count();
		for($i=1;$i<5;$i++){

			if(!empty($flash['picurl'.$i])){

				$flash['picurl'][]=$flash['picurl'.$i];

				unset($flash['picurl'.$i]);

			}

		}
		//print_r($info);die;
		//print_r($str);die;
		$copyright=M('Jikedati_reply')->where(array('token'=> $this->_get('token')))->find();
		$this->assign('copyright',$copyright);
		$this->assign('info', $info);
		$this->assign('flash', $flash);
		$this->assign('count', $count);
		$this->display();
	}
	
	public function info(){
		$title = M('Jikedati')->where(array('token'=> $this->_get('token'),'id'=>$this->_get('id')))->find();
		$pid = $this->_get('id');
		$where = array('token'=> $this->_get('token'),'pid'=>$pid);
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$info = M('Jikedati_setcin')->where($where)->select();
		
        $copyright=M('Jikedati_reply')->where(array('token'=> $this->_get('token')))->find();
		$this->assign('copyright',$copyright);
		$this->assign('info', $info);
		$this->assign('title', $title);

		$this->display();

	}
	public function xiangqing(){
		$title = M('Fenlei')->where(array('token'=> $this->_get('token'),'id'=>$this->_get('pid')))->find();
		$pid = $this->_get('pid');
		$where = array('token'=> $this->_get('token'),'pid'=>$pid,'id'=>$this->_get('id'));
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$info = M('fenlei_setcin')->where($where)->find();
		
        $copyright=M('fenlei_reply')->where(array('token'=> $this->_get('token')))->find();
		$flash=M('fenlei_setcin')->where(array('token'=> $this->_get('token'),'pid'=>$pid,'id'=>$this->_get('id')))->find();
		//dump($flash);exit;

		for($i=1;$i<4;$i++){

			if(!empty($flash['picurl'.$i])){

				$flash['picurl'][]=$flash['picurl'.$i];

				unset($flash['picurl'.$i]);

			}

		}
		$this->assign('copyright',$copyright);
		$this->assign('info', $info);
		$this->assign('title', $title);
		$this->assign('flash', $flash);

		$this->display();
	}

	

	   }


?>