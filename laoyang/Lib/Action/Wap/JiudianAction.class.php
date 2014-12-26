<?php

//wap

class JiudianAction extends WapAction{

	public $token;

	public $wecha_id;

	public $Yuyue_model;

	public $yuyue_order;

	public function __construct(){

		

		parent::__construct();

		$this->token = isset($_REQUEST['token']) ? htmlspecialchars($_REQUEST['token']) : session('token');

		// $this->token = $this->_get('token');

		$this->assign('token',$this->token);

		$this->wecha_id	= $this->_get('wecha_id');

		if (!$this->wecha_id){

			$this->wecha_id='null';

		}

		$this->assign('wecha_id',$this->wecha_id);

		$this->Yuyue_model=M('yuyue');

		$this->yuyue_order=M('yuyue_order');
		
		$this->wxuser=M('wxuser');

		$this->type='Jiudian';



	}



	

	//预约列表

	public function index(){

		$pid = $this->_get('id');

		$wecha_id = $this->_get('wecha_id');

		$where = array('token'=> $this->_get('token'),'id'=>$pid);

		$data = $this->Yuyue_model->where($where)->find();

		$info = M('yuyue_setcin')->where(array('pid'=>$pid,'type'=>$this->type))->select();

		//print_r($info);die;

		$data['count'] = $this->yuyue_order->where(array('wecha_id'=> $wecha_id,'pid'=>$pid))->count();

		$data['token'] = $this->_get('token');

		$data['wecha_id'] = $wecha_id;

		//print_r($str);die;

		$this->assign('data', $data);

		$this->assign('info', $info);

		$this->assign('id', $pid);
		
		$this->display();

	}

	

	public function info(){

		$pid = $this->_get('id');

		$id = $this->_get('aid');

		$where = array('token'=> $this->_get('token'),'id'=>$pid);
		
		$data = $this->Yuyue_model->where($where)->find();
		
		//是否余额支付
		$user= M('Userinfo')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		
		$this->assign('yuer',$user['balance']);
		//是否支持在线支付
		$payment =M('payment')->where(array('token'=>$this->token,'enabled'=>1))->select();
		
		$this->assign('payment',$payment);

		$cast = array(

			'token'=> $this->_get('token'),

			'wecha_id'=> $this->_get('wecha_id')

		);

		$info = M('yuyue_setcin')->where(array('id'=>$id))->find();

		$info['sheng']=$info['yuanjia']-$info['youhui'];

		for($i=1;$i<6;$i++){

			if(!empty($info['pic'.$i])){

				$info['pic'][]=$info['pic'.$i];

				unset($info['pic'.$i]);

			}

		}

		$data['token'] = $this->_get('token');

		$data['wecha_id'] = $this->_get('wecha_id');

		$wap= M('setinfo')->where(array('pid'=>$pid))->select();

		$str=array();


		foreach($wap as $v){


			if($v['kind']==5){

				$str["message"]=$v["name"];

			}else{

				$str[$v["name"]]=$v["value"];

			}		

		}

		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();

		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();

		$i=0;

		foreach($list as $v){

			$list[$i]['value']= explode("|",$v['value']);

			$i++;

		}

		$this->assign('str', $str);

		$this->assign('arr',$arr);

		$this->assign('list',$list);

		$this->assign('data', $data);

		$this->assign('info', $info);

		$this->display();

	}

	

	//添加订单

