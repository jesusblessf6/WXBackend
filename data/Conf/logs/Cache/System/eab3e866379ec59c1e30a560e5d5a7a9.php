<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>站点配置</title>
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery-1.7.2.min.js" type="text/css" rel="stylesheet">
<link href="<?php echo RES;?>/images/jquery.form.js" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<style>
.set_top{background:url('<?php echo RES;?>/images/set_top.png');height:60px;}
.set_top li{font-weight: bold;float:left;width:98px;line-height:60px;text-align: center;background:url('<?php echo RES;?>/images/set_top_li.png');}
#set_top_li_bg{background:url('<?php echo RES;?>/images/set_top_li_hover.png');}
</style>
<div class="set_top">
	<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php if(ACTION_NAME == $vo['name']): ?>id="set_top_li_bg"<?php endif; ?>><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>6,'level'=>3));?>"><?php echo ($vo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div id="artlist">
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">
 <form id="myform" action="<?php echo U('Site/insert');?>" method="post">
	 <tr> 
	   <td  height="48" align="right"><strong>心跳间隔：</strong></td>
	   <td><input type="text" name="interval" value="<?php echo C('interval');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;</span>
        </td>
	   <td>单位为秒</td>
      </tr>
	 <tr> 
      <td  height="48" align="right"><strong>心跳地址：</strong></td>
      <td><input type="text" name="posturl" value="<?php echo C('posturl');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;</span></td>
      <td>负载均衡用,一般为自身URL</td>
     </tr>
      <tr> 
      <td  height="48" align="right"><strong>跳转地址：</strong></td>
      <td><input type="text" name="jumpurl" value="<?php echo C('jumpurl');?>" class="ipt" size="45" /><span>&nbsp;&nbsp;</span></td>
      <td>认证成功后跳转地址</td>
     </tr>
	 <tr >
	   <td width="182" height="48" align="right" valign="center" ><strong>是否启用第三方认证： </strong></td>
	   <td width="127" valign="center" >
	     <input type="radio" name="hotspot_enable" value="true" <?php if(C('hotspot_enable')==='true') echo checked; ?> />开启
	     <input type="radio" name="hotspot_enable" value="false" <?php if(C('hotspot_enable')==='false') echo checked; ?> />关闭
	     </td>
	   <td width="283" valign="center" > </td>
      </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>第三方认证地址： </strong></td>
    <td width="127" valign="center" ><input type="text" name="hotspot_authurl" value="<?php echo C('hotspot_authurl');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" > </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>认证超时时间： </strong></td>
    <td width="127" valign="center" ><input type="text" name="hotspot_timeout" value="<?php echo C('hotspot_timeout');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" >单位为秒 </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>强制超时时间： </strong></td>
    <td width="127" valign="center" ><input type="text" name="hotspot_kickout" value="<?php echo C('hotspot_kickout');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" > 
      单位为秒 </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>域名白名单： </strong></td>
    <td width="127" valign="center" ><textarea name="hotspot_whiteurl" style="width:450px;height:60px;margin:5px 0 5px 0;" class="ipt"><?php echo C('hotspot_whiteurl');?></textarea></td>
    <td width="283" valign="center" >多个域名请用,&nbsp;隔开 </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>IP白名单： </strong></td>
    <td width="127" valign="center" >
    <textarea style="width:450px;height:60px;margin:5px 0 5px 0;" class="ipt" name="hotspot_whiteip" type="text"><?php echo C('hotspot_whiteip');?></textarea></td>
    <td width="283" valign="center" >多个IP请用,&nbsp;隔开 </td>
    </tr>

  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>是否启用JS注入： </strong></td>
    <td width="127" valign="center" >
    <input type="radio" name="inject_enable" value="true"      <?php if(C('inject_enable')==='true') echo checked; ?> >开启
       <input type="radio" name="inject_enable" value="false" <?php if(C('inject_enable')==='false') echo checked; ?> >关闭
       </td>
    <td width="283" valign="center" > </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>Js注入的地址： </strong></td>
    <td width="127" valign="center" ><input type="text" name="inject_jsurl" value="<?php echo C('inject_jsurl');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" >注意不需要输入http:// </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>是否启用劫持： </strong></td>
    <td width="127" valign="center" >
     <input type="radio" name="hijack_enable" value="true"      <?php if(C('hijack_enable')==='true') echo checked; ?> >开启
       <input type="radio" name="hijack_enable" value="false" <?php if(C('hijack_enable')==='false') echo checked; ?> >关闭
     </td>
    <td width="283" valign="center" > </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>劫持到的地址： </strong></td>
    <td width="127" valign="center" ><input type="text" name="hijack_targeturl" value="<?php echo C('hijack_targeturl');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" >注意不需要输入http:// </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>被劫持的地址： </strong></td>
    <td width="127" valign="center" ><input type="text" name="hijack_hijackurl" value="<?php echo C('hijack_hijackurl');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" >注意不需要输入http://&nbsp;多个域名请用,&nbsp;隔开 </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>是否启用推送： </strong></td>
    <td width="127" valign="center" >
      <input type="radio" name="pushing_enable" value="true"      <?php if(C('pushing_enable')==='true') echo checked; ?> >开启
       <input type="radio" name="pushing_enable" value="false" <?php if(C('pushing_enable')==='false') echo checked; ?> >关闭 </td>
    <td width="283" valign="center" > </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>推送的间隔： </strong></td>
    <td width="127" valign="center" ><input type="text" name="pushing_interval" value="<?php echo C('pushing_interval');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" > </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>推送的URL： </strong></td>
    <td width="127" valign="center" ><input type="text" name="pushing_url" value="<?php echo C('pushing_url');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" >注意不需要输入http:// </td>
    </tr>
  <tr >
    <td width="182" height="48" align="right" valign="center" ><strong>配置的版本号： </strong></td>
    <td width="127" valign="center" ><input type="text" name="cfgver" value="<?php echo C('cfgver');?>" class="ipt" size="45" /> </td>
    <td width="283" valign="center" > </td>
    </tr>
	<input type="hidden" name="files" value="Heartbeat.php" />
    <tr> 
      <td height="48" colspan="3">
		  <div id="addkey"></div>
		  <div style="padding-left:100px;">
			<input type="submit" value="保存设置" />
		  </div>
	  </td>
    </tr>
	</form>
</table>


</div>
</body>
</html>