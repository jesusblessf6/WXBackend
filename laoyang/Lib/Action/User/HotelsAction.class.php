<?php
class HotelsAction extends UserAction{
    public $_cid = 0;
    public function _initialize(){
        parent :: _initialize();
        $this -> canUseFunction('hotel');
        $this -> _cid = isset($_GET['cid']) ? intval($_GET['cid']) : session('companyid');
        if (empty($this -> token)){
            $this -> error('不合法的操作', U('Index/index'));
        }
        if (empty($this -> _cid)){
            $company = M('Company') -> where(array('token' => $this -> token, 'isbranch' => 0)) -> find();
            if ($company){
                $this -> _cid = $company['id'];
                session('companyk', md5($this -> _cid . session('uname')));
            }else{
                $this -> error('您还没有添加您的商家信息', U('Company/index', array('token' => $this -> token)));
            }
        }else{
            $k = session('companyk');
            $company = M('Company') -> where(array('token' => $this -> token, 'id' => $this -> _cid)) -> find();
            if (empty($company)){
                $this -> error('非法操作', U('Hotels/index', array('token' => $this -> token)));
            }else{
                $username = $company['isbranch'] ? $company['username'] : session('uname');
                if (md5($this -> _cid . $username) != $k){
                    $this -> error('非法操作', U('Hotels/index', array('token' => $this -> token)));
                }
            }
        }
        $this -> assign('ischild', session('companyLogin'));
        $this -> assign('cid', $this -> _cid);
    }
    public function index(){
        $data = M('Hotels_house_sort');
        $where = array('cid' => $this -> _cid);
        $count = $data -> where($where) -> count();
        $Page = new Page($count, 20);
        $show = $Page -> show();
        $list = $data -> where($where) -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $this -> assign('page', $show);
        $this -> assign('list', $list);
        $this -> display();
    }
    public function add(){
        $dataBase = D('Hotels_house_sort');
        if (IS_POST){
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if ($id){
                if ($dataBase -> create() !== false){
                    $action = $dataBase -> save();
                    if ($action != false){
                        $this -> success('修改成功', U('Hotels/index', array('token' => $this -> token, 'cid' => $this -> _cid)));
                    }else{
                        $this -> error('操作失败');
                    }
                }else{
                    $this -> error($dataBase -> getError());
                }
            }else{
                if ($dataBase -> create() !== false){
                    $action = $dataBase -> add();
                    if ($action != false){
                        $this -> success('添加成功', U('Hotels/index', array('token' => $this -> token, 'cid' => $this -> _cid)));
                    }else{
                        $this -> error('操作失败');
                    }
                }else{
                    $this -> error($dataBase -> getError());
                }
            }
        }else{
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $findData = $dataBase -> where(array('id' => $id, 'cid' => $this -> _cid)) -> find();
            $this -> assign('tableData', $findData);
            $this -> display();
        }
    }
    public function del(){
        $diningTable = M('Hotels_house_sort');
        if (IS_GET){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $where = array('id' => $id, 'cid' => $this -> _cid);
            $check = $diningTable -> where($where) -> find();
            if($check == false) $this -> error('非法操作');
            $back = $diningTable -> where($where) -> delete();
            if ($back == true){
                $this -> success('操作成功', U('Hotels/index', array('token' => $this -> token, 'cid' => $this -> _cid)));
            }else{
                $this -> error('服务器繁忙,请稍后再试', U('Hotels/index', array('token' => $this -> token, 'cid' => $this -> _cid)));
            }
        }
    }
    public function house(){
        $data = M('Hotels_house');
        $where = array('cid' => $this -> _cid);
        $count = $data -> where($where) -> count();
        $Page = new Page($count, 20);
        $show = $Page -> show();
        $list = $data -> where($where) -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $list_sort = M('Hotels_house_sort') -> where(array('cid' => $this -> _cid)) -> select();
        $t = array();
        foreach ($list_sort as $l){
            $t[$l['id']] = $l['name'];
        }
        $h = array();
        foreach ($list as $r){
            $r['sname'] = $t[$r['sid']];
            $h[] = $r;
        }
        $this -> assign('page', $show);
        $this -> assign('list', $h);
        $this -> display();
    }
    public function batchadd(){
        $dataBase = D('Hotels_house');
        if (IS_POST){
            $houseid = isset($_POST['houseid']) ? $_POST['houseid'] : '';
            $start = isset($_POST['start']) ? intval($_POST['start']) : '';
            $end = isset($_POST['end']) ? intval($_POST['end']) : '';
            if ($end < $start){
                $this -> error('操作失败');
            }
            $n = strlen($end);
            unset($_POST['houseid'], $_POST['start'], $_POST['end'], $_POST['end']);
            $data = array('sid' => $_POST['sid'], 'cid' => $_POST['cid'], 'token' => $this -> token, 'image' => $_POST['image'], 'note' => $_POST['note']);
            for ($i = $start; $i < $end; $i++){
                $data['name'] = $houseid . sprintf("%0{$n}d", $i);
                $dataBase -> add($data);
                D('Hotels_house_sort') -> where(array('id' => $_POST['sid'])) -> setInc('houses', 1);
            }
            $this -> success('添加成功', U('Hotels/house', array('token' => $this -> token, 'cid' => $this -> _cid)));
        }else{
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $findData = $dataBase -> where(array('id' => $id, 'cid' => $this -> _cid)) -> find();
            $this -> assign('tableData', $findData);
            $list = M('Hotels_house_sort') -> where(array('cid' => $this -> _cid)) -> select();
            $this -> assign('list', $list);
            $this -> display();
        }
    }
    public function houseadd(){
        $dataBase = D('Hotels_house');
        if (IS_POST){
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            if ($id && ($house = $dataBase -> where(array('id' => $id, 'token' => $this -> token, 'cid' => $this -> _cid)) -> find())){
                $sid = $house['sid'];
                if ($dataBase -> create() !== false){
                    $action = $dataBase -> save();
                    if ($sid != $_POST['sid']){
                        D('Hotels_house_sort') -> where(array('id' => $_POST['sid'])) -> setInc('houses', 1);
                        D('Hotels_house_sort') -> where(array('id' => $sid, 'houses' => array('gt', 1))) -> setDec('houses', 1);
                    }
                    if ($action != false){
                        $this -> success('修改成功', U('Hotels/house', array('token' => $this -> token, 'cid' => $this -> _cid)));
                    }else{
                        $this -> error('操作失败');
                    }
                }else{
                    $this -> error($dataBase -> getError());
                }
            }else{
                if ($dataBase -> create() !== false){
                    $action = $dataBase -> add();
                    if ($action != false){
                        D('Hotels_house_sort') -> where(array('id' => $_POST['sid'])) -> setInc('houses', 1);
                        $this -> success('添加成功', U('Hotels/house', array('token' => $this -> token, 'cid' => $this -> _cid)));
                    }else{
                        $this -> error('操作失败');
                    }
                }else{
                    $this -> error($dataBase -> getError());
                }
            }
        }else{
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $findData = $dataBase -> where(array('id' => $id, 'cid' => $this -> _cid)) -> find();
            $this -> assign('tableData', $findData);
            $list = M('Hotels_house_sort') -> where(array('cid' => $this -> _cid)) -> select();
            $this -> assign('list', $list);
            $this -> display();
        }
    }
    public function housedel(){
        $house = M('Hotels_house');
        if(IS_GET){
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
            $where = array('id' => $id, 'cid' => $this -> _cid);
            $check = $house -> where($where) -> find();
            if($check == false) $this -> error('非法操作');
            $back = $house -> where($where) -> delete();
            if($back == true){
                D('Hotels_house_sort') -> where(array('id' => $check['sid'], 'houses' => array('gt', 1))) -> setDec('houses', 1);
                $this -> success('操作成功', U('Hotels/house', array('token' => $this -> token, 'cid' => $this -> _cid)));
            }else{
                $this -> error('服务器繁忙,请稍后再试', U('Hotels/house', array('token' => $this -> token, 'cid' => $this -> _cid)));
            }
        }
    }
    public function orders(){
        $status = isset($_GET['status']) ? intval($_GET['status']) : 0;
        $hotelOrder = M('Hotels_order');
        $where = array('token' => $this -> _session('token'), 'cid' => $this -> _cid);
        if ($status){
            $where['startdate'] = array('ELT', $status);
            $where['enddate'] = array('GT', $status);
        }
        $count = $hotelOrder -> where($where) -> count();
        $Page = new Page($count, 20);
        $show = $Page -> show();
        $orders = $hotelOrder -> where($where) -> order('id DESC') -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $sort = M('Hotels_house_sort') -> where(array('cid' => $this -> _cid, 'token' => $this -> token)) -> select();
        $t = array();
        foreach ($sort as $row){
            $t[$row['id']] = $row['name'];
        }
        $list = array();
        foreach ($orders as $o){
            $o['housename'] = isset($t[$o['sid']]) ? $t[$o['sid']] : '';
            $o['startdate'] = date("Y-m-d", strtotime($o['startdate']));
            $o['enddate'] = date("Y-m-d", strtotime($o['enddate']));
            $list[] = $o;
        }
        $dates = array();
        for ($i = -30; $i <= 90; $i ++){
            $dates[] = array('k' => date("Ymd", strtotime("+{$i} days")), 'v' => date("Y-m-d", strtotime("+{$i} days")));
        }
        $this -> assign('dates', $dates);
        $this -> assign('orders', $list);
        $this -> assign('status', $status);
        $this -> assign('page', $show);
        $this -> display();
    }
    public function orderInfo(){
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $hotelOrder = M('Hotels_order');
        if ($thisOrder = $hotelOrder -> where(array('id' => $id, 'token' => $this -> token, 'cid' => $this -> _cid)) -> find()){
            if (IS_POST){
                $status = isset($_POST['status']) ? intval($_POST['status']) : 0;
                $paid = isset($_POST['paid']) ? intval($_POST['paid']) : 0;
                $hotelOrder -> where(array('id' => $thisOrder['id'])) -> save(array('status' => $status, 'paid' => $paid));
                $company = M('Company') -> where(array('token' => $this -> token, 'id' => $this -> _cid)) -> find();
                Sms :: sendSms($this -> token, "{$company['name']}欢迎您，本店对您的订单号为：{$thisOrder['orderid']}的订单状态进行了修改，如有任何疑意，请您及时联系本店！", $thisOrder['tel']);
                $this -> success('修改成功', U('Hotels/orderInfo', array('token' => session('token'), 'id' => $thisOrder['id'])));
            }else{
                $sort = M('Hotels_house_sort') -> where(array('cid' => $this -> _cid, 'token' => $this -> token, 'id' => $thisOrder['sid'])) -> find();
                $thisOrder['housename'] = isset($sort['name']) ? $sort['name'] : '';
                $this -> assign('thisOrder', $thisOrder);
                $this -> display();
            }
        }
    }
    public function deleteOrder(){
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
        $hotelOrder = M('Hotels_order');
        if ($thisOrder = $hotelOrder -> where(array('id' => $id, 'token' => $this -> token, 'cid' => $this -> _cid)) -> find()){
            $hotelOrder -> where(array('id' => $id)) -> delete();
            $this -> success('操作成功', U('Hotels/orders', array('token' => session('token'), 'cid' => $this -> _cid)));
        }
    }
}
?>