<?php
class GrouponAction extends ProductAction{
	public $token;
	public $wecha_id;
	public $product_model;
	public $product_cat_model;
	public $isDining;
	public $tplid;
	public $pageSize;
	public function _initialize(){
		parent::_initialize();
		$this->pageSize=8;
		$grouponConfig=S('grouponConfig'.$this->token);
		$grouponDetailConfig=unserialize($grouponConfig['config']);

		$this->tplid=intval($grouponDetailConfig['tplid']);
		$this->assign('pageSize',$this->pageSize);
		$this->assign('wecha_id',$this->_get('wecha_id'));
	}
	
	public function grouponIndex(){
		$where=array('token'=>$this->token,'groupon'=>1);
		$where['endtime']=array('gt',time());
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
			
			$thisCat=$this->product_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat',$thisCat);
		}
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('?g=Wap&m=Groupon&a=grouponIndex&token='.$this->token.'&keyword='.$key);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");
            $this->assign('isSearch',1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count',$count); 
		//排序方式
		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';
		$orders=array('time','discount','price','salecount');
		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';
		$this->assign('order',$order);
		$this->assign('method',$method);
		//
        	
		$products = $this->product_model->where($where)->order($order.' '.$method)->limit($this->pageSize)->select();
		$now=time();
		$i=0;
		if ($products){
			foreach ($products as $p){
				$products[$i]['new']=0;
				if ($now-$p['time']<3*24*3600){
					$products[$i]['new']=1;
				}
				$i++;
			}
		}
		$this->assign('products',$products);
		$this->assign('metaTitle','团购');
		$this->display('grouponIndex_'.$this->tplid);
	}
	public function ajaxGrouponProducts(){
		$where=array('token'=>$this->token,'groupon'=>1);
		$page=isset($_GET['page'])&&intval($_GET['page'])>1?intval($_GET['page']):2;
		$pageSize=isset($_GET['pagesize'])&&intval($_GET['pagesize'])>1?intval($_GET['pagesize']):$this->pageSize;
		$start=($page-1)*$pageSize;
		//排序方式
		$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';
		$method=$method=='ASC'?'DESC':'ASC';
		$orders=array('time','discount','price','salecount');
		$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';
		//
		$products = $this->product_model->where($where)->order($order.' '.$method)->limit($start.','.$pageSize)->select();
		/*
		$now=time();
		$i=0;
		if ($products){
			foreach ($products as $p){
				$products[$i]['new']=0;
				if ($now-$p['time']<3*24*3600){
					$products[$i]['new']=1;
				}
				$i++;
			}
		}
		*/
		$str='{"products":[';
		if ($products){
			$comma='';
			foreach ($products as $p){
				$membercount=intval($p['salecount'])+intval($p['fakemembercount']);
				$str.=$comma.'{"id":"'.$p['id'].'","catid":"'.$p['catid'].'","storeid":"'.$p['storeid'].'","name":"'.$p['name'].'","price":"'.$p['price'].'","token":"'.$p['token'].'","keyword":"'.$p['keyword'].'","salecount":"'.$p['salecount'].'","logourl":"'.$p['logourl'].'","time":"'.$p['time'].'","oprice":"'.$p['oprice'].'","fakemembercount":"'.$p['fakemembercount'].'","membercount":"'.$membercount.'","enddate":"'.date('Y-m-d',$p['endtime']).'"}';
				$comma=',';
			}
		}
		$str.=']}';
		$this->show($str);
	}
	public function product(){
		$where=array('token'=>$this->token);
		if (isset($_GET['id'])){
			$id=intval($_GET['id']);
			$where['id']=$id;
		}
		$product=$this->product_model->where($where)->find();
		$this->assign('product',$product);
		if ($product['endtime']){
			$startSeconds=intval($product['starttime']-time());
			$startflag=0;
			if($startSeconds>0)
			{
				$leftSeconds=intval($product['starttime']-time());
			}else{
				$leftSeconds=intval($product['endtime']-time());
				$startflag=1;
			}
			$this->assign('leftSeconds',$leftSeconds);
			$this->assign('startflag',$startflag);
		}
		$this->assign('metaTitle',$product['name']);
		$product['intro']=str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '),$product['intro']);
		$intro=$this->remove_html_tag($product['intro']);
		$intro=mb_substr($intro,0,30,'utf-8');
		$this->assign('intro',$intro);
		//店铺信息
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		$thisCompany=$company_model->where($where)->find();
		$this->assign('thisCompany',$thisCompany);
		//分店信息
		$branchStoreCount=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->count();
		$this->assign('branchStoreCount',$branchStoreCount);
		//销量最高的商品
		$sameCompanyProductWhere=array('token'=>$this->token,'id'=>array('neq',$product['id']));
		if ($product['dining']){
			$sameCompanyProductWhere['dining']=1;
		}
		if ($product['groupon']){
			$sameCompanyProductWhere['groupon']=1;
		}
		if (!$product['groupon']&&!$product['dining']){
			$sameCompanyProductWhere['groupon']=array('neq',1);
			$sameCompanyProductWhere['dining']=array('neq',1);
		}
		$products=$this->product_model->where($sameCompanyProductWhere)->limit('salecount DESC')->limit('0,5')->select();
		$this->assign('products',$products);
		$this->display('product_'.$this->tplid);
	}
	public function detail(){
		$where=array('token'=>$this->token);
		if (isset($_GET['id'])){
			$id=intval($_GET['id']);
			$where['id']=$id;
		}
		$product=$this->product_model->where($where)->find();
		if ($product['endtime']){
			$startSeconds=intval($product['starttime']-time());
			$startflag=0;
			if($startSeconds>0)
			{
				$leftSeconds=intval($product['starttime']-time());
			}else{
				$leftSeconds=intval($product['endtime']-time());
				$startflag=1;
			}
			$this->assign('leftSeconds',$leftSeconds);
			$this->assign('startflag',$startflag);
		}
		$product['intro']=html_entity_decode($product['intro']);
		$this->assign('product',$product);
		
		$this->assign('metaTitle',$product['name']);
		$this->display('detail_'.$this->tplid);
	}
	public function my(){
		$this->noaccess();
		$product_cart_model=M('product_cart');
		//$this->wecha_id
		$orders=$product_cart_model->where(array('token'=>$this->token,'groupon'=>1,'wecha_id'=>$this->wecha_id))->order('time DESC')->select();
		
		$unpaidCount=0;
		$unusedCount=0;
		if ($orders){
			foreach ($orders as $o){
				$products=unserialize($o['info']);
				//$firstProductID=$products
				if (!$o['paid']){
					$unpaidCount++;
				}
				if (!$o['handled']){
					$unusedCount++;
				}
			}
		}
		$this->assign('orders',$orders);
		$this->assign('unpaidCount',$unpaidCount);
		$this->assign('unusedCount',$unusedCount);
		$this->assign('ordersCount',count($orders));
		$this->assign('metaTitle','我的订单');
		//
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);

