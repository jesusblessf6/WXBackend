<?php
class SharetalentAction extends WapAction
{
    public function index()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent')->where(array('token' => $token))->select();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('token', $token);
        $this->assign('wecha_id', $wecha_id);
        $this->assign('info', $info);
        $this->assign('date', $date);
        $ttime = time();
        // dump($a);exit;
        if (empty($info)) {
            die('非法操作');
        }
        $this->assign('ttime', $ttime);
        $this->display();
    }
    public function rules()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $id = $this->_get('id');
        //注册
        $infos = M('sharetalent_user')->where(array('wecha_id' => $wecha_id, 'token' => $token))->find();
        if (empty($infos)) {
            $this->redirect('Sharetalent/reg', array('token' => $token, 'wecha_id' => $wecha_id));
        }
        //end
        $info = M('sharetalent')->where(array('token' => $token, 'id' => $id))->find();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        $this->assign('info', $info);
        if (empty($info)) {
            die('非法操作');
        }
        $this->display();
    }
    public function reg()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent_user')->where(array('wecha_id' => $wecha_id, 'token' => $token))->find();
        //dump($info);exit;
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        if (IS_POST) {
            $p['token'] = $token;
            $p['wecha_id'] = $wecha_id;
            $p['name'] = $this->_post('name');
            $p['tel'] = $this->_post('tel');
            $p['date'] = date('Y-m-d H:i:s', time());
            $enter = M('sharetalent_user')->add($p);
            if ($enter) {
               echo 1;exit;
            } else {
               echo 2;exit;
            }
        }
        if (!empty($info)) {
            $this->redirect('Sharetalent/user', array('token' => $token, 'wecha_id' => $wecha_id));
        } else {
            $this->display();
        }
    }
    public function info()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $pid = $this->_get('id');
        //注册
        $infos = M('sharetalent_user')->where(array('wecha_id' => $wecha_id, 'token' => $token))->find();
        if (empty($infos)) {
            $this->redirect('Sharetalent/reg', array('token' => $token, 'wecha_id' => $wecha_id));
        }
        //end
        $action = $this->_get('action');
        $id = $this->_get('id');
        $click = M('sharetalent')->where(array('token' => $token, 'id' => $id))->setInc('click');
        $info = M('sharetalent')->where(array('token' => $token, 'id' => $id))->find();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        //click
        $enter = M('sharetalent')->where(array('token' => $token, 'id' => $pid))->find();
        $name = M('sharetalent_user')->where(array('token' => $token, 'wecha_id' => $wecha_id))->find();
        $dates['token'] = $token;
        $dates['wecha_id'] = $wecha_id;
        $dates['pid'] = $pid;
        $dates['click'] = 1;
        $dates['rule'] = $enter['rule'];
        $dates['prize'] = $enter['prize'];
        $dates['end'] = 1 - $enter['rule'];
        $dates['title'] = $enter['title'];
        $dates['picurl'] = $enter['picurl'];
        $dates['number'] = $enter['number'];
        $dates['name'] = $name['name'];
        $dates['tel'] = $name['tel'];
        $dates['statdate'] = $enter['statdate'];
        $s = M('sharetalent_record')->where(array('token' => $token, 'wecha_id' => $wecha_id, 'pid' => $pid))->find();
        if ($action == 'share') {
            $ip = get_client_ip();
            $clickip['ip'] = $ip;
            $clickip['token'] = $token;
            $clickip['pid'] = $pid;
            $clickip['enterdate'] = time();
            $userip = M('sharetalent_userip')->where(array('token' => $token, 'ip' => $ip))->find();
            $end = time() - $userip['enterdate'];
            if (empty($s)) {
                $infos = M('sharetalent_record')->add($dates);
            } else {
                if (empty($userip)) {
                    $useriprecord = M('sharetalent_userip')->add($clickip);
                } elseif ($end >= 86400) {
                    $notime['enterdate'] = time();
                    $useriprecord = M('sharetalent_userip')->where(array('ip' => $ip, 'pid' => $pid, 'token' => $token))->save($notime);
                    $click = M('sharetalent_record')->where(array('token' => $token, 'pid' => $pid, 'wecha_id' => $wecha_id))->setInc('click');
                    if ($click) {
                        $numeber['end'] = $s['click'] - $s['rule'] + 1;
                        $nemberenter = M('sharetalent_record')->where(array('token' => $token, 'pid' => $pid, 'wecha_id' => $wecha_id))->save($numeber);
                    }
                }
            }
        }
        $this->assign('info', $info);
        if (empty($info)) {
            die('非法操作');
        }
        $this->display();
    }
    public function user()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent_user')->where(array('token' => $token, 'wecha_id' => $wecha_id))->find();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        $this->assign('info', $info);
        $this->display();
    }
    public function edit()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent_user')->where(array('token' => $token, 'wecha_id' => $wecha_id))->find();

        if (IS_POST) {
            $data['name'] = $this->_post('name');
            $data['tel'] = $this->_post('tel');
            $insert = M('sharetalent_user')->where(array('token' => $token, 'wecha_id' => $wecha_id))->save($data);
            if ($insert) {
                echo 1;exit;
            } else {
                echo 2;exit;
            }
        }
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        $this->assign('info', $info);
        $this->display();
    }
    public function how()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent_sm')->where(array('token' => $token))->find();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        $this->assign('info', $info);
        $this->display();
    }
    public function what()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        //注册
        $infos = M('sharetalent_user')->where(array('wecha_id' => $wecha_id, 'token' => $token))->find();
        if (empty($infos)) {
            $this->redirect('Sharetalent/reg', array('token' => $token, 'wecha_id' => $wecha_id));
        }
        //end
        $info = M('sharetalent_sm')->where(array('token' => $token))->find();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('date', $date);
        $this->assign('info', $info);
        $this->display();
    }
    public function my()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        //注册
        $infos = M('sharetalent_user')->where(array('wecha_id' => $wecha_id, 'token' => $token))->find();
        if (empty($infos)) {
            $this->redirect('Sharetalent/reg', array('token' => $token, 'wecha_id' => $wecha_id));
        }
        //end
        $condition['token'] = $token;
        $condition['wecha_id'] = $wecha_id;
        $condition['click'] = array('GT', 0);
        $list = M('sharetalent_record')->where($condition)->select();
        $ttime = time();
        $date = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('ttime', $ttime);
        $this->assign('date', $date);
        $this->assign('list', $list);
        $this->display();
    }
    public function myprize()
    {
        $token = $this->_get('token');
        $wecha_id = $this->_get('wecha_id');
        $info = M('sharetalent')->where(array('token' => $token))->select();
        $condition['wecha_id'] = $wecha_id;
        $condition['token'] = $token;
        $condition['end'] = array('EGT', 0);
        $info = D('sharetalent_record')->where($condition)->select();
        $dates = M('sharetalent_reply')->where(array('token' => $token))->find();
        $this->assign('dates', $dates);
        $this->assign('info', $info);
        $this->display();
    }
}?>