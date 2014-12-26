<?php
class APAction extends UserAction
{
	const AUTHCAT_NODE_API = "https://api.authcat.org";
	const AUTHCAT_CREATE_NODE = "/node_api/create_node";
	const AUTHCAT_UPDATE_NODE = "/node_api/update_node";
	const AUTHCAT_RETRIEVE_NODE = "/node_api/retrieve_node";
	const AUTHCAT_DELETE_NODE = "/node_api/delete_node";
	const DB_ERROR = "操作数据库失败";
	const WX_NAME_ERROR = "微信公众号不存在";

	public function _initialize()
	{
		parent::_initialize();
		$this->canUseFunction("wifi");
		parent::_initialize();
		$this->node_api_id = c("rptk_node_api_id");
		$this->node_api_key = c("rptk_node_api_key");
		$this->bind_name = c("rptk_bind_name");
		$this->bind_key = c("rptk_bind_key");
		$this->wx_auth_api_id = c("rptk_wx_auth_api_id");
		$this->wx_auth_api_key = c("rptk_wx_auth_api_key");
		$this->err_msg = array(" ", "请求格式错误", "参数不完整", "参数类型错误", "服务器错误", "节点不存在", "节点API ID或KEY错误", "节点名重复");
	}

	public function index()
	{
		$apModel = m("Wifi_keyword");
		$data["uid"] = session("uid");
		$data["token"] = session("token");
		$list = $apModel->where($data)->select();

		if (IS_POST) {
			$key = $this->_post("searchkey");

			if (empty($key)) {
				exit("关键词不能为空.");
			}
		}

		$this->assign("list", $list);
		$this->display();
	}

	public function delete()
	{
		$ap = m("ApNodes");
		$where = array("id" => intval($_GET["id"]));
		$rt = $ap->where($where)->delete();

		if ($rt == true) {
			$this->success("删除成功", u("AP/index"));
		}
		else {
			$this->error("服务器繁忙,请稍后再试", u("AP/index"));
		}
	}

	public function add()
	{
		$id = $_GET["id"];

		if ($_POST) {
			if (!$id) {
				$where = array("token" => $this->get("token"), "tmpl" => 1, "suc_tmpl" => 1);
				
				$_POST["id"] = d("Wifi_keyword")->add($where);

			}

			$data = $_POST;
			$apinfo = d("Wifi_keyword")->where("id = '$id'")->find();

			if (!$apinfo["node"]) {
				$ret = $this->rptk_create($data);
			}
			else {
				$ret = $this->rptk_edit($data);
			}

			if (is_string($ret)) {
				$this->error($ret, u("AP/add"));
			}
			else {
				$this->success("修改成功", u("AP/index"));
			}
		}
		else {
			if ($_GET["id"]) {
				$apinfo = d("Wifi_keyword")->where("id = '$id'")->find();
				$this->assign("ap", $apinfo);
			}

			if ($apinfo["node"]) {
				$node_info = array();

				if (!$this->rptk_display($node_info, $id)) {
					return NULL;
				}

				$this->assign("node_info", $node_info);
			}

			$where["uid"] = session("uid");
			$where["token"] = session("token");
			$wxuser = m("Wxuser");
			$webs = $wxuser->where($where)->find();
			$this->assign("webs", $webs);
			$this->display();
		}
	}

	public function wxsave()
	{
		$this->all_save("Wxuser");
	}

	public function deleteAP()
	{
		$token = session("token");
		$node = d("Wifi_keyword")->where(array("token" => $token, "id" => $_GET["id"]))->find();

		if (is_array($node)) {
			$this->rptk_delete_node($node["node"]);
			m("Keyword")->where(array("module" => "RippleOS_url", "token" => $token, "pid" => $_GET["id"]))->delete();
			m("Keyword")->where(array("module" => "RippleOS_code", "token" => $token, "pid" => $_GET["id"]))->delete();
			d("Wifi_keyword")->where(array("token" => $token, "id" => $_GET["id"]))->delete();
		}

		$this->success("清除成功", u("AP/index"));
	}

