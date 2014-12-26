<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>微信公众平台管理系统</TITLE>
<META charset=utf-8><LINK rel=stylesheet type=text/css 
href="<?php echo RES;?>/css/global.css"><LINK rel=stylesheet type=text/css 
 href="<?php echo RES;?>/css/main.css">
<link href="<?php echo RES;?>/css/account.css" rel="stylesheet" type="text/css">
<SCRIPT type=text/javascript src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?php echo RES;?>/js/global.js"></SCRIPT>
<SCRIPT type=text/javascript src="<?php echo RES;?>/js/account.js"></SCRIPT>
<META name=GENERATOR content="MSHTML 8.00.6001.18702"></HEAD>
<BODY><!--[if lte IE 9]>
<SCRIPT src="member_files/jquery.watermark-1.3.js"></SCRIPT>
<![endif]-->
<STYLE type=text/css>BODY {
	BACKGROUND:url(<?php echo RES;?>/images/main/main-bg.jpg) fixed no-repeat left top
}
HTML {
	BACKGROUND: url(<?php echo RES;?>/images/main/main-bg.jpg) fixed no-repeat left top
}
</STYLE>
<DIV id=iframe_page>
<DIV class=iframe_content><LINK rel=stylesheet type=text/css 
href="<?php echo RES;?>/css/account.css">
<SCRIPT type=text/javascript src="<?php echo RES;?>/js/account.js"></SCRIPT>
<SCRIPT language=javascript>$(document).ready(account_obj.index_init);</SCRIPT>
<DIV id=home>
<DIV class=welcome>
<DIV></DIV><SPAN><?php echo (session('uname')); ?></SPAN></DIV>


<DIV class=info>
<DIV class=member>
<DIV class=face><IMG src="<?php echo ($wecha["headerpic"]); ?>" style="width:116px; height:116px"></DIV>
<UL class=info_list>
  <LI><IMG src="<?php echo RES;?>/images/member_files/icon-0.png">公众账号：已绑定【<?php echo ($wecha["wxname"]); ?>】</LI>
  <LI><IMG src="<?php echo RES;?>/images/member_files/icon-1.png">帐号状态：<?php if(($userinfo["status"]) == "1"): ?>正常<?php else: ?>不正常<?php endif; ?>
</LI>
  <LI><IMG src="<?php echo RES;?>/images/member_files/icon-3.png">开通时间：<?php echo (date("Y-m-d",$thisUser["createtime"])); ?></LI>
  <LI><IMG src="<?php echo RES;?>/images/member_files/icon-4.png">到期时间：<?php echo (date("Y-m-d",$thisUser["viptime"])); ?></LI></UL></DIV>
  
