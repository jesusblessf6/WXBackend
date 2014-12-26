<?php
//wap
class YuyueAction extends WapAction{
	public $token;
	public $wecha_id;
	public $Yuyue_model;
	public $yuyue_order;
	public function __construct(){
		
		parent::__construct();
		$this->token=session('token');
		// $this->token = $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='null';
		}
		$this->assign('wecha_id',$this->wecha_id);
		$this->Yuyue_model=M('yuyue');
		$this->yuyue_order=M('yuyue_order');				$this->wxuser=M('wxuser');		
		$this->type='Yuyue';

	}

	
	//预约列表
	public function index(){
		$pid = $this->_get('id');
		$wecha_id = $this->_get('wecha_id');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		$data = $this->Yuyue_model->where($where)->find();
		$info = M('yuyue_setcin')->where(array('pid'=>$pid,'type'=>$this->type))->select();
		//print_r($info);die;
		$data['count'] = $this->yuyue_order->where(array('wecha_id'=> $wecha_id,'pid'=>$pid))->count();
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $wecha_id;
		//print_r($str);die;
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	public function info(){
		$pid = $this->_get('id');
		$id = $this->_get('aid');
		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		
		$cast = array(
			'token'=> $this->_get('token'),
			'wecha_id'=> $this->_get('wecha_id')
		);
		$info = M('yuyue_setcin')->where(array('id'=>$id))->find();
		$info['sheng']=$info['yuanjia']-$info['youhui'];
		$data = $this->Yuyue_model->where($where)->find();
		for($i=1;$i<6;$i++){
			if(!empty($info['pic'.$i])){
				$info['pic'][]=$info['pic'.$i];
				unset($info['pic'.$i]);
			}
		}
		//print_r($data);print_r($info);die;
		$data['token'] = $this->_get('token');
		$data['wecha_id'] = $this->_get('wecha_id');
		$wap= M('setinfo')->where(array('pid'=>$pid))->select();
		$str=array();
		//print_r($wap);die;
		foreach($wap as $v){

			if($v['kind']==5){
				$str["message"]=$v["name"];
			}else{
				$str[$v["name"]]=$v["value"];
			}		
		}
		//print_r($str);die;
		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();
		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();
		$i=0;
		foreach($list as $v){
			$list[$i]['value']= explode("|",$v['value']);
			$i++;
		}
		//print_r($list);die;
		
		$this->assign('str', $str);
		$this->assign('arr',$arr);
		$this->assign('list',$list);
		$this->assign('data', $data);
		$this->assign('info', $info);
		$this->display();
	}
	
	//添加订单
	public function add(){
		//print_r($_POST());die;
		if(IS_POST){
			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));
			$url = substr($url,1);
			//$url = U($this->type.'/order',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']));
			$_POST['date']= date("Y-m-d H:i:s",time());						$flag=false;
			if($this->yuyue_order->add($_POST)){
				$json = array(
					'error'=> 1,
					'msg'=> '添加成功！',
					'url'=> $url
				);								$flag=true;
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '添加失败！',
					'url'=> U($this->type.'/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']))
				);
				echo  json_encode($json);
			}						if($flag)			{				//短信通知商家				$where = array('token'=>$_POST['token']);				$check1 = $this->wxuser->where($where)->order('id desc')->select();				$smsstatus = $check1[0]['smsstatus'];								if($smsstatus=='1')				{					$smsuser = $check1[0]['smsuser'];					$smspassword = $check1[0]['smspassword'];					$phone=$check1[0]['phone'];					$content="亲，".$_POST['name']."刚刚预约成功，预约时间：".$_POST['date']."，请及时去处理哦！";					$smsapi = "api.smsbao.com"; //短信网关 					$charset = "utf8"; //文件编码 					$user = $smsuser; //短信平台帐号 					$pass = md5($smspassword); //短信平台密码 					include_once("snoopy.php"); 					$snoopy = new snoopy();					$sendurl = "http://{$smsapi}/sms?u={$user}&p={$pass}&m={$phone}&c=".urlencode($content);					$snoopy->fetch($sendurl);					$result = $snoopy->results;				}			}
		}
	}
	}
	
	//订单列表
	public function order(){
		$id = $this->_get('id');
		$token = $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
		$where = array(
			'wecha_id'=> $wecha_id,
			'pid'=> $id
		);
		$data = $this->yuyue_order->where($where)->order('id desc')->select();
		$info= $this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$id))->find();
		//print_r($data);die;
		$this->assign('data',$data);
		$this->assign('info',$info);
		$this->display();
	}
	
	//修改订单视图
	public function set(){
		$id = $this->_get('id');
		$pid = $this->_get('pid');
		$data = M('yuyue_order')->find($id);
		$data['pid'] = $pid;
		$data['id'] = $id;
		$this->assign('data',$data);
		$this->display();
	}
	
	//修改订单
	public function runSet(){
	
		$id = $_GET['id']; 
		if(IS_POST){
			//$url = U('Yuyue/set',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['pid'],));
			$where = array(
				'id' =>$id
			);
			if($this->yuyue_order->where($where)->save($_POST)){
				$json = array(
					'error'=> 1,
					'msg'=> '修改成功！',
					'url'=> $url
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '修改失败！',
					'url'=> $url
				);
				echo  json_encode($json);
			}
		}
		
	}
	
	//删除订单
	public function del(){
		if(IS_POST){
			//$url = U('Yuyue/set',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'pid'=>$_POST['pid'],));
			$where = array(
				'id' =>$_POST['id']
			);
			if($this->yuyue_order->where($where)->delete()){
				$json = array(
					'error'=> 1,
					'msg'=> '删除成功！',
					'url'=> $url
				);
				echo  json_encode($json);
			}else{
				$json = array(
					'error'=> 0,
					'msg'=> '删除失败！',
					'url'=> $url
				);
				echo  json_encode($json);
			}
		}
	}
	
}


?>