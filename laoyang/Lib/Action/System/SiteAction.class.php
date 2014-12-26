<?php
class SiteAction extends BackAction{
	public function _initialize() {
        parent::_initialize(); //RBAC 验证接口初始化
    }
	
	public function index(){
		$groups=M('User_group')->order('id ASC')->select();
		$this->assign('groups',$groups);
		$this->display();
	}
	public function email(){
		
		$this->display();
	}	
	public function alipay(){
		$this->display();
	}
	public function safe(){
		$this->display();
	}
	public function rippleos_key(){
		$this->display();
	}
	public function upfile(){
		$this->display();
	}
	public function sms(){
		$total=M('Sms_expendrecord')->sum('count');
		$this->assign('total',$total);
		$this->display();
	}
	public function muban(){
		$this->display();
	}
	public function Heartbeat(){
		$this->display();
	}
	public function insert(){
		$file=$this->_post('files');
		unset($_POST['files']);
		unset($_POST[C('TOKEN_NAME')]);
		if (isset($_POST['countsz'])){
		$_POST['countsz']=base64_encode($_POST['countsz']);
		}
		
		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功',U('Site/index',array('pid'=>6,'level'=>3)));
		}else{
			$this->error('操作失败',U('Site/index',array('pid'=>6,'level'=>3)));
		}
	}
	public function tenpay(){
		$file=$this->_post('tfiles');
		unset($_POST['tfiles']);
		//unset($_POST[C('TOKEN_NAME')]);

		if($this->update_config($_POST,CONF_PATH.$file)){
			$this->success('操作成功',U('Site/index',array('pid'=>6,'level'=>3)));
		}else{
			$this->error('操作失败',U('Site/index',array('pid'=>6,'level'=>3)));
		}
	}
	private function update_config($config, $config_file = '') {
		!is_file($config_file) && $config_file = CONF_PATH . 'web.php';
		if (is_writable($config_file)) {
			//$config = require $config_file;
			//$config = array_merge($config, $new_config);
			//dump($config);EXIT;
			file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
			@unlink(RUNTIME_FILE);
			return true;
		} else {
			return false;
		}
	}//老杨分享 www.fenxiangweb.com 9月21日
	public function qianmoban() {		$this->display();		}	public function qianmoban_up() {		$data=$this->_post('beer');		$setfile = "./data/conf/Home/config.php";		$settingstr="<?php \n return array(\n   'TMPL_FILE_DEPR'=>'_',  \n 'DEFAULT_THEME' => '".$data."',      );\n?>\n";		file_put_contents($setfile,$settingstr);		$this->success('操作成功',U('Site/qianmoban'));	}	public function huiyuan() {		$this->display();		}		public function huiyuan_up() {		$data=$this->_post('beer');		$setfile = "./data/conf/User/config.php";		$settingstr="<?php \n return array(\n   'TMPL_FILE_DEPR'=>'_',  \n 'DEFAULT_THEME' => '".$data."',      );\n?>\n";		file_put_contents($setfile,$settingstr);		$this->success('操作成功',U('Site/huiyuan'));	 }		}