		//
		$this->assign('hideTopButton',1);
		$this->display('my_'.$this->tplid);
	}
	public function myOrders(){
		$this->noaccess();
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);

		//
		$where=array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'groupon'=>1);
		if (isset($_GET['used'])){
			if (intval($_GET['used'])==1){
				$title='已使用团购';
			}else {
				$title='未使用团购';
			}
			$where['handled']=intval($_GET['used']);
		}elseif (isset($_GET['paid'])){
			$title='待付款订单';
			$where['paid']=intval($_GET['paid']);
		}else{
			$title='全部订单';
		}
		$this->assign('title',$title);
		$product_cart_model=M('product_cart');
		//$this->wecha_id
		$orders=$product_cart_model->where($where)->order('time DESC')->select();
		//

		$productsIDs=array();
		if ($orders){
			foreach ($orders as $k=>$o){
				array_push($productsIDs,$o['productid']);
				$orders[$k]['name'] = M('Product')->where(array('token'=>$this->token,'id'=>$o['productid']))->getField('name');
			}
		}
		
		if ($productsIDs){
		$products=M('Product')->where(array('id'=>array('in',$productsIDs)))->select();
		}
		//
		$productsByID=array();
		if ($products){
			foreach ($products as $p){
				$productsByID[$p['id']]=$p;
			}
		}
		if ($orders){
			$i=0;
			foreach ($orders as $o){
				$orders[$i]['logourl']=$productsByID[$o['productid']]['logourl'];
				$orders[$i]['productName']=$productsByID[$o['productid']]['name'];
				//$orders[$i]['productPrice']=$productsByID[$o['productid']]['price'];
				if (!$o['paid']&&$payment&&!$o['handled']){
					$orders[$i]['needPay']=1;
				}else {
					$orders[$i]['needPay']=0;
				}
				$i++;
			}
		}
		//
		$this->assign('orders',$orders);
		$this->assign('unpaidCount',$unpaidCount);
		$this->assign('unusedCount',$unusedCount);
		$this->assign('ordersCount',count($orders));
		$this->assign('metaTitle','我的订单');
		//
		
		//
		$this->assign('hideTopButton',1);
		$this->display('myOrders_'.$this->tplid);
	}
	public function search(){
		$this->display('search_'.$this->tplid);
	}
	public function orderCart(){
		$this->noaccess();
		$userinfo_model=M('Userinfo');
		$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('thisUser',$thisUser);
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);
		//是否余额支付
		$user= M('Userinfo')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('yuer',$user['balance']);

		//
		if (IS_POST){
			
			$row=array();
			$orderid=$this->randStr(4).time();
			$row['orderid']=$orderid;
			//
			$row['truename']=$this->_post('truename');
			$row['tel']=$this->_post('tel');
			$row['address']=$this->_post('address');


			$row['token']=$this->token;
			$row['wecha_id']=$this->wecha_id;
			if (!$row['wecha_id']){
				$row['wecha_id']='null';
			}
			$time=time();
			$row['time']=$time;
			//分别加入3类订单
			$product_cart_model=M('product_cart');
			$row['total']=intval($_POST['quantity']);
			$row['price']=$row['total']*floatval($_POST['price']);
			$row['diningtype']=0;
			$row['productid']=intval($_POST['productid']);
			$row['code']=substr($row['wecha_id'],0,6).$time;
			$row['tableid']=0;
			$row['info']=serialize(array(intval($_POST['productid'])=>array('count'=>$row['total'],'price'=>intval($_POST['price']))));
			$row['groupon']=1;
			$row['dining']=0;
			$paymode = 0;
			if(intval($_POST['payment'])== 1)
			{
				$paymode = 1;//货到付款
			}elseif(intval($_POST['payment'])== 2){
				$paymode = 2;//余额支付
			}else{
				$paymode = 3;//在线支付
			}		
			$row['paymode'] = $paymode;

			$product_cart_model->add($row);
			//。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。。

			$product_model=M('product');
			$product_cart_list_model=M('product_cart_list');
			$product_model->where(array('id'=>intval($_POST['productid'])))->setInc('salecount',$_POST['quantity']);
			$productName = $product_model->where(array('id'=>intval($_POST['productid'])))->getField('name');
			//保存个人信息
			if ($_POST['saveinfo']){
				$userRow=array('tel'=>$row['tel'],'truename'=>$row['truename'],'address'=>$row['address']);
				if ($thisUser){
					$userinfo_model->where(array('id'=>$thisUser['id']))->save($userRow);
				}else {
					$userRow['token']=$this->token;
					$userRow['wecha_id']=$this->wecha_id;
					$userRow['wechaname']='';
					$userRow['qq']=0;
					$userRow['sex']=-1;
					$userRow['age']=0;
					$userRow['birthday']='';
					$userRow['info']='';
					//
					$userRow['total_score']=0;
					$userRow['sign_score']=0;
					$userRow['expend_score']=0;
					$userRow['continuous']=0;
					$userRow['add_expend']=0;
					$userRow['add_expend_time']=0;
					$userRow['live_time']=0;
					$userinfo_model->add($userRow);
				}
			}
			
			$orderName = '团购-'.$productName;

			//是否在线支付
			$pay_code=$this->_post('payment');
			
			if($pay_code == 2)
			{
				$this->success('正在提交中...', U('CardPay/pay', array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'price'=>$row['price'],'from'=>'Groupon','orderName'=>$orderName,'single_orderid'=>$orderid)));
				die;
			}else{
				$this->redirect(U('Pay/'.$pay_code,array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'orderid'=>$orderid,'from'=>'Groupon')));
				die;
			}

		}else {
			$where=array('token'=>$this->token);
			if (isset($_GET['id'])){
				$id=intval($_GET['id']);
				$where['id']=$id;
			}
			$product=$this->product_model->where($where)->find();
			$this->assign('product',$product);
			$this->display('orderCart_'.$this->tplid);
		}
	}
	public function printOrder($orderid){
		$thisOrder=M('product_cart')->where(array('orderid'=>$orderid))->find();
		$msg='';
		$msg=$msg.
		chr(10).'姓名：'.$thisOrder['truename'].
		chr(10).'电话：'.$thisOrder['tel'].
		chr(10).'地址：'.$thisOrder['address'].
		chr(10).'下单时间：'.date('Y-m-d H:i:s',$thisOrder['time']).
		chr(10).'配送时间:'.$thisOrder['buytime'].
		chr(10).'*******************************'.
		chr(10).$product_list.
		chr(10).'*******************************'.
		chr(10).'品种数量：'.$thisOrder['total'].
		chr(10).'合计：'.$thisOrder['price'].'元'.
		chr(10).'※※※※※※※※※※※※※※'.
		chr(10).'谢谢惠顾，欢迎下次光临'.
		chr(10).'订单编号：'.$thisOrder['orderid'];
		$op=new orderPrint();
		$op->printit($this->token,0,'Store',$msg);
	}
	public function deleteOrder(){
		$this->noaccess();
		$product_model=M('product');
		$product_cart_model=M('product_cart');
		$product_cart_list_model=M('product_cart_list');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['wecha_id']!=$this->wecha_id||$thisOrder['handled']==1){
			exit();
		}
		//
		//删除订单和订单列表
		$product_cart_model->where(array('id'=>$id))->delete();
		$product_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$product_model->where(array('id'=>$k))->setDec('salecount',$thisOrder['total']);
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
	public function orderDetail(){
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);

		//
		$product_cart_model=M('product_cart');
		$thisOrder=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>intval($_GET['id'])))->find();

		//
		$product_model=M('product');
		$thisProduct=$product_model->where(array('id'=>$thisOrder['productid']))->find();
		$this->assign('thisProduct',$thisProduct);
		//
		if (!$thisOrder['paid']&&$payment&&!$thisOrder['handled']){
			$thisOrder['needPay']=1;
		}else {
			$thisOrder['needPay']=0;
		}
		$this->assign('thisOrder',$thisOrder);
		$this->assign('hideTopButton',1);
		//
		$this->display('orderDetail_'.$this->tplid);
	}
	public function company($display=1){
		//店铺信息
		$company_model=M('Company');
		$where=array('token'=>$this->token);
		if (isset($_GET['companyid'])){
			$where['id']=intval($_GET['companyid']);
		}
		
		$thisCompany=$company_model->where($where)->find();
		$this->assign('thisCompany',$thisCompany);
		//分店信息
		$branchStores=$company_model->where(array('token'=>$this->token,'isbranch'=>1))->order('taxis ASC')->select();
		$branchStoreCount=count($branchStores);
		$this->assign('branchStoreCount',$branchStoreCount);
		$this->assign('branchStores',$branchStores);
		$this->assign('metaTitle','公司信息');
		if($display){
			$this->display('company_'.$this->tplid);
		}
	}
	public function companyMap(){
		$this->apikey=C('baidu_map_api');
		$this->assign('apikey',$this->apikey);
		$this->company(0);
		$this->assign('hideTopButton',1);
		$this->display('companyMap_'.$this->tplid);
	}
	public function handle(){
		$this->noaccess();
		$product_cart_model=M('product_cart');
		if (IS_POST){
			$staff_db=M('Company_staff');
			$thisStaff=$staff_db->where(array('username'=>$this->_post('username'),'token'=>$this->_get('token')))->find();
			if (!$thisStaff){
				echo'{"success":-4,"msg":"用户名和密码不匹配"}';
				exit();
			}else {
				if (md5($this->_post('password'))!=$thisStaff['password']){
					echo'{"success":-4,"msg":"用户名和密码不匹配"}';
					exit();
				}else {
					$now=time();
					$arr['handleduid']=$thisStaff['id'];
					$arr['handledtime']=$time;
					$arr['handled']=1;
					$arr['sent']=1;
					//
					$product_cart_model->where(array('id'=>intval($_POST['id'])))->save($arr);
					echo'{"success":1,"msg":"处理成功"}';
					exit();
				}
			}
			//
		}else{
			//是否支持在线支付
			$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
			$this->assign('payment',$payment);

			//
			
			$thisOrder=$product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>intval($_GET['id'])))->find();

			//
			$product_model=M('product');
			$thisProduct=$product_model->where(array('id'=>$thisOrder['productid']))->find();
			$this->assign('thisProduct',$thisProduct);
			//
			if (!$thisOrder['paid']&&$payment&&!$thisOrder['handled']){
				$thisOrder['needPay']=1;
			}else {
				$thisOrder['needPay']=0;
			}
			$this->assign('thisOrder',$thisOrder);
			$this->assign('hideTopButton',1);
			$this->display('handle_'.$this->tplid);
		}
	}
	function randStr($randLength){
		$randLength=intval($randLength);
		$chars='abcdefghjkmnpqrstuvwxyz';
		$len=strlen($chars);
		$randStr='';
		for ($i=0;$i<$randLength;$i++){
			$randStr.=$chars[rand(0,$len-1)];
		}
		return $randStr;
	}
	public function payReturn(){
		$this->noaccess();
		$product_cart_model=M('product_cart');
		$out_trade_no=$_GET['orderid'];
		$order=$product_cart_model->where(array('orderid'=>$out_trade_no))->find();
		if (!$this->wecha_id){
			$this->wecha_id=$order['wecha_id'];
		}
		$sepOrder=0;
		if (!$order){
			$order=$product_cart_model->where(array('id'=>$out_trade_no))->find();
			$sepOrder=1;
		}
		if($order){
			if($order['paid']!=1){exit('该订单还未支付');}
			/************************************************/
			$setting = M('Product_setting')->where(array('token' => $order['token'],'groupon'=>1))->find();
			//短信通知			
			if($setting['phone_status'])
			{
				$content=$this->product_sms_email_content($this->wecha_id,1,0);
				Sms::sendSms($order['token'],$content,$setting['phone']);
			}
			//print_r($content);die();

			//邮件通知
			if($setting['email_status'])
			{
				$content=$this->product_sms_email_content($this->wecha_id,1,0,1);
				Sms::send_email($order['token'],"恭喜您有新的团购订单，请及时查收！",$content,$setting['email']);
			}				
			//打印小票
			if($setting['print_status'])
			{
				if($setting['printtype']=='feiyin')
				{
					$content=$this->product_print_content($this->wecha_id,1,0,0);
					define('MEMBER_CODE', $setting['memberCode']);
					define('FEYIN_KEY', $setting['feiyin_key']);
					define('DEVICE_NO', $setting['deviceNo']);
					define('Page',$setting['printpage']);
					define('FEYIN_HOST','my.feyin.net');
					define('FEYIN_PORT', 80);
					$str=$content;
					if(intval(Page))
					{		
						for ($i=1; $i<Page; $i++)
						{							
							$str.='<br><br><br><br><br>'.$str;
						}
					}
					$msgInfo=array(
						'memberCode'=>MEMBER_CODE,
						'msgDetail'=>$str,
						'deviceNo'=>DEVICE_NO,
						'msgNo'=>time()+1,
						'reqTime' => number_format(1000*time(), 0, '', '')
					);
					$content = $msgInfo['memberCode'].$msgInfo['msgDetail'].$msgInfo['deviceNo'].$msgInfo['msgNo'].$msgInfo['reqTime'].FEYIN_KEY;
					$msgInfo['securityCode'] = md5($content);
					$msgInfo['mode']=2;
					$client = new HttpClient('my.feyin.net');
					if($client->post('/api/sendMsg',$msgInfo)){
						$printstate=$client->getContent();
					}
				}
				if($setting['printtype']=='laoyang')
				{
					if($setting['bwdeviceNo'])
					{
						$url = 'http://115.28.141.183:60002';//POST指向的API链接 
						$content=$this->product_print_content($this->wecha_id,1,0,1);	

						define('DEVICE_NO', $setting['bwdeviceNo']);
						define('Page',$setting['printpage']);
						$str=$content;
						$msgInfo=array(
							'dingdanID'=>'dingdanID='.$orderid, //订单号
							'dayinjisn'=>'dayinjisn='.DEVICE_NO, //打印机ID号
							'dingdan'=>'dingdan='.$str, //订单内容
							'pages'=>'pages='.Page, //联数 
							'replyURL'=>'replyURL='.C('site_url').'/index.php?g=Wap&m=Printreply&a=return_url&token='.$this->token.'&out_trade_no='.$orderid
							); //回复确认URL   						
						$post_data = implode('&',$msgInfo);		//print_r($post_data);die();				
						$result = $this->postData($url, $post_data);     
						$array = json_decode($result,true);   
					}	
					if($setting['bwdeviceNo1'])
					{
						$url = 'http://115.28.141.183:60002';//POST指向的API链接 
						$content=$this->product_print_content($this->wecha_id,1,0,1);	

						define('DEVICE_NO1', $setting['bwdeviceNo1']);
						define('Page',$setting['printpage']);
						$str=$content;
						$msgInfo=array(
							'dingdanID'=>'dingdanID='.$orderid, //订单号
							'dayinjisn'=>'dayinjisn='.DEVICE_NO1, //打印机ID号
							'dingdan'=>'dingdan='.$str, //订单内容
							'pages'=>'pages='.Page, //联数 
							'replyURL'=>'replyURL='.C('site_url').'/index.php?g=Wap&m=Printreply&a=return_url&token='.$this->token.'&out_trade_no='.$orderid
							); //回复确认URL   						
						$post_data = implode('&',$msgInfo);		//print_r($post_data);die();				
						$result = $this->postData($url, $post_data);     
						$array = json_decode($result,true);   
					}
					if($setting['bwdeviceNo2'])
					{
						$url = 'http://115.28.141.183:60002';//POST指向的API链接 
						$content=$this->product_print_content($this->wecha_id,1,0,1);	

						define('DEVICE_NO2', $setting['bwdeviceNo2']);
						define('Page',$setting['printpage']);
						$str=$content;
						$msgInfo=array(
							'dingdanID'=>'dingdanID='.$orderid, //订单号
							'dayinjisn'=>'dayinjisn='.DEVICE_NO2, //打印机ID号
							'dingdan'=>'dingdan='.$str, //订单内容
							'pages'=>'pages='.Page, //联数 
							'replyURL'=>'replyURL='.C('site_url').'/index.php?g=Wap&m=Printreply&a=return_url&token='.$this->token.'&out_trade_no='.$orderid
							); //回复确认URL   						
						$post_data = implode('&',$msgInfo);		//print_r($post_data);die();				
						$result = $this->postData($url, $post_data);     
						$array = json_decode($result,true);   
					}		
				}
			}	
			/************************************************/
			if($this->tplid == 0){
				$this->redirect('/index.php?g=Wap&m=Groupon&a=myOrders&token='.$order['token'].'&wecha_id='.$order['wecha_id']);
			}else{
				
				$this->redirect('/index.php?g=Wap&m=Product&a=my&token='.$order['token'].'&wecha_id='.$order['wecha_id']);
			}
			
		}else{
			exit('订单不存在：'.$out_trade_no);
		}
	}
	
	public function product_sms_email_content($wecha_id,$isgroupon,$dining,$email){
		$where['token']=$this->token;
		$where['wecha_id']=$wecha_id;
		$where['groupon']=$isgroupon;
		$br="\r\n";
		if($email==1)
		{
			$br="<br>";
		}
		$this->product_model=M('product');
		if($dining==1)
		{
			$this->product_model=M('dining');
		}		
		$this->product_cart_model=M('product_cart');
		$count      = $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$thisuser_allorder=$this->product_cart_model->where(array('wecha_id'=>$wecha_id,'token'=>$this->token))->count();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['diningtype']){
				case 0:
					$orderType='购物';
					if($thisOrder['groupon']==1)
					{
						$orderType='团购';
					}
					break;
				case 1:
					$orderType='点餐';
					break;
				case 2:
					$orderType='外卖';
					break;
				case 3:
					$orderType='预定';
					break;
			}
			if($dining==1)
			{
				//订餐信息
				$product_diningtable_model=M('dining_diningtable');
				if ($thisOrder['tableid']) {
					$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
					$thisOrder['tableName']=$thisTable['name'];
				}else{
					$thisOrder['tableName']='未指定';
				}
				$str.="订单类型：".$orderType.$br."订单编号：".$thisOrder['orderid'].$br."姓名：".$thisOrder['truename'].$br."电话：".$thisOrder['tel'].$br."地址：".$thisOrder['address'].$br."桌台：".$thisOrder['tableName'].$br."下单时间：".date('Y-m-d H:i:s',$thisOrder['time']).$br."历史下单：".$thisuser_allorder."次".$br."留言：".$thisOrder['beizhu'].$br."订单详情：".$br."";
			}else{
				$str="订单类型：".$orderType.$br."订单编号：".$thisOrder['orderid'].$br."姓名：".$thisOrder['truename'].$br."电话：".$thisOrder['tel'].$br."地址：".$thisOrder['address'].$br."下单时间：".date('Y-m-d H:i:s',$thisOrder['time']).$br."历史下单：".$thisuser_allorder."次".$br."订单详情：".$br."";
			}
			//订单详情
			$carts=unserialize($thisOrder['info']);
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts as $k=>$c){
				if (is_array($c)){
					$productid=$k;
					$price=$c['price'];
					$count=$c['count'];
					//
					if (!in_array($productid,$ids)){
						array_push($ids,$productid);
					}
					$totalFee+=$price*$count;
					$totalCount+=$count;
				}
			}
			if (count($ids)){
				$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str.=$p['name']."*".$products[$i]['count']."  单价：".$p['price']."元".$br;
					$i++;
				}
			}
			$str.="合计：".$thisOrder['price']."元";
			return $str;
		}else {
			return '';
		}
	}
	//订单内容
	public function product_print_content($wecha_id,$isgroupon,$dining,$laoyang){
		$where['token']=$this->token;
		$where['wecha_id']=$wecha_id;
		$where['printed']=0;
		$where['groupon']=$isgroupon;
		$this->product_model=M('product');
		$br="<br>";
		if($laoyang==1)
		{
			$br="<0D0A>";
		}
		if($dining==1)
		{
			$this->product_model=M('dining');
		}
		$this->product_cart_model=M('product_cart');
		$count= $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$thisuser_allorder=$this->product_cart_model->where(array('wecha_id'=>$wecha_id,'token'=>$this->token))->count();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['diningtype']){
				case 0:
					$orderType='购物';
					if($thisOrder['groupon']==1)
					{
						$orderType='团购';
					}
					break;
				case 1:
					$orderType='点餐';
					break;
				case 2:
					$orderType='外卖';
					break;
				case 3:
					$orderType='预定';
					break;
			}

			$info=M('wxuser')->where(array('token'=>$this->token))->find();
			$str="欢迎使用".$info['wxname']."打印系统<br>";
			if($laoyang==1)
			{
				$str="<1B40><1B40><1B40>欢迎使用".$info['wxname']."打印系统<0D0A>";
			}
			if($dining==1)
			{
				//订餐信息
				$product_diningtable_model=M('dining_diningtable');
				if ($thisOrder['tableid']) {
					$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
					$thisOrder['tableName']=$thisTable['name'];
				}else{
					$thisOrder['tableName']='未指定';
				}
				$str.="订单类型：".$orderType.$br."订单编号：".$thisOrder['orderid'].$br."姓名：".$thisOrder['truename'].$br."电话：".$thisOrder['tel'].$br."地址：".$thisOrder['address'].$br."桌台：".$thisOrder['tableName'].$br."下单时间：".date('Y-m-d H:i:s',$thisOrder['time']).$br."历史下单：".$thisuser_allorder."次".$br."留言：".$thisOrder['beizhu'].$br."订单详情：".$br."--------------------------------".$br."";
			}else{
				$str.="订单类型：".$orderType.$br."订单编号：".$thisOrder['orderid'].$br."姓名：".$thisOrder['truename'].$br."电话：".$thisOrder['tel'].$br."地址：".$thisOrder['address'].$br."下单时间：".date('Y-m-d H:i:s',$thisOrder['time']).$br."历史下单：".$thisuser_allorder."次".$br."订单详情：".$br."--------------------------------".$br."";
			}
			
			//订单详情
			$carts=unserialize($thisOrder['info']);
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts as $k=>$c){
				if (is_array($c)){
					$productid=$k;
					$price=$c['price'];
					$count=$c['count'];
					if (!in_array($productid,$ids)){
						array_push($ids,$productid);
					}
					$totalFee +=$price*$count;
					$totalCount +=$count;
				}
			}
			if (count($ids)){
				$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
			}
			if ($products){
				$i=0;
				foreach ($products as $p){
					$products[$i]['count']=$carts[$p['id']]['count'];
					$str .=$p['name']."*".$products[$i]['count']."  单价：".$p['price']."元".$br."";
					$i++;
				}
			}
			if($laoyang==1)
			{
				$str .="--------------------------------<0D0A>合计：".$thisOrder['price']."元<0D0A>--------------------------------<0D0A>谢谢惠顾，欢迎下次光临<0D0A><0D0A><0D0A><0D0A><0D0A><0D0A>";
			}else{
				$str .="\n------------------------------</br>合计：".$thisOrder['price']."元</br>------------------------------</br>谢谢惠顾，欢迎下次光临";
			}
			return $str;
		}else {
			return '';
		}
	}
	public function postData($url, $data)      
	{      
		$ch = curl_init();      
		$timeout = 300;
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转 （很重要）     
		curl_setopt($ch, CURLOPT_URL, $url);     
		curl_setopt($ch, CURLOPT_REFERER, "http://115.28.141.183:60002");   //构造来路    
		curl_setopt($ch, CURLOPT_POST, true);      
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);      
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);      
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
		//ob_start();
		$handles = curl_exec($ch);  //获取返回结果 
		//$result = ob_get_contents() ;  
		//ob_end_clean();  
		//close connection 
		curl_close($ch);      
		//return $result;   
		return $handles;      
	}	
	public function noaccess(){
		if (!$this->wecha_id){
			$this->error('您无权参与，请关注微信号“'.$this->wxuser['wxname'].'”，然后回复“团购”便可进行',U('Groupon/grouponIndex',array('token'=>$order['token'])));
		}
	}
}
	
?>