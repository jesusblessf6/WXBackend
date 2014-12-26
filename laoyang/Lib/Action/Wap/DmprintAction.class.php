<?php
class DmprintAction extends WapAction {

    private $usr;
    private $ord;
    private $sgn;
    private $id;
    private $sta;
    private $shp;
    private $stat;

    private $key;
    private $name;

    private $arr;
    private $res;
    private $cont;

    #初始化
    public function __construct(){
        header("Content-Type:text/html; charset=gb2312");
        $this->acceptparams();
        $this->getkey();
        $this->checksign();
    }

    public function _after_index(){
        echo $this->cont;
    }
    #执行流程
    public function index(){
        if($this->stat=='send'){
            $this->getdata();
            if($this->res){
                $this->outputxml();
            }else{
                $this->nodata();
            }
        }else{
            $this->updata();
        }
    }

    #接受参数
    private function acceptparams(){
        $usr = $this->_get('usr');
        $ord = $this->_get('ord');
        $sgn = $this->_get('sgn');
        $shp = $this->_get('shp');
        $id = $this->_get('id');
        $sta = $this->_get('sta');

        if(!isset($usr)||!isset($ord)||!isset($sgn)||!isset($shp)){
            die();
        }else{
            $this->usr = $usr;
            $this->ord  = $ord;
            $this->sgn  = $sgn;
            $this->shp  = $shp;
        }
        if(isset($id)&&isset($sta)){
            $this->id = $id;
            $this->sta = $sta;
            $this->stat = 'accept';
        }else{
            $this->stat = 'send';
        }
    }

    #取得打印密钥，店名
    private function getkey(){
        //缓存规则：cashe_sid_pkey,_pname
        $key = 'cache_'.$this->shp.'_pkey';
        $name = 'cache_'.$this->shp.'_pname';
        if(S($key)&&S($name)){
            $this->key = S($key);
            $this->name = S($name);
        }
        else{
            $res = M('Dining_company')->where(array('id'=>$this->shp))->find();
			$res1 = M('Company')->where(array('id'=>$res['catid']))->find();
            $sname = $res1['name'];
			
            $s_pkey = $res['dmdeviceNo'];
            S($key,$s_pkey,7200);
            S($name,$sname,7200); 
            $this->name = $sname;
            $this->key = $s_pkey;
        }
		
    }
    
    #密钥检查
    private function checksign()
    {
        if($this->stat=='send'){
            $str =  $this->usr.$this->ord.$this->key;
        }else{
            $str =  $this->usr.$this->id.$this->ord.$this->sta.$this->key;
        }
        $str = strtoupper(md5($str));
        $str==$this->sgn ? $statu=true : $statu=false;
        
        !$statu && die();
    }

    #获取数据
    private function getdata(){
        $olist = D('product_cart');
        $where['diningshopid'] = intval($this->shp);
        $where['printed'] = 0;
        $res = $olist->where($where)->order('time DESC')->find();
        $this->res = $res;
    }

    #输出函数
    private function outputxml(){

        $temp = $this->strtemplate();
        $res = $this->res;

        $oid = $res['orderid'];
        //打印明细
        $dt = $this->makestrlen('品名',1,14)
            . $this->makestrlen('数量',2,5)
            . $this->makestrlen('单价',2,5)
            . $this->makestrlen('金额',2,5);
        $dl = $this->makedl();
        $odetail = $this->makedetail();
		
        $this->arr = array(
            'sname'=>$this->name,
            'onumber'=>$res['orderid'],
            'otime'=>date('Y-m-d H:i:s',$res['otime']),
            'dl'=>$dl,
            'dt'=>$dt,
            'odetail'=>$odetail,
            'ototal'=>$res['price'],
            'oname'=>$res['truename'],
            'omobi'=>$res['tel'],
            'oaddr'=>$res['address'],
            'orema'=>$res['beizhu']
        );
		//print_r($this->arr);die();
        
        $str = $this->strtemplate();
        $temp = $this->xmltemplate();
        $time = date('Y-m-d H:m:s');
        $cont = $this->u2g(sprintf($temp,$oid,$time,$str));
		//print_r($cont);die();
        //$this->cont = $cont;
        echo $cont;

    }

    #生成明细列表
    private function makedetail(){
		$this->product_model=M('dining');
        $o = unserialize($this->res['info']);

		$ids=array();
		$products=array();
		foreach ($o as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				if (!in_array($productid,$ids)){
					array_push($ids,$productid);
				}
			}
		}
		if (count($ids)){
			$products=$this->product_model->where(array('id'=>array('in',$ids)))->select();
		}
		$str = '';
		if ($products){
			$i=0;
			foreach ($products as $p){
				$products[$i]['count']=$o[$p['id']]['count'];
				$total = $products[$i]['count'] * $p['price'];
				$str .= $this->makestrlen($p['name'],1,14);
				$str .= $this->makestrlen($products[$i]['count'],2,5);
				$str .= $this->makestrlen($p['price'],2,5);
				$str .= $this->makestrlen($total,2,5);
				$str .= '%%';
				$i++;
			}
		}
        return $str;
    }

    #字符串占位函数 for makedetail()
    private function makestrlen($t,$s,$n){
        $len = (strlen($t) + mb_strlen($t,'utf8'))/2;
        $num = intval($n);
        if($len<$num){
            $fx = $num-$len;
        }
        switch(intval($s)){
            case 1:
            $t .= $this->makespace($fx);
            break;
            case 2:
            $t = $this->makespace($fx).$t;
            break;
        }
        return $t;
    }

    #生成空格 for makedetail()
    private function makespace($n){
        $s = '';
        for ($i=0; $i < $n ; $i++) { 
            $s .= ' ';
        }
        return $s;
    }

    private function makedl(){
        $s = '';
        for ($i=0; $i < 29 ; $i++) { 
            $s .= '.';
        }
        return $s;
    }

    #UTF8 to GB2312
    private function u2g($s){
       $s = iconv('UTF-8', 'gb2312//IGNORE', $s);
       return $s;
    }

    #输出模版
    private function xmltemplate(){
        $xml = "<?xml version=\"1.0\" encoding=\"GB2312\" ?>\r\n";
        $xml .= "<r>\r\n";
        $xml .= "<id>%s</id>\r\n";
        $xml .= "<time>%s</time>\r\n";
        $xml .= "<content>%s</content>\r\n";
        $xml .= "<setting></setting>\r\n";
        $xml .= "</r>"; 
        return $xml;
    }

    #数据模版
    private function strtemplate(){
        $arr = $this->arr;
        $str = '%%%30'.$arr['sname'].'%%%00%%';
        $str.= '单号:'.$arr['onumber'].'%%';
        $str.= '日期:'.$arr['otime'].'%%';
        $str.= ''.$arr['dl'].'%%';
        $str.= ''.$arr['dt'].'%%'; //$明细标题
        $str.= ''.$arr['odetail'].'';
        $str.= ''.$arr['dl'].'%%';
        $str.= '合计:'.$arr['ototal'].'元%%';
        $str.= '备注:'.$arr['orema'].'%%';
        $str.= '姓名:'.$arr['oname'].'%%';
        $str.= '电话:'.$arr['omobi'].'%%';
        $str.= '地址:'.$arr['oaddr'].'%%';
        return $str;
    }

    #更新打印状态;
    private function updata(){
        $olist = M('product_cart');
        $where['orderid'] = $this->id;
        $data['printed'] = 1;
        $olist->where($where)->save($data);
        $this->cont = '1';
    }
}