	public function add(){

		//print_r($_POST());die;

		if(IS_POST){
			
			$_POST['date']= date("Y-m-d H:i:s",time());
			
			$paymode = 0;
			if(intval($_POST['payment'])== 1)
			{
				$paymode = 1;//到店付款
			}elseif(intval($_POST['payment'])== 2){
				$paymode = 2;//余额支付
			}else{
				$paymode = 3;//在线支付
			}		
			$_POST['paymode'] = $paymode;
			
			$_POST['orderid'] = $orderid = date("YmdHis").rand(1000,2000);	
			
			$url = U($this->type.'/payReturn',array('token'=>$_POST['token'], 'orderid'=>$orderid,'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],'paytype'=>'other'));

			$url = substr($url,1);

			$normal_rt =$this->yuyue_order->add($_POST);
			if($normal_rt){

				//是否在线支付
				$pay_code=$this->_post('payment');
			
				if($pay_code == 2)
				{
					$json = array(

						'error'=> 1,

						'msg'=> '提交成功,进入支付页面...',

						'url'=> U('CardPay/pay', array('token' => $_POST['token'], 'wecha_id' => $_POST['wecha_id'], 'success' => 1, 'from'=> 'Jiudian','id'=>$_POST['pid'],'orderName' => "酒店预定", 'single_orderid' => $orderid, 'price' => $_POST['price']))

					);
					echo  json_encode($json);die();

				}elseif ($pay_code == 1){

					$json = array(

						'error'=> 1,

						'msg'=> '预定成功！',

						'url'=> $url

					);
					echo  json_encode($json);die();
				}else {
					$json = array(

						'error'=> 1,

						'msg'=> '提交成功,进入支付页面...',

						'url'=> U('Pay/'.$pay_code,array('token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'from'=>'Jiudian','id'=>$_POST['pid'],'orderid'=>$orderid))

					);
					echo  json_encode($json);die();
				}

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '提交失败！',

					'url'=> U($this->type.'/index',array('token'=>$this->$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],$id=>$_POST['pid']))

				);

				echo  json_encode($json);

			}
			
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
	
	//订单列表

	public function order(){

		$id = $this->_get('id');

		$token = $this->_get('token');

		$wecha_id = $this->_get('wecha_id');

		$where = array(

			'wecha_id'=> $wecha_id,

			'token'=> $token,
			
			'module'=> 'Jiudian',
			
			'pid'=>$id

		);

		$data = $this->yuyue_order->where($where)->order('id desc')->select();

		$info= $this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$id))->find();

		$this->assign('data',$data);

		$this->assign('info',$info);

		$this->display();

	}

	

	//修改订单视图

	public function set(){

		$id = $this->_get('id');

		$pid = $this->_get('pid');

		

		$cast = array(

			'token'=> $this->_get('token'),

			'wecha_id'=> $this->_get('wecha_id')

		);

		$data = M('yuyue_order')->where(array('id'=>$id))->find();
		
		if($data['type']==1||$data['type']==3)
		{
			$this->error('订单无法修改，请联系客服');
		}

		$info = M('yuyue_setcin')->where(array('name'=>$data['kind']))->find();

		$info['sheng']=$info['yuanjia']-$info['youhui'];

		

		//print_r($data);print_r($info);die;

		$copyright=$this->Yuyue_model->where(array('token'=> $this->_get('token'),'id'=>$pid))->find();

		$data['copyright']=$copyright['copyright'];

		//print_r($copyright);die;

		$data['token'] = $this->_get('token');

		$data['wecha_id'] = $this->_get('wecha_id');

		$wap= M('setinfo')->where(array('pid'=>$pid))->select();

		$str=array();

		foreach($wap as $v){

			if($v['kind']==5){

				$str["message"]=$v["name"];

			}

			else{

				$str[$v["name"]]=$v["value"];

			}

		}

		//print_r($str);die;

		$arr= M('setinfo')->where(array('kind'=>'3','pid'=>$pid))->select();

		$list= M('setinfo')->where(array('kind'=>'4','pid'=>$pid))->select();

		$list_arr =array();

		$i=0;

		foreach($list as $v){

			$list[$i]['value']= explode("|",$v['value']);

			$i++;

		}

		//print_r($list);die;



		$text=$data['fieldsigle'];

		$down=$data['fielddownload'];

		$text=substr($text,1);

		$down=substr($down,1);

		$text=explode('$',$text);

		$down=explode('$',$down);

		$detail=array();

		$i=1;

		foreach($text as $v){

			$detail['text'][$i]=explode('#',$v);

			$i++;

		}

		$i=1;

		foreach($down as $v){

			$detail['down'][$i]=explode('#',$v);	

		}

		//print_r($detail);die;



		$this->assign('detail', $detail);

		

		$this->assign('str', $str);

		$this->assign('arr',$arr);

		$this->assign('list',$list);

		$this->assign('list_arr',$list);

		$this->assign('data', $data);

		$this->assign('info', $info);

		$this->display();

	}

	

	//修改订单

	public function runSet(){

	

		$id = $_GET['id']; 

		if(IS_POST){

			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));

			$url = substr($url,1);

			$where = array(

				'id' =>$id

			);
			$_POST['type']=0;//恢复状态
			if($this->yuyue_order->where($where)->save($_POST)){

				$json = array(

					'error'=> 1,

					'msg'=> '修改成功！',

					'url'=> $url

				);

				echo  json_encode($json);

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '修改失败！',

					'url'=> $url

				);

				echo  json_encode($json);

			}

		}

		

	}

	

	//删除订单

	public function del(){

		if(IS_POST){

			$url = U($this->type.'/order',array('token'=>$_POST['token'], 'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['pid'],));

			$url = substr($url,1);

			$where = array(

				'id' =>$_POST['id']

			);

			if($this->yuyue_order->where($where)->delete()){

				$json = array(

					'error'=> 1,

					'msg'=> '删除成功！',

					'url'=> $url

				);

				echo  json_encode($json);

			}else{

				$json = array(

					'error'=> 0,

					'msg'=> '删除失败！',

					'url'=> $url

				);

				echo  json_encode($json);

			}

		}

	}
	//订单内容
	public function product_print_content($wecha_id,$laoyang){
		$where['token']=$this->token;
		$where['wecha_id']=$wecha_id;
		$where['printed']=0;
		$where['module']='Jiudian';
		$br="<br>";
		if($laoyang==1)
		{
			$br="<0D0A>";
		}		
		$orders=$this->yuyue_order->where($where)->order('date DESC')->limit(0,1)->select();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];

			$info=$orders[0]['fieldsigle'].$orders[0]['fielddownload'];

			$info=substr($info,1);

			$info=explode('$',$info);

			$detail=array();
			$user=M('wxuser')->where(array('token'=>$this->token))->find();
			
			if($laoyang==1)
			{
				$str="<1B40><1B40><1B40>欢迎使用".$user['wxname']."酒店预约系统<0D0A>";
			}else{
				$str="欢迎使用".$user['wxname']."酒店预约系统".$br;
			}	
			$str.= "联系人:".$thisOrder['name'].$br;
			$str.= "联系电话:".$thisOrder['phone'].$br;
			$str.= "到店时间:".$thisOrder['or_date']." ".$thisOrder['time'].$br;
			$str.= "离店时间:".$thisOrder['or_date1']." ".$thisOrder['time1'].$br;
			$str.= "房间类型:".$thisOrder['kind'].$br;
			$str.= "预定数量:".$thisOrder['nums'].$br;
			$str.= "客人留言:".$thisOrder['memo'].$br;
			foreach($info as $v){

				$str.= str_replace("#",":",$v).$br;

			}
			if($laoyang==1)
			{
				$str .="<0D0A>--------------------------------<0D0A>谢谢惠顾，欢迎下次光临<0D0A><0D0A><0D0A><0D0A><0D0A><0D0A>";
			}else{
				$str .="<br>--------------------------------<br>谢谢惠顾，欢迎下次光临<br><br>";
			}			

			return $str;
		}else {
			return '';
		}
	}		
	public function product_sms_email_content($wecha_id){
		$where['token']=$this->token;
		$where['wecha_id']=$wecha_id;
		$where['module']='Jiudian';
		$orders=$this->yuyue_order->where($where)->order('date DESC')->limit(0,1)->select();
		$now=time();
		if ($orders){
			$thisOrder=$orders[0];

			$info=$orders[0]['fieldsigle'].$orders[0]['fielddownload'];

			$info=substr($info,1);

			$info=explode('$',$info);

			$detail=array();
			
			$str="订单通知："."\r\n";
			$str.= "联系人:".$thisOrder['name']."\r\n";
			$str.= "联系电话:".$thisOrder['phone']."\r\n";
			$str.= "到店时间:".$thisOrder['or_date']." ".$thisOrder['time']."\r\n";
			$str.= "离店时间:".$thisOrder['or_date1']." ".$thisOrder['time1']."\r\n";
			$str.= "房间类型:".$thisOrder['kind']."\r\n";
			$str.= "预定数量:".$thisOrder['nums']."\r\n";
			$str.= "客人留言:".$thisOrder['memo']."\r\n";
			foreach($info as $v){

				$str.= str_replace("#",":",$v)."\r\n";

			}		

			return $str;
		}else {
			return '';
		}
	}
	//充值页面
	public function topay(){
		//查订单记录
		$record = M('yuyue_order');
		$orderid = $this->_get('orderid');
		$token = $this->_get('token');
		$wecha_id = $this->_get('wecha_id');
		if($orderid != ''){
			$res = $record->where("token = '$token' AND wecha_id = '$wecha_id' AND orderid = $orderid AND paid = 0")->find();
			$this->assign('res',$res);
		}
		//支付方式
		$payment =M('payment')->where(array('token'=>$token,'enabled'=>1))->select();
		$this->assign('payment',$payment);
		$info['id'] = $this->_get('id','intval');
		$info['token'] = $this->_get('token');
		$info['wecha_id'] = $this->_get('wecha_id');
		//查当前订单
		$order = M('yuyue_order')->where(array('token'=>$info['token'],'wecha_id'=>$info['wecha_id'],'id'=>$info['id']))->find();
		$company_model=M('Company');
		$token = $this->token;
		$thisCompany=$company_model->where("token = '$token'")->find();
		$this->assign('thisCompany',$thisCompany);
		$this->assign('info',$info);
		$this->assign('order',$order);
		$this->display();
	}
	//充值处理
	public function payAction(){
		$record = M('yuyue_order');
		if (IS_POST){
			if($_POST['orderid'])
			{
				if($_POST['price'] <= 0){
					$this->error('请填写正确的充值金额');
				}
				$_POST['createtime'] = time();
				$_POST['ordername'] = $_POST['kind'].$_POST['nums']."间";
				if($record->create($_POST)){
					if($record->add($_POST)){
					$this->success('提交成功，正在跳转支付页面..',U('Pay/'.$_POST['payment'],array('from'=>'Jiudian','orderName'=>$_POST['ordername'],'token'=>$_POST['token'],'wecha_id'=>$_POST['wecha_id'],'id'=>$_POST['id'],'orderid'=>$_POST['orderid'],'price'=>$_POST['price'])));
				}
				}else{
					$this->error('系统错误');
				}		
			}
			else{
				$this->error('订单不存在');
			}
		}
	}
			
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
		
	   $orderid = $_GET['orderid'];
	   $id = $_GET['id'];
	   $paytype = $_GET['paytype'];
	   if ($order = M('yuyue_order')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			if (!$this->wecha_id){
				$this->wecha_id=$order['wecha_id'];
			}
			if ($order['paid']||$paytype=="other") {
				$userInfo = D('Userinfo')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
				/************************************************/
				$setting = M('yuyue')->where(array('token' => $order['token'],'id'=>$id))->find();
				//短信通知			
				if($setting['phone_status'])
				{
					$content=$this->product_sms_email_content($this->wecha_id);
					Sms::sendSms($order['token'],$content,$setting['phone']);
				}
				//print_r($content);die();

				//邮件通知
				if($setting['email_status'])
				{
					$content=$this->product_print_content($this->wecha_id,0,0,1);
					Sms::send_email($order['token'],"恭喜您的微酒店有新的订单，请及时查收！",$content,$setting['email']);
				}				
				//打印小票
				if($setting['print_status'])
				{
					if($setting['printtype']=='feiyin')
					{
						$content=$this->product_print_content($this->wecha_id,0);
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
							$content=$this->product_print_content($this->wecha_id,1);

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
							$content=$this->product_print_content($this->wecha_id,1);

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
							$content=$this->product_print_content($this->wecha_id,1);

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
			}
			$this->success('支付成功',U('Jiudian/order',array('token' => $order['token'],'wecha_id' => $this->wecha_id,'id' => $id)));
	   }else{
	      exit('订单不存在');
	    }
	}	
	

}





?>