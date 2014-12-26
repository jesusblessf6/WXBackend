<?php
class IndexAction extends UserAction{
	//公众帐号列表
	public function index(){
		if (class_exists('demoImport')){
			$this->assign('demo',1);
			//
			$token=$this->get_token();
			$pigSecret=$this->get_token(20,0,1);
			$wxinfo=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
			if (!$wxinfo){
				$demoImport=new demoImport(session('uid'),$token,$pigSecret);
			}
			$wxinfo=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
			$this->assign('wxinfo',$wxinfo);
			//
			$this->assign('token',$token);
		}
		//
		$where['uid']=session('uid');
		$group=D('User_group')->select();
		foreach($group as $key=>$val){
			$groups[$val['id']]['did']=$val['diynum'];
			$groups[$val['id']]['cid']=$val['connectnum'];
		}
		unset($group);
		$db=M('Wxuser');
		$count=$db->where($where)->count();
		$page=new Page($count,100);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		if ($info){
			foreach ($info as $item){
				if (!$item['appid']&&$apiinfo['appid']&&$apiinfo['appsecret']){
					$apiinfo=M('Diymen_set')->where(array('token'=>$item['token']))->find();
					$db->where(array('id'=>$item['id']))->save(array('appid'=>$apiinfo['appid'],'appsecret'=>$apiinfo['appsecret']));
				}else {
					$diymen=M('Diymen_set')->where(array('token'=>$item['token']))->find();
					if (!$diymen&&$item['appid']&&$item['appsecret']){
					M('Diymen_set')->add(array('token'=>$item['token'],'appid'=>$item['appid'],'appsecret'=>$item['appsecret']));
					}
				}
				//
			}
		}
		
		$this->assign('thisGroup',$this->userGroup);
		$this->assign('info',$info);
		$this->assign('group',$groups);
		$this->assign('page',$page->show());
		if (count($info)==1&&$info[0]['wxid']=='demo'){
			$this->assign('info',$info[0]);
			$this->display('bindTip');
		}else {
			$this->display();
		}
	}
	//

		public function frame(){

		$qx=M('Users')->where(array('id'=>session('uid')))->find();
		//dump($qx);exit;
		$id=$this->_get('id','intval');
		if (!$id){
			$token=$this->token;
			$info=M('Wxuser')->find(array('token'=>$this->token));
		}else {
			$info=M('Wxuser')->find($id);
		}
		$wecha=M('Wxuser')->field('wxname,wxid,headerpic,weixin')->where(array('token'=>session('token'),'uid'=>session('uid')))->find();
		$this->assign('wecha',$wecha);
		session('token',$token);
		session('wxid',$info['id']);
		

	/* $token=$this->token; */
		$token=$this->_get('token','trim');	
		session('token',$token);
		$this->assign('token',session('token'));
		$this->assign('qx',$qx);
		$this->display();
	}	
	public function info(){
		$where['uid']=session('uid');
		$group=D('User_group')->select();
		foreach($group as $key=>$val){
			$groups[$val['id']]['did']=$val['diynum'];
			$groups[$val['id']]['cid']=$val['connectnum'];
		}
		unset($group);
		$db=M('Wxuser');
		$count=$db->where($where)->count();
		$page=new Page($count,25);
		$info=$db->where($where)->limit($page->firstRow.','.$page->listRows)->select();
		if ($info){
			foreach ($info as $item){
				if (!$item['appid']){
					$apiinfo=M('Diymen_set')->where(array('token'=>$item['token']))->find();
					$db->where(array('id'=>$item['id']))->save(array('appid'=>$apiinfo['appid'],'appsecret'=>$apiinfo['appsecret']));
				}else {
					$diymen=M('Diymen_set')->where(array('token'=>$item['token']))->find();
					if (!$diymen){
					M('Diymen_set')->add(array('token'=>$item['token'],'appid'=>$item['appid'],'appsecret'=>$item['appsecret']));
					}
				}
				//
			}
		}
		$this->assign('thisGroup',$this->userGroup);
		$this->assign('info',$info);
		$this->assign('group',$groups);
		$this->assign('page',$page->show());
		$this->display();
	}
	
