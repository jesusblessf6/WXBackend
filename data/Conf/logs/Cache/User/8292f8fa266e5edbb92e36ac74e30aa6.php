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


<div class="content" style="width:98%; background:none; margin-left:25px; border:none; margin-bottom:30px; margin-top:30px;" >
         
          <div class="cLineB">
  <div  class="quick-actions_homepage">

  </div>
              <h4 class="left">自定义回复信息</h4>
              <div class="clr"></div>
          </div>
          <div class="cLine">
              <div class="pageNavigator left">
  <a href='<?php echo U("Text/add");?>' title='新增文本自定义回复' class='btnGrayS vm bigbtn'><img src="<?php echo RES;?>/images/text.png" class="vm" />新增文本自定义回复</a>　
  <a href='<?php echo U("Img/add");?>' title='新增图文自定义回复' class='btnGrayS vm bigbtn'><img src="<?php echo RES;?>/images/pic.png" class="vm" />新增图文自定义回复</a>　
          
            </div>
  <div style="float:right;line-height:30px;">
	<form action="#" method="post">
	<input type="text" placeholder="请输入标题搜索词" value="<?php echo ($_POST['search']); ?>" class="px" name="search" />
	<button class="btnGrayS" style="height: 29px;">搜索</button>
	</form>
   </div>
            <div class="clr"></div>
			<div style="background:#fefbe4;border:1px solid #f3ecb9;color:#993300;padding:10px;margin-bottom:5px;font-size:12px;">温馨提示：修改排序时，首先填写好当前页面每篇文章的排序数值，点击“排序”按钮后整页统一保存。</div>
          </div>
          <div class="msgWrap">
            <TABLE class="ListProduct" border="0" cellSpacing="0" cellPadding="0" width="100%">
              <THEAD>
                <TR valign="top">
					<TH class="answer">标题</TH>
					<TH class="keywords">关键词</TH>
					
                    <TH  class="category" >分类</TH>
                    <TH class="time"><button class="btnGrayS" onclick="$('#sortform').submit()" >排序</button></TH>
                    <TH class="time">浏览次数</TH>
					<TH class="time">时间</TH>
					<TH class="edit norightborder">操作</TH>
                </TR>
              </THEAD>
              <TBODY>
                <TR></TR>
				<form action="<?php echo U("Img/editUsort");?>" method="post" id="sortform">
				<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "没有找到数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                  <td><div class="answer_text"><img src="<?php echo RES;?>/images/pic.png" class="vm" title="图文自定义内容"><?php echo ($vo["title"]); ?></div></td>
                  <td><?php echo ($vo["keyword"]); ?></td>
                  
                  <td><?php echo ($vo["classname"]); ?></td>
                  <td>
					<input type="number" style="border:1px solid #c9c9c9;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;" class="usort" name="usort<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["usort"]); ?>" />
					
				  </td>
                  <td><?php echo ($vo["click"]); ?></td>
                    <td><?php echo date('Y-m-d',$vo['uptatetime']); ?></td>
                   
                   <td class="norightborder">
				   <!--a target="ddd" href="<?php echo U('Wap/Index/content',array('token'=>$_SESSION['token'],'id'=>$vo['id']));?>">查看</a--> 
				   <a href="<?php echo U('Img/edit',array('id'=>$vo['id']));?>" title="编辑图文自定义回复">编辑</a>
				   <a href="<?php echo U('Img/del',array('id'=>$vo['id']));?>">删除</a></td>
          
                </tr><?php endforeach; endif; else: echo "没有找到数据" ;endif; ?>
					<input type="hidden" name="token" value="<?php echo ($_SESSION['token']); ?>" />
                </form>       
              </TBODY>
            </TABLE>
<style>
	.usort {
		width:45px;
		height:23px;
	}
</style>
           <script>
   function checkvotethis() {
var aa=document.getElementsByName('del_id[]');
var mnum = aa.length;
j=0;
for(i=0;i<mnum;i++){
if(aa[i].checked){
j++;
}
}
if(j>0) {
document.getElementById('info').submit();
} else {
alert('未选中任何文章或回复！')
}
}

			//edit-usort
			/*
					function editUsort(id){
						if(document.activeElement.id != 'usortinp'){
							var val = $(".usort-"+id).html();
							$(".usort-"+id).html('<input type="number" class="usort" id="usortinp" name="usort" value="'+val+'" onkeydown="if(event.keyCode==13){ upUsort('+id+',$(this).val());}" onblur="upUsort('+id+',$(this).val())" />');
							$("input[name=usort]").focus();
						}

						
					}
					
					function upUsort(id,b){
						$.ajax({
							url:'<?php echo U("Img/editUsort");?>',
							data:{"id":id,"v":b,"token":"<?php echo (session('token')); ?>"},
							type:'POST',
							dataType:'text',
							success:function(obj){
								if(obj != 'error'){
									$(".usort-"+id).html(obj);
								}else{
									$(".usort-"+id).html(b);
								}
							}
						});
						
					}
				*/
   </script>
          </div>
          <div class="cLine">
            <div class="pageNavigator right">
                 <div class="pages"><?php echo ($page); ?></div>
              </div>
            <div class="clr"></div>
          </div>
        </div>

        <div class="clr"></div>
      </div>
    </div>
  </div>
  <script>

function checkAll(form, name) {
for(var i = 0; i < form.elements.length; i++) {
var e = form.elements[i];
if(e.name.match(name)) {
e.checked = form.elements['chkall'].checked;
}
}
}


  </script>
  <!--底部-->
  	</div>
<div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>