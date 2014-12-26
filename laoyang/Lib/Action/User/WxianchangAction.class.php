<?php
class wxianchangAction extends UserAction{
    public $wxianchang_db;
    public $token;
    public $info;
    public function _initialize(){
        parent :: _initialize();
        //$this -> canUseFunction('wxianchang');
        $this -> token = session('token');
        $this -> wxianchang_db = D('Wechat_wxianchang');
        $wxianchang_info = M('wechat_wxianchang') -> where(array('token' => $this -> token, 'is_open' => '1', 'id' => $this -> _get('wxianchangid', 'intval'))) -> find();
        if($wxianchang_info){
            $info = $wxianchang_info;
            $this -> assign('wxianchangid', $wxianchang_info['id']);
            if(ACTION_NAME == 'wall' || ACTION_NAME == 'wall_pic'){
                $info = M('Wall') -> where(array('token' => $this -> token, 'id' => $wxianchang_info['wall_id'])) -> find();
            }else if(ACTION_NAME == 'shake'){
                $info = M('Shake') -> where(array('token' => $this -> token, 'id' => $wxianchang_info['shake_id'])) -> find();
                $info['cheer'] = json_encode(explode('|', $info['cheer']));
            }
            $info['open_vote'] = $wxianchang_info['open_vote'];
            $info['open_lottery'] = $wxianchang_info['open_lottery'];
            $info['open_zzle'] = $wxianchang_info['open_zzle'];
            $info['wall_id'] = $wxianchang_info['wall_id'];
            $info['shake_id'] = $wxianchang_info['shake_id'];
            $info['title'] = $wxianchang_info['title'];
            $info['logo'] = $wxianchang_info['logo'];
            $info['keyword'] = $wxianchang_info['keyword'];
            $info['qrcode'] = $wxianchang_info['qrcode'];
            $info['background'] = $wxianchang_info['background'];
        }else{
            if(ACTION_NAME == 'wall' || ACTION_NAME == 'wall_pic'){
                $info = M('Wall') -> where(array('token' => $this -> token, 'id' => $this -> _get('id', 'intval'))) -> find();
                $info['open_wall'] = 1;
                $info['cheer'] = json_encode(explode(',', $info['cheer']));
            }else if(ACTION_NAME == 'shake'){
                $info = M('Shake') -> where(array('token' => $this -> token, 'id' => $this -> _get('id', 'intval'))) -> find();
                $info['cheer'] = json_encode(explode('|', $info['cheer']));
                $info['open_shake'] = 1;
            }
        }
        $info['wxuser'] = M('wxuser') -> where(array('token' => $this -> token)) -> getField('weixin');
        $this -> info = $info;
        $this -> assign('info', $info);
    }
    public function index(){
        $where = array('token' => $this -> token);
        $count = $this -> wxianchang_db -> where($where) -> count();
        $Page = new Page($count, 15);
        $wxianchang_list = $this -> wxianchang_db -> where($where) -> order('id desc') -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $this -> assign('wxianchang_list', $wxianchang_list);
        $this -> assign('page', $Page -> show());
        $this -> display();
    }
    public function set(){
        $keyword_db = M('keyword');
        $wall = M('Wall') -> where(array('token' => $this -> token, 'isopen' => 1)) -> select();
        $shake = M('Shake') -> where(array('token' => $this -> token, 'isopen' => 1)) -> select();
        $wxianchang_info = $this -> wxianchang_db -> where(array('token' => $this -> token, 'id' => $this -> _get('id', 'intval'))) -> find();
        if(IS_POST){
            if($this -> wxianchang_db -> create($_POST)){
                if($wxianchang_info){
                    $_POST['vote_id'] = ltrim($_POST['vote_id'], ',');
                    $id = $this -> _post('id', 'intval');
                    $this -> wxianchang_db -> where(array('token' => $this -> token, 'id' => $id)) -> save($_POST);
                    $this -> success('修改成功', U('wxianchang/index', array('token' => $this -> token)));
                    $keyword['pid'] = $id;
                    $keyword['module'] = 'wxianchang';
                    $keyword['token'] = $this -> token;
                    $keyword['keyword'] = $this -> _post('keyword', 'trim');
                    $keyword_db -> where(array('token' => $this -> token, 'pid' => $id, 'module' => 'wxianchang')) -> save($keyword);
                }else{
                    $_POST['token'] = $this -> token;
                    $_POST['vote_id'] = ltrim($_POST['vote_id'], ',');
                    $id = $this -> wxianchang_db -> add($_POST);
                    $keyword['pid'] = $id;
                    $keyword['module'] = 'wxianchang';
                    $keyword['token'] = $this -> token;
                    $keyword['keyword'] = $this -> _post('keyword', 'trim');
                    $keyword_db -> add($keyword);
                    $this -> success('添加现场成功', U('wxianchang/index', array('token' => $this -> token)));
                }
            }else{
                $this -> error($this -> wxianchang_db -> getError());
            }
        }else{
            $vote = M('Vote') -> where(array('token' => $this -> token, 'type' => 'wxianchang', 'id' => array('in', explode(',', $wxianchang_info['vote_id'])))) -> select();
            $this -> assign('vote', $vote);
            $this -> assign('id', 6);
            $this -> assign('info', $wxianchang_info);
            $this -> assign('wall', $wall);
            $this -> assign('shake', $shake);
            $this -> display();
        }
    }
    public function del(){
        $id = $this -> _get('id', 'intval');
        $where = array('token' => $this -> token, 'id' => $id);
        if($this -> wxianchang_db -> where($where) -> delete()){
            M('keyword') -> where(array('pid' => $id, 'token' => $this -> token, 'module' => 'wxianchang')) -> delete();
            M('Wall_member') -> where(array('act_id' => $id, 'act_type' => '3', 'token' => $this -> token)) -> delete();
            M('wall_supperzzle') -> where(array('wxianchangid' => $id, 'token' => $this -> token)) -> delete();
            M('wall_prize') -> where(array('wxianchangid' => $id, 'token' => $this -> token)) -> delete();
            M('wall_prize_record') -> where(array('wxianchangid' => $id)) -> delete();
            $this -> success('删除成功', U('wxianchang/index', array('token' => $this -> token)));
        }
    }
    public function vote_add(){
        $where = array('token' => $this -> token, 'type' => 'wxianchang');
        $count = M('Vote') -> where($where) -> count();
        $Page = new Page($count, 5);
        $vote = M('Vote') -> where($where) -> order('id desc') -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $this -> assign('page', $Page -> show());
        $this -> assign('vote_list', $vote);
        $this -> display();
    }
    public function wall(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $where = array('token' => $this -> token, 'wallid' => $this -> info['id']);
        $message = $this -> _getWallList($where, 'check_time desc,time desc', 3, $wxianchangid, 'msg');
        $temp = $this -> _getWallList($where, 'check_time asc,time asc', 10, $wxianchangid, 'msg');
        $this -> assign('wxianchangid', $wxianchangid);
        $this -> assign('temp', $temp);
        $this -> assign('message', $message);
        $this -> display();
    }
    public function wall_pic(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $where = array('token' => $this -> token, 'wallid' => $this -> info['id']);
        $message = $this -> _getWallList($where, 'check_time desc,time desc', 5, $wxianchangid, 'pic');
        $this -> assign('wxianchangid', $wxianchangid);
        $this -> assign('message', $message);
        $this -> display();
    }
    public function ajaxWall(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $where = array('token' => $this -> token, 'wallid' => $this -> _get('id', 'intval'), 'check_time' => array('gt', intval($_GET['ajax_time'])));
        $data = $this -> _getWallList($where, 'check_time asc,time asc', '', $wxianchangid, 'msg');
        $result = array();
        if($data){
            $result['err'] = 0;
            $result['res'] = $data;
        }
        echo json_encode($result);
    }
    public function ajaxWallPic(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $where = array('token' => $this -> token, 'wallid' => $this -> _get('id', 'intval'), 'check_time' => array('gt', intval($_GET['ajax_time'])));
        $data = $this -> _getWallList($where, 'check_time asc,time asc', '', $wxianchangid, 'pic');
        $result = array();
        if($data){
            $result['err'] = 0;
            $result['res'] = $data;
        }
        echo json_encode($result);
    }
    public function _getWallList($where, $order, $limit = "", $wxianchangid = '', $type = ''){
        $uwhere = array('token' => $where['token']);
        if($wxianchangid){
            $where['is_wxianchang'] = '1';
            $uwhere['act_type'] = '3';
            $uwhere['act_id'] = $wxianchangid;
        }else{
            $where['is_wxianchang'] = '0';
            $uwhere['act_type'] = '1';
            $uwhere['act_id'] = $where['wallid'];
        }
        if($type == 'msg'){
            $where['picture'] = array('eq', '');
        }else if($type == 'pic'){
            $where['picture'] = array('neq', '');
        }
        $ck_msg = M('wall') -> where(array('token' => $this -> token, 'id' => $where['wallid'])) -> getField('ck_msg');
        if($ck_msg == '1'){
            $where['is_check'] = '1';
        }
        $message = M('Wall_message') -> where($where) -> order($order) -> limit($limit) -> select();
        $wuser_db = M('Wall_member');
        foreach($message as $key => $value){
            $uwhere['id'] = $value['uid'];
            $message[$key]['nickname'] = $wuser_db -> where($uwhere) -> getField('nickname');
            $message[$key]['portrait'] = $wuser_db -> where($uwhere) -> getField('portrait');
            $message[$key]['ajax_time'] = $value['check_time'];
        }
        return $message;
    }
    public function Shake(){
        $id = $this -> _get('id', 'intval');
        $wxianchangid = $this -> _post('wxianchangid', 'intval');
        if($wxianchangid){
            $is_wxianchang = '1';
        }else{
            $is_wxianchang = '0';
        }
        $round = M('Shake_rt') -> where(array('token' => $this -> token, 'shakeid' => $id, 'is_wxianchang' => $is_wxianchang)) -> max('round');
        $this -> assign('round', $round + 1);
        $this -> display();
    }
    public function startShake(){
        $result = M('Shake') -> where(array('token' => $this -> token, 'id' => $this -> _get('id', 'intval'))) -> save(array('isact' => '1', 'endtime' => time()));
        if($result){
            $result = array('err' => 0);
        }else{
            $result = array('err' => 1, 'info' => '游戏意外中断，请重新开始');
            M('Shake') -> where(array('token' => $this -> token, 'id' => $this -> _get('id', 'intval'))) -> save(array('isact' => '0', 'endtime' => ''));
        }
        echo json_encode($result);
    }
    public function getConnectNum(){
        $wxianchangid = $this -> _post('wxianchangid', 'intval');
        $id = $this -> _post('id', 'intval');
        $where = array('token' => $this -> token);
        if($wxianchangid){
            $where['act_type'] = '3';
            $where['act_id'] = $wxianchangid;
        }else{
            $where['act_type'] = '2';
            $where['act_id'] = $id;
        }
        $count = M('Wall_member') -> where($where) -> count();
        echo $count;
    }
    public function getCount(){
        $result = M('Shake_rt') -> where(array('token' => $this -> _get('token'), 'shakeid' => intval($this -> _get('id', 'intval')))) -> limit(0, 80) -> order('count desc') -> select();
        $js = json_encode($result);
        echo $js;
    }
    public function shakeRun(){
        $id = $this -> _get('id', 'intval');
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $shake_db = M('Shake');
        $rt_db = M('Shake_rt');
        $member_db = M('Wall_member');
        if($wxianchangid){
            $is_wxianchang = '1';
            $act_type = '3';
            $act_id = $wxianchangid;
        }else{
            $is_wxianchang = '0';
            $act_type = '2';
            $act_id = $id;
        }
        $shake_info = $shake_db -> where(array('id' => $id, 'token' => $this -> token, 'isact' => 1, 'isopen' => 1)) -> find();
        $is_end = $rt_db -> where(array('is_wxianchang' => $is_wxianchang, 'token' => $this -> token, 'shakeid' => $id, 'round' => 0, 'count' => array('egt', $shake_info['endshake']))) -> find();
        $result = array();
        if($is_end || ($shake_info['endtime'] + $shake_info['usetime'] < time())){
            $result['status'] = 1;
            $result['info'] = '游戏已经结束';
            $user = $rt_db -> where(array('shakeid' => $id, 'token' => $this -> token, 'round' => 0, 'is_wxianchang' => $is_wxianchang)) -> order('count desc') -> limit(3) -> select();
            foreach ($user as $key => $value){
                $uwhere = array('wecha_id' => $value['wecha_id'], 'act_id' => $act_id, 'act_type' => $act_type);
                $u_info = $member_db -> where($uwhere) -> find();
                $user[$key]['name'] = $u_info['nickname'];
                $user[$key]['portrait'] = $u_info['portrait'];
            }
            $result['res'] = $user;
            $max_round = $rt_db -> where(array('token' => $this -> token, 'shakeid' => $id, 'is_wxianchang' => $is_wxianchang)) -> max('round');
            $rt_db -> where(array('token' => $this -> token, 'shakeid' => $id, 'round' => 0, 'is_wxianchang' => $is_wxianchang)) -> save(array('round' => $max_round + 1));
            M('Shake') -> where(array('token' => $this -> token, 'id' => $id)) -> save(array('isact' => '0'));
        }else{
            $user = $rt_db -> where(array('token' => $this -> token, 'shakeid' => $id, 'round' => 0, 'is_wxianchang' => $is_wxianchang)) -> order('count desc') -> limit($shake_info['shownum']) -> select();
            foreach ($user as $key => $value){
                $uwhere = array('wecha_id' => $value['wecha_id'], 'act_id' => $act_id, 'act_type' => $act_type);
                $u_info = $member_db -> where($uwhere) -> find();
                $user[$key]['nickname'] = $u_info['nickname'];
                $user[$key]['portrait'] = $u_info['portrait'];
                $user[$key]['mLeft'] = $this -> percent($value['count'], $shake_info['endshake']);
            }
            $result['status'] = 0;
            $result['res'] = $user;
        }
        echo json_encode($result);
    }
    public function show_shake(){
        $id = $this -> _get('id', 'intval');
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $round = $this -> _get('round', 'intval');
        if($wxianchangid){
            $is_wxianchang = '1';
        }else{
            $is_wxianchang = '0';
        }
        $max = M('Shake_rt') -> where(array('is_wxianchang' => $is_wxianchang, 'token' => $this -> token, 'shakeid' => $id, 'round' => array('neq', 0))) -> order('round desc,count desc') -> group('round') -> order('round asc') -> getField('round', true);
        if(empty($round)){
            $round = $max[0];
        }
        $data = M('Shake_rt') -> where(array('is_wxianchang' => $is_wxianchang, 'token' => $this -> token, 'shakeid' => $id, 'round' => $round)) -> order('count desc') -> select();
        foreach ($data as $key => $value){
            $where = array('token' => $this -> token, 'wecha_id' => $value['wecha_id']);
            if($wxianchangid){
                $where['act_type'] = 3;
                $where['act_id'] = $wxianchangid;
            }else{
                $where['act_type'] = 2;
                $where['act_id'] = $id;
            }
            $data[$key]['name'] = M('Wall_member') -> where($where) -> getField('nickname');
            $data[$key]['head'] = M('Wall_member') -> where($where) -> getField('portrait');
        }
        $this -> assign('id', $id);
        $this -> assign('round', $round);
        $this -> assign('max', $max);
        $this -> assign('data', $data);
        $this -> display();
    }
    public function show_fans(){
        $id = $this -> _get('id', 'intval');
        $keyword = $this -> _post('keyword', 'trim');
        $where = array('token' => $this -> token, 'act_id' => $id, 'act_type' => '3');
        if(!empty($keyword)){
            $where['nickname|truename'] = array('like', '%' . $keyword . '%');
        }
        $count = M('Wall_member') -> where($where) -> count();
        $Page = new Page($count, 15);
        $list = M('Wall_member') -> where($where) -> order('time desc') -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $wxianchang = M('Wechat_wxianchang') -> where(array('token' => $this -> token, 'id' => $id)) -> field('wall_id,shake_id,vote_id') -> find();
        $this -> assign('wxianchangid', $id);
        $this -> assign('wxianchang', $wxianchang);
        $this -> assign('page', $Page -> show());
        $this -> assign('list', $list);
        $this -> display();
    }
    public function del_fens(){
        $id = $this -> _get('id', 'intval');
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $where = array('token' => $this -> token, 'id' => $id, 'act_type' => '3');
        $wecha_id = M('Wall_member') -> where($where) -> getField('wecha_id');
        $wxianchang_info = M('Wechat_wxianchang') -> where(array('token' => $this -> token, 'wxianchangid' => $wxianchangid)) -> find();
        if(M('Wall_member') -> where($where) -> delete()){
            M('Shake_rt') -> where(array('token' => $this -> token, 'is_wxianchang' => '1', 'wecha_id' => $wecha_id)) -> delete();
            M('Wall_message') -> where(array('token' => $this -> token, 'is_wxianchang' => '1', 'wallid' => $wxianchang_info['wall_id'], 'uid' => $id)) -> delete();
            M('wall_prize_record') -> where(array('token' => $this -> token, 'wxianchangid' => $wxianchangid, 'uid' => $id)) -> delete();
            $this -> success('删除成功', U('wxianchang/show_fans', array('token' => $this -> token, 'id' => $wxianchangid)));
        }
    }
    function percent($p, $t, $offset = 0){
        if($t == 0){
            $val = 1;
        }else{
            $val = $p / $t;
        }
        $num = sprintf('%.2f%%', ($val + $offset) * 100);
        return $num;
    }
    public function Lottery(){
        $prize = M('Wall_prize') -> where(array('token' => $this -> token, 'wxianchangid' => $this -> _get('wxianchangid', 'intval'))) -> order('sort desc,id asc') -> select();
        $users = M('Wall_member') -> where(array('token' => $this -> token, 'act_type' => '3', 'act_id' => $this -> _get('wxianchangid', 'intval'))) -> count();
        $this -> assign('users', $users);
        $this -> assign('prize', $prize);
        $this -> display();
    }
    public function prize_data(){
        $pid = $this -> _get('pid', 'intval');
        $id = $this -> _get('id', 'intval');
        $where = array('token' => $this -> token, 'id' => $pid, 'wxianchangid' => $id);
        $num = M('Wall_prize') -> where($where) -> getField("num");
        $p_num = M('Wall_prize_record') -> where(array('wxianchangid' => $id, 'prize' => $pid)) -> count();
        $prize_user = M('Wall_prize_record') -> where(array('wxianchangid' => $id, 'prize' => $pid)) -> order('time asc') -> select();
        foreach($prize_user as $key => $value){
            $user_info = M('Wall_member') -> where(array('id' => $value['uid'], 'act_id' => $id, 'act_type' => '3')) -> find();
            $prize_user[$key]['nickname'] = $user_info['nickname'];
            $prize_user[$key]['portrait'] = $user_info['portrait'];
        }
        $data = array('prize_num' => $num - $p_num, 'prize_user' => $prize_user);
        echo json_encode($data);
    }
    public function get_lottery(){
        $pid = $this -> _get('pid', 'intval');
        $id = $this -> _get('id', 'intval');
        $info = M('Wall_member') -> where(array('token' => $this -> token, 'act_id' => $id, 'act_type' => '3')) -> order('time desc') -> limit(50) -> select();
        $result = array();
        $prize_num = M('wall_prize') -> where(array('id' => $pid, 'token' => $this -> token, 'wxianchangid' => $id)) -> getField('num');
        $prize_user = M('wall_prize_record') -> where(array('wxianchangid' => $id, 'prize' => $pid)) -> count();
        if($prize_num <= $prize_user){
            $result['err'] = 2;
            $result['info'] = '该奖项名额已经用完';
            echo json_encode($result);
            exit;
        }
        if($info){
            $result['err'] = 0;
            $result['res'] = $info;
        }else{
            $result['err'] = 1;
            $result['info'] = '还没人有参加！';
        }
        echo json_encode($result);
    }
    public function lottery_ok(){
        $member_db = M('Wall_member');
        $record_db = M('wall_prize_record');
        $prize_db = M('wall_prize');
        $pid = $this -> _get('pid', 'intval');
        $id = $this -> _get('id', 'intval');
        $arr = $member_db -> where(array('act_id' => $id, 'act_type' => '3')) -> getField('id', true);
        $key = array_rand($arr);
        $info = $member_db -> where(array('act_id' => $id, 'act_type' => '3', 'id' => $arr[$key])) -> select();
        if($info){
            $data['uid'] = $arr[$key];
            $data['wxianchangid'] = $id;
            $data['prize'] = $pid;
            $data['time'] = time();
            $record_db -> add($data);
            echo json_encode($info);
        }
    }
    public function loadUser(){
        $wxianchangid = $this -> _get('id', 'intval');
        $where = array('act_id' => $wxianchangid, 'act_type' => 3);
        $count = M('Wall_member') -> where($where) -> count();
        echo json_encode(array('err' => 0, 'count' => $count));
    }
    public function show_prize(){
        $wxianchangid = $this -> _get('id', 'intval');
        $prize_info = M('wall_prize') -> where(array('token' => $this -> token, 'wxianchangid' => $wxianchangid)) -> order('sort desc,id desc') -> select();
        $this -> assign('prize_info', $prize_info);
        $this -> display();
    }
    public function show_plog(){
        $wxianchangid = $this -> _get('id', 'intval');
        $pid = $this -> _get('pid', 'intval');
        $prize_info = M('Wall_prize') -> where(array('token' => $this -> token, 'wxianchangid' => $wxianchangid)) -> order('sort desc,id desc') -> select();
        if(empty($pid)){
            $pid = $prize_info[0]['id'];
        }
        $user = M('Wall_prize_record') -> where(array('wxianchangid' => $wxianchangid, 'prize' => $pid)) -> select();
        foreach ($user as $key => $value){
            $where = array('act_id' => $wxianchangid, 'act_type' => 3, 'id' => $value['uid']);
            $user_info = M('Wall_member') -> where($where) -> field('portrait,nickname') -> find();
            $user[$key]['name'] = $user_info['nickname'];
            $user[$key]['head'] = $user_info['portrait'];
        }
        $this -> assign('pid', $pid);
        $this -> assign('user', $user);
        $this -> assign('prize_info', $prize_info);
        $this -> display();
    }
    public function prize(){
        $wxianchangid = $this -> _get('id', 'intval');
        $where = array('wxianchangid' => $wxianchangid, 'token' => $this -> token);
        $count = M('Wall_prize') -> where($where) -> count();
        $Page = new Page($count, 15);
        $list = M('Wall_prize') -> where($where) -> order('sort desc,id asc') -> limit($Page -> firstRow . ',' . $Page -> listRows) -> select();
        $this -> assign('wxianchangid', $wxianchangid);
        $this -> assign('list', $list);
        $this -> assign('page', $Page -> show());
        $this -> display();
    }
    public function prize_set(){
        $prize_db = D('Wall_prize');
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $pid = $this -> _get('pid', 'intval');
        $prize_info = $prize_db -> where(array('token' => $this -> token, 'wxianchangid' => $wxianchangid, 'id' => $pid)) -> find();
        if(IS_POST){
            if($prize_db -> create()){
                if($prize_info){
                    $_POST['token'] = $this -> token;
                    $prize_db -> where(array('token' => $this -> token, 'id' => $this -> _post('id', 'intval'), 'wxianchangid' => $wxianchangid)) -> save($_POST);
                    $this -> success('修改成功', U('wxianchang/prize', array('token' => $this -> token, 'id' => $wxianchangid)));
                }else{
                    $_POST['token'] = $this -> token;
                    $_POST['wxianchangid'] = $wxianchangid;
                    $prize_db -> add($_POST);
                    $this -> success('添加成功', U('wxianchang/prize', array('token' => $this -> token, 'id' => $wxianchangid)));
                }
            }else{
                $this -> error($prize_db -> getError());
            }
        }else{
            $this -> assign('info', $prize_info);
            $this -> assign('wxianchangid', $wxianchangid);
            $this -> display();
        }
    }
    public function prize_del(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $id = $this -> _get('pid', 'intval');
        if(M('Wall_prize') -> where(array('token' => $this -> token, 'id' => $id, 'wxianchangid' => $wxianchangid)) -> delete()){
            M('wall_prize') -> where(array('prize' => $id, 'wxianchangid' => $wxianchangid, 'token' => $this -> token)) -> delete();
            $this -> success('删除成功', U('wxianchang/prize', array('token' => $this -> token, 'id' => $wxianchangid)));
        }
    }
    public function prizeRecords(){
        $where['token'] = $this -> token;
        $where['prize'] = $this -> _get('pid', 'intval');
        $where['wxianchangid'] = $this -> _get('wxianchangid', 'intval');
        $recordsArr = M('Wall_prize_record') -> where($where) -> select();
        foreach($recordsArr as $key => $value){
            $user = M('wall_member') -> where(array('act_type' => '3', 'act_id' => $where['wxianchangid'], 'id' => $value['uid'])) -> field('portrait,nickname') -> find();
            $recordsArr[$key]['nickname'] = $user['nickname'];
            $recordsArr[$key]['portrait'] = $user['portrait'];
            $recordsArr[$key]['prize_name'] = M('wall_prize') -> where(array('token' => $this -> token, 'wxianchangid' => $value['wxianchangid'], 'id' => $value['prize'])) -> getField('pname');
        }
        $this -> assign('empty', '没有找到相关记录');
        $this -> assign('records', $recordsArr);
        $this -> display();
    }
    public function vote(){
        $vote_list = M('Vote') -> where(array('token' => $this -> token, 'id' => array('in', $this -> info['vote_id']))) -> select();
        $now = time();
        foreach ($vote_list as $key => $value){
            if($value['enddate'] < $now && $value['status'] == 0){
                $vote_list[$key]['is_end'] = 1;
            }else{
                $vote_list[$key]['is_end'] = 0;
            }
        }
        $this -> assign('vote_list', $vote_list);
        $this -> display();
    }
    public function get_vote(){
        $vote_id = $this -> _get('vote_id', 'intval');
        $wxianchang_id = $this -> _get('wxianchang_id', 'intval');
        $vote_item = M('Vote_item') -> where(array('vid' => $vote_id)) -> order('id desc') -> select();
        $result = array();
        if($vote_item){
            $result['err'] = 0;
            $result['res'] = $vote_item;
        }else{
            $result['err'] = 1;
            $result['res'] = "没有找到投票选项";
        }
        echo json_encode($result);
    }
    public function vote_start(){
        $vote_id = $this -> _get('vote_id', 'intval');
        $offset = M('Vote') -> where(array('token' => $this -> token, 'id' => $vote_id, 'status' => 0)) -> save(array('status' => 1));
        $result['err'] = 0;
        $result['msg'] = '投票已经开启';
        echo json_encode($result);
    }
    public function ajaxVcount(){
        $vote_id = $this -> _get('vote_id', 'intval');
        $vote_info = M('Vote') -> where(array('token' => $this -> token, 'id' => $vote_id)) -> find();
        $res = M('Vote_item') -> where(array('vid' => $vote_id)) -> field('id,vcount') -> select();
        $result['res'] = $res;
        $time = time();
        if($vote_info['statdate'] < $time && $vote_info['enddate'] > $time){
            $result['flag'] = 1;
        }else{
            $result['flag'] = 0;
        }
        echo json_encode($result);
    }
    public function vote_stop(){
        $vote_id = $this -> _get('vote_id', 'intval');
        $now = time();
        $offset = M('Vote') -> where(array('token' => $this -> token, 'id' => $vote_id)) -> save(array('status' => 0, 'statdate' => $now-1, 'enddate' => $now-1));
        if($offset = 1){
            $result['err'] = 0;
            $id = M('Vote_item') -> where(array('vid' => $vote_id)) -> order('vcount desc') -> getField('id', true);
            $id = array_flip($id);
            $res = M('Vote_item') -> where(array('vid' => $vote_id)) -> order('id desc') -> select();
            foreach ($res as $key => $value){
                $res[$key]['ranks'] = $id[$value['id']] + 1;
            }
            $result['res'] = $res;
        }
        echo json_encode($result);
    }
    public function vote_count(){
        $vote_id = $this -> _get('vote_id', 'intval');
        $result['count'] = count($this -> _getMember('vote_id', $vote_id, '', 'id'));
        $result['fcount'] = M('Vote_record') -> where(array('vid' => $vote_id)) -> count();
        echo json_encode($result);
    }
    public function show_vote(){
        $vote_id = $this -> _get('id', 'intval');
        $now = time();
        $vote_info = M('Vote') -> where(array('token' => $this -> token, 'id' => $vote_id, 'status' => 0, 'enddate' => array('lt', $now))) -> find();
        if($vote_info){
            $res = M('Vote_item') -> where(array('vid' => $vote_info['id'])) -> order('vcount desc') -> select();
        }
        $this -> assign('vote', $res);
        $this -> display();
    }
    public function supperzzle(){
        $this -> display();
    }
    public function defUser(){
        $wxianchangid = $this -> _get('wxianchangid', 'intval');
        $result = array();
        $male = $this -> _getMember('id', $wxianchangid, '', 'list', array('sex' => 1));
        $female = $this -> _getMember('id', $wxianchangid, '', 'list', array('sex' => 0));
        $maleCount = count($this -> _getMember('id', $wxianchangid, '', 'id', array('sex' => 1)));
        $femaleCount = count($this -> _getMember('id', $wxianchangid, '', 'id', array('sex' => 0)));
        if(empty($maleCount) || empty($femaleCount)){
            $result['err'] = 1;
            $result['msg'] = '剩余玩家不足以配对！';
        }else{
            $result['err'] = 0;
            $result['data']['list']['male'] = $male;
            $result['data']['list']['female'] = $female;
        }
        $result['data']['maleCount'] = $maleCount;
        $result['data']['femaleCount'] = $femaleCount;
        echo json_encode($result);
    }
    public function add_slog(){
        $_POST['addtime'] = time();
        $_POST['token'] = $this -> token;
        M('Wall_supperzzle') -> add($_POST);
    }
    public function supperzzle_log(){
        $wxianchangid = $this -> _get('id', 'intval');
        $sid = $this -> _get('sid', 'intval');
        $count = M('Wall_supperzzle') -> where(array('wxianchangid' => $wxianchangid)) -> order('addtime desc') -> getField('id', true);
        if(empty($sid)){
            $sid = $count[0];
        }
        $info = M('Wall_supperzzle') -> where(array('wxianchangid' => $wxianchangid, 'id' => $sid)) -> order('addtime desc') -> find();
        $n_info = $this -> supperzzle_user($info['nid'], $wxianchangid);
        $v_info = $this -> supperzzle_user($info['vid'], $wxianchangid);
        $info['n_name'] = $n_info['nickname'];
        $info['n_head'] = $n_info['portrait'];
        $info['v_name'] = $v_info['nickname'];
        $info['v_head'] = $v_info['portrait'];
        $this -> assign('wxianchangid', $wxianchangid);
        $this -> assign('info', $info);
        $this -> assign('count', $count);
        $this -> display();
    }
    public function supperzzle_user($id, $wxianchangid){
        $where = array('token' => $this -> token, 'act_type' => '3', 'act_id' => $wxianchangid, 'id' => $id);
        $user = M('wall_member') -> where($where) -> field('nickname,portrait') -> find();
        return $user;
    }
    public function _getMember($field, $id, $limit = "", $return = "list", $ext = ''){
        $member_db = M('Wall_member');
        $wxianchang_db = M('Wechat_wxianchang');
        $act_id = $wxianchang_db -> where(array('token' => $this -> token, 'is_open' => '1', "$field" => $id)) -> getField('id');
        if($act_id){
            $where = array('token' => $this -> token, 'act_id' => $act_id, 'act_type' => '3');
        }else{
            if($field == 'shake_id'){
                $where = array('token' => $this -> token, 'act_id' => $id, 'act_type' => '2');
            }else if($field == 'wall_id'){
                $where = array('token' => $this -> token, 'act_id' => $id, 'act_type' => '1');
            }
        }
        if($ext){
            $where = array_merge($where, $ext);
        }
        if($return == 'list'){
            $user = $member_db -> where($where) -> limit($limit) -> select();
        }else if($return == 'id'){
            $user = $member_db -> where($where) -> limit($limit) -> getField('id', true);
        }
        return $user;
    }
    public function header(){
        $this -> display();
    }
    public function footer(){
        $this -> display();
    }
}
?>