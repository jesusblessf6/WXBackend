<?php
class IndexAction extends BaseAction{
	public $includePath;
	protected function _initialize(){
		parent::_initialize();
		$this->home_theme=$this->home_theme?$this->home_theme:'laoyang';
		$this->includePath='./tpl/Home/'.$this->home_theme.'/';
		
		$this->assign('includeHeaderPath',$this->includePath.'Public_header.html');
		$this->assign('includeFooterPath',$this->includePath.'Public_footer.html');
		
	}
	public function clogin()
	{
		$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
		$k = isset($_GET['k']) ? $_GET['k'] : '';
		$this->assign('cid', $cid);
		$this->assign('k', $k);
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	//关注回复
	public function index(){
		$where['status']=1;
		if (C('agent_version')){
			$where['agentid']=$this->agentid;
		}
		$links=D('Links')->where($where)->select();
		$this->assign('links',$links);
		$users = M('Users')->where(array(//前台时间调用开始
			'id' => $_SESSION['uid']
		))->find();
		$this->assign('thisUser', $users);//前台时间结束
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function wifi()
	{
		$where = array("id" => $_GET["id"]);
		$info = d("Wifi_keyword")->where($where)->find();
		$ret_json = $this->rippleos_auth_url($info["node"]);
		$ret_code = $this->rippleos_auth_token($info["node"]);
		$rt["token"] = $ret_code["auth_token"];
		$rt["url"] = $ret_json["auth_url"];
		$temp_id = ($info["tmpl"] ? $info["tmpl"] : "2");
		$tmpl = d("Wifi_tmpl")->where(array("id" => $temp_id))->find();
		$themes = "tpl/Home/wifi/" . $tmpl["tpl"] . "/";
		$this->assign("themes", $themes);

		if ($info["rz_id"] == 4) {
			$times = time();
			$raw = array("rptk_user_mac" => $this->_get("rptk_user_mac"), "rptk_key" => $this->_get("rptk_key"), "use_time" => $times, "rptk_user_ip" => $this->_get("rptk_user_ip"), "user" => $this->_get("wecha_id"), "wid" => $this->_get("id"));

			if ($this->_get("rptk_user_mac")) {
				d("Wifi_user")->add($raw);
			}

			if ($info["rz_url"]) {
				header("Location: " . $info["rz_url"]);
			}
			else {
				header("Location: " . c("site_url"));
			}
		}
		else {
			$isweixin = 1;
			$rztype = 0;

			if (strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") !== false) {
				$isweixin = 0;
			}

			$this->assign("isweixin", $isweixin);
			$db2 = d("Wifi_ads");
			$head = $db2->where(array("wifi_id" => $info["id"], "type" => "0"))->order("id")->select();
			$this->assign("head", $head);
			$ads = $db2->where(array("wifi_id" => $info["id"], "type" => "1"))->order("id")->select();
			$this->assign("ads", $ads);
			$menulink = $db2->where(array("wifi_id" => $info["id"], "type" => "2"))->order("id")->select();
			$this->assign("menulink", $menulink);
			$bgpic = $db2->where(array("wifi_id" => $info["id"], "type" => "3"))->order("id")->select();
			$this->assign("bgpic", $bgpic);

			if ($tmpl["tpl"] == "weixin") {
				header("Location: ./index.php?g=Wap&m=Index&a=Index&token=" . $info["token"] . "&wecha_id=" . $_GET["wecha_id"] . "&ischeckonline=1");
				exit();
			}

			if ($info["rz_id"] == 3) {
				$rztype = 3;
			}
			else if ($info["rz_id"] == 2) {
				$rztype = 2;
				$rt["url"] = "http://service.rippletek.com/Portal/Wx/login?weixin=" . $info["wx_id"];
			}
			else {
				$rztype = 1;
			}
		}

		$this->assign("rt", $rt);
		$this->assign("get", $_GET);
		$this->assign("rztype", $rztype);
		$this->assign("info", $info);
		if (($this->isMobile() == true) || ($_GET["type"] == "test")) {
			$this->display("wifi/" . $tmpl["tpl"] . ":Index:" . ACTION_NAME);
		}
		else {
			$this->display("wifi/pc:Index:" . ACTION_NAME);
		}

		echo c("cnzz");
	}

	public function sendCode()
	{
		if (!preg_match("/1[3458]{1}\d{9}$/", $this->_get("phone"))) {
			echo "请输入正确的手机号码!";
			return NULL;
		}

		$openid = ($_GET["wecha_id"] ? $_GET["wecha_id"] : "test_id");
		$times = time();
		$raw = array("use_time" => $times, "phone" => $this->_get("phone"), "user" => $this->_get("wecha_id"), "rptk_user_mac" => $this->_get("rptk_user_mac"), "rptk_key" => $this->_get("rptk_key"), "rptk_user_ip" => $this->_get("rptk_user_ip"), "wid" => $this->_get("id"));

		if ($this->_get("phone")) {
			d("Wifi_user")->add($raw);
		}

		$data["c"] = "感谢您使用本店免费WIFI，您这次的上网认证码为：" . $_GET["code"] . "，有效期为2分钟！";
		$rts = $this->sms_send_owner($_GET["phone"], $data["c"]);

		if ($rts == "1") {
			echo "短信已发送，请注意查收！";
		}
		else {
			echo "短信发送失败";
		}
	}

	public function sms_send_owner($phone, $content)
	{
		if (empty($content)) {
			return "短信内容为空？写点吧～";
		}

		$info = d("Wifi_keyword")->where(array("id" => $_GET["id"]))->find();
		$sms = d("Weiwosms")->where(array("token" => $info["token"]))->find();

		if ($sms["wifi"] == 0) {
			echo "短信功能还没启用！本次的上网码是：" . $_GET["code"] . "，有效期为2分钟！";
			exit();
		}

		$smsapi = "api.smsbao.com";
		$charset = "utf8";
		$user = $sms["name"];
		$pass = $sms["password"];

		if (function_exists("curl_exec") == 1) {
			$sendurl = "http://$smsapi/sms?u=$user&p=$pass&m=$phone&c=" . urlencode($content);
			$result = $this->curlGet($sendurl);
			if ((trim(strval($result)) != "0") && (trim(strval($result)) != "")) {
				return "短信发送失败，错误码：" . $result . "。请确认支持curl或者fsocket，请联系您的空间商解决或者更换空间！";
			}

			return true;
		}
		else {
			include ("snoopy.php");
			$snoopy = new snoopy();
			$sendurl = "http://$smsapi/sms?u=$user&p=$pass&m=$phone&c=" . urlencode($content);
			$snoopy->fetch($sendurl);
			$result = $snoopy->results;
			if ((trim(strval($result)) != "0") && (trim(strval($result)) != "")) {
				return "短信发送失败，错误码：" . $result . "。请确认支持curl或者fsocket，请联系您的空间商解决或者更换空间！";
			}

			return true;
		}
	}

	private function postJson($url, $jsonData)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	public function curlGet($url, $method = "get", $data = "")
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}

	private function rippleos_auth_url($node)
	{
		$openid = ($_GET["wecha_id"] ? $_GET["wecha_id"] : "test_id");
		$this->rptk_err_msg = array("数据库错误", "请求格式错误", "参数不完整", "参数类型错误", "服务器错误", "节点不存在", "认证API ID或KEY错误", "不存在对应的OPENID");
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $openid);
		return json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/get_auth_url", json_encode($date)), true);
	}

