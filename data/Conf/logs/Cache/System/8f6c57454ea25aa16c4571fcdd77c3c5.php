<?php if (!defined('THINK_PATH')) exit();?>﻿<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo C('site_name');?>-laoyang后台管理系统</title>
<meta name="keywords" content="<?php echo C('site_name');?>-laoyang后台管理系统" />
<meta name="description" content="<?php echo C('site_name');?>-laoyang后台管理系统" />
<link href="<?php echo RES;?>/images/style.css" type="text/css" rel="stylesheet">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo RES;?>/js/frame.js" type=text/javascript></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>
<script type="text/javascript" src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>
</head>
<body class="showmenu">
<table width="100%" height="100%" border=0 cellpadding="0" cellSpacing=0>
  <tr>
    <td>
    <div id="header">
    <!--后台左边logo扩展开始-->
    <div class="left1">
			<li><img src="tpl/System/common/images/logo.png"></li>	
		</div>
       <!--后台左边logoend--> 
    <div class="tm">
    	<ul>
			<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav_val): $mod = ($i % 2 );++$i;?><li class="nav" id="link<?php echo ($nav_val['id']); ?>">
			<a href="#" onClick="JumpleftFrame('<?php echo U('System/menu',array('pid'=>$nav_val['id'],'level'=>2,'title'=>rawurlencode ($nav_val['title'])));?>',<?php echo ($nav_val['id']); ?>);"><?php echo ($nav_val['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>     
    </div>
    <!--右边开始-->
      <div class="login">
			<li>您好：<b><?php echo (session('username')); ?></b> ，欢迎使用<?php echo C('site_name');?>！</li>	
			<li><a href="/index.php" target="_blank"> 首页</a></li>
			<li><a href="/index.php?g=User&m=Index&a=index" target="_blank">用户中心</a></li>
			<li><a href="<?php echo U('Admin/logout');?>">[退出]</a></li>
		</div>
<!--end-->
    </div>
    <i class="tico"></i>
</div></td>
  </tr>
  <tr>
    <td height="100%" bgcolor="#ffffff"><table width="100%" height="100%" cellpadding="0" cellSpacing=0 border=0 borderColor="#f0f0f0">
        <tbody>
          <tr>
            <td noWrap id="frmTitle" bgcolor="#f0f0f0" width="200"><IFRAME frameBorder="0" id="left" name="left" scrolling="auto" src="<?php echo U('System/menu');?>" style="HEIGHT:100%;VISIBILITY:inherit;width:200px;Z-INDEX:2" allowtransparency="true"></IFRAME></td>
            <td></td>
            <td width="100%"><table height="100%" cellSpacing=0 cellPadding=0 width="100%" align="right" border=0>
                <tbody>
                  <tr>
                    <td align=right><IFRAME id="main" name="main" style="width: 100%; HEIGHT: 100%" src="<?php echo U('System/main');?>" frameBorder=0></IFRAME></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </tbody>
      </table></td>
  </tr>
</table>
</body>
</html>
      </table></td>
  </tr>
</table>
</body>
</html>