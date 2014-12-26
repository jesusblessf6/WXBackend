<?php
final class Sms {
	public $topdomain;
	public $key;
	public $smsapi_url;
	public $pay_config;
	/**
	 * 
	 * 初始化接口类
	 * @param int $userid 用户id
	 * @param int $productid 产品id
	 * @param string $sms_key 密钥
	 */
	public function __construct() {
		
	}
	
	public function checkmobile($mobilephone) {
		$mobilephone = trim($mobilephone);
		if(preg_match("/^13[0-9]{1}[0-9]{8}$|15[01236789]{1}[0-9]{8}$|18[01236789]{1}[0-9]{8}$/",$mobilephone)){
			return  $mobilephone;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 * 批量发送短信
	 * @param array $mobile 手机号码
	 * @param string $content 短信内容
	 * @param datetime $send_time 发送时间
	 * @param string $charset 短信字符类型 gbk / utf-8
	 * @param string $id_code 唯一值 、可用于验证码
	 */
	public function sendSms($token, $content='',$mobile='', $send_time='', $charset='utf-8',$id_code = '') {
		$companyid=0;
		if(!(strpos($token,'_') === FALSE)){
			$sarr=explode('_',$token);
			$token=$sarr[0];
			$companyid=intval($sarr[1]);
		}
		if (!$mobile){
			$companyWhere=array();
			$companyWhere['token']=$token;
			if ($companyid){
				$companyWhere['id']=$companyid;
			}
			$company=M('Company')->where($companyWhere)->find();
			$mobile=$company['mp'];
		}
		$thisWxUser=M('Wxuser')->where(array('token'=>Sms::_safe_replace($token)))->find();
		$user=$thisWxUser['smsuser'];//短信平台帐号
		$pass=md5($thisWxUser['smspassword']);//短信平台密码
		$content .= '【'.$thisWxUser['subfix'].'】'; //加后缀

		if ($user && $content) {
			$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$mobile.'&c='.urlencode($content));
		}

	}
		
	//发邮件函数
	public function send_email($token,$Subject,$body,$to_email){
		$info=M('wxuser')->where(array('token'=>$token))->find();
		$emailuser=$info['emailuser'];
		$emailpassword=$info['emailpassword'];
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
		$mail->FromName =  "平台系统自动发送";  // 发件人    
		//$mail->AddAddress($to_email, '商户');
        $mail->AddReplyTo($emailuser."@qq.com",'微商城');
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
	public function wxfahuo($token,$out_trade_no,$transaction_id,$openid) {
		$pay_config =M('payment')->where(array('token'=>$token,'pay_code'=>'wxpay'))->find();
		$this->pay_config = unserialize($pay_config['pay_config']);
		$this->wxuser = D('Wxuser') -> where(array('token' => $this -> token)) -> find();
		$obj['deliver_timestamp'] = time();
		$obj['appid']          = $this->pay_config['appId'];
		$obj['appkey']         = $this->pay_config['appKey'];
		$obj['openid']         = $openid;
		$obj['transid']        = $transaction_id;
		$obj['out_trade_no']   = $out_trade_no;
		$obj['deliver_status'] = "1";
		$obj['deliver_msg']    = "OK";
		import("@.ORG.Weixinpay.WxPayHelper");	
		$WxPayHelper = new WxPayHelper($this->pay_config['appid'],$this->pay_config['appkey'],$this->pay_config['partnerKey']);
		$sign = $WxPayHelper->get_sign($obj);
		$txt = '{
			"appid" : "'.$obj['appid'].'", 
			"openid" : "'.$obj['openid'].'", 
			"transid" : "'.$obj['transid'].'", 
			"out_trade_no" : "'.$obj['out_trade_no'].'", 
			"deliver_timestamp" : "'.$obj['deliver_timestamp'].'", 
			"deliver_status" : "'.$obj['deliver_status'].'", 
			"deliver_msg" : "'.$obj['deliver_msg'].'", 
			"app_signature" : "'.$sign.'", 
			"sign_method" : "sha1"
		}';	
		$where = array('token' => $token);
		$thisWxUser = M('Wxuser')->where($where)->find();	
		$wx = new weixinbase($thisWxUser['appid'],$thisWxUser['appsecret']);
		$access_token = $wx->get_access_token();
		$url = "https://api.weixin.qq.com/pay/delivernotify?access_token=".$access_token;
		$status = $wx->https_post($url,$txt);
		$status = json_decode($status);
		if($status->errmsg=="ok"){
			//如果发货成功，则向客服发送微信文本信息
			$msgcontent = "尊敬的用户，我们已经收到订单号：".$obj['out_trade_no']." 支付成功订单，已经为您安排发货了哦！ ";
			$wx->kefu_response($obj['openid'],$msgcontent);
		}
		return $status->errmsg;
		//return $s_status;

	}

	/**
	 *  post数据
	 *  @param string $url		post的url
	 *  @param int $limit		返回的数据的长度
	 *  @param string $post		post数据，字符串形式username='dalarge'&password='123456'
	 *  @param string $cookie	模拟 cookie，字符串形式username='dalarge'&password='123456'
	 *  @param string $ip		ip地址
	 *  @param int $timeout		连接超时时间
	 *  @param bool $block		是否为阻塞模式
	 *  @return string			返回字符串
	 */
	private function _post($url, $limit = 0, $post = '', $cookie = '', $ip = '', $timeout = 15, $block = true) {
		$return = '';
		$url=str_replace('&amp;','&',$url);
		$matches = parse_url($url);
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;
		$siteurl = Sms::_get_url();
		if($post) {
			$out = "POST $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n" ;
			$out .= 'Content-Length: '.strlen($post)."\r\n" ;
			$out .= "Connection: Close\r\n" ;
			$out .= "Cache-Control: no-cache\r\n" ;
			$out .= "Cookie: $cookie\r\n\r\n" ;
			$out .= $post ;
		} else {
			$out = "GET $path HTTP/1.1\r\n";
			$out .= "Accept: */*\r\n";
			$out .= "Referer: ".$siteurl."\r\n";
			$out .= "Accept-Language: zh-cn\r\n";
			$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
			$out .= "Host: $host\r\n";
			$out .= "Connection: Close\r\n";
			$out .= "Cookie: $cookie\r\n\r\n";
		}
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		if(!$fp) return '';
		
		stream_set_blocking($fp, $block);
		stream_set_timeout($fp, $timeout);
		@fwrite($fp, $out);
		$status = stream_get_meta_data($fp);
	
		if($status['timed_out']) return '';	
		while (!feof($fp)) {
			if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n"))  break;				
		}
		
		$stop = false;
		while(!feof($fp) && !$stop) {
			$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
			$return .= $data;
			if($limit) {
				$limit -= strlen($data);
				$stop = $limit <= 0;
			}
		}
		@fclose($fp);
		var_export($return);
		exit();
		//部分虚拟主机返回数值有误，暂不确定原因，过滤返回数据格式
		$return_arr = explode("\n", $return);
		if(isset($return_arr[1])) {
			$return = trim($return_arr[1]);
		}
		unset($return_arr);
		
		return $return;
	}

	/**
	 * 获取当前页面完整URL地址
	 */
	private function _get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? Sms::_safe_replace($_SERVER['PHP_SELF']) : Sms::_safe_replace($_SERVER['SCRIPT_NAME']);
		$path_info = isset($_SERVER['PATH_INFO']) ? Sms::_safe_replace($_SERVER['PATH_INFO']) : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? Sms::_safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.Sms::_safe_replace($_SERVER['QUERY_STRING']) : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
	
	/**
	 * 安全过滤函数
	 *
	 * @param $string
	 * @return string
	 */
	private function _safe_replace($string) {
		$string = str_replace('%20','',$string);
		$string = str_replace('%27','',$string);
		$string = str_replace('%2527','',$string);
		$string = str_replace('*','',$string);
		$string = str_replace('"','&quot;',$string);
		$string = str_replace("'",'',$string);
		$string = str_replace('"','',$string);
		$string = str_replace(';','',$string);
		$string = str_replace('<','&lt;',$string);
		$string = str_replace('>','&gt;',$string);
		$string = str_replace("{",'',$string);
		$string = str_replace('}','',$string);
		$string = str_replace('\\','',$string);
		return $string;
	}	
}
?>