<?php
class ZuqiuAction extends LotteryBaseAction{
	public function index()
	{		
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		$this->assign('group',$group);
		$this->assign('activitynum',$user['activitynum']);
		$list=M('Lottery')->field('id,title,joinnum,click,keyword,statdate,enddate,status')->where(array('token'=>session('token'),'type'=>6))->select();
		//dump($list);
		$this->assign('count',M('Lottery')->where(array('token'=>session('token'),'type'=>6))->count());
		$this->assign('list',$list);
		$this->display();	
	}

	function response($data,$keywordArr)
	{		
		$ZD=M("Lottery")->where(array(
			'keyword'=>$data["Content"],
			'token'=>$data["token"]
		))->find();
		return array(
			array(
				array(
					'Title'=>$ZD['title'],
					'Description'=>strip_tags(htmlspecialchars_decode($ZD['info'])),
					'PicUrl'=>(empty($ZD['starpicurl'])?C('site_url'):$ZD['starpicurl']),
					'Url'=>C('site_url') . '/index.php?g=Apps&m=Zuqiu&a=wap_index&token=' .$data['token'] .'&wecha_id=' . $data['FromUserName'] .'&id='. $ZD["id"],
				)
			),
			'news'
		);
	}
	
	function menu()
	{
		return array(
				array('action'=>'add','name'=>'新增点球大战'),
				array('action'=>'index','name'=>'点球大战管理'),
		);
	}
	public function sn(){
		if(session('gid')==1){
			$this->error('vip0无法使用抽奖活动,请充值后再使用',U('Home/Index/price'));
		}
		$id=$this->_get('id');
		$data=M('Lottery')->where(array('token'=>session('token'),'id'=>$id,'type'=>6))->find();
		$record=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn!=""')->select();
		$recordcount=M('Lottery_record')->where('token="'.session('token').'" and lid='.$id.' and sn!=""')->count();
		$datacount=$data['fistnums']+$data['secondnums']+$data['thirdnums'];
		
		/*dump($datacount);
		dump($recordcount);
		dump($record);
		dump($sendCount);*/
		
		
		$this->assign('datacount',$datacount);//奖品数量
		$this->assign('recordcount',$recordcount);//中讲数量
		$this->assign('record',$record);
		//
		$sendCount=M('Lottery_record')->where('lid='.$id.' and sendstutas=1 and sn!=""')->count();
		$this->assign('sendCount',$sendCount);
		$this->display();
	
	
	}
	public function add(){
		if(session('gid')==1){
			$this->error('vip0无法使用抽奖活动,请充值后再使用',U('Home/Index/price'));
		}
		if(IS_POST){		
			$data=D('lottery');
			$_POST['statdate']=strtotime($_POST['statdate']);
			$_POST['enddate']=strtotime($_POST['enddate']);
			$_POST['token']=session('token');		
			if($data->create()!=false){				
				if($id=$data->add()){
					$data1['pid']=$id;
					$data1['module']='Lottery';
					$data1['token']=session('token');
					$data1['keyword']=$_POST['keyword'];
					M('Keyword')->add($data1);
					$user=M('Users')->where(array('id'=>session('uid')))->setInc('activitynum');
					$this->success('活动创建成功',U('Zuqiu/index'));
				}else{
					$this->error('服务器繁忙,请稍候再试');
				}
			}else{
				$this->error($data->getError());
			}
			
			
		}else{
			$this->display();
		}
	}
	public function setinc(){
		if(session('gid')==1){
			$this->error('vip0无法开启活动,请充值后再使用',U('Home/Index/price'));
		}
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$check=M('Lottery')->where($where)->find();
		if($check==false)$this->error('非法操作');
		$user=M('Users')->field('gid,activitynum')->where(array('id'=>session('uid')))->find();
		$group=M('User_group')->where(array('id'=>$user['gid']))->find();
		
		if($user['activitynum']>=$group['activitynum']){
			$this->error('您的免费活动创建数已经全部使用完,请充值后再使用',U('Home/Index/price'));
		}
		$data=M('Lottery')->where($where)->setInc('status');
		if($data!=false){
			$this->success('恭喜你,活动已经开始');
		}else{ 
			$this->error('服务器繁忙,请稍候再试');
		}

	}
	public function setdes(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$check=M('Lottery')->where($where)->find();
		if($check==false)$this->error('非法操作');
		$data=M('Lottery')->where($where)->setDec('status');
		if($data!=false){
			$this->success('活动已经结束');
		}else{
			$this->error('服务器繁忙,请稍候再试');
		}
	
	}
	public function edit(){
		if(IS_POST){
			$data=D('Lottery');
			$_POST['id']=$this->_get('id');
			$_POST['token']=session('token');
			$where=array('id'=>$_POST['id'],'token'=>$_POST['token'],'type'=>6);
			$_POST['statdate']=strtotime($_POST['statdate']);
			$_POST['enddate']=strtotime($_POST['enddate']);			
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($data->create()){				
				if($id=$data->where($where)->save($_POST)){
					$data1['pid']=$_POST['id'];
					$data1['module']='Lottery';
					$data1['token']=session('token');
					$da['keyword']=$_POST['keyword'];
					M('Keyword')->where($data1)->save($da);
					$this->success('修改成功');
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($data->getError());
			}
			
		}else{
			$id=$this->_get('id');
			$where=array('id'=>$id,'token'=>session('token'),'type'=>6);
			$data=M('Lottery');
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			$lottery=$data->where($where)->find();		
			$this->assign('vo',$lottery);
			//dump($lottery);
			$this->display('add');
		}
	
	}
	public function del(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data=M('Lottery');
		$check=$data->where($where)->find();
		if($check==false)$this->error('非法操作');
		$back=$data->where($where)->delete();
		if($back==true){
			M('Keyword')->where(array('pid'=>$id,'token'=>session('token'),'module'=>'Lottery'))->delete();
			$this->success('删除成功');
		}else{
			$this->error('操作失败');
		}
	
	
	}
	
	public function sendprize(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data['sendtime'] = time();
		$data['sendstutas'] = 1;
		$back = M('Lottery_record')->where($where)->save($data);
		if($back==true){
			$this->success('成功发奖');
		}else{
			$this->error('操作失败');
		}
	}
	
	public function sendnull(){
		$id=$this->_get('id');
		$where=array('id'=>$id,'token'=>session('token'));
		$data['sendtime'] = '';
		$data['sendstutas'] = 0;
		$back = M('Lottery_record')->where($where)->save($data);
		if($back==true){
			$this->success('已经取消');
		}else{
			$this->error('操作失败');
		}
	}
	
	protected function get_rand($proArr,$total) {
		$result = 6;
		$randNum = mt_rand(1, $total);
		foreach ($proArr as $k => $v) {
			 
			if ($v['v']>0){//奖项存在或者奖项之外
				if ($randNum>$v['start']&&$randNum<=$v['end']){
					$result=$k;
					break;
				}
			}
		}
		return $result;
	}
	
	
	
	public function wap_add(){
		if($_POST['action'] ==  'add'  ){
			$lid 				= $this->_post('lid');
			$wechaid 			= $this->_post('wechaid');
			$data['phone'] 		= $this->_post('tel');
			$data['wecha_name'] = $this->_post('wxname');
			$data['prize']		= $this->_post('prize');
			$data['islottery'] 	= 1;
			$data['time']		= time();
			$data['sn']			= uniqid();
			M('Lottery')->where(array('id'=>$lid))->setInc('joinnum');
			$rollback = M('Lottery_record')->where(array('lid'=> $lid,
					'wecha_id'=>$wechaid))->save($data);
			echo'{"success":1,"msg":"恭喜！尊敬的'.$data['wecha_name'].'请您保持手机通畅！请您牢记的领奖号:'.$data['sn'].'"}';
			exit;
		}
	}
}


?>