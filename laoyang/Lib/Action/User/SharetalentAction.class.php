<?php
class SharetalentAction extends UserAction{
	
	public function _initialize() {

		parent::_initialize();

		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();

		if(!strpos($token_open['queryname'],'Sharetalen')){

            	//$this->error('您还开启该模块的使用权,请到功能模块中添加',U('Sharetalen/index',array('token'=>session('token'),'id'=>session('wxid'))));

		}
	}
    public function index(){
        
		$info = M('sharetalent')->where(array('token'=>session('token')))->select();
		$this->assign('info',$info);
		
        $this->display();
		
	}
	
	public function add(){
		 if(IS_POST){
           
            $data['token']=session('token');
            $data['statdate']=strtotime($this->_post('statdate'));
           
            $data['info'] = $this->_post("info");
            $data['picurl'] = $this->_post("picurl");
            $data['title'] = $this->_post("title");
            
			$data['prize'] = $this->_post('prize');
			$data['number'] = $this->_post('number');
			$data['rule'] = $this->_post('rule');
			$data['hdrules'] = $this->_post('hdrules');
			$data['picurl1'] = $this->_post('picurl1');
			$data['url'] = $this->_post('url');
			$data['date']= date("Y-m-d",time());
			$insert = M('sharetalent')->add($data);
			if($insert){
				$this->success('添加成功',U('Sharetalent/index',array('token'=>session('token'))));
			}else{
                $this->error('服务器繁忙,请稍候再试');
			}
		}else{
			$this->display();
		} 
    }
	/**修改活动**/
	public function edit(){
		
		  $id= $_GET['id'];
		   
		$info = M('sharetalent')->where(array('token'=>session('token'),'id'=>$id))->find();
	//	dump($info);exit;
		$this->assign('info',$info);
		  if(IS_POST){
           
            $data['token']=session('token');
            $data['statdate']=strtotime($this->_post('statdate'));
           
            $data['info'] = $this->_post("info");
            $data['picurl'] = $this->_post("picurl");
            $data['title'] = $this->_post("title");
            
			$data['prize'] = $this->_post('prize');
			$data['number'] = $this->_post('number');
			$data['rule'] = $this->_post('rule');
			$data['hdrules'] = $this->_post('hdrules');
			$data['picurl1'] = $this->_post('picurl1');
			$data['url'] = $this->_post('url');
			
			$record['title']=$this->_post("title");
			$record['number']=$this->_post("number");
			$record['picurl']=$this->_post("picurl");
			$record['rule']=$this->_post("rule");
		
			$insert = M('sharetalent')->where(array('id'=>$id))->save($data);
			$inserts= M('sharetalent_record')->where(array('pid'=>$id))->save($record);
			if($insert){
				$this->success('添加成功',U('Sharetalent/index',array('token'=>session('token'))));
			}else{
                $this->error('服务器繁忙,请稍候再试');
			}
		}else{
			$this->display();
		} 
   	}
 public function reply(){
	 	$where['token'] = session('token');
		$Cdata = M('sharetalent_reply');
		$info = $Cdata->where($where)->find();
		$this->info = $info;
		if(IS_POST){
			$where['token'] = session('token');
			$data['copyright'] = strip_tags($_POST['copyright']);
			$data['title'] = strip_tags($_POST['title']);
			$data['tp'] = strip_tags($_POST['tp']);
			
			$data['info'] = strip_tags($_POST['info']);
			
			//$res = M('Vcard')->where($where)->find();
			if($info){
				$result = M('sharetalent_reply')->where($where)->save($data);
				if($result){
					$this->success('回复信息更新成功!');
				}else{
					$this->error('服务器繁忙 更新失败!');
				}
			}else{
				$data['token'] = session('token');
				$insert = M('sharetalent_reply')->add($data);
				if($insert > 0){
					$this->success('回复信息添加成功!');
				}else{
					$this->error('回复信息添加失败!');
				}
			}
		}else{
			$this->display();
		}
	}
   /**删除活动**/
    public function del(){
		 $id= $_GET['id'];
		   
		$info = M('sharetalent')->where(array('token'=>session('token'),'id'=>$id))->delete();
		if($info){
           
                    $this->success('删除成功',U('Sharetalent/index',array('token'=>session('token'))));}
                    else{
                   $this->error('删除失败,请稍候再试');
                }
           
		
		
       
    } 
		public function sm(){
	
         $info=M('sharetalent_sm')->where(array('token'=>session('token')))->find();
		
		 if(IS_POST){
           
            $data['token']=session('token');
           
           
            $data['info'] = $this->_post("info");
			$data['infos'] = $this->_post('infos');
			if(empty($info)){
			      $insert = M('sharetalent_sm')->add($data);
			      if($insert){
               
                                 $this->success('添加成功',U('Sharetalent/index',array('token'=>session('token'))));}
                           else{
                                 $this->error('服务器繁忙,请稍候再试'); }}
			else{
				 $insert = M('sharetalent_sm')->where(array('token'=>session('token')))->save($data);	   
					   
					  if($insert){
               
                    $this->success('更新成功',U('Sharetalent/index',array('token'=>session('token'))));}
                    else{
                   $this->error('服务器繁忙,请稍候再试'); }  
					   
					   
					   
					   }}
					  $this->assign('info',$info); 
					 $this->display();  
					   
					   }
	
