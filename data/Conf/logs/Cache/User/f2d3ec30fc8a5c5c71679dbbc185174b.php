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
<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>
 
	
        <div class="content">
<div class="cLineB">
<h4 class="left">公司信息</h4>
<div class="searchbar right">
<form method="post" action="">

<script>
function selectall(name) {
	var checkItems=$('.cbitem');
	if ($("#check_box").attr('checked')==false) {
		$.each(checkItems, function(i,val){
			val.checked=false;
		});
		
	} else {
		$.each(checkItems, function(i,val){
			val.checked=true;
		});
	}
}
function setlatlng(longitude,latitude){
	art.dialog.data('longitude', longitude);
	art.dialog.data('latitude', latitude);
	// 此时 iframeA.html 页面可以使用 art.dialog.data('test') 获取到数据，如：
	// document.getElementById('aInput').value = art.dialog.data('test');
	art.dialog.open('<?php echo U('Map/setLatLng',array('token'=>$token,'id'=>$id));?>',{lock:false,title:'设置经纬度',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.87});
}
</script>
<?php if(($parentid != '0') and ($parentid != '')): ?><a href="<?php echo U('Product/cats',array('token'=>$token,'parentid'=>$parentCat['parentid']));?>" class="btn btn-primary btn_submit  J_ajax_submit_btn" style="margin-top:-27px">返回上</a><?php endif; ?>
</form>
</div>
<div class="clr"></div>
</div>

<!--tab start-->
<div class="tab">
<ul>
<li class="<?php if($isBranch != 1): ?>current<?php endif; ?> tabli" id="tab0"><a href="<?php echo U('Company/index',array('token'=>$token));?>">公司信息</a></li>
<li class="<?php if($isBranch == 1): ?>current<?php endif; ?> tabli" id="tab2"><a href="<?php echo U('Company/branches',array('token'=>$token,'isBranch'=>1));?>">分支机构</a></li>
</ul>
</div>
<!--tab end-->
<div class="msgWrap">
 <form class="form" method="post" id="form" name="form" action=""> 
<?php if($isUpdate == 1): ?><input type="hidden" name="id" value="<?php echo ($set["id"]); ?>" /><?php endif; ?>
<input type="hidden" name="discount" id="discount" value="<?php echo ($set["discount"]); ?>" />
    <div class="msgWrap bgfc"> 
     <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"> 
      <tbody> 
       <tr> 
        <th><span class="red">*</span>名称：</th> 
        <td><input type="text" id="name" name="name" value="<?php echo ($set["name"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr>
       <tr> 
        <th><span class="red">*</span>简称：</th> 
        <td><input type="text" id="shortname" name="shortname" value="<?php echo ($set["shortname"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr>
       <tr> 
        <th><span class="red">*</span>电话：</th> 
        <td><input type="text" id="tel" name="tel" value="<?php echo ($set["tel"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr> 
       <tr> 
        <th><span class="red">*</span>手机：</th> 
        <td><input type="text" id="mp" name="mp" value="<?php echo ($set["mp"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr> 
       <?php if($isBranch == 1): ?><tr> 
        <th><span class="red">*</span>分支登陆账号：</th> 
        <td><input type="text" id="username" name="username" value="<?php echo ($set["username"]); ?>" class="px require" style="width:200px;" /></td> 
       </tr> 
       <tr> 
        <th><span class="red">*</span>分支登陆密码：</th> 
        <td><input type="password" id="password" name="password" value="" class="px require" style="width:200px;" />(修改时如果不想修改密码请留空)</td> 
       </tr> 
       <tr> 
        <th><span class="red"></span>状态：</th> 
        <td>
        <input id="radio1" class="radio" type="radio" name="display" value="1"  <?php if($set["display"] == 1): ?>checked="checked"<?php endif; ?> > <label for="radio1">显示</label>
        <input class="radio" id="radio2" type="radio" name="display" value="0"  <?php if($set["display"] == 0): ?>checked="checked"<?php endif; ?> > <label for="radio2">隐藏</label>
        </td>
       </tr><?php endif; ?>
       <tr> 
        <th><span class="red">*</span>地址：</th> 
        <td><input type="text" id="address" name="address" value="<?php echo ($set["address"]); ?>" class="px require" style="width:400px;" /></td> 
       </tr> 
       <tr> 
        <th><span class="red">*</span>Logo地址：</th> 
        <td><input type="text" id="logourl" name="logourl" value="<?php echo ($set["logourl"]); ?>" class="px require" style="width:400px;" /> <script src="/tpl/static/upyun.js"></script><a href="###" onclick="upyunPicUpload('logourl',700,420,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a> <a href="###" onclick="viewImg('logourl')">预览</a></td> 
       </tr>
        <tr> 
        <th><span class="red">*</span>经纬度：</th> 
        <td>经度 <input type="text" id="longitude"  name="longitude" size="14" class="px" value="<?php echo ($set["longitude"]); ?>" /> 纬度 <input type="text"  name="latitude" size="14" id="latitude" class="px" value="<?php echo ($set["latitude"]); ?>" /> <a href="###" onclick="setlatlng($('#longitude').val(),$('#latitude').val())">在地图中查看/设置</a></td> 
       </tr>
       <tr> 
        <th><span class="red"></span>顺序：</th> 
        <td><input type="text" id="taxis" name="taxis" value="<?php echo ($set["taxis"]); ?>" class="px require" style="width:100px;" /></td> 
       </tr>
        <TR>
                  <TH valign="top"><label for="info">图文详细页内容：</label></TH>
                  <TD><textarea name="intro" id="intro"  rows="5" style="width:590px;height:360px;display:none;"><?php echo ($set["intro"]); ?></textarea>

                  </TD>
                </TR>  
       <tr>         
       <th>&nbsp;</th>
       <td>
       <?php if($isBranch == 1): ?><input type="hidden" name="isbranch" value="1" /><?php endif; ?>
      <input type="hidden" name="token" value="<?php echo $token;?>" />
       <button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">保存</button></td> 
       </tr> 
      </tbody> 
     </table> 
     </div>
    
   </form> 


</div>
<div class="cLine">

<div class="clr"></div>
</div>
</div>
<script language="javascript">
$(function(){

	$("#form").valid([
	{ name:"name",simple:"名称",require:true},
	{ name:"mp",type:"mobile",message:"手机号输入不正确"}
	
	],true,true);

})
</script>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>