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


 <script src="<?php echo RES;?>/flash/FusionCharts.js" type="text/javascript"></script>
 <script src="<?php echo RES;?>/flash/MSLine.swf" language="javascript" type="text/javascript"></script>      

<div class="content">
        	<h4 class="cLineB">选择年份<select class="setting-period" name="year" id="year" onchange="doit($('#period').val())"><?php echo ($yearOption); ?></select> 选择月份&nbsp;&nbsp;<select class="setting-period" name="period" id="period" onchange="doit(this.value)">
                
            <option value="1" <?php if($month == 1): ?>selected<?php endif; ?>>1月</option>
            <option value="2" <?php if($month == 2): ?>selected<?php endif; ?>>2月</option>
            <option value="3" <?php if($month == 3): ?>selected<?php endif; ?>>3月</option>
            <option value="4" <?php if($month == 4): ?>selected<?php endif; ?>>4月</option>
            <option value="5" <?php if($month == 5): ?>selected<?php endif; ?>>5月</option>
            <option value="6" <?php if($month == 6): ?>selected<?php endif; ?>>6月</option>
            <option value="7" <?php if($month == 7): ?>selected<?php endif; ?>>7月</option>
            <option value="8" <?php if($month == 8): ?>selected<?php endif; ?>>8月</option>
            <option value="9" <?php if($month == 9): ?>selected<?php endif; ?>>9月</option>
            <option value="10" <?php if($month == 10): ?>selected<?php endif; ?>>10月</option>
            <option value="11" <?php if($month == 11): ?>selected<?php endif; ?>>11月</option>
            <option value="12" <?php if($month == 12): ?>selected<?php endif; ?>>12月</option>
            </select></h4>
                <script>
function doit(month){
location.href= '/index.php?g=User&m=Requerydata&a=index&token=<?php echo ($token); ?>&month='+month+'&year='+$('#year').val();
}
</script>
<div class="msgWrap">
       <table width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:20px 0; ">
 		<tbody>
 			<tr>
 				<td align="center" bgcolor="#f9f9f9">
					<div id="chartdiv1" align="center">
					</div>
					<script type="text/javascript">
						var chart = new FusionCharts("<?php echo RES;?>/flash/MSLine.swf", "ChartId", "996", "400", "0", "1");
						//chart.setTransparent("false");
						chart.setDataXML('<?php echo ($xml); ?>');
						//chart.setDataURL("data.html");
						chart.render("chartdiv1");
					</script>
 				</td>
			</tr>
                <tr>
 				<td align="center" bgcolor="#f9f9f9">
                  <div id="chartdiv2" align="center"></div>


 				</td>
				</tr>
 			</tbody>
 		</table>
            
          </div>
          <div class="msgWrap">
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="ListProduct">
 		<thead>
 			<tr>
				<th>日期</th>
 				<th style="display:none">3G网站浏览量</th>
                <th>文本请求数</th>
 				<th>图文请求数</th>
				<th>语音请求数</th>
				<th>营销/电商请求</th>
				
				<th>关注人数</th>				
				<th>取消关注人数</th> 
				<th>总请求数/日</th>
 				</tr>
 			</thead>
 		<tbody>
           </tbody>
		   <tfoot>
             <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo (date('Y-m-d',$list["time"])); ?></td>
					<td style="display:none"><?php echo ($list["3g"]); ?></td>
					<td><?php echo ($list["textnum"]); ?></td>
					<td><?php echo ($list["imgnum"]); ?></td>
					<td><?php echo ($list["videonum"]); ?></td>
					<td><?php echo ($list["other"]); ?></td>					
					<td><?php echo ($list["follownum"]); ?></td>
					<td><?php echo ($list["unfollownum"]); ?></td>											 
					<td><?php echo $list['3g']+$list['textnum']+$list['imgnum']+$list['videonum']+$list['other']?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tfoot> 			
 		</table>            
          </div>  
        </div>

  <div style="display:none">
<link href="tpl/static/simpleboot/themes/flat/theme.min.css" rel="stylesheet">
</div>