	private function rptk_create($input)
	{
		$wx = d("Wxuser")->where(array("token" => session("token")))->find();

		if ($wx == false) {
			return self::WX_NAME_ERROR;
		}

		$node_info = array();
		$node_info = $input;
		$node_info["wx_id"] = $wx["weixin"];
		$node_info["wx_name"] = $wx["wxname"];
		$node_info["name"] = $this->_post("name");
		$node_info["login_url"] = c("site_url") . "/index.php?g=Home&m=Index&a=wifi&id=" . $input["id"];
		$node_info["success_url"] = c("site_url") . "/index.php?g=Home&m=Index&a=wifisuccess&id=" . $input["id"];

		if ($node_info["name"]) {
			$authcat_id = $this->rptk_update_node(NULL, $node_info);
		}

		if ($authcat_id < 0) {
			return $this->err_msg[abs($authcat_id)];
		}

		$keyword = array("keyword" => $input["keyword"], "shop_name" => $input["shop_name"], "title" => $input["title"], "wx_pic" => $input["wx_pic"], "shoplogo" => $input["shoplogo"], "copyright" => $input["copyright"], "token" => $this->token, "ewm" => $input["ewm"], "wx_id" => $wx["wxid"], "wx" => $input["wx"], "name" => $input["name"], "address" => $input["address"], "phone" => $input["phone"], "node" => $authcat_id, "about" => $input["about"]);

		if (!$this->rptk_add_keyword($keyword, $input["id"])) {
			$this->rptk_delete_node($authcat_id);
			return self::DB_ERROR;
		}

		return true;
	}

	private function rptk_edit($input)
	{
		$data = d("Wifi_keyword");
		$node = d("Wifi_keyword")->where(array("token" => session("token")))->find();
		$wx = d("Wxuser")->where(array("token" => session("token")))->find();

		if ($wx == false) {
			return self::WX_NAME_ERROR;
		}

		$node_info = array();
		$node_info = $input;
		unset($input["wx_id"]);
		unset($input["wx_name"]);
		$node_info["wx_id"] = $wx["weixin"];
		$node_info["wx_name"] = $wx["wxname"];
		$authcat_id = $this->rptk_update_node($node["node"], $node_info);

		if ($authcat_id < 0) {
			return $this->err_msg[abs($authcat_id)];
		}

		$keyword = array("keyword" => $this->_post("keyword"), "title" => $this->_post("title"), "shop_name" => $this->_post("shop_name"), "wx_pic" => $this->_post("wx_pic"), "shoplogo" => $this->_post("shoplogo"), "copyright" => $this->_post("copyright"), "wx_id" => $wx["wxid"], "wx" => $this->_post("wx"), "ewm" => $this->_post("ewm"), "address" => $this->_post("address"), "phone" => $this->_post("phone"), "about" => $this->_post("about"));

		if (!$this->rptk_update_keyword($keyword, $input["id"])) {
			return self::DB_ERROR;
		}

		return true;
	}

	private function rptk_add_keyword($keyword, $id)
	{
		$data = d("Wifi_keyword");

		if ($id = $data->where(array("id" => $id))->save($keyword)) {
			$da["pid"] = $id;
			$da["module"] = "wifi";
			$da["token"] = session("token");
			$da["keyword"] = $keyword["keyword"];
			m("Keyword")->add($da);
			return true;
		}
		else {
			return false;
		}
	}

	private function rptk_update_keyword($keyword, $id)
	{
		$data = d("Wifi_keyword");
		$node = d("Wifi_keyword")->where(array("token" => session("token"), "id" => $id))->find();

		if ($data->where(array("id" => $node["id"]))->save($keyword)) {
			$wh = array();
			$wh["pid"] = $node["id"];
			$wh["module"] = "wifi";
			$wh["token"] = session("token");
			m("Keyword")->where($wh)->save(array("keyword" => $keyword["keyword"]));
		}

		return true;
	}

