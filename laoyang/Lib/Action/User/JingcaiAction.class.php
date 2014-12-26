<?php
//----web----//

class JingcaiAction extends UserAction{
	public function index(){

        $data = D('JingcaiSet');
        $where = array('token' => session('token'));
       
        $es_data = $data->where($where)->find();
        
        if (IS_POST) {
        	
        	if($data->create() === false){
        		
        		 $this->error($data->getError());
        		 die;
        	}
        	
            if ($es_data == null) {
                if ($id = $data->add($_POST)) {
                    $data1['pid'] = $id;
                    $data1['module'] = 'Jingcai';
                    $data1['token'] = session('token');
                    $data1['keyword'] = trim($_POST['keyword']);
                    M('Keyword')->add($data1);
                    $this->success('添加成功', U('Jingcai/index', array('token' => session('token'))));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($data->where($wh)->save($_POST)) {
                    $data1['pid'] = (int) $this->_post('id');
                    $data1['module'] = 'Jingcai';
                    $data1['token'] = session('token');
                    $da['keyword'] = trim($this->_post('keyword'));
                    M('Keyword')->where($data1)->save($da);
                   $this->success('修改成功', U('Jingcai/index', array('token' => session('token'))));
                } else {
                    $this->error('操作失败');
                }
            }
        } else {
            $this->assign('es_data', $es_data);
           
            $this->display();
        }
    }
	
	public function type(){


        $where = array('token' => session('token'));


        $data = D('JingcaiSet');
        $set_data = $data->where($where)->find();
        
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }

        $this->assign('pid', $set_data['id']);
        $estate_son = M('Jingcai_type');


        $where = array('token' => session('token'));
        
        
        $count=$estate_son->where($where)->count();
        $page=new Page($count,20);
        $son_data = $estate_son->where($where)->order('sort desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$page->show());

        $this->assign('son_data', $son_data);


        $this->display();


    }
    public function type_add(){
        $id = (int) $this->_get('id');


        $where = array('token' => session('token'));



        $data = D('JingcaiSet');
        $set_data = $data->where($where)->find();
        
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }
        
        $t_son = M('Jingcai_type');
        
        
        $this->assign('pid', $set_data['id']);
        


        $token = session('token');


        $where = array('id' => $id, 'token' => $token);


        $check = $t_son->where($where)->find();


        if ($check != null) {


            $this->assign('son', $check);


        }


        if (IS_POST) {


            if ($check == null) {


                $_POST['token'] = session('token');


                if ($t_son->add($_POST)) {


                    $this->success('添加成功', U('Jingcai/type', array('token' => session('token'))));


                    die;


                } else {


                    $this->error('服务器繁忙,请稍候再试');


                }


            } else {


                $wh = array('token' => session('token'), 'id' => $this->_post('id'));


                if ($t_son->where($wh)->save($_POST)) {


                    $this->success('修改成功', U('Jingcai/type', array('token' => session('token'))));


                } else {


                    $this->error('操作失败');


                }


            }


        }


        $this->display();


    }


    public function type_del(){

        $t_son = M('Jingcai_type');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $check = $t_son->where($where)->find();

        if ($check == null) {

            $this->error('操作失败');

        } else {


            $isok = $t_son->where($where)->delete();


            if ($isok) {


                $this->success('删除成功', U('Jingcai/type', array('token' => session('token'))));


            } else {


                $this->error('删除失败', U('Jingcai/type', array('token' => session('token'))));

            }

        }

    }
    
    /**
     * 赛事会员
     */
    public function team(){
        $where = array('token' => session('token'));
        $data = D('JingcaiSet');
        $set_data = $data->where($where)->find();
        
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }

        $this->assign('pid', $set_data['id']);
        
        
        $type_id = $this->_get('id');
        
        
       $type_info = M('jingcai_type')->where(array('token'=>session('token'),'id'=>$type_id))->find();
        if(!$type_info){
        	$this->error('非法的赛事组织信息',U('User/Jingcai/type'));
        }
        
         $this->assign('type_name', $type_info['title']);
         
        $estate_son = M('Jingcai_team');
        $where['type_id'] = $type_id;
        
        $count=$estate_son->where($where)->count();
		$page=new Page($count,25);
        $son_data = $estate_son->where($where)->order('sort desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$page->show());
        $this->assign('son_data', $son_data);

        $this->display();


    }
    public function team_add(){
    	//这个id是指 赛事组织配置id
        $type_id = (int) $this->_get('type_id');
        $id = (int) $this->_get('id');
        $where = array('token' => session('token'));
        $data = D('JingcaiSet');
        
        /**
         * 回复配置检查
         */
        $set_data = $data->where($where)->find();
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }
       
        
        $this->assign('pid', $set_data['id']);
        
        
        $token = session('token');
        $where = array('id' => $type_id, 'token' => $token);
        /**
         * 赛事组织检查
         */
        $t_son = M('Jingcai_type');
        $check = $t_son->where($where)->find();
        
