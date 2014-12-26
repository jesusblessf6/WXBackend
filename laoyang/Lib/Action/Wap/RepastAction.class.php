<?php
class RepastAction extends WapAction {
	public $token;
	public $wecha_id = 'gh_aab60b4c5a39';
	
	public $session_dish_info;//
	public $session_dish_user;
	public $_cid = 0;
	
	public function _initialize(){
		parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if (!strpos($agent, "MicroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		
		$this->token = isset($_REQUEST['token']) ? $_REQUEST['token'] : session('token');//$this->_get('token');
		
		$this->assign('token', $this->token);
		$this->wecha_id	= isset($_REQUEST['wecha_id']) ? $_REQUEST['wecha_id'] : '';
		if (!$this->wecha_id){
			$this->wecha_id='';
		}
//		$this->wecha_id = 'gh_aab60b4c5a39';
		$this->assign('wecha_id', $this->wecha_id);
		
		$this->_cid = $_SESSION["session_company_{$this->token}"];
		$this->assign('cid', $this->_cid);
		
		$this->session_dish_info = "session_dish_{$this->_cid}_info_{$this->token}";
		$this->session_dish_user = "session_dish_{$this->_cid}_user_{$this->token}";
		$menu = $this->getDishMenu();
		$count = count($menu);
		$this->assign('totalDishCount', $count);
	}
	
	/**
	 * 餐厅分布
	 */
	public function index() {
		$company = M('Company')->where("`token`='{$this->token}' AND ((`isbranch`=1 AND `display`=1) OR `isbranch`=0)")->select();
		if (count($company) == 1) {
			$this->redirect(U('Repast/select',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $company[0]['id'])));
		}
		$this->assign('company', $company);
		$this->assign('metaTitle', '餐厅分布');
		$this->display();
	}
	
	/**
	 *就餐形式选择页 
	 */
	public function select() {
		$istakeaway = 0;
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		if ($company = M('Company')->where(array('token' => $this->token, 'id' => $cid))->find()) {
			$_SESSION["session_company_{$this->token}"] = $cid;
		} else {
			$this->redirect(U('Repast/index',array('token' => $this->token, 'wecha_id' => $this->wecha_id)));
		}
		
		if ($dishCompany = M('Dish_company')->where(array('cid' => $cid))->find()) {
			$istakeaway = $dishCompany['istakeaway'];
		}
		$this->assign('istakeaway', $istakeaway);
		$this->assign('metaTitle', '点餐选择');
		$this->display();
	}
	
	/**
	 * 餐厅介绍
	 */
	public function virtual() {
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		$company = M('Company')->where(array('token' => $this->token, 'id' => $cid))->find();
		$this->assign('company', $company);
		$this->assign('metaTitle', '餐厅介绍');
		$this->display();
	}
	/**
	 * 选取餐桌与填写个人信息
	 */
	public function selectTable() {
		$thisUser = M('Userinfo')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
		$this->assign('thisUser', $thisUser);
		$takeaway = isset($_GET['takeaway']) ? intval($_GET['takeaway']) : 0;
		$_SESSION[$this->session_dish_user] = null;
		unset($_SESSION[$this->session_dish_user]);
		$time = time();
		$orderTable = M('Dish_table')->where(array('reservetime' => array('elt', $time + 2 * 3600), 'reservetime' => array('egt', $time - 2 * 3600), 'cid' => $this->_cid, 'isuse' => 0))->select();
		$tids = array();
		foreach ($orderTable as $row) {
			$tids[] = $row['tableid'];
		}
		if ($tids) {
			$table = M('Dining_table')->where(array('id' => array('not in', $tids), 'cid' => $this->_cid))->select();
		} else {
			$table = M('Dining_table')->where(array('cid' => $this->_cid))->select();
		}
		
		$dates = array();
		$dates[] = array('k' => date("Y-m-d"), 'v' => date("m月d日"));
		for ($i = 1; $i <= 90; $i ++) {
			$dates[] = array('k' => date("Y-m-d", strtotime("+{$i} days")), 'v' => date("m月d日", strtotime("+{$i} days")));
		}
		$hours = array();
		for ($i = 0; $i < 24; $i ++) {
			$hours[] = array('k' => $i, 'v' => $i . "时");
		}
		
		$seconds = array();
		for ($i = 0; $i < 60; $i ++) {
			$seconds[] = array('k' => $i, 'v' => $i . "分");
		}
		
		$this->assign('dates', $dates);
		$this->assign('seconds', $seconds);
		$this->assign('hours', $hours);
		$this->assign('takeaway', $takeaway);
		$this->assign('tables', $table);
		$this->assign('metaTitle', '填写个人信息');
		$this->assign('time', date("Y-m-d H:i:s"));
		$this->display();
	}
	
	/**
	 * ajax请求获取餐桌信息
	 */
	public function getTable() {
		$date = isset($_POST['redate']) ? htmlspecialchars($_POST['redate']) : '';
		$hour = isset($_POST['rehour']) ? htmlspecialchars($_POST['rehour']) : '';
		$second = isset($_POST['resecond']) ? htmlspecialchars($_POST['resecond']) : '';
		$time = strtotime($date . ' ' . $hour . ':' . $second . ':00');
		$orderTable = M('Dish_table')->where(array('reservetime' => array('elt', $time + 2 * 3600), 'reservetime' => array('egt', $time - 2 * 3600), 'cid' => $this->_cid, 'isuse' => 0))->select();
		$tids = array();
		foreach ($orderTable as $row) {
			$tids[] = $row['tableid'];
		}
		if ($tids) {
			$table = M('Dining_table')->where(array('id' => array('not in', $tids), 'cid' => $this->_cid))->select();
		} else {
			$table = M('Dining_table')->where(array('cid' => $this->_cid))->select();
		}
		exit(json_encode($table));
	}
	
	/**
	 * 保存订餐人的信息到session
	 */
	public function saveUser() {
		$takeaway = isset($_POST['takeaway']) ? intval($_POST['takeaway']) : 0;
		$tel = $table = $address = $des = $name = '';
		$sex = $nums = 1;
		$price = 0;
		if ($takeaway == 1) {
			$dishCompany = M('Dish_company')->where(array('cid' => $this->_cid))->find();
			if (isset($dishCompany['istakeaway']) && $dishCompany['istakeaway']) $price = $dishCompany['price'];
		}
		if ($takeaway != 2) {
			$tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			if (empty($tel)) {
				exit(json_encode(array('success' => 0, 'msg' => '电话号码不能为空')));
			}
			$name = isset($_POST['guest_name']) ? $_POST['guest_name'] : '';
			if (empty($name)) {
				exit(json_encode(array('success' => 0, 'msg' => '姓名不能为空')));
			}
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$sex = isset($_POST['sex']) ? intval($_POST['sex']) : 0;
			$date = isset($_POST['redate']) ? htmlspecialchars($_POST['redate']) : '';
			$hour = isset($_POST['rehour']) ? htmlspecialchars($_POST['rehour']) : '';
			$second = isset($_POST['resecond']) ? htmlspecialchars($_POST['resecond']) : '';
			$reservetime = strtotime($date . ' ' . $hour . ':' . $second . ':00');
			if ($reservetime < time()) {
				exit(json_encode(array('success' => 0, 'msg' => '预约用餐时间不可以小于当前时间')));
			}
			$nums = isset($_POST['nums']) ? intval($_POST['nums']) : 1;
		} else {
			$reservetime = time() + 600;
		}
		$table = isset($_POST['table']) ? intval($_POST['table']) : 0;
		$des = isset($_POST['remark']) ? htmlspecialchars($_POST['remark']) : '';
		$data = array('tableid' => $table, 'tel' => $tel, 'takeaway' => $takeaway, 'address' => $address, 'name' => $name, 'sex' => $sex, 'reservetime' => $reservetime, 'price' => $price, 'nums' => $nums, 'des' => $des);
		$_SESSION[$this->session_dish_user] = serialize($data);
		exit(json_encode(array('success' => 1, 'msg' => 'ok')));
	}
	
	
	/**
	 * 点餐页
	 */
	public function dish() {
		$company = M('Company')->where(array('token' => $this->token, 'id' => $this->_cid))->find();
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->redirect(U('Repast/select',array('token' => $this->token,'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		$this->assign('metaTitle', $company['name']);
		$this->display();
	}
	
	/**
	 * 菜单列表
	 */
	public function GetDishList() {
		$company = M('Company')->where(array('token' => $this->token, 'id' => $this->_cid))->find();
		$dish_sort = M('Dish_sort')->where(array('cid' => $this->_cid))->select();
		$dish = M('Dish')->where(array('cid' => $this->_cid))->select();
		$dish_like = M('Dish_like')->where(array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id))->select();
		$like = array();
		foreach ($dish_like as $dl) {
			$like[$dl['did']] = 1;
		}
		$mymenu = $this->getDishMenu();
		$list = array();
		foreach ($dish as $d) {
			$t = array();
			$t['id'] = $d['id'];
			$t['aid'] = $d['cid'];
			$t['name'] = $d['name'];
			$t['price'] = $d['price'];
			$t['discount_name'] = '';
			$t['discount_price'] = '';
			$t['class_id'] = $d['sid'];
			$t['pic'] = $d['image'];
			$t['note'] = $d['des'];
			$t['unit'] = $d['unit'];
			$t['tag_name'] = $d['ishot'] ? '推荐' : '';
			$t['html_name'] = '';
			$t['check'] = isset($like[$d['id']]) ? $like[$d['id']] : 0;
			$t['select'] = isset($mymenu[$d['id']]) ? 1 : 0;
			$list[$d['sid']][] = $t;
		}
		$result = array();
		foreach ($dish_sort as $sort) {
			$r = array();
			$r['id'] = $sort['id'];
			$r['aid'] = $sort['cid'];
			$r['name'] = $sort['name'];
			$r['dishes'] = isset($list[$sort['id']]) ? $list[$sort['id']] : '';
			$result[] = $r;
		}
		exit(json_encode($result));
	}
	
	/**
	 * 对某个菜进行喜欢标记操作
	 */
	public function dolike() {
		if (empty($this->wecha_id)) {
			exit(json_encode(array('status' => 0)));
		}
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$check = isset($_POST['check']) ? intval($_POST['check']) : 0;
		if ($id) {
			$dishLike = D('Dish_like');
			$data = array('did' => $id, 'cid' => $this->_cid, 'wecha_id' => $this->wecha_id);
			if ($check) {
				$dishLike->add($data);
			} else {
				$dishLike->where($data)->delete();
				exit(json_encode(array('status' => 1)));
			}
		}
		exit(json_encode(array('status' => 0)));
	}
	
	/**
	 * 喜欢餐店中的某些菜的列表
	 */
	public function like() {
		if ($this->wecha_id) {
			$mymenu = $this->getDishMenu();
			$dish_like = M('Dish_like')->where(array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id))->select();
			$dids = array();
			foreach ($dish_like as $like) {
				$dids[] = $like['did'];
			}
			$dish = array();
			if ($dids) {
				$list = M('Dish')->where(array('id' => array('in', $dids), 'cid' => $this->_cid))->select();
				foreach ($list as $row) {
					$row['select'] = isset($mymenu[$row['id']]) ? 1 : 0;
					$dish[] = $row;
				}
			}
		} else {
			$dish = array();
		}
		$this->assign('dishlist', $dish);
		$this->assign('metaTitle', '我喜欢的菜');
		$this->display();
	}
	
	
	/**
	 * 点餐操作
	 */
	public function editOrder() {
		$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
		$num = isset($_POST['num']) ? intval($_POST['num']) : 0;
		$des = isset($_POST['des']) ? htmlspecialchars($_POST['des']) : '';
		if ($id) {
			$oldMenu = $this->getDishMenu();
			if (isset($oldMenu[$id])) {
				$oldMenu[$id]['des'] = $des ? $des : $oldMenu[$id]['des'];
				$oldMenu[$id]['num'] += $num;
				if ($oldMenu[$id]['num'] == 0) {
					unset($oldMenu[$id]);
				}
			} elseif ($num > 0) {
				$oldMenu[$id]['des'] = $des ;
				$oldMenu[$id]['num'] = $num;
			}
			$_SESSION[$this->session_dish_info] = serialize($oldMenu);
		}
	}
	
	/**
	 * 我的菜单（我的购物车）
	 */
	public function mymenu() {
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->error('没有填写用餐信息，先填写信息，再提交订单！', U('Repast/select',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		$menu = $this->getDishMenu();
		$data = array();
		$totalNum = $totalPrice = 0;
		if ($menu) {
			$dids = array_keys($menu);
			$dishList = M('Dish')->where(array('cid' => $this->_cid, 'id' => array('in', $dids)))->select();
			foreach ($dishList as $dish) {
				if (isset($menu[$dish['id']])) {
					$totalNum += $menu[$dish['id']]['num'];
					$totalPrice += $menu[$dish['id']]['num'] * $dish['price'];
					$r = array();
					$r['id'] = $dish['id'];
					$r['name'] = $dish['name'];
					$r['price'] = $dish['price'];
					$r['nums'] = $menu[$dish['id']]['num'];
					$r['des'] = $menu[$dish['id']]['des'];
					$data[] = $r;
				}
			}
		}
		//是否余额支付
		$user= M('Userinfo')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->assign('yuer',$user['balance']);
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		//print_r($payment);die();
		$this->assign('payment',$payment);
		$dishCompany = M('Dish_company')->where(array('cid' => $this->_cid))->find();
		$this->assign('paymode',$dishCompany['payonline']);
		
		$tableName = '';
		if ($userInfo['tableid']) {
			$diningTable= M('Dining_table')->where(array('cid' => $this->_cid, 'id' => $userInfo['tableid']))->find();
			$tableName = isset($diningTable['name']) && isset($diningTable['isbox']) ? ($diningTable['isbox'] ?  $diningTable['name'] . '(包厢'. $diningTable['num']. '座)' : $diningTable['name'] . '(大厅'. $diningTable['num']. '座)') : '';
		}
		$this->assign('tableName', $tableName);
		$this->assign('userInfo', $userInfo);
		$this->assign('totalNum', $totalNum);
		$this->assign('totalPrice', $totalPrice);
		$this->assign('my_dish', $data);
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	public function getInfo() 
	{
		if (empty($this->wecha_id)) {
			exit(json_encode(array('success' => 0, 'msg' => '无法获取您的微信身份，请关注“公众号”，然后回复“订餐”来使用此功能')));
		}
		//$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		//if (empty($userInfo)) {
			//exit(json_encode(array('success' => 0, 'msg' => '您的个人信息有误，请重新下单')));
		//}
		exit(json_encode(array('success' => 1, 'msg' => 'ok')));
	}
	
	/**
	 * 保存我的订单
	 */
	public function saveMyOrder()
	{
		if (empty($this->wecha_id)) {
			unset($_SESSION[$this->session_dish_info]);
			$this->error('您的微信账号为空，不能订餐!');
			exit(json_encode(array('success' => 0, 'msg' => '您的微信账号为空，不能订餐!')));
		}
		
		$dishs = $this->getDishMenu();
		if (empty($dishs)) {
			$this->error('没有点餐，请去点餐吧!');
		}
		$userInfo = unserialize($_SESSION[$this->session_dish_user]);
		if (empty($userInfo)) {
			$this->error('您的个人信息有误，请重新下单!', U('Repast/selectTable',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
		}
		
		$userInfo['cid'] = $this->_cid;
		$userInfo['wecha_id'] = $this->wecha_id;
		$userInfo['token'] = $this->token;
		
		$total = $price = 0;
		$dids = array_keys($dishs);

		$dishList = M('Dish')->where(array('cid' => $this->_cid, 'id' => array('in', $dids)))->select();
		$temp = array();
		foreach ($dishList as $r) {
			if (isset($dishs[$r['id']])) {
				$temp[$r['id']] = array('price' => $r['price'], 'num' => $dishs[$r['id']]['num'], 'name' => $r['name'], 'des' => $dishs[$r['id']]['des']);
				$total += $dishs[$r['id']]['num'];
				$price += $dishs[$r['id']]['num'] * $r['price'];
			}
		}
		$takeAwayPrice = 0;
		if (isset($userInfo['price']) && $userInfo['price']) {
			$price += $userInfo['price'];
			$takeAwayPrice = $userInfo['price'];
		}
		$userInfo['total'] = $total;
		$userInfo['price'] = $price;
		$userInfo['info'] = serialize(array('takeAwayPrice' => $takeAwayPrice, 'list' => $temp));
		$userInfo['time'] = time();
		$userInfo['orderid'] = date("YmdHis").rand(1000,2000);
		$doid = D('Dish_order')->add($userInfo);
		//订单号
		$orderid=$userInfo['orderid'];
		if ($doid) {
			//TODO 短信提示
			// if ($userInfo['takeaway'] != 2) {
				// if ($userInfo['takeaway'] == 1) {
					// Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$userInfo['name']}刚刚叫了一份外卖，订单号：{$userInfo['orderid']}，请您注意查看并处理");
				// } else {
					// Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$userInfo['name']}刚刚预约了一次用餐，订单号：{$userInfo['orderid']}，请您注意查看并处理");
				// }
			// }
			if ($userInfo['tableid']) {
				$table_order = array('cid' => $this->_cid, 'tableid' => $userInfo['tableid'], 'orderid' => $doid, 'wecha_id' => $this->wecha_id, 'reservetime' => $userInfo['reservetime'], 'creattime' => time());
				$doid = D('Dish_table')->add($table_order);
			}
			$_SESSION[$this->session_dish_info] = $_SESSION[$this->session_dish_user] = '';
			unset($_SESSION[$this->session_dish_user], $_SESSION[$this->session_dish_info]);
			// $alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
			
			$dishCompany = M('Dish_company')->where(array('cid' => $this->_cid))->find();
			
			// if ($alipayConfig['open'] && $dishCompany['payonline']) {
				// $this->success('正在提交中...', U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Repast', 'orderName' => $userInfo['orderid'], 'single_orderid' => $userInfo['orderid'], 'price' => $price)));
			// } else {
				// $this->redirect(U('Repast/myOrder',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid,'success'=>1)));
			// }
			if($dishCompany['print_status']==1)
			{
				
				if($dishCompany['printtype']=='feiyin')
				{
					if($dishCompany['deviceNo']) 
                    { 					 
						$printercounts=$this->email_body();
					
					    define('MEMBER_CODE', $dishCompany['memberCode']);
					    define('FEYIN_KEY', $dishCompany['feiyin_key']);
						define('DEVICE_NO', $dishCompany['deviceNo']);
					    define('Page',$dishCompany['printpage']);
					    define('FEYIN_HOST','my.feyin.net');
					    define('FEYIN_PORT', 80);
					    $str=$printercounts;
					    if(intval(Page))
					    {		
						   for ($i=1; $i<Page; $i++)
						   {							
							$str.='</br></br></br></br></br>'.$str;
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
					if($dishCompany['deviceNo1']) 
                    { 					 
						$printercounts=$this->email_body();
					
					    define('MEMBER_CODE', $dishCompany['memberCode']);
					    define('FEYIN_KEY', $dishCompany['feiyin_key']);
					    define('DEVICE_NO', $dishCompany['deviceNo1']);
					    define('Page',$dishCompany['printpage']);
					    define('FEYIN_HOST','my.feyin.net');
					    define('FEYIN_PORT', 80);
					    $str=$printercounts;
					    if(intval(Page))
					    {		
						   for ($i=1; $i<Page; $i++)
						   {							
							$str.='</br></br></br></br></br>'.$str;
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
					if($dishCompany['deviceNo2']) 
                    { 					 
						$printercounts=$this->email_body();
					
					    define('MEMBER_CODE', $dishCompany['memberCode']);
					    define('FEYIN_KEY', $dishCompany['feiyin_key']);
					    define('DEVICE_NO', $dishCompany['deviceNo2']);
					    define('Page',$dishCompany['printpage']);
					    define('FEYIN_HOST','my.feyin.net');
					    define('FEYIN_PORT', 80);
					    $str=$printercounts;
					    if(intval(Page))
					    {		
						   for ($i=1; $i<Page; $i++)
						   {							
							$str.='</br></br></br></br></br>'.$str;
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
				}
				if($dishCompany['printtype']=='laoyang')
				{
					if($dishCompany['bwdeviceNo'])
					{
						$url = 'http://215.28.141.183';//POST指向的API链接 
						$printercounts=$this->print2_body();

						define('DEVICE_NO', $dishCompany['lydeviceNo']);
						define('Page',$dishCompany['printpage']);
						$str=$printercounts;
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
					if($dishCompany['bwdeviceNo1'])
					{
						$url = 'http://215.28.141.183';//POST指向的API链接 
						$printercounts=$this->print2_body();

						define('DEVICE_NO1', $dishCompany['bwdeviceNo1']);
						define('Page',$dishCompany['printpage']);
						$str=$printercounts;
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
					if($dishCompany['bwdeviceNo2'])
					{
						$url = 'http://215.28.141.183';//POST指向的API链接 
						$printercounts=$this->print2_body();

						define('DEVICE_NO2', $dishCompany['bwdeviceNo2']);
						define('Page',$dishCompany['printpage']);
						$str=$printercounts;
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
					//echo '<pre>';print_r($result);die();
				}
			}
			// 给客户发送短信
			
			$info=M('wxuser')->where(array('token'=>$this->token))->find();
			$phone=$dishCompany['phone'];
			
			$user=$info['smsuser'];//短信平台帐号
			$pass=md5($info['smspassword']);//短信平台密码
			$smsstatus=$dishCompany['phone_status'];//短信平台状态
			$content = $this->sms_body();
			$content .= '【'.$info['subfix'].'】'; //加后缀

			if ($user && $smsstatus == 1 && $content) {
				$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$phone.'&c='.urlencode($content));
			}
							
			//给管理员发邮件通知
			$to_email=$dishCompany['email'];
			$emailuser=$info['emailuser'];
			$emailpassword=$info['emailpassword'];
			$emailstatus=$dishCompany['email_status'];
			if ($emailstatus == 1&&$emailuser) {
				$subject="您有新的订单，单号：".$orderid."，预定人：".$row['truename'];
				$body="预定店铺：".$this->company['name']."\r\n".$this->email_body();
				$this->send_email($subject,$body,$emailuser,$emailpassword,$to_email);
			}
			//是否在线支付
			$pay_code=$this->_post('payment');
			if ($pay_code && $dishCompany['payonline']){
				$this->redirect(U('Pay/'.$pay_code,array('token'=>$this->token, 'from'=> 'Repast','wecha_id'=>$this->wecha_id,'orderid'=>$userInfo['orderid'])));
			}else {
				$this->redirect(U('Repast/myOrder',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid,'success'=>1)));
			}
			
			exit(json_encode(array('success' => 1, 'msg' => 'ok', 'orderid' => $userInfo['orderid'], 'orderName'=> $userInfo['orderid'], 'price'=> $price, 'isopen'=> $alipayConfig['open'])));
		} else {
			$this->error('订单出错，请重新下单');
			exit(json_encode(array('success' => 0, 'msg' => '订单出错，请重新下单')));
		}
	}
	//发邮件函数
	public function send_email($Subject,$body,$emailuser,$emailpassword,$to_email){
        date_default_timezone_set('PRC');
        require_once 'class.phpmailer.php';
        include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
        $mail = new PHPMailer();
        $mail->IsSMTP();
        // telling the class to use SMTP
        $mail->Host = 'smtp.qq.com';
        // SMTP server
        $mail->SMTPDebug = '1';
        // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true;

        // enable SMTP authentication
        $mail->Port = 25;
        // set the SMTP port for the GMAIL server
        $mail->Username = $emailuser;
        // SMTP account username
        $mail->Password = $emailpassword;
        // SMTP account password
		$mail->From = $emailuser."@qq.com";      // 发件人邮箱    
		$mail->FromName =  "管理员";  // 发件人    
		//$mail->AddAddress($to_email, '商户');
        $mail->AddReplyTo($emailuser."@qq.com",'微订餐');
        $mail->Subject = $Subject;
        $mail->IsHTML(true);  // send as HTML    
        // optional, comment out and test
        $mail->MsgHTML($body);
		$to_email_arr=explode(",",$to_email);
        foreach($to_email_arr as $k => $v){ 
        	$mail->AddAddress($v, '商户'); 
    	} 
        return($mail->Send());
    }
	/**
	 * 清空我的菜单
	 */
	public function clearMyMenu() {
		$_SESSION[$this->session_dish_info] = null;
		unset($_SESSION[$this->session_dish_info]);
	}
	
	
	/**
	 * 我的订单记录
	 */
	public function myOrder() {
		$status = isset($_GET['status']) ? intval($_GET['status']) : 0;
		$where = array('cid' => $this->_cid, 'wecha_id' => $this->wecha_id);
		if ($status == 4) {
			$where['isuse'] = 1;
			$where['paid'] = 1;
		} elseif ($status == 3) {
			$where['isuse'] = 0;
			$where['paid'] = 1;
		} elseif ($status == 2) {
			$where['isuse'] = 1;
			$where['paid'] = 0;
		} elseif ($status == 1) {
			$where['isuse'] = 0;
			$where['paid'] = 0;
		}
		$dish_order = M('Dish_order')->where($where)->order('id DESC')->select();
		$list = array();
		foreach ($dish_order as $row) {
			$row['info'] = unserialize($row['info']);
			$list[] = $row;
		}
		$this->assign('orderList', $list);
		$this->assign('status', $status);
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	
	/**
	 * 点餐信息
	 */
	public function getDishMenu() {
		if (!isset($_SESSION[$this->session_dish_info]) || !strlen($_SESSION[$this->session_dish_info])) {
			$dish = array();
		} else {
			$dish = unserialize($_SESSION[$this->session_dish_info]);
		}
		return $dish;
	}
	
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
	   $orderid = $_GET['orderid'];
	   if ($order = M('dish_order')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			//TODO 发货的短信提醒
			if ($order['paid']) {
				Sms::sendSms($this->token . "_" . $this->_cid, "顾客{$order['name']}刚刚对订单号：{$orderid}的订单进行了支付，请您注意查看并处理");
			}
			$this->redirect(U('Repast/myOrder', array('token'=>$this->token, 'wecha_id' => $this->wecha_id, 'cid' => $this->_cid)));
	   }else{
	      exit('订单不存在');
	    }
	}
	//订单内容
	public function email_body(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->product_model=M('dish');
		$this->product_cart_model=M('dish_order');
		$count= $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$thisuser_allorder=$this->product_cart_model->where(array('wecha_id'=>$this->wecha_id,'token'=>$this->token))->count();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			switch ($thisOrder['takeaway']){
				case 0:
					$orderType='在线预订';
					break;
				case 1:
					$orderType='外卖';
					break;
				case 2:
					$orderType='现场点餐';
					break;
			}
			
			//订餐信息
			$product_diningtable_model=M('dining_table');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$info=M('wxuser')->where(array('token'=>$this->token))->find();
			$str="欢迎使用".$info['wxname']."无线点餐系统\r\n";
			$str.="订单类型：".$orderType."\r\n订单编号：".$thisOrder['orderid']."\r\n姓名：".$thisOrder['name']."\r\n电话：".$thisOrder['tel']."\r\n地址：".$thisOrder['address']."\r\n桌台：".$thisOrder['tableName']."\r\n下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."\r\n用餐时间：".date('Y-m-d H:i:s',$thisOrder['reservetime'])."\r\n历史下单：".$thisuser_allorder."次\r\n留言：".$thisOrder['des']."\n--------------------------------\r\n";
			
			//订单详情
			$carts=unserialize($thisOrder['info']);
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts['list'] as $k=>$c){
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
					$str .=$p['name']." 单价：".$p['price']."元\r\n";
					$i++;
				}
			}
			$str .="\n------------------------------\r\n合计：".$thisOrder['price']."元\r\n------------------------------\r\n谢谢惠顾，欢迎下次光临";
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
		curl_setopt($ch, CURLOPT_REFERER, "http://215.28.141.183");   //构造来路    
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
	//订单内容
	public function print2_body(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->product_model=M('dish');
		$this->product_cart_model=M('dish_order');
		$count= $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		$thisuser_allorder=$this->product_cart_model->where(array('wecha_id'=>$this->wecha_id,'token'=>$this->token))->count();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			
			switch ($thisOrder['takeaway']){
				case 0:
					$orderType='在线预订';
					break;
				case 1:
					$orderType='外卖';
					break;
				case 2:
					$orderType='现场点餐';
					break;
			}
			
			//订餐信息
			$product_diningtable_model=M('dining_table');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$info=M('wxuser')->where(array('token'=>$this->token))->find();
			$str="<1B40><1B40><1B40>欢迎使用".$info['wxname']."无线点餐系统<0D0A>";
			$str.="订单类型：".$orderType."<0D0A>订单编号：".$thisOrder['orderid']."<0D0A>姓名：".$thisOrder['name']."<0D0A>电话：".$thisOrder['tel']."<0D0A>地址：".$thisOrder['address']."<0D0A>桌台：".$thisOrder['tableName']."<0D0A>下单时间：".date('Y-m-d H:i:s',$thisOrder['time'])."<0D0A>用餐时间：".date('Y-m-d H:i:s',$thisOrder['reservetime'])."<0D0A>历史下单：".$thisuser_allorder."次<0D0A>留言：".$thisOrder['des']."\n--------------------------------<0D0A>";
			//订单详情
			$carts=unserialize($thisOrder['info']);
			
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts['list'] as $k=>$c){
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
					$str .=$p['name']."  单价：".$p['price']."元<0D0A>";
					$i++;
				}
			}
			$str .="--------------------------------<0D0A>合计：".$thisOrder['price']."元<0D0A>--------------------------------<0D0A>谢谢惠顾，欢迎下次光临<0D0A><0D0A><0D0A><0D0A><0D0A><0D0A>";
			return $str;
		}else {
			return '';
		}
	}
	//订单内容
	public function sms_body(){
		$where['token']=$this->token;
		$where['wecha_id']=$this->wecha_id;
		$where['printed']=0;
		$this->product_model=M('dish');
		$this->product_cart_model=M('dish_order');
		$count= $this->product_cart_model->where($where)->count();
		$orders=$this->product_cart_model->where($where)->order('time DESC')->limit(0,1)->select();
		
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];
			
			switch ($thisOrder['takeaway']){
				case 0:
					$orderType='在线预订';
					break;
				case 1:
					$orderType='外卖';
					break;
				case 2:
					$orderType='现场点餐';
					break;
			}
			
			//订餐信息
			$product_diningtable_model=M('dining_table');
			if ($thisOrder['tableid']) {
				$thisTable=$product_diningtable_model->where(array('id'=>$thisOrder['tableid']))->find();
				$thisOrder['tableName']=$thisTable['name'];
			}else{
				$thisOrder['tableName']='未指定';
			}
			$str.="类型：".$orderType." 编号：".$thisOrder['orderid']." 姓名：".$thisOrder['name'].",电话：".$thisOrder['tel'].",地址：".$thisOrder['address']." 桌台：".$thisOrder['tableName'].",用餐时间：".date('Y-m-d H:i:s',$thisOrder['reservetime']);
			//订单详情
			$carts=unserialize($thisOrder['info']);
			$totalFee=0;
			$totalCount=0;
			$products=array();
			$ids=array();
			foreach ($carts['list'] as $k=>$c){
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
					$str .=$p['name']." ";
					$i++;
				}
			}
			$str .=" 合计".$thisOrder['price']."元,留言：".$thisOrder['beizhu'];
			return $str;
		}else {
			return '';
		}
	}
}
?>