	public function get_token($randLength=6,$attatime=1,$includenumber=0){
		if ($includenumber){
			$chars='abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
		}else {
			$chars='abcdefghijklmnopqrstuvwxyz';
		}
		$len=strlen($chars);
		$randStr='';
		for ($i=0;$i<$randLength;$i++){
			$randStr.=$chars[rand(0,$len-1)];
		}
		$tokenvalue=$randStr;
		if ($attatime){
			$tokenvalue=$randStr.time();
		}
		return $tokenvalue;
	}
	//添加公众帐号
	public function add(){
		$randLength=6;
		$chars='abcdefghijklmnopqrstuvwxyz';
		$len=strlen($chars);
		$randStr='';
		for ($i=0;$i<$randLength;$i++){
			$randStr.=$chars[rand(0,$len-1)];
		}
		$tokenvalue=$randStr.time();

		$this->assign('tokenvalue',$tokenvalue);
		$this->assign('email',time().'@yourdomain.com');
		$this->display();
	}
	public function edit(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$where['id']=$id;
		$res=M('Wxuser')->where($where)->find();
		$this->assign('info',$res);
		$this->display();
	}
	
	public function bindEdit(){
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find();
		$this->assign('info',$res);
		$this->display();
	}
	public function del(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$thisWxUser=M('Wxuser')->where(array('id'=>$where['id']))->find();
		$users=M('Users')->where(array('id'=>$thisWxUser['uid']))->find();
		if(D('Wxuser')->where($where)->delete()){
			if ($this->isAgent){
				$wxuserCount=M('Wxuser')->where(array('agentid'=>$this->thisAgent['id']))->count();
				M('Agent')->where(array('id'=>$this->thisAgent['id']))->save(array('wxusercount'=>$wxuserCount));
				if ($this->thisAgent['wxacountprice']&&time()-$thisWxUser['createtime']<5*24*3600){
					
					$pricebyMonth=intval($this->thisAgent['wxacountprice'])/12;
					$month=($users['viptime']-time())/(30*24*3600);
					$month=intval($month);
					$price=$month*$pricebyMonth;
					//
					M('Agent')->where(array('id'=>$this->thisAgent['id']))->setInc('moneybalance',$price);
					M('Agent_expenserecords')->add(array('agentid'=>$this->thisAgent['id'],'amount'=>$price,'des'=>$this->user['username'].'(uid:'.$this->user['id'].')删除公众号'.$thisWxUser['wxname'].'_'.$month.'个月','status'=>1,'time'=>time()));
				}
			}
			$this->success('操作成功',U(MODULE_NAME.'/info'));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/info'));
		}
	}
	
	public function upsave(){
		S('wxuser_'.$this->token,NULL);
		M('Diymen_set')->where(array('token'=>$this->token))->save(array('appid'=>trim($this->_post('appid')),'appsecret'=>trim($this->_post('appsecret'))));
		//
		$db=D('Wxuser');
		if (isset($_POST['demoStep'])){
			$back='/bindHelp?id='.intval($_POST['id']);
		}else {
			$back='';
		}
		if($db->create()===false){
			$this->error($db->getError());
		}else{
			$id=$db->save();
			if($id){
				if (isset($_POST['demoStep'])){
					header('Location:'.$this->siteUrl.U('Index/bindHelp',array('id'=>intval($_POST['id']))));
				}else {
					$this->success('操作成功',U('Index/info'));
				}
				
			}else{
				$this->error('操作失败',U('Index/info'));
			}
		}
	}
	
	public function insert(){
		$data=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
		$users=M('Users')->where(array('id'=>session('uid')))->find();
		//
		if ($this->isAgent){
			$needPay=0;
			if (($users['viptime']-$users['createtime']-20)>$this->reg_validDays*24*3600||$this->reg_validDays>30){
				$needPay=1;
			}
			if ($needPay){
				$pricebyMonth=intval($this->thisAgent['wxacountprice'])/12;
				$month=($users['viptime']-time())/(30*24*3600);
				$month=intval($month);
				$price=$month*$pricebyMonth;
				$price=intval($price);
				if ($price>$this->thisAgent['moneybalance']){
					$this->error('请联系您的站长处理');
				}
			}
		}
		//
		if($users['wechat_card_num']<$data['wechat_card_num']){
			
		}else{
			$this->error('您的VIP等级所能创建的公众号数量已经到达上线，请购买后再创建',U('User/Index/index'));exit();
		}
		//$this->all_insert('Wxuser');
		//
		$db=D('Wxuser');
		if ($this->isAgent){
			$_POST['agentid']=$this->thisAgent['id'];
		}
		$pigSecret=$this->get_token(20,0,1);
		$_POST['pigsecret']=$pigSecret;
		if($db->create()===false){
			$this->error($db->getError());
		}else{
			$id=$db->add();
			if($id){
				if ($this->isAgent){
					$wxuserCount=M('Wxuser')->where(array('agentid'=>$this->thisAgent['id']))->count();
					M('Agent')->where(array('id'=>$this->thisAgent['id']))->save(array('wxusercount'=>$wxuserCount));
					if ($this->thisAgent['wxacountprice']){
						//试用期内不扣费
						if ($needPay){
							$pricebyMonth=intval($this->thisAgent['wxacountprice'])/12;
							$month=($users['viptime']-time())/(30*24*3600);
							$month=intval($month);
							$price=$month*$pricebyMonth;
							M('Agent')->where(array('id'=>$this->thisAgent['id']))->setDec('moneybalance',$price);
							M('Agent_expenserecords')->add(array('agentid'=>$this->thisAgent['id'],'amount'=>(0-$price),'des'=>$this->user['username'].'(uid:'.$this->user['id'].')添加公众号'.$_POST['wxname'].'('.$month.'个月)','status'=>1,'time'=>time()));
						}
					}
				}
				M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->setInc('wechat_card_num');
				$this->addfc();
				M('Diymen_set')->add(array('appid'=>trim($this->_post('appid')),'token'=>$this->_post('token'),'appsecret'=>trim($this->_post('appsecret'))));
				//
				$this->success('操作成功',U('Index/info'));
			}else{
				$this->error('操作失败',U('Index/info'));
			}
		}
		
	}
	
