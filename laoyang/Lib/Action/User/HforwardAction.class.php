<?php
class HforwardAction extends UserAction{
	
	/**转发有礼首页**/
    public function index(){
        
		$this->canUseFunction('Hforward');
        $token=session('token');
		$t_hforward=M('Hforward');
		$list=$t_hforward->where(array('token'=>$token))->select();
		$this->assign('list',$list);
        $this->display();
		
	}
	/**添加活动**/
	public function add(){
     	$this->canUseFunction('Hforward');
		$token=session('token');
		 if(IS_POST){
            $data=D('Hforward');
            $_POST['token']=session('token');
            $_POST['statdate']=strtotime($this->_post('statdate'));
           
            $_POST['info'] = strip_tags($this->_post("info"));
            $_POST['picurl'] = $this->_post("picurl");
            $_POST['title'] = $this->_post("title");
            $_POST['keyword'] = $this->_post('keyword');
			$_POST['gz'] = $this->_post('gz');
			$_POST['lj'] = $this->_post('lj');
            
            if($data->create()!=false){
                if($id=$data->add()){
                    $data1['pid']=$id;
                    $data1['module']='Hforward';
                    $data1['token']=session('token');
                    $data1['keyword']=$_POST['keyword'];
                    M('keyword')->add($data1);
                    $this->success('添加成功',U('Hforward/index',array('token'=>session('token'))));
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
	/**修改活动**/
	public function edit(){
		    $this->canUseFunction('Hforward');
		    if(IS_POST){
            $data=D('Hforward');
            $_POST['id']= (int)$this->_post('id');
            $_POST['token']=session('token');
            $_POST['statdate']=strtotime($this->_post('statdate'));
            
            $_POST['display'] = $this->_post("display");
            $_POST['info'] = strip_tags($this->_post("info"));
            $_POST['picurl'] = $this->_post("picurl");
            $_POST['title'] = $this->_post("title");
			$_POST['gz'] = $this->_post('gz');
			$_POST['lj'] = $this->_post('lj');
            
            $where=array('id'=>$_POST['id'],'token'=>session('token'));
            $check=$data->where($where)->find();

            if($check==NULL) exit($this->error('非法操作'));
           
            if($data->create()){
                if($data->where($where)->save($_POST)){
                    $data1['pid']=$_POST['id'];
                    $data1['module']='Hforward';
                    $data1['token']=session('token');
                    $da['keyword']=trim($_POST['keyword']);
                    $ok = M('keyword')->where($data1)->save($da);
                    $this->success('修改成功!',U('Hforward/index',array('token'=>session('token'))));exit;
                }else{
                    //$this->error('没有做任何修改！');exit;
                    $this->success('修改成功',U('Hforward/index',array('token'=>session('token'))));exit;
                }
            }else{
                $this->error($data->getError());
            }
        }else {
		
		    $id=(int)$this->_get('id');
            $where=array('id'=>$id,'token'=>session('token'));
            $data=M('Hforward');
            $check=$data->where($where)->find();
            if($check==NULL)$this->error('非法操作');
            $vo=$data->where($where)->find();
            $this->assign('vo',$vo);
            $this->display('add');
		
		}
       
   	}
   /**删除活动**/
    public function del(){
		$this->canUseFunction('Hforward');
		$id = $this->_get('id');
        $hforward = M('Hforward');
        $find = array('id'=>$id);
        $result = $hforward->where($find)->find();
         if($result){
            $hforward->where('id='.$result['id'])->delete();
            M('Hfor_item')->where('fid='.$result['id'])->delete();
           // M('Hvote_record')->where('vid='.$result['id'])->delete();
            $where = array('pid'=>$result['id'],'module'=>'Hforward','token'=>session('token'));
            M('Keyword')->where($where)->delete();
            $this->success('删除成功',U('Hforward/index',array('token'=>session('token'))));
         }else{
            $this->error('非法操作！');
         }
		
       
    } 
	
	/**产看中奖名单**/ 
	public function item(){
		
		$this->canUseFunction('Hforward');
		$id = $this->_get('id');
		$token=session('token');
		$hforward = M('Hforward');
		$hf_item  = M('Hfor_item');
		$find = array('id'=>$id);
        $result = $hforward->where($find)->find();
        if($result){
			
			$list=$hf_item->where("fid=".$id)->select();
			$this->assign('list',$list);
			$this->assign('id',$id);
			$this->display();
			
			}else{
				
			 $this->error('非法操作！');
			
			}
		
	}
	
	/**删除转发记录**/
	public function add_item(){
	
		$this->canUseFunction('Hforward');
		$id = $this->_get('id');
		$token=session('token');
		$hforward = M('Hforward');
		$hf_item  = M('Hfor_item');
		$find = array('id'=>$id);
        $result = $hforward->where($find)->find();
		if($result){
			
			if(IS_POST){
				$data['name']=$this->_post('name');
				$data['phone']=$this->_post('phone');
				$data['tongji']=$this->_post('tongji');
				$data['ip']=$this->_post('ip');
				$data['createtime']=time();
				$data['fid']=$id;
				$res=$hf_item->add($data);
				if($res){
				$this->success('添加成功',U('Hforward/item',array('token'=>session('token'),'id'=>$id)));
				
				}else 
				$this->error('添加失败',U('Hforward/item',array('token'=>session('token'),'id'=>$id)));
			}else {
				
				$this->assign('id',$id);
				$this->display('');
			
			}
			
         }else{
            $this->error('非法操作！');
         }
		
	}
	public function delete_item(){
		$fid=$this->_get('fid');
		$id=$this->_get('id');
		$hf_item  = M('Hfor_item');
		$res=$hf_item->where('id='.$id)->delete();
		if($res){
				$this->success('删除成功',U('Hforward/item',array('token'=>session('token'),'id'=>$fid)));
				
				}else 
				$this->error('删除失败',U('Hforward/item',array('token'=>session('token'),'id'=>$fid)));
	}
	public function edite_item(){
		
		$fid=$this->_get('fid');
		$id=$this->_get('id');
		$hf_item  = M('Hfor_item');
		if(IS_POST){
		
			$data['id']=$this->_post('id');
			$data['name']=$this->_post('name');
			$data['phone']=$this->_post('phone');
				$data['tongji']=$this->_post('tongji');
				$data['ip']=$this->_post('ip');
				$data['createtime']=time();
				$data['fid']=$this->_post('fid');
				$res=$hf_item->where('id='.$data['id'])->save($data);
				if($res){
				$this->success('修改成功',U('Hforward/item',array('token'=>session('token'),'id'=>$fid)));
				
				}else 
				$this->error('修改失败',U('Hforward/item',array('token'=>session('token'),'id'=>$fid)));
		
		}else{
			$item=$hf_item->where('id='.$id)->find();
			//dump($item);
			$this->assign('item',$item);
			$this->assign('id',$id);
			$this->assign('fid',$fid);
			$this->display();
		
		}

    }


}
?>