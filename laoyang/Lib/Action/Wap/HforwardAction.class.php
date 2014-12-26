<?php


class HforwardAction extends BaseAction{
	public function index(){
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"icroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token		= $this->_get('token');
		$wecha_id	= $this->_get('wecha_id');
        $id         = $this->_get('id');
        $this->assign('token',$token);
        $this->assign('wecha_id',$wecha_id);
        $this->assign('id',$id);
		$t_forward= M('Hforward');
        $t_item = M('Hfor_item');
		$hforward 	= $t_forward->where(array('token'=>$token,'id'=>$id))->find();
        if(empty($hforward)){
            exit('非法操作');
        }
        $count=$t_item->where(array('fid'=>$id))->count();
		$static=$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->find();
		if($static){
			$state=1;
		}else $state=0;
		
		if($state){
			
		$f_item=$t_item->where('fid='.$id)->order('tongji desc')->select();
			
		foreach($f_item as $k=>$value){
			
			if($f_item[$k]['wecha_id']==$wecha_id){
				
				$vpm=$k+1;
			}
		}	
			
		}
		$wxref=$this->_get('wxref');
		if($wxref && $wecha_id){
			    $zs=1;
			    $ip=get_client_ip();

				$items=$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->find();
								
				if($items['ip']==''){
					$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->setField('ip',$ip);
					$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->setInc('tongji',1);
				}else{
					
					$ips = explode(",", $items['ip']);

					if(!in_array($ip,$ips)){
						$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->setField('ip',$items['ip'].','.$ip);
						$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->setInc('tongji',1);
					}
				}
				
			
			}
		

		$f_item=$t_item->where('fid='.$id)->order('tongji desc')->select();       
		$hforward['gz']=html_entity_decode($hforward['gz']);
		$hforward['lj']=html_entity_decode($hforward['lj']);
        $hforward['info']=html_entity_decode($hforward['info']);
        $this->assign('f_item', $f_item);
		$this->assign('state', $state);
		$this->assign('vpm', $vpm);
		$this->assign('zs', $zs);
        $this->assign('hforward',$hforward);
		$this->assign('count',$count);
		$this->display();
	}
	public function save(){
		
		if(IS_POST){
				
		$token		= $this->_post('token');
		$wecha_id	= $this->_post('wecha_id');
        $id         = $this->_post('id');
		$name         = $this->_post('name');
		$phone         = $this->_post('phone');
        $this->assign('token',$token);
        $this->assign('wecha_id',$wecha_id);
        $this->assign('id',$id);
		$t_forward= M('Hforward');
        $t_item = M('Hfor_item');
		$hforward 	= $t_forward->where(array('token'=>$token,'id'=>$id))->find();
		$static=$t_item->where(array('wecha_id'=>$wecha_id,'fid'=>$id))->find();
		if($static){
		
			$this->error('你已经报转发了',U('Hforward/index',array('id'=>$id,'token'=>$token,'wecha_id'=>$wecha_id)));
			exit;
		
		}
		
		if(empty($hforward)){
            exit('非法操作');
        }
		$data['token']=$token;
		$data['wecha_id']=$wecha_id;
		$data['fid']=$id;
		$data['createtime']=time();
		$data['name']=$name;
		$data['phone']=$phone;
		$res=$t_item->add($data);
		if($res){
			
			 $this->success('报名成功',U('Hforward/index',array('id'=>$id,'token'=>$token,'wecha_id'=>$wecha_id)));
			
		}else {
			
			$this->error('参与失败',U('Hforward/index',array('id'=>$id,'token'=>$token,'wecha_id'=>$wecha_id)));
			
			}
			
			
			}
		
		
		
		
		}
	
    

  
	
}?>