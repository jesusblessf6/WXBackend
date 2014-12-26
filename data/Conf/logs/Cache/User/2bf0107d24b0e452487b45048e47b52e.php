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



<script src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>

<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" />
<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js" type="text/javascript"></script>
 <style>
.cLine {
    overflow: hidden;
    padding: 5px 0;
  color:#000000;
}
.alert {
padding: 8px 35px 0 10px;
text-shadow: none;
-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #f9edbe;
border: 1px solid #f0c36d;
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
color: #333333;
margin-top: 5px;
}
.alert p {
margin: 0 0 10px;
display: block;
}
.alert .bold{
font-weight:bold;
}
 </style>

<script>
var editor;
KindEditor.ready(function(K) {
editor = K.create('#intro', {
resizeType : 1,
allowPreviewEmoticons : false,
allowImageUpload : true,
uploadJson : '/index.php?g=User&m=Upyun&a=kindedtiropic',
items : [
'source','undo','plainpaste','wordpaste','clearhtml','quickformat','selectall','fullscreen','fontname', 'fontsize','subscript','superscript','indent','outdent','|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline','hr']
});
});
</script>

<script>
    jQuery(document).ready(function(){
      jQuery("#formID").validationEngine();
    });
</script>

<div class="content">
<link rel="stylesheet" href="<?php echo STATICS;?>/jQValidationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="./tpl/User/default/common/css/cymain.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script src="<?php echo RES;?>/js/date/WdatePicker.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/jQValidationEngine/js/languages/jquery.validationEngine-zh_CN.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo STATICS;?>/jQValidationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<style>
    #myClas ul li {
    margin-left: 5px;
    }

    .tooltips span {
display: none;
}
    .tooltips:hover span {
        text-align:left;
        display: block;
        position: absolute;
        margin:0 auto;
        width: 310px;
        border: 1px solid #CCC;
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
        border-radius: 6px;
        padding: 10px;
        font-size: 12px;
        line-height: 22px;
        color: #333;
    }
</style>

<div class="msgWrap form">
<ul id="tags" style="margin:0;">
<li class="<?php if((ACTION_NAME == 'tenant')): ?>selectTag<?php endif; ?> " id="tab0"><a href="<?php echo U('Market/tenant',array('token'=>$token,'type'=>'market'));?>">商家管理</a></li>
<li class="<?php if(ACTION_NAME == 'cate'): ?>selectTag<?php endif; ?> " id="tab2"><a href="<?php echo U('Market/cate',array('token'=>$token,'type'=>'market'));?>">商户分类</a></li>
<li class="<?php if(ACTION_NAME == 'park'): ?>selectTag<?php endif; ?> " id="tab2"><a href="<?php echo U('Market/park',array('token'=>$token,'type'=>'market'));?>">停车场管理</a></li>
<li class="<?php if(ACTION_NAME == 'area'): ?>selectTag<?php endif; ?> " id="tab2"><a href="<?php echo U('Market/area',array('token'=>$token,'type'=>'market'));?>">区域管理</a></li>
<li class="<?php if(ACTION_NAME == 'index'): ?>selectTag<?php endif; ?> " id="tab2"><a href="<?php echo U('Market/index',array('token'=>$token,'type'=>'market'));?>">商圈设置</a></li>
<li class="<?php if(ACTION_NAME == 'wap_nav'): ?>selectTag<?php endif; ?> " id="tab2"><a href="<?php echo U('Market/wap_nav',array('token'=>$token,'type'=>'market'));?>">商圈首页板块设置</a></li>
</ul>
</div>
  <div class="cLineB">
    <h4>请设置商圈信息</h4>
    <a href="<?php echo U('Market/tenant',array('token'=>$token));?>" class="btn btn-primary btn_submit  J_ajax_submit_btn right" style="margin-top:-27px">返回商家</a> 
</div>


<div class="msgWrap">
  <form class="form" method="post" id="formID" action=""   enctype="multipart/form-data">
<table class="userinfoArea" style=" margin:20px 0 0 0;" border="0" cellspacing="0" cellpadding="0" width="100%">
 <tbody>
