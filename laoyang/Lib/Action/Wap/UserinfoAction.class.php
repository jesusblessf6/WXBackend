<?php
class UserinfoAction extends WapAction{
	public function _initialize() {
		parent::_initialize();
		session('wapupload',1);
		if (!$this->wecha_id){
			$this->error('您无权访问','');
		}
	}
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"icroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$cardid=intval($this->_get('cardid'));
		session('send_code',$this -> random(6,1));//生成手机验证码
		//$sql=D('Userinfo');
		$card = D('Member_card_create'); 
		$data['wecha_id']=$this->_get('wecha_id');
		$data['token']=$this->_get('token');
		//
		$cardInfoRow['wecha_id']=$this->_get('wecha_id');
		$cardInfoRow['token']=$this->_get('token');
		$cardInfoRow['cardid']=$this->_get('cardid');
		$cardinfo=$card->where($cardInfoRow)->find(); //是否领取过
		$this->assign('cardInfo',$cardinfo);
		//
		$member_card_set_db=M('Member_card_set');
		$thisCard=$member_card_set_db->where(array('token'=>$this->_get('token'),'id'=>intval($_GET['cardid'])))->find();
		if (!$thisCard&&$cardid){
			exit();
		}
		//
		$sql=D('Userinfo');
		$userinfo=$sql->where($data)->find();
		if($thisCard['memberinfo']!=false){
			$img=$thisCard['memberinfo'];			
		}else{
			$img='tpl/Wap/default/common/images/userinfo/fans.jpg';
		}
		$this->assign('cardnum',$cardinfo['number']);
		$this->assign('homepic',$img);
		$this->assign('thisCard',$thisCard);
		$this->assign('info',$userinfo);
		$this->assign('cardid',$cardid);
		//redirect url
		if (isset($_GET['redirect'])){
			$urlinfo=explode('|',$_GET['redirect']);
			$parmArr=explode(',',$urlinfo[1]);
			$parms=array('token'=>$cardInfoRow['token'],'wecha_id'=>$cardInfoRow['wecha_id']);
			if ($parmArr){
				foreach ($parmArr as $pa){
					$pas=explode(':',$pa);
					$parms[$pas[0]]=$pas[1];
				}
			}
			$redirectUrl=U($urlinfo[0],$parms);
			$this->assign('redirectUrl',$redirectUrl);
		}
		//
		if(IS_POST){
			//如果有post提交，说明是修改	
			if($this->_post('wechaname'))
			{
				$data['wechaname'] = $this->_post('wechaname');
			}
			if($this->_post('tel'))
			{
				$data['tel']       = $this->_post('tel');
				if(empty($data['tel'])){
					$this->error("手机号必填。");exit;
				}
			}		
			if($this->_post('truename'))
			{
				$data['truename']  = $this->_post('truename');
			}
			if($this->_post('qq'))
			{
				$data['qq']  = $this->_post('qq');
			}
				$data['sex'] = $this->_post('sex');
			if($this->_post('bornyear'))
			{
				$data['bornyear'] = $this->_post('bornyear');
			}
			if($this->_post('bornmonth'))
			{
				$data['bornmonth'] = $this->_post('bornmonth');
			}
			if($this->_post('bornday'))
			{
				$data['bornday'] = $this->_post('bornday');
			}
			$data['portrait'] = $this->_post('portrait');
			//$this->error("手机号必填。");exit;
			if($this->_post('diy1_value'))
			{			
				$data['diy1_value'] = $this->_post('diy1_value');
			}
			if($this->_post('diy2_value'))
			{			
				$data['diy2_value'] = $this->_post('diy2_value');
			}
			if($this->_post('paypass') != ''){
				$data['paypass'] = md5($this->_post('paypass'));
			}
			//验证手机短信
			if($this->_post('mobile_code') != ''){
				$moblie=$this->_post('tel');
				$mobile_code=$this->_post('mobile_code');
				if($moblie!=$_SESSION['mobile'] or $mobile_code!=$_SESSION['mobile_code'] or empty($moblie) or empty($mobile_code)){
					echo 5;exit;
				}	
			}			
 			//如果会员卡不为空[更新]
 			//写入两个表 Userinfo Member_card_create 
 			if ($cardid==0){
 				
 				$infoWhere=array();
 				$infoWhere['wecha_id']=$data['wecha_id'];
 				$infoWhere['token']=$data['token'];
 				$userInfoExist=M('Userinfo')->where($infoWhere)->find();
 				if ($userInfoExist){
 					M('Userinfo')->where($infoWhere)->save($data);
 				}else {
 					M('Userinfo')->add($data);
 				}
 				S('fans_'.$this->token.'_'.$this->wecha_id,NULL);
 				echo 1;exit;
 			}else {
 				if($cardinfo){ //如果Member_card_create 不为空，说明领过卡，但是可以修改会员信息
 					$update['wecha_id']=$data['wecha_id'];
 					$update['token']=$data['token'];
 					unset($data['wecha_id']);
 					unset($data['token']);
 					if(M('Userinfo')->where($update)->save($data)){
 						S('fans_'.$this->token.'_'.$this->wecha_id,NULL);
 						echo 1;exit;
 					}else{
 						echo 0;exit;
 					}
 				}else{
 					//Sms::sendSms($this->token,'有新的会员领了会员卡');
 					$card=M('Member_card_create')->field('id,number')->where("token='".$this->_get('token')."' and cardid=".intval($_POST['cardid'])." and wecha_id = ''")->order('id ASC')->find();
 					//
 					$userinfo_db=M('Userinfo');
 					$userInfos=$userinfo_db->where(array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id')))->select();
 					$userScore=0;
 					if ($userInfos){
 						$userScore=intval($userInfos[0]['total_score']);
 						$userInfo=$userInfos[0];
 					}
 					if(!$card){
 						echo 3;exit;
 					}else {
 						//
 						if (intval($thisCard['miniscore'])==0||$userScore>intval($thisCard['minscore'])){
 							M('Member_card_create')->where(array('token'=>$this->_get('token'),'wecha_id'=>$this->_get('wecha_id')))->delete();
 							$card_up=M('Member_card_create')->where(array('id'=>$card['id']))->save(array('wecha_id'=>$this->_get('wecha_id')));
 							$data['getcardtime']=time();
 							if ($userinfo){
 								$update['wecha_id']=$data['wecha_id'];
 								$update['token']=$data['token'];
 								M('Userinfo')->where($update)->save($data);
 							}else {
 								M('Userinfo')->data($data)->add();
 							}
 							S('fans_'.$this->token.'_'.$this->wecha_id,NULL);
 							echo 2;exit;
 						}else {
 							echo 4;exit;
 						}
 					}

 				} //post
 			}
		}else {
			$this->display();	
		}

		
    } 
	public function getcode()
	{
		$send_code = $_POST['send_code'];
		$mobile = $_POST['mobile'];
		if(empty($mobile)){
			exit('手机号码不能为空');
		}
		
		if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
			//防用户恶意请求
			exit('请求超时，请刷新页面后重试');
		}
		
