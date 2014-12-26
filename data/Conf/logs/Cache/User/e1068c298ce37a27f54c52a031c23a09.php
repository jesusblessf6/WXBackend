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



<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />

<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/cymain.css" />

<script src="/tpl/static/artDialog/jquery.artDialog.js?skin=default"></script>

<script src="/tpl/static/artDialog/plugins/iframeTools.js"></script>

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />

<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>

<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>

<script src="<?php echo RES;?>/js/date/WdatePicker.js"></script>

<script type="text/javascript" src="<?php echo RES;?>/js/formCheck/formcheck.js"> </script>

<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
 <script>
	function ccolumns(value){
		if(value=='none'){
			$('.feiyin').css('display','none');
			$('.laoyang').css('display','none');
		}
		if(value=='feiyin'){
			$('.feiyin').css('display','');
			$('.laoyang').css('display','none');
		}
		if(value=='laoyang'){
			$('.feiyin').css('display','none');
			$('.laoyang').css('display','');
		}
	}
</script>
<script>

	KindEditor.ready(function(K){

		var editor = K.editor({

			allowFileManager:true

		});

		K('#upload_pic').click(function() {

			editor.loadPlugin('image', function() {

				editor.plugin.imageDialog({

					fileUrl : K('#pic').val(),

					clickFn : function(url, title) {

						if(url.indexOf("http") > -1){

							K('#pic').val(url);

						}else{

							K('#pic').val("<?php echo C('site_url');?>"+url);

						}

						editor.hideDialog();

					}

				});

			});

		});

	})

</script>
<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#content1', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : false,
items : [
'source','undo','clearhtml','hr',
'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
'insertunorderedlist', '|', 'emoticons', 'image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut']
});
});
</script>



<script>



var editor;
KindEditor.ready(function(K) {
editor = K.create('#description', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [

'source','undo','clearhtml','hr',

'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',

'insertunorderedlist', '|', 'emoticons', 'image','link', 'unlink','baidumap','lineheight','table','anchor','preview','print','template','code','cut']

});



});

</script>

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

<div class="content" style="width:98%; background:none; margin-left:25px; border:none; margin-bottom:30px; margin-top:30px;" >

<div class="cLineB">


<span class="FAQ"></span>
<div class="tab">

		<ul>

		<a href="<?php echo U('Jiudian/index',array('token'=>$token));?>"><li class="current tabli" id="tab0">酒店管理</li></a>

		<a href="<?php echo U('Jiudian/infos',array('token'=>$token,'pid'=>$set['id']));?>"><li class="tabli" id="tab2">订单管理</li></a>

		<a href="<?php echo U('Jiudian/setcin',array('token'=>$token,'pid'=>$set['id']));?>"><li class="tabli" id="tab2">房间设置</li></a>

		<a href="<?php echo U('Jiudian/setinfo',array('token'=>$token,'pid'=>$set['id']));?>"><li class="tabli" id="tab2">表单设置</li></a>

		</ul>

	</div>

<div class="clr"></div>

</div>



   <form class="form" method="post" id="form" action="" enctype="multipart/form-data"> 

