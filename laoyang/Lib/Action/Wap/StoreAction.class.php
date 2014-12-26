<?php
class StoreAction extends WapAction{
	//public $token;
	//public $wecha_id = '';
	public $product_model;
	public $product_cat_model;
	public $session_cart_name;
	public $_cid = 0;
	public $_set;
	public $_isgroup = 0;
	
	public $mainCompany = null;
	
	public $_twid = '';
	
	public $mytwid = '';
	
	private $randstr = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
	public function _initialize() 
	{
		parent::_initialize();
		
		$tpl=$this->wxuser;
		$tpl['color_id']=intval($tpl['color_id']);
		$this->tpl=$tpl;
		
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if (!strpos($agent, "MicroMessenger")) {
			//	echo '此功能只能在微信浏览器中使用';exit;
		}
		
		$this->_cid = session("session_company_{$this->token}");
		$this->assign('cid', $this->_cid);
		$this->session_cart_name = "session_cart_products_{$this->token}_{$this->_cid}";//'session_cart_products_' . $this->token;
		$this->product_model = M('Product');
		$this->product_cat_model = M('Product_cat');
		$this->mainCompany = M('Company')->where("`token`='{$this->token}' AND `isbranch`=0")->find();
		if (C('zhongshuai')) {
			$cid = $this->mainCompany['id'];
			$set = M("Product_setting")->where(array('token' => $this->token, 'cid' => $this->mainCompany['id']))->find();
			$this->_isgroup = isset($set['isgroup']) ? intval($set['isgroup']) : 0;
		}
			
		if ($this->_cid) {
			$this->_set = M("Product_setting")->where(array('token' => $this->token, 'cid' => $this->_cid))->find();
			$this->assign('productSet', $this->_set);
			$cid = $this->_isgroup ? $this->mainCompany['id'] : $this->_cid;
			$cats = $this->product_cat_model->where(array('token' => $this->token, 'cid' => $cid, 'parentid' => 0))->order("sort ASC, id DESC")->select();
			$this->assign('cats', $cats);
		}
		
		
		$this->_twid = isset($_REQUEST['twid']) ? $_REQUEST['twid'] : '';//来自推广人的推广标示
		$this->mytwid = session('twid');//我自己的推广标示
		$login = session("login");
		if (empty($this->wecha_id) && empty($this->mytwid) && empty($login) && !in_array(ACTION_NAME, array('register','login','products','product','cart','select','cats','index'))) {
			$callbackurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			session('callbackurl', $callbackurl);
			//点击链接时的推广记录
			session("login", 1);
			$this->redirect(U('Store/login', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
		}
		
		$istwittersave = session('twitter_save');
		if (empty($istwittersave) && $this->_cid) {
			$this->savelog(1, $this->_twid, $this->token, $this->_cid);
			session('twitter_save', 1);
		}
		
		if (empty($this->wecha_id) && $this->mytwid) {
			$fansInfo = M('Userinfo')->where(array('token' => $this->token, 'twid' => $this->mytwid))->find();
			$this->fans = $fansInfo;
			$this->assign('fans', $fansInfo);
		}
		
		if ($this->fans && empty($this->fans['twid'])) {
			$twid = $this->randstr{rand(0, 51)} . $this->randstr{rand(0, 51)} . $this->randstr{rand(0, 51)} . $this->fans['id'];
			D('Userinfo')->where(array('id' => $this->fans['id']))->save(array('twid' => $twid));
			$this->fans['twid'] = $twid;
			$this->assign('fans', $fansInfo);
		}
		$this->mytwid = $this->fans['twid'];
		
		$this->_cid || $this->_cid = $this->mainCompany['id'];
		$this->wecha_id || $this->wecha_id = $this->mytwid;
		
		$this->assign('staticFilePath', str_replace('./', '/', THEME_PATH . 'common/css/store'));
		//购物车
		$calCartInfo = $this->calCartInfo();
		$this->assign('totalProductCount', $calCartInfo[0]);
		$this->assign('totalProductFee', $calCartInfo[1]);
		/* $recommended_cats = $this->product_cat_model->where(array('token' => $this->token,'recommended' => 1))->order('sort asc')->select();
		if(count($recommended_cats))
		{
			$catid = array();
			foreach ($recommended_cats as $item){
				if (!in_array($item['id'], $catid)){
					array_push($catid, $item['id']);
				}
			}
			$products = $this->product_model->where(array('catid'=>array('in',$catid),'token' => $this->token, 'groupon' => 0 , 'dining' => 0))->limit('0, 8')->select();		
			$this->assign('products', $products);
		} */
		$this->assign('mytwid', $this->mytwid);
		$this->assign('twid', $this->_twid);
	}
	
	public function select()
	{
		//session("session_company_{$this->token}", null);
		
		$company = M('Company')->where("`token`='{$this->token}' AND ((`isbranch`=1 AND `display`=1) OR `isbranch`=0)")->select();
		if (count($company) == 1) {
			$this->redirect(U('Store/cats',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'cid' => $company[0]['id'], 'twid' => $this->_twid)));
		}
		
		$this->assign('company', $company);
		$this->assign('metaTitle', '商城分布');
		$this->display();
		
	}
	
	
	/**
	 * 商城首页
	 */
	public function index() 
	{
		$this->redirect(U('Store/cats',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
	}


	/**
	 * 商城首页
	 */
	public function cats() 
	{   $where = array('token'=> $this->_get('token'),'infotype'=>'Shop');
		$company = M('Company')->where("`token`='{$this->token}' AND `isbranch`=0")->find();
		D("Product_cat")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Attribute")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Product")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Product_cart")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Product_cart_list")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Product_comment")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		D("Product_setting")->where(array('token' => $this->token, 'cid' => 0))->save(array('cid' => $company['id']));
		
		$cid = $this->_cid = isset($_GET['cid']) ? intval($_GET['cid']) : $company['id'];
		if ($this->_isgroup) {
			$cid = $company['id'];
			$relation = M("Product_relation")->where(array('token' => $this->token, 'cid' => $this->_cid))->select();
			if (empty($relation) && $this->_cid != $cid) {
				$this->error("该店铺暂时没有商品可卖，先逛逛别的", U('Store/select',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
			}
		}
		session("session_company_{$this->token}", $this->_cid);
		$this->assign('cid', $this->_cid);
		
		$parentid = isset($_GET['parentid']) ? intval($_GET['parentid']) : 0;
		$cats = $this->product_cat_model->where(array('token' => $this->token, 'cid' => $cid))->order("sort ASC, id DESC")->select();
						
		$info = array();
		$sub = array();

		foreach ($cats as &$row) {
			$row['info'] = $row['des'];
			$row['img'] = $row['logourl'];
			if ($row['isfinal'] == 1) {
				$row['url'] = U('Store/products', array('token' => $this->token, 'catid' => $row['id'], 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid));
			} else {
				$row['sub'] = array();
				$row['url'] = U('Store/cats', array('token' => $this->token, 'cid' => $this->_cid, 'parentid' => $row['id'], 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid));
			}
			$info[$row['id']] = $row;
			
			$row['parentid'] && $sub[$row['parentid']][] = $row;
		}
		
		foreach ($sub as $k => $r) {
			if (isset($info[$k]) && $info[$k]) {
				$info[$k]['sub'] = $r;
			}
		}
		$result = array();
		foreach ($info as $kk => $ii) {
			if ($ii['parentid'] == $parentid) {
				$result[$kk] = $ii;
			}
		}
		$this->assign('info', $result);

		$this->assign('metaTitle', '商品分类');
		
		include('./laoyang/Lib/ORG/index.Tpl.php');
		include('./laoyang/Lib/ORG/cont.Tpl.php');
		$catemenu[0] = array('id' => 0, 'name' => '所有商品', 'picurl' => '/tpl/static/store/m-act-cat.png', 'k' => 0, 'vo' => array(), 'url' => U('Store/cats', array('token'=> $this->token,'wecha_id'=> $this->wecha_id,'cid' => $this->_cid)));
		$catemenu[1] = array('id' => 1, 'name' => '购物车', 'picurl' => '/tpl/static/store/m-act-cart.png', 'k' => 1, 'vo' => array(), 'url' => U('Store/cart', array('token'=> $this->token,'wecha_id'=> $this->wecha_id,'cid' => $this->_cid)));
		$catemenu[2] = array('id' => 2, 'name' => '查物流', 'picurl' => '/tpl/static/store/m-act-wuliu.png', 'k' => 2, 'vo' => array(), 'url' => U('Store/my', array('token'=> $this->token,'wecha_id'=> $this->wecha_id,'cid' => $this->_cid)));
		$catemenu[3] = array('id' => 3, 'name' => '用户中心', 'picurl' => '/tpl/static/store/user2.png', 'k' => 3, 'vo' => array(), 'url' => U('Store/my', array('token'=> $this->token,'wecha_id'=> $this->wecha_id,'cid' => $this->_cid)));
		$this->assign('catemenu', $catemenu);
		$set = M("Product_setting")->where(array('token' => $this->token, 'cid' => $this->_cid))->find();

		if (isset($tpl[$set['tpid'] - 1]['tpltypename'])) {
			$t = $tpl[$set['tpid'] - 1]['tpltypename'];
			
			$cateMenuFileName = "tpl/Wap/default/Index_menuStyle{$set['footerid']}.html";
			
			$this->assign('cateMenuFileName', $cateMenuFileName);
			
			$allflash=M('Store_flash')->where(array('token' => $this->token, 'cid' => $this->_cid))->select();
			
			foreach ($allflash as &$f) {
				if ($f['url']) {
					$url = $f['url'];
					$link=str_replace(array('{wechat_id}','{siteUrl}','&amp;'),array($this->wecha_id,$this->siteUrl,'&'),$url);
					if (!!(strpos($url,'tel')===false)&&$url!='javascript:void(0)'&&!strpos($url,'wecha_id=')){
						if (strpos($url,'?')){
							$link=$link.'&wecha_id='.$this->wecha_id . '&twid=' . $this->_twid;
						}else {
							$link=$link.'?wecha_id='.$this->wecha_id . '&twid=' . $this->_twid;
						}
					}
					$f['url'] = $link;
				}
			}
		
			$flash = array();
			$flashbg = array();
			foreach ($allflash as $af){
				if ($af['url']=='') {
					$af['url']='javascript:void(0)';
				}
				if ($af['type'] == 1) {
					array_push($flash,$af);
				} elseif ($af['type'] == 0) {
					array_push($flashbg,$af);
				}
			}
			
			//$allflash=$this->convertLinks($allflash);
		
			$count = count($flash);
			$this->assign('flash', $flash);
			$this->assign('tpl', $this->tpl);
			$this->assign('num', $count);
			$this->assign('flashbg', $flashbg);
			$this->assign('flashbgcount', count($flashbg));
			//print_r($t);die();
			$this->display("Index:{$t}");
		} else {
			$this->assign('cats', $result);
			$this->display();
		}
	}

	
	public function products() 
	{
		//if (isset($_G['cid']))
		$where = array('token' => $this->token, 'cid' => $this->_cid, 'groupon' => 0, 'dining' => 0, 'status' => 0);
		if ($this->_isgroup) {
			$relation = M("Product_relation")->where(array('token' => $this->token, 'cid' => $this->_cid))->select();
			$gids = array();
			foreach ($relation as $r) {
				$gids[] = $r['gid'];
			}
			if ($gids) $where['gid'] = array('in', $gids);
			$where['cid'] = $this->mainCompany['id'];
		}
		
		$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;
		if ($catid) {
			$where['catid'] = $catid;
			$thisCat = $this->product_cat_model->where(array('id'=>$catid))->find();
			$where['cid'] = $thisCat['cid'];
			if (empty($this->_cid) || $this->_cid != $thisCat['cid']) {
				$this->_cid = $thisCat['cid'];
				session("session_company_{$this->token}", $this->_cid);
			}
			$this->assign('thisCat', $thisCat);
		}
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('/index.php?g=Wap&m=Store&a=products&token=' . $this->token . '&wecha_id=' . $this->wecha_id . '&keyword=' . $key . '&twid=' . $this->_twid);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like', "%".$_GET['keyword']."%");
            $this->assign('isSearch', 1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count', $count); 
		//排序方式
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$this->assign('order', $order);
		$this->assign('method', $method);
        	
		$products = $this->product_model->where($where)->order("sort ASC, " . $order.' '.$method)->limit('0, 8')->select();
		$this->assign('products', $products);
		$name = isset($thisCat['name']) ? $thisCat['name'] . '列表' : "商品列表";
		$this->assign('metaTitle', $name);
		$this->display();
	}
	
	public function ajaxProducts()
	{
		$where = array('token' => $this->token, 'cid' => $this->_cid, 'groupon' => 0, 'dining' => 0, 'status' => 0);
		if ($this->_isgroup) {
			$relation = M("Product_relation")->where(array('token' => $this->token, 'cid' => $this->_cid))->select();
			$gids = array();
			foreach ($relation as $r) {
				$gids[] = $r['gid'];
			}
			if ($gids) $where['gid'] = array('in', $gids);
			$where['cid'] = $this->mainCompany['id'];
		}
		//$where = array('token' => $this->token, 'cid' => $this->_cid);
		if (isset($_GET['catid'])) {
			$catid = intval($_GET['catid']);
			$where['catid'] = $catid;
		}
		$page = isset($_GET['page']) && intval($_GET['page']) > 1 ? intval($_GET['page']) : 2;
		$pageSize = isset($_GET['pagesize']) && intval($_GET['pagesize']) > 1 ? intval($_GET['pagesize']) : 8;
		
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$start = ($page-1) * $pageSize;
		$products = $this->product_model->where($where)->order("sort ASC, " . $order.' '.$method)->limit($start . ',' . $pageSize)->select();
		exit(json_encode(array('products' => $products)));
	}
	
	public function product() 
	{
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$where = array('token' => $this->token, 'id' => $id);
		$product = $this->product_model->where($where)->find();
		if (empty($product)) {
			$this->redirect(U('Store/products',array('token' => $this->token,'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
		}
		
		$cid = $this->_isgroup ? $this->mainCompany['id'] : $this->_cid;
		
		$product['intro'] = isset($product['intro']) ? htmlspecialchars_decode($product['intro']) : '';
		$this->assign('product', $product);
		if ($product['endtime']){
			$leftSeconds = intval($product['endtime'] - time());
			$this->assign('leftSeconds', $leftSeconds);
		}
        $normsData = M("Norms")->where(array('catid' => $product['catid']))->select();
        foreach ($normsData as $row) {
        	$normsList[$row['id']] = $row['value'];
        }
        if($productCatData = M('Product_cat')->where(array('id' => $product['catid'], 'token' => $this->token, 'cid' => $cid))->find()) {
        	$this->assign('catData', $productCatData);
        }
		$colorDetail = $normsDeatail = $productDetail = array();
		$attributeData = M("Product_attribute")->where(array('pid' => $product['id']))->select();
		
		$productDetailData = M("Product_detail")->where(array('pid' => $product['id']))->select();
		foreach ($productDetailData as $p) {
			$p['formatName'] = $normsList[$p['format']];
			$p['colorName'] = $normsList[$p['color']];
			
			$formatData[$p['format']] = $colorData[$p['color']] = $productDetail[] = $p;
			
			$colorDetail[$p['color']][] = $p;
			$normsDetail[$p['format']][] = $p;
		}
		$productimage = M("Product_image")->where(array('pid' => $product['id']))->select();
		
		$this->assign('imageList', $productimage);
		$this->assign('productDetail', $productDetail);
		$this->assign('attributeData', $attributeData);
		$this->assign('normsDetail', $normsDetail);
		$this->assign('colorDetail', $colorDetail);
		$this->assign('formatData', $formatData);
		$this->assign('colorData', $colorData);
		$this->assign('metaTitle', $product['name']);
		
		$where = array('token' => $this->token, 'cid' => $cid, 'pid' => $id, 'isdelete' => 0);
		$product_model = M("Product_comment");
		$score      = $product_model->where($where)->sum('score');
		$count      = $product_model->where($where)->count();
		$comment = $product_model->where($where)->order('id desc')->limit("0, 10")->select();
		foreach ($comment as &$com) {
			$com['wecha_id'] = $com['truename'];
		}
		
		$percent = "100%";
		if ($count) {
			$score = number_format($score / $count, 1);
			$percent =  number_format($score / 5, 2) * 100 . "%";
		}
		$totalPage = ceil($count / 10);
		$page = $totalPage > 1 ? 2 : 0;
		
		$this->assign('score', $score);
		$this->assign('num', $count);
		$this->assign('page', $page);
		$this->assign('comment', $comment);
		$this->assign('percent', $percent);
		$this->display();
	}
	
	public function getcomment()
	{
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		$start = ($page - 1) * $offset;
		$offset = 10;
		$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
		$where = array('token' => $this->token, 'pid' => $pid, 'isdelete' => 0);
		$product_model = M("Product_comment");
		$count = $product_model->where($where)->count();
		
		$comment = $product_model->where($where)->order('id desc')->limit($start, $offset)->select();
		foreach ($comment as &$com) {
			$com['wecha_id'] = $com['truename'];
			$com['dateline'] = date("Y-m-d H:i", $com['dateline']);//substr($com['wecha_id'], 0, 7) . "****";
		}
		$totalPage = ceil($count / $offset);
		$page = $totalPage > $page ? intval($page + 1) : 0;
		exit(json_encode(array('error_code' => false, 'data' => $comment, 'page' => $page)));
	}
	
	/**
	 * 添加购物车
	 */
	public function addProductToCart()
	{
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;//商品的详细id,即颜色与尺寸
		if (isset($carts[$id])) {
			if ($did) {
				if (isset($carts[$id][$did])) {
					$carts[$id][$did]['count'] += $count;
				} else {
					$carts[$id][$did]['count'] = $count;
				}
			} else {
				$carts[$id] += $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	
	private function calCartInfo($carts='')
	{
		$totalCount = $totalFee = 0;
		if (!$carts) {
			$carts = $this->_getCart();
		}
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		
		return array($totalCount, $totalFee, $data[2]);
	}
	
	private function _getCart()
	{
		if (!isset($_SESSION[$this->session_cart_name])||!strlen($_SESSION[$this->session_cart_name])){
			$carts = array();
		} else {
			$carts=unserialize($_SESSION[$this->session_cart_name]);
		}
		return $carts;
	}
	
	/**
	 * 购物车列表
	 */
	public function cart()
	{
// 		if (empty($this->wecha_id)) {
// 			unset($_SESSION[$this->session_cart_name]);
// 		}
		$totalCount = $totalFee = 0;
		$data = $this->getCat($this->_getCart());
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		$list = $data[0];
		
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('totalCount', $totalCount);
		$this->assign('metaTitle','购物车');
		$this->display();
	}
	
	
	
	/**
	 * 计算一次购物的总的价格与数量
	 * @param array $carts
	 */
	public function getCat($carts = '')
	{
		$carts = empty($carts) ? $this->_getCart() : $carts;
		//邮费
		$mailPrice = 0;
		//商品的IDS
		$pids = array_keys($carts);
		
		//商品分类IDS
		$productList = $cartIds = array();
		if (empty($pids)) {
			return array(array(), array(), array());
		}
		
		//获取分类ID
		$productdata = $this->product_model->where(array('id'=> array('in', $pids)))->select();
		foreach ($productdata as $p) {
			if (!in_array($p['catid'], $cartIds)) {
				$cartIds[] = $p['catid'];
			}
			$mailPrice = max($mailPrice, $p['mailprice']);
			$productList[$p['id']] = $p;
		}
		
		//商品规格参数值
		$catlist = $norms = array();
		if ($cartIds) {
			//产品规格列表
			$normsdata = M('norms')->where(array('catid' => array('in', $cartIds)))->select();
			foreach ($normsdata as $r) {
				$norms[$r['id']] = $r['value'];
			}
			//商品分类
			$catdata = M('Product_cat')-> where(array('id' => array('in', $cartIds)))->select();
			foreach ($catdata as $cat) {
				$catlist[$cat['id']] = $cat;
			}
		}
		$dids = array();
		foreach ($carts as $pid => $rowset) {
			if (is_array($rowset)) {
				$dids = array_merge($dids, array_keys($rowset));
			}
		}
		//商品的详细
		$totalprice = 0;
		$data = array();
		if ($dids) {
			$dids = array_unique($dids);
			$detail = M('Product_detail')->where(array('id'=> array('in', $dids)))->select();
			foreach ($detail as $row) {
				$row['colorName'] = isset($norms[$row['color']]) ? $norms[$row['color']] : '';
				$row['formatName'] = isset($norms[$row['format']]) ? $norms[$row['format']] : '';
				$row['count'] = isset($carts[$row['pid']][$row['id']]['count']) ? $carts[$row['pid']][$row['id']]['count'] : 0;
				if ($this->fans['getcardtime'] > 0) {
					$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
				}
				$productList[$row['pid']]['detail'][] = $row;
				$data[$row['pid']]['total'] = isset($data[$row['pid']]['total']) ? intval($data[$row['pid']]['total'] + $row['count']) : $row['count'];
				$data[$row['pid']]['totalPrice'] = isset($data[$row['pid']]['totalPrice']) ? intval($data[$row['pid']]['totalPrice'] + $row['count'] * $row['price']) : $row['count'] * $row['price'];//array('total' => $totalCount, 'totalPrice' => $totalFee);
				$totalprice += $data[$row['pid']]['totalPrice'];
			}
		}
		//商品的详细列表
		$list = array();
		foreach ($productList as $pid => $row) {
			if (!isset($data[$pid]['total'])) {
				$count = $price = 0;
				if (isset($carts[$pid]) && is_array($carts[$pid])) {
					$a = explode("|", $carts[$pid]['count']);
					$count = isset($a[0]) ? $a[0] : 0;
					$price = isset($a[1]) ? $a[1] : 0;
				} else {
					$a = explode("|", $carts[$pid]);
					$count = isset($a[0]) ? $a[0] : 0;
					$price = isset($a[1]) ? $a[1] : 0;
				}
				$data[$pid] = array();
				$row['price'] = $price ? $price : ($this->fans['getcardtime'] > 0 && $row['vprice'] ? $row['vprice'] : $row['price']);
				$row['count'] = $data[$pid]['total'] = $count;
				if (empty($count) && empty($price)) {
					$row['count'] = $data[$pid]['total'] = isset($carts[$pid]['count']) ? $carts[$pid]['count'] : (isset($carts[$pid]) && is_int($carts[$pid]) ? $carts[$pid] : 0);
					if ($this->fans['getcardtime'] > 0) {
						$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
					}
				}
				
				
				$data[$pid]['totalPrice'] = $data[$pid]['total'] * $row['price'];
				$totalprice += $data[$pid]['totalPrice'];
			}
			$row['formatTitle'] =  isset($catlist[$row['catid']]['norms']) ? $catlist[$row['catid']]['norms'] : '';
			$row['colorTitle'] =  isset($catlist[$row['catid']]['color']) ? $catlist[$row['catid']]['color'] : '';
			$list[] = $row;
		}
		if ($obj = M('Product_setting')->where(array('token' => $this->token, 'cid' => $this->_cid))->find()) {
			if ($totalprice >= $obj['price']) $mailPrice = 0;
		}
		return array($list, $data, $mailPrice);
	}
	
	public function deleteCart()
	{
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if ($did) {
			unset($carts[$id][$did]);
			if (empty($carts[$id])) {
				unset($carts[$id]);
			}
		} else {
			unset($carts[$id]);
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$this->redirect(U('Store/cart',array('token'=>$_GET['token'],'wecha_id'=>$_GET['wecha_id'], 'twid' => $this->_twid)));
	}
	
	public function ajaxUpdateCart(){
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		if (isset($carts[$id])) {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		$_SESSION[$this->session_cart_name] = serialize($carts);
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	
	
	public function ordersave()
	{
		$row = array();
		
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$row['truename'] = $this->_post('truename');
		$row['tel'] = $this->_post('tel');
		$row['address'] = $this->_post('address');
		$row['token'] = $this->token;
		$row['wecha_id'] = $wecha_id;
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
		$row['cid'] = $cid = $this->_isgroup ? $this->mainCompany['id'] : $this->_cid;
		
		//积分
		$score = isset($_POST['score']) ? intval($_POST['score']) : 0;
		$orid = isset($_POST['orid']) ? intval($_POST['orid']) : 0;
		$product_cart_model = D('Product_cart');
		
		if ($cartObj = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'id' => $orid))->find()) {
			$carts = unserialize($cartObj['info']);
		} else {
			$carts = $this->_getCart();
		}
		$normal_rt = 0;
		
		$info = array();
		if ($carts){
			$calCartInfo = $this->calCartInfo($carts);
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				$tmp = M('product')->where(array('id' => $pid))->find();//setDec('num', $total);
				if (is_array($rowset)) {
					foreach ($rowset as $did => $ro) {
						$temp = M('Product_detail')->where(array('id' => $did, 'pid' => $pid))->find();//setDec('num', $ro['count']);
						if ($temp['num'] < $ro['count'] && empty($cartObj)) {
							$this->error('购买的量超过了库存');
						}
						$total += $ro['count'];
						$price = $this->fans['getcardtime'] ? ($temp['vprice'] ? $temp['vprice'] : $temp['price']) : $temp['price'];
						$info[$pid][$did] = array('count' => $ro['count'], 'price' => $price);
					}
				} else {
					$total = $rowset;
					$price = $this->fans['getcardtime'] ? ($tmp['vprice'] ? $tmp['vprice'] : $tmp['price']) : $tmp['price'];
					$info[$pid] = $rowset . "|" . $price;
				}
				if ($tmp['num'] < $total && empty($cartObj)) {
					$this->error('购买的量超过了库存');
				}
			}
			
			$setting = M('Product_setting')->where(array('token' => $this->token, 'cid' => $cid))->find();
			$saveprice = $totalprice = $calCartInfo[1] + $calCartInfo[2];
			if ($score && $setting && $setting['score'] > 0 && $this->fans['total_score'] >= $score) {
				$s = isset($cartObj['score']) ? intval($cartObj['score']) : 0;
				$totalprice -= ($score + $s) / $setting['score'];
				if ($totalprice <= 0) {
					$score = ($calCartInfo[1] + $calCartInfo[2]) * $setting['score'];
					$totalprice = 0;
					$row['paid'] = 1;
					$row['paymode'] = 5;
				} else {
					$score += $s;
				}
			}
			
			$row['total'] = $calCartInfo[0];
			$row['price'] = $totalprice;
			$row['diningtype'] = 0;
			$row['buytime'] = '';
			$row['tableid'] = 0;
			$row['info'] = serialize($info);
			$row['groupon']=0;
			$row['dining'] = 0;
			$row['score'] = $score;
			if ($cartObj) {
				//$row['score'] = $cartObj['score'] + $score;
				$normal_rt = $product_cart_model->where(array('id' => $orid))->save($row);
				$orderid = $cartObj['orderid'];
			} else {
				$row['time'] = $time = time();
				$row['orderid'] = $orderid = date("YmdHis") . rand(100000, 999999);
				$normal_rt = $product_cart_model->add($row);
			}
			
		}
		if ($normal_rt){
			$product_model = M('product');
			$product_cart_list_model = M('product_cart_list');
			$userinfo_model = M('Userinfo');
			$thisUser = $userinfo_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id))->find();
			if (empty($cartObj)) {
			$crow = array();
			$tdata = $this->getCat($carts);
			foreach ($carts as $k => $c){
				$crow['cartid'] = $normal_rt;
				$crow['productid'] = $k;
				$crow['price'] = $tdata[1][$k]['totalPrice'];//$c['price'];
				$crow['total'] = $tdata[1][$k]['total'];
				$crow['wecha_id'] = $row['wecha_id'];
				$crow['token'] = $row['token'];
					$crow['cid'] = $row['cid'];
				$crow['time'] = $time;
				$product_cart_list_model->add($crow);
				
					//增加销量
					$totalprice || $product_model->where(array('id'=>$k))->setInc('salecount', $tdata[1][$k]['total']);
			}
			
			//删除库存
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $ro) {
							M('Product_detail')->where(array('id' => $did, 'pid' => $pid))->setDec('num', $ro['count']);
						$total += $ro['count'];
					}
				} else {
						if (strstr($rowset, '|')) {
							$a = explode("|", $rowset);
							$total = $a[0];
						} else {
							$total = $rowset;
						}
					}
					$product_model->where(array('id' => $pid))->setDec('num', $total);
			}
			$_SESSION[$this->session_cart_name] = null;
			unset($_SESSION[$this->session_cart_name]);
			//保存个人信息
			if ($_POST['saveinfo']){
				$this->assign('thisUser', $thisUser);
				$userRow=array('tel'=>$row['tel'],'truename'=>$row['truename'],'address'=>$row['address']);
				if ($thisUser) {
					$userinfo_model->where(array('id' => $thisUser['id']))->save($userRow);
						$userinfo_model->where(array('id' => $thisUser['id'], 'total_score' => array('egt', $score)))->setDec('total_score', $score);
					F('fans_token_wechaid', NULL);
				} else {
					$userRow['token']=$this->token;
						$userRow['wecha_id'] = $wecha_id;
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
			}
			} else {
				$userinfo_model->where(array('id' => $thisUser['id'], 'total_score' => array('egt', $score - $cartObj['score'])))->setDec('total_score', $score - $cartObj['score']);
				F('fans_token_wechaid', NULL);
			}
			//购买商品时的推广记录
			if ($this->_twid) {
				$this->savelog(3, $this->_twid, $this->token, $this->_cid, $saveprice);
			}	
			//是否在线支付
			$pay_code=$this->_post('payment');
			
			if($pay_code == 2)
			{
				$this->success('正在提交中...', U('CardPay/pay', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Store', 'orderName' => "商城购物", 'single_orderid' => $orderid, 'price' => $totalprice)));
				die;
			}elseif ($pay_code == 1){
				$this->redirect(U("Store/payReturn",array('orderid'=>$orderid,'token'=>$this->token,'wecha_id'=>$this->wecha_id,'id'=>$id,'paytype'=>'other')));die();
			}else {
				$this->redirect(U('Pay/'.$pay_code,array('token'=>$this->token,'wecha_id'=>$this->wecha_id,'from'=>'Store','orderid'=>$orderid)));
				die;
			}
			$model = new templateNews();
			$model->sendTempMsg('TM00820', array('href' => U('Store/my',array('token' => $this->token, 'wecha_id' => $wecha_id)), 'wecha_id' => $wecha_id, 'first' => '购买商品提醒', 'keynote1' => '订单未支付', 'keynote2' => date("Y年m月d日H时i分s秒"), 'remark' => '购买成功，感谢您的光临，欢迎下次再次光临！'));
			$this->success('预定成功,进入您的订单页', U('Store/my',array('token' => $_GET['token'], 'wecha_id' => $wecha_id, 'success' => 1, 'twid' => $this->_twid)));
		} else {
			$this->error('订单生产失败');
		} 
	}

	public function orderCart() {
		if (empty($this->wecha_id) && empty($this->mytwid)) {
			$callbackurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
			session('callbackurl', $callbackurl);
			$this->redirect(U('Store/login',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
		}
// 		if (empty($this->wecha_id)) {
// 			unset($_SESSION[$this->session_cart_name]);
// 		}
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$cid = $this->_isgroup ? $this->mainCompany['id'] : $this->_cid;
		$orid = isset($_GET['orid']) ? intval($_GET['orid']) : 0;
		$setting = M('Product_setting')->where(array('token' => $this->token, 'cid' => $cid))->find();
		$this->assign('setting', $setting);
		//是否要支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);

		$totalCount = $totalFee = 0;
		if ($orid && ($cartObj = M('product_cart')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'id' => $orid))->find())) {
			$products = unserialize($cartObj['info']);
			$data = $this->getCat($products);
		} else {
			$data = $this->getCat($this->_getCart());
		}
		if (empty($data[0])) {
			$this->redirect(U('Store/cart', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
		}
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		if ($cartObj) {
			$totalFee -= $cartObj['score'] / $setting['score'];
		}
		if (empty($totalCount)) {
			$this->error('没有购买商品!', U('Store/cart', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
		}


		if($this->wxuser['winxintype'] ==3 && $this->wxuser['oauth'] == 1){
			$addr = new WechatAddr($this->wxuser['appid'],$this->wxuser['appsecret']);
			$this->assign('addrSign', $addr->addrSign());
		}
			$list = $data[0];
		$this->assign('orid', $orid);
			$this->assign('products', $list);
			$this->assign('totalFee', $totalFee);
			$this->assign('totalCount', $totalCount);
			$this->assign('mailprice', $data[2]);
			$this->assign('metaTitle', '购物车结算');
			$this->display();
	}
	
	public function my()
	{
		$offset = 5;
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		$start = ($page - 1) * $offset;
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$product_cart_model = M('product_cart');
		$orders = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'groupon' => 0, 'dining' => 0))->limit($start, $offset)->order('time DESC')->select();
		$count = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'groupon' => 0, 'dining' => 0))->count();
		$list = array();
		if ($orders){
			foreach ($orders as $o){
				$products = unserialize($o['info']);
				$pids = array_keys($products);
				$o['productInfo'] = array();
				if ($pids) {
					$o['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
				}
				$list[] = $o;
			}
		}
		$totalpage = ceil($count / $offset);
		$this->assign('orders', $list);
		$this->assign('ordersCount', $count);
		$this->assign('totalpage', $totalpage);
		$this->assign('page', $page);
		$this->assign('metaTitle', '我的订单');
		
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);
		$this->display();
	}

	public function myDetail(){
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_cart_model = M('product_cart');

		$list = array();
		if ($cartObj = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'id' => $cartid))->find()){
			$products = unserialize($cartObj['info']);
			$data = $this->getCat($products);
			$pids = array_keys($products);
			$cartObj['productInfo'] = array();
			if ($pids) {
				$cartObj['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
			}
			
			$totalCount = $totalFee = 0;
			if (isset($data[1])) {
				foreach ($data[1] as $pid => $row) {
					$totalCount += $row['total'];
					$totalFee += $row['totalPrice'];
				}
			}
			$list = $data[0];
			$commentList = array();
			foreach ($list as &$row) {
				if ($row['detail']) {
					foreach ($row['detail'] as &$r) {
						if (isset($commentList[$row['id']][$r['id']])) {
							$r['comment'] = 0;
						} else {
							$r['comment'] = $cartObj['paid'] ? 1 : 0;
						}
					}
				} else {
					if (isset($commentList[$row['id']][0])) {
						$row['comment'] = 0;
					} else {
						$row['comment'] = $cartObj['paid'] ? 1 : 0;
					}
				}
			}
			$commentcount=M('product_comment')->where(array('wecha_id'=>$wecha_id,'cartid'=>$cartid,'token'=>$this->token))->count();
			$this->assign('commentList', $commentList);
			$this->assign('commentcount', $commentcount);
			$this->assign('products', $list);
			$this->assign('totalFee', $totalFee);
			$this->assign('totalCount', $totalCount);
			$this->assign('mailprice', $data[2]);
			$this->assign('cartData', $cartObj);
			$this->assign('cartid', $cartid);
		}
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	public function cancelCart()
	{
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_model=M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id'=> $cartid))->find();
		if (empty($thisOrder)) {
			exit(json_encode(array('error_code' => true, 'msg' => '没有此订单')));
		}
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$id = $thisOrder['id'];
		if (empty($thisOrder['paid'])) {
			//删除订单和订单列表
			$product_cart_model->where(array('id' => $cartid))->delete();
			$product_cart_list_model->where(array('cartid' => $cartid))->delete();
			//还原积分
			$userinfo_model = M('Userinfo');
			$thisUser = $userinfo_model->where(array('token' => $this->token, 'wecha_id' => $wecha_id))->find();
			$userinfo_model->where(array('id' => $thisUser['id']))->setInc('total_score', $thisOrder['score']);
			F('fans_token_wechaid', NULL);
			//商品销量做相应的减少
			$carts = unserialize($thisOrder['info']);
			//还原库存
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $row) {
						M('product_detail')->where(array('id' => $did, 'pid' => $pid))->setInc('num', $row['count']);
						$total += $row['count'];
					}
				} else {
					if (strstr($rowset, '|')) {
						$a = explode("|", $rowset);
						$total = $a[0];
					} else {
						$total = $rowset;
					}
				}
				$product_model->where(array('id' => $pid))->setInc('num', $total);
				//$product_model->where(array('id' => $pid))->setDec('salecount', $total);
			}
			exit(json_encode(array('error_code' => false, 'msg' => '订单取消成功')));
		}
		exit(json_encode(array('error_code' => true, 'msg' => '购买成功的订单不能取消')));
	}
	
	public function updateOrder()
	{
		$product_cart_model = M('product_cart');
		$thisOrder = $product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		if ($thisOrder['wecha_id']!=$this->wecha_id){
			exit();
		}
		$this->assign('thisOrder',$thisOrder);
		$carts = unserialize($thisOrder['info']);
		$totalCount = $totalFee = 0;
		$listNum = array();
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
				$listNum[$pid] = $row['total'];
			}
		}
		$list = $data[0];
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('listNum', $listNum);
		$this->assign('metaTitle','修改订单');
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		$this->assign('payment',$payment);
		$this->display();
	}
	/**
	 * 评论
	 */
	public function comment()
	{
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
		$detailid = isset($_GET['detailid']) ? intval($_GET['detailid']) : 0;
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		if ($cartObj = M("product_cart")->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'id' => $cartid))->find()){
			if ($cartObj['paid'] == 0 ) {
				$this->error("您暂时还不能评论该商品");
			}
		} else {
			$this->error("您还没有购买此商品，暂时无法对其评论");
		}
		
		$this->assign('cartid', $cartid);
		$this->assign('detailid', $detailid);
		$this->assign('pid', $pid);
		$this->display();
	}
	
	public function commentSave()
	{
		$cartid = isset($_POST['cartid']) && intval($_POST['cartid'])? intval($_POST['cartid']) : 0;
		$pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
		$detailid = isset($_POST['detailid']) ? intval($_POST['detailid']) : 0;
		
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		$commentcount=M('product_comment')->where(array('wecha_id'=>$wecha_id,'cartid'=>$cartid,'token'=>$this->token))->count();
		if($commentcount>2)
		{
			$this->error("您已经评价过，无法再评了哦！");
		}
		if ($cartObj = M("product_cart")->where(array('token' => $this->token, 'wecha_id' => $wecha_id, 'id' => $cartid))->find()){
			if ($cartObj['paid'] == 0 ) {
				$this->error("您暂时还不能评论该商品");
			}
			$data = array();
			if ($product = M("Product")->where(array('id' => $pid, 'token' => $this->token))->find()) {
				if ($detailid) {
					$products = unserialize($cartObj['info']);
					$result = $this->getCat($products);
					foreach ($result[0] as $row) {
						foreach ($row['detail'] as $d) {
							if ($d['id'] == $detailid) {
								$str = $row['colorTitle'] && $d['colorName'] ? $row['colorTitle'] . ":" . $d['colorName'] : '';
								$str .= $row['formatTitle'] && $d['formatName'] ? ", " . $row['formatTitle'] . ":" . $d['formatName'] : '';
								$data['productinfo'] = $str;
							}
						}
					}
				}
			} else {
				$this->error("此产品可能下架了，暂时无法对其评论");
			}
		} else {
			$this->error("您还没有购买此商品，暂时无法对其评论");
		}
		
		$comment = D("Product_comment");
		$data['cartid'] = $cartid;
		$data['pid'] = $pid;
		$data['detailid'] = $detailid;
		$data['score'] = $_POST['score'];
		$data['content'] = htmlspecialchars($_POST['content']);
		$data['token'] = $this->token;
		$data['wecha_id'] = $wecha_id;
		$data['truename'] = $cartObj['truename'];
		$data['tel'] = $cartObj['tel'];
		$data['__hash__'] = $_POST['__hash__'];
		$data['dateline'] = time();
		if (false !== $comment->create($data)) {
			unset($data['__hash__']);
			$comment->add($data);
			$this->success("评论成功", U('Store/myDetail',array('token' => $this->token,'wecha_id' => $this->wecha_id,'cartid' => $cartid, 'twid' => $this->_twid)));
		} else {
			$this->error($comment->error, U('Store/myDetail',array('token' => $this->token,'wecha_id' => $this->wecha_id,'cartid' => $cartid, 'twid' => $this->_twid)));
		}
	}
	public function deleteOrder()
	{
		$product_model = M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id' => intval($_GET['id'])))->find();
		//检查权限
		$id = $thisOrder['id'];
		$wecha_id = $this->wecha_id ? $this->wecha_id : session('twid');
		
		if ($thisOrder['wecha_id'] != $wecha_id || $thisOrder['handled'] == 1) {
			exit();
		}
		//删除订单和订单列表
		$product_cart_model->where(array('id' => $id))->delete();
		$product_cart_list_model->where(array('cartid' => $id))->delete();
		//商品销量做相应的减少
		$carts = unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c) {
			if (is_array($c)) {
				$productid = $k;
				$price = $c['price'];
				$count = $c['count'];
				//$product_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		$this->redirect(U('Store/my', array('token' => $_GET['token'], 'wecha_id' => $_GET['wecha_id'], 'twid' => $this->_twid)));
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
				$userInfo = D('Userinfo')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
				/************************************************/
				$setting = M('Product_setting')->where(array('token' => $order['token'],'groupon'=>0))->find();
				//短信通知			
				if($setting['phone_status'])
				{
					$content=$this->product_sms_email_content($this->wecha_id,0,0,0);
					Sms::sendSms($order['token'],$content,$setting['phone']);
				}
				//print_r($content);die();

				//邮件通知
				if($setting['email_status'])
				{
					$content=$this->product_sms_email_content($this->wecha_id,0,0,1);
					Sms::send_email($order['token'],"恭喜您的微商城有新的订单，请及时查收！",$content,$setting['email']);
				}				
				//打印小票
				if($setting['print_status'])
				{
					if($setting['printtype']=='feiyin')
					{
						$content=$this->product_print_content($this->wecha_id,0,0,0);
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
							$content=$this->product_print_content($this->wecha_id,0,0,1);

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
							$content=$this->product_print_content($this->wecha_id,0,0,1);

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
							$content=$this->product_print_content($this->wecha_id,0,0,1);

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
				$model = new templateNews();
				$model->sendTempMsg('TM00820', array('href' => U('Store/my',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)), 'wecha_id' => $this->wecha_id, 'first' => '购买商品提醒', 'keynote1' => '订单已支付', 'keynote2' => date("Y年m月d日H时i分s秒"), 'remark' => '购买成功，感谢您的光临，欢迎下次再次光临！'));
			}
			$this->redirect(U('Store/my',array('token' => $this->token,'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
	   }else{
	      exit('订单不存在');
	    }
	}
	
	public function register()
	{
		if (IS_POST) {
			$tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
			$password2 = isset($_POST['password2']) ? htmlspecialchars($_POST['password2']) : '';
			$truename = isset($_POST['truename']) ? htmlspecialchars($_POST['truename']) : '';
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$wechaname = isset($_POST['wechaname']) ? htmlspecialchars($_POST['wechaname']) : '';
			$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
			//$wecha_id = md5($tel . time());
			$userInfo = M('Userinfo')->where(array('username' => $username))->find();
			if ($password != $password2) {
				echo 1;exit();
			}
			if ($userInfo) {
				echo 2;exit();
			}			
			$uid = D("Userinfo")->add(array('truename' => $truename, 'token' => $this->token, 'address' => $address, 'password' => md5($password), 'tel' => $tel, 'username' => $username));
			if ($uid) {
				$twid = $this->randstr{rand(0, 51)} . $this->randstr{rand(0, 51)} . $this->randstr{rand(0, 51)} . $uid;
				D('Userinfo')->where(array('id' => $uid))->save(array('twid' => $twid, 'wecha_id' => $twid));
				$this->savelog(2, $this->_twid, $this->token, $this->_cid);
				session('twid', $twid);
				echo 0;exit();
			} else {
				echo 3;exit();
			}
		} else {
			$this->assign('callbackurl', session('callbackurl'));
			$this->assign('metaTitle', '商城会员注册');
			$this->display();
		}
	}
	
	public function login()
	{
		if (IS_POST) {
			$username = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '';
			$password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '';
			$userInfo = M('Userinfo')->where(array('username' => $username))->find();
			if (empty($userInfo)) {
				$this->error("用户不存在");
			} elseif ($userInfo['password'] != md5($password)) {
				$this->error("密码不正确");
			} else {
				session('twid', $userInfo['twid']);
				$callbackurl = session('callbackurl');
				if ($callbackurl) {
					session('callbackurl', null);
					$this->success('登录成功', $callbackurl);
				} else {
					$this->success('登录成功', U('Store/index', array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'twid' => $this->_twid)));
				}
			}
		} else {
			$this->assign('metaTitle', '商城会员登录');
			$this->display();
		}
	}
	
	/**
	 * 分佣记录
	 */
	private function savelog($type, $twid, $token, $cid, $param = 1)
	{
		if ($twid && $token && $cid) {
			$set = M("Twitter_set")->where(array('token' => $token, 'cid' => $cid))->find();
			if($set)
			{
				$db = D("Twitter_log");
				// 1.点击， 2.注册会员， 3.购买商品
		// 		$twitter = $db->where(array('token' => $token, 'cid' => $cid, 'twid' => $twid, 'type' => $type))->order("id DESC")->limit("0, 1")->find();
				if ($type == 3) {//购买商品
					$price = $set['percent'] * 0.01 * $param;
		// 			if ($twitter && (date("Ymd") == date("Ymd", $twitter['dateline']))) {
		// 				$db->where(array('id' => $twitter['id']))->save(array('param' => $param + $twitter['param'], 'price' => $twitter['price'] + $price));
		// 			} else {
						$db->add(array('token' => $token, 'cid' => $cid, 'twid' => $twid, 'type' => 3, 'dateline' => time(), 'param' => $param, 'price' => $price));
		// 			}
				} elseif ($type == 2) {//注册会员
					$price = $set['registerprice'];
		// 			if ($twitter && (date("Ymd") == date("Ymd", $twitter['dateline'])) && $twitter['param'] < $set['registermax']) {
		// 				$db->where(array('id' => $twitter['id']))->save(array('param' => $param + $twitter['param'], 'price' => $twitter['price'] + $set['registerprice']));
		// 			} else {
						$db->add(array('token' => $token, 'cid' => $cid, 'twid' => $twid, 'type' => 2, 'dateline' => time(), 'param' => $param, 'price' => $price));
		// 			}
				} else {//点击
					$price = $set['clickprice'];
		// 			if ($twitter && (date("Ymd") == date("Ymd", $twitter['dateline'])) && $twitter['param'] < $set['clickmax']) {
		// 				$db->where(array('id' => $twitter['id']))->save(array('param' => $param + $twitter['param'], 'price' => $twitter['price'] + $set['clickprice']));
		// 			} else {
						$db->add(array('token' => $token, 'cid' => $cid, 'twid' => $twid, 'type' => 1, 'dateline' => time(), 'param' => $param, 'price' => $price));
		// 			}
				}
				//统计总收入
				if ($count = M("Twitter_count")->where(array('token' => $token, 'cid' => $cid, 'twid' => $twid))->find()) {
					D("Twitter_count")->where(array('id' => $count['id']))->setInc('total', $price);
				} else {
					D("Twitter_count")->add(array('twid' => $twid, 'token' => $token, 'cid' => $cid, 'total' => $price, 'remove' => 0));
				}
			}
		}
	}
	
	/**
	 * 我的个人信息
	 */
	public function myinfo()
	{
		if ($this->mytwid) {
			$userinfo = M("Userinfo")->where(array('twid' => $this->mytwid))->find();
			$count = M("Twitter_count")->where(array('token' => $this->token, 'cid' => $this->_cid, 'twid' => $this->mytwid))->find();
			$total = $count['total'] - $count['remove'];
			$this->assign('total', $total);
			$this->assign('count', $count);
			$this->assign('metaTitle', '我的个人信息');
		}
		$this->display();
	}
	
	/**
	 * 佣金的获取记录
	 */
	public function detail()
	{
// 		echo $this->mytwid;die;
		if ($this->mytwid) {
			$offset = 5;
			$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
			$start = ($page - 1) * $offset;
			$log = M("Twitter_log")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid))->limit($start, $offset)->order('id DESC')->select();
			$count = M("Twitter_log")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid))->count();
			$totalpage = ceil($count / $offset);
			$this->assign('orders', $log);
			$this->assign('ordersCount', $count);
			$this->assign('totalpage', $totalpage);
			$this->assign('page', $page);
		}
		$this->assign('metaTitle', '佣金获取记录');
		$this->display();
	}
	
	/**
	 * 提现记录
	 */
	public function remove()
	{
		if ($this->mytwid) {
			$offset = 5;
			$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
			$start = ($page - 1) * $offset;
			$log = M("Twitter_remove")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid))->limit($start, $offset)->order('id DESC')->select();
			$count = M("Twitter_remove")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid))->count();
			$totalpage = ceil($count / $offset);
			$this->assign('orders', $log);
			$this->assign('ordersCount', $count);
			$this->assign('totalpage', $totalpage);
			$this->assign('page', $page);
		}
		$this->assign('metaTitle', '我的个人信息');
		$this->display();
	}
	
	public function logout()
	{
		session('twid', null);
		session('login', null);
		session('twitter_save', null);
		$this->redirect(U('Store/login',array('token' => $this->token, 'twid' => $this->_twid)));
	}
	
	/**
	 * 提现请求
	 */
	public function setremove()
	{
		if ($this->mytwid) {
			$remove = M("Twitter_remove")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid, 'status' => 0))->find();
			$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
			$tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
			$number = isset($_POST['number']) ? htmlspecialchars($_POST['number']) : '';
			$bank = isset($_POST['bank']) ? htmlspecialchars($_POST['bank']) : '';
			$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
			$price = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : 0;
			$data = array('token' => $this->token, 'cid' => $this->_cid, 'twid' => $this->mytwid, 'name' => $name, 'tel' => $tel, 'number' => $number, 'bank' => $bank, 'address' => $address, 'price' => $price);
			if (IS_POST) {
				$count = M("Twitter_count")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid))->find();
				$total = $count['total'] - $count['remove'];
				if ($total < $price) $this->error("请不要贪心，您现在还没有{$price}元钱供你提现");
				if (empty($name)) $this->error("提款人姓名不能为空");
				if (empty($number)) $this->error("提款人账号不能为空");
				if (empty($bank)) $this->error("提款银行名称不能为空");
				if ($remove) {
					D('Twitter_remove')->where(array('id' => $remove['id']))->save($data);
				} else {
					$data['dateline'] = time();
					$data['status'] = 0;
					D('Twitter_remove')->add($data);
				}
				$this->success('提现提交成功');
				die;
			} else {
				if (empty($remove)) {
					$remove = M("Twitter_remove")->where(array('twid' => $this->mytwid, 'token' => $this->token, 'cid' => $this->_cid, 'status' => 1))->order('id DESC')->limit('0, 1')->find();
					$remove['price'] = 0;
				}
				$this->assign('remove', $remove);
			}
		}
		$this->assign('metaTitle', '填写提现信息');
		$this->display();
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
}

?>