		$mobile_code = $this->random(4,1);
		///$mobile_code = 111;//测试
		$thisWxUser=M('Wxuser')->where(array('token'=>$this->_get('token')))->find();				
		$user=$thisWxUser['smsuser'];//短信平台帐号
		$pass=md5($thisWxUser['smspassword']);//短信平台密码
		$content .= '【'.$thisWxUser['subfix'].'】'; //加后缀
		$smsapi = "api.smsbao.com";
		include_once("snoopy.php");
		$snoopy = new snoopy();
		$sendurl = "http://{$smsapi}/sms?u={$user}&p={$pass}&m={$mobile}&c=".urlencode("您的验证码：".$mobile_code."。请不要把验证码泄露给其他人，如果不是本人操作，请忽略此短信。".$content);				
		$snoopy->fetch($sendurl);
		$result = $snoopy->results;
		//$result = 0;//测试
		if($result == 0){
			$result ="验证码获取成功，请查收！";
			$_SESSION['mobile'] = $mobile;
			$_SESSION['mobile_code'] = $mobile_code;
		}else{
			$result ="验证码获取失败，请重试！";
		}
		echo $result;
	}

	//获取随机字符串
	public function random($length = 6 , $numeric = 0) {
		PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
		if($numeric) {
			$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
		} else {
			$hash = '';
			$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
			$max = strlen($chars) - 1;
			for($i = 0; $i < $length; $i++) {
				$hash .= $chars[mt_rand(0, $max)];
			}
		}
		return $hash;
	}	
}

?>