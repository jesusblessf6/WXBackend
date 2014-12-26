<?php
class JingcaiAction extends BaseAction
{
    public $pagesize;    //每页获取数量
    public $wecha_id;     //实际意义是openid，如果直接菜单访问该链接需要进行 认证 授权的方式
    public $token;        //每个公众账号配置生成的值 （这个是指页面传递的 appid ）
    public $pageindex;    //获取的页索引
    public function _initialize() {
    	
    	parent::_initialize();
    	
    	$this->token    = $this->_get('token');
        $this->wecha_id = $this->_get('wecha_id');
        
        $this->assign('token', $this->token);
        $this->assign('wecha_id', $this->wecha_id);
        
        
        defined('RES') or define('RES', THEME_PATH);
       // $this->wecha_id = $this->_get('wecha_id');
        //$this->assign('wecha_id', $this->wecha_id);
        
        
    }
   
  public function index() {
    	
      //获取老杨设定
      $set_info = M('jingcai_set')->where(array('token'=>$this->token))->find();
      
      if(!$set_info || !$set_info['status']){
      	die('商家还未开启微竞猜服务');
      }
     $this->assign('bannerpic',$set_info['bannerpic']);
      
      
       
        $type_list = M('jingcai_type')->where(array('token'=>$this->token,'pid'=>$set_info['id']))->order('sort desc,id desc')->select();
       
        $changci_db = new Model();
        $curtime = time();
        foreach ($type_list as &$value ) {
           
           $where =  " a.token='".$this->token."' and a.type_id=".$value['id']." and a.stime >".$curtime."  and  a.zhudui=b.id and a.kedui=c.id ";
          
           $changcilst = $changci_db->table(C('DB_PREFIX')."jingcai_changci a left outer join ".C('DB_PREFIX')."jingcai_changci_record r on(a.id=r.changci_id and r.token='".$this->token."' and r.wecha_id='".$this->wecha_id."'),".C('DB_PREFIX')."jingcai_team b,".C('DB_PREFIX')."jingcai_team c")->field("a.*,b.name zhuduiname,c.name keduiname,IFNULL(r.wecha_id,null) result")->where($where)->order('a.stime asc')->select();
           
           $value['changcilst'] = $changcilst;
           $value['changcilen'] = count($changcilst);
        }
        
        $this->assign('typelst',$type_list);
    	
    	
    	//var_dump($type_list);
    	
    	$this->display();
   }
    
    
    public function dtl() {
    	
      //获取laoyang设定
      $set_info = M('jingcai_set')->where(array('token'=>$this->token))->find();
      
      if(!$set_info || !$set_info['status']){
      	die('商家还未开启微竞猜服务');
      }
      
      $id = $this->_get('id');
      $changci_db = new Model();
      $where =  " a.token='".$this->token."' and a.id=".$id." and  a.zhudui=b.id and a.kedui=c.id ";
     
      $info = $changci_db->table(C('DB_PREFIX')."jingcai_changci a left outer join ".C('DB_PREFIX')."jingcai_changci_record r on(a.id=r.changci_id and r.token='".$this->token."' and r.wecha_id='".$this->wecha_id."'),".C('DB_PREFIX')."jingcai_team b,".C('DB_PREFIX')."jingcai_team c")->field('a.*,b.name zhuduiname,b.team_logo zhuduilogo,c.name keduiname,c.team_logo keduilogo,r.ycjg')->where($where)->find();
              
      if(!$info){
        	die('非法数据');
      }
      
      $week_num = date('w',$info['stime']);
      if($week_num === 0){
      	$info['week']='周日';
      }else if($week_num === 1){
      	$info['week']='周一';
      }else if($week_num === 2){
      	$info['week']='周二';
      }else if($week_num === 3){
      	$info['week']='周三';
      }else if($week_num === 4){
      	$info['week']='周四';
      }else if($week_num === 5){
      	$info['week']='周五';
      }else if($week_num === 6){
      	$info['week']='周六';
      }
      
      /**
       * 计算主队最近战绩
       * 0,
       */
       
        $info_hz = M('jingcai_changci')->field('count(id) total,sum(case when zhuduinum>keduinum then 1 else 0 end) sl,sum(case when zhuduinum=keduinum then 1 else 0 end) pj,sum(case when zhuduinum<keduinum then 1 else 0 end) sb')->where(array('token'=>$this->token,'zhudui'=>$info['zhudui'],'status'=>1))->find();
        //var_dump($info_hz);
        $info['zhuduitotal'] = $info_hz['total'];
        $info['zhuduislnum'] = $info_hz['sl'];
        $info['zhuduipjnum'] = $info_hz['pj'];
        $info['zhuduisbnum'] = $info_hz['sb'];
        
        $info['zhuduiper'] = (number_format(($info_hz['sl'] / $info_hz['total']),4))*100;
        $info['keduiper'] = (number_format(($info_hz['sb'] / $info_hz['total']),4))*100;
        $info['pingper'] = (number_format(($info_hz['pj'] / $info_hz['total']),4))*100;
        
        $this->assign('end','1');
        $this->assign('info',$info);
    	$this->display();
   }
   
    public function buy() {
    	
      //获取laoyang设定
      $set_info = M('jingcai_set')->where(array('token'=>$this->token))->find();
      
      if(!$set_info || !$set_info['status']){
      	die(array("success"=>0,'info'=>'商家还未开启微竞猜服务'));
      }
       
      $id = $this->_get('id');
       
      $info = M('jingcai_changci')->where(array('token'=>$this->token,'id'=>$id))->find();
       
      if(!$info){
      	//非法数据的情况
      	die(json_encode(array("success"=>0,'info'=>'非法数据')));
      	
      }
      
      $curtime = time();
      
      if($curtime >= $info['stime']){
      	die(json_encode(array("success"=>0,'info'=>'该比赛已开始，无法继续竞猜')));
      }
      
      
      $record_db = M('jingcai_changci_record');
      
      $record_where = array('token'=>$this->token,'changci_id'=>$id,'wecha_id'=>$this->wecha_id);
      $record_info = $record_db->where($record_where)->find();
      //开始记录竞猜信息
       $code = $this->_post('code');
       
       
       if($code == '3'){
     		$score = $info['speilv']*$info['minlimit'];
     	}elseif($code == '1'){
     		$score = $info['ppeilv']*$info['minlimit'];
     	}elseif($code == '2'){
     		$score = $info['fpeilv']*$info['minlimit'];
     	}else{
     		die(json_encode(array("success"=>0,'info'=>'非法数据，请重新进入')));
     	}
     	
     	
     	
     if($record_info){
     	
     	
     	$record_db->where($record_where)->save(array('ycjg'=>$code,'sjm'=>$score));
     	
     	die(json_encode(array("success"=>0,'info'=>'竞猜结果重置完毕')));
     }else{
     	
     	//根据预测结果计算预测积分                     
     	
        $data = array(
	         'token'=>$this->token,
	         'wecha_id'=>$this->wecha_id,
	         'type_id'=>$info['type_id'],
	         'changci_id'=>$info['id'],
	         'ycjg'=>$code,
	         'ctime'=>time(),
	         'sjm'=>$score
       );
      $record_db->add($data);
      
      die(json_encode(array("success"=>1,'info'=>'成功参与竞猜')));
     }
    
   }
}
?>