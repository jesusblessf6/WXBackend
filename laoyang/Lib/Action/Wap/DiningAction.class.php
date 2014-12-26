<?php
class DiningAction extends WapAction{
	public $token;
	public $wecha_id;
	public $dining_model;
	public $dining_cat_model;
	public $isDining;
	public $storeid;
	public $thisCompany;
	public function __construct(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"MicroMessenger")) {
		//	echo '此功能只能在微信浏览器中使用';exit;
		}
		
		$this->token		= $this->_get('token');
		$this->assign('token',$this->token);
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='';
		}
		$this->assign('wecha_id',$this->wecha_id);
		$this->dining_model=M('Dining');
		$this->dining_cat_model=M('Dining_cat');
		
		$this->assign('staticFilePath',str_replace('./','/',THEME_PATH.'common/weidingcan'));
		//订单类型
		if (isset($_GET['dtype'])){
			$dtype=$this->_get('dtype');
			$_SESSION['dtype']=$dtype;
		}else{
			$dtype=$_SESSION['dtype'];
		}
		$this->assign('dtype',$dtype);
		//是否是餐饮
		$this->isDining=1;
		$this->assign('isDining',1);
		//公司信息
		if (isset($_GET['setid'])){
			$setid=$this->_get('setid');
			$_SESSION['setid']=$setid;
		}else{
			$setid=$_SESSION['setid'];
		}
		$company_model=M('Dining_company');
		$this->thisCompany=$company_model->where(array('token'=>$this->token,'id'=>$_GET['setid']))->find();
		$this->assign('thisCompany',$this->thisCompany);
		if($setid){
			$this->assign('setid',$setid);
			//店铺信息
			$setinfos=$company_model->where(array('id'=>$setid))->find();
			$this->storeid=$setinfos['catid'];
			$this->company=M('Company')->where(array('id'=>$setinfos['catid']))->find();
			//如果是分店
			if($this->company['isbranch']){
				$this->top_company=M('Company')->where(array('id'=>$setinfos['catid'],'isbranch'=>0))->find();
			}
			$metaTitle=$this->company;
			$this->assign('company',$this->company);
			$this->assign('top_company',$this->top_company);
			$this->assign('setinfos',$setinfos);
		}
	
	}
	function remove_html_tag($str){  //清除HTML代码、空格、回车换行符
		//trim 去掉字串两端的空格
		//strip_tags 删除HTML元素

		$str = trim($str);
		$str = @preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $str);
		$str = @preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $str);
		$str = @strip_tags($str,"");
		$str = @ereg_replace("\t","",$str);
		$str = @ereg_replace("\r\n","",$str);
		$str = @ereg_replace("\r","",$str);
		$str = @ereg_replace("\n","",$str);
		$str = @ereg_replace(" ","",$str);
		$str = @ereg_replace("&nbsp;","",$str);
		return trim($str);
	}
	public function cats(){
		$catWhere=array('parentid'=>0,'token'=>$this->token,'storeid'=>$this->storeid);
		if (isset($_GET['parentid'])){
			$parentid=intval($_GET['parentid']);
			$catWhere['parentid']=$parentid;
			
			$thisCat=$this->dining_cat_model->where(array('id'=>$parentid))->find();
			$this->assign('thisCat',$thisCat);
			$this->assign('parentid',$parentid);
		}
		$cats = $this->dining_cat_model->where($catWhere)->order('id asc')->select();
		$this->assign('cats',$cats);
		$where=array('token'=>$this->token,'storeid'=>$this->storeid);
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid']=$catid;
			
			$thisCat=$this->dining_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat',$thisCat);
			
			if (IS_POST){
				$key = $this->_post('search_name');
				$url=U('Dining/cats',array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'keyword'=>$key));
				$this->redirect($url);
			}
			if (isset($_GET['keyword'])){
				$where['name|intro|keyword'] = array('like',"%".$_GET['keyword']."%");
				$this->assign('isSearch',1);
			}
			$count = $this->dining_model->where($where)->count();
			$this->assign('count',$count); 
			//排序方式
			$method=isset($_GET['method'])&&($_GET['method']=='DESC'||$_GET['method']=='ASC')?$_GET['method']:'DESC';
			$orders=array('time','discount','price','salecount');
			$order=isset($_GET['order'])&&in_array($_GET['order'],$orders)?$_GET['order']:'time';
			$this->assign('order',$order);
			$this->assign('method',$method);
			//
			$products = $this->dining_model->where($where)->order($order.' '.$method)->select();
		}else{
			if($cats)
			{
				//存在分类，默认显示第一个分类的数据
				$where1['catid']=$cats[0]['id'];
				$where1['token']=$this->token;
				$products = $this->dining_model->where($where1)->select();
			}
			else
			{
				$products = $this->dining_model->where($where)->select();
			}

		}
		//格式化简介
		foreach($products as $k=>$v){
			$products[$k]['intro']=$this->remove_html_tag($v['intro']);
		}
		$this->assign('products',$products);
		$metaTitle2=$this->metaTitle;
		$metaTitle=$metaTitle2['name'];
		$this->assign('metaTitle',$metaTitle);
		
		$this->display('caipu');
	}
	public function header(){
			$this->display();
	}
	
	public function about(){
		//店铺信息

		$Company=M('Company')->where(array('token'=>$this->token,'id'=>$this->thisCompany['catid']))->find();
		$this->assign('thisCompany',$this->thisCompany);
		$this->assign('Company',$Company);

		$this->assign('metaTitle',"店铺介绍");
		
		//轮换图
		$flash=M('Flash')->where($where)->select();
		$count=count($flash);
		$this->assign('flash',$flash);
		
		
		$this->display('dianpujieshao');
		
	}

	public function calCartInfo($carts=''){
		$totalFee=0;
		$totalCount=0;
		if (!$carts){
			if (!isset($_SESSION['session_cart_products'])||!strlen($_SESSION['session_cart_products'])){
			$carts=array();
			}else {
			$carts=unserialize($_SESSION['session_cart_products']);
			}
		}
		if ($carts){
			foreach ($carts as $c){
				if ($c){
					$totalFee+=floatval($c['price'])*$c['count'];
					$totalCount+=intval($c['count']);
				}
			}
		}
		return array($totalCount,$totalFee);
	}
	function _getCart(){
		if (!isset($_SESSION['session_cart_products'])||!strlen($_SESSION['session_cart_products'])){
			$carts=array();
		}else {
			$carts=unserialize($_SESSION['session_cart_products']);
		}
		return $carts;
	}
	public function cart(){
		$totalFee=0;
		$totalCount=0;
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
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
			$list=$this->dining_model->where(array('id'=>array('in',$ids)))->select();
		}
		//判断是不是餐饮
		
		if ($list){
			$i=0;
			foreach ($list as $p){
				$list[$i]['count']=$carts[$p['id']]['count'];
				
				$i++;
			}
		}
		
		$this->assign('products',$list);
		//是否余额支付
		$user= M('Userinfo')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('yuer',$user['balance']);
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);
		//获取个人信息
		$userinfo_model=M('Userinfo');
		$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('thisUser',$thisUser);
		//获取时间
		$diningConfig =M('Reply_info')->where(array('infotype'=>'Dining','token'=>$this->token))->find();
		$this->assign('diningConfig',$diningConfig);
		//可以预定多少天内的
		$diningConfigDetail=unserialize($diningConfig['config']);
		if (!$diningConfigDetail||!$diningConfigDetail['yudingdays']){
			$days=7;
		}else {
			$days=$diningConfigDetail['yudingdays'];
		}
		$time=time();
		$secondsOfDay=24*60*60;
		$dateTimes=array();
		for ($i=0;$i<$days;$i++){
			array_push($dateTimes,$time+$i*$secondsOfDay);
		}
		$this->assign('dateTimes',$dateTimes);
		//
		$orderHour=date('H',$time);
		$this->assign('orderHour',$orderHour);
		$hours=array();
		for ($i=0;$i<24;$i++){
			array_push($hours,$i);
		}
		$this->assign('hours',$hours);
		
		//获取桌台信息
		$dining_diningtable_model=M('Dining_diningtable');
		$tables=$dining_diningtable_model->where(array('token'=>$_GET['token'],'storeid'=>$this->storeid))->order('taxis ASC')->select();
		$this->assign('tables',$tables);
		//
		$this->assign('totalCount',$totalCount);
		$this->assign('totalFee',$totalFee);
		
		$_SESSION['formhash']=md5($time);
		$this->assign('formhash',md5($time));
		
		$this->assign('metaTitle',"下订单");
		$this->display('gouwuche');
	}
	public function dingdanpost(){
			//查询当前会员信息
			$userinfo_model=M('Userinfo');
			$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			$this->assign('thisUser',$thisUser);
			
			//提交
			if (IS_POST){
				//商品信息
				$goodsData=$this->_post('goodsData');

				$arr = array_filter(explode(';',$goodsData));
				if(empty($arr)){
					$this->error('购物车为空！');
				}
				foreach ($arr as $k=>$v){
						$p = explode(',',$v);
						$carts[$p[0]]=array('count'=>$p[2],'price'=>$p[1],'catid'=>$p[0]);
				}
				//订单信息
				$totalFee=$this->_post('price');
				$productids=array();
				foreach ($carts as $k=>$c){
					array_push($productids,$k);
				}
				//订单号
				$orderid=date("YmdHis").rand(1000,2000);
				$row=array();
				$row['diningtype']=$this->_post('diningtype');
				$row['orderid']=$orderid;
				//联系资料
				$row['truename']=$this->_post('truename');
				$row['tel']=$this->_post('tel');
				$row['address']=$this->_post('address');
				$row['beizhu']=$this->_post('beizhu');
				$row['token']=$this->token;
				$row['wecha_id']=$this->wecha_id;
				
				//支付方式
				$row['payment']=$this->_post('payment');
				$buytimestamp=$this->_post('buytimestamp');//购买时间
				if ($buytimestamp){
					$row['year']=date('Y',$buytimestamp);
					$row['month']=date('m',$buytimestamp);
					$row['day']=date('d',$buytimestamp);
					$row['hour']=$this->_post('hour');
					$row['mini']=$this->_post('mini');
				}
				$row['time']=time();
				
				//加入订餐订单
				$dining_cart_model=M('Product_cart');;
				$calCartInfo=$this->calCartInfo($carts);
				$row['total']=$calCartInfo[0];
				$row['price']=$calCartInfo[1];
				//
				$row['diningtype']=intval($this->_post('diningtype'));
				$row['buytime']=$buytimestamp?$row['month'].'月'.$row['day'].'日'.$row['hour'].'点'.$row['mini'].'分':'';
				$row['tableid']=intval($this->_post('tableid'));
				$row['info']=serialize($carts);
				//
				$row['groupon']=0;
				$row['dining']=1;
				$row['diningshopid']=$this->thisCompany['id'];
				$order_id=$dining_cart_model->add($row);
				if(empty($order_id)){
					$this->error('订单提交失败');
				}
				//订单商品列表
				$dining_model=M('Dining');
				$dining_cart_list_model=M('Product_cart_list');
				$crow=array();
				foreach ($carts as $k=>$c){
					$crow['cartid']=$order_id;
					$crow['productid']=$k;
					$crow['price']=$c['price'];
					$crow['total']=$c['count'];
					$crow['wecha_id']=$row['wecha_id'];
					$crow['token']=$row['token'];
					$crow['time']=time();
					$dining_cart_list_model->add($crow);
					$dining_model->where(array('id'=>$k))->setInc('salecount',$c['count']);
				}
				//保存个人信息
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
					$userRow['total_score']=0;
					$userRow['sign_score']=0;
					$userRow['expend_score']=0;
					$userRow['continuous']=0;
					$userRow['add_expend']=0;
					$userRow['add_expend_time']=0;
					$userRow['live_time']=0;
					$userinfo_model->add($userRow);
				}

				//在线支付
				$pay_code=$this->_post('payment');
				
				if($pay_code == 2)
				{
					$this->success('正在提交中...', U('CardPay/pay', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Dining', 'orderName' => "餐饮下单", 'single_orderid' => $orderid, 'price' => $totalFee)));
					die;
				}elseif ($pay_code == 1)
				{
					$this->redirect(U("Dining/payReturn",array('orderid'=>$orderid,'token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>$id,'paytype'=>'other')));die();
				}
				else{
					$this->redirect(U('Pay/'.$pay_code,array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'orderid'=>$orderid,'from'=>'Dining')));
					die;
				}
				
			}
		}
	
	public function my(){
		if(IS_POST){
			$row['wechaname']=$this->_post('wechaname');
			$row['truename']=$this->_post('truename');
			$row['tel']=$this->_post('tel');
			$row['address']=$this->_post('address');
			
			$row['token']=$this->token;
			$row['wecha_id']=$this->wecha_id;
			if (!$row['wecha_id']){
				$row['wecha_id']='null';
			}
			$userinfo_model=M('Userinfo');
			$where=array('token'=>$this->token,'wecha_id'=>$this->wecha_id);
			if($where){
			$thisUser=$userinfo_model->where($where)->save($row);
			}else{
				$thisUser=$userinfo_model->where($where)->add($row);
				}
			if($thisUser){
				$this->success('成功',U('Dining/my',array('token'=>$this->token,'wecha_id'=>$this->wecha_id)));
			}else{
				$this->error('操作失败，请稍候再试');
			}
		}else{
			$userinfo_model=M('Userinfo');
			$thisUser=$userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			$this->assign('thisUser',$thisUser);
			
			//$this->assign('metaTitle','我的资料');
			$metaTitle2=$this->metaTitle;
			$metaTitle=$metaTitle2['name'];
			$this->assign('metaTitle',$metaTitle);
			
			$this->display('gerenziliao');
		}
		
	}
	public function dingdan(){
		$dining_cart_model=M('Product_cart');;
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['_string'] = 'dining=1 AND groupon=0';
		$orders=$dining_cart_model->where($where)->order('time DESC')->select();
		
		$this->assign('orders',$orders);
		$this->assign('ordersCount',count($orders));
		$this->assign('metaTitle','我的订单');
		$this->display('dingdan');
	}
	public function xiangqing(){
		$dining_cart_model=M('Product_cart');;
		$thisOrder=$dining_cart_model->where(array('id'=>intval($_GET['id']),'wecha_id'=>$this->wecha_id))->find();
		$this->assign('thisOrder',$thisOrder);
		$dining_diningtable_model=M('Dining_diningtable');
		$tables=$dining_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
		$this->assign('tables',$tables);
		
		$carts=unserialize($thisOrder['info']);
		$totalFee=$thisOrder['price'];
		$totalCount=$thisOrder['total'];
		$products=array();
		$ids=array();
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				if (!in_array($productid,$ids)){
					array_push($ids,$productid);
				}
			}
		}
		if (count($ids)){
			$list=$this->dining_model->where(array('id'=>array('in',$ids)))->select();
		}
		if ($list){
			$i=0;
			foreach ($list as $p){
				$list[$i]['count']=$carts[$p['id']]['count'];
				if ($i==0){
					$orderName=$p['name'];
				}else{
					$orderName .="|".$p['name'];
				}$i++;
			}
		}
		$this->assign('products',$list);
		$this->assign('totalFee',$totalFee);
		$this->assign('orderName',$orderName);
		$this->assign('totalCount',$totalCount);
		$this->assign('metaTitle','订单详情');		
		$this->display('xiangqing');
	}
	public function deleteOrder(){
		$dining_model=M('Dining');
		$dining_cart_model=M('Product_cart');;
		$dining_cart_list_model=M('Product_cart_list');
		$dining=$_GET['dining'];
		$thisOrder=$dining_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['wecha_id'] !=$this->wecha_id || $thisOrder['handled']==1){
			$this->error('操作失败，请稍候再试');
		}
		//
		//删除订单和订单列表
		$dining_cart_model->where(array('id'=>$id))->delete();
		$dining_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$carts=unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				$dining_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		
		$this->redirect(U('Dining/dingdan',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'],'dining'=>1)));
		
		
	}
	public function index(){
		//查询总店信息
		$Company=M('Company')->where(array('token'=>$this->token,'isbranch'=>0))->find();
		//查询首页配置
		$Reply_info=M('Reply_info')->where(array('token'=>$this->token,'infotype'=>'Dining'))->find();
		
		$this->assign('logourl',$Company['logourl']);
		$this->assign('homepic',$Reply_info['homepic']);
		$this->assign('metaTitle','订餐首页');
		$this->display('index');
	}
	public function stores(){
		$token_open=M('token_open')->field('queryname')->where(array('token'=>$this->token))->find();
		$this->assign('diningOpen',1);
		if(!strpos($token_open['queryname'],'dx')){
            $this->assign('diningOpen',0);
		}
		$company_model=M('Dining_company');		
		$branchStores=$company_model->where(array('token'=>$this->token))->select();
		foreach ($branchStores as $k=>$c){
			$catid=$c['catid'];
			$thisCompany=M('Company')->where(array('id'=>$catid))->find();
			$branchStores[$k]['name']=$thisCompany['name'];
			$branchStores[$k]['logourl']=$thisCompany['logourl'];
			$branchStores[$k]['tel']=$thisCompany['tel'];
			$branchStores[$k]['latitude']=$thisCompany['latitude'];
			$branchStores[$k]['longitude']=$thisCompany['longitude'];
			$branchStores[$k]['address']=$thisCompany['address'];
		}
		$branchStoreCount=count($branchStores);	
		$this->assign('branchStoreCount',$branchStoreCount);
		$this->assign('branchStores',$branchStores);
		$this->assign('metaTitle','店铺列表');
		$this->display('shangjiaxinxi');
	}
	public function dining(){
		//是否外卖预定等
		$diningConfig =M('Reply_info')->where(array('infotype'=>'Dining','token'=>$this->token))->find();
		$this->assign('diningConfig',$diningConfig);
		//$this->assign('metaTitle','订餐');
		$metaTitle2=$this->metaTitle;
		$metaTitle=$metaTitle2['name'];
		$this->assign('metaTitle',$metaTitle);
		
		$this->display();
	}
	
	/**
	 * 检查某时间段内是否已经有和桌子被预定
	 *
	 */
	public function ajaxTables(){
		$token=$this->_get('token');
		$time=$this->_get('time');
		$hour=intval($this->_get('hour'));
		$year=date('Y',$time);
		$month=date('m',$time);
		$day=date('d',$time);
		$occupiedTables=array();
		$dining_cart_model=M('Product_cart');;
		$otableWhere=array();
		$otableWhere['token']=$token;
		$otableWhere['hour']=array('between',array($hour-3,$hour+3));//三个小时内不能再定
		$otableWhere['year']=$year;
		$otableWhere['month']=$month;
		$otableWhere['day']=$day;
		$otables=$dining_cart_model->where($otableWhere)->select();
		$str='';
		$comma='';
		if ($otables){
			foreach ($otables as $t){
				if (!in_array($t['tableid'],$occupiedTables)){
					$str.=$comma.$t['tableid'];
					array_push($occupiedTables,$t['tableid']);
					$comma=',';
				}
			}
		}
		echo $str;
	}
	//模拟post提交
	public function api_curl_post($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
			return false;
		}else{

			return true;
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
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
	   $orderid = $_GET['orderid'];
	   $paytype = $_GET['paytype'];
	   if ($order = M('Product_cart')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			if (!$this->wecha_id){
				$this->wecha_id=$order['wecha_id'];
			}
			if ($order['paid']||$paytype=="other") {
				$setting = M('dining_company')->where(array('token' => $this->token,'id'=>$order['diningshopid']))->find();

				//短信通知			
				if($setting['phone_status'])
				{
					$content=$this->product_sms_email_content($this->wecha_id,0,1,0);
					Sms::sendSms($this->token,$content,$setting['phone']);
				}
				//print_r($content);die();

				//邮件通知
				if($setting['email_status'])
				{
					
					$content=$this->product_sms_email_content($this->wecha_id,0,1,1);
					Sms::send_email($this->token,"恭喜您有新的订单，请及时查收！",$content,$setting['email']);
				}				
				//打印小票
				if($setting['print_status'])
				{
					if($setting['printtype']=='feiyin')
					{
						$content=$this->product_print_content($this->wecha_id,0,1,0);
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
							$url = 'http://125.28.141.183:60002';//POST指向的API链接 
							$content=$this->product_print_content($this->wecha_id,0,1,1);

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
							$url = 'http://125.28.141.183:60002';//POST指向的API链接 
							$content=$this->product_print_content($this->wecha_id,0,1,1);

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
							$url = 'http://125.28.141.183:60002';//POST指向的API链接 
							$content=$this->product_print_content($this->wecha_id,0,1,1);

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
			}
			$this->success('支付成功',U('Dining/dingdan', array('token'=>$this->token, 'wecha_id' => $this->wecha_id)));
	   }else{
	      exit('订单不存在');
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
}
?>