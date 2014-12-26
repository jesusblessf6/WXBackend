<?php
class PrinterAction extends UserAction{
	public $token;
	public $wecha_id;
	
	public function _initialize() {
		parent::_initialize();
		$this->token= SESSION('token');
		$this->wecha_id	= $this->_get('wecha_id');
		if (!$this->wecha_id){
			$this->wecha_id='';
		}
		$this->assign('token',$this->token);
		$this->assign('wecha_id',$this->wecha_id);
		$this->printer_model = M('printer_set');
		$this->printer_set = M('printer_set')->where(array('token'=>$this->token,'uid'=>session('uid')))->find();
		
	}
	public function index(){
		$set=$this->printer_set;
		$db=$this->printer_model;
		if(IS_POST){
			$_POST['uid']=SESSION('uid');
			$_POST['token']=SESSION('token');
			if($set==false){
				if ($db->create() === false) {
					$this->error($db->getError());
				} else {
					$id = $db->add();
					if ($id == true) {
						$this->success('操作成功', U('Printer/index',array('token'=>$this->token)));
					} else {
						$this->error('操作失败');
					}
				}
			}else{
				$_POST['id']=$set['id'];
				if ($db->create() === false) {
					$this->error($db->getError());
				} else {
					$id = $db->save();
					if ($id == true) {
						$this->success('操作成功', U('Printer/index',array('token'=>$this->token)));
					} else {
						$this->error('操作失败');
					}
				}	
			}
		}else{
			$this->assign('set',$set);
			$this->display();
		}
	}
	//测试打印
	public function test(){
		//设置打印服务器开始
		$printer_set = M('printer_set')->where(array('token'=>$this->token))->find();
		define('MEMBER_CODE', $printer_set['memberCode']);
		define('FEYIN_KEY', $printer_set['feiyin_key']);
		define('DEVICE_NO', $printer_set['deviceNo']);
		define('Page',$printer_set['printpage']);
		define('FEYIN_HOST','my.feyin.net');
		define('FEYIN_PORT', 80);
		$str='
    老杨平台订餐打印测试
	
条目      单价（元）   数量
----------------------------
番茄炒粉     10.0       1
客家咸香鸡   20.0       1

备注：请快点送到。
----------------------------
合计：30.0元 

送货地址：*******
联系电话：1380017****
订购时间：'.date("Y-m-d H:i:s");
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
		if($printstate==0){
			$this->success('打印成功', U('Printer/index',array('token'=>$this->token)));
		}else{
			$this->error('打印失败，错误代码：'.$printstate);
		}
	}
}
?>