<tr>
            <th valign="top"><span class="red">*</span><label for="keyword">商圈名称：</label></th>
            <td><input type="text" class="px" id="mtitle" value="<?php echo ($market['name']); ?>" name="name" style="width:400px" data-validation-engine="validate[required,minSize[2],maxSize[50]]" data-errormessage-value-missing="必填项">
              <br>
            </td>
            <td></td>
          </tr>
 <tr>
  <th valign="top"><span class="red">*</span><label for="keyword">触发关键词</label></th>
  <td><input type="text" class="px" id="keyword" value="<?php echo ($market['keyword']); ?>" name="keyword"  data-validation-engine="validate[required,minSize[1],maxSize[20]]" data-errormessage-value-missing="必填项">
         10个字以内         </td>
  <td></td>
</tr>         
<tr>
  <th valign="top"><span class="red">*</span><label for="keyword">图文消息标题</label></th>
  <td><input type="text" class="px" id="title" value="<?php echo ($market['title']); ?>" name="title" style="width:400px"  data-validation-engine="validate[required,minSize[2],maxSize[50]]" data-errormessage-value-missing="必填项">
                  </td>
  <td></td>
</tr> 

<tr>
  <th valign="top"><span class="red">*</span><label for="keyword">图文消息封面</label></th>
  <td>
    <input type="text" class="px" id="logo_pic" value="<?php if($market['logo_pic'] == ''): echo ($default); else: echo ($market['logo_pic']); endif; ?>" name="logo_pic"  style="width:350px" data-validation-engine="validate[required,minSize[2],maxSize[100]]" data-errormessage-value-missing="必填项">
<script src="<?php echo STATICS;?>/upyun.js"></script>
<a href="javascript:void(0);" onclick="upyunPicUpload('logo_pic',360,200,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
<a href="javascript:void(0);" onclick="viewImg('logo_pic')">预览</a> [360*200] 

  </td>
</tr> 
<tr>
  <th valign="top"><span class="red">*</span><label for="keyword">联系电话</label></th>
  <td><input type="text" class="px" id="tel" value="<?php echo ($market['tel']); ?>" name="tel"  data-validation-engine="validate[required,minSize[1],maxSize[20]]" data-errormessage-value-missing="必填项">
         联系电话 </td>
  <td></td>
</tr> 
<tr>
  <th valign="top"><span class="red">*</span><label for="keyword">商圈首页模板：</label></th>
  <td>
  <input type="text" id="market_index_tpl" class="px"  value="<?php if($market['market_index_tpl'] > 0): ?>已选择模板<?php echo ($market['market_index_tpl']); else: endif; ?>"  placeholder="点击右侧按钮选择"  size="40" data-validation-engine="validate[required,minSize[2],maxSize[25]]" data-errormessage-value-missing="必填项"  />
  <a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="chooseTpl('tpid','market_index_tpl',1)">选择模板</a>
  <?php if($market['market_index_tpl'] > 0): ?><a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="viewTpl()">预览</a><?php endif; ?>
  <input type="hidden" class="px" value="<?php echo ($market['market_index_tpl']); ?>" id="tpid" name="market_index_tpl" style="width:250px">
  <script>
    function viewTpl(){
      var tid = $('#tpid').val();
      chooseTpl(tid,'',2);
    }
  </script>
  </td>
</tr>
<!--
<tr>
  <th valign="top"><label for="keyword">商户首页模板：</label></th>
  <td>
  <input type="text" id="tenant_index_tpl" class="px" value="<?php if($market['tenant_index_tpl'] > 0): ?>默认模板<?php else: ?>点击右侧按钮选择<?php endif; ?>" disabled size="40"  />
  <a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="chooseTpl('conid','tenant_index_tpl',1)">选择模板</a>
  <a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="viewTpl1()">预览</a>
  <input type="hidden" class="px" value="116" id="conid" name="tenant_index_tpl" style="width:250px">
  <script>
    function viewTpl1(){
      var tid = $('#conid').val();
      chooseTpl(tid,'',2);
    }
  </script>
  </td>
</tr>-->
<tr>
  <th valign="top"><span class="red">*</span><label for="keyword">商家列表页模板：</label></th>
  <td>
  <input type="text" id="tenant_list_tpl" class="px"  value="<?php if($market['tenant_list_tpl'] > 0): ?>已选择模板<?php echo ($market['tenant_list_tpl']); else: endif; ?>"  size="40" placeholder="点击右侧按钮选择" data-validation-engine="validate[required,minSize[2],maxSize[25]]" data-errormessage-value-missing="必填项"  />
  <a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="chooseTpl('conttpid','tenant_list_tpl',1)">选择模板</a>
