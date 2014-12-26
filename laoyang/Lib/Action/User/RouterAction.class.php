<?php
class RouterAction extends UserAction
{
	public $tokenWhere;
	public $server;

	public function _initialize()
	{
		parent::_initialize();
		$this->tokenWhere = array("token" => $this->token);
		$this->server = "http://service.rippletek.com/Portal/Wx/wxFunLogin";
	}

	public function index()
	{
		header("Location: index.php?g=User&m=rippleOS&a=set");
		$this->display();
	}

	public function userlist()
	{
		$db = d("Wifi_user");
		$wid = $_GET["id"];

		if ($wid) {
			$where = array("wid" => $wid);
			$list = $db->field("*,count(*) as count")->where($where)->group("rptk_user_mac")->select();
			$this->assign("wid", $wid);
		}
		else {
			$where = array("token" => $this->token);
			$info = d("Wifi_keyword")->where($where)->select();

			if (count($info) == 1) {
				$info = $info[0];
			}

			$this->assign("wid", $info["id"]);
			$list = $db->field("*,count(*) as count")->where(array("wid" => $info["id"]))->group("rptk_user_mac")->select();
		}

		$this->assign("list", $list);
		$this->display();
	}

	public function unauth_user()
	{
		$where["id"] = intval($_GET["id"]);
		$suc = d("Wifi_user")->where($where)->find();
		$info = d("Wifi_keyword")->where(array("token" => $this->token))->find();

		if (!$suc["rptk_user_mac"]) {
			$this->error("踢除不成功!", u("Router/userlist"));
			header("Location: index.php?g=User&m=Router&a=userlist&id=" . $suc["wid"]);
			exit();
		}
		else {
			$rt = $this->get_openid($info["node"], $suc["rptk_user_mac"]);

			if ($rt["status"] == "-7") {
				$header("Location: index.php?g=User&m=Router&a=userlist&id=" . $suc["wid"]);
			}

			$this->success("剔除成功", u("Router/userlist", array("id" => $suc["wid"])));
			header("Location: index.php?g=User&m=Router&a=userlist&id=" . $suc["wid"]);
			exit();
		}

		print_r($rt);
		exit();
		$this->display();
		$this->success("删除成功", u("Router/success"));
		rippleos_unauth($node, $openid);
		header("Location: index.php?g=User&m=Router&a=" . $type);
	}

	public function adslist()
	{
		$db = d("Wifi_keyword");
		$where = array("token" => $this->token);
		$info = $db->where($where)->find();
		$where2 = array("wifi_id" => $info["id"]);
		$info = d("wifi_ads")->where($where2)->select();
		$list = array();

		foreach ($info as $key => $val ) {
			$val["list_info"] = d("wifi_count")->where(array("ads_id" => $val["id"]))->select();
			$val["count"] = d("wifi_count")->where(array("ads_id" => $val["id"]))->count();
			$list[] = $val;
		}

		$this->assign("list", $list);
		$this->assign("tab", "adslist");
		$this->display();
	}

	public function tmpl()
	{
		$this->assign("wid", $_GET["id"]);
		$tpl = d("Wifi_tmpl")->where(array("status" => 1))->select();
		$info = d("Wifi_keyword")->where(array("token" => $this->token, "id" => $_GET["wid"]))->find();
		$info["temp"] = (isset($_GET["wid"]) ? intval($info["temp"]) : 0);
		$this->assign("tpl", $tpl);
		$this->assign("info", $info);
		$this->display();
	}

	public function selecttmpl()
	{
		$data = array($_GET["type"] => $_GET["style"]);
		$ret = d("Wifi_keyword")->where(array("id" => $_GET["wid"]))->save($data);

		if ($_GET["type"] == "tmpl") {
			header("Location: index.php?g=User&m=Router&a=rzdisplay&menu=wifi&id=" . $_GET["wid"]);
		}
		else {
			header("Location: index.php?g=User&m=Router&a=success&menu=wifi&id=" . $_GET["wid"]);
		}
	}

	public function setrzdisplay()
	{
		$data = array("rz_id" => $_GET["rz_id"]);
		$ret = d("Wifi_keyword")->where(array("id" => $_GET["id"]))->save($data);
		header("Location: index.php?g=User&m=Router&a=rzdisplay&menu=wifi&id=" . $_GET["id"]);
	}

	public function setsuccess()
	{
		$data = array("suc_id" => $_GET["suc_id"]);
		$ret = d("Wifi_keyword")->where(array("id" => $_GET["id"]))->save($data);
		header("Location: index.php?g=User&m=Router&a=success&menu=wifi&id=" . $_GET["id"]);
	}