	private function rippleos_auth_token($node)
	{
		$openid = ($_GET["wecha_id"] ? $_GET["wecha_id"] : "test_id");
		$this->rptk_err_msg = array("数据库错误", "请求格式错误", "参数不完整", "参数类型错误", "服务器错误", "节点不存在", "认证API ID或KEY错误", "不存在对应的OPENID");
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $openid);
		return json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/get_auth_token", json_encode($date)), true);
	}

	public function wifisuccess()
	{
		$times = time();
		$raw = array("use_time" => $times, "phone" => $this->_get("phone"), "user" => $this->_get("wecha_id"), "rptk_user_mac" => $this->_get("rptk_user_mac"), "rptk_key" => $this->_get("rptk_key"), "rptk_user_ip" => $this->_get("rptk_user_ip"), "wid" => $this->_get("id"));

		if ($this->_get("rptk_user_mac")) {
			d("Wifi_user")->add($raw);
		}

		$db = d("Wifi_keyword");
		$where = array("id" => $_GET["id"]);
		$info = $db->where($where)->find();
		$this->assign("info", $info);

		if ($info["suc_id"] == 3) {
			if ($info["suc_url"]) {
				header("Location: " . $info["suc_url"]);
			}
			else {
				header("Location: " . c("site_url"));
			}
		}
		else if ($info["suc_id"] == 1) {
			header("Location: ./index.php?g=Wap&m=Index&a=Index&token=" . $info["token"] . "&wecha_id=" . $_GET["wecha_id"]);
		}
		else {
			$where2 = array("wifi_id" => $info["id"], "type" => "1");
			$db2 = d("Wifi_ads");
			$head = $db2->where(array("wifi_id" => $info["id"], "type" => "4"))->order("id")->select();
			$this->assign("head", $head);
			$ads = $db2->where(array("wifi_id" => $info["id"], "type" => "5"))->order("id")->select();
			$this->assign("ads", $ads);
			$menulink = $db2->where(array("wifi_id" => $info["id"], "type" => "6"))->order("id")->select();
			$this->assign("menulink", $menulink);
			$bgpic = $db2->where(array("wifi_id" => $info["id"], "type" => "7"))->order("id")->select();
			$this->assign("bgpic", $bgpic);
			$temp_id = ($info["suc_tmpl"] ? $info["suc_tmpl"] : "2");
			$tmpl = d("Wifi_tmpl")->where(array("id" => $temp_id))->find();

			if ($tmpl["tpl"] == "weixin") {
				header("Location: ./index.php?g=Wap&m=Index&a=Index&token=" . $info["token"] . "&wecha_id=" . $_GET["wecha_id"] . "&wifisuccess=1");
			}

			$themes = "tpl/Home/wifi/" . $tmpl["tpl"] . "/";
			$this->assign("themes", $themes);
			$this->display("wifi/" . $tmpl["tpl"] . ":Index:" . ACTION_NAME);
		}
	}

	public function ads()
	{
		$id = $_GET["id"];
		$user = $_GET["wecha_id"];
		$hittime = time();
		$db = d("Wifi_ads");
		$where = array("id" => $id);
		$info = $db->where($where)->find();
		$where2 = array("ads_id" => $id, "user" => $user, "hittime" => $hittime);
		m("wifi_count")->add($where2);
		header("Location: " . $info["links"]);
	}
    // 用户登出
    public function logout() {
		session(null);
		session_destroy();
		unset($_SESSION);
        redirect(U('Home/Index/index'));
    }
	public function verify(){
		Image::buildImageVerify(4,1,'png',0,28,'verify');
	}
	public function verifyLogin(){
		Image::buildImageVerify(4,1,'png',0,28,'loginverify');
	}
	public function resetpwd(){
		$uid=$this->_get('uid','intval');
		$code=$this->_get('code','trim');
		$rtime=$this->_get('resettime','intval');
		$info=M('Users')->find($uid);
		if( (md5($info['uid'].$info['password'].$info['email'])!==$code) || ($rtime<time()) ){
			$this->error('非法操作',U('Index/index'));
		}
		$this->assign('uid',$uid);
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function fc(){
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function about(){
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function price(){
		$groupWhere=array();
		$groupWhere['status']=1;
		if (C('agent_version')){
			$groupWhere['agentid']=$this->agentid;
		}
		$groups=M('User_group')->where($groupWhere)->order('id ASC')->select();
		$this->assign('groups',$groups);
		$count=count($groups);
		$this->assign('count',$count);
		//
		$prices=array();
		$isCopyright=array();
		$wechatNums=array();
		$diynums=array();
		$connectnums=array();
		$activitynums=array();
		$create_card_nums=array();
		if ($groups){
			foreach ($groups as $g){
				array_push($prices,$g['price']);
				array_push($isCopyright,$g['copyright']);
				array_push($wechatNums,$g['wechat_card_num']);
				array_push($diynums,$g['diynum']);
				array_push($connectnums,$g['connectnum']);
				array_push($activitynums,$g['activitynum']);
				array_push($create_card_nums,$g['create_card_num']);
			}
		}
		$this->assign('prices',$prices);
		$this->assign('copyrights',$isCopyright);
		$this->assign('wechatNums',$wechatNums);
		$this->assign('diynums',$diynums);
		$this->assign('connectnums',$connectnums);
		$this->assign('activitynums',$activitynums);
		$this->assign('create_card_nums',$create_card_nums);
		//
		if (C('agent_version')&&$this->agentid){
			$funs=M('Agent_function')->where(array('status'=>1,'agentid'=>$this->agentid))->order('gid DESC')->select();
		}else {
			$funs=M('Function')->where(array('status'=>1))->order('gid DESC')->select();
		}
		if ($funs){
			$i=0;
			foreach ($funs as $f){
				$funs[$i]['access']=array();
				if ($groups){
					foreach ($groups as $g){
						if ($f['gid']>$g['id']){
							$canUse=0;
						}else {
							$canUse=1;
						}
						array_push($funs[$i]['access'],$canUse);
					}
				}
				$i++;
			}
		}
		$this->assign('funs',$funs);
		//
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function help(){
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	function think_encrypt($data, $key = '', $expire = 0) {
		$key  = md5(empty($key) ? C('DATA_AUTH_KEY') : $key);
		$data = base64_encode($data);
		$x    = 0;
		$len  = strlen($data);
		$l    = strlen($key);
		$char = '';

		for ($i = 0; $i < $len; $i++) {
			if ($x == $l) $x = 0;
			$char .= substr($key, $x, 1);
			$x++;
		}

		$str = sprintf('%010d', $expire ? $expire + time():0);

		for ($i = 0; $i < $len; $i++) {
			$str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1)))%256);
		}
		return str_replace('=', '',base64_encode($str));
	}

	function common(){
		$where['status']=1;
		if (C('agent_version')){
			$where['agentid']=$this->agentid;
		}
		$cases=M('Case')->where($where)->order('id DESC')->select();
		$this->assign('cases',$cases);
		$this->display($this->home_theme.':Index:'.ACTION_NAME);
	}
	public function isMobile()
	{
		$mobile = array();
		static $mobilebrowser_list = "Mobile|iPhone|Android|WAP|NetFront|JAVA|OperasMini|UCWEB|WindowssCE|Symbian|Series|webOS|SonyEricsson|Sony|BlackBerry|Cellphone|dopod|Nokia|samsung|PalmSource|Xphone|Xda|Smartphone|PIEPlus|MEIZU|MIDP|CLDC";

		if (preg_match("/$mobilebrowser_list/i", $_SERVER["HTTP_USER_AGENT"], $mobile)) {
			return true;
		}
		else if (preg_match("/(mozilla|chrome|safari|opera|m3gate|winwap|openwave)/i", $_SERVER["HTTP_USER_AGENT"])) {
			return false;
		}
		else if ($_GET["mobile"] === "yes") {
			return true;
		}
		else {
			return false;
		}
	}
}

?>