<?php if($market['tenant_list_tpl'] > 0): ?><a class="btn btn-primary btn_submit  J_ajax_submit_btn" onclick="viewTpl2()">预览</a><?php endif; ?>
  <input type="hidden" class="px" value="<?php echo ($market['tenant_list_tpl']); ?>" id="conttpid" name="tenant_list_tpl" style="width:250px">
  <!--商户首页默认-->
  <input type="hidden" class="px" value="116" id="conid" name="tenant_index_tpl" style="width:250px">
  <script>
    function viewTpl2(){
      var tid = $('#conttpid').val();
      chooseTpl(tid,'',2);
    }
  </script>
  </td>
</tr>
        <tr>
            <th valign="top"><span class="red">*</span><label for="keyword">商圈地址</label></th>
            <td><input type="text" class="px" id="address" value="<?php echo ($market['address']); ?>" name="address" style="width:400px" data-validation-engine="validate[required,minSize[5],maxSize[100]]" data-errormessage-value-missing="必填项">
              <br>
            </td>
            <td></td>
          </tr>
          <tr>
            <th valign="top"><span class="red">*</span><label for="keyword">经纬地址</label></th>
            <td><div class="control-group">
              <label class="control-label" for="suggestId"></label>
              <div class="controls">
         经度 <input type="text" id="longitude"  name="longitude" size="14" class="px" value="<?php echo ($market['longitude']); ?>" data-validation-engine="validate[required]" data-errormessage-value-missing="必选项"/> 
         纬度 <input type="text"  name="latitude" size="14" id="latitude" class="px" value="<?php echo ($market['latitude']); ?>" /> <a href="javascript:void(0);" onclick="setlatlng($('#latitude').val(),$('#latitude').val())">在地图中查看/设置</a>
         </div>

              </div></div>
            </td>
          </tr>

<tr>
  <th valign="top"><label for="keyword">交通路线</label></th>
  <td><input type="text" class="px" id="line" value="<?php echo ($market['line']); ?>" name="line" style="width:400px" >
                  </td>
  <td></td>
</tr>  


<tr>
  <th>幻灯片</th>
  <td>
    <table class="quanjing" border="0" cellspacing="0" cellpadding="0" width="750">
        <tr>
          <td>     
            <a href="###" onclick="addLink('link_1',0)" class="btn btn-primary btn_submit  J_ajax_submit_btn">添加</a>  
            <input type="text" class="px" id="link_1" value="<?php echo ($slide['link_0']); ?>" name="link[]"  placeholder="幻灯片链接" style="width:85px">   
          </td>
          <td>
            <a href="###" onclick="addLink('link_2',0)" class="btn btn-primary btn_submit  J_ajax_submit_btn">添加</a>
            <input type="text" class="px" id="link_2" value="<?php echo ($slide['link_1']); ?>" name="link[]"  placeholder="链接地址" style="width:85px">            
          </td>
          <td>
            <a href="###" onclick="addLink('link_3',0)" class="btn btn-primary btn_submit  J_ajax_submit_btn">添加</a>
            <input type="text" class="px" id="link_3" value="<?php echo ($slide['link_2']); ?>" name="link[]"  placeholder="链接地址" style="width:85px">         
          </td>
          <td>
            <a href="###" onclick="addLink('link_4',0)" class="btn btn-primary btn_submit  J_ajax_submit_btn">添加</a>
            <input type="text" class="px" id="link_4" value="<?php echo ($slide['link_3']); ?>" name="link[]"  placeholder="幻灯片链接" style="width:85px">    
          </td>
          <td>
            <a href="###" onclick="addLink('link_5',0)" class="btn btn-primary btn_submit  J_ajax_submit_btn">添加</a>
            <input type="text" class="px" id="link_5" value="<?php echo ($slide['link_4']); ?>" name="link[]"  placeholder="幻灯片链接" style="width:85px">       
          </td>
        </tr>
      <!--
        <tr>
          <td><input type="text" class="px" id="link_1" value="<?php echo ($slide['title_0']); ?>" name="slid_title[]"  placeholder="幻灯片标题" style="width:133px"></td>
          <td><input type="text" class="px" id="link_1" value="<?php echo ($slide['title_1']); ?>" name="slid_title[]"  placeholder="幻灯片标题" style="width:133px"></td>
          <td><input type="text" class="px" id="link_1" value="<?php echo ($slide['title_2']); ?>" name="slid_title[]"  placeholder="幻灯片标题" style="width:133px"></td>
          <td><input type="text" class="px" id="link_1" value="<?php echo ($slide['title_3']); ?>" name="slid_title[]"  placeholder="幻灯片标题" style="width:133px"></td>
          <td><input type="text" class="px" id="link_1" value="<?php echo ($slide['title_4']); ?>" name="slid_title[]"  placeholder="幻灯片标题" style="width:133px"></td>
        </tr>-->
        <tr id="slide">
          <td>
              <img id="slide_1_src"  style="width:145px;" src="<?php echo ($slide['slide_0']); ?>">  
          </td>
          <td>
              <img id="slide_2_src"  style="width:145px;" src="<?php echo ($slide['slide_1']); ?>">
          </td>
          <td>
              <img id="slide_3_src"  style="width:145px;" src="<?php echo ($slide['slide_2']); ?>">
          </td>
          <td>
              <img id="slide_4_src"  style="width:145px;" src="<?php echo ($slide['slide_3']); ?>">
          </td>
          <td>
              <img id="slide_5_src"  style="width:145px;" src="<?php echo ($slide['slide_4']); ?>">
          </td>
        </tr>