<DIV class=data>
<DIV class=d0>
<H1><?php echo (($list["follownum"])?($list["follownum"]):0); ?></H1>
<H2>今日新增粉丝</H2></A></DIV>
<DIV class=d1>
<H1><?php echo (($list["3g"])?($list["3g"]):0); ?></H1>
<H2>今日官网访问</H2></A></DIV>
<DIV class=d2>
<H1><?php echo (($list["other"])?($list["other"]):0); ?></H1>
<H2>今日参与活动</H2></A></DIV>
<DIV class=d3>
<H1><?php echo $list['3g']+$list['textnum']+$list['imgnum']+$list['videonum']+$list['other']?></H1>
<H2>今日请求总量</H2></A></DIV></DIV>
<DIV class=clear></DIV></DIV>
<DIV class=list>
<DIV><IMG src="<?php echo RES;?>/images/member_files/list-app.png"></DIV>
<UL>
  <LI><A href="#" group="#"><IMG 
  src="<?php echo RES;?>/images/member_files/account.png"><BR>我的帐号</A></LI>
  <LI><A href="<?php echo U('User/Index/edit',array('token'=>$token));?>" group="wechat"><IMG 
  src="<?php echo RES;?>/images/member_files/wechat.png"><BR>我的微信</A></LI>
  <LI><A href="<?php echo U('Text/index',array('token'=>$token));?>" 
  group="wechat"><IMG src="<?php echo RES;?>/images/member_files/reply_keyword.png"><BR>关键字回复</A></LI>
  <!--<LI><A href="material_pic.html" group="material"><IMG 
  src="<?php echo RES;?>/images/member_files/material.png"><BR>素材管理</A></LI>-->
  <?php if($qx['3g'] == 1): ?><LI><A href="<?php echo U('Home/set',array('token'=>$token));?>" group="web"><IMG 
  src="<?php echo RES;?>/images/member_files/web.png"><BR>微官网管理</A></LI><?php else: endif; ?>
 <?php if($qx['wsc'] == 1): ?><LI><A href="<?php echo U('Product/index',array('token'=>$token));?>" group="shop"><IMG 
  src="<?php echo RES;?>/images/member_files/shop.png"><BR>微商城管理</A></LI><?php else: endif; ?>
 <?php if($qx['tg'] == 1): ?><LI><A href="<?php echo U('Groupon/index',array('token'=>$token));?>" group="app"><IMG 
  src="<?php echo RES;?>/images/member_files/tuan.png"><BR>微团购管理</A></LI><?php else: endif; ?>
  <?php if($qx['jyk'] == 1): ?><LI><A href="<?php echo U('Member/index',array('token'=>$token));?>" group="user"><IMG 
  src="<?php echo RES;?>/images/member_files/user.png"><BR>会员管理</A></LI><?php else: endif; ?>
 <?php if($qx['zxyy'] == 1): ?><LI><A href="<?php echo U('Yuyue/index',array('token'=>$token));?>" group="app"><IMG 
  src="<?php echo RES;?>/images/member_files/reserve.png"><BR>在线预约管理</A></LI><?php else: endif; ?>
  <?php if($qx['wdy'] == 1): ?><LI><A href="<?php echo U('Diaoyan/index',array('token'=>$token));?>" group="app"><IMG 
  src="<?php echo RES;?>/images/member_files/survey.png"><BR>微调研管理</A></LI><?php else: endif; ?>
  <?php if($qx['wxc'] == 1): ?><LI><A href="<?php echo U('Photo/index',array('token'=>$token));?>" group="app"><IMG 
  src="<?php echo RES;?>/images/member_files/albums.png"><BR>微相册管理</A></LI><?php else: endif; ?>
 <!-- <LI><A href="#" group="#"><IMG 
  src="<?php echo RES;?>/images/member_files/businesscard.png"><BR>微名片管理</A></LI>-->
  <!-- <LI><A href="qy_microbar.html" group="app"><IMG 
  src="<?php echo RES;?>/images/member_files/microbar.png"><BR>微吧管理</A></LI> -->
  <LI><A href="<?php echo U('Company/index',array('token'=>$token));?>" group="stores"><IMG 
  src="<?php echo RES;?>/images/member_files/stores.png"><BR>LBS门店定位</A></LI>
  <?php if($qx['ggk'] == 1): ?><LI><A href="<?php echo U('Guajiang/index',array('token'=>$token));?>" group="action"><IMG 
  src="<?php echo RES;?>/images/member_files/turntable.png"><BR>刮刮卡管理</A></LI><?php else: endif; ?>
  <?php if($qx['sgj'] == 1): ?><LI><A href="<?php echo U('LuckyFruit/index',array('token'=>$token));?>" group="action"><IMG 
  src="<?php echo RES;?>/images/member_files/fruit.png"><BR>水果达人管理</A></LI><?php else: endif; ?>
  <?php if($qx['dzp'] == 1): ?><LI><A href="<?php echo U('Lottery/index',array('token'=>$token));?>" group="action"><IMG 
  src="<?php echo RES;?>/images/member_files/scratch.png"><BR>欢乐大转盘</A></LI><?php else: endif; ?>
  </UL></DIV>
<DIV class=clear></DIV>
<DIV class=list>
<DIV><IMG src="<?php echo RES;?>/images/member_files/list-trade.png"></DIV>
<UL>
  <?php if($qx['hq'] == 1): ?><LI><A href="<?php echo U('Wedding/index',array('token'=>$token));?>" 
  group="shop"><IMG src="<?php echo RES;?>/images/member_files/app_wedding.png"><BR>微婚庆</A></LI><?php else: endif; ?>
  <?php if($qx['cy'] == 1): ?><LI><A href="<?php echo U('Repast/index',array('token'=>$token));?>" 
  group="shop"><IMG src="<?php echo RES;?>/images/member_files/app_catering.png"><BR>微餐饮</A></LI><?php else: endif; ?>
  <?php if($qx['fc'] == 1): ?><LI><A href="<?php echo U('Estate/index',array('token'=>$token));?>" 
  group="shop"><IMG src="<?php echo RES;?>/images/member_files/app_estate.png"><BR>微房产</A></LI><?php else: endif; ?>
  <?php if($qx['jd'] == 1): ?><LI><A href="<?php echo U('Jiudian/index',array('token'=>$token));?>" 
  group="shop"><IMG src="<?php echo RES;?>/images/member_files/app_hotels.png"><BR>微酒店</A></LI><?php else: endif; ?>
 <?php if($qx['yl'] == 1): ?><LI><A href="<?php echo U('Yiliao/index',array('token'=>$token));?>" 
  group="shop"><IMG src="<?php echo RES;?>/images/member_files/app_medical.png"><BR>微医疗</A></LI><?php else: endif; ?>
  <?php if($qx['qc'] == 1): ?><LI><A href="<?php echo U('Car/index',array('token'=>$token));?>" group="shop"><IMG 
  src="<?php echo RES;?>/images/member_files/app_car.png"><BR>微汽车</A></LI><?php else: endif; ?></UL></DIV></DIV></DIV>
<DIV>
<DIV style="DISPLAY: none">
<?php echo base64_decode(C('countsz'));?>
</DIV></DIV></DIV></BODY></HTML>