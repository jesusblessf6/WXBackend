<?php
class ZhidaAction extends UserAction{
	public $token;
	public function _initialize(){
		parent::_initialize();
		$this->token=$this->_session('token');
		$this->assign('token',$this->token);
		$this->canUseFunction('Zhida');
	}

	public function index(){
		$db = M('Zhida');
		if(IS_POST){
			//$_POST['code'] = $this->_post('code');
			$_POST['token'] = $this->token;
			if(stripos($_POST['code'],'eval') === false && stripos($_POST['code'],'alert') === false && stripos($_POST['code'],'php') === false){
				$_POST['code'] = base64_encode($_POST['code']);
				if($db->where(array('token'=>$this->token))->getField('id')){
					if($db->where(array('token'=>$this->token))->save($_POST)){
						$this->success('保存成功');
					}else{
						$this->error('保存失败');
					}
				}else{
					if($db->create() !== false){
						if($db->add()){
							$this->success('保存成功');
						}else{
							$this->error('保存失败');
						}
					}else{

						$this->error('发生了点小问题，请稍后再试');
					}
				}
			}else{
				$this->error('抱歉，代码存在不安全因素，请检查后再试');
			}

		}else{
			$info = $db->where(array('token'=>$this->token))->find();
			$info['code'] = htmlspecialchars_decode(base64_decode($info['code']));
			$this->assign('info',$info);
			$this->display();
		}
	}

	public function site(){
		$preTpl='<?xml version="1.0" encoding="utf-8"?>'."\r\n".'<urlset>'."\r\n";
		$endTpl='</urlset>';
		if($this->_get('c') != NULL ){
			$changefreq=$this->_get('c');
		}else{
			$changefreq='daily';
		}

		$data=M('Img')->where("1")->field('id,text,info,uptatetime,classid,token')->order("id DESC")->limit(10)->select();
		foreach($data as $k=>$v){
			$data[$k]['loc'] = C('site_url').'/index.php?g=Wap&amp;m=Index&amp;a=content&amp;id='.$v['id'].'&amp;classid='.$v['classid'].'&amp;token='.$v['token'];
			$tpl.='<url>'."\r\n".'<loc>'.$data[$k]['loc'].'</loc>'."\r\n".'<lastmod>'.$v['uptatetime'].'</lastmod>'."\r\n".'<changefreq>'.$changefreq.'</changefreq>'."\r\n".'</url>'."\r\n";
		}
		return $preTpl.$tpl.$endTpl;
	
	}
	
	public function sitemap(){
		header("Content-type:text/xml");
		echo $this->site();
	}



}
?>