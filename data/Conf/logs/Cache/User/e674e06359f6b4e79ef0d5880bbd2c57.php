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
<h4 class="left">分支机构</h4>
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
</script>

</form>
</div>
<div class="clr"></div>
</div>
<!--tab start-->
<div class="tab">
<ul>
<li class="tabli" id="tab0"><a href="<?php echo U('Company/index',array('token'=>$token));?>">公司信息</a></li>
<li class="<?php if($isBranch == 1): ?>current<?php endif; ?> tabli" id="tab2"><a href="<?php echo U('Company/branches',array('token'=>$token,'isBranch'=>1));?>">分支机构</a></li>
</ul>
</div>
<!--tab end-->
<div class="msgWrap">
<form method="post" action="" id="info">
<div class="cLine">
<div class="pageNavigator left"> <a href="<?php echo U('Company/index',array('token'=>$token,'isBranch'=>1));?>" title="" class="btn btn-primary btn_submit  J_ajax_submit_btn"><img src="<?php echo RES;?>/images/icons/add.png" class="vm">添加</a></div>
<div class="clr"></div>
</div>

<table class="ListProduct" border="0" cellspacing="0" cellpadding="0" width="100%">
<thead>
<tr>
<th class="select" style="display:none"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
<th width="70">名称</th>
<th width="80">电话</th>
<th width="80">状态</th>
<th width="160">地址</th>
<th width="280">分支登陆地址</th>
<th width="80" class="norightborder">操作</th>
</tr>
</thead>
<tbody>
<tr></tr>
<?php if(is_array($branches)): $i = 0; $__LIST__ = $branches;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><tr>
<td style="display:none"><input type="checkbox" value="<?php echo ($o["id"]); ?>" class="cbitem" name="id_<?php echo ($i); ?>"></td>
<td><?php echo ($c["name"]); ?></td>
<td><?php echo ($c["tel"]); ?></td>
<td><?php if($c['display'] == 1): ?>显示<?php else: ?>隐藏<?php endif; ?></td>
<td><?php echo ($c["address"]); ?></td>
<td><?php echo ($c["url"]); ?></td>
<td class="norightborder"><a href="<?php echo U('Company/index',array('token'=>$token,'id'=>$c['id'],'isBranch'=>1));?>">修改</a> <a href="javascript:drop_confirm('您确定要删除吗?', '<?php echo U('Company/delete',array('token'=>$token,'id'=>$c['id'],'isBranch'=>1));?>');">删除</a></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
<input type="hidden" name="token" value="<?php echo ($_GET['token']); ?>" />
</form>

   <script>
function showIntroDetail(id){
	art.dialog.open('<?php echo U('Product/orderInfo',array('token'=>$token,'dining'=>$isDining));?>&id='+id,{lock:false,title:'订单详情',width:700,height:420,yesText:'关闭',background: '#000',opacity: 0.87});
}
</script>
</div>
<div class="cLine">
<div class="pageNavigator right">
<div class="pages"><?php echo ($page); ?></div>
</div>
<div class="clr"></div>
</div>
</div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>