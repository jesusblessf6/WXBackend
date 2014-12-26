<?php
class ActivityReply
{	
	public $item;
	public $wechat_id;
	public $siteUrl;
	public $token;
	public function __construct($token,$wechat_id,$data,$siteUrl)
	{
		$this->item=M('Activity')->where(array('id'=>$data['pid']))->find();
		$this->wechat_id=$wechat_id;
		$this->siteUrl=$siteUrl;
		$this->token=$token;

	}
	public function index(){
		$thisItem=$this->item;
		if ($this->item['status'] == 0||$this->item['statdate'] > time()) {
			return array (	
				'活动可能还没开始哦',
				'text' 
			)
			;
		}
		if ($this->item['enddate'] < time()) {
			return array (	
				'活动结束了哦',
				'text' 
			)
			;
		}		
		$id = M('Lottery')->where(array('zjpic'=>$thisItem['id']))->getField('id');
		return array(array(array($thisItem['title'],$thisItem['sttxt'],$thisItem['starpicurl'],$this->siteUrl.U('Wap/Autumns/index',array('id'=>$id,'token'=>$this->token,'wecha_id'=>$this->wechat_id)))),'news');
	}
}
?>