<?php if($isUpdate == 1): ?><input type="hidden" name="id" value="<?php echo ($set["id"]); ?>" /><?php endif; ?>

    <div class="msgWrap bgfc"> 

     <table class="userinfoArea" style=" margin:0;" border="0" cellspacing="0" cellpadding="0" width="100%"> 

      <tbody> 

       

	   <tr> 

        <th><span class="red">*</span>关键词：</th>

        <td><input type="text" name="keyword" id="keyword" value="<?php echo ($set["keyword"]); ?>" class="px" style="width:400px;" /></td> 

       </tr>

	   <tr> 

        <th ><span class="red">*</span>标题：</th> 

        <td><input  type="text" id="name" name="title" value="<?php echo ($set["title"]); ?>" class="px require" style="width:400px;" /></td> 

       </tr> 

	   

	   <tr> 

            <th><span class="red"></span>订单页头部图片：</th>
            <td><input type="text" name="topic" value="<?php echo ($set["topic"]); ?>" id="pic" class="px" style="width:400px;"  readonly="readonly"/>
              <script src="<?php echo STATICS;?>/upyun.js"></script>
              <a href="###" onclick="upyunPicUpload('pic',720,400,'<?php echo ($token); ?>')" class="ChooseImage">上传</a> <a href="###" onclick="viewImg('pic')" class="ChooseImage" class="ChooseImage">预览</a></td>
       </tr>

	   <tr>

	   <th>是否调用LBS信息：</th>

	   <td><?php if($arr == ''): ?><input type="radio" name="lbs" value="1" checked="true" /><?php else: ?><input type="radio" name="lbs" value="1" /><?php endif; ?><font size="4px">调用</font> &nbsp; <?php if($arr == ''): ?><input type="radio" name="lbs" value="0" /><?php else: ?><input type="radio" name="lbs" value="0" checked="true" /><?php endif; ?><font size="4px">自己填写</font></td>

	   </tr>

	   <?php if($arr == ''): ?><tr name="lbb"><?php else: ?><tr name="lbb" style="display:none" ><?php endif; ?>

        <th><span class="red">*</span>选择酒店地址</th>

        <td><select name="cid" id="cid" onchange='javascript:ShowInfo(this.value);' style="width:412px;" class="px">

					<?php if(is_array($arr)): $k = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($k % 2 );++$k;?><option value="<?php echo ($i["catid"]); ?>"><?php echo ($i["address"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

			</select>

		</td> 

	   </tr>

	   <?php if($arr == ''): ?><tr name="lbss" style="display:none"><?php else: ?><tr name="lbss"><?php endif; ?>

        <th><span class="red">*</span>酒店电话：</th>

        <td><input type="text" name="phone" value="<?php echo ($set["phone"]); ?>" class="px" style="width:400px;" /></td> 

	   </tr>

	   <?php if($arr == ''): ?><tr name="lbss" style="display:none"><?php else: ?><tr name="lbss"><?php endif; ?>

        <th><span class="red"></span>酒店地址：</th>

        <td><input type="text" name="address" value="<?php echo ($set["address"]); ?>" class="px" style="width:400px;" /></td> 

       </tr>

	   <?php if($arr == ''): ?><tr name="lbss" style="display:none"><?php else: ?><tr name="lbss"><?php endif; ?> 

        <th><span class="red">*</span>经纬度：</th> 

        <td>经度 <input type="text" id="longitude"  name="longitude" size="14" class="px" value="<?php echo ($set["longitude"]); ?>" /> 纬度 <input type="text" name="latitude" size="14" id="latitude" class="px" value="<?php echo ($set["latitude"]); ?>" /> <a href="###" onclick="setlatlng($('#longitude').val(),$('#latitude').val())" class="ChooseImage">在地图中查看/设置</a></td> 

       </tr>

<!-- 	   <?php if(is_array($arr)): $k = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($k % 2 );++$k; if(($act == '') AND ($i['catid'] == 0)): ?><tr name="lbbb" id="la<?php echo ($k); ?>">

	   <?php else: ?><tr name="lbbb" id="la<?php echo ($k); ?>" style="display:none"><?php endif; ?>

        <th><span class="red">*</span>酒店电话：</th>

        <td><input type="text" name="phone" value="<?php echo ($i["phone"]); ?>" class="px" style="width:400px;" /></td> 

	   </tr>

	   <?php if(($act == '') AND ($i['catid'] == 0)): ?><tr name="lbbb" id="lb<?php echo ($k); ?>">

	   <?php else: ?><tr name="lbbb" id="lb<?php echo ($k); ?>" style="display:none"><?php endif; ?>

        <th><span class="red"></span>酒店地址：</th>

        <td><input type="text" name="address" value="<?php echo ($i["address"]); ?>" class="px" style="width:400px;" /></td> 

       </tr>

	   <?php if(($act == '') AND ($i['catid'] == 0)): ?><tr name="lbbb" id="lc<?php echo ($k); ?>">

	   <?php else: ?><tr name="lbbb" id="lc<?php echo ($k); ?>" style="display:none"><?php endif; ?>

        <th><span class="red">*</span>经纬度：</th> 

        <td>经度 <input type="text" id="longitude"  name="longitude" size="14" class="px" value="<?php echo ($i["longitude"]); ?>" /> 纬度 <input type="text"  name="latitude" size="14" id="latitude" class="px" value="<?php echo ($i["latitude"]); ?>" /> <a href="###" onclick="setlatlng($('#longitude').val(),$('#latitude').val())" class="ChooseImage">在地图中查看/设置</a></td> 

       </tr><?php endforeach; endif; else: echo "" ;endif; ?> -->

		<TR>

			<th><span class="red">*</span>订房时间：</th>

			<td><input type="input" class="px" id="statdate" value="<?php if($set['statdate'] != ''): echo ($set["statdate"]); else: echo date('Y-m-d',mktime(0, 0, 0, date("m") , date("d"), date("Y"))); endif; ?>" onClick="WdatePicker()" name="statdate" />                

			到

			<input type="input" class="px" id="enddate" value="<?php if($set['enddate'] != ''): echo ($set["enddate"]); else: echo date('Y-m-d',mktime(0, 0, 0, date("m") , date("d")+3, date("Y"))); endif; ?>" name="enddate" onClick="WdatePicker()"  /> 

			</td>

		</TR>

	   <tr> 

        <th ><span class="red">*</span>版权：</th> 

        <td><input  type="text" id="copyright" name="copyright" value="<?php echo ($set["copyright"]); ?>" class="px require" style="width:400px;" /></td> 

       </tr> 
       <tr> 
        <th><span class="red"></span>短信通知：</th> 
        <td><input type="text" id="tel" name="tel" value="<?php echo ($set["tel"]); ?>" placeholder="如：13808080808   "   class="px require" style="width:400px;" />&nbsp;&nbsp;开启&nbsp;<input type="radio" name="tel_status" <?php if($set["tel_status"] == 1): ?>checked<?php endif; ?> id="statu-1" value="1">&nbsp;&nbsp;
		关闭&nbsp;<input type="radio" name="tel_status" <?php if($set["tel_status"] == 0): ?>checked<?php endif; ?> id="statu-0" value="0"></td> 
       </tr> 
       <tr> 
        <th><span class="red"></span>邮件通知：</th> 
        <td><input type="text" id="email" name="email" value="<?php echo ($set["email"]); ?>" placeholder="如：1234@qq.com   "   class="px require" style="width:400px;" />&nbsp;&nbsp;开启&nbsp;<input type="radio" name="email_status" <?php if($set["email_status"] == 1): ?>checked<?php endif; ?> id="statu-1" value="1">&nbsp;&nbsp;
		关闭&nbsp;<input type="radio" name="email_status" <?php if($set["email_status"] == 0): ?>checked<?php endif; ?> id="statu-0" value="0"></td> 
       </tr> 
		<tr>
		<th width="100">打印机品牌：</th>
		<td>
		<select name="printtype" onchange="ccolumns(this.value)">
		<option value="none" <?php if($set["printtype"] == ''): ?>selected<?php endif; ?>>请选择</option>
		<option value="laoyang" <?php if($set["printtype"] == 'laoyang'): ?>selected<?php endif; ?>>老杨</option>
		<option value="feiyin" <?php if($set["printtype"] == 'feiyin'): ?>selected<?php endif; ?>>飞印</option>
		</select>
		</td>
		</tr>
		<tr class="feiyin" <?php if($set["printtype"] != 'feiyin'): ?>style="display:none"<?php endif; ?>><th><span class="red">*</span>商户代码：</th><td><input type="text" class="px" name="memberCode" value="<?php echo ($set["memberCode"]); ?>" tabindex="1" size="35"> <span class="red">&nbsp;&nbsp;&nbsp;登录飞印后在"API集成"-&gt;"获取API集成信息"获取</span></td></tr>
		<tr class="feiyin" <?php if($set["printtype"] != 'feiyin'): ?>style="display:none"<?php endif; ?>><th><span class="red">*</span>API 密钥：</th><td><input type="text" class="px" name="feiyin_key" value="<?php echo ($set["feiyin_key"]); ?>" tabindex="1" size="25"> <span class="red">&nbsp;&nbsp;&nbsp;获取方法同上</span></td></tr>
		<tr class="feiyin" <?php if($set["printtype"] != 'feiyin'): ?>style="display:none"<?php endif; ?>><th><span class="red">*</span>设备编码：</th><td><input type="text" class="px" name="deviceNo" value="<?php echo ($set["deviceNo"]); ?>" tabindex="1" size="25"> <span class="red">&nbsp;&nbsp;&nbsp;通过打印机后面的激活按键获取，为16位数字，例如"4600365507768327"</span></td></tr>
		<tr class="feiyin" <?php if($set["printtype"] != 'feiyin'): ?>style="display:none"<?php endif; ?>><th>设备编码1：</th><td><input type="text" class="px" name="deviceNo1" value="<?php echo ($set["deviceNo1"]); ?>" tabindex="1" size="25"> <span class="red">&nbsp;&nbsp;&nbsp;第二台无线打印设备</span></td></tr>
		<tr class="feiyin" <?php if($set["printtype"] != 'feiyin'): ?>style="display:none"<?php endif; ?>><th>设备编码2：</th><td><input type="text" class="px" name="deviceNo2" value="<?php echo ($set["deviceNo2"]); ?>" tabindex="1" size="25"> <span class="red">&nbsp;&nbsp;&nbsp;第三台无线打印设备</span></td></tr>		
		<tr class="laoyang" <?php if($set["printtype"] != 'laoyang'): ?>style="display:none"<?php endif; ?>><th>设备编码：</th><td><input type="text" class="px" name="bwdeviceNo" value="<?php echo ($set["bwdeviceNo"]); ?>" tabindex="1" size="25"> <span class="red">&nbsp;&nbsp;&nbsp;老杨无线打印设备</span></td></tr>		
		<tr>
		<th>打印联数：</th>
			<td>
				1联&nbsp;<input type="radio" name="printpage" <?php if($set["printpage"] == 1): ?>checked<?php endif; ?> id="statu-1" value="1">&nbsp;&nbsp;
				2联&nbsp;<input type="radio" name="printpage" <?php if($set["printpage"] == 2): ?>checked<?php endif; ?> id="statu-0" value="2">&nbsp;&nbsp;
				3联&nbsp;<input type="radio" name="printpage" <?php if($set["printpage"] == 3): ?>checked<?php endif; ?> id="statu-0" value="3">
			</td>	
		</tr>
		<tr>
		<th>打印开关：</th>
			<td>
				开启&nbsp;<input type="radio" name="print_status" <?php if($set["print_status"] == 1): ?>checked<?php endif; ?> id="statu-1" value="1">&nbsp;&nbsp;
				关闭&nbsp;<input type="radio" name="print_status" <?php if($set["print_status"] == 0): ?>checked<?php endif; ?> id="statu-0" value="0">
			</td>	
		</tr>
       <tr> 
        <th>在线支付：</th>
        <td>
	        <select name="payonline">
	        <option value="0"  <?php if(0 == $set['payonline']): ?>selected<?php endif; ?> >不要</option>
	        <option value="1"  <?php if(1 == $set['payonline']): ?>selected<?php endif; ?> >需要</option>
	        </select>
        </td> 
       </tr>	
        <TR>

			<TH valign="top"><label for="info">订房说明：</label></TH>

            <TD><textarea name="info" id="content1"  rows="5" style="width:590px;height:160px"><?php echo ($set["info"]); ?></textarea></TD>

        </TR>  

		

       <tr>         

       <th>&nbsp;</th>

       <td>

		<!--input type="hidden" name="time" value="<?php echo ($set["time"]); ?>" /-->

       <button type="submit" class="btnGreen">保存</button> &nbsp; <a href="<?php echo U($type.'/index',array('token'=>$token));?>" class="btnGray vm">取消</a></td> 

       </tr> 

	   

      </tbody> 

     </table> 

     </div>

    

   </form> 

  </div> 

<script language="javascript">

$(function(){

	$("#form").valid([

	{ name:"name",simple:"名称",require:true},

	{ name:"keyword",simple:"关键词",require:true}，

		

	],true,true);



});

</script>

<script language="javascript">

function ShowInfo(Id){

	

	$('[name="lbbb"]').attr("style","display:none");

	$("#la"+Id).attr("style","");

	$("#lb"+Id).attr("style","");

	$("#lc"+Id).attr("style","");

	

}

</script>

<script language="javascript">

$("input[type='radio']").click(function(){

	var i = $(this).val();

	if(i==1){

		$('[name="lbss"]').attr("style","display:none");

		$('[name="lbb"]').attr("style","");

		$("#la1").attr("style","");

		$("#lb1").attr("style","");

		$("#lc1").attr("style","");

	}else{

		$('[name="lbss"]').attr("style","");

		$('[name="lbb"]').attr("style","display:none");

		$('[name="lbbb"]').attr("style","display:none");

	}

})

</script>

  <div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>