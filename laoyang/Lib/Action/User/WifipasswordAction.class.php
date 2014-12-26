<?php
class WifipasswordAction extends UserAction{
	//配置
	public function index(){
		$wifipassword=M('Wifipassword')->where(array('token'=>session('token')))->find();
		if(IS_POST){
			if($wifipassword==false){				
				$this->all_insert('Wifipassword','/index');
			}else{
				$_POST['id']=$wifipassword['id'];
				$this->all_save('Wifipassword','/index');				
			}
		}else{
			if(isset($_GET["login"]))
			{
				$type=$this->_get('login');

/* 
				$login_url = 'http://wifi.yckjx.com/member/login_chk.asp';

				//cookie文件存放在网站根目录的temp文件夹下
				$cookie_file = tempnam('./temp','cookie');

				$ch = curl_init($login_url);// 初始化一个的curl对话

				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5');//为一个的curl设置对话参数

				//CURLOPT_USERAGENT

				//在HTTP请求中包含一个的”user-agent”头的char串。
				 
				curl_setopt($ch, CURLOPT_HEADER, 0);

				//CURLOPT_HEADER为false，则应用CURL_TIMECOND_ISUNMODSINCE，默认 value为 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				//在启用CURLOPT_RETURNTRANSFER时间将获取数据返回
				curl_setopt($ch, CURLOPT_MAXREDIRS, 1);

				//CURLOPT_MAXREDIRS
				 

				//指定最多的HTTP重定向的数量，那个选项是和CURLOPT_FOLLOWLOCATION一起应用的。
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				//启用时会将服务器服务器返回的“Location:”放在header中递归的返回给服务器，应用CURLOPT_MAXREDIRS没成绩限定递归返回的数量。
				curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
				//自动设置header中的referer消息
				curl_setopt($ch, CURLOPT_POST, 1);
				//启用时会发送一个的常规的POST请求，类别为：application/x-www-form-urlencoded，就像表单提交的相同。
				curl_setopt($ch, CURLOPT_POSTFIELDS,"rm=0&uname=shop031&upass=shop031@abc");
				//在HTTP中的“POST”操作。假如要传送一个的文档，需求一个的@开头的文档名
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
				//连接关闭以后，存放cookie消息的文档名称
				$result = curl_exec($ch);
				//print_r($result);die();
				curl_close($ch);

				//带上cookie文件，访问人人网首页
				$send_url='http://wifi.yckjx.com/member/shopinfo.asp';
				$ch = curl_init($send_url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
				$contents = curl_exec($ch);
				curl_close($ch);

				//清理cookie文件
				unlink($cookie_file);

				输出网页内容
				// print_r($contents); */
				
			}
			//dump($wifipassword);
			$this->assign('wifipassword',$wifipassword);
			$this->display();
		}
	}
}
?>