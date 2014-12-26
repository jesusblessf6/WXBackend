<?php
class EstateAction extends UserAction{
    public function _initialize() {
        parent::_initialize();
		//
		$this->canUseFunction('estate');
    }
	public function index(){
        $data = M('Estate');
         $where['token'] = session('token');
        $where['thetype'] = 'estate';
        $es_data = $data->where($where)->find();
        $panorama = M('Panorama')->where($where)->field('id as pid,name,keyword')->select();
        $this->assign('panorama',$panorama);
        $classify = M('Classify')->where($where)->field('id as cid,name')->select();
        $this->assign('classify',$classify);
        $reslist = M('Reservation')->where($where)->field('id as rid ,title')->select();
        $this->assign('reslist',$reslist);
        if(IS_POST){

            if(!D('Estate')->create()){
                $this->error('表单提交错误！,请检查是否有项为空！');exit();
            }

           if($es_data == null){

                    if($id=$data->add($_POST)){
                        $data1['pid']=$id;
                        $data1['module']='Estate';
                        $data1['token']=session('token');
                        $data1['keyword']=trim($_POST['keyword']);
                        M('Keyword')->add($data1);
                        //$user=M('Users')->where(array('id'=>session('uid')))->setInc('activitynum');
                        $this->success('添加成功',U('Estate/index',array('token'=>session('token'))));
                         exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }

           }else{
            $wh = array('token'=>session('token'),'id'=>$this->_post('id'));

             if($data->where($wh)->save($_POST)){
                    $data1['pid']=(int)$this->_post('id');
                    $data1['module']='Estate';
                    $data1['token']=session('token');
                    $da['keyword']=trim($this->_post('keyword'));
                    M('Keyword')->where($data1)->save($da);

                    $this->success('修改成功',U('Estate/index',array('token'=>session('token'))));exit;
                }else{
                    $this->error('操作失败');exit;
                }
           }
        }else{
          $this->assign('es_data',$es_data);
           $this->display();
        }



	}

    public function son(){

        $where = array('token'=>session('token'),'thetype' => 'estate');
        $this->assign('pid',M("Estate")->where($where)->getField('id'));

        $estate_son = M('Estate_son');
       $where = array('token'=>session('token'),'thetype' => 'estate');
        $son_data = $estate_son->where($where)->order('sort desc')->select();
        $this->assign('son_data',$son_data);
        $this->display();
    }

