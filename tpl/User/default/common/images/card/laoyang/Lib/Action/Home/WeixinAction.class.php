<?php
class WeixinAction extends Action
{
	private $token;
	private $fun;
    public $fans;
	private $data = array ();
	private $my = '小宝';
	public function index() 
	{
		$this->token = $this->_get('token', "htmlspecialchars");
		if (!preg_match("/^[0-9a-zA-Z]{3,42}$/", $this->token))
		{
			exit('error token');
		}
		$weixin = new Wechat($this->token);
		$data = $weixin->request();
		$this->data = $weixin->request();
        $this -> fans = S('fans_' . $this -> token . '_' . $this -> data['FromUserName']);
        if (!$this -> fans || 1){
            $this -> fans = M('Userinfo') -> where(array('token' => $this -> token, 'wecha_id' => $this -> data['FromUserName'])) -> find();
            S('fans_' . $this -> token . '_' . $this -> data['FromUserName'], $this -> fans);
        }
		$this->my = C('site_my');
		$open = M('Token_open')->where(array('token' => $this->_get('token')))->find();
		$this->fun = $open['queryname'];
		list($content, $type) = $this->reply($data);
		$weixin->response($content, $type);
	}
	private function reply($data) 
	{
		M('Wxuser_message')->add($data);
		if ('CLICK' == $data ['Event']) {
			
			$data ['Content'] = $data ['EventKey'];
		}
		if ('voice' == $data['MsgType'])
		{
			$data['Content'] = $data['Recognition'];
			$this->data['Content'] = $data['Recognition'];
		}

        //判断是不是有API操作
        if (!(strpos($this->fun, 'api') === FALSE) && isset($data['Content'])) {
            $apiData = M('Api')->where(array('token' => $this->token, 'status' => 1))->select();
            if (is_array($apiData)) {
                foreach ($apiData as $apiArray) {
                    if (!(strpos($data['Content'], $apiArray['keyword']) === FALSE)) {
                        $api['type'] = $apiArray['type'];
                        $api['url'] = $apiArray['url'];
                        break;
                    }
                }
                if ($api != false) {
                    $vo['fromUsername'] = $this->data['FromUserName'];
                    $vo['Content'] = $this->data['Content'];
                    $vo['toUsername'] = $this->token;
                    if ($api['type'] == 2) {
                        $apidata = $this->api_notice_increment($api['url'], $vo);
                        return array($apidata, 'text');
                    } else {
                        $xml = file_get_contents('php://input');
                        $apidata = $this->api_notice_increment($api['url'], $xml);
                        header('Content-type: text/xml');
                        die($apidata);
                        return false;
                    }
                }
            }
        }
        //车牌判断
        if (preg_match('/(京|沪|津|渝|冀|蒙|辽|吉|黑|苏|浙|皖|闽|赣|鲁|豫|鄂|湘|粤|桂|琼|川|贵|云|藏|陕|甘|青|宁|新)[a-zA-z]{1}[a-zA-z0-9]{5}/', $data['Content'], $che)) {
            return array($this->weizhang(strtoupper($che[0])), 'text');
            die;
        }		
		if ($data['Event'] == 'SCAN')
		{
			$data['Content'] = $this->getRecognition($data['EventKey']);
			$this->data['Content'] = $data['Content'];
		}
		if ('subscribe' == $data ['Event']) {
			
			$follow_data ['follow_form_id'] = $data ['FromUserName'];
			
			$follow_data ['follow_to_id'] = $data ['ToUserName'];
			
			$follow_data ['follow_time'] = $data ['CreateTime'];
			
			$foloow_lists = M ( 'Follow' )->add ( $follow_data );
			
			$this->requestdata ( 'follownum' );
			
			$data = M ( 'Areply' )->field ( 'home,keyword,content' )->where ( array (
					
					'token' => $this->token 
			)
			 )

			->find ();
			
			if ($data['keyword'] == '微房产') {
                return $this->estate();
            }
            if ($data['keyword'] == '微教育') {
                return $this->jiaoyu();
            }
            if ($data['keyword'] == '微婚庆') {
                return $this->hunqing();
            }
            if ($data['keyword'] == '微政务') {
                return $this->zhengwu();
            }
            if ($data['keyword'] == '微物业') {
                return $this->wuye();
            }
			if ($data ['home'] == 0 && $data ['keyword'] == "") { 
				
				if($data ['content'] != "")
				{
					return array (
						
						htmlspecialchars_decode(str_replace('{wechat_id}', $this->data['FromUserName'], $data ['content'])),

						'text' );
				}
				
			} else {
				
				if ($data ['home'] == 1 && $data ['keyword'] == "")//首次关注时只显示文本回复或者不回复
				{
					return $this->shouye ();
				}
				else
				{
					if ($data ['home'] == 1 && $data ['keyword'] != "")//首次关注时显示微站也显示多图文
					{
						
						$home = M ( 'Home' )->where ( array ('token' => $this->token))->find ();
						
						if ($home == false) {
							
							return array (
									
									'商家未做微官网配置',
									
									'text' 
							);					
						} else {
							
							if ($home ['apiurl'] == false) {
								
								$weburl = rtrim ( C ( 'site_url' ), '/' ) . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com';
							} else {
								
								$weburl = $home ['apiurl'];
							}
														
							$return [] = array (
							
								$home ['title'],
								
								$home ['info'],
								
								$home ['picurl'],
								
								$weburl 
							);
							
							$like ['keyword'] = array ('like','%' . $data ['keyword'] . '%' );

							$like ['token'] = $this->token;
							
							$back = M ( 'Img' )->field ( 'id,text,pic,url,title' )->limit ( 9 )->order ( 'sortid ASC' )->where ( $like )->select ();
							
							foreach ( $back as $keya => $infot ) {
								
								if ($infot ['url'] != false) {
									
									$url = $infot ['url'];
									$link = str_replace(array('{wechat_id}', '{siteUrl}', '&amp;'), array($this->wecha_id, C('site_url'), '&'), $url);
								} else {
									
									$link = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Index/content', array (
											
											'token' => $this->token,
											
											'id' => $infot ['id'] 
										)
									 );
								}
								$return [] = array (
										
										$infot ['title'],
										
										$infot ['text'],
										
										$infot ['pic'],
										
										$link 
								);

							}
							return array (
									
									$return,
									
									'news' 
							);
						}
					}
					else
					{
						if ($data ['home'] == 0 && $data ['keyword'] != "")//首次关注时不显示微站，只显示多图文
						{
							$like ['keyword'] = array ('like','%' . $data ['keyword'] . '%' );

							$like ['token'] = $this->token;
							
							$back = M ( 'Img' )->field ( 'id,text,pic,url,title' )->limit ( 9 )->order ( 'sortid ASC' )->where ( $like )->select ();
							
							foreach ( $back as $keya => $infot ) {
								
								if ($infot ['url'] != false) {
									
									$url = $infot ['url'];
									$link = str_replace(array('{wechat_id}', '{siteUrl}', '&amp;'), array($this->wecha_id, C('site_url'), '&'), $url);
								} else {
									
									$link = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Index/content', array (
											
											'token' => $this->token,
											
											'id' => $infot ['id'] 
									)
									 )

									;
								}
								
								$return [] = array (
										
										$infot ['title'],
										
										$infot ['text'],
										
										$infot ['pic'],
										
										$link 
								)
								;

							}
							
							return array (
									
									$return,
									
									'news' 
							);
						}
					}
				}
			}
		} elseif ('unsubscribe' == $data ['Event']) {
			
			$follow_data ['follow_form_id'] = $data ['FromUserName'];
			
			$follow_data ['follow_to_id'] = $data ['ToUserName'];
			
			$foloow_del = M ( 'Follow' )->where ( $follow_data )->delete ();
			
			$this->requestdata ( 'unfollownum' );
			$node = d("Wifi_keyword")->where(array("token" => $this->token))->find();
			$this->rippleos_unauth($node["node"]);
		} elseif ($data['Event'] == 'LOCATION') {return;}
        //开始一站到底
        if (!isset($_SESSION['wecha_id']) || $_SESSION['wecha_id'] == '') {
            $_SESSION['wecha_id'] = $this->data['FromUserName'];
        }
        if (@strpos($data['Content'], '出题') !== false) {
            $info = $this->dati();
            return $info;
        }
        if (S($_SESSION['wecha_id']) == 'start') {
            $info = $this->dati_start($data['Content']);
            return $info;
        }
        if ($data['Content'] == 'wechat ip') {
            return array($_SERVER['REMOTE_ADDR'], 'text');
        }
        if(strtolower($data['Content']) == 'wx#open'){
            M('Userinfo') -> where(array('token' => $this -> token, 'wecha_id' => $this -> data['FromUserName'])) -> save(array('wallopen' => 1));
            S('fans_' . $this -> token . '_' . $this -> data['FromUserName'], NULL);
            return array('您已进入微信墙对话模式，您下面发送的所有文字和图片信息都将会显示在大屏幕上，如需退出微信墙模式，请输入“wx#quit”', 'text');
        }elseif(strtolower($data['Content']) == 'wx#quit'){
            M('Userinfo') -> where(array('token' => $this -> token, 'wecha_id' => $this -> data['FromUserName'])) -> save(array('wallopen' => 0));
            S('fans_' . $this -> token . '_' . $this -> data['FromUserName'], NULL);
            return array('成功退出微信墙对话模式', 'text');
        }
        if ($this -> fans['wallopen']){
            $thisItem = M('Wall') -> where(array('token' => $this -> token, 'isopen' => 1)) -> find();
            if (!$thisItem){
                return array('微信墙活动不存在,如需退出微信墙模式，请输入“wx#quit”', 'text');
            }else{
                $memberRecord = M('Wall_member') -> where(array('wallid' => $thisItem['id'], 'wecha_id' => $this -> data['FromUserName'])) -> find();
                if (!$memberRecord){
                    return array('<a href="' . C('site_url') . '/index.php?g=Wap&m=Wall&a=index&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'] . '">点击这里完善信息后再参加此活动</a>', 'text');
                }else{
                    $row = array();
                    if ('image' != $data['MsgType']){
                        $message = str_replace('wx#', '', $data['Content']);
                    }else{
                        $message = '';
                        $row['picture'] = $data['PicUrl'];
                    }
                    $row['uid'] = $memberRecord['id'];
                    $row['wecha_id'] = $this -> data['FromUserName'];
                    $row['token'] = $this -> token;
                    $thisWall = $thisItem;
                    $thisMember = $memberRecord;
                    $row['wallid'] = $thisWall['id'];
                    $row['content'] = $message;
                    $row['uid'] = $thisMember['id'];
                    $row['time'] = time();
                    M('Wall_message') -> add($row);
                    return array('上墙成功，如需退出微信墙模式，请输入“wx#quit”', 'text');
                }
            }
        }
		$Pin = new GetPin ();
        //判断用户提交是否为图片
        if ($data['MsgType'] == 'image') {
            /**
             * 发送图片目前是晒图片的功能，
             */
            $pic_wall_inf = M('pic_wall')->where(array('token' => $this->token, 'status' => 1))->order('id desc')->find();
            if (!$pic_wall_inf) {
                return array('图片上墙失败！还未开启照片墙功能。', 'text');
            }
            if ($pic_wall_inf && $pic_wall_inf['status'] === '1') {
                //存在晒照片活动并且 活动开关是开的
                /*--开始下载图片操作*/
                $sub_dir = date('Ymd');
                if (!file_exists(($_SERVER['DOCUMENT_ROOT'] . '/uploads')) || !is_dir(($_SERVER['DOCUMENT_ROOT'] . '/uploads'))) {
                    mkdir($_SERVER['DOCUMENT_ROOT'] . '/uploads', 511);
                }
                $firstLetterDir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/picwall';
                if (!file_exists($firstLetterDir) || !is_dir($firstLetterDir)) {
                    mkdir($firstLetterDir, 511);
                }
                $firstLetterDir = ($_SERVER['DOCUMENT_ROOT'] . '/uploads/picwall/') . $sub_dir;
                if (!file_exists($firstLetterDir) || !is_dir($firstLetterDir)) {
                    mkdir($firstLetterDir, 511);
                }
                $file_name = ((date('YmdHis') . '_') . rand(10000, 99999)) . '.jpg';
                $pic_wall_save_path = ((($_SERVER['DOCUMENT_ROOT'] . '/uploads/picwall/') . $sub_dir) . '/') . $file_name;
                $file_web_path = (((C('site_url') . '/uploads/picwall/') . $sub_dir) . '/') . $file_name;
                $PicUrl = $data['PicUrl'];
                $imgdata = $this->curlGet($PicUrl);
                $fp = fopen($pic_wall_save_path, 'w');
                fwrite($fp, $imgdata);
                fclose($fp);
                //将照片的路径放入到 缓存中
                $checkresult = $pic_wall_inf['ischeck'] ? 0 : 1;
                //设置上墙图片的检查结果。如果活动设置 是需要审核，那么上墙结果为0需要审核，审核成功以后为1
                //插入到照片墙表中
                $pic_wall_log = array('uid' => $pic_wall_inf['id'], 'token' => $this->token, 'picurl' => $file_web_path, 'wecha_id' => $data['FromUserName'], 'create_time' => time(), 'username' => '', 'state' => $checkresult);
                S('zhaopianwall_' . $this->data['FromUserName'], $pic_wall_log, 60);
                //--下载图片结束
                return array('照片接收成功，请在一分钟内输入 上墙照片的显示名字，或者回复 取消 结束本次活动', 'text');
            } else {
                return array('图片上墙失败！还未开启照片墙功能。', 'text');
            }
        }
        //判断照片墙
        $zhaopianwall_result = S('zhaopianwall_' . $data['FromUserName']);
        if ($zhaopianwall_result) {
            return $this->zhaopianwall($zhaopianwall_result);
        }
		if (!(strpos($data['Content'], '附近') === false))
		{
			$this->recordLastRequest($data['Content']);
			$return = $this->fujin(array(str_replace('附近', '', $data['Content'])));
        }elseif (!(strpos($data['Content'], '公交') === false)){
            $return = $this -> gongjiao(explode('公交', $data['Content']));
        }elseif (!(strpos($data['Content'], '域名') === false)){
            $return = $this -> yuming(str_replace('域名', '', $data['Content']));
        }elseif (!(strpos($data['Content'], '天气') === false)){
            $return = $this -> tianqi(str_replace('天气', '', $data['Content']));
        }
		elseif (strtolower ( substr ( $data ['Content'], 0, 3 ) ) == "yyy") 
		{
			
			$key = "摇一摇";
			
			$yyyphone = substr ( $data ['Content'], 3, 11 );
		} 

		elseif (substr ( $data ['Content'], 0, 2 ) == "##") 

		{
			
			$key = "微信墙";
			
			$wallmessage = substr_replace ( $data ['Content'], "", 0, 2 );
		} 
		else
		{
			$key = $data ['Content'];
			
			$open = M ( 'Token_open' )->where ( array (
					
					'token' => $this->_get ( 'token' )
					)
			 )
			->find ();
			$this->fun = $open ['queryname'];
			
			$datafun = explode ( ',', $open ['queryname'] );
				$tags = $this->get_tags($key);
				$back = explode(',', $tags);
				if ($key == '首页' || $key == 'home')
				{
					return $this->home();
				}
				foreach($back as $keydata => $data)
				{
					$string = $Pin->Pinyin($data);
					if (in_array($string, $datafun) && $string)
					{
						$check = $this->user ( 'connectnum' );
							if ($string == 'fujin')
							{
								$this->recordLastRequest($key);
							}
							$this->requestdata('textnum');
						if ($check ['connectnum'] != 1) {
							
							$return = C ( 'connectout' );
							
							continue;
						}
							unset($back[$keydata]);
						
						eval ( '$return= $this->' . $string . '($back);' );
						continue;
					}
				}
		}
		
		if (!empty($return))
		{
			if (is_array($return))
			{
				return $return;
			}
			else
			{
				return array($return, 'text');
			}
		}
		else
		{
			if (!(strpos($key, 'cheat') === false))
			{
				$arr = explode(' ', $key);
				$datas['lid'] = intval($arr[1]);
				$lotteryPassword = $arr[2];
				$datas['prizetype'] = intval($arr[3]);
				$datas['intro'] = $arr[4];
				$datas['wecha_id'] = $this->data['FromUserName'];
				$thisLottery = M('Lottery')->where(array('id' => $datas['lid']))->find();
				if ($lotteryPassword == $thisLottery['parssword'])
				{
					$rt = M('Lottery_cheat')->add($datas);
					if ($rt)
					{
						return array('设置成功', 'text');
					}
					return array('设置失败:未知原因', 'text');
				}
				else
				{
					return array('设置失败:密码不对', 'text');
				}
			}
			if ($this->data['Location_X'])
			{
				$this->recordLastRequest($this->data['Location_Y'] . ',' . $this->data['Location_X'], 'location');
				return $this->map($this->data['Location_X'], $this->data['Location_Y']);
			}
			if (!(strpos($key, '开车去') === false) || !(strpos($key, '坐公交') === false) || !(strpos($key, '步行去') === false))
			{
				$this->recordLastRequest($key);
				$user_request_model = M('User_request');
				$loctionInfo = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => 'location', 'uid' => $this->data['FromUserName']))->find();
				
				if ($loctionInfo && intval ( $loctionInfo ['time'] > (time () - 60) )) {
					
					$latLng = explode ( ',', $loctionInfo ['keyword'] );
					
					return $this->map ( $latLng [1], $latLng [0] );
				}
				
				return array (
						
						'请发送您所在的位置',
						
						'text' 
				)
				;
			}
			switch ($key) {
				
				case '首页' :
					
					return $this->home ();
					
					break;
				
				case '主页' :
					
					return $this->home ();
					
					break;
				
				case '地图' :
					
					return $this->companyMap ();
					
					break;
					
				case '电影': 
					
					return $this -> dianying();
             
					break;
				
				case '微信墙' :
					
					// 判断商家是否开启
					
					$yyy = M ( 'Wewall' )->where ( array (
							
							'isact' => '1',
							
							'token' => $this->token 
					)
					 )->find ();
					
					$welog = array ();
					
					if ($yyy == false) {
						
						return array (
								
								'目前商家未开启微信墙活动',
								
								'text' 
						)
						;

						
					}
					
					// 进入开启状态处理 step1 检查是否需要生成sn码抽奖
					
					$openid = $this->data ['FromUserName'];
					
					$exs = M ( 'Wewalllog' )->where ( array (
							
							'openid' => $openid,
							
							'token' => $this->token 
					)
					 )->find ();
					
					if ($yyy ['iflottery'] == '1' && $exs == false) {
						
						$welog ['sncode'] = substr ( uniqid(), 6, 7 );
					}
					
					$welog ['content'] = $wallmessage;
					
					$welog ['uid'] = $yyy ['id'];
					
					$welog ['token'] = $this->token;
					
					$welog ['updatetime'] = time ();
					
					$welog ['ifsent'] = '0';
					
					$welog ['ifscheck'] = '0';
					
					if ($yyy ['ifcheck'] == '0') 

					{
						
						$welog ['ifcheck'] = '1';
					} 

					else 

					{
						
						$welog ['ifcheck'] = '0';
					}
					
					if ($exs == false) {
						
						$welog ['openid'] = $openid;
						
						M ( 'Wewalllog' )->add ( $welog );
						
						$sncode = $welog ['sncode'];
					} 
					else 
					{
						
						M ( 'Wewalllog' )->where ( array (
								
								'openid' => $openid,
								
								'token' => $this->token 
						)
						 )->save ( $welog );
						
						$sncode = $exs ['sncode'];
					}
					
					if ($yyy ['iflottery'] == '1') {
						
						return array (
								
								'上墙成功！获得sn号码为[' . $sncode . '],请留意抽奖环节哦',
								
								'text' 
						)
						;

						
					} 

					else {
						
						return array (
								
								'上墙成功！祝君万事如意',
								
								'text' 
						)
						;

						
					}
				
				case '摇一摇' :
					
					$yyy = M ( 'Shake' )->where ( array (
							
							'isopen' => '1',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					if ($yyy == false) {
						
						return array (
								
								'目前没有正在进行中的摇一摇活动',
								
								'text' 
						)
						;

						
					}
					
					if(!preg_match("/^13[0-9]{1}[0-9]{8}$|15[01235689]{1}[0-9]{8}$|18[6789]{1}[0-9]{8}$/",$yyyphone)){ return array( '拜托遵守规则好吗，请输入yyy加您的手机号码，例如yyy13647810523', 'text' ); }
					
					$url = C ( 'site_url' ) . U ( 'Wap/Toshake/index', array (
							
							'token' => $this->token,
							
							'phone' => $yyyphone,
							
							'wecha_id' => $this->data ['FromUserName'] 
					)
					 )

					;
					
					return array (
							
							'<a href="' . $url . '">点击进入刺激的现场摇一摇活动</a>',
							
							'text' 
					)
					;

					
				
				case '最近的' :
					
					$this->recordLastRequest ( $key );
					
					$user_request_model = M ( 'User_request' );
					
					$loctionInfo = $user_request_model->where ( array (
							
							'token' => $this->_get ( 'token' ),
							
							'msgtype' => 'location',
							
							'uid' => $this->data ['FromUserName'] 
					)
					 )

					->find ();
					
					if ($loctionInfo && intval ( $loctionInfo ['time'] > (time () - 60) )) {
						
						$latLng = explode ( ',', $loctionInfo ['keyword'] );
						
						return $this->map ( $latLng [1], $latLng [0] );
					}
					
					return array (
							
							'请发送您所在的位置',
							
							'text' 
					)
					;

					
					
					break;
				
				case '帮助' :
					
					return $this->help ();
					
					break;
				
				case '笑话' :
					
					return $this->xiaohua ();
					
					break;
				
				case '快递' :
					
					return $this->kuaidi ();
					
					break;
				
				case '公交' :
					
					return $this->gongjiao ();
					
					break;
				
				case '火车' :
					
					return $this->huoche ();
					
					break;
				
				case 'help' :
					
					return $this->help ();
					
					break;
				
				case '会员卡' :
					
					return $this->member ();
					
					break;
				
				case '身份证' :
					
					return $this->shenfenzheng ();
					
					break;
				
				case '会员' :
					
					return $this->member ();
					
					break;
				
				case '3g相册' :
					
					return $this->xiangce ();
					
					break;
				
				case '相册' :
					
					return $this->xiangce ();
					
					break;
				case 'wifi' :
				case 'Wifi' :
				
					return $this->wifi ();
					
					break;
				
				// case '留言':
				
				// return $this->liuyan();
				
				// break;
				case '婚庆喜帖':
				
                $url = C('site_url') . U('Wap/Wedding/index', array(
                    'token' => $this->token,
                    'wecha_id' => $this->data['FromUserName'],
                    'id' => $urlInfos[1]
                ));
				
                break;
				
				case '微喜帖' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Xitie',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					if ($pro ['apiurl'] == false) {
						
						$url = C ( 'site_url' ) . '/index.php?g=Wap&m=Xitie&a=index&token=' . $this->token . '&id=' . $xitie ['id'];
					} else {
						
						$url = $pro ['apiurl'];
					}
					
					if ($pro == false) {
						
						return array (
								
								'商家未开通微喜帖或未做回复配置，请稍后再试',
								
								'text' 
						)
						;

						
					}
					
					$xitie = M ( 'xitie' )->order ( 'id', 'DESC' )->limit ( "0,1" )->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											$url 
									)
									 
							)
							,
							
							'news' 
					)
					;

					
					
					break;
				
				case '商城':

					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Shop',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					if ($pro ['apiurl'] != false) {
					
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['picurl'],
												
												$pro ['apiurl'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
					
					} else {
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['picurl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Store&a=cats&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;
					}
					break;
				case '讨论社区':
				case '论坛':
					$fconfig=M('Forum_config')->where(array('token'=>$this->token))->find();
					return array(array(array($fconfig['forumname'],str_replace('&nbsp;','',strip_tags(htmlspecialchars_decode($fconfig['intro']))),$fconfig['picurl'],C('site_url').'/index.php?g=Wap&m=Forum&a=index&&token='.$this->token.'&wecha_id='.$this->data['FromUserName'])),'news');
					break;
				 case '2048':
					$pro = M('gamereply_info')->where(array(
						'token' => $this->token
					))->find();
					$url = C('site_url') . '/index.php?g=Wap&m=Game&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
					
					return array(
						array(
							array(
								$pro['title'],
								strip_tags(htmlspecialchars_decode($pro['info'])) ,
								$pro['picurl'],
								$url
							)
						) ,
						'news'
					);
					break;
						 case '2048加强版':
					$pro = M('gametreply_info')->where(array(
						'token' => $this->token
					))->find();
					$url = C('site_url') . '/index.php?g=Wap&m=Gamet&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
					
					return array(
						array(
							array(
								$pro['title'],
								strip_tags(htmlspecialchars_decode($pro['info'])) ,
								$pro['picurl'],
								$url
							)
						) ,
						'news'
					);
					break;
					 case 'fly2048':
					$pro = M('gamettreply_info')->where(array(
						'token' => $this->token
					))->find();
					$url = C('site_url') . '/index.php?g=Wap&m=Gamett&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
					
					return array(
						array(
							array(
								$pro['title'],
								strip_tags(htmlspecialchars_decode($pro['info'])) ,
								$pro['picurl'],
								$url
							)
						) ,
						'news'
					);
					break;
					case '吃粽子':

                    $pro = M('czzreply_info')->where(array(

                        'token' => $this->token

                    ))->find();

                    $url = C('site_url') . '/index.php?g=Wap&m=Czz&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';

                    

                    return array(

                        array(

                            array(

                                $pro['title'],

                                strip_tags(htmlspecialchars_decode($pro['info'])) ,

                                $pro['picurl'],

                                $url

                            )

                        ) ,

                        'news'

                    );

                    break;

					case '神经猫':

                    $pro = M('sjmreply_info')->where(array(

                        'token' => $this->token

                    ))->find();

                    $url = C('site_url') . '/index.php?g=Wap&m=Sjm&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';

                    

                    return array(

                        array(

                            array(

                                $pro['title'],

                                strip_tags(htmlspecialchars_decode($pro['info'])) ,

                                $pro['picurl'],

                                $url

                            )

                        ) ,

                        'news'

                    );

                    break;	
                case '微房产':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'Estate'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Estate&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                case '微教育':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jiaoyu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jiaoyu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                case '微婚庆':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'hunqing'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Hunqing&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                case '微政务':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'zhengwu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Zhengwu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
				case '微食品': 
				    $Estate = M('Estate')->where(array(
				         'token' => $this->token,'thetype' => 'shipin'
				     ))->find();
                     return array(
				        array(
				            array(
				                $Estate['title'],
				                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))), 
				                $Estate['cover'],
				                C ('site_url') . '/index.php?g=Wap&m=Shipin&a=index&&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'] . '&hid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
				            )
				        ),
				        'news'
				    );
                    break;
                case '微物业':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'wuye'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Wuye&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                    
                case '微美容':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'meirong'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Meirong&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 case '微旅游':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'lvyou'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Lvyou&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 case '微健身':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jianshen'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jianshen&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 
                 case '微KTV':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'ktv'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Ktv&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                    
                case '微酒吧':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'jiuba'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Jiuba&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                 
                 case '微装修':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'zhuangxiu'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                                C ( 'site_url' ) . '/index.php?g=Wap&m=Zhuangxiu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
                  case '微花店':
                    $Estate = M('Estate')->where(array(
                        'token' => $this->token,'thetype' => 'huadian'
                    ))->find();
                    return array(
                        array(
                            array(
                                $Estate['title'],
                                str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))),
                                $Estate['cover'],
                               C ( 'site_url' ) . '/index.php?g=Wap&m=Huadian&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
                    break;
					
				case '全景': 
				
				$pro = M('reply_info')->where(array('infotype' => 'panorama', 'token' => $this->token))->find();
				
					if ($pro)
					{
						return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], C('site_url') . '/index.php?g=Wap&m=Panorama&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com')), 'news');
					}
					else
					{
						return array(array(array('360°全景看车看房', '通过该功能可以实现3D全景看车看房', rtrim(C('site_url'), '/') . '/tpl/User/default/common/images/panorama/360view.jpg', C('site_url') . '/index.php?g=Wap&m=Panorama&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com')), 'news');
					}
					
					break;
				
				case '留言' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'message',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Reply&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;

					
					
					break;
				
				case '预约' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Yuyue',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Yuyue&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;

					
					
					break;
								
				case '订餐' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Dining',
							
							'token' => $this->token 
					)
					 )

					->find ();
					if ($pro ['apiurl'] != false) {
					
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['picurl'],
												
												$pro ['apiurl'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
					
					} else {
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Dining&a=index&dining=1&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
						)
						;
					}
					break;
				case '点餐' :
					
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Repast',
							
							'token' => $this->token 
					)
					 )

					->find ();
					if ($pro ['apiurl'] != false) {
					
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['picurl'],
												
												$pro ['apiurl'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
					
					} else {
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Repast&a=index&dining=1&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
						)
						;
					}
					break;
				case '团购':
					$pro = M ( 'reply_info' )->where ( array (
							
							'infotype' => 'Groupon',
							
							'token' => $this->token 
					)
					 )

					->find ();
					
					return array (
							
							array (
									
									array (
											
											$pro ['title'],
											
											strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
											
											$pro ['picurl'],
											
											C ( 'site_url' ) . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
									)
									 
							)
							,
							
							'news' 
					)
					;		
					break;
				case '微商盟': $pro = M('fenlei_reply') -> where(array( 'token' => $this -> token)) -> find();

                $url = C('site_url') . '/index.php?g=Wap&m=Fenlei&a=index&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'] . '&sgssz=mp.weixin.qq.com';             

                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['tp'], $url)), 'news');

                break;
				case 'p': 
				$pass = rand(1000, 9999);
				$aucode['authcode'] = $pass;
				$aucode['token'] = $this->token;
				$codeModel = M('ap_authcode');
				$codeModel->add($aucode);
				return array($pass, 'text');
				break;

				case '密码':
				$pass = rand(1000, 9999);
				$aucode['authcode'] = $pass;
				$aucode['token'] = $this->token;
				$codeModel = M('ap_authcode');
				$codeModel->add($aucode);
				return array($pass, 'text');
				break;
				
				default :
					
					$check = $this->user ( 'diynum', $key );
					
					if ($check ['diynum'] != 1) {
						
						return array (
								
								C ( 'connectout' ),
								
								'text' 
						);
					} else {
						
						if($key!=""&&$key!=null)
						{
							return $this->keyword ( $key );
						}
					}
			}
		}
	}
	function xiangce() 
	{
		$photo = M ( 'Photo' )->where ( array (
				
				'token' => $this->token,
				
				'status' => 1
				)
		 )

		->find ();
		
		$data ['title'] = $photo ['title'];
		
		$data ['keyword'] = $photo ['info'];
		
		$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Photo/index', array (
				
				'token' => $this->token,
				
				'wecha_id' => $this->data ['FromUserName'] 
				)
		 );
		
		$data ['picurl'] = $photo ['picurl'] ? $photo ['picurl'] : rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/yj.jpg';
		
		return array (
				
				array (
						
						array (
								
								$data ['title'],
								
								$data ['keyword'],
								
								$data ['picurl'],
								
								$data ['url'] 
						)
						 
				),
				'news' 
		);
	}
	function companyMap() 
	{
		import ( "Home.Action.MapAction" );
		
		$mapAction = new MapAction ();
		
		return $mapAction->staticCompanyMap ();
	}
	function shenhe($name) 
	{
		$name = implode ( '', $name );
		
		if (empty ( $name )) {
			
			return '正确的审核帐号方式是：审核+帐号';
		} else {
			
			$user = M ( 'Users' )->field ( 'id' )->where ( array (
					
					'username' => $name 
			)
			 )

			->find ();
			
			if ($user == false) {
				
				return '主人' . $this->my . "提醒您,您还没注册吧\n正确的审核帐号方式是：审核+帐号,不含+号\n您的账号也可能尚未通过审核，请拨打13705081923联系技术代表";
			} else {
				
				$up = M ( 'users' )->where ( array (
						
						'id' => $user ['id'] 
				)
				 )

				->save ( array (
						
						'status' => 1,
						
						'viptime' => strtotime ( "+1 day" ) 
				)
				 )

				;
				
				if ($up != false) {
					
					return '主人' . $this->my . '恭喜您,您的帐号已经审核,您现在可以登陆老杨平台使用最强的功能啦!';
				} else {
					
					return '服务器繁忙请稍后再试';
				}
			}
		}
	}
	function huiyuanka($name) 
	{
		return $this->member ();
	}

	function member()
	{
		$card = M ( 'member_card_create' )->where ( array (
				
				'token' => $this->token,
				
				'wecha_id' => $this->data ['FromUserName'] 
		)
		 )->find ();
		
		$cardInfo = M ( 'member_card_set' )->where ( array (
				
				'token' => $this->token 
		)
		 )->find ();
		
		// $this->behaviordata ( 'Member_card_set', $cardInfo ['id'] );
		
		$reply_info_db = M ( 'Reply_info' );
		
		if ($card == false) {
			
			$where_member = array (
					
					'token' => $this->token,
					
					'infotype' => 'membercard' 
			)
			;
			
			$memberConfig = $reply_info_db->where ( $where_member )->find ();
			
			if (! $memberConfig) {
				
				$memberConfig = array ();
				
				$memberConfig ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/member.jpg';
				
				$memberConfig ['title'] = '会员卡,省钱，打折,促销，优先知道,有奖励哦';
				
				$memberConfig ['info'] = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦';
			}
			
			$data ['picurl'] = $memberConfig ['picurl'];
			
			$data ['title'] = $memberConfig ['title'];
			
			$data ['keyword'] = $memberConfig ['info'];
			
			if (! $memberConfig ['apiurl']) {
				
				$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/index', array (
						
						'token' => $this->token,
						
						'wecha_id' => $this->data ['FromUserName'] 
				)
				 );
			} else {
				
				$data ['url'] = str_replace ( '{wechat_id}', $this->data ['FromUserName'], $memberConfig ['apiurl'] );
			}
		} else {
			
			$where_unmember = array (
					
					'token' => $this->token,
					
					'infotype' => 'membercard_nouse' 
			)
			;
			
			$unmemberConfig = $reply_info_db->where ( $where_unmember )->find ();
			
			if (! $unmemberConfig) {
				
				$unmemberConfig = array ();
				
				$unmemberConfig ['picurl'] = rtrim ( C ( 'site_url' ), '/' ) . '/tpl/static/images/vip.jpg';
				
				$unmemberConfig ['title'] = '申请成为会员';
				
				$unmemberConfig ['info'] = '申请成为会员，享受更多优惠';
			}
			
			$data ['picurl'] = $unmemberConfig ['picurl'];
			
			$data ['title'] = $unmemberConfig ['title'];
			
			$data ['keyword'] = $unmemberConfig ['info'];
			
			if (! $unmemberConfig ['apiurl']) {
				
				$data ['url'] = rtrim ( C ( 'site_url' ), '/' ) . U ( 'Wap/Card/index', array (
						
						'token' => $this->token,
						
						'wecha_id' => $this->data ['FromUserName'] 
				)
				 );
			} else {
				
				$data ['url'] = str_replace ( '{wechat_id}', $this->data ['FromUserName'], $unmemberConfig ['apiurl'] );
			}
		}
		
		return array (
				
				array (
						
						array (
								
								$data ['title'],
								
								$data ['keyword'],
								
								$data ['picurl'],
								
								$data ['url']
								)
						),				
				'news'
				);
	}
		private function postJson($url, $jsonData)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	private function rippleos_auth_url($node)
	{
		$this->rptk_err_msg = array("数据库错误", "请求格式错误", "参数不完整", "参数类型错误", "服务器错误", "节点不存在", "认证API ID或KEY错误", "不存在对应的OPENID");
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $this->data["FromUserName"]);
		return json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/get_auth_url", json_encode($date)), true);
	}

	private function rippleos_auth_token($node)
	{
		$this->rptk_err_msg = array("数据库错误", "请求格式错误", "参数不完整", "参数类型错误", "服务器错误", "节点不存在", "认证API ID或KEY错误", "不存在对应的OPENID");
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $this->data["FromUserName"]);
		return json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/get_auth_token", json_encode($date)), true);
	}

	private function rippleos_unauth($node)
	{
		$date = array("api_id" => c("rptk_wx_auth_api_id"), "api_key" => c("rptk_wx_auth_api_key"), "node" => intval($node), "openid" => $this->data["FromUserName"]);
		$ret = json_decode($this->postJson("http://wx.rippletek.com/Portal/Wx/unauth_user", json_encode($date)), true);
		return NULL;
	}
	function keyword($key) 
	{
		$like ['keyword'] = array (
				
				'like',
				
				'%' . $key . '%' 
		);
		$like ['token'] = $this->token;
		$wifi ['keyword'] = $key;
		$wifi ['token'] = $this->token;
		$node = d("Wifi_keyword")->where($wifi)->order("id desc")->find();
		if($node!=false)
		{
			$ret_json = $this->rippleos_auth_url($node["node"]);
			$ret_code = $this->rippleos_auth_token($node["node"]);
			if (is_array($node) && ($ret_json["status"] === 0)) {
				if (($node["rztype"] == 0) && ($node["rz_id"] == 1)) {
					$url = $ret_json["auth_url"];
				}
				else {
					$url = c("site_url") . "/index.php?g=Home&m=Index&a=wifi&id=" . $node["id"] . "&wecha_id=" . $this->data["FromUserName"];
				}

				return array(
							array(
								array($node["title"], strip_tags(htmlspecialchars_decode("本机上网直接点击,<br />如果其他机器使用请在设备登陆界面输入验证码:" . $ret_code["auth_token"])), $node["wx_pic"], $url)
								),
							"news"
							);
			}
			else {
				return array("配置出问题了，appId=" . c("rptk_wx_auth_api_id") . ";____appKey=" . c("rptk_wx_auth_api_key") . ";____nodeId=" . $node["name"] . ";___openId=" . $this->data["FromUserName"] . $node["name"], "text");
			}
		}
		$data = M ( 'kefuonline' )->where ( $like )->order ( 'id desc' )->find ();
		if($data!=false)
		{
			$img = M ( 'kefuonline' )->field ( 'id,text,picurl,info,title,info2' )->limit ( 1 )->order ( 'id desc' )->where ($like) ->select ();
					
			$weburl = $img[0] ['info2'];
			
			if($weburl)
			{
				$return [] = array (
							
							$img[0] ['title'],
							
							$img[0] ['text'],
							
							$img[0] ['picurl'],
							
							$weburl 
					);
				return array (
						
					$return,
					'news' 
				);
			}
			else
			{
				return array(
				
					'客服代码不正确！',
					
					'text'
				);
			}
		}
		 else
		{
			$like ['keyword'] = array (
					
					'like',
					
					'%' . $key . '%' 
			);
			$like ['token'] = $this->token;
			
			$data = M ( 'keyword' )->where ( $like )->order ( 'id desc' )->find ();
			
			if ($data != false) 
			{
				
				switch ($data ['module']) 
				{
					
					            case 'Img':
                $this->requestdata('imgnum');
                $img_db = M($data['module']);
                //修改以sort来排序
                $like['pic'] = array('neq', '');
                $back = $img_db->field('id,text,pic,url,title')->limit(9)->order('usort desc,id DESC')->where($like)->select();
                if ($back == false) {
                    return array(('‘' . $data['keyword']) . '’无此图文信息或图片,请提醒商家，重新设定关键词', 'text');
                }
                $idsWhere = 'id in (';
                $comma = '';
                foreach ($back as $keya => $infot) {
                    $idsWhere .= $comma . $infot['id'];
                    $comma = ',';
                    if ($infot['url'] != false) {
                        if (!(strpos($infot['url'], 'http') === FALSE)) {
                            $url = $this->getFuncLink(html_entity_decode($infot['url']));
                        } else {
                            $url = $this->getFuncLink($infot['url']);
                        }
                    } else {
                        $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
                    }
                    $return[] = array($infot['title'], $this->handleIntro($infot['text']), $infot['pic'], $url);
                }
                $idsWhere .= ')';
                if ($back) {
                    $img_db->where($idsWhere)->setInc('click');
                }
                return array($return, 'news');
                break;
					case 'Wall': $thisItem = M('Wall') -> where(array('id' => $data['pid'])) -> find();
						if (!$thisItem['isopen']){
							return array('微信墙活动已关闭', 'text');
						}else{
							$memberRecord = M('Wall_member') -> where(array('wallid' => $data['pid'], 'wecha_id' => $this -> data['FromUserName'])) -> find();
							if (!$memberRecord || !$this -> fans){
								return array('<a href="' . C('site_url') . U('Wap/Userinfo/index', array('token' => $this -> token, 'wecha_id' => $this -> data['FromUserName'], 'redirect' => 'Wall/person|id:' . intval($data['pid']))) . '">请点击这里完善信息后再参加此活动</a>', 'text');
							}else{
								M('Userinfo') -> where(array('token' => $this -> token, 'wecha_id' => $this -> data['FromUserName'])) -> save(array('wallopen' => 1));
								S('fans_' . $this -> token . '_' . $this -> data['FromUserName'], NULL);
								return array('您已进入微信墙对话模式，您下面发送的所有文字和图片信息都将会显示在大屏幕上，如需退出微信墙模式，请输入“wx#quit”', 'text');
							}
						}
					break;
					case 'Host' :
						
						$this->requestdata ( 'other' );
						
						$host = M ( 'Host' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$host ['name'],
												
												$host ['info'],
												
												$host ['ppicurl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&rid=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					case 'Carowner' :
						
						$this->requestdata ( 'other' );
						
						$host = M ( 'Carowner' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$host ['title'],
												
												$host ['info'],
												
												$host ['head_url'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Car&a=owner&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&rid=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					case 'Text':
                $this->requestdata('textnum');
                $info = M($data['module'])->order('id desc')->find($data['pid']);
                return array(htmlspecialchars_decode(str_replace('{wechat_id}', $this->data['FromUserName'], $info['text'])), 'text');
                break;
						
				case 'Invites':
					$this->requestdata('other');
					$info = M('Invites')->where(array('id' => $data['pid']))->find();
					if ($info == false) {
						return array('商家未做邀请回复配置，请稍后再试', 'text');
					}
					return array(array(array($info['title'], $this->handleIntro($info['brief']), $info['picurl'], C('site_url') . U('Wap/Invites/index', array('token' => $this->token, 'id' => $info['id'])))), 'news');
					break;
					
					case 'Product' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'Product' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['name'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['intro'] ) ),
												
												$pro ['logourl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Product&a=product&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
					case 'Vote' :
						
						$this->requestdata ( 'other' );
						
						$Vote = M ( 'Vote' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$Vote ['title'],
												
												str_replace ( '&nbsp;', ' ', strip_tags ( htmlspecialchars_decode ( $Vote ['info'] ) ) ),
												
												$Vote ['picurl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Vote&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
					case 'Xitie' :
						
						$this->requestdata ( 'other' );
						
						$info = M ( 'Xitie' )->find ( $data ['pid'] );
						
						if ($info == false) {
							
							return array (
									
									'商家未做微喜帖回复配置，请稍后再试',
									
									'text' 
							)
							;

							
						}
						
						$id = $info ['id'];
						
						$picurl = $info ['replypicurl'];
						
						$title = $info ['title'];
						
						$info = $info ['hua'];
						
						$url = C ( 'site_url' ) . U ( 'Wap/Wedding/index', array (
								
								'token' => $this->token,
								
								'id' => $id 
						)
						 )

						;
						
						return array (
								
								array (
										
										array (
												
												$title,
												
												$info,
												
												$picurl,
												
												$url 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
						case 'Wedding' :
						 $this->requestdata('other');
						$wedding = M('Wedding')->where(array(
							'id' => $data['pid']
						))->find();
						return array(
							array(
								array(
									$wedding['title'],
									strip_tags(htmlspecialchars_decode($wedding['word'])),
									$wedding['coverurl'],
									C('site_url') . '/index.php?g=Wap&m=Wedding&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
								),
								array(
									'查看我的祝福',
									strip_tags(htmlspecialchars_decode($wedding['word'])),
									$wedding['picurl'],
									C('site_url') . '/index.php?g=Wap&m=Wedding&a=check&type=2&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
								),
								array(
									'查看我的来宾',
									strip_tags(htmlspecialchars_decode($wedding['word'])),
									$wedding['picurl'],
									C('site_url') . '/index.php?g=Wap&m=Wedding&a=check&type=1&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $data['pid'] . '&sgssz=mp.weixin.qq.com'
								)
							),
							'news'
						);
						break;	
							return array (
										
									array (
												
											array (
														
													$title,
														
													$info,
														
													$picurl,
														
													$url
											)
						
									)
									,
										
									'news'
							)
							;
						
							break;
						
					case 'Reservation' :
						
						$this->requestdata ( 'other' );
						
						$rt = M ( 'Reservation' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$rt ['title'],
												
												$rt ['info'],
												
												$rt ['picurl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Reservation&a=index&rid=' . $data ['pid'] . '&token=' . $this->token . '&addtype=' . $rt ['addtype'] . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com' 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					case 'Sign':
					$thisItem = M('Sign_set')->where(array('id' => $data['pid']))->find();
					return array(array(array($thisItem['title'], $thisItem['content'], $thisItem['reply_img'], C('site_url'). U('Wap/Fanssign/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'])))), 'news');
					break;
					case 'Xitienew' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'Xitienew' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['message'] ) ),
												
												$pro ['pic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Xitienew&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
						
					case 'Vote': $this -> requestdata('other');
                    $Vote = M('Vote') -> where(array('id' => $data['pid'])) -> order('id DESC') -> find();
                    return array(array(array($Vote['title'], '', $Vote['picurl'], $this -> siteUrl . '/index.php?g=Wap&m=Vote&a=index&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'] . '&id=' . $data['pid'] . '')), 'news');
                    break;
					
					case 'Yiliao' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'yuyue' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['topic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Yiliao&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
					case 'Yuyue' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'yuyue' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['topic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Yuyue&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
					            case 'Jingcai': $set_info =  M("jingcai_set")->where(array('token'=>$this->token))->find();
                   if(!$set_info || !$set_info['status']){
                        return array(
                        '商家还未开启微竞猜服务',
                        'text'

                         );
                   }
                    return array(
                     array(
                            array(
                                $set_info['title'],

                               $set_info['info'],

                                $set_info['cover'],


                                C('site_url') . '/index.php?g=Wap&m=Jingcai&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&id=' . $set_info['pid']

                            )

                        ),

                        'news'

                    );
                    break;
					
					case 'Live' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'live' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['name'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['intro'] ) ),
												
												$pro ['open_pic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Live&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;

						break;
					
					case 'Jiejing':

                    $this->requestdata('other');

                    $Jiejing = M('Jiejing')->where(array(

                        'token' => $data['token']

                    ))->find();


					$url ='http://apis.map.qq.com/uri/v1/streetview?pano='. $Jiejing['pano'].'&heading=30&pitch=10';

                    return array(

                        array(

                            array(

                                $Jiejing['title'],

                                $Jiejing['text'],

                                C('site_url') .$Jiejing['picurl'],

								$url,

                                

                            )

                        ) ,

                        'news'

                    );

                    break;
					
					case 'Jiudian' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'yuyue' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['topic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Jiudian&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
					case 'Canting' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'yuyue' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['topic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Canting&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
					case 'Diaoyan' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'diaoyan' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['sinfo'] ) ),
												
												$pro ['pic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Diaoyan&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
					case 'Zhongchou' :
						
						return array(
							'本活动仅通过朋友圈方式参与！',
							'text'
						);
						break;
					case 'Heka' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'heka' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['sinfo'] ) ),
												
												$pro ['topic'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Heka&a=index&id=&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
						case 'Greeting_card' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'Greeting_card' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['title'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['info'] ) ),
												
												$pro ['picurl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Greeting_card&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
					
        case 'Paper': $this -> requestdata('other');
            $Paper = M('Paper') -> where(array('id' => $data['pid'])) -> find();
            return array(array(array($Paper['title'], strip_tags(htmlspecialchars_decode($Paper['title'])) , $Paper['pic'], $this -> siteUrl . '/index.php?g=Wap&m=Paper&a=item&token=' . $this -> token . '&wecha_id=' . $this -> data['FromUserName'] . '&id=' . $data['pid'] . '')), 'news');
            break;
					case 'Selfform' :
						
						$this->requestdata ( 'other' );
						
						$pro = M ( 'Selfform' )->where ( array (
								
								'id' => $data ['pid'] 
						)
						 )

						->find ();
						
						return array (
								
								array (
										
										array (
												
												$pro ['name'],
												
												strip_tags ( htmlspecialchars_decode ( $pro ['intro'] ) ),
												
												$pro ['logourl'],
												
												C ( 'site_url' ) . '/index.php?g=Wap&m=Selfform&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&id=' . $data ['pid'] 
										)
										 
								)
								,
								
								'news' 
						)
						;
						break;
					
					 case 'Estate':
						return $this->estate();
					 case 'Jiaoyu':
						return $this->jiaoyu();
					 case 'Hunqing':
						return $this->hunqing();
					 case 'Zhengwu':
						return $this->zhengwu();
					 case 'Wuye':
						return $this->wuye();
					 case 'Meirong':
						return $this->meirong();
					 case 'Lvyou':
						return $this->Lvyou();
					 case 'Jianshen':
						return $this->jianshen();
					 case 'Ktv':
						return $this->ktv();
					 case 'Jiuba':
						return $this->jiuba();
					 case 'Zhuangxiu':
						return $this->zhuangxiu();
					 case 'Huadian':
						return $this->huadian();
					case 'Multi': 
	                      $multiImgClass=new multiImgNews(
		                  $this->token,
		                  $this->data['FromUserName'],
		                  $this->siteUrl
	    );
                return $multiImgClass->news($data['pid']
	    );
                break;
					case 'Market':
					$thisItem = M('Market')->where(array('market_id' => $data['pid']))->find();
					return array(array(array($thisItem['title'], $thisItem['address'], $thisItem['logo_pic'], C('site_url').U('Wap/Market/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'])))), 'news');
					 case 'Lottery' :
						
						$this->requestdata ( 'other' );
						
						$info = M ( 'Lottery' )->find ( $data ['pid'] );
						
						if ($info == false || $info ['status'] == 3) {
							
							return array (
									
									'活动可能已经结束或者被删除了',
									
									'text' 
							)
							;

							
						}
					switch($info['type']){
					case 1:
					$model='Lottery';
					break;
					case 2:
					$model='Guajiang';
					break;
					case 3:
					$model='Coupon';
					break;
					case 4:
					$model='LuckyFruit';
					break;
					case 5:
					$model='GoldenEgg';
					break;
					case 7: $model = 'AppleGame';
                    break;
                    case 8: $model = 'Lovers';
                    break;
						}
						
						$id = $info ['id'];
						
						$type = $info ['type'];
						
						if ($info ['status'] == 1) {
							
							$picurl = $info ['starpicurl'];
							
							$title = $info ['title'];
							
							$id = $info ['id'];
							
							$info = $info ['info'];
						} else {
							
							$picurl = $info ['endpicurl'];
							
							$title = $info ['endtite'];
							
							$info = $info ['endinfo'];
						}
						
						$url = C ( 'site_url' ) . U ( 'Wap/' . $model . '/index', array (
								
								'token' => $this->token,
								
								'type' => $type,
								
								'wecha_id' => $this->data ['FromUserName'],
								
								'id' => $id,
								
								'type' => $type 
						)
						 )

						;
						
						return array (
								
								array (
										
										array (
												
												$title,
												
												$info,
												
												$picurl,
												
												$url 
										)
										 
								)
								,
								
								'news' 
						)
						;
					case 'Carset': $this->requestdata('other');
					$thisItem = M('Carset')->where(array('id' => $data['pid']))->find();
					$news = array();
					array_push($news, array($thisItem['title'], '', $thisItem['head_url'], $thisItem['url']?$thisItem['url']:C('site_url') . '/index.php?g=Wap&m=Car&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title1'], '', $thisItem['head_url_1'], $thisItem['url1']?$thisItem['url1']:C('site_url') . '/index.php?g=Wap&m=Car&a=brands&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title2'], '', $thisItem['head_url_2'], $thisItem['url2']?$thisItem['url2']:C('site_url') . '/index.php?g=Wap&m=Car&a=salers&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title3'], '', $thisItem['head_url_3'], $thisItem['url3']?$thisItem['url3']:C('site_url') . '/index.php?g=Wap&m=Car&a=CarReserveBook&addtype=drive&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title4'], '', $thisItem['head_url_4'], $thisItem['url4']?$thisItem['url4']:C('site_url') . '/index.php?g=Wap&m=Car&a=owner&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title5'], '', $thisItem['head_url_5'], $thisItem['url5']?$thisItem['url5']:C('site_url') . '/index.php?g=Wap&m=Car&a=tool&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					array_push($news, array($thisItem['title6'], '', $thisItem['head_url_6'], $thisItem['url6']?$thisItem['url6']:C('site_url') . '/index.php?g=Wap&m=Car&a=showcar&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName']));
					return array($news, 'news');
					break;
					default :
						
						$this->requestdata ( 'videonum' );
						
						$info = M ( $data ['module'] )->order ( 'id desc' )->find ( $data ['pid'] );
						
						return array (
								
								array (
										
										$info ['title'],
										
										$info ['keyword'],
										
										$info ['musicurl'],
										
										$info ['hqmusicurl']
										),
								'music' 
								);
				}
			}
			else
			{
				$chaFfunction = M('Function')->where(array('funname' => 'liaotian'))->find();
				if (!strpos($this->fun, 'liaotian') || !$chaFfunction['status'])
				{
					$other = M('Other')->where(array('token' => $this->token))->find();
					if ($other == false)
					{
						return array('回复帮助，可了解所有功能', 'text');
					}
					else
					{
						if (empty($other['keyword']))
						{
							return array($other['info'], 'text');
						}
						else
						{
							$img = M('Img')->field('id,text,pic,url,title')->limit(5)->order('sortid desc')->where(array('token' => $this->token, 'keyword' => array('like', '%' . $other['keyword'] . '%')))->select();
							if ($img == false)
							{
								return array('无此图文信息,请提醒商家，重新设定关键词', 'text');
							}
								
							foreach($img as $keya => $infot)
							{
								if ($infot['url'] != false)
								{
									if (!(strpos($infot['url'], 'http') === false))
									{
										$url = $this->getFuncLink(html_entity_decode($infot['url']));
									}
									else
									{
										$url = $this->getFuncLink($infot['url']);
									}
								}
								else
								{
									$url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
								}
								$return[] = array($infot['title'], $infot['text'], $infot['pic'], $url);
							}
							return array($return, 'news');
						}
					}
				}
			$this->selectService();
			return array($this->chat($key), 'text');
			}
		}
	}
	function taobao($name)
	{
		$name = array_merge($name);
		$data = M('Taobao')->where(array('token' => $this->token))->find();
		if ($data != false)
		{
			if (strpos($data['keyword'], $name))
			{
				$url = $data['homeurl'] . '/search.htm?search=y&keyword=' . $name . '&lowPrice=&highPrice=';
			}
			else
			{
				$url = $data['homeurl'];
			}
			return array(array(array($data['title'], $data['keyword'], $data['picurl'], $url)), 'news');
		}
		else
		{
			return '商家还未及时更新淘宝店铺的信息,回复帮助,查看功能详情';
		}
	}
	function choujiang($name)
	{
		$data = M('lottery')->field('id,keyword,info,title,starpicurl')->where(array('token' => $this->token, 'status' => 1, 'type' => 1))->order('id desc')->find();
		if ($data == false)
		{
			return array('暂无抽奖活动', 'text');
		}
		$pic = $data['starpicurl']?$data['starpicurl']:rtrim(C('site_url'), '/') . '/tpl/User/default/common/images/img/activity-lottery-start.jpg';
		$url = rtrim(C('site_url'), '/') . U('Wap/Lottery/index', array('type' => 1, 'token' => $this->token, 'id' => $data['id'], 'wecha_id' => $this->data['FromUserName']));
		return array(array(array($data['title'], $data['info'], $pic, $url)), 'news');
	}
	function home()
	{
		return $this->shouye();
	}
	function shouye($name) 
	{
		$home = M ( 'Home' )->where ( array (
				
				'token' => $this->token 
		)
		 )

		->find ();
		
		if ($home == false) {
			
			return array (
					
					'商家未做微官网配置',
					
					'text' 
			)
			;

			
		} else {
			
			if ($home ['apiurl'] == false) {
				
				$url = rtrim ( C ( 'site_url' ), '/' ) . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] . '&sgssz=mp.weixin.qq.com';
			} else {
				
				$url = $home ['apiurl'];
			}
		}
		
		return array (
				
				array (
						
						array (
								
								$home ['title'],
								
								$home ['info'],
								
								$home ['picurl'],
								
								$url 
						)
						 
				)
				,
				
				'news' 
		)
		;
	}
	function nokeywordApi(){
    if(!(strpos($this -> fun, 'api') === FALSE)){
        $apiwhere = array('token' => $this -> token, 'status' => 1, 'noanwser' => 1);
        $apiwhere['noanswer'] = array('gt', 0);
        $api = M('Api') -> where($apiwhere) -> find();
        if($api != false){
            $vo['fromUsername'] = $this -> data['FromUserName'];
            $vo['Content'] = $this -> data['Content'];
            if (intval($api['is_colation'])){
                $vo['Content'] = trim(str_replace($api['keyword'], '', $this -> data['Content']));
            }
            $vo['toUsername'] = $this -> token;
            $api['url'] = $this -> getApiUrl($api['url'], $api['apitoken']);
            if($api['type'] == 2){
                $apidata = $this -> api_notice_increment($api['url'], $vo, 0);
                return array($apidata, 'text');
            }else{
                $xml = file_get_contents("php://input");
                if (intval($api['is_colation'])){
                    $xml = str_replace(array($api['keyword'], $api['keyword'] . ' '), '', $xml);
                }
                $apidata = $this -> api_notice_increment($api['url'], $xml, 0);
                if ($apidata != 'false'){
                    header("Content-type: text/xml");
                    exit($apidata);
                    return false;
                }
            }
        }
    }
}
    function getApiUrl($url, $token){
    $timestamp = time();
    $nonce = $_GET["nonce"];
    $tmpArr = array($token, $timestamp, $nonce);
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode($tmpArr);
    $signature = sha1($tmpStr);
    if (strpos($url, '?')){
        $url = $url . '&fromthirdapi=1&signature=' . $signature . '&timestamp=' . $timestamp . '&nonce=' . $nonce . '&apitoken=' . $this -> token;
    }else{
        $url = $url . '?fromthirdapi=1&signature=' . $signature . '&timestamp=' . $timestamp . '&nonce=' . $nonce . '&apitoken=' . $this -> token;
    }
    return $url;
}
	function estate($name)
    {
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微房产模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Estate&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function jiaoyu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jiaoyu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微教育模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jiaoyu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function hunqing($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'hunqing'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微婚庆模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Hunqing&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function zhengwu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'zhengwu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置政务模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Zhengwu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function wuye($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'wuye'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置物业模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Wuye&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function meirong($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'meirong'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微美容模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Meirong&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function lvyou($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'lvyou'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微旅游模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Lvyou&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function jianshen($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jianshen'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微健身模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jianshen&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function ktv($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'ktv'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微KTV模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Ktv&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function jiuba($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'jiuba'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微酒吧模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Jiuba&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
    function zhuangxiu($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'zhuangxiu'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微装修模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Zhuangxiu&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
	function dianying($name){
		$back = M('Dianying') -> field('id,picurl,title,name') -> where(array('token' => $this -> token)) -> find();
		if($back){
			$url = rtrim(C('site_url'), '/') . U('Wap/Dianying/index', array('token' => $this -> token, 'id' => $back['id'], 'wecha_id' => $this -> data['FromUserName'], 'laoyang' => 'mp.weixin.qq.com'));
			if(stristr($back['picurl'], "http:")) $purl = $back['picurl'];
			else $purl = rtrim(C('site_url'), '/') . $back['picurl'];
			$return[] = array($back['title'], $back['info'], $purl, $url);
			return array($return, 'news');
		}else return array('没有设置微电影模块，请稍后再试', 'text');
	}

    function huadian($name)
    {
    	
    	$theuid = M('wxuser')->where(array('token' => $this->token))->find();
       	if ($theuid != false) {
            $agentdomain = M('users')->where(array('id' => $theuid['uid']))->find();
            if ($agentdomain['agentdomain'] != '' ) 
            $theagentdomain = $agentdomain['agentdomain'];
            else
            $theagentdomain = C('site_url');
            }
        $Estate = M('Estate')->where(array(
            'token' => $this->token,'thetype' => 'huadian'
        ))->find();
        if ($Estate == false) {
            return array(
                '商家未配置微花店模块',
                'text'
            );
        } else {
            $imgurl = $Estate['cover'];
                    $url = $theagentdomain . '/cms/index.php?token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com';
        }
        return array(
            array(
                array(
                    $Estate['title'],
                    strip_tags(htmlspecialchars_decode($Estate['estate_desc'])),
                    $imgurl,
                    $theagentdomain . '/index.php?g=Wap&m=Huadian&a=index&&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $Estate['id'] . '&sgssz=mp.weixin.qq.com'
                )
            ),
            'news'
        );
    }
	function kuaidi($data)
	{
       $data = array_merge($data);
        $dt = '';
        $dnum = '';
        if (!(strpos($data[0], '申通') === FALSE)) {
            $dt = 'shentong';
        } else {
            if (!(strpos($data[0], '圆通') === FALSE)) {
                $dt = 'yuantong';
            } else {
                if (!(strpos($data[0], '顺丰') === FALSE)) {
                    $dt = 'shunfeng';
                } else {
                    if (!(strpos($data[0], 'ems') === FALSE)) {
                        $dt = 'ems';
                    } else {
                        if (!(strpos($data[0], 'EMS') === FALSE)) {
                            $dt = 'ems';
                        } else {
                            if (!(strpos($data[0], '中通') === FALSE)) {
                                $dt = 'zhongtong';
                            } else {
                                if (!(strpos($data[0], '增益') === FALSE)) {
                                    $dt = 'zengyisudi';
                                } else {
                                    if (!(strpos($data[0], '天天') === FALSE)) {
                                        $dt = 'tiantian';
                                    } else {
                                        if (!(strpos($data[0], '全峰') === FALSE)) {
                                            $dt = 'quanfengkuaidi';
                                        } else {
                                            if (!(strpos($data[0], '德邦') === FALSE)) {
                                                $dt = 'debangwuliu';
                                            } else {
                                                if (!(strpos($data[0], '宅急送') === FALSE)) {
                                                    $dt = 'zhaijisong';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $len = strlen($data[1]);
        $dall = $data[1];
        for ($i = 0; $i < $len; $i++) {
            if (eregi('^[0-9]+$', $dall[$i])) {
                $dnum .= $dall[$i];
            }
        }
        if ($dt == '') {
            return '快递名称错误，请按照【快递+快递名称+快递号】的格式填写，例如： 快递申通201545875';
        } else {
            if ($dnum == '') {
                return '快递单号未填写，请按照【快递+快递名称+快递号】的格式填写，例如： 快递申通201545875';
            } else {
                $str = "http://www.kuaidi100.com/query?type={$dt}&postid={$dnum}";
                $json = json_decode(file_get_contents($str));
                if ($json->message == 'ok') {
                    $kd = '';
                    $kdlen = count($json->data);
                    for ($i = 0; $i < $kdlen; $i++) {
                        $newkd = '';
                        $newkd .= $json->data[$i]->time . '';
                        $newkd .= $json->data[$i]->context;
                        if ($i != 0) {
                            $newkd .= '';
                        }
                        $kd = $newkd . $kd;
                    }
                    return $kd;
                } else {
                    return '快递单号错误。';
                }
            }
        }
	}
	function langdu($data)
	{
        $data = implode('', $data);
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . urlencode($data);
        return array(array($data, '点听收听', $mp3url, $mp3url), 'music');
	}
	function jiankang($data)
	{
		if (empty($data))return '主人，' . $this->my . "提醒您\n正确的查询方式是:\n健康+身高,+体重\n例如：健康170,65";
		$height = $data[1] / 100;
		$weight = $data[2];
		$Broca = ($height * 100-80) * 0.7;
		$kaluli = 66 + 13.7 * $weight + 5 * $height * 100-6.8 * 25;
		$chao = $weight - $Broca;
		$zhibiao = $chao * 0.1;
		$res = round($weight / ($height * $height), 1);
		if ($res < 18.5)
		{
			$info = '您的体形属于骨感型，需要增加体重' . $chao . '公斤哦!';
			$pic = 1;
		}elseif ($res < 24)
		{
			$info = '您的体形属于圆滑型的身材，需要减少体重' . $chao . '公斤哦!';
		}elseif ($res > 24)
		{
			$info = '您的体形属于肥胖型，需要减少体重' . $chao . '公斤哦!';
		}elseif ($res > 28)
		{
			$info = '您的体形属于严重肥胖，请加强锻炼，或者使用我们推荐的减肥方案进行减肥';
		}
		return $info;
	}
	function fujin($keyword)
	{
		$keyword = implode('', $keyword);
		if ($keyword == false)
		{
			return $this->my . "很难过,无法识别主人的指令,正确使用方法是:输入【附近+关键词】当" . $this->my . '提醒您输入地理位置的时候就OK啦';
		}
		$data = array();
		$data['time'] = time();
		$data['token'] = $this->_get('token');
		$data['keyword'] = $keyword;
		$data['uid'] = $this->data['FromUserName'];
		$re = M('Nearby_user');
		$user = $re->where(array('token' => $this->_get('token'), 'uid' => $data['uid']))->find();
		if ($user == false)
		{
			$re->data($data)->add();
		}
		else
		{
			$id['id'] = $user['id'];
			$re->where($id)->save($data);
		}
		return "主人【" . $this->my . "】已经接收到你的指令\n请发送您的地理位置给我哈";
	}
	function recordLastRequest($key, $msgtype = 'text')
	{
		$rdata = array();
		$rdata['time'] = time();
		$rdata['token'] = $this->_get('token');
		$rdata['keyword'] = $key;
		$rdata['msgtype'] = $msgtype;
		$rdata['uid'] = $this->data['FromUserName'];
		$user_request_model = M('User_request');
		$user_request_row = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => $msgtype, 'uid' => $rdata['uid']))->find();
		if (!$user_request_row)
		{
			$user_request_model->add($rdata);
		}
		else
		{
			$rid['id'] = $user_request_row['id'];
			$user_request_model->where($rid)->save($rdata);
		}
	}
	function map($x, $y){
	    $user_request_model = M ('User_request');
	    $user_request_row = $user_request_model -> where (array ('token' => $this -> _get ('token'), 'msgtype' => 'text', 'uid' => $this -> data ['FromUserName'])) -> find ();
	    if (! (strpos ($user_request_row ['keyword'], '附近') === FALSE)){
	        $user = M ('Nearby_user') -> where (array ('token' => $this -> _get ('token'), 'uid' => $this -> data ['FromUserName'])) -> find ();
	        $keyword = $user ['keyword'];
	        $radius = 2000;
	        $str = file_get_contents (C ('site_url') . '/map.php?keyword=' . urlencode ($keyword) . '&x=' . $x . '&y=' . $y);
	        $array = json_decode ($str);
	        $map = array ();
	        foreach ($array as $key => $vo){
	            $map [] = array ($vo -> title, $key, rtrim (C ('site_url'), '/') . '/tpl/static/images/home.jpg', $vo -> url) ;
	        }
	        return array ($map, 'news') ;
	    }else{
	        import ("Home.Action.MapAction");
	        $mapAction = new MapAction ();
	        if (! (strpos ($user_request_row ['keyword'], '开车去') === FALSE) || ! (strpos ($user_request_row ['keyword'], '坐公交') === FALSE) || ! (strpos ($user_request_row ['keyword'], '步行去') === FALSE)){
	            if (! (strpos ($user_request_row ['keyword'], '步行去') === FALSE)){
	                $companyid = str_replace ('步行去', '', $user_request_row ['keyword']);
	                if (! $companyid){
	                    $companyid = 1;
	                }
	                return $mapAction -> walk ($x, $y, $companyid);
	            }
	            if (! (strpos ($user_request_row ['keyword'], '开车去') === FALSE)){
	                $companyid = str_replace ('开车去', '', $user_request_row ['keyword']);
	                if (! $companyid){
	                    $companyid = 1;
	                }
	                return $mapAction -> drive ($x, $y, $companyid);
	            }
	            if (! (strpos ($user_request_row ['keyword'], '坐公交') === FALSE)){
	                $companyid = str_replace ('坐公交', '', $user_request_row ['keyword']);
	                if (! $companyid){
	                    $companyid = 1;
	                }
	                return $mapAction -> bus ($x, $y, $companyid);
	            }
	        }else{
	            switch ($user_request_row ['keyword']){
	            case '最近的' : return $mapAction -> nearest ($x, $y);
	                break;
	            }
	        }
	    }
	}
	function suanming($name)
	{
		$name = implode('', $name);
		if (empty($name))
		{
			return '主人' . $this->my . '提醒您正确的使用方法是[算命+姓名]';
		}
		$data = require_once(CONF_PATH . 'suanming.php');
		$num = mt_rand(0, 80);
		return $name . "\n" . trim($data[$num]);
	}
	function yinle($name)
	{
		$name = implode('', $name);
		$url = 'http://httop1.duapp.com/mp3.php?musicName=' . $name;
		$str = file_get_contents($url);
		$obj = json_decode($str);
		return array(array($name, $name, $obj->url, $obj->url), 'music');
	}
	function geci($n)
	{
		$name = implode ( '', $n );
		
		@$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode ( '歌词' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'bmweixin', $str );
	}
	function yuming($n)
	{
		$name = implode ( '', $n );
		
		@$str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode ( '域名' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'bmweixin', $str );
	}
    function tianqi($n)
    {
        $s=""; 
        $name=str_replace("天气","",$n); 
        $name = mb_convert_encoding($name, 'gb2312', 'UTF-8'); 
        $content = file_get_contents('http://php.weather.sina.com.cn/xml.php?city='.
        $name.'&password=DJOYnieT8234jlsK&day=0'); 
        $xml = simplexml_load_string($content); 
        foreach($xml as $tmp){ 
        $s="**".
        $tmp->city."天气-今天**\n日期".
        $tmp->savedate_weather."\n白天:".
        $tmp->status1."\n夜晚:".
        $tmp->status2."\n温度:".
        $tmp->temperature1."-".
        $tmp->temperature2."摄氏度\n风级:".
        $tmp->power1."\n风向:".
        $tmp->direction1."\n污染指数:".
        $tmp->pollution_l."\n污染指数说明:".
        $tmp->pollution_s."\n感冒指数:".
        $tmp->gm_l."\n感冒指数说明:".
        $tmp->gm_s."\n紫外线:".
        $tmp->zwx_s."\n洗车指数:".
        $tmp->xcz_s."\n穿衣说明:".
        $tmp->chy_shuoming."\n************************\n\n";} 
        $content = file_get_contents('http://php.weather.sina.com.cn/xml.php?city='.
        $name.'&password=DJOYnieT8234jlsK&day=1'); 
        $xml = simplexml_load_string($content); 
        foreach($xml as $tmp){ 
        $s=$s."**".
        $tmp->city."天气-明天**\n日期".
        $tmp->savedate_weather."\n白天:".
        $tmp->status1."\n夜晚:".
        $tmp->status2."\n温度:".
        $tmp->temperature1."-".
        $tmp->temperature2."摄氏度\n风级:".
        $tmp->power1."\n风向:".
        $tmp->direction1."\n污染指数:".
        $tmp->pollution_l."\n污染指数说明:".
        $tmp->pollution_s."\n感冒指数:".
        $tmp->gm_l."\n感冒指数说明:".
        $tmp->gm_s."\n紫外线:".
        $tmp->zwx_s."\n洗车指数:".
        $tmp->xcz_s."\n穿衣说明:".
        $tmp->chy_shuoming."\n*********************\n\n";} 
        $content = file_get_contents('http://php.weather.sina.com.cn/xml.php?city='.
        $name.'&password=DJOYnieT8234jlsK&day=2'); 
        $xml = simplexml_load_string($content); 
        foreach($xml as $tmp){ 
        $s=$s."**".$tmp->city."天气-后天**\n日期".
        $tmp->savedate_weather."\n白天:".
        $tmp->status1."\n夜晚:".
        $tmp->status2."\n温度:".
        $tmp->temperature1."-".
        $tmp->temperature2."摄氏度\n风级:".
        $tmp->power1."\n风向:".
        $tmp->direction1."\n污染指数:".
        $tmp->pollution_l."\n污染指数说明:".
        $tmp->pollution_s."\n感冒指数:".
        $tmp->gm_l."\n感冒指数说明:".
        $tmp->gm_s."\n紫外线:".
        $tmp->zwx_s."\n洗车指数:".
        $tmp->xcz_s."\n穿衣说明:".
        $tmp->chy_shuoming."\n*********************";} 
        return $s; 
    } 
	function sousuo($n) 
	{
		$name = implode ( '', $n );
		
		@$str = 'http://vip0476.com/weixinapi.php?city_id=1' . urlencode ( '搜' . $name );
		
		$json = json_decode ( file_get_contents ( $str ) );
		
		$str = str_replace ( '{br}', "\n", $json->content );
		
		return str_replace ( 'mzxing_com', 'bmweixin', $str );
	}
	function shouji($n)
	{
        $name = implode('', $n);
        @($str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode(('归属' . $name)));
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', '\\n', $json->content);
        $str = str_replace('菲菲', $this->my, str_replace('提示：', $this->my . '提醒您:', str_replace('{br}', '\\n', $str)));
        return $str;
	}
	function shenfenzheng($n)
	{
        $n = implode('', $n);
        if (count($n) > 1) {
            $this->error_msg($n);
            return false;
        }
        $str1 = file_get_contents('http://www.youdao.com/smartresult-xml/search.s?jsFlag=true&type=id&q=' . $n);
        $array = explode(':', $str1);
        $array[2] = rtrim($array[4], ',\'gender\'');
        $str = trim($array[3], ',\'birthday\'');
        if ($str !== iconv('UTF-8', 'UTF-8', iconv('UTF-8', 'UTF-8', $str))) {
            $str = iconv('GBK', 'UTF-8', $str);
        }
        $str = ((((('【身份证】 ' . $n) . '') . '【地址】') . $str) . '【该身份证主人的生日】') . str_replace('\'', '', $array[2]);
        return $str;
	}
	function gongjiao($data)
	{
        $data = array_merge($data);
        if (count($data) < 2) {
            $this->error_msg();
            return false;
        }
        if (trim($data[0]) == '' or trim($data[1]) == '') {
            return '公交车查询格式为：上海公交774';
        }
        $json = file_get_contents((('http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=5da453b2-b154-4ef1-8f36-806ee58580f6&zone=' . $data[0]) . '&line=') . $data[1]);
        $data = json_decode($json);
        $xianlu = $data->Response->Head->XianLu;
        $xdata = get_object_vars($xianlu->ShouMoBanShiJian);
        $xdata = $xdata['#cdata-section'];
        $piaojia = get_object_vars($xianlu->PiaoJia);
        $xdata = ($xdata . ' -- ') . $piaojia['#cdata-section'];
        $main = $data->Response->Main->Item->FangXiang;
        $xianlu = $main[0]->ZhanDian;
        $str = '【本公交途经】';
        for ($i = 0; $i < count($xianlu); $i++) {
            $str .= '' . trim($xianlu[$i]->ZhanDianMingCheng);
        }
        return $str;
	}
	function huoche($data, $time = '')
	{
		$data = array_merge($data);
		$data[2] = date('Y', time()) . $time;
		if (count($data) != 3)
		{
			$this->error_msg($data[0] . '至' . $data[1]) ;
			return false;
		};
		$time = empty($time)?date('Y-m-d', time()):date('Y-', time()) . $time;
		$json = file_get_contents("http://www.twototwo.cn/train/Service.aspx?format=json&action=QueryTrainScheduleByTwoStation&key=5da453b2-b154-4ef1-8f36-806ee58580f6&startStation=" . $data[0] . "&arriveStation=" . $data[1] . "&startDate=" . $data[2] . "&ignoreStartDate=0&like=1&more=0");
		if ($json)
		{
			$data = json_decode($json);
			$main = $data->Response->Main->Item;
			if (count($main) > 10)
			{
				$conunt = 10;
			}
			else
			{
				$conunt = count($main);
			}
			for($i = 0;$i < $conunt;$i++)
			{
				$str .= "\n 【编号】" . $main[$i]->CheCiMingCheng . "\n 【类型】" . $main[$i]->CheXingMingCheng . "\n【发车时间】:　" . $time . ' ' . $main[$i]->FaShi . "\n【耗时】" . $main[$i]->LiShi . ' 小时';
				$str .= "\n----------------------";
			}
		}
		else
		{
			$str = '没有找到 ' . $name . ' 至 ' . $toname . ' 的列车';
		}
		return $str;
	}
	function fanyi($name)
	{
		$name = array_merge ( $name );
		
		$url = "http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=" . $name [0] . "&from=auto&to=auto";
		
		$json = Http::fsockopenDownload ( $url );
		
		if ($json == false) {
			
			$json = file_get_contents ( $url );
		}
		
		$json = json_decode ( $json );
		
		$str = $json->trans_result;
		
		if ($str [0]->dst == false)
			
			return $this->error_msg ( $name [0] );
		
		$mp3url = 'http://www.apiwx.com/aaa.php?w=' . $str [0]->dst;
		
		return array (
				
				array (
						
						$str [0]->src,
						
						$str [0]->dst,
						
						$mp3url,
						
						$mp3url 
				)
				,
				
				'music' 
		)
		;
	}
	function caipiao($name)
	{
		$name = array_merge($name);
		$url = "http://api2.sinaapp.com/search/lottery/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=" . $name[0];
		$json = Http::fsockopenDownload($url);
		if ($json == false)
		{
			$json = file_get_contents($url);
		}
		$json = json_decode($json, true);
		$str = $json['text']['content'];
		return $str;
	}
	function mengjian($name)
	{
		$name = array_merge($name);
		if (empty($name))return '周公睡着了,无法解此梦,这年头神仙也偷懒';
		$data = M('Dream')->field('content')->where("`title` LIKE '%" . $name[0] . "%'")->find();
		if (empty($data))return '周公睡着了,无法解此梦,这年头神仙也偷懒';
		return $data['content'];
	}
	function gupiao($name) 
	{
        $url = 'http://api2.sinaapp.com/search/stock/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=' . $name[1];
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json, true);
        $str = $json['text']['content'];
        return $str;
	}
	function getmp3($data) 
	{
		$obj = new getYu ();
		
		$ContentString = $obj->getGoogleTTS ( $data );
		
		$randfilestring = 'mp3/' . time () . '_' . sprintf ( '%02d', rand ( 0, 999 ) ) . ".mp3";
		
		file_put_contents ( $randfilestring, $ContentString );
		
		return rtrim ( C ( 'site_url' ), '/' ) . $randfilestring;
	}
	function xiaohua()
	{
        $name = implode('', $n);
        @$str = 'http://api.bd001.com/iMicms_com/api.php?key=free&appid=0&msg=' . urlencode('笑话' . $name);
        $json = json_decode(file_get_contents($str));
        $str  = str_replace('{br}', "\n", $json->content);
        $str  = str_replace('iwxcms.com', 'bmweixin.com', $str);
        return str_replace('老杨', 'iwxcms', $str);
	}
	function wifi()
	{
		$wifi = M ( 'wifipassword' )->where ( array (
				
				'token' => $this->token 
		)
		 )
		->find ();
		
		if ($wifi == false) {
			
			return 'Wifi未设定';
			
		} else {
			if($wifi['type']=="witown")
			{
				$url = 'http://wifi.witown.com/weixin/wxNotify.htm?mid='.$wifi['url'].'&fromUserName='.$this->data ['FromUserName'].'&toUserName='.$this->data ['ToUserName'].'&Content=wifi';
				
				$doc = new DOMDocument();
				
				$doc->load($url);
				
				$itemEncrypt_key = $doc->getElementsByTagName( "Content" );
				
				$encrypt_key = $itemEncrypt_key->item(0)->nodeValue;
				
				$pos = strpos($encrypt_key, '密码'); 
				
				if($pos==true)		
				{		
					$ptn = "/(?<=密码是：).*?(?=（)/";
				}
				else
				{
					$ptn = "/(?<=验证码：).*?(?=（)/";
				}
				
				preg_match($ptn, $encrypt_key, $matches);
				
				return str_replace("{WIFI}",$matches[0],$wifi['info']);
			}
			if($wifi['type']=="laoyang")
			{
				$url=rtrim ( C ( 'site_url' ), '/' ) . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data ['FromUserName'] .'&username='.$wifi['acc_bw'].'&passwd='.$wifi['psw_bw'];
				return "<a href=\"".$url."\">点击这里开始免费上网</a>";
			}
			if($wifi['type']=="rippleos")
			{
				$key = 'wifi';
				return $this->rippleos($key);
			}
		}
	}
	function rippleos($key)
	{
		$like["keyword"] = array("like", "%" . $key . "%");
		$like["token"] = $this->token;
		$node = d("Wifi_keyword")->where($like)->order("id desc")->find();
		if($node==false)
		{
			return array("rippleos节点列表未找到此关键词", "text");
		}
		$ret_json = $this->rippleos_auth_url($node["node"]);
		$ret_code = $this->rippleos_auth_token($node["node"]);
		if (is_array($node) && ($ret_json["status"] === 0)) {
			if (($node["rztype"] == 0) && ($node["rz_id"] == 1)) {
				$url = $ret_json["auth_url"];
			}
			else {
				$url = c("site_url") . "/index.php?g=Home&m=Index&a=wifi&id=" . $node["id"] . "&wecha_id=" . $this->data["FromUserName"];
			}

			return array(
						array(
							array($node["title"], strip_tags(htmlspecialchars_decode("本机上网直接点击,<br />如果其他机器使用请在设备登陆界面输入验证码:" . $ret_code["auth_token"])), $node["wx_pic"], $url)
							),
						"news"
						);
		}
		else {
			return array("配置出问题了，appId=" . c("rptk_wx_auth_api_id") . ";____appKey=" . c("rptk_wx_auth_api_key") . ";____nodeId=" . $node["name"] . ";___openId=" . $this->data["FromUserName"] . $node["name"], "text");
		}
	}
	function liaotian($name) 
	{
		$name = array_merge($name);
		$this->chat($name[0]);
	}
	function chat($name) 
	{
        $function = M('Function')->where(array(
            'funname' => 'liaotian'
        ))->find();
        if (!$function['status']) {
            return '';
        }
        $this->requestdata('textnum');
        $check = $this->user('connectnum');
        if ($check['connectnum'] != 1) {
            return C('connectout');
        }
        if (!(strpos($name, '你是') === FALSE)) {
            return '咳咳，我是只能微信机器人';
        }
        if ($name == "你叫什么" || $name == "你是谁") {
            return '咳咳，我是聪明与智慧并存的美女，主人你可以叫我' . $this->my . '，人家刚交男朋友，你不可追我啦~~';
        } elseif ($name == "你父母是谁" || $name == "你爸爸是谁" || $name == "你妈妈是谁") {
            return '主人，' . $this->my . '是微信通创造的，所以他们是我的父母，不过主人我属于你的';
        } elseif ($name == '糗事') {
            $name = '笑话';
        } elseif ($name == '网站' || $name == '官网' || $name == '网址' || $name == '3g网址') {
            return "【" . C('site_name') . "】\n" . C('site_name') . "\n【" . C('site_name') . "服务宗旨】\n化繁为简，让菜鸟也能使用强大的系统！";
        }
        $str= 'http://api.bd001.com/iMicms_com/api.php?key=free&appid=0&msg='.urlencode($name);
        $json = Http::fsockopenDownload($str);
        if ($json == false) {
            $json = file_get_contents($str);
        }
        $json = json_decode($json, true);
        $str = str_replace('小胖', $this->my, str_replace('提示：', $this->my . '提醒您:', str_replace('{br}', "\n", $json['content'])));
        return str_replace('mzxing_com', 'laoyang', $str);
	}
	function fistMe($data)
	{
		if ('event' == $data['MsgType'] && 'subscribe' == $data['Event'])
		{
			return $this->help();
		}
	}
	function help()
	{
		$this->behaviordata('help', '', '1');
		$data = M('Areply')->where(array('token' => $this->token))->find();
		return array(htmlspecialchars_decode(str_replace('{wechat_id}', $this->data['FromUserName'], $data ['content'])),'text');
		
	}
	function error_msg($data)
	{
		return '没有找到' . $data . '相关的数据';
	}
	function user($action, $keyword = '')
	{
		$user = M('Wxuser')->field('uid')->where(array('token' => $this->token))->find();
		$usersdata = M('Users');
		$dataarray = array('id' => $user['uid']);
		$users = $usersdata->field('gid,diynum,connectnum,activitynum,viptime')->where(array('id' => $user['uid']))->find();
		$group = M('User_group')->where(array('id' => $users['gid']))->find();
		if ($users['diynum'] < $group['diynum'])
		{
			$data['diynum'] = 1;
			if ($action == 'diynum')
			{
				$usersdata->where ( $dataarray )->setInc ( 'diynum' );
			}
		}
		if ($users['connectnum'] < $group['connectnum'])
		{
			$data['connectnum'] = 1;
			if ($action == 'connectnum')
			{
				$usersdata->where($dataarray)->setInc('connectnum');
			}
		}
		if ($users['viptime'] > time())
		{
			$data['viptime'] = 1;
		}
		return $data;
	}
	function requestdata($field)
	{
		$data['year'] = date('Y');
		$data['month'] = date('m');
		$data['day'] = date('d');
		$data['token'] = $this->token;
		$mysql = M('Requestdata');
		$check = $mysql->field('id')->where($data)->find();
		if ($check == false)
		{
			$data['time'] = time();
			$data[$field] = 1;
			$mysql->add($data);
		}
		else
		{
			$mysql->where($data)->setInc($field);
		}
	}
    //一战到底
    private function dati()
    {
        $wecha_id = $_SESSION['wecha_id'];
        S($wecha_id, 'start', 1800);
        //清空用户上次的所有积分
        M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $wecha_id))->delete();
        return array('回复xzt开始选择题答题，回复jdt开始简答题，回复ktc开始看图猜,回复jf查询积分,回复top查询前五排名,回复help获得帮助,回复end结束游戏', 'text');
    }
    private function dati_start($content)
    {
        $now_time = time();
        $where['wecha_id'] = $_SESSION['wecha_id'];
        $where['token'] = $this->token;
        /*
        | -------------------------------------------
        | 记录答题者的信息
        | -------------------------------------------
        */
        $record = M('Dati_record')->where($where)->find();
        if ($record == NULL) {
            M('Dati_record')->add($where);
            $record = M('Dati_record')->where($where)->find();
        }
        $condition['token'] = $where['token'];
        switch (strtolower($content)) {
        case 'jdt':
            //开始出题
            $condition['type'] = 1;
            if (S($record['id'] . '_did') !== null) {
                S($record['id'] . '_did', null);
            }
            $ak = M('Dati')->where($condition)->order('id DESC')->find();
            if ($ak !== null) {
                S($record['id'] . '_did', $ak['id'], 1800);
                S($record['id'] . '_daan', $ak['daan'], 1800);
                S($record['id'] . '_type', 1, 1800);
                S($record['id'] . '_score', $ak['score'], 1800);
                S($record['id'] . '_time', $now_time, 1800);
                //记录出题时间
                return array($ak['title'], 'text');
            } else {
                S($record['id'] . '_did', 'end', 1800);
                return array('题库还没题目哦！回复xzt开始选择题，回复ktc开始看图猜.', 'text');
            }
            break;
        case 'xzt':
            //开始出题
            $condition['type'] = 0;
            if (S($record['id'] . '_did') !== null) {
                S($record['id'] . '_did', null);
            }
            $ak = M('Dati')->where($condition)->order('id DESC')->find();
            if ($ak !== null) {
                S($record['id'] . '_did', $ak['id'], 1800);
                S($record['id'] . '_daan', $ak['daan'], 1800);
                S($record['id'] . '_type', 0, 1800);
                S($record['id'] . '_score', $ak['score'], 1800);
                S($record['id'] . '_time', $now_time, 1800);
                //记录出题时间
                return array($ak['title'], 'text');
            } else {
                S($record['id'] . '_did', 'end', 1800);
                return array('题库还没题目哦！先玩玩其他的吧！', 'text');
            }
            break;
        case 'ktc':
            //开始出题
            $condition['type'] = 2;
            if (S($record['id'] . '_did') !== null) {
                S($record['id'] . '_did', null);
            }
            $ak = M('Dati')->where($condition)->order('id DESC')->find();
            if ($ak !== null) {
                S($record['id'] . '_did', $ak['id'], 1800);
                S($record['id'] . '_daan', $ak['daan'], 1800);
                S($record['id'] . '_type', 2, 1800);
                S($record['id'] . '_score', $ak['score'], 1800);
                S($record['id'] . '_time', $now_time, 1800);
                //记录出题时间
                return array(array(array($ak['title'], $this->handleIntro($ak['info']), $ak['picurl'], '')), 'news');
            } else {
                S($record['id'] . '_did', 'end', 1800);
                return array('题库还没题目哦！先玩玩其他的吧！', 'text');
            }
            break;
        case 'end':
            S($_SESSION['wecha_id'], null);
            return array('您已经结束了一站到底游戏！您还可以关注我们其他好玩的游戏!', 'text');
            break;
        case 'jf':
            return array('您的积分为：' . $record['score'], 'text');
            break;
        case 'help':
            return array('回复xzt开始选择题答题，回复jdt开始简答题，回复ktc开始看图猜,回复jf查询积分,回复top查询前五排名,回复help获得帮助,回复end结束游戏', 'text');
            break;
        case 'top':
            $like['token'] = $this->token;
            $back = M('Dati_record')->limit(5)->order('score desc')->where($like)->select();
            if ($back == false) {
                return array('暂无排名信息', 'text');
            }
            $topstr = '';
            foreach ($back as $keya => $infot) {
                if ($_SESSION['wecha_id'] == $infot['wecha_id']) {
                    $topstr = ((($topstr . $infot['wecha_id']) . '(你)：') . $infot['score']) . '';
                } else {
                    $topstr = ((($topstr . $infot['wecha_id']) . '：') . $infot['score']) . '';
                }
            }
            return array('游戏排名：' . $topstr, 'text');
            break;
        default:
            if (S($record['id'] . '_did') !== 'end') {
                $condition['id'] = array('lt', S($record['id'] . '_did'));
                $condition['type'] = S($record['id'] . '_type');
                $ak = M('Dati')->where($condition)->order('id DESC')->find();
                if ($ak == null) {
                    //如果已经是最后一题
                    $return = '';
                    if (S($record['id'] . '_daan') !== '') {
                        $daan = S($record['id'] . '_daan');
                        $return .= ('正确答案是:' . S(($record['id'] . '_daan'))) . '-------------------';
                        switch (S($record['id'] . '_type')) {
                        case 0:
                            if (strtolower($content) == strtolower($daan)) {
                                $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                                M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                            } else {
                                if ($record['score'] >= S($record['id'] . '_score')) {
                                    $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                                    M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                                }
                            }
                            break;
                        case 1:
                            if (@stripos($content, $daan) !== false) {
                                $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                                M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                            } else {
                                if ($record['score'] >= S($record['id'] . '_score')) {
                                    $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                                    M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                                }
                            }
                            break;
                        case 2:
                            if (@stripos($content, $daan) !== false) {
                                $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                                M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                            } else {
                                if ($record['score'] >= S($record['id'] . '_score')) {
                                    $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                                    M('Dati_record')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                                }
                            }
                            break;
                        }
                    }
                    S($record['id'] . '_did', 'end');
                    $return .= '你好棒！所有题目都答完了!回复xzt开始选择题答题，回复jdt开始简答题，回复ktc开始看图猜,回复jf查询积分,回复top查询前五排名,回复help获得帮助,回复end结束游戏';
                    return array($return, 'text');
                } elseif (S($record['id'] . '_type') == 2) {
                    $daan = S($record['id'] . '_daan');
                    if (@stripos($content, $daan) !== false) {
                        $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                        M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                    } else {
                        if ($record['score'] > S($record['id'] . '_score')) {
                            $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                            M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                        }
                    }
                    $info = (('正确答案：' . $daan) . '--------------------------') . $ak['info'];
                    $imgurl = $ak['picurl'];
                    $url = '';
                    S($record['id'] . '_daan', $ak['daan'], 1800);
                    S($record['id'] . '_did', $ak['id'], 1800);
                    return array(array(array($ak['title'], $this->handleIntro($info), $imgurl, $url)), 'news');
                } else {
                    $daan = S($record['id'] . '_daan');
                    switch (intval(S($record['id'] . '_type'))) {
                    case 0:
                        if (strtolower($content) == strtolower($daan)) {
                            $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                            M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                        } else {
                            if ($record['score'] >= S($record['id'] . '_score')) {
                                $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                                M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                            }
                        }
                        break;
                    case 1:
                        if (@stripos($content, $daan) !== false) {
                            $data['score'] = (int) $record['score'] + intval(S(($record['id'] . '_score')));
                            M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                        } else {
                            if ($record['score'] >= S($record['id'] . '_score')) {
                                $data['score'] = (int) $record['score'] - intval(S(($record['id'] . '_score')));
                                M('DatiRecord')->where(array('token' => $this->token, 'wecha_id' => $_SESSION['wecha_id']))->save($data);
                            }
                        }
                        break;
                    }
                }
                $return = (('正确答案：' . $daan) . ';-------------------------') . $ak['title'];
                S($record['id'] . '_daan', $ak['daan'], 1800);
                S($record['id'] . '_did', $ak['id'], 1800);
                return array($return, 'text');
            }
        }
        S($_SESSION['wecha_id'], null);
        return array('答题结束', 'text');
        break;
    }
	function baike($name)
	{
		$name = implode('', $name);
		if ($name == 'bmweixin')
		{
			return '福州是一个牛B的地方，这里的男淫女淫都喜欢..不过马上要被我收购了，当然这只是一个笑话';
		}
		$name_gbk = iconv('utf-8', 'gbk', $name);
		$encode = urlencode($name_gbk);
		$url = 'http://baike.baidu.com/list-php/dispose/searchword.php?word=' . $encode . '&pic=1';
		$get_contents = $this->httpGetRequest_baike($url);
		$get_contents_gbk = iconv('gbk', 'utf-8', $get_contents);
		preg_match("/URL=(\S+)'>/s", $get_contents_gbk, $out);
		$real_link = 'http://baike.baidu.com' . $out[1];
		$get_contents2 = $this->httpGetRequest_baike($real_link);
		preg_match('#"Description"\scontent="(.+?)"\s\/\>#is', $get_contents2, $matchresult);
		if (isset($matchresult[1]) && $matchresult[1] != "")
		{
			return htmlspecialchars_decode($matchresult[1]);
		}
		else
		{
			return "抱歉，没有找到与“" . $name . "”相关的百科结果。";
		}
	}

	function httpGetRequest_baike($url)
	{
		$headers = array("User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1", "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8", "Accept-Language: en-us,en;q=0.5", "Referer: http://www.baidu.com/");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$output = curl_exec($ch);
		curl_close($ch);
		if ($output === false)
		{
			return "cURL Error: " . curl_error($ch);
		}
		return $output;
	}
	function behaviordata($field, $id = '', $type = '')
	{
		$data['date'] = date('Y-m-d', time());
		$data['token'] = $this->token;
		$data['openid'] = $this->data['FromUserName'];
		$data['keyword'] = $this->data['Content'];
		if (!$data['keyword'])
		{
			$data['keyword'] = '用户关注';
		}
		$data['model'] = $field;
		if ($id != false)
		{
			$data['fid'] = $id;
		}
		if ($type != false)
		{
			$data['type'] = 1;
		}
		$mysql = M('Behavior');
		$check = $mysql->field('id')->where($data)->find();
		$this->updateMemberEndTime($data['openid']);
		if ($check == false)
		{
			$data['enddate'] = time();
			$mysql->add($data);
		}
		else
		{
			$mysql->where($data)->setInc('num');
		}
	}
	function get_tags($title, $num = 10)
	{
		vendor('Pscws.Pscws4', '', '.class.php');
		$pscws = new PSCWS4();
		$pscws->set_dict(CONF_PATH . 'etc/dict.utf8.xdb');
		$pscws->set_rule(CONF_PATH . 'etc/rules.utf8.ini');
		$pscws->set_ignore(true);
		$pscws->send_text($title);
		$words = $pscws->get_tops($num);
		$pscws->close();
		$tags = array();
		foreach ($words as $val)
		{
			$tags[] = $val['word'];
		}
		return implode(',', $tags);
	}
	function updateMemberEndTime($openid)
	{
		$mysql = M('Wehcat_member_enddate');
		$id = $mysql->field('id')->where(array('openid' => $openid))->find();
		$data['enddate'] = time();
		$data['openid'] = $openid;
		$data['token'] = $this->token;
		if ($id == false)
		{
			$mysql->add($data);
		}
		else
		{
			$data['id'] = $id['id'];
			$mysql->save($data);
		}
	}
	function selectService()
	{
        if (!C('without_chat')) {
            $this->behaviordata('chat', '');
            $sepTime = 30 * 60;
            $nowTime = time();
            $time = $nowTime - $sepTime;
            $where['token'] = $this->token;
            $serviceUserWhere = array('token' => $this->token, 'status' => 0);
            $serviceUserWhere['endJoinDate'] = array('gt', $time);
            $serviceUser = M('Service_user')->field('id')->where($serviceUserWhere)->select();
            if ($serviceUser != false) {
                $list = M('wechat_group_list')->field('id')->where(array('openid' => $this->data['FromUserName'], 'token' => $this->token))->find();
                if ($list == false) {
                    $this->adddUserInfo();
                }
                $serviceJoinDate = M('wehcat_member_enddate')->field('id,uid,joinUpDate')->where(array('token' => $this->token, 'openid' => $this->data['FromUserName']))->find();
                if ($serviceJoinDate['uid'] == false || $nowTime - $serviceJoinDate['joinUpDate'] > $sepTime) {
                    foreach ($serviceUser as $key => $users) {
                        $user[] = $users['id'];
                    }
                    if (count($user) == 1) {
                        $id = $user[0];
                    } else {
                        $rand = mt_rand(0, count($user) - 1);
                        $id = $user[$rand];
                    }
                    $where['id'] = $serviceJoinDate['id'];
                    $where['uid'] = $id;
                    M('wehcat_member_enddate')->data($where)->save();
                } else {
                    die;
                }
            }
        }
	}
	public function zhaopianwall($zhaopianwall_result){
    	$message = $this->data;
    	$zhaopianwall_name = '';
    	if ($message['MsgType'] == 'text') {
			$zhaopianwall_name = $message['Content'];
		}
		
		//取消直接删除缓存
		if($zhaopianwall_name == '取消'){
			 S('zhaopianwall_'.$this->data['FromUserName'],NULL);
			 return array(
	                     '晒图片取消成功！感谢您的参与',
	                    'text'
             );
		}else{
			 
			S('zhaopianwall_'.$this->data['FromUserName'],NULL);
			  
		     	 
		    $zhaopianwall_result['username'] = $zhaopianwall_name;
		    $pic_wall_inf = M('pic_wall')->where(array('token'=>$this->token,'id'=>$zhaopianwall_result['uid']))->order('id desc')->find();
		    M('pic_walllog')->data($zhaopianwall_result)->add();
		    
		    if($zhaopianwall_result['state']){//照片上传成功
		    	 return array(
                        array(
                            array(
                                '照片上墙成功',
                                $pic_wall_inf['info'],
                                $pic_wall_inf['starpicurl'],
                                C('site_url') . '/index.php?g=Wap&m=Zhaopianwall&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&sgssz=mp.weixin.qq.com'
                            )
                        ),
                        'news'
                    );
		    }else{
		    	//照片需要审核
		    	
		    return array(
	                     '照片上传成功，正在审核，审核通过后可以显示',
	                    'text'
                     );
		    }
		}
		
		
    }
	function getRecognition($id)
	{
		$GetDb = D('Recognition');
		$data = $GetDb->field('keyword')->where(array('id' => $id, 'status' => 0))->find();
		if ($data != false)
		{
			$GetDb->where(array('id' => $id))->setInc('attention_num');
			return $data['keyword'];
		}
		else
		{
			return false;
		}
	}
	function api_notice_increment($url, $data)
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		if (strpos($url, '?'))
		{
			$url .= '&token=' . $this->token;
		}
		else
		{
			$url .= '?token=' . $this->token;
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch))
		{
			return false;
		}
		else
		{
			return $tmpInfo;
		}
	}
	function adddUserInfo()
	{
        $access_token = $this->_getAccessToken();
        $url2 = (('https://api.weixin.qq.com/cgi-bin/user/info?openid=' . $this->data['FromUserName']) . '&access_token=') . $access_token;
        $classData = json_decode($this->curlGet($url2));
        $db = M('wechat_group_list');
        $data['token'] = $this->token;
        $data['openid'] = $this->data['FromUserName'];
        $item = $db->where(array('token' => $this->token, 'openid' => $this->data['FromUserName']))->find();
        $data['nickname'] = str_replace('\'', '', $classData->nickname);
        $data['sex'] = $classData->sex;
        $data['city'] = $classData->city;
        $data['province'] = $classData->province;
        $data['headimgurl'] = $classData->headimgurl;
        $data['subscribe_time'] = $classData->subscribe_time;
        $url3 = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=' . $access_token;
        $json2 = json_decode($this->curlGet($url3, 'post', ('{"openid":"' . $data['openid']) . '"}'));
        $data['g_id'] = $json->groupid;
        if (!$data['g_id']) {
            $data['g_id'] = 0;
        }
        if (!$item) {
            $db->data($data)->add();
        } else {
            $db->where(array('token' => $this->token, 'openid' => $this->data['FromUserName']))->save($data);
        }
	}
	function _getAccessToken()
	{
		$where = array('token' => $this->data['FromUserName']);
		$this->thisWxUser = M('Wxuser')->where($where)->find();
		$url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->thisWxUser['appid'] . '&secret=' . $this->thisWxUser['appsecret'];
		$json = json_decode($this->curlGet($url_get));
		if (!$json->errmsg)
		{
		}
		else
		{
			$this->error('获取access_token发生错误：错误代码' . $json->errcode . ',微信返回错误信息：' . $json->errmsg);
		}
		return $json->access_token;
	}
    function weizhang($data)
    {
        //return $data;die();
        return file_get_contents('http://www.hcgajj.com/weixin.asp?ch=' . urlencode($data));
    }
	function curlGet($url, $method = 'get', $data = '')
	{
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
	function handleIntro($str)
	{
	        $str = html_entity_decode(htmlspecialchars_decode($str));
	        $search = array('&amp;', '&quot;', '&nbsp;', '&gt;', '&lt;');
	        $replace = array('&', '"', ' ', '>', '<');
	        return strip_tags(str_replace($search, $replace, $str));
	}
	function getFuncLink($u)
	{
		$urlInfos = explode(' ', $u);
		switch ($urlInfos[0])
		{
			default: $url = str_replace(array('{wechat_id}', '{siteUrl}', '&amp;'), array($this->data['FromUserName'], C('site_url'), '&'), $urlInfos[0]);
				break;
			case '刮刮卡': $Lottery = M('Lottery')->where(array('token' => $this->token, 'type' => 2, 'status' => 1))->order('id DESC')->find();
				$url = C('site_url') . U('Wap/Guajiang/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $Lottery['id']));
				break;
			case '大转盘': $Lottery = M('Lottery')->where(array('token' => $this->token, 'type' => 1, 'status' => 1))->order('id DESC')->find();
				$url = C('site_url') . U('Wap/Lottery/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $Lottery['id']));
				break;
			case '商家订单': $url = C('site_url') . '/index.php?g=Wap&m=Host&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'] . '&rid=' . $urlInfos[1] . '&sgssz=mp.weixin.qq.com';
				break;
			case '优惠券': $Lottery = M('Lottery')->where(array('token' => $this->token, 'type' => 3, 'status' => 1))->order('id DESC')->find();
				$url = C('site_url') . U('Wap/Coupon/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $Lottery['id']));
				break;
			case '万能表单': $url = C('site_url') . U('Wap/Selfform/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
				break;
			case '会员卡': $url = C('site_url') . U('Wap/Card/vip', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
				break;
			case '首页': $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Index&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
				break;
			case '团购': $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
				break;
			case '商城': $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Product&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
				break;
			//case '订餐': $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Product&a=dining&dining=1&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
			//	break;
			case '相册': $url = rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Photo&a=index&token=' . $this->token . '&wecha_id=' . $this->data['FromUserName'];
				break;
			case '网站分类': $url = C('site_url') . U('Wap/Index/lists', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'classid' => $urlInfos[1]));
				break;
			case 'LBS信息': if ($urlInfos[1])
				{
					$url = C('site_url') . U('Wap/Company/map', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'companyid' => $urlInfos[1]));
				}
				else
				{
					$url = C('site_url') . U('Wap/Company/map', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
				}
				break;
			case 'DIY宣传页': $url = C('site_url') . '/index.php/show/' . $this->token;
				break;
			case '婚庆喜帖': $url = C('site_url') . U('Wap/Wedding/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
				break;
			case '投票': $url = C('site_url') . U('Wap/Vote/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
				break;
		}
		return $url;
	}
}
?>