<?php
//	wap

class ZhongchouAction extends WapAction{

	public $token;
	public $wecha_id;
	public $zhongchou;
	public $zhongchou_user;
	public $zhongchou_id;
	public $urlarr;
	public $user_id;
	
	public function __construct(){

		parent::__construct();	
		$this->token=$this->_get('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		
		$this->user_id = $this->_get('uid');
		$this->zhongchou_id = $this->_get('id');
		$this->zhongchou=M('Zhongchou');
		$this->zhongchou_user=M('Zhongchou_user');
		$this->urlarr =array(
			'token'=>$this->token, 
			'wecha_id'=> $this->wecha_id, 
			'id'=> $this->zhongchou_id,
			'uid'=> $this->user_id
		);
		
		$this->assign('token',$this->token);
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('urlarr',$this->urlarr);
		$this->assign('Zhongchou_id',$this->zhongchou_id);
		
		
		
	}
	
	//众筹开始界面
	public function index(){
		$where = array(
			'id'=> $this->zhongchou_id,'token'=>$this->token
		);

		$data = $this->zhongchou->where($where)->find();
		//print_r($data);die();
		$this->assign('data', $data);
		$this->display();
	}
	
	//众筹个人信息获取
	public function name(){
		if(IS_POST){
			if($user_id = $this->zhongchou_user->add($_POST)){
				$urlarr = $this->urlarr;
				$urlarr['uid'] = $user_id;
				$urlarr['p'] = 1;
				$url = U("Zhongchou/set",$urlarr);
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
	

	//众筹建议采集
	public function Comment(){
		$where = array(
			'id'=> $this->zhongchou_id,
		);
		$field = array(
			'title',
		);
		$data = $this->zhongchou->field($field)->where($where)->find();
		
		$this->assign('data', $data);
		$this->display();
	}
	
	//众筹结束
	public function end(){
		// dump($_POST);die;
		$where = array(
				'id'=> $this->zhongchou_id,
		);
		$field = array(
				'einfo',
				'title',
				'stime',
				'etime'
		);
		$data = $this->zhongchou->field($field)->where($where)->find();
		$this->zhongchou_user->where(array('id'=>$_GET['uid']))->save($_POST);
		$this->assign('data', $data);
		$this->display();
	}
	
}


?>