        if (!$check) {
            $this->error('非法的数据，请重新选择进入',U('User/Jingcai/type'));
        }
        $this->assign('type_id', $check['id']);
        $this->assign('type_name', $check['title']);
        /**
         * 查找对应
         */
        $team_db = M('Jingcai_team');
        $team_info = $team_db->where(array('id'=>$id,'token' => $token))->find();
        if($team_info){
        	
        	 $this->assign('team', $team_info);
        }
        if (IS_POST) {
            if ($team_info == null) {
                $_POST['token'] = session('token');
                if ($team_db->add($_POST)) {
                    $this->success('添加成功', U('Jingcai/team', array('token' => session('token'),'id'=> $_POST['type_id'])));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                    die;
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($team_db->where($wh)->save($_POST)) {
                    $this->success('修改成功', U('Jingcai/team', array('token' => session('token'),'id'=> $_POST['type_id'])));
                    die;
                } else {
                    $this->error('操作失败');
                    die;
                }
            }
        }
        $this->display();
    }
	
	 public function team_del(){

        $t_son = M('Jingcai_team');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $check = $t_son->where($where)->find();

        if ($check == null) {

            $this->error('操作失败');

        } else {
            $isok = $t_son->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jingcai/team', array('token' => session('token'),'id'=>$this->_get('type_id'))));
            } else {
                $this->error('删除失败', U('Jingcai/team', array('token' => session('token'),'id'=>$this->_get('type_id'))));

            }
        }

    }
    
    
	 public function changci(){
        $where = array('token' => session('token'));
        $data = D('JingcaiSet');
        $set_data = $data->where($where)->find();
        
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }

        $this->assign('pid', $set_data['id']);
        
        
        $type_id = $this->_get('id');
        
        
       $type_info = M('jingcai_type')->where(array('token'=>session('token'),'id'=>$type_id))->find();
        if(!$type_info){
        	$this->error('非法的赛事组织信息',U('User/Jingcai/type'));
        }
        
         $this->assign('type_name', $type_info['title']);
         
        
        $team_list = M('Jingcai_team')->where(array( 'token' => session('token'),'type_id'=>$type_id,'status'=>1))->order('sort desc')->select();
        
        foreach ( $team_list as $value ) {
            $teams[$value['id']] = $value['name'];
        }
         $this->assign('teams', $teams);
         
        $estate_son = M('Jingcai_changci');
        $where['type_id'] = $type_id;
        
        $count=$estate_son->where($where)->count();
		$page=new Page($count,25);
        $son_data = $estate_son->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('page',$page->show());
        $this->assign('son_data', $son_data);
        $this->assign('nowtime', time());
        $this->display();
    }
    
    public function changci_add(){
    	//这个id是指 赛事组织配置id
        $type_id = (int) $this->_get('type_id');
        $id = (int) $this->_get('id');
        $where = array('token' => session('token'));
        $data = D('JingcaiSet');
                
        /**
         * 回复配置检查
         */
        $set_data = $data->where($where)->find();
        if(!$set_data){
        	$this->error('还未设置回复配置',U('User/Jingcai/index'));
        }
        
        
        $this->assign('pid', $set_data['id']);
        
        
        $token = session('token');
        $where = array('id' => $type_id, 'token' => $token);
        /**
         * 赛事组织检查
         */
        $t_son = M('Jingcai_type');
        $check = $t_son->where($where)->find();
        
        if (!$check) {
            $this->error('非法的数据，请重新选择进入',U('User/Jingcai/type'));
        }
        
        
        /**
         * 查找对应的  成员
         */
        $team_list = M('Jingcai_team')->where(array( 'token' => $token,'type_id'=>$check['id'],'status'=>1))->order('sort desc')->select();
         
        if(count($team_list) <= 1){
        	 $this->error('参赛成员不足两个，请先录入赛事成员！',U('User/Jingcai/team',array('id'=>$check['id'])));
        	 die;
        }
        $this->assign('teams', $team_list);
        $this->assign('type_id', $check['id']);
        $this->assign('type_name', $check['title']);
        /**
         * 查找对应
         */
        $team_db = D('JingcaiChangci');
        $team_info = $team_db->where(array('id'=>$id,'token' => $token))->find();
        if($team_info){
        	
        	 $this->assign('changci', $team_info);
        }
        if (IS_POST) {
        	 $_POST['stime'] = strtotime($_POST['stime']);
        	 
        	 if($team_db->create() === false){
        		
        		 $this->error($team_db->getError());
        		 die;
        	}
        	
            if ($team_info == null) {
                $_POST['token'] = session('token');
                if ($team_db->add($_POST)) {
                    $this->success('添加成功', U('Jingcai/changci', array('token' => session('token'),'id'=> $_POST['type_id'])));
                    die;
                } else {
                    $this->error('服务器繁忙,请稍候再试');
                    die;
                }
            } else {
                $wh = array('token' => session('token'), 'id' => $this->_post('id'));
                if ($team_db->where($wh)->save($_POST)) {
                    $this->success('修改成功', U('Jingcai/changci', array('token' => session('token'),'id'=> $_POST['type_id'])));
                    die;
                } else {
                    $this->error('操作失败');
                    die;
                }
            }
        }
       
        $this->display();
    }
    
    
     public function changci_del(){

        $t_son = M('Jingcai_changci');
        $id = (int) $this->_get('id');
        $token = $this->_get('token');
        $where = array('id' => $id, 'token' => $token);
        $check = $t_son->where($where)->find();

        if ($check == null) {

            $this->error('操作失败');

        } else {
            $isok = $t_son->where($where)->delete();
            if ($isok) {
                $this->success('删除成功', U('Jingcai/changci', array('token' => session('token'),'id'=>$this->_get('type_id'))));
            } else {
                $this->error('删除失败', U('Jingcai/changci', array('token' => session('token'),'id'=>$this->_get('type_id'))));

            }
        }

    }
    
    
     public function result(){
    	//这个id是指 赛事组织配置id
       
        $id = (int) $this->_get('id');
        
        $token = session('token');
        
        $where = " a.token='".$token."' and a.id=".$id." and a.zhudui=b.id and a.kedui=c.id";
        
        $changci_db = new Model();
        
        $changci = $changci_db->table(C('DB_PREFIX')."jingcai_changci a,".C('DB_PREFIX')."jingcai_team b,".C('DB_PREFIX')."jingcai_team c")->field("a.*,b.name zhuduiname,c.name keduiname")->where($where)->find();
        
        $this->assign('info',$changci);
        	
        if (IS_POST) {
        	
        	$zhuduinum = $this->_post('zhuduinum');
        	$keduinum = $this->_post('keduinum');
        	
        
        	
        	/**
        	 * 给成功竞猜的人增加积分
        	 */
        	 
        	 if($zhuduinum > $keduinum){
        	 	$type = 3;
        	 }elseif($zhuduinum == $keduinum){
        	 	$type = 1;
        	 }else{
        	 	$type=2;
        	 }
        	
             $Model = new Model(); 
        
             $score_dtl_sql ="insert into `".C('DB_PREFIX')."member_card_sign`(`sign_time`,`is_sign`,`score_type`,`token`,`wecha_id`,`expense`,`score_name`)".
    	            " select '".time()."',".
                    "       1,36,token,wecha_id,sjm,'2333'".
    	            " from `".C('DB_PREFIX')."jingcai_changci_record`  where `token`='".$this->token."' and `changci_id`=".$id." and `ycjg`=".$type." ";
    	 
    	 
             $Model->execute($score_dtl_sql);
                 
             $userinfo_sql = "update `".C('DB_PREFIX')."userinfo` a  set a.total_score=(select sjm+a.total_score from `".C('DB_PREFIX')."jingcai_changci_record` c where c.token='".$this->token."' and c.changci_id=".$id." and c.ycjg=".$type." and a.wecha_id=c.wecha_id )".
                                 " where `token`='".$this->token."' and exists (select 1 from `".C('DB_PREFIX')."jingcai_changci_record` b where b.token='".$this->token."' and b.changci_id=".$id." and b.ycjg=".$type." and a.wecha_id=b.wecha_id  )";
                 
             $Model->execute($userinfo_sql);
                 
        	
            M('jingcai_changci')->where(array('token'=>$token,'id'=>$id))->save(array('zhuduinum'=>$zhuduinum,'keduinum'=>$keduinum,'status'=>1));
        		
        		
        	$this->success('该赛事已成功结束', U('Jingcai/changci', array('token' => session('token'),'id'=>$changci['type_id'])));
        	die;
        }
        $this->display();
    }
    
    
    /**
     * 用户统计结果
     */
    public function statistics(){
    	//这个id是指 赛事组织配置id
        $type_id = (int) $this->_get('type_id');
        $id = (int) $this->_get('id');
      
       
        $where = " a.token='".session('token')."' and a.id=".$id." and a.zhudui=b.id and a.kedui=c.id";
        
        $changci_db = new Model();
         $info = $changci_db->table(C('DB_PREFIX')."jingcai_changci a ,".C('DB_PREFIX')."jingcai_team b,".C('DB_PREFIX')."jingcai_team c")->field('a.*,b.name zhuduiname,c.name keduiname')->where($where)->find();
       
        
                           
      
        $sql_cur_total = "select sum(case when ycjg=3 then 1 else 0 end) zhuduinums,sum(case when ycjg=1 then 1 else 0 end) pingnums,sum(case when ycjg=2 then 1 else 0 end) funums ";
        
        $sql_cur_total .=" from ".C('DB_PREFIX')."jingcai_changci_record";
        
        $sql_cur_total .=" where token ='".session('token')."' and changci_id=".$id;
        
        
         
        $result = $changci_db->query($sql_cur_total);
        
        
        if($result[0]){
        	
        	$this->assign('maxvalue', max($result[0]));
        	
        }else{
        	$this->assign('maxvalue', 5);
        }
      
        
        $this->assign('result', $result[0]);
		
     
    
        $this->assign('info', $info);
       
         
        $this->display();
    
    	
    }
}

?>