<script>
  $(function(){
    var slide = $('#slide img');
        slide.each(function(){
          if($(this).attr("src") == ''){
            $(this).css('display','none');
          }
        });
  });
</script>
        <tr>
          <td>
            <input type="text" class="px" id="slide_1" value="<?php echo ($slide['slide_0']); ?>" name="slide[]" placeholder="幻灯片" style="width:133px">
              
          </td>
          <td>
            <input type="text" class="px" id="slide_2" value="<?php echo ($slide['slide_1']); ?>" name="slide[]" placeholder="幻灯片" style="width:133px">
                   
          </td>
          <td>
            <input type="text" class="px" id="slide_3" value="<?php echo ($slide['slide_2']); ?>" name="slide[]" placeholder="幻灯片" style="width:133px">
               
          </td>
          <td>
            <input type="text" class="px" id="slide_4" value="<?php echo ($slide['slide_3']); ?>" name="slide[]" placeholder="幻灯片" style="width:133px">
            
            
          </td>
          <td>
            <input type="text" class="px" id="slide_5" value="<?php echo ($slide['slide_4']); ?>" name="slide[]" placeholder="幻灯片" style="width:133px">
                 
          </td>
        </tr>
        <tr>
          <td>
            <a href="javascript:void(0);" onclick="upyunPicUpload('slide_1',640,320,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
            <a href="javascript:void(0);" onclick="viewImg('slide_1')">预览</a>[640*320]

            
          </td>
          <td>
            <a href="javascript:void(0);" onclick="upyunPicUpload('slide_2',640,320,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
            <a href="javascript:void(0);" onclick="viewImg('slide_2')">预览</a>[640*320]
          </td>
          <td>
            <a href="javascript:void(0);" onclick="upyunPicUpload('slide_3',640,320,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
            <a href="javascript:void(0);" onclick="viewImg('slide_3')">预览</a>[640*320]
          </td>
          <td>
            <a href="javascript:void(0);" onclick="upyunPicUpload('slide_4',640,320,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
            <a href="javascript:void(0);" onclick="viewImg('slide_4')">预览</a>[640*320]
          </td>
          <td>
            <a href="javascript:void(0);" onclick="upyunPicUpload('slide_5',640,320,'<?php echo ($token); ?>')" class="btn btn-primary btn_submit  J_ajax_submit_btn">上传</a>
            <a href="javascript:void(0);" onclick="viewImg('slide_5')">预览</a>[640*320]
          </td>
        </tr>
    </table>
  </td>
</tr>
<script>
  $(function(){


  });
</script>




<script>
function setlatlng(longitude,latitude){
  art.dialog.data('longitude', longitude);
  art.dialog.data('latitude', latitude);
  art.dialog.open('<?php echo U('Map/setLatLng',array('token'=>$token,'id'=>$id));?>',{lock:false,title:'设置经纬度',width:600,height:400,yesText:'关闭',background: '#000',opacity: 0.87});
}
</script>

          <tr>
            <th valign="top"><label for="keyword">商圈简介</label></th>
            <td>
              <textarea class="px" id="intro" name="intro" style="width: 400px; height: 200px;" ><?php echo ($market['intro']); ?></textarea>
            </td>
            <td></td>
          </tr>

  <tr>
  <th></th>
  <td>
    <input type="hidden" name="market_id" value="<?php echo ($market['market_id']); ?>">
    <button type="submit" name="button" class="btn btn-primary btn_submit  J_ajax_submit_btn">保存</button>
    <div class="clr"></div>
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