	public function rzdisplay()
	{
		$db = d("Wifi_keyword");
		$this->assign("wid", $_GET["id"]);

		if (IS_POST) {
			$post = $this->_post();
			$data = array("settime" => 0, "rztype" => $post["rztype"], "rz_url" => $post["rz_url"], "otherinfo" => $post["otherinfo"]);

			if ($post["djs"]) {
				$data["settime"] = $post["settime"];
			}

			$rs = $db->where(array("token" => $this->token, "id" => $post["id"]))->save($data);

			for ($i = 0; $i < count($post["ad_title"]); $i++) {
				if ($post["ad_id"][$i]) {
					$adlist["title"] = $post["ad_title"][$i];
					$adlist["pic"] = $post["ad_pic"][$i];
					$adlist["links"] = $post["ad_links"][$i];
					$ref = d("Wifi_ads")->where(array("id" => $post["ad_id"][$i]))->save($adlist);
				}
				else {
					$raw = array("wifi_id" => $post["id"], "title" => $post["ad_title"][$i], "pic" => $post["ad_pic"][$i], "type" => $post["type"][$i], "links" => $post["ad_links"][$i]);
					d("Wifi_ads")->add($raw);
				}
			}

			header("Location: index.php?g=User&m=Router&a=rzdisplay&menu=wifi&id=" . $_GET["id"]);
		}

		if ($_GET["id"]) {
			$where = array("token" => $this->token, "id" => $_GET["id"]);
			$info = $db->where($where)->find();
		}
		else {
			$where = array("token" => $this->token);
			$info = $db->where($where)->select();

			if (count($info) == 1) {
				$info = $info[0];
				$this->assign("wid", $info["id"]);
			}
		}

		$this->assign("info", $info);
		$teml = d("Wifi_tmpl")->where(array("id" => $info["tmpl"]))->find();
		$this->assign("teml", $teml);
		$db2 = d("Wifi_ads");
		$head = $db2->where(array("wifi_id" => $info["id"], "type" => "0"))->order("id")->select();
		$this->assign("head", $head);
		$ads = $db2->where(array("wifi_id" => $info["id"], "type" => "1"))->order("id")->select();
		$this->assign("ads", $ads);
		$menulink = $db2->where(array("wifi_id" => $info["id"], "type" => "2"))->order("id")->select();
		$this->assign("menulink", $menulink);
		$bgpic = $db2->where(array("wifi_id" => $info["id"], "type" => "3"))->order("id")->select();
		$this->assign("bgpic", $bgpic);
		$this->display();
	}

	public function success()
	{
		$this->assign("wid", $_GET["id"]);
		$db = d("Wifi_keyword");

		if (IS_POST) {
			$post = $this->_post();
			$data = array("suc_url" => $post["suc_url"]);
			$db->where(array("token" => $this->token))->save($data);

			for ($i = 0; $i < count($post["ad_title"]); $i++) {
				if ($post["ad_id"][$i]) {
					$adlist["title"] = $post["ad_title"][$i];
					$adlist["pic"] = $post["ad_pic"][$i];
					$adlist["links"] = $post["ad_links"][$i];
					$ref = d("Wifi_ads")->where(array("id" => $post["ad_id"][$i]))->save($adlist);
				}
				else {
					$raw = array("wifi_id" => $post["id"], "title" => $post["ad_title"][$i], "pic" => $post["ad_pic"][$i], "links" => $post["ad_links"][$i], "type" => "4");
					d("Wifi_ads")->add($raw);
				}
			}

			header("Location: index.php?g=User&m=Router&a=success&menu=wifi&id=" . $_GET["id"]);
		}

		if ($_GET["id"]) {
			$where = array("token" => $this->token, "id" => $_GET["id"]);
			$info = $db->where($where)->find();
			$where3 = array("id" => $info["suc_tmpl"]);
			$tmpl = d("Wifi_tmpl")->where($where3)->find();
			$info["suc_tmpl"] = $tmpl["title"];
		}
		else {
			$where = array("token" => $this->token);
			$info = $db->where($where)->select();

			if (count($info) == 1) {
				$info = $info[0];
			}

			$this->assign("wid", $info["id"]);
		}

		$db2 = d("Wifi_ads");
		$where2 = array("wifi_id" => $info["id"], "type" => "4");
		$wifi = $db2->where($where2)->order("id")->select();
		$this->assign("ads", $wifi);
		$this->assign("info", $info);
		$this->assign("tab", "success");
		$this->display();
	}

	public function delete()
	{
		$where = array();
		$where["token"] = $this->token;
		$where["id"] = intval($_GET["id"]);
		m("Wifi_keyword")->where($where)->delete();
		$this->success("删除成功", u("Router/index"));
	}

	public function del_ads()
	{
		$where["id"] = intval($_GET["id"]);
		$type = $_GET["type"];
		$suc = d("Wifi_ads")->where($where)->delete();
		$this->success("删除成功", u("Router/success"));
		header("Location: index.php?g=User&m=Router&a=" . $type);
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

	private function rippleos_unauth($node, $openid)
	{
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $openid);
		$ret = json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/unauth_user", json_encode($date)), true);
		return NULL;
	}

	private function get_openid($node, $mac)
	{
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "mac" => $mac);
		$ret = json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/get_openid_by_mac", json_encode($date)), true);
		return NULL;
	}

	public function curlPost($url, $data, $showError = 1)
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno = curl_errno($ch);

		if ($errorno) {
			exit("curl error:" . $errorno);
		}
		else {
			return $tmpInfo;
		}
	}

	public function curlGet($url)
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
}
?>
