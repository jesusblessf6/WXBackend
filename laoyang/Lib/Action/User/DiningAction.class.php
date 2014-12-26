<?php
class DiningAction extends UserAction{
	public $token;
	public $dining_model;
	public $dining_cat_model;
	public $isDining;
	public $isBranch;
	public $company_model;
	public function _initialize() {
		parent::_initialize();
		$token_open=M('token_open')->field('queryname')->where(array('token'=>session('token')))->find();

		//if(!strpos($token_open['queryname'],'dining')){
        //    $this->error('您还开启该模块的使用权,请到功能模块中添加',U('Connme/index',array('token'=>session('token'),'id'=>session('wxid'))));
		//}
		
		//店铺信息
		$this->token=session('token');
		$this->isDining=intval($_GET['dining']);
		$this->assign('token',$this->token);
		$this->company_model=M('Dining_company');
		$this->dining_model=M('Dining');
		//查询店铺
		$Companys =M('Company')->where(array('token'=>$this->token))->select();
		if(!$Companys){
			$this->error('请设置lbs公司信息',U('Company/index',array('token'=>$this->token)));
		}
		$this->Companys=$Companys;
		$url=$this->curPageURL();
		$url=$this->remove_querystring_var($url,"storeid");
		$this->assign('Companys',$Companys);
		$this->assign('url',$url);
	}
	public function index(){		
		$catid=intval($_GET['catid']);
		$catid=$catid==''?0:$catid;
		$dining_model=M('Dining');
		$dining_cat_model=M('Dining_cat');
		$where=array('token'=>$this->token);
		if ($catid){
			$where['catid']=$catid;
		}
		$where['groupon']=0;
        if(IS_POST){
            $key = $this->_post('searchkey');
            if(empty($key)){
                $this->error("关键词不能为空");
            }

            $map['token'] = $this->get('token'); 
            $map['name|intro|keyword'] = array('like',"%$key%"); 
            $list = $dining_model->where($map)->select(); 
            $count      = $dining_model->where($map)->count();       
            $Page       = new Page($count,20);
        	$show       = $Page->show();
        }else{
        	$count      = $dining_model->where($where)->count();
        	$Page       = new Page($count,20);
        	$show       = $Page->show();
        	$list = $dining_model->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach ($list as $k=>$c){
			$catid=$c['storeid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$list[$k]['shopname']=$thisCompany['name'];
			}
        }
		foreach($list as $k=>$v){
			$list[$k]['catname']=M('Dining_cat')->where(array('id'=>$v['catid']))->getField('name');
		}
		$this->assign('page',$show);		
		$this->assign('list',$list);
		$this->assign('isDiningPage',1);
		
		$this->display();		
	}
	public function cats(){
		$parentid=intval($_GET['parentid']);
		$parentid=$parentid==''?0:$parentid;
		$data=M('Dining_cat');
		$where=array('parentid'=>$parentid,'token'=>$this->token);
        if(IS_POST){
            $key = $this->_post('searchkey');
            if(empty($key)){
                $this->error("关键词不能为空");
            }

            $map['token'] = $this->get('token'); 
            $map['name|des'] = array('like',"%$key%"); 
            $list = $data->where($map)->select(); 
            $count      = $data->where($map)->count();       
            $Page       = new Page($count,20);
        	$show       = $Page->show();
        }else{
        	$count      = $data->where($where)->count();
        	$Page       = new Page($count,20);
        	$show       = $Page->show();
        	$list = $data->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
			foreach ($list as $k=>$c){
			$catid=$c['storeid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$list[$k]['shopname']=$thisCompany['name'];
			}	
        }
		$this->assign('page',$show);		
		$this->assign('list',$list);
		if ($parentid){
			$parentCat = $data->where(array('id'=>$parentid,'token'=>$this->token))->find();
			foreach ($parentCat as $c){
			$catid=$c['storeid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$parentCat['shopname']=$thisCompany['name'];
			}	
		}
		$this->assign('parentCat',$parentCat);
		$this->assign('parentid',$parentid);
		$this->display();		
	}
	public function catAdd(){ 
		if(IS_POST){
			$this->insert('Dining_cat','/cats?parentid='.$this->_post('parentid'));
		}else{
			if (isset($_GET['storeid'])){
			$storeid=$this->_get('storeid');
			$where=array('token'=>$this->token,'storeid'=>$storeid);
			}
			else
			{
				$where=array('token'=>$this->token);
			}
			$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
			if(!$Company){
				$this->error('请先在店铺信息添加店铺',U('Dining/ComBranches',array('token'=>$this->token)));
			}
			else
			{
				foreach ($Company as $k=>$c){
				$catid=$c['catid'];
				$thisCompany=M('Company')->where(array('id'=>$catid))->find();
				$Company[$k]['shopname']=$thisCompany['name'];
				}	
			}
			$parentid=intval($_GET['parentid']);
			$parentid=$parentid==''?0:$parentid;
			//查询所有分类
			$catlist =M('Dining_cat')->where($where)->select();
			$this->assign('catlist',$catlist);
			$shopOptions=$this->shopOptions($Company,$storeid);
			$this->assign('shopOptions',$shopOptions);			
			$this->assign('parentid',$parentid);
			$this->display('catSet');
		}
	}
	public function catDel(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = $this->_get('id');
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $data=M('Dining_cat');
            $check=$data->where($where)->find();
            if($check==false)   $this->error('非法操作');
            $dining_model=M('Dining');
            $diningsOfCat=$dining_model->where(array('catid'=>$id))->select;
            if (count($diningsOfCat)){
            	$this->error('本分类下有商品，请删除商品后再删除分类',U('Dining/cats',array('token'=>$this->token)));
            }
            $back=$data->where($wehre)->delete();
            if($back==true){
                $this->success('操作成功',U('Dining/cats',array('token'=>$this->token,'parentid'=>$check['parentid'])));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Dining/cats',array('token'=>$this->token)));
            }
        }        
	}
	public function catSet(){
        $id = $this->_get('id'); 
		$checkdata = M('Dining_cat')->where(array('id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有相应记录.您现在可以添加.",U('Dining/catAdd'));
        }
		if(IS_POST){ 
            $data=D('Dining_cat');
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$data->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($data->create()){
				if($data->where($where)->save($_POST)){
					$this->success('修改成功',U('Dining/cats',array('token'=>$this->token,'parentid'=>$this->_post('parentid'))));	
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($data->getError());
			}
		}else{
			if (isset($_GET['storeid'])){
			$storeid=$this->_get('storeid');
			$where=array('token'=>$this->token,'storeid'=>$storeid);
			}
			else
			{
				$where=array('token'=>$this->token);
			}
			//查询所有分类
			$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
			if(!$Company){
				$this->error('请设置lbs公司信息',U('Company/index',array('token'=>$this->token)));
			}
			else
			{
				foreach ($Company as $k=>$c){
				$catid=$c['catid'];
				$thisCompany=M('Company')->where(array('id'=>$catid))->find();
				$Company[$k]['shopname']=$thisCompany['name'];
				}	
			}
			$catlist =M('Dining_cat')->where($where)->select();
			$this->assign('catlist',$catlist);
			$shopOptions=$this->shopOptions($Company,$storeid);
			$this->assign('shopOptions',$shopOptions);			
			$this->assign('parentid',$checkdata['parentid']);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	public function add(){ 
		if(IS_POST){
			$this->all_insert('Dining','/index?token='.$this->token);
		}else{
			//分类
			if (isset($_GET['storeid'])){
				$storeid=$this->_get('storeid');
				$catWhere=array('token'=>$this->token,'storeid'=>$storeid);
			}
			else
			{
				$catWhere=array('token'=>$this->token);
			}
			$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
			if(!$Company){
				$this->error('请先添加店铺信息',U('Dining/ComBranches',array('token'=>$this->token)));
			}
			foreach ($Company as $k=>$c){
			$catid=$c['catid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$Company[$k]['shopname']=$thisCompany['name'];
			}
			$data=M('Dining_cat');
			$cats=$data->where($catWhere)->select();
			if (!$cats){
				 $this->error("请先添加分类",U('Dining/catAdd',array('token'=>$this->token)));
				 exit();
			}
			$this->assign('cats',$cats);
			$catsOptions=$this->catOptions($cats,0);
			$shopOptions=$this->shopOptions($Company,$storeid);
			$this->assign('shopOptions',$shopOptions);
			$this->assign('catsOptions',$catsOptions);
			$this->assign('isDiningPage',1);
			$this->display('set');
		}
	}
	/**
	 * 商品类别ajax select
	 *
	 */
	public function ajaxCatOptions(){
		$parentid=intval($_GET['parentid']);
		$data=M('Dining_cat');
		$catWhere=array('parentid'=>$parentid,'token'=>$this->token);
		$cats=$data->where($catWhere)->select();
		$str='';
		if ($cats){
			foreach ($cats as $c){
				$str.='<option value="'.$c['id'].'">'.$c['name'].'</option>';
			}
		}
		$this->show($str);
	}
	public function set(){
        $id = $this->_get('id'); 
        $dining_model=M('Dining');
        $dining_cat_model=M('Dining_cat');
		$checkdata = $dining_model->where(array('id'=>$id))->find();
		if(empty($checkdata)){
            $this->error("没有相应记录.您现在可以添加.",U('Dining/add'));
        }
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$dining_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($dining_model->create()){
				if($dining_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Dining/index',array('token'=>$this->token)));
					$keyword_model=M('Keyword');
					$keyword_model->where(array('token'=>$this->token,'pid'=>$this->_post('id'),'module'=>'Dining'))->save(array('keyword'=>$this->_post('keyword')));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($dining_model->getError());
			}
		}else{
			//分类
			if (isset($_GET['storeid'])){
				$storeid=$this->_get('storeid');
				$catWhere=array('token'=>$this->token,'storeid'=>$storeid);
			}
			else
			{
				$catWhere=array('token'=>$this->token);
			}
			$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
			if(!$Company){
				$this->error('请设置lbs公司信息',U('Company/index',array('token'=>$this->token)));
			}
			foreach ($Company as $k=>$c){
			$catid=$c['catid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$Company[$k]['shopname']=$thisCompany['name'];
			}
			$shopOptions=$this->shopOptions($Company,$storeid);
			$this->assign('shopOptions',$shopOptions);
			$cats=$dining_cat_model->where($catWhere)->select();
			$this->assign('cats',$cats);
			
			$thisCat=$dining_cat_model->where(array('id'=>$checkdata['catid']))->find();
			$childCats=$dining_cat_model->where(array('parentid'=>$thisCat['parentid']))->select();
			$this->assign('thisCat',$thisCat);
			$this->assign('parentCatid',$thisCat['parentid']);
			$this->assign('childCats',$childCats);
			$this->assign('isUpdate',1);
			$catsOptions=$this->catOptions($cats,$checkdata['catid']);
			$childCatsOptions=$this->catOptions($childCats,$thisCat['id']);
			$this->assign('catsOptions',$catsOptions);
			$this->assign('childCatsOptions',$childCatsOptions);
			//
			$this->assign('set',$checkdata);
			$this->assign('isDiningPage',1);
			$this->display();	
		
		}
	}
	//商品类别下拉列表
	public function catOptions($cats,$selectedid){
		$str='';
		if ($cats){
			foreach ($cats as $c){
				$selected='';
				if ($c['id']==$selectedid){
					$selected=' selected';
				}
				$str.='<option value="'.$c['id'].'"'.$selected.'>'.$c['name'].'</option>';
			}
		}
		return $str;
	}
	//店铺下拉列表
	public function shopOptions($shops,$selectedid){
		$str='';
		if ($shops){
			foreach ($shops as $c){
				$selected='';
				if ($c['catid']==$selectedid){
					$selected=' selected';
				}
				$str.='<option value="'.$c['catid'].'"'.$selected.'>'.$c['shopname'].'</option>';
			}
		}
		return $str;
	}
	
	public function del(){
		$dining_model=M('Dining');
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = $this->_get('id');
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $check=$dining_model->where($where)->find();
            if($check==false)   $this->error('非法操作');

            $back=$dining_model->where($wehre)->delete();
            if($back==true){
            	$keyword_model=M('Keyword');
            	$keyword_model->where(array('token'=>$this->token,'pid'=>$id,'module'=>'Dining'))->delete();
                $this->success('操作成功',U('Dining/index',array('token'=>$this->token)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Dining/index',array('token'=>$this->token)));
            }
        }        
	}
	public function orders(){
		$dining_cart_model=M('Product_cart');
		$where=array('token'=>$this->_session('token'));
		if (IS_POST){
			if ($_POST['token']!=$this->_session('token')){
				exit();
			}
			$print = "";
			for ($i=0;$i<40;$i++){
				if (isset($_POST['id_'.$i])){
					$thiCartInfo=$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->find();
					if ($thiCartInfo['handled']){
						$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>0));
					}else {
						$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>1));
					}
					if($_POST['prints']){
						//$print = array_push($print, $_POST['id_'.$i]);
						if (empty($print)){
							$print = $_POST['id_'.$i];
						}else{
							$print = $_POST['id_'.$i].",".$print;
						}
					}
				}
			}
			if($_POST['prints']){

						$data = array("id"=>$print,"token"=>$_POST['token']);
						$url = U('Print/index',$data);
						echo "<script>window.open('$url');</script>";
			}
			$this->success('操作成功',U('Dining/orders',array('token'=>session('token'),'dining'=>$this->isDining)));
		}else{
			if(IS_POST){
				$key = $this->_post('searchkey');
				if(empty($key)){
					$this->error("关键词不能为空");
				}

				$where['truename|address'] = array('like',"%$key%");
				$orders = $dining_cart_model->where($where)->select();
				$count      = $dining_cart_model->where($where)->limit($Page->firstRow.','.$Page->listRows)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
			}else {
				if (isset($_GET['dining']))
				{
					$where['dining']=intval($_GET['dining']);
				}
				if (isset($_GET['handled'])){
					$where['handled']=intval($_GET['handled']);
				}
				$count      = $dining_cart_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
				$orders=$dining_cart_model->where($where)->order('time DESC')->limit($Page->firstRow.','.$Page->listRows)->select();
			}
			$where['handled']=0;
			$unHandledCount=$dining_cart_model->where($where)->count();
			$this->assign('unhandledCount',$unHandledCount);


			$this->assign('orders',$orders);
			$this->assign('dining',$this->isDining);
			$this->assign('page',$show);
			$this->display();
		}
	}
	public function orderInfo(){
		$this->dining_model=M('Dining');
		$this->dining_cat_model=M('Dining_cat');
		$dining_cart_model=M('Product_cart');
		$thisOrder=$dining_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		if (strtolower($thisOrder['token'])!=strtolower($this->_session('token'))){
			exit();
		}
		if (IS_POST){
			if (intval($_POST['sent'])){
				$_POST['handled']=1;
				Sms::wxfahuo($thisOrder['token'], $thisOrder['orderid'],$thisOrder['transactionid'],$thisOrder['wecha_id']);
			}
			$dining_cart_model->where(array('id'=>$thisOrder['id']))->save(array('sent'=>intval($_POST['sent']),'paid'=>intval($_POST['paid']),'logistics'=>$_POST['logistics'],'logisticsid'=>$_POST['logisticsid'],'handled'=>1));
			$this->success('修改成功',U('Dining/orderInfo',array('token'=>$this->token,'id'=>$thisOrder['id'])));
		}else {
			//订餐信息
			$dining_diningtable_model=M('dining_diningtable');
			$thisuser_allorder=$dining_cart_model->where(array('wecha_id'=>$thisOrder['wecha_id'],'token'=>$this->token,'handled'=>1))->count();
			if ($thisOrder['tableid']) {
				$thisTable=$dining_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}
			//
			$this->assign('thisOrder',$thisOrder);
			$this->assign('thisuser_allorder',$thisuser_allorder);
			$carts=unserialize($thisOrder['info']);

			//
			$totalFee=0;
			$totalCount=0;
			$dinings=array();
			$ids=array();
			foreach ($carts as $k=>$c){
				if (is_array($c)){
					$diningid=$k;
					$price=$c['price'];
					$count=$c['count'];
					//
					if (!in_array($diningid,$ids)){
						array_push($ids,$diningid);
					}
					$totalFee+=$price*$count;
					$totalCount+=$count;
				}
			}
			if (count($ids)){
				$list=$this->dining_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($list){
				$i=0;
				foreach ($list as $p){
					$list[$i]['count']=$carts[$p['id']]['count'];
					$i++;
				}
			}
			$this->assign('dinings',$list);
			//
			$this->assign('totalFee',$totalFee);
			$this->display();
		}
	}
	public function deleteOrder(){
		$dining_model=M('dining');
		$dining_cart_model=M('Product_cart');
		$dining_cart_list_model=M('Product_cart_list');
		$thisOrder=$dining_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['token']!=$this->_session('token')){
			exit();
		}
		//删除订单和订单列表
		$dining_cart_model->where(array('id'=>$id))->delete();
		$dining_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$carts=unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$diningid=$k;
				$price=$c['price'];
				$count=$c['count'];
				$dining_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		$this->success('操作成功', U('Dining/orders',array('token'=>$this->token)));
	}
	//公司信息
	public function ComIndex(){
		$where=array('token'=>$this->token);
		$catid=$this->_get('catid');
		$id=$this->_get('id');
		if(IS_POST){
			$where['id']=$id;
			$thisCompany=M('Dining_company')->where($where)->find();
			if (!$thisCompany){
				$db   = M('Dining_company');
				if ($db->create() === false) {
					$this->error($db->getError());
				} else {
					$id = $db->add();
					if ($id == true) {
						$this->success('操作成功', U('Dining/ComBranches',array('token'=>$this->token,'id'=>$id)));
					} else {
						$this->error('操作失败',U('Dining/ComBranches',array('token'=>$this->token,'id'=>$id)));
					}
				}
			}else {
				if($this->company_model->create()){
					if($this->company_model->where($where)->save($_POST)){
						$this->success('修改成功',U('Dining/ComIndex',array('token'=>$this->token,'id'=>$id)));
					}else{
						$this->error('修改失败');
					}
				}else{
					$this->error($this->company_model->getError());
				}
			}
			
		}else{
			//信息
			$where['id']=$id;
			$thisCompany=M('Dining_company')->where($where)->find();
			$this->assign('set',$thisCompany);
			//店铺名称
			
			$Company=M('Company')->where(array('token'=>$this->token))->select();
			if(!$Company){
				$this->error('请设置lbs公司信息',U('Company/index',array('token'=>$this->token)));
			}
			$this->assign('Company',$Company);
			$this->display();
		}
	}
	public function ComBranches(){
		$branches=array();
		$branches=$this->company_model->where(array('token'=>$this->token))->select();
		foreach ($branches as $k=>$c){
				$catid=$c['catid'];
				$thisCompany=M('Company')->where(array('id'=>$catid))->find();
				$branches[$k]['name']=$thisCompany['name'];
		}	
		$this->assign('branches',$branches);
		$this->display();
	}
	public function ComDelete(){
		$where=array('token'=>$this->token,'id'=>intval($_GET['id']));
		$rt=$this->company_model->where($where)->delete();
		if($rt==true){
			$this->success('删除成功',U('Dining/ComBranches',array('token'=>$this->token)));
		}else{
			$this->error('删除失败',U('Dining/ComBranches',array('token'=>$this->token)));
		}
	}
	
	//桌台管理
	public function tables(){

		$dining_diningtable_model=M('dining_diningtable');
		if (IS_POST){
			if ($_POST['token']!=$this->_session('token')){
				exit();
			}
			for ($i=0;$i<40;$i++){
				if (isset($_POST['id_'.$i])){
					$thiCartInfo=$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->find();
					if ($thiCartInfo['handled']){
					$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>0));
					}else {
						$dining_cart_model->where(array('id'=>intval($_POST['id_'.$i])))->save(array('handled'=>1));
					}
				}
			}
			$this->success('操作成功',U('Dining/orders',array('token'=>$this->token)));
		}else{
			$where=array('token'=>$this->_session('token'));
			if(IS_POST){
				$key = $this->_post('searchkey');
				if(empty($key)){
					$this->error("关键词不能为空");
				}

				$where['truename|address'] = array('like',"%$key%");
				$orders = $dining_cart_model->where($where)->select();
				$count      = $dining_cart_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
			}else {
				
				$count      = $dining_diningtable_model->where($where)->count();
				$Page       = new Page($count,20);
				$show       = $Page->show();
				$tables=$dining_diningtable_model->where($where)->order('taxis ASC')->limit($Page->firstRow.','.$Page->listRows)->select();
				foreach ($tables as $k=>$c){
				$catid=$c['storeid'];
				$thisCompany=M('Company')->where(array('id'=>$catid))->find();
				$tables[$k]['shopname']=$thisCompany['name'];
				}	
			}

			$this->assign('tables',$tables);
			$this->assign('page',$show);
			$this->display();
		}
	}
	public function tableAdd(){ 
		$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
		if(!$Company){
			$this->error('请先设置店铺信息',U('Dining/ComBranches',array('token'=>$this->token)));
		}
		else
		{
			foreach ($Company as $k=>$c){
			$catid=$c['catid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$Company[$k]['shopname']=$thisCompany['name'];
			}	
		}
		if(IS_POST){
			$this->insert('Dining_diningtable','/tables?dining=1');
		}else{
			$this->assign('Company',$Company);
			$this->display('tableSet');
		}
	}
	public function tableSet(){
		$Company=M('Dining_company')->where(array('token'=>$this->token))->select();
		if(!$Company){
			$this->error('请设置lbs公司信息',U('Company/index',array('token'=>$this->token)));
		}
		else
		{
			foreach ($Company as $k=>$c){
			$catid=$c['catid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$Company[$k]['shopname']=$thisCompany['name'];
			}	
		}
		$dining_diningtable_model=M('dining_diningtable');
        $id = $this->_get('id'); 
		$checkdata = $dining_diningtable_model->where(array('id'=>$id))->find();
		if(IS_POST){ 
            $where=array('id'=>$this->_post('id'),'token'=>$this->token);
			$check=$dining_diningtable_model->where($where)->find();
			if($check==false)$this->error('非法操作');
			if($dining_diningtable_model->create()){
				if($dining_diningtable_model->where($where)->save($_POST)){
					$this->success('修改成功',U('Dining/tables',array('token'=>$this->token,'dining'=>1)));
				}else{
					$this->error('操作失败');
				}
			}else{
				$this->error($data->getError());
			}
		}else{
			$this->assign('Company',$Company);
			$this->assign('set',$checkdata);
			$this->display();	
		
		}
	}
	public function tableDel(){
		if($this->_get('token')!=$this->token){$this->error('非法操作');}
        $id = $this->_get('id');
        if(IS_GET){                              
            $where=array('id'=>$id,'token'=>$this->token);
            $dining_diningtable_model=M('dining_diningtable');
            $check=$dining_diningtable_model->where($where)->find();
            if($check==false)   $this->error('非法操作');
           
            $back=$dining_diningtable_model->where($wehre)->delete();
            if($back==true){
            	$this->success('操作成功',U('Dining/tables',array('token'=>$this->token,'dining'=>1)));
            }else{
                 $this->error('服务器繁忙,请稍后再试',U('Dining/tables',array('token'=>$this->token,'dining'=>1)));
            }
        }        
	}
	public function curPageURL()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on")
		{
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	//解析URL参数
	function parseUrlParam($query){
		$queryArr = explode('&', $query);
		$params = array();
		if($queryArr[0] !== ''){
			foreach( $queryArr as $param ){
				list($name, $value) = explode('=', $param);
				$params[urldecode($name)] = urldecode($value);
			}       
		}
		return $params;
	}

	//设置URL参数数组
	function setUrlParams($cparams, $url = ''){
	  $parse_url = $url === '' ? parse_url($_SERVER["REQUEST_URI"]) : parse_url($url);
	  $query = isset($parse_url['query']) ? $parse_url['query'] : '';
	  $params = parseUrlParam($query);
	  foreach( $cparams as $key => $value ){
		$params[$key] = $value;
	  }
	  return $parse_url['path'].'?'.http_build_query($params);
	}

	//获取URL参数
	function getUrlParam($cparam, $url = ''){
		$parse_url = $url === '' ? parse_url($_SERVER["REQUEST_URI"]) : parse_url($url);
		$query = isset($parse_url['query']) ? $parse_url['query'] : '';
		$params = parseUrlParam($query);
		return isset($params[$cparam]) ? $params[$cparam] : '';
	}
	function remove_querystring_var($url, $key) {
		$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
		$url = substr($url, 0, -1);
    return ($url);
	}
}
?>