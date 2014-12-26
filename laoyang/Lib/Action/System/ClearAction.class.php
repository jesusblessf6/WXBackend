<?php
class ClearAction extends BackAction{
	protected function deldir($dir){
		$result = true;
		$dh = opendir($dir);
		while($file=readdir($dh)){
			if($file!="." && $file!=".."){
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)){
					$result = unlink($fullpath);					
				}else{
					$this->deldir($fullpath);
				}
			}
			rmdir($fullpath);
		}
		closedir($dh);
		return $result;
	}
	public function clear(){
		$this->display();
	}
	
	public function del(){
		
		$dir = './data/Conf/logs';
		$r = $this->deldir($dir);
		if($r){
			$this->success('清除成功',U('index'));
		}else{
			$this->error('清除失败，请检查目录权限',U('index'));
		}
	}
	}


?>