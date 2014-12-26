<?php
// 3G
class ReservationAction extends WapAction{
	public $thetype;
    public $token;
    public $wecha_id;
    public function _initialize() {
        parent::_initialize();
        $this->token=$this->_get('token');
        $this->wecha_id=$this->_get('wecha_id');
        $this->assign('token',$this->token);
        $this->assign('wecha_id',$this->wecha_id);
        //$get_ids = M('Estate')->where(array('token'=>$this->token))->field('res_id,classify_id')->find();
        //$this->assign('rid',$get_ids['res_id']);
    }

   public function index(){
       $agent = $_SERVER['HTTP_USER_AGENT'];
        if(!strpos($agent,"icroMessenger")) {
            //echo '此功能只能在微信浏览器中使用';exit;
        }
        $data = M("Reservation");
        $token      = $this->_get('token');
        $wecha_id   = $this->_get('wecha_id');
		$thetype    =$this->_get('thetype');
        $rid         = (int)$this->_get('rid');
        $this->assign('token',$token);
        $this->assign('wecha_id',$wecha_id);
        $where = array('token'=>$token,'thetype'=>$thetype);
        //$rid = M('Estate')->where($where)->getField('res_id');
		 $this->assign('rid',$rid);
		$where2 = array('token'=>$token,'id'=>$rid);
		$reslist1 =  $data->where($where2)->find();
		if(empty($reslist1)){
			$this->error('Sorry.请求错误！正在带您转到首页',U('Estate/index',array('token'=>$token,'wecha_id'=>$wecha_id)));
			exit;
		}

		$this->assign('reslist1',$reslist1);
		$t_carsaler = M('Estate_saler');
		$saler = $t_carsaler->where(array('token' => $token))->order('sort DESC')->select();
		$this->assign('estate_saler', $saler);
        $where3 = array('token'=>$token,'wecha_id'=>$wecha_id);
        $user = M('Userinfo')->where($where3)->field('truename,tel as user_tel')->find();
        if(!empty($user)){
            $reslist = array_merge($reslist,$user);
        }

		$this->assign('reslist',$reslist);
        $this->assign('thetype',$thetype);
        $t_housetype = M('Estate_housetype');
        $housetype = $t_housetype->where($where)->order('sort desc')->field('id as hid,name')->select();
        $this->assign('housetype',$housetype);
        $where4 = array('token'=>$token,'wecha_id'=>$wecha_id,'type'=>'house_book');
        $count = M('Reservebook')->where($where4)->count();
        $this->assign('count',$count);
        $this->display();

    }


