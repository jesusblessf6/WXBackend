<?php
class BaseAction extends Action
{
    public $isAgent;
    public $home_theme;
    public $reg_needCheck;
    public $minGroupid;
    public $reg_validDays;
    public $reg_groupid;
    public $thisAgent;
    public $agentid;
    public $adminMp;
    public $siteUrl;
    protected function _initialize()
    {

        define('RES', THEME_PATH . 'common');
        define('STATICS', TMPL_PATH . 'static');
        $this->assign('action', $this->getActionName());
        $this->isAgent = 0;
        if (C('agent_version')){
            $thisAgent = M('agent') -> where(array('siteurl' => 'http://' . $_SERVER['HTTP_HOST'])) -> find();
            if ($thisAgent) {
                $this->isAgent = 1;
            }
        }
        if (!$this->isAgent) {
            $this->agentid       = 0;
            if (!C('site_logo')) {
                $f_logo = 'tpl/User/default/common/images/logo.png';
            } else {
                $f_logo = C('site_logo');
            }
            $f_siteName          = C('SITE_NAME');
            $f_siteTitle         = C('SITE_TITLE');
            $f_metaKeyword       = C('keyword');
            $f_metaDes           = C('content');
            $f_qq                = C('site_qq');
            $f_qrcode            = C('site_qrcode');
	    $f_ipc  		 = C('ipc');
            $f_siteUrl           = C('site_url');
            $this->home_theme    = C('DEFAULT_THEME');
            $f_regNeedMp         = C('reg_needmp') == 'true' ? 1 : 0;
            $this->reg_needCheck = C('ischeckuser') == 'false' ? 1 : 0;
            $this->minGroupid    = 1;
            $this->reg_validDays = C('reg_validdays');
            $this->reg_groupid   = C('reg_groupid');
            $this->adminMp       = C('site_mp');
        } else {
            $this->agentid    = $thisAgent['id'];
            $this->thisAgent  = $thisAgent;
            $f_logo           = $thisAgent['sitelogo'];
            $f_siteName       = $thisAgent['sitename'];
            $f_siteTitle      = $thisAgent['sitetitle'];
            $f_metaKeyword    = $thisAgent['metakeywords'];
            $f_metaDes        = $thisAgent['metades'];
            $f_qq             = $thisAgent['qq'];
            $f_qrcode         = $thisAgent['qrcode'];
            $f_siteUrl        = $thisAgent['siteurl'];
            $f_ipc = $thisAgent['copyright'];
            $this->home_theme = C('DEFAULT_THEME');
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/tpl/Home/' . 'agent_' . $thisAgent['id'])) {
                $this->home_theme = 'agent_' . $thisAgent['id'];
            }
            $f_regNeedMp = $thisAgent['regneedmp'];
            $this -> reg_needCheck = $thisAgent['needcheckuser'];
            $minGroup = M('User_group') -> where(array('agentid' => $thisAgent['id'])) -> order('id ASC') -> find();
            $this -> minGroupid = $minGroup['id'];
            $this -> reg_validDays = $thisAgent['regvaliddays'];
            $this -> reg_groupid = $thisAgent['reggid'];
            $this->adminMp       = $thisAgent['mp'];
        }
        $this -> siteUrl = $f_siteUrl;
        $this -> assign('f_logo', $f_logo);
        $this -> assign('f_siteName', $f_siteName);
        $this -> assign('f_siteTitle', $f_siteTitle);
        $this -> assign('f_metaKeyword', $f_metaKeyword);
        $this -> assign('f_metaDes', $f_metaDes);
        $this -> assign('f_qq', $f_qq);
        $this -> assign('f_qrcode', $f_qrcode);
        $this -> assign('f_siteUrl', $f_siteUrl);
        $this -> assign('f_regNeedMp', $f_regNeedMp);
        $this -> assign('f_ipc', $f_ipc);
        $this -> assign('reg_validDays', $this -> reg_validDays);

    }

	protected function _upload($name = '')
	{
		$name = $name ? $name : MODULE_NAME;
		$savePath = './data/attachments/' . $name . '/';
		if (!is_dir($savePath))
		{
			if (is_dir(base64_decode($savePath)))
			{
				$savePath = base64_decode($savePath);
			}
			else
			{
				if (!mkdir($savePath))
				{
					$this->error = '上传目录' . $savePath . '不存在';
					return false;
				}
			}
		}
		import("@.ORG.UploadFile");
		$upload = new UploadFile();
		$upload->maxSize = 3292200;
		$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
		$upload->savePath = $savePath . date("Ymd", time()) . '/';
		$upload->thumb = true;
		$upload->imageClassPath = '@.ORG.Image';
		$upload->thumbPrefix = 'm_';
		$upload->thumbMaxWidth = '720';
		$upload->thumbMaxHeight = '400';
		$upload->saveRule = uniqid;
		$upload->thumbRemoveOrigin = false;
		if (!$upload->upload())
		{
			$this->error($upload->getErrorMsg());
		}
		else
		{
			$uploadList = $upload->getUploadFileInfo();
			return $uploadList;
		}
	}
	protected function all_insert($name = '', $back = '/index')
	{
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->add();
            if ($id) {
                $m_arr = array(
                    'Img',
                    'Text',
                    'Voiceresponse',
                    'Ordering',
                    'Lottery',
                    'Host',
                    'Product',
                    'Selfform',
                    'Panorama',
                    'Wedding',
                    'Vote',
                    'Goldegg',
                    'Estate',
                    'Reservation',
                    'Car_baoyang',
                    'Car_guanhuai',
                    'Medical',
                    'Shipin',
                    'Jiaoyu',
                    'Lvyou',
                    'Huadian',
                    'Wuye',
                    'Jiuba',
                    'Hunqing',
                    'Zhuangxiu',
                    'Ktv',
                    'Jianshen',
                    'Zhengwu',
                    'Cosmetology',
                    'Greeting_card',
                    'Diaoyan',
                    'Invites',
                    'Carowner',
                    'Carset'
                );
                if (in_array($name, $m_arr)) {
					//isset($_POST['precisions']) ? $precisions = 1: $precisions = 0 ;
					$this->handleKeyword($id,$name,$_POST['keyword'],intval($_POST['precisions']));

                }
                $this->success('操作成功', U(MODULE_NAME . $back));
            } else {
                $this->error('操作失败', U(MODULE_NAME . $back));
            }
		}
	}
	protected function insert($name = '', $back = '/index')
	{
		$name = $name?$name:MODULE_NAME;
		$db = D($name);
		if ($db->create() === false)
		{
			$this->error($db->getError());
		}
		else
		{
			$id = $db->add();
			if ($id == true)
			{
				$this->success('操作成功', U(MODULE_NAME . $back));
			}
			else
			{
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
	protected function save($name = '', $back = '/index')
	{
		$name = $name?$name:MODULE_NAME;
		$db = D($name);
		if ($db->create() === false)
		{
			$this->error($db->getError());
		}
		else
		{
			$id = $db->save();
			if ($id == true)
			{
				$this->success('操作成功', U(MODULE_NAME . $back));
			}
			else
			{
				$this->error('操作失败', U(MODULE_NAME . $back));
			}
		}
	}
    protected function all_save($name = '', $back = '/index', $arr = array())
    {
        $name = $name ? $name : MODULE_NAME;
        $db   = D($name);
        if ($db->create() === false) {
            $this->error($db->getError());
        } else {
            $id = $db->save();
            if ($id) {
                $m_arr = array(
                    'Img',
                    'Text',
                    'Voiceresponse',
                    'Ordering',
                    'Lottery',
                    'Host',
                    'Product',
                    'Selfform',
                    'Panorama',
                    'Wedding',
                    'Vote',
                    'Goldegg',
                    'Estate',
                    'Reservation',
                    'Car_baoyang',
                    'Car_guanhuai',
                    'Medical',
                    'Shipin',
                    'Jiaoyu',
                    'Lvyou',
                    'Huadian',
                    'Wuye',
                    'Jiuba',
                    'Hunqing',
                    'Zhuangxiu',
                    'Ktv',
                    'Jianshen',
                    'Zhengwu',
                    'Cosmetology',
                    'Greeting_card',
                    'Diaoyan',
                    'Invites',
                    'Carowner',
                    'Carset'
                    
                );
                if (in_array($name, $m_arr)) {
					$this->handleKeyword(intval($_POST['id']),$name,$_POST['keyword'],intval($_POST['precisions']));

				}
				$this->success('操作成功',U(MODULE_NAME.$back));
			}else{
				$this->error('操作失败',U(MODULE_NAME.$back));
			}
		}
	}
	protected function del_id($name='',$jump=''){
		$name=$name?$name:MODULE_NAME;
		$jump=empty($name)?MODULE_NAME.'/index':$jump;
		$db=D($name);
		$where['id']=$this->_get('id','intval');
		$where['token']=session('token');
		if($db->where($where)->delete()){
			$this->success('操作成功',U($jump));
		}else{
			$this->error('操作失败',U(MODULE_NAME.'/index'));
		}
	}
	protected function all_del($id, $name = '', $back = '/index')
	{
		$name = $name?$name:MODULE_NAME;
		$db = D($name);
		if ($db->delete($id))
		{
			$this->ajaxReturn('操作成功', U(MODULE_NAME . $back));
		}
		else
		{
			$this->ajaxReturn('操作失败', U(MODULE_NAME . $back));
		}
	}

 	//通用添加关键词 支持逗号和空格分隔关键词
	public function handleKeyword($id,$module,$keyword='',$precisions=0,$delete=0){
		$db=M('Keyword');
		$token = session('token');
		$db->where(array('pid'=>$id,'token'=>$token,'module'=>$module))->delete();
		$keyword = trim(trim($keyword),',');

		if (!$delete){

			$data['pid']=$id;
			$data['module']=$module;
			$data['token']=$token;

			$flag1 = strpos($keyword,',');
			$flag2 = strpos($keyword,' ');

			if( $flag1 === false &&  $flag2 === false ){
				$pk = explode('|',$keyword);
				if(count($pk) == 2){
					$data['precisions'] = $pk[1];
					$data['keyword'] = $pk[0];
				}else{
					$data['precisions'] = $precisions;
					$data['keyword'] = $keyword;
				}

				$db->add($data);

			}else{
				//关键词 关键|1 关键词|0
				if($flag1 === false){
					$keyword = explode(' ', $keyword);
					foreach ($keyword as $k => $v){
						$pk = explode('|',$v);
						if(count($pk) == 2){
							$data['precisions'] = $pk[1];
							$data['keyword'] = $pk[0];
						}else{
							$data['precisions'] = $precisions;
							$data['keyword'] = $v;
						}
						$db->add($data);
					}


				}else{

					$keyword = explode(',', $keyword);
					foreach ($keyword as $k => $v){
						$pk = explode('|',$v);
						if(count($pk) == 2){
							$data['precisions'] = $pk[1];
							$data['keyword'] = $pk[0];
						}else{
							$data['precisions'] = $precisions;
							$data['keyword'] = $v;
						}
						$db->add($data);
					}
				}
			}
		}
	}   
	protected function order_pay($payinfo, $wecha_id, $token, $name = '', $back = '')
	{
		$name = $name ? $name : "Product";
		$back = U($name . "/my", array('token' => $token, 'wecha_id' => $wecha_id));
		$pay_m_alipay_config = M('Pay_m_alipay_config')->where(array('token' => $token))->find();
		if ($pay_m_alipay_config['open'] != 1)
		{
			$this->error('商家还未配置支付宝！', U($name . $back));
		}
		if (empty($payinfo))
		{
			$this->error('订单不能为空', U($name . $back));
		}
		else
		{
			$order = M('Product_cart')->where(array('id' => $payinfo['id']))->find();
			$this->do_order_pay($order);
		}
	}
	protected function do_order_pay($order)
	{
		$id = $order['id'];
		$order = M('Product_cart')->where(array('id' => $id))->find();
		$product_cart_list_model = M('product_cart_list')->where(array('cartid' => $id))->find();
		$product_model = M('product')->where(array('id' => $product_cart_list_model['productid']))->find();
		$this->redirect(U('Pay_m_alipay/dopay', array('token' => $order['token'], 'wecha_id' => $order['wecha_id'], 'success' => '', 'price' => $order['price'], 'ordername' => $product_model['name'], 'order_id' => $order['id'], 'out_trade_no' => $order['sn'], 'productid' => $product_cart_list_model['productid'])));
	}
	protected function sendSMS($user, $pass, $phone, $content)
	{
		$sms_plat = file_get_contents('http://api.smsbao.com/sms?u=' . $user . '&p=' . $pass . '&m=' . $phone . '&c=' . urlencode($content));
	}
	protected function sendEMAIL($to, $name, $subject = '', $body = '', $attachment = null, $config = array(), $ssl)
	{
		vendor('PHPMailer.class#phpmailer');
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = true;
		if ($ssl)
		{
			$mail->SMTPSecure = 'ssl';
		}
		else
		{
			$mail->SMTPSecure = '';
		}
		$mail->Host = $config['SMTP_HOST'];
		$mail->Port = $config['SMTP_PORT'];
		$mail->Username = $config['SMTP_USER'];
		$mail->Password = $config['SMTP_PASS'];
		$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
		$replyEmail = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
		$replyName = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
		$mail->AddReplyTo($replyEmail, $replyName);
		$mail->Subject = $subject;
		$mail->MsgHTML($body);
		$mail->AddAddress($to, $name);
		if (is_array($attachment))
		{
			foreach ($attachment as $file)
			{
				is_file($file) && $mail->AddAttachment($file);
			}
		}
		return $mail->Send() ? true : $mail->ErrorInfo;
	}
// 生成excel
    protected function generate_xls($keynames, $data, $name='office2003', $ext = '2003') {
        $keys = array_keys($keynames);
        $titles = array_values($keynames);
        $xlsx[] = $keynames;
        foreach($data as $rs) {
            $xlsx[] = $rs;
        }
		
        vendor('phpexcel', '', '.class.php');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("PHPExcel")
                                     ->setLastModifiedBy("PHPExcel")
                                     ->setTitle("PHPExcel reports")
                                     ->setSubject("PHPExcel reports")
                                     ->setDescription("PHPExcel document for Office 2003 XLS, generated at ".date('Y-m-d'))
                                     ->setKeywords("PHPExcel reports")
                                     ->setCategory("PHPExcel");
        foreach($xlsx as $index => $row){
            $i = $index + 1;
            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            foreach($keys as $key => $val){
                $ascii = chr(65+$key);
                $sheet->setCellValue($ascii.$i, " ".$row[$val]);
            }
        }
        $objPHPExcel->getActiveSheet()->setTitle($name);
        $objPHPExcel->setActiveSheetIndex(0);
        if($ext == '2007') {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');  
            header('Content-Disposition: attachment;filename="'.$name.'.xlsx"');  
            header('Cache-Control: max-age=0');  
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
            $objWriter->save('php://output');  
            exit;  
        } else {
            header('Content-Type: application/vnd.ms-excel');  
            header('Content-Disposition: attachment;filename="'.$name.'.xls"');  
            header('Cache-Control: max-age=0');  
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
            $objWriter->save('php://output');  
            exit;  
        }
    }

    // 解析excel
    protected function parse_xls($keynames,$file) {
        $keys = array_keys($keynames);
        $titles = array_values($keynames);
        vendor('phpexcel', '', '.class.php');
        if(file_exists($file)){
            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $current_sheet =$objPHPExcel->getSheet(0);      
            $all_column =$current_sheet->getHighestColumn();
            $all_row =$current_sheet->getHighestRow();
            $ret = array();  
            
            for($r = 2; $r <= $all_row; $r++) { 
                $rs = array();
                for($c = 'A'; $c <= $all_column; $c++){  
                    $SerialNum = $c.$r;
                    $content = $current_sheet->getCell($SerialNum)->getValue();
                    if(is_object($content)){  
                        $content = $content->__toString();  
                    }
                    $rs[] = $content; 
                }  
                $rs = array_combine($keys,$rs);
                $ret[] = $rs;
            }
        }
        return $ret;
    }	
}

?>