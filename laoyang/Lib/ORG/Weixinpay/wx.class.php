<?php
/**
*   微信交互基础函数
*/

class weixinbase
{
	public $appid;
	public $appSecret;
	function __construct($appid,$appSecret)
	{
		$this->appid=$appid;
		$this->appSecret=$appSecret;
		
	}
	
	//* 获取 access_token : access_token是公众号的全局唯一票据* 
	public function get_access_token(){
		
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appSecret."";
		$html = $this->curlGet($url);
		$obj = json_decode($html);
		$access_token = $obj->access_token;	//返回access_token {"access_token":"ACCESS_TOKEN","expires_in":7200}
		return $access_token;
	}
	
	
	 /*
		使用refresh_token进行刷新，refresh_token拥有较长的有效期（7天、30天、60天、90天
	*/
	public function refresh_time($refresh_token){
		
		$html = $this->get_url_contents($url);
		$obj = json_decode($html);
		return $obj;
		
	}
	/*
		拉取用户信息(需scope为 snsapi_userinfo)
	
		openid  用户的唯一标识  
		nickname  用户昵称  
		sex  用户的性别，值为1时是男性，值为2时是女性，值为0时是未知  
		province  用户个人资料填写的省份  
		city  普通用户个人资料填写的城市  
		country  国家，如中国为CN  
		headimgurl  用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空  
		privilege  用户特权信息，json 数组，如微信沃卡用户为（chinaunicom 
	
	*/
	public function curlGet($url, $method = 'get', $data = '')
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}	
	public function get_userinfo($access_token,$openid){
		
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."";
		$html = $this->get_url_contents($url);
		$obj = json_decode($html);
		return $obj;
	}
	
	//客服功能 向购买支付成功的用户发送信息
	public function kefu_response($userOpenID,$content){
		$txt = '{
			"touser":"'.$userOpenID.'",
			"msgtype":"text",
			"text":
			{
				 "content":"'.$content.'"
			}
		}';
				
		$access_token = $this->get_access_token();
		$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$access_token;
		$obj = $this->https_post($url,$txt);
		$obj = json_decode($obj);		 
		return $obj->errmsg;
	}
	
	//* 向远程网址发送POST信息*
	
	public function https_post($url,$data)
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url); 
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		if (curl_errno($curl)) {
		   return 'Errno'.curl_error($curl);
		}
		curl_close($curl);
		return $result;
	}
	
	//* 获取远程地址数据函数 * 
	
	public function get_url_contents($url) {
		if (function_exists('file_get_contents')) {
			$file_contents = @file_get_contents($url);
		}
		if ($file_contents == '') {
			$ch = curl_init();
			$timeout = 30;
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}

	
	
	
}



?>