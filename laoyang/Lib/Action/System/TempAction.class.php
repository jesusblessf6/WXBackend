<?php
/**
 *用户案例
**/
class TempAction extends BackAction{
	public function index(){
		//$map = array();
		$templist = D('Wifi_tmpl');
		$count = $templist->count();
		$Page       = new Page($count,30);// 实例化分页类 传入总记录数
		// 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
		$nowPage = isset($_GET['p'])?$_GET['p']:1;
		$show       = $Page->show();// 分页显示输出
		$list = $templist->where($map)->order('id ASC')->limit($Page->firstRow.','.$Page->listRows)->select();			
		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
		$this->display();
		
		
	}
	public function add(){
		if(IS_POST){
			$this->all_insert('Wifi_tmpl');
		}else{
			//$group=D('Wifi_tmpl')->getAllGroup('status=0');
			//$this->assign('group',$group);
			$this->display();
		}
	}
	public function edit(){
		if(IS_POST){//print_r($_POST);
			$this->all_save('Wifi_tmpl');
		}else{
			$id=$this->_get('id','intval',0);
			if($id==0)$this->error('非法操作');
			$this->assign('tpltitle','编辑');
			$fun=M('Wifi_tmpl')->where(array('id'=>$id))->find();
			$this->assign('info',$fun);
			$this->display('add');
		}
	}	
	public function del(){
		if(IS_POST){
			$this->all_save();
		}else{
			$id=$this->_get('id','intval',0);
			if($id==0)$this->error('非法操作');
			$this->assign('tpltitle','编辑');
			$fun=M('Wifi_tmpl')->where(array('id'=>$id))->delete();
			if($fun==false){
				$this->error('删除失败');
			}else{
				$this->success('删除成功');
			}
		}
	}
	
}