	/**用户列表**/ 
	public function user(){
		
		
		
		$token=session('token');
		
		
        $info = M('sharetalent_user')->where(array('token'=>session('token')))->select();
		
        $this->assign('info',$info);
		 $this->display();  
					   
	}
	//参与的活动
	public function userhd(){
		
		
		
		$token=session('token');
		$wecha_id=$this->_get('wecha_id');
		$name=  M('sharetalent_user')->where(array('token'=>session('token'),'wecha_id'=>$wecha_id))->find();
        $info = M('sharetalent_record')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->select();
		
        $this->assign('info',$info);
		 $this->assign('name',$name);
		 $this->display();  
					   
	}
	//奖品发放
	public function prize(){
		
		
		
		$token=session('token');
		$wecha_id=$this->_get('wecha_id');
		$pid=$this->_get('id');
		$condition['end'] = array('EGT',0);
		$condition['token'] = $token;
		$condition['pid'] = $pid;
        $info = M('sharetalent_record')->where($condition)->select();
		
        $this->assign('info',$info);
		
		 $this->display();  
					   
	}
	//兑奖
	public function sendprize(){
		
		
		
		$token=session('token');
		$wecha_id=$this->_get('wecha_id');
		$id=$this->_get('id');
		$pid=$this->_get('pid');
		
		
		$date['statu']=1;
        $info = M('sharetalent_record')->where(array('token'=>$token,'wecha_id'=>$wecha_id,'id'=>$id))->save($date);
		
		
		if($info){
			$wql = M('sharetalent_record')->where(array('token'=>$token,'pid'=>$pid,'statu'=>1))->count();
		    $nu = M('sharetalent')->where(array('token'=>$token,'id'=>$pid))->find();
		    $new['number']=$nu['number']-$wql;
           $newdate = M('sharetalent_record')->where(array('token'=>$token,'wecha_id'=>$wecha_id,'pid'=>$pid))->save($new);
		   $newdates = M('sharetalent')->where(array('token'=>$token,'id'=>$pid))->save($new);
		
                    $this->success('兑奖成功',U('Sharetalent/prize',array('token'=>$token,'wecha_id'=>$wecha_id,'id'=>$pid)));}
                    else{
                   $this->error('兑奖失败,请稍候再试',U('Sharetalent/prize',array('token'=>$token,'wecha_id'=>$wecha_id,'id'=>$pid)));
                }
       
					   
	}
	
	public function userdel(){
		
		
		
		$token=session('token');
		$wecha_id=$this->_get('wecha_id');
		$id=$this->_get('id');
		$condition['wecha_id'] = $wecha_id;
		$condition['token'] = $token;
		$condition['id'] = $id;
        $info = M('sharetalent_user')->where($condition)->delete();
		
       if($info){
         
                    $this->success('删除成功',U('Sharetalent/user',array('token'=>$token,'wecha_id'=>$wecha_id,'id'=>$pid)));}
                    else{
                   $this->error('删除失败,请稍候再试',U('Sharetalent/user',array('token'=>$token,'wecha_id'=>$wecha_id,'id'=>$pid)));
                }
		
		
					   
	}
	
	


}
?>