    public function son_add(){
        $t_son = M('Estate_son');
        $id = (int)$this->_get("id");
       $where = array('token'=>session('token'),'thetype' => 'estate');
        $this->assign('pid',M("Estate")->where($where)->getField('id'));
        $token = $this->_get('token');
        $where =  array('id'=>$id,'token'=>$token);
        $check = $t_son->where($where)->find();
        if($check != null){
             $this->assign('son',$check);
        }
        if(IS_POST){
            if(!D('Estate_son')->create()){
                $this->error('表单提交错误！,请检查是否有项为空！');exit();
            }
            if($check == null){
                    $_POST['token']= session('token');
                    if($t_son->add($_POST)){
                        $this->success('添加成功',U('Estate/son',array('token'=>session('token'))));
                         exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }
           }else{
             $wh = array('token'=>session('token'),'id'=>$this->_post('id'));
             if($t_son->where($wh)->save($_POST)){
                    $this->success('修改成功',U('Estate/son',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');
                    exit;
                }
           }
        }

        $this->display();

    }

    public function son_del(){
        $t_son = M('Estate_son');
        $id = (int)$this->_get('id');
        $token = $this->_get('token');
        $where = array('id'=>$id,'token'=>$token);
        $check = $t_son->where($where)->find();
        if($check == null){
            $this->error('操作失败');
        }else{
            $isok = $t_son->where($where)->delete();
            if($isok){
               $this->success('删除成功',U('Estate/son',array('token'=>session('token'))));exit;
           }else{
                $this->error('删除失败',U('Estate/son',array('token'=>session('token'))));exit();
           }
        }

    }


    public function housetype(){

        $t_housetype = M('Estate_housetype');
        $where = array('token'=>session('token'),'thetype' => 'estate');
        $housetype = $t_housetype->where($where)->order('sort desc')->select();

        foreach ($housetype as $k => $v) {
            $son_type[] = M("Estate_son")->where(array('id'=>$v['son_id']))->field('id as sid,title')->find();
        }


        foreach ($son_type as $key => $value) {
             foreach ($value as $k => $v) {
                  $housetype[$key][$k] = $v;
             }

        }

        $this->assign('housetype',$housetype);
        $this->display();
    }

    public function panorama(){
		$id = (int)$this->_get("id");
        $t_panorama = M('Estate_panorama');
        $token = $this->_get('token');
		$where =  array('type'=>$id,'token'=>$token);
        $panorama = $t_panorama->where($where)->order('sort desc')->select();

        foreach ($panorama as $k => $v) {
            $son_type[] = M("Estate_son")->where(array('id'=>$v['son_id']))->field('id as sid,title')->find();
        }


        foreach ($son_type as $key => $value) {
             foreach ($value as $k => $v) {
                  $housetype[$key][$k] = $v;
             }

        }

        $this->assign('panorama',$panorama);
        $this->display();
    }
	
    public function housetype_add(){
        $t_housetype = M('Estate_housetype');
		$t_housetype_360 = M('Estate_housetype_360');
		$t_redirect = M('Estate_room_redirect');
        $id = $this->_get("id");
        $token = $this->_get('token');
        $where =  array('id'=>$id,'token'=>$token);
        $check = $t_housetype->where($where)->find();
        $where1 =  array('housetype_id'=>$id,'token'=>$token);
        $items = $t_housetype_360->where($where1)->select();
        $where2 =  array('housetype_id'=>$id,'token'=>$token);
        $redirects = $t_redirect->where($where2)->select();
        $son_data = M("Estate_son")->where(array('token'=>session('token')))->field('id as sid,title')->select();
        $this->assign('son_data',$son_data);
        $panorama = M('Panorama')->where(array('token'=>session('token')))->field('id as pid,name,keyword')->select();
        $this->assign('panorama',$panorama);
        if($check != null){
             $this->assign('housetype',$check);
        }
        if($items != null){
             $this->assign('items',$items);
        }
		
        if($redirects != null){
             $this->assign('redirects',$redirects);
        }
        $po_data=M('Photo');        $list = $po_data->where(array('token'=>session('token')))->field('id,title')->select();        $this->assign('photo',$list);
        if(IS_POST){
            if(!D('Estate_housetype')->create()){
                $this->error('表单提交错误！,请检查是否有项为空！');exit();
            }
            if($check == null){
                    $_POST['token']= session('token');
                    if($lastInsId = $t_housetype->add($_POST)){														$res = array();							$arr=$_POST[add];							$keys =array_keys($arr);							foreach ($keys as $key => $k) {								foreach ($arr[$k] as $key1 => $v) {									 $res[$key1][$k] = $arr[$k][$key1];								}							}							foreach ($res as $key => $k)							{								$k['housetype_id']=$lastInsId;								$k['token']=session('token');								$t_housetype_360->add($k);							}														$res = array();							$arr=$_POST[room];							$keys =array_keys($arr);							foreach ($keys as $key => $k) {								foreach ($arr[$k] as $key1 => $v) {									 $res[$key1][$k] = $arr[$k][$key1];								}							}							foreach ($res as $key => $k)							{								$k['housetype_id']=$lastInsId;								$k['token']=session('token');								$t_redirect->add($k);							}
							$this->success('添加成功',U('Estate/housetype',array('token'=>session('token'))));
                         exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }
           }else{
             $wh = array('token'=>session('token'),'id'=>$this->_post('id'));			 			 $wh2 = array('token'=>session('token'),'housetype_id'=>$this->_post('id'));						$res = array();			$arr=$_POST[add];			$keys =array_keys($arr);			foreach ($keys as $key => $k) {				foreach ($arr[$k] as $key1 => $v) {					 $res[$key1][$k] = $arr[$k][$key1];				}			}						$flag=false;			foreach ($res as $key => $k)			{				if($k['id'])				{					if($k['flag']=='data')					{						$wh1 = array('token'=>session('token'),'id'=>$k['id']);						$t_housetype_360->where($wh1)->save($k);					}					else					{						$wh1 = array('token'=>session('token'),'id'=>$k['id']);						$t_housetype_360->where($wh1)->delete($k);					}					$flag=true;				}				else				{					if($k['flag']=='data')					{						 $k['housetype_id']=$id;						 $k['token']=session('token');						 $t_housetype_360->add($k);							$flag=true;					}				}			}						$res = array();			$arr=$_POST[room];			$keys =array_keys($arr);			foreach ($keys as $key => $k) {				foreach ($arr[$k] as $key1 => $v) {					 $res[$key1][$k] = $arr[$k][$key1];				}			}			if($res)			{				foreach ($res as $key => $k)				{					if($k['id'])					{						if($k['flag']=='data')						{							$wh1 = array('token'=>session('token'),'id'=>$k['id']);							$t_redirect->where($wh1)->save($k);						}						else						{							$wh1 = array('token'=>session('token'),'id'=>$k['id']);							$t_redirect->where($wh1)->delete($k);						}						$flag=true;					}					else					{						if($k['flag']=='data')						{							$k['housetype_id']=$id;							$k['token']=session('token');							$t_redirect->add($k);							$flag=true;						}										}				}			}
             if($t_housetype->where($wh)->save($_POST)||$flag){			 
                    $this->success('修改成功',U('Estate/housetype',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');exit;
                }
           }
        }
        $this->display();
    }

    public function housetype_del(){
       $housetype = M('Estate_housetype');
        $id = (int)$this->_get('id');
        $token = $this->_get('token');
        $where = array('id'=>$id,'token'=>$token);
        $check = $housetype->where($where)->find();
        if($check == null){
            $this->error('操作失败');
        }else{
            $isok = $housetype->where($where)->delete();
            if($isok){
               $this->success('删除成功',U('Estate/housetype',array('token'=>session('token'))));exit;
           }else{
                $this->error('删除失败',U('Estate/housetype',array('token'=>session('token'))));exit;
           }
        }
    }

    public function album(){
        $Photo = M("Photo");
        $t_album = M('Estate_album');
        $where['token'] = session('token');
        $where['thetype'] = 'estate';
        $album = $t_album->where($where)->field('id,poid')->select();
        foreach ($album as $k => $v) {

             $list_photo[] = $Photo->where(array('token'=>session('token'),'id'=>$v['poid']))->order('id desc')->find();


        }
        foreach ($album as $key => &$value) {
            $list_photo[$key]['mid'] = $value['id'];
        }
        $this->assign('album',$list_photo);
        $this->display();
    }

    public function album_add(){
        $po_data=M('Photo');
        $where['token'] = session('token');
        $where['thetype'] = 'estate';
        $list = $po_data->where($where)->field('id,title')->select();
        $this->assign('photo',$list);
        $t_album = M('Estate_album');
        $poid = (int)$this->_get('poid');

        $check = $t_album->where(array('token' => session('token'), 'poid' => $poid,'thetype' => 'estate'))->find();
        $this->assign('album',$check);

        if(IS_POST){			$_POST['token']= session('token');			$_POST['thetype']= 'estate';
            if($check == NULL){
                $check_ex = $t_album->where(array('token' => session('token'), 'poid' => $this->_post('poid'),'thetype' => 'estate'))->find();
                if($check_ex){
                     $this->error('您已经添加过改相册，请勿重复添加。');
                    exit;
                }
                    if($t_album->add($_POST)){
                        $this->success('添加成功',U('Estate/album',array('token'=>session('token'))));
                         exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }
           }else{
             $wh = array('token'=>session('token'),'id'=>$this->_post('id'));

             if($t_album->where($wh)->save($_POST)){
                    $this->success('修改成功',U('Estate/album',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');exit;
                }
           }
        }
        $this->display();

    }

    public function impress(){

        $t_impress = M('Estate_impress');
        $impress = $t_impress->where(array('token'=>session('token')))->order('sort desc')->select();
        $this->assign('impress',$impress);
        $this->display();
    }

    public function impress_add(){
        $t_impress = M('Estate_impress');
        $id = $this->_get("id");

        $where =  array('id'=>$id);
        $check = $t_impress->where($where)->find();

        if($check != null){
             $this->assign('impress',$check);
        }

        if(IS_POST){
             $_POST['token'] = session('token');
            if($check == null){

                    if($t_impress->add($_POST)){
                        $this->success('添加成功',U('Estate/impress',array('token'=>session('token'))));
                        exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }
           }else{
             $wh = array('id'=>$this->_post('id'));

             if($t_impress->where($wh)->save($_POST)){
                    $this->success('修改成功',U('Estate/impress',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');exit;
                }
           }
        }

        $this->display();
    }

    public function impress_del(){
        $impress = M('Estate_impress');
        $id = $this->_get('id');
        $where = array('id'=>$id);
        $check = $impress->where($where)->find();
        if($check == null){
            $this->error('操作失败');
        }else{
            $isok = $impress->where($where)->delete();
            if($isok){
               $this->success('删除成功',U('Estate/impress',array('token'=>session('token')))); exit;
           }else{
                $this->error('删除失败',U('Estate/impress',array('token'=>session('token'))));exit;
           }
        }
    }

    public function expert(){


        $t_expert = M('Estate_expert');

        $expert = $t_expert->where(array('token'=>session('token')))->order('sort desc')->select();


        $this->assign('expert',$expert);
        $this->display();
    }

    public function expert_add(){

       $t_expert = M('Estate_expert');
        $id = $this->_get("id");

        $where =  array('id'=>$id);
        $check = $t_expert->where($where)->find();

        if($check != null){
             $this->assign('expert',$check);
        }

        if(IS_POST){
             $_POST['token'] = session('token');
             if(!D('Estate_expert')->create()){
                $this->error('表单提交错误！,请检查是否有项为空！');exit();
             }
            if($check == null){

                    if($t_expert->add($_POST)){
                        $this->success('添加成功',U('Estate/expert',array('token'=>session('token'))));
                        exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit();
                    }
           }else{
             $wh = array('id'=>$this->_post('id'));

             if($t_expert->where($wh)->save($_POST)){
                    $this->success('修改成功',U('Estate/expert',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');exit();
                }
           }
        }

        $this->display();
    }

    public function expert_del(){

       $expert = M('Estate_expert');
        $id = $this->_get('id');
        $where = array('id'=>$id);
        $check = $expert->where($where)->find();
        if($check == null){
            $this->error('操作失败');
        }else{
            $isok = $expert->where($where)->delete();
            if($isok){
               $this->success('删除成功',U('Estate/expert',array('token'=>session('token'))));exit;
           }else{
                $this->error('删除失败',U('Estate/expert',array('token'=>session('token'))));exit();
           }
        }
    }

    public function  reservation(){
        $data = M("Reservation");
        $where = array('token'=>session('token'),'addtype'=>'house_book');
        //$reslist =  $data->where($where)->select();
        $count      = $data->where($where)->count();
        $Page       = new Page($count,12);
        $show       = $Page->show();
        $reslist = $data->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('count',$count);
        $this->assign('page',$show);
        $this->assign('reslist',$reslist);
        $this->display();
    }

    public function reservation_add(){
        if(IS_POST){
            $data=D('Reservation');
            $_POST['token']=session('token');
            $_POST['addtype'] = 'house_book';
			$_POST['thetype'] = 'estate';
            if($data->create()!=false){
                if($id=$data->data($_POST)->add()){
					$data2=D('Estate');
					$where1=array('token'=>session('token'),'thetype'=>'estate');
					$check=$data2->where($where1)->find();
					if(empty($check)){
					$this->error('请先添加房产主体信息');
					}
					$_POST1['res_id'] = $id;
					$_POST1['token'] = session('token');
					if($data2->where($where1)->save($_POST1))

                    $data1['pid']=$id;
                    $data1['module']='Reservation';
                    $data1['token']=session('token');
                    $data1['keyword']=trim($_POST['keyword']);
                    M('Keyword')->add($data1);
                    $this->success('添加成功',U('Estate/reservation',array('token'=>session('token'))));
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

    public function reservation_total(){
        $this->display();
    }

    public function reservation_del(){
        $id = (int)$this->_get('id');
        $res = M('Reservation');
        $find = array('id'=>$id,'token'=>$this->_get('token'));
        $result = $res->where($find)->find();
         if($result){
            $res->where('id='.$result['id'])->delete();
            $where = array('pid'=>$result['id'],'module'=>'Reservation','token'=>session('token'));
            M('Keyword')->where($where)->delete();
            $this->success('删除成功',U('Estate/reservation',array('token'=>session('token'))));
             exit;
         }else{
            $this->error('非法操作！');
             exit;
         }
    }

    public function reservation_edit(){

         if(IS_POST){
            $data=D('Reservation');
            $where=array('id'=>(int)$this->_post('id'),'token'=>session('token'));
            $check=$data->where($where)->find();

            if(empty($check)){
            $this->error('非法操作');
            }

            if($data->create()){
                $_POST['addtype'] = 'house_book';
				$_POST['thetype'] = 'estate';
                $_POST['token'] = session('token');
                if($data->where($where)->save($_POST)){
                    $data1['pid']=(int)$this->_post('id');
                    $data1['module']='Reservation';
                    $data1['token']=session('token');

                    $da['keyword']=trim($_POST['keyword']);
                    M('Keyword')->where($data1)->save($da);
                    $this->success('修改成功',U('Estate/reservation',array('token'=>session('token'))));
                }else{
                    $this->error('操作失败');
                }
            }else{
                $this->error($data->getError());
            }
        }else{
            $id=$this->_get('id');
            $where=array('id'=>$id,'token'=>session('token'));
            $data=M('Reservation');
            $check=$data->where($where)->find();
            if(empty($check))$this->error('非法操作');
            $reslist=$data->where($where)->find();
            $this->assign('reslist',$reslist);
            $this->display('reservation_add');
        }
    }

    public function reservation_manage(){
        $t_reservebook = M('Reservebook');
        $rid = (int)$this->_get('id');
        $where = array('token'=>session('token'),'rid'=>$rid,'type'=>'house_book');
        $count      = $t_reservebook->where($where)->count();
        $Page       = new Page($count,12);
        $show       = $Page->show();
        $books = $t_reservebook->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('id DESC')->select();
        $this->assign('page',$show);
        //var_dump($books);
        $this->assign('books',$books);
        $this->assign('count',$t_reservebook->where($where)->count());
        $this->assign('ok_count',$t_reservebook->where(array('token'=>session('token'),'remate'=>1,'rid'=>$rid,'type'=>'house_book'))->count());
        $this->assign('lose_count',$t_reservebook->where(array('token'=>session('token'),'remate'=>2,'rid'=>$rid,'type'=>'house_book'))->count());
        $this->assign('call_count',$t_reservebook->where(array('token'=>session('token'),'remate'=>0,'rid'=>$rid,'type'=>'house_book'))->count());
        $this->display();
    }

    public function album_del(){
        $t_album = M('estate_album');
        $id =filter_var($this->_get('id'),FILTER_VALIDATE_INT);
        $where = array('id'=>$id,'token'=>session('token'));
        $check = $t_album->where($where)->find();
        if($check == null){
            $this->error('操作失败');
        }else{
            $isok = $t_album->where($where)->delete();
            if($isok){
               $this->success('删除成功',U('Estate/album',array('token'=>session('token')))); exit;
           }else{
                $this->error('删除失败',U('Estate/album',array('token'=>session('token'))));exit;
           }
        }
    }

    public function aboutus(){
        $t_company = M('Company');
        $token = session('token');
        $where =  array('token'=>$token,'isbranch'=>1,'shortname'=>'loupan');
        $check = $t_company->where($where)->find();

        if($check != null){
             $this->assign('set',$check);
        }

        if(IS_POST){

            if($check == null){
                    if($t_company->add($_POST)){
                        $this->success('添加成功',U('Estate/aboutus',array('token'=>session('token'))));
                        exit;
                    }else{
                        $this->error('服务器繁忙,请稍候再试');exit;
                    }
           }else{
             $wh = array('id'=>$this->_post('id'),'token'=>session('token'));

             if($t_company->where($wh)->save($_POST)){
                    $this->success('修改成功',U('Estate/aboutus',array('token'=>session('token'))));
                    exit;
                }else{
                    $this->error('操作失败');exit;
                }
           }
        }

        $this->display();
    }
	
	public function salers()
	{
		$data = M('Estate_saler');
		$where = array('token' => session('token'));
		$count = $data->where($where)->count();
		$Page = new Page($count, 12);
		$show = $Page->show();
		$salers = $data->where($where)->order('sort desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$this->assign('page', $show);
		$this->assign('salers', $salers);
		$this->display();
	}
	public function add_saler()
	{
		if (IS_POST)
		{
			$data = D('Estate_saler');
			$_POST['token'] = session('token');
			if ($data->create() != false)
			{
				if ($id = $data->data($_POST)->add())
				{
					$this->success('添加成功', U('Estate/salers', array('token' => session('token'))));
					exit;
				}
				else
				{
					$this->error('服务器繁忙,请稍候再试');
					exit;
				}
			}
			else
			{
				$this->error($data->getError());
			}
		}
		$this->display();
	}
	public function edit_salers()
	{
		if (IS_POST)
		{
			$data = D('Estate_saler');
			$where = array('id' => (int)$this->_get('id'), 'token' => session('token'));
			$check = $data->where($where)->find();
			if ($check == null)$this->error('非法操作');
			if ($data->create())
			{
				$where2 = array('id' => (int)$this->_post('id'), 'token' => session('token'));
				if ($data->where($where2)->save($_POST))
				{
					$this->success('修改成功', U('Estate/salers', array('token' => session('token'))));
				}
				else
				{
					$this->error('操作失败');
				}
			}
			else
			{
				$this->error($data->getError());
			}
		}
		else
		{
			$id = (int)$this->_get('id');
			$where2 = array('id' => $id, 'token' => session('token'));
			$data = M('Estate_saler');
			$check = $data->where($where2)->find();
			if ($check == null)$this->error('非法操作');
			$salers = $data->where($where2)->find();
			$this->assign('salers', $salers);
			$this->display('add_saler');
		}
	}
	public function del_salers()
	{
		$id = (int)$this->_get('id');
		$res = M('Estate_saler');
		$find = array('id' => $id, 'token' => session('token'));
		$result = $res->where($find)->find();
		if ($result)
		{
			$res->where(array('id' => $result['id']))->delete();
			$this->success('删除成功', U('Estate/salers', array('token' => session('token'))));
			exit;
		}
		else
		{
			$this->error('非法操作！');
			exit;
		}
	}




}



?>