	//功能
	public function autos(){
		$this->display();
	}
	
	public function addfc(){
		$token_open=M('Token_open');
		$open['uid']=session('uid');
		$open['token']=$_POST['token'];
		$gid=session('gid');
		if (C('agent_version')&&$this->agentid){
			$fun=M('Agent_function')->field('funname,gid,isserve')->where('`gid` <= '.$gid.' AND agentid='.$this->agentid)->select();
		}else {
			$fun=M('Function')->field('funname,gid,isserve')->where('`gid` <= '.$gid)->select();
		}
		foreach($fun as $key=>$vo){
			$queryname.=$vo['funname'].',';
		}
		$open['queryname']=rtrim($queryname,',');
		$token_open->data($open)->add();
	}
	
	public function usersave(){
		$pwd=$this->_post('password');
		if($pwd!=false){
			$data['password']=md5($pwd);
			$data['id']=$_SESSION['uid'];
			if(M('Users')->save($data)){
				$this->success('密码修改成功！',U('Index/index'));
			}else{
				$this->error('密码修改失败！',U('Index/index'));
			}
		}else{
			$this->error('密码不能为空!',U('Index/useredit'));
		}
	}
	//处理关键词
	public function handleKeywords(){
		$Model = new Model();
		//检查system表是否存在
		$keyword_db=M('Keyword');
		$count = $keyword_db->where('pid>0')->count();
		//
		$i=intval($_GET['i']);
		//
		if ($i<$count){
			$img_db=M($data['module']);
			$back=$img_db->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($like)->select();
			//
			$rt=$Model->query("CREATE TABLE IF NOT EXISTS `tp_system_info` (`lastsqlupdate` INT( 10 ) NOT NULL ,`version` VARCHAR( 10 ) NOT NULL) ENGINE = MYISAM CHARACTER SET utf8");
			$this->success('关键词处理中:'.$row['des'],'?g=User&m=Create&a=index');
		}else {
			exit('更新完成，请测试关键词回复');
		}
	}
	public function bindHelp(){
		$where['id']=$this->_get('id','intval');
		$where['uid']=session('uid');
		$thisWxUser=M('Wxuser')->where($where)->find();
		$this->assign('wxuser',$thisWxUser);
		$this->display();
	}
	public function bindTip(){
		if (class_exists('demoImport')){
			$this->assign('demo',1);
			//
			$token=$this->get_token();
			$pigSecret=$this->get_token(20,0,1);
			$wxinfo=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
			if (!$wxinfo){
				$demoImport=new demoImport(session('uid'),$token,$pigSecret);
			}
			$wxinfo=M('wxuser')->where(array('uid'=>intval(session('uid'))))->find();
			$this->assign('wxinfo',$wxinfo);
			//
			$this->assign('token',$token);
		}
		$this->display();
	}
	public function editsms(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$this->assign('info',$res);
		$this->display();
	}
	
