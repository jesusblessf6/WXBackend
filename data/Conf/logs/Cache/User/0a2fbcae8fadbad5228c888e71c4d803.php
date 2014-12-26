<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title> <?php echo C('site_title');?> <?php echo C('site_name');?></title>

<meta name="keywords" content="<?php echo C('keyword');?>" />

<meta name="description" content="<?php echo C('content');?>" />

<meta http-equiv="MSThemeCompatible" content="Yes" />

<script>var SITEURL='';</script>

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style_2_common.css?BPm" />

<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css" />

<link href="<?php echo RES;?>/css/stylet.css" rel="stylesheet" type="text/css" />

<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">

<script src="<?php echo RES;?>/js/common.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo RES;?>/js/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/js/main.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/js/global.js"></script>

  <link rel="stylesheet" href="/tpl/User/default/common/css/cymain.css" />

  <link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />

<script src="/tpl/static/upyun.js"></script>



<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>



<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>



<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />







<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>







<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>







<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>



<script>

var editor;

KindEditor.ready(function(K) {

editor = K.create('#content2', {

resizeType : 1,

allowPreviewEmoticons : false,

allowImageUpload : true,

uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',

items : [

        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',

        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',

        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',

        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',

        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',

        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',

        'flash', 'media',  'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',

        'anchor', 'link', 'unlink', '|', 'about'

],

afterBlur: function(){this.sync();}

});

});

</script>

<script>

var editor;

KindEditor.ready(function(K) {

editor = K.create('#content1', {

resizeType : 1,

allowPreviewEmoticons : false,

allowImageUpload : true,

uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',

items : [

        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',

        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',

        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',

        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',

        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',

        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',

        'flash', 'media','table', 'hr', 'emoticons', 'baidumap', 'pagebreak',

        'anchor', 'link', 'unlink', '|', 'about'

],

afterBlur: function(){this.sync();}

});

});

</script>

<script>

var editor;

KindEditor.ready(function(K) {

editor = K.create('#content', {

resizeType : 1,

allowPreviewEmoticons : false,

allowImageUpload : true,

uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',

items :[

        'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',

        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',

        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',

        'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',

        'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',

        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',

        'flash', 'media', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',

        'anchor', 'link', 'unlink', '|', 'about'

],

afterBlur: function(){this.sync();}

});

});

</script>

<script>

var editor;

KindEditor.ready(function(K) {

editor = K.create('#intro', {

resizeType : 1,

allowPreviewEmoticons : false,

allowImageUpload : true,

uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',

items : [

'source','undo','clearhtml','hr',

'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

'insertunorderedlist', '|', 'emoticons','fontname', 'fontsize','forecolor','hilitecolor','bold','image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut', 'music', 'video','map'],

afterBlur: function(){this.sync();}

});

});

</script>





<style>

.content {

 background:none; margin-left:30px; margin-top:20px; border:none; margin-bottom:30px;

}

</style>

</head>



<body>


<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />
<div class="content" style="width:98%; background:none; margin-left:25px; border:none; margin-bottom:30px; margin-top:30px;" >
  <div class="cLineB">
<h4>支付接口配置</h4>
</div>
<!--tab start-->
<div class="tab">
<ul>
<li class='<?php if(MODULE_NAME == 'Wxpay'): ?>current<?php endif; ?> tabli' id="tab1"><a href="<?php echo U('Wxpay/index');?>">微信支付</a></li>
<li class='<?php if(MODULE_NAME == 'Alipay_config'): ?>current<?php endif; ?> tabli' id="tab2"><a href="<?php echo U('Alipay_config/index');?>">免签支付宝</a></li>
<li class='<?php if(MODULE_NAME == 'Wapalipay'): ?>current<?php endif; ?> tabli' id="tab3"><a href="<?php echo U('Wapalipay/index');?>">手机支付宝</a></li>
<li class='<?php if(MODULE_NAME == 'Tenpay'): ?>current<?php endif; ?> tabli' id="tab1"><a href="<?php echo U('Tenpay/index');?>">财付通</a></li>
<li class='<?php if(MODULE_NAME == 'Waptenpay'): ?>current<?php endif; ?> tabli' id="tab1"><a href="<?php echo U('Waptenpay/index');?>">手机财付通</a></li>
<li class='<?php if(MODULE_NAME == 'Offlinepay'): ?>current<?php endif; ?> tabli' id="tab1"><a href="<?php echo U('Offlinepay/index');?>">线下支付</a></li>
<?php if($thisUser[baofustate] == '1'): ?><li class='<?php if(MODULE_NAME == 'Baofu'): ?>current<?php endif; ?> tabli' id="tab1"><a href="<?php echo U('Baofu/index');?>">银联支付</a></li><?php endif; ?>
</ul>
</div>
<!--tab end-->                
<div class="msgWrap bgfc" style="margin-top:10px;">
<form class="form" method="post" action="" enctype="multipart/form-data">
    <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%">
    <tbody>
    <tr>
    <th>支付开关：</th>
    <td><select name="enabled" id="enabled">
    <option value="0" <?php if($payset["enabled"] == 0): ?>selected<?php endif; ?>>关闭支付</option>
    <option value="1" <?php if($payset["enabled"] == 1): ?>selected<?php endif; ?>>开启支付</option>
    </select> 开启支付后，商城等b2c功能将有支付功能</td>
    </tr>
    <tr>
    <th width="120">财付通partnerId：</th>
    <td><input type="text" name="partnerId" value="<?php echo ($pay_config["partnerId"]); ?>" class="px" style="width:350px;"> <span class="red">*</span></td>
    </tr>
    <tr>
    <th>财付通partnerKey：</th>
    <td><input type="text" name="partnerKey" value="<?php echo ($pay_config["partnerKey"]); ?>" class="px" style="width:350px;"> <span class="red">*</span></td>
    </tr>
    <tr><th>&nbsp;</th>
    <td>
    <button type="submit" name="button" class="btnGreen">保存</button>
    </td>
    </tr>
    </tbody>
    </table>
    </form>
</div> 
</div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>