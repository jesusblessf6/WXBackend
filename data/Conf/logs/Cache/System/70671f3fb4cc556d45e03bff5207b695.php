<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C('site_name');?>后台首页</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body style="background:none">
<div class="content">
<div class="box">
	<h3><?php echo C('site_name');?>更新消息</h3>
    <div class="con dcon">
    <div class="update">
    <p>服务器环境：[<?php echo PHP_OS; ?>]<?php echo $_SERVER[SERVER_SOFTWARE];?> MySql:<?php echo mysql_get_server_info(); ?> php:<?php echo PHP_VERSION; ?></p>
    <p>服务器IP：<?php echo $_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT']; ?></p>
    <p>当前网站语言：<?php echo getenv("HTTP_ACCEPT_LANGUAGE"); ?></p>
    <p>被屏蔽的函数：<?php echo get_cfg_var("disable_functions")?get_cfg_var("disable_functions"):"无" ; ?></p>
    <p>系统版本：2.9 <a href="javascript:alert('升级请移驾到：http://www.fenxiangweb.com/')" class="isub">检查更新</a></p>
    </div>
    <ul class="myinfo">
    <li><p class="red">您的程序版本为：<?php echo C('site_name');?>多用户微信营销系统</p><span>[ 授权版本：商业版 (终身使用权) ]</span></li>
	</ul>
    </div>
</div>
<!--/box-->
<div class="box">
	<h3>laoyang官方动态</h3>
    <div class="con dcon">
    <div class="kjnav">
    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">使用帮助</a><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">技术售后</a><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">安装指导</a><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">联系我们</a><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes">升级咨询</a>
    </div>
    <ul class="myinfo kjinfo">
   <li class="title">售后服务范围</li>
<script type="text/javascript" src="http://www.fenxiangweb.com/api.php?mod=js&bid=24"></script>
	</ul>
    </div>
</div>

<!--/box-->
</div>
</body>
</html>