	public function editemail(){
		$id=$this->_get('id','intval');
		$where['uid']=session('uid');
		$res=M('Wxuser')->where($where)->find($id);
		$this->assign('info',$res);
		$this->display();
	}
	public function autobind_add(){
		$tokenvalue=$this->get_token();
		$this->assign('tokenvalue',$tokenvalue);
		$this->display();
	}
	public function insertAuto()
 	{
 		$data=M('User_group')->field('wechat_card_num')->where(array('id'=>session('gid')))->find();
		$users=M('Users')->field('wechat_card_num')->where(array('id'=>session('uid')))->find();
		if($users['wechat_card_num']<$data['wechat_card_num']){
			
		}else{
			$this->error('您的VIP等级所能创建的公众号数量已经到达上线，请购买后再创建',U('User/Index/index'));exit();
		}
    	$tokenvalue=$this->_post('token');
    	$weixin = $this->_post('weixin');
    	$wxpwd = md5( substr($this->_post('wxpwd'), 0, 16));
    	$imgcode = '';
    	//验证本平台是否已经绑定过
			if ($this->isAgent){
				$_POST['agentid']=$this->thisAgent['id'];
			}
    	$cnt = M('Wxuser')->where(array('wxun'=>$weixin, 'bindok'=> '1'))->count();
    	if($cnt > 0) {
				$this->error('微信号已经存在,不能重复绑定,请填写新的账号',"/index.php?g=User&m=Index&a=autobind_add");
   
    	}else {
    		$bindurl = 'http://'.$_SERVER['SERVER_NAME'].'/index.php/api/'.$tokenvalue;
    		$url = 'http://weifuapi.sinaapp.com/api.php?type=bangding&url='.$bindurl.'&token='.$tokenvalue.'&uname='.$weixin.'&password='.$wxpwd; 
				$rest = file_get_contents($url); 
				if($rest != '0') {
					die('绑定失败,请确认用户名密码输入正确');
				}
				
    		$url = 'http://weifuapi.sinaapp.com/api.php?type=getinfo&uname='.$weixin.'&password='.$wxpwd; 
    		//die($url);
				$getWxInfo = file_get_contents($url); 			
				$getWxInfo = json_decode($getWxInfo,true);
				$data['wxname'] = $getWxInfo['user_info']['nick_name'];
				$data['wxid'] = $getWxInfo['user_info']['user_name'];
				//die($data['wxname'].$data['wxid']);
				$data['headerpic'] = "/tpl/static/images/wxpicdefault.jpg";
					
				$data['weixin']	= $getWxInfo['user_info']['user_name'];
				$data['qq']	= $weixin;
				$data['token']	= $tokenvalue;
				$data['uid']	= session('uid');
					
				$data['tpltypeid'] = $data['tpllistid'] = '1';
				$data['tplcontentid'] = '2';
				$data['typeid'] = '1';
				$data['typename'] = '生活';
				
				$data['tpltypename'] = '101_index';
				$data['tpllistname'] = 'list_list1';
				$data['tplcontentname'] = 'content_2';
				$data['createtime'] = $data['updatetime'] = time();
				$appid = $getWxInfo['advanced_info']['dev_info']['app_id'];
				$appsecret = $getWxInfo['advanced_info']['dev_info']['app_key'];
				$data['binok'] = 1;
    		$data['wxun'] = $weixin;
    		$data['wxpwd'] = $wxpwd;
				//$wxu = M('Wxuser')->where(array('uid'=>session('uid')))->find();
				
				//if( $wxu ) {
					
				//	$data['id'] = $wxu['id'];
					
				//	M('Wxuser')->save($data);
				//	M('Diymen_set')->where(array('token'=>$tokenvalue))->save(array('appid'=>$appid,'appsecret'=>$appsecret));
    		//}else {
    			
    			M('Diymen_set')->add(array('appid'=>$appid,'token'=>$tokenvalue,'appsecret'=>$appsecret));
    			$db=D('Wxuser');
					$id=$db->data($data)->add();
					
					if($id){
						if ($this->isAgent){
							$wxuserCount=M('Wxuser')->where(array('agentid'=>$this->thisAgent['id']))->count();
							M('Agent')->where(array('id'=>$this->thisAgent['id']))->save(array('wxusercount'=>$wxuserCount));
							if ($this->thisAgent['wxacountprice']){
								M('Agent')->where(array('id'=>$this->thisAgent['id']))->setDec('moneybalance',$this->thisAgent['wxacountprice']);
								M('Agent_expenserecords')->add(array('agentid'=>$this->thisAgent['id'],'amount'=>(0-$this->thisAgent['wxacountprice']),'des'=>$this->user['username'].'(uid:'.$this->user['id'].')添加公众号'.$_POST['wxname'],'status'=>1,'time'=>time()));
							}
						}
					}
					
				//}
				$this->addfc();
    		$this->success('平台账户信息绑定成功',"/index.php?g=User&m=Index&a=index");
    	}
    	
    }
}
?>