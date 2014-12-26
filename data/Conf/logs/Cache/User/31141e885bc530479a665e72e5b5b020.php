<?php if (!defined('THINK_PATH')) exit();?>﻿<style>
.msgWrap .control-group {
margin-bottom: 20px;
}
.msgWrap .control-label {
text-align: left;
width: 140px;
font-weight: bold;
padding-top: 5px;
float: left;
display: block;
margin-bottom: 5px;
}
.msgWrap .controls {
margin-left: 160px;
}
.msgWrap .form-actions {
padding: 19px 20px 20px 160px;
margin-top: 20px;
}
.span4, .span1, .option, .valid, .input-large{
	background: url(../images/px.png) repeat-x scroll 0 0 #FFFFFF;
    border-color: #848484 #E0E0E0 #E0E0E0 #848484;
    border-style: solid;
    border-width: 1px;
	border-radius: 2px 2px 2px 2px;
	padding:5px;
	width: 210px;
}
.alert {
padding: 8px 35px 0 10px;
text-shadow: none;
-webkit-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
-moz-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
background-color: #9FCCFC;
border: 1px solid #6BC1F1;
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
<link href="<?php echo RES;?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RES;?>/js/common.js"></script>
<div class="content" style="margin-left:30px; margin-top:20px; height:1000px">
<div class="usercontent">
<ul>
<li><a href="" class="btn btn-primary btn_submit  J_ajax_submit_btn" title="查看资金" >账户资金总数：<?php echo ($thisUser["money"]); ?></a></li>
<li class="addli"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" title="已消费资金数" href="" >已消费资金数：<?php echo ($thisUser["spend"]); ?></a></li>
<li class="addli"><a class="btn btn-primary btn_submit  J_ajax_submit_btn" title="添加微信公众号" onclick="location.href='<?php echo U('Index/add');?>';">添加微信公众号</a></li>
<li><a href="index.php?g=User&m=Alipay&a=index" title="支付宝在线充值" class="btn btn-primary btn_submit  J_ajax_submit_btn">支付宝在线充值</a></li>

<li><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" title="在线客服" class="btn btn-primary btn_submit  J_ajax_submit_btn">在线客服</a></li>


</ul>
        <div class="clr"></div>
      </div>
      <div class="cLine">
    <div class="alert">
    <p><span class="bold">温馨提示：</span>在本平台绑定公众号，并且在微信公众平台绑定接口后，可在微信公众号里回复"<span style="color:red">对接测试</span>"，如果提示绑定成功，即可正常使用！</p>
    </div>
</div>
          <div class="msgWrap">
            <TABLE class="ListProduct" border="0" cellSpacing="0" cellPadding="0" width="100%">
              <THEAD>
                <TR>
                  <TH>公众号名称</TH>
                  <TH>VIP等级</TH>
                  <TH>创建时间/到期时间</TH>
                   <TH>已定义/上限</TH>
                   <TH>请求数</TH>
                  <TH>操作</TH>
                </TR>
              </THEAD>
              <TBODY>
                <TR></TR>                
                 <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><TR>
					  <TD><p><a href="<?php echo U('Function/index',array('id'=>$vo['id'],'token'=>$vo['token']));?>" title="点击进入功能管理"><img src="<?php echo ($vo["headerpic"]); ?>" width="40" height="40"></a></p><p><?php echo ($vo["wxname"]); ?></p></TD>
					  <TD align="center"><?php if($_SESSION['gid']>1){echo $_SESSION['gid']-1;}else{echo 0;} ?></TD>
					  <TD><p>创建时间:<?php echo (date("Y-m-d",$vo["createtime"])); ?></p><p>到期时间:<?php echo (date("Y-m-d",$viptime)); ?></p><p><a   href="<?php echo U('Alipay/index');?>" id="smemberss" class="green"><em>升降级vip续费</em></a></p></Td>
					  <TD><p>图文：<?php echo $_SESSION['diynum'].'/'.$group[$_SESSION['gid']]['did']; ?></p></TD>
					   <TD><p>总请求数:<?php echo $_SESSION['connectnum'] ?></p><p> 本月请求数:<?php echo $group[$_SESSION['gid']]['cid']; ?></p></TD>
					  
					  <TD class="norightborder">　

					  <a onclick="window.parent.location.href='<?php echo U('Index/frame',array('id'=>$vo['id'],'token'=>$vo['token']));?>';" class="btn btn-primary btn_submit  J_ajax_submit_btn" target='_top' >功能管理</a>
					  <a href="<?php echo U('Home/Index/help',array('id'=>$vo['id'],'token'=>$vo['token']));?>" class="btn btn-primary btn_submit  J_ajax_submit_btn" >API接口</a>　
                      
                      <a href="<?php echo U('Index/edit',array('id'=>$vo['id']));?>" class="btn btn-primary btn_submit  J_ajax_submit_btn">编辑</a>　
                      
                      <a  href="javascript:drop_confirm('您确定要删除吗?', '<?php echo U('Index/del',array('id'=>$vo['id']));?>');" style="background:#F00" class="btn btn-primary btn_submit  J_ajax_submit_btn">删除</a>
					  </TD>
					</TR><?php endforeach; endif; else: echo "" ;endif; ?>

              </TBODY>
            </TABLE>
            
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