    public function add(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if(!strpos($agent,"icroMessenger")) {
            //exit('此功能只能在微信浏览器中使用');
        }
        $da['token']      = $this->_post('token');
        $da['wecha_id']   = $this->_post('wecha_id');
        $da['rid']        = (int)$this->_post('rid');
        $da['truename']   = $this->_post("truename");
        $da['dateline']   = $this->_post("dateline");
        $da['timepart']   = $this->_post("timepart");
        $da['info']       = $this->_post("info");
        $da['tel']        = $this->_post("tel");
        $da['type']       = $this->_post('type');
        $das['id']        = (int)$this->_post('id');
        //$da['fieldsigle'] =$this->_post('fieldsigle');
        $da['housetype']  = $this->_post('fielddownload1');
		$da['estate_saler']  = $this->_post('fielddownload2');
        $da['booktime']   = time();

        $book   =   M('Reservebook');
//$where   = array('rid'=>$rid,'wecha_id'=>$wecha_id);
//$recode =  $book->where($where)->find();
  //  $arr=array('errno'=>1,'msg'=>$das['id'],'truename'=>$da['truename']);
  //  echo json_encode($arr);
  // exit;
        if($das['id'] != ''){
            $o = $book->where(array('id'=>$das['id']))->save($da);
            if($o){
			
			//短信通知置业顾问
			if($this->_post('fielddownload3')!='')
			{
				if(preg_match("/^13[0-9]{1}[0-9]{8}$|17[0678]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$/",$this->_post('fielddownload3')))
				{
					$info=M('wxuser')->where(array('token'=>$this->_post('token')))->find();			
					$user=$info['smsuser'];//短信平台帐号
					$pass=md5($info['smspassword']);//短信平台密码
					$content = "你有一位客户叫".$this->_post("truename")."预约了您看房！预约日期：".$this->_post("dateline")."，客户电话是：".$this->_post("tel");
					$content .= '【'.$info['subfix'].'】'; //加后缀
					if ($user && $smsstatus == 1 && $content) {
						$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$this->_post('fielddownload3').'&c='.urlencode($content));
					}
				}
			}
                 $arr=array('errno'=>0,'msg'=>'修改成功','token'=>$token,'wecha_id'=>$wecha_id);
                echo json_encode($arr);
                exit;
            }else{
                 $arr=array('errno'=>1,'msg'=>'修改失败','token'=>$token,'wecha_id'=>$wecha_id);
                echo json_encode($arr);
                exit;
            }
        }
        $ok = $book->data($da)->add();
        if(!empty($ok)){
			//短信通知置业顾问
			if($this->_post('fielddownload3')!='')
			{
				if(preg_match("/^13[0-9]{1}[0-9]{8}$|17[0678]{1}[0-9]{8}$|15[012356789]{1}[0-9]{8}$|18[012356789]{1}[0-9]{8}$/",$this->_post('fielddownload3')))
				{
					$info=M('wxuser')->where(array('token'=>$this->_post('token')))->find();			
					$user=$info['smsuser'];//短信平台帐号
					$pass=md5($info['smspassword']);//短信平台密码
					$content = "你有一位客户叫".$this->_post("truename")."预约了您看房！预约日期：".$this->_post("dateline")."，客户电话是：".$this->_post("tel");
					$content .= '【'.$info['subfix'].'】'; //加后缀
					if ($user && $smsstatus == 1 && $content) {
						$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$this->_post('fielddownload3').'&c='.urlencode($content));
					}
				}
			}
            $arr=array('errno'=>0,'msg'=>'恭喜预约成功','token'=>$token,'wecha_id'=>$wecha_id);
            echo json_encode($arr);
            exit;
        }else{
             $arr=array('errno'=>1,'msg'=>'预约失败，请重新预约','token'=>$token,'wecha_id'=>$wecha_id);
            echo json_encode($arr);
            exit;
        }

    }


    public function mylist(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if(!strpos($agent,"icroMessenger")) {
            //exit('此功能只能在微信浏览器中使用');
        }
        $token      = $this->_get('token');
        $wecha_id   = $this->_get('wecha_id');
        $this->assign('token',$token);	
        $this->assign('wecha_id',$wecha_id);
        $book   =   M('Reservebook');
        $where = array('token'=>$token,'wecha_id'=>$wecha_id);
        $books  = $book->where($where)->select();
        $this->assign('books',$books);

        $data = M("Reservation");
        $where2 = array('token'=>$token);
        $rid = $data->where($where2)->getField('headpic');
        $rid = M('Estate')->where($where)->getField('res_id');
        if($rid != ''){
            $where3 = array('token'=>$token,'id'=>$rid);
            $headpic =  $data->where($where3)->getField('headpic');
        }
        $this->assign('headpic',$headpic);
        $this->display();
    }

    public function edit(){
        $agent = $_SERVER['HTTP_USER_AGENT'];
        if(!strpos($agent,"icroMessenger")) {
            //exit('此功能只能在微信浏览器中使用');
        }			
        $book = M('Reservebook');
        $data = M("Reservation");
        $id = (int)$this->_get('id');
        $token = $this->_get('token');
		$rid	= (int)$this->_get('rid');
        $wecha_id = $this->_get('wecha_id');
        $where = array('id'=>$id,'token'=>$token,'wecha_id'=>$wecha_id);
        $reslist = $book->where($where)->field('id,rid,token,wecha_id,truename,tel as user_tel,housetype,dateline,timepart,info as userinfo,type,booktime')->find();
		$where2 = array('token'=>$token,'id'=>$rid);
		$reslist1 =  $data->where($where2)->find();
		$thetype = $reslist1['thetype'];
        $this->assign('thetype',$thetype);
		$t_carsaler = M('Estate_saler');
		$saler = $t_carsaler->where(array('token' => $token))->order('sort DESC')->select();
		$this->assign('estate_saler', $saler);
		if(empty($reslist1)){
			$this->error('Sorry.请求错误！正在带您转到首页',U('Estate/index',array('token'=>$token,'wecha_id'=>$wecha_id)));
			exit;
		}
		$this->assign('reslist1',$reslist1);
        if(!empty($reslist)){
            $this->assign('reslist',$reslist);
            $t_housetype = M('Estate_housetype');
            $housetype = $t_housetype->where(array('token'=>$token,'thetype'=>$thetype))->order('sort desc')->field('id as hid,name')->select();
            $this->assign('housetype',$housetype);
        }else{
            $this->error('操作错误',U('Estate/index',array('token'=>$token,'wecha_id'=>$wecha_id)));
        }
        // $where4 = array('token'=>$token,'wecha_id'=>$wecha_id,'type'=>'house_book');
        // $count = M('Reservebook')->where($where4)->count();
        // $this->assign('count',$count);
        $this->display('index');

    }


}?>