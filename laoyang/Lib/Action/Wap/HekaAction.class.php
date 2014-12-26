<?php
class HekaAction extends BaseAction{
	public $token;
	public $Heka;
	public $wecha_id;
	public function __construct(){

		parent::__construct();
		$this->token=session('token');
		// $this->token = $this->_get('token');
		$this->assign('token',$this->token);
        if ((!$_GET['wecha_id']||strpos($_GET['wecha_id'],"wecha")) && $this -> wxuser['winxintype'] == 3 && !isset($_GET['code']) && $this -> wxuser['oauth']){
            $customeUrl = C('site_url') . $_SERVER['REQUEST_URI'];
            $scope = 'snsapi_userinfo';
            if (isset($_GET['diymenu'])){
                $scope = 'snsapi_base';
            }
            $oauthUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $this -> wxuser['appid'] . '&redirect_uri=' . urlencode($customeUrl) . '&response_type=code&scope=' . $scope . '&state=oauth#wechat_redirect';
            header('Location:' . $oauthUrl);
        }
        if (isset($_GET['code']) && isset($_GET['state']) && isset($_GET['state']) == 'oauth'){
            $rt = $this -> curlGet('https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this -> wxuser['appid'] . '&secret=' . $this -> wxuser['appsecret'] . '&code=' . $_GET['code'] . '&grant_type=authorization_code');
            $jsonrt = json_decode($rt, 1);
            $openid = $jsonrt['openid'];
            $access_token = $jsonrt['access_token'];
            $_GET['wecha_id'] = $openid;
            $this -> wecha_id = $openid;
        }else{
            $this -> wecha_id = $this -> _get('wecha_id');
        }
		$this->assign('wecha_id',$this->wecha_id);
		$this->Heka=M('heka');
		

	}

	public function index(){
		
		$id= $this->_get('id');
		$where = array('id'=>$id);
		$data = $this->Heka->where($where)->find();
		//print_r($data);die;
		if($data){
			$this->Heka->where(array('id'=>$id))->setInc('see');
		}
		$this->assign('data', $data);
		$this->display();
	}
	public function get(){
		//print_r($_GET);die;
		if(IS_GET){
			$id = $_GET['id'];
			$data=$this->Heka->where(array('id'=>$id))->field('id,bg_topic,bg_music,banquan,sub,forwards,title,see')->find();
			if($data){
				$this->Heka->where(array('id'=>$id))->setInc('see');
			}
			if($_GET['from']=='app'){
				$this->Heka->where(array('id'=>$id))->setInc('forwards');
			}
			$data['name'] = $_GET['name'];
			$data['content'] = $_GET['info'];
			$data['bg_action'] = $_GET['bg_action'];
			$this->assign('data', $data);
			$this->display('index');
		}
	
	}

}
?>