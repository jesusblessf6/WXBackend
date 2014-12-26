<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> <?php echo ($f_siteTitle); ?> <?php echo ($f_siteName); ?></title>
<meta name="keywords" content="<?php echo ($f_metaKeyword); ?>" />
<meta name="description" content="<?php echo ($f_metaDes); ?>" />
<meta http-equiv="MSThemeCompatible" content="Yes" />
<script>var SITEURL='';</script>
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />
<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>
</head>
<body id="nv_member" class="pg_CURMODULE">
<link href="<?php echo RES;?>/css/style.css?id=100" rel="stylesheet" type="text/css" />
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
<div class="topbg">
<div class="top">
<div class="toplink">
<style>
.topbg{BACKGROUND-IMAGE: url(<?php echo RES;?>/images/top.png);BACKGROUND-REPEAT: repeat-x; height:124px; box-shadow:0 0 10px #000;-moz-box-shadow:0 0 10px #000;-webkit-box-shadow:0 0 10px #000;}
.top {
	MARGIN: 0px auto; WIDTH: 988px; HEIGHT: 124px;
}

.top .toplink{ height:27px; line-height:27px; color:#999; font-size:12px;}
.top .toplink .welcome{ float:left;}
.top .toplink .memberinfo{ float:right;}
.top .toplink .memberinfo a{ color:#999;}
.top .toplink .memberinfo a:hover{ color:#F90}
.top .toplink .memberinfo a.green{ background:none; color:#0C0}

.top .logo {WIDTH: 990px;COLOR: #333; height:70px;  FONT-SIZE:16px; PADDING-TOP:25px}
.top h1{ font-size:25px; margin-top:20px; float:left; width:230px; margin:0; padding:0;}
.top .navr {WIDTH:750px; float:right; overflow:hidden; margin-top:10px;}
.top .navr ul{ width:850px;}
.navr LI {TEXT-ALIGN:center;FLOAT: left;HEIGHT:32px;FONT-SIZE:1em;width:103px; margin-right:5px;}
.navr LI A {width:103px;TEXT-ALIGN:center; LINE-HEIGHT:30px; FLOAT: left;HEIGHT:32px;COLOR: #333; FONT-SIZE: 1em;TEXT-DECORATION: none
}
.navr LI A:hover {BACKGROUND: url(<?php echo RES;?>/images/navhover.gif) center no-repeat;color:#009900;}
.navr LI.menuon {BACKGROUND: url(<?php echo RES;?>/images/navon.gif) center no-repeat; display:block;width:103px;HEIGHT:32px;}
.navr LI.menuon a{color:#FFF;}
.navr LI.menuon a:hover{BACKGROUND: url(img/navon.gif) center no-repeat;}
.banner{height:200px; text-align:center; border-bottom:2px solid #ddd;}
.hbanner{ background: url(img/h2003070126.jpg) center no-repeat #B4B4B4;}
.gbanner{ background: url(img/h2003070127.jpg) center no-repeat #264C79;}
.jbanner{ background: url(img/h2003070128.jpg) center no-repeat #E2EAD5;}
.dbanner{ background: url(img/h2003070129.jpg) center no-repeat #009ADA;}
.nbanner{ background: url(img/h2003070130.jpg) center no-repeat #ffca22;}
</style>


<script src="./tpl/static/jquery-1.4.2.min.js" type="text/javascript"></script>

<div id="content" style="margin-top:80px; margin-left:15px;">
  <div id="content-header">
  </div>
<style>
.usercontent ul li{
float:none;
line-height:50px;
padding-left:10px;
}
input{border: 1px solid #DDDDDD;height:30px;width:200px;margin-left:10px;}
.new-btn-login{
    background-color: transparent;
    background-image: url('<?php echo RES;?>/images/img/new-btn-fixed.png');
    border: medium none;
	border:1px solid red;
	
}
.new-btn-login{
    background-position: 0 -198px;
    width: 82px;
	color: #FFFFFF;
    font-weight: bold;
    height: 28px;
    line-height: 28px;
    padding: 1px 10px 0px 8px;
	
}
.new-btn-login:hover{
	background-position: 0 -167px;
}
.bottonbox{
border: 1px solid #D74C00;
padding: 1px;
display: inline-block;
}
</style>
<script>

$(function(){
var price=new Array();
		<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>price[<?php echo ($p["id"]); ?>]=<?php echo ($p["price"]); ?>;<?php endforeach; endif; else: echo "" ;endif; ?>
	$('#group').change(function(){		
		
$('#price').val(price[$('#group').val()]*$('#num').val());
	});
	$('#num').change(function(){		
		
$('#price').val(price[$('#group').val()]*$('#num').val());
	});
});
</script>
<div class="usercontent">
<ul>
<form action="<?php echo U('Alipay/recharge');?>" method="post">
	<li> 
		<b>充值　选项: </b>
		<select name="gid" style="margin-left:10px;" id="group">
			<?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><option value="<?php echo ($group["id"]); ?>" <?php if($_SESSION['gid'] == $group['id']): ?>selected="selected"<?php endif; ?>><?php echo ($group["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		<select name="num" style="margin-left:10px;" id="num">
			<option value="1">1个月</option>
			<option value="2">2个月</option>
			<option value="3">3个月</option>
			<option value="4">4个月</option>
			<option value="5">5个月</option>
			<option value="6">6个月</option>
			<option value="7">7个月</option>
			<option value="8">8个月</option>
			<option value="9">9个月</option>
			<option value="10">10个月</option>
			<option value="11">11个月</option>
			<option value="12">12个月</option>		
		</select>
    </li>
	<li> <b>充值用户名: </b><input type="text" name="uname" value="<?php echo (session('uname')); ?>" size="60" style="padding-left:5px;" > <b>充值帐号,默认即可请勿修改</b></li>
	<li> <b>账户余额: </b><input type="text" style="border:none;width:30px;" name="moneybalance" value="<?php echo ($thisUser["moneybalance"]); ?>" id="needmoneybalanceprice" size="10" disabled> 元<b></b></li>
	<li> <b>充值金额: </b><input type="text" name="price" value="<?php echo ($user["price"]); ?>" id="price" size="60" readonly="readonly" style="padding-left:5px;"  > <b>先择对应的充值选项,价格自动生成</b></li>
	<li><button class="btn btn-primary" type="submit" style="text-align:center;">确 认</button></li>
</ul>
        <div class="clr"></div>
      </div>
          <div class="cLine">
            <div class="pageNavigator right">
              <div class="pages"></div>
            </div>
            <div class="clr"></div>
          </div>
        </div>
        
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <!--底部-->
  	</div>



<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>