	private function rptk_display(&$node_info, $id)
	{
		if ((strlen($this->node_api_id) == 0) || (strlen($this->node_api_key) == 0) || (strlen($this->wx_auth_api_id) == 0) || (strlen($this->wx_auth_api_key) == 0)) {
			echo "请联系管理员开通微WIFI功能";
			return false;
		}

		$node = d("wifi_keyword")->where(array("token" => session("token"), "id" => $id))->find();

		if (is_array($node)) {
			
			$node_info = $this->rptk_retrieve_node($node["node"]);

			if ($node_info["status"] < 0) {
				echo $this->err_msg[abs($node_info["status"])];
				return false;
			}

			$node_info["created_at"] = date("Y-m-d H:i:s", $node_info["create_time"]);
			$node_info["updated_at"] = date("Y-m-d H:i:s", $node_info["update_time"]);
			$node_info["is_portal"] = ($node_info["is_portal"] ? "1" : "0");
			$node_info["hide_cp"] = ($node_info["hide_cp"] ? "1" : "0");
			$node_info["keyword"] = $node["keyword"];
			$node_info["code_keyword"] = $node["code_keyword"];
			$node_info["text"] = $node["text"];
		}

		$node_info["bind_name"] = $this->bind_name;
		$node_info["bind_key"] = $this->bind_key;
		$node_info["token"] = session("token");
		return true;
	}

	private function rptk_update_node($authcat_id, $input_info)
	{
		if (!is_array($input_info)) {
			return -1;
		}

		$node_info = array("api_id" => $this->node_api_id, "api_key" => $this->node_api_key, "login_url" => $input_info["login_url"], "success_url" => $input_info["success_url"], "login_timeout" => intval($input_info["login_timeout"] == NULL ? 1440 : $input_info["login_timeout"]), "is_portal" => $input_info["is_portal"] == "1" ? true : false, "weixin_login" => true, "wx_id" => $input_info["wx_id"], "wx" => $input_info["wx"], "copyright" => $input_info["copyright"], "shoplogo" => $input_info["shoplogo"], "wx_name" => $input_info["wx_name"], "description" => $input_info["shop_name"], "wx_unauth_timeout" => empty($input_info["wx_unauth_timeout"]) ? 10 : intval($input_info["wx_unauth_timeout"]), "wx_reject_timeout" => empty($input_info["wx_reject_timeout"]) ? 3 : intval($input_info["wx_reject_timeout"]), "hide_cp" => $input_info["hide_cp"] == "1" ? true : false, "auth2nd" => intval($input_info["auth2nd"]));

		if ($authcat_id == NULL) {
			$node_info["name"] = $input_info["name"];

			if (!empty($input_info["white_list"])) {
				$node_info["white_list"] = $input_info["white_list"];
			}

			$receive = $this->rptk_send_msg(self::AUTHCAT_CREATE_NODE, $node_info);
		}
		else {
			$node_info["node"] = intval($authcat_id);
			$node_info["white_list"] = (empty($input_info["white_list"]) ? NULL : $input_info["white_list"]);
			$receive = $this->rptk_send_msg(self::AUTHCAT_UPDATE_NODE, $node_info);
		}

		if ($receive["status"] === 0) {
			return $receive["node"];
		}

		return $receive["status"];
	}

	public function rptk_delete_node($authcat_id)
	{
		$node_info = array("api_id" => $this->node_api_id, "api_key" => $this->node_api_key, "node" => intval($authcat_id));
		$receive = $this->rptk_send_msg(self::AUTHCAT_DELETE_NODE, $node_info);

		if ($receive["status"] == 0) {
			return 0;
		}

		return -1;
	}

	private function rptk_retrieve_node($authcat_id)
	{
		$node_info = array("api_id" => $this->node_api_id, "api_key" => $this->node_api_key, "node" => intval($authcat_id));
		$receive = $this->rptk_send_msg(self::AUTHCAT_RETRIEVE_NODE, $node_info);
		$receive["created_at"] = date("Y-m-d H:i:s", $receive["create_time"]);
		$receive["updated_at"] = date("Y-m-d H:i:s", $receive["update_time"]);
		return $receive;
	}

	private function rptk_send_msg($action, $msg)
	{
		$ret = json_decode($this->rptk_post_json(self::AUTHCAT_NODE_API . $action, json_encode($msg)), true);

		if (!is_array($ret)) {
			return array("status" => -999, "err_msg" => "Received nothing");
		}

		return $ret;
	}

	private function rptk_post_json($url, $jsonData)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
?>
