<?php
class PrintAction extends UserAction{
	public function index(){
		$product_cart = M('product_cart');
		$product	  = M('dining');
		$id = $this->_get('id');
		$token = $this->_get('token');
		$product_id = explode(",", $id);
		foreach($product_id as $pid){
			$data = $product_cart->where(array('id'=>$pid))->find();
			$info = unserialize($data['info']);
			foreach ($info as $k=>$v){
				$name = $product->where("id={$v['catid']}")->find();
				$dishes['name'] = $name['name'];
				$dishes['count'] = $v['count'];
				$dishes['price'] = $v['price'];
				$cart[] = $dishes;
			}
			$data['info'] = $cart;
			$cart = array();
			$sum[] = $data;
		}
		$token_name = M('wxuser')->where(array('token'=>$token))->find();
		$this->assign('data',$sum);
		$this->assign('token_name',$token_name['wxname']);
		$this->display();
	}
}