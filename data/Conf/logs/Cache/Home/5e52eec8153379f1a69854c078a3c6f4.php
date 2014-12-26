<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?php echo C('keyword');?>"/>
    <meta name="description" content="<?php echo C('content');?>"/>
    <link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/style-price.css"/>
<style type="text/css">
<!--
.STYLE1 {
    color: #00FF00;
    font-weight: bold;
}
.STYLE2 {color: #FF0000}
-->
</style>
    <title>功能介绍－<?php echo C('site_title');?></title></head>
    <link rel="stylesheet" type="text/css" href="<?php echo RES;?>/css/index.css" media="all" />
<script src="<?php echo RES;?>/js/html5.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/jQuery.js"></script>
<script type="text/javascript" src="<?php echo RES;?>/js/carouFredSel.js"></script>
<body>
    <div class="nav clearfix">
        <div class="nav-content">   
		
		<img src="<?php echo C('site_logo');?>"   >
            <div class="right line-li">
                <ul>
                    <li><a href="/" class="hover">首页</a></li>
                    <li><a href="<?php echo U('Home/Index/fc');?>">功能介绍</a></li>
                    <li><a href="<?php echo U('Home/Index/about');?>">关于我们</a></li>
                    <li><a href="<?php echo U('Home/Index/price');?>">资费说明</a></li>
                    <li><a href="<?php echo U('Home/Index/guide');?>">案例展示</a></li>

               	<?php if($_SESSION[uid]==false): ?><li><a href="<?php echo U('Index/login');?>">登录后台</a></li>
				<li><a href="<?php echo U('Index/reg');?>" class="hover">申请试用</a></li>
					<?php else: ?>
                <li><a href="<?php echo U('User/Index/index');?>">管理中心</a></li>
				<li><a href="/#" onClick="Javascript:window.open('<?php echo U('System/Admin/logout');?>','_blank')" >退出</a></li><?php endif; ?>	

                </ul>
            </div>
      </div>
    </div>
<div class="Public-content clearfix">
    <div class="Public">
 
        <div class="document faq">
            <div class="normalTitle"><h2>资费</h2></div>
            <div class="normalContent">
                <div class="section lastSection">
                	<table width="100%" border="0" cellpadding="0" cellspacing="0" class=" ListProduct8">
<thead>
                			<tr>
                				<th class="lefttitle"><strong>微信号流量套餐</strong></th>
                				<th width="100">vip0</th>
                				<th width="100">vip1</th>
                				<th width="100">vip2</th>
                			
                				
                				<th width="100" class="norightborder">vip3</th>
               				</tr>
</thead>
<tbody>
                			<tr>
                				<td height="60" valign="middle" class="lefttitle">VIP价格
                					<a  class="tooltips" ><img src="<?php echo RES;?>/images/price_help.png" align="absmiddle" /><span>
<p>VIP只是流量套餐（自定义数和赠送的请求数不同而已），点击问号查看详细购买流程！</p>
</span></a></td>
                				<td><span class=><?php echo C('vip0');?>
                				    元 / 月
           				      </span>                				  <p class="STYLE1"><?php echo C('vip0m');?> 元 / 年 </p></td>
                				<td><span class=><?php echo C('vip1');?>
                				    元 / 月
                				    <p class="STYLE1"><?php echo C('vip1m');?> 元 / 年</p>
                				</span></td>
                				<td><span class=><?php echo C('vip2');?>
                				    元 / 月
                				        <p class="STYLE1"><?php echo C('vip2m');?> 元 / 年</p>
                				</span></td>
                				<td><span class=><?php echo C('vip3');?>
                				    元 / 月
           				      </span>                				  <p class="STYLE1"><?php echo C('vip3m');?> 元 / 年 </p></td>
                				
               				</tr>
                			<tr>
                				<td height="32" class="lefttitle">自定义条数限额 <span class="tooltips" ><img src="<?php echo RES;?>/images/price_help.png" align="absmiddle" /><span>
<p><strong>什么是自定义限额数？</strong></p>
<p>自定义分：自定义文本、自定义图文、自定义语音。意思是，你写一个图文就少一个自定义图文〔vip0图文、文本、语音都有2000自定义，够挥霍了。〕</p>
</span></span></td>
                				<td>100</td>
                				<td>1000</td>
                				<td>10000</td>
                				
                				
                				<td class="norightborder">100000</td>
               				</tr>
                			<tr>
                				<td height="32" class="lefttitle">赠送月请求次数 <span class="tooltips"><img src="<?php echo RES;?>/images/price_help.png" align="absmiddle" />
<span>
<p><strong>什么是请求数？</strong></p>
<p>用户发送一句话，就代表一个请求。
比如：用户发送 "你好！"，系统回复"你也好！"
这就算一个请求，如果系统没回复，则不计。
〔温馨提示：3G功能〔分类功能〕请求也算在内。3G请求看不到，只是粉丝在浏览里3G网站时候，浏览一篇文章，或者重新打开一个分类就算一个请求。目前3G功能只统计请求并不收费。〕</p>
<p><strong>什么是赠送请求？</strong></p>
<p>用户购买VIP流量套餐后会赠送用户一些功能和请求数，这个请求数被 称为赠送请求数。</p>
</span></span></td>
                				<td>1000</td>
                				<td>10000</td>
                				<td>100000</td>
                			
                				
                				<td class="norightborder">1000000</td>
               				</tr>
                            <tr >
                				<td height="50" class="lefttitle">每月免收活动创建费次数<span class="tooltips"><img src="<?php echo RES;?>/images/price_help.png" align="absmiddle" />
<span>
<p><strong>什么是活动创建费？</strong></p>
<p>创建1次活动的基础费是10元,这就是活动创建费。免收活动创建费就是免10元，其他资源消耗还是要正常扣费（如：SN码费用和实际参与抽奖人数的费用）!</p>
</span></span></td>
                				<td>10次</td>
                				<td>100次</td>
                				<td>1000次</td>
                		
                			
                				<td class="norightborder">10000次</td>
               				</tr>
					  <td class="lefttitle">会员卡数量</td>
                				<td class="error">&nbsp;</td>
                				<td class=" ">100</td>
                				<td class="">1000</td>
                				<td class=" ">10000</td>
                				
	
                            <tr >
                				<td height="50" class="lefttitle">底部版权信息<span class="tooltips"><img src="<?php echo RES;?>/images/price_help.png" align="absmiddle" />
<span>
<p><strong>版权信息？</strong></p>
<p>	V0 页面有:此页面是由【<a href="<?php echo C('site_url');?>"><?php echo C('site_name');?>接口平台</a>】系统生成 版权信息</p>
</span></span></td>
                				<td>无</td>
                				<td>无</td>
                				<td>有</td>
                			
                				
                				<td class="norightborder">有</a></td>
               				</tr>
                			<tr >
               				  <td height="50" class="lefttitle"> <span class="red STYLE2"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes"target="_blank">点击联系管理员QQ</a><br>1、注册账号 2、查看功能需求，选择套餐3、联系管理员QQ：<span class="foot-menu"><?php echo C('site_qq');?></span> ，把套餐和账号报与管理员，开通权限！另<?php echo C('copyright');?>面向全国招收代理，有意者请联系管理员QQ：<span class="foot-menu"><?php echo C('site_qq');?></span>，验证信息注明：代理。</span></td>
                				<td><a class="btnGreens"  href="<?php echo U('User/Alipay/index',array('gid'=>0));?>"><em>立即充值</em></a></td>
                				<td><a class="btnGreens"  href="<?php echo U('User/Alipay/index',array('gid'=>1));?>"><em>立即充值</em></a></td>
                				<td><a class="btnGreens"  href="<?php echo U('User/Alipay/index',array('gid'=>2));?>"><em>立即充值</em></a></td>
                				<td><a class="btnGreens"  href="<?php echo U('User/Alipay/index',array('gid'=>3));?>"><em>立即充值</em></a></td>
                			
               				</tr>
                			<tr>
                				<td height="36" class="lefttitle"><strong>基础功能</strong></td>
                				<td></td>
                				<td></td>
                				<td></td>
                				
                				<td class="norightborder"></td>
               				</tr>
                			<tr>
                				<td class="lefttitle">天气</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">查快递</td>
                				<td class="checked">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">翻译</td>
                				<td class="checked">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">百科</td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">手机归属地查询</td>
                				<td class="checked">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">身份证查询</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">糗事</td>
                				<td class="checked">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">笑话</td>
                				<td class="checked">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">藏头藏尾诗</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">解梦</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked ">&nbsp;</td>
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">健康指数计算器</td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">公交查询</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">火车查询</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">网络音乐搜索</td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>

<tr>
                				<td class="lefttitle">翻译朗读开关</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
<tr>

<td class="lefttitle">发地理位置直接显示周边</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
<tr >
                				<td class="lefttitle">自定义LBS数据</td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
<tr>

<td class="lefttitle">文本回复模糊匹配</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
<tr >
                				<td class="lefttitle">图文回复包含匹配</td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
<tr>

<td class="lefttitle">回答不上启用第三方接口</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td height="36" class="lefttitle"><strong>高级功能（不需要单独收费）</strong></td>
                				<td></td>
                				<td></td>
                				<td></td>
                				
                				<td class="norightborder"></td>
               				</tr>
                			<tr>
                				<td class="lefttitle"><a class="tooltips" href="forum.php?mod=viewthread&amp;tid=498&amp;extra=page=1" target="999"><span><p>&nbsp;</p>
</span></a>刮刮卡活动</td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">大转盘活动</td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">优惠券活动<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>

<tr>
                				<td class="lefttitle">投票活动 <span class="tooltips" ><span><p>&nbsp;</p></span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">店铺管理</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked ">&nbsp;</td>
               				</tr>
                			<tr>
                				<td class="lefttitle">第三方接口融合<a class="tooltips" href="forum.php?mod=viewthread&amp;tid=340" target="999"><span>
                				  <p>&nbsp;</p>
</span></a></td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                		
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
<tr>
                				<td align="left" class="lefttitle">淘宝客模块<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">技术指导</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">3G网站</td>
                				<td class="error " >&nbsp;</td>
                				<td class="checked " >&nbsp;</td>
                				<td class="checked " >&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">自定义语音</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">自定义图文</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
       				  </tr>
                			<tr>
                				<td class="lefttitle">自定义文本</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
								<tr>
                				<td align="left" class="lefttitle">DIY宣传页<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
               				</tr>
									<tr>
                				<td class="lefttitle">域名查询</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder ">&nbsp;</td>
                				</tr>
								<tr>
                				<td align="left" class="lefttitle">无线网络订餐<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
               				</tr>
							<tr>
                				<td align="left" class="lefttitle">在线商城<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
               				</tr>
							<tr>
                				<td align="left" class="lefttitle">在线团购<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
               				</tr>
							<tr>
                				<td align="left" class="lefttitle">会员资料管理<span></span></td>
                				<td class="error">&nbsp;</td>
                				<td class="error">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                			
                				<td class="checked norightborder">&nbsp;</td>
               				</tr>
							<tr>
                				<td class="lefttitle">微喜帖</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				<td class="checked ">&nbsp;</td>
                				
                			
                				<td class="checked norightborder">&nbsp;</td>
       				  </tr>
								<tr>
                				<td class="lefttitle">360全景</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				<td class="error ">&nbsp;</td>
                				
                			
                				<td class="checked norightborder">&nbsp;</td>
                				</tr>
</tbody>
       			  </table>
                </div>
            <div class="section lastSection">
<p><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="999" class="red">点击QQ交谈</a><br>1、注册账号 2、查看功能需求，选择套餐3、联系管理员QQ：<span class="foot-menu"><?php echo C('site_qq');?></span> ，把套餐和账号报与管理员，开通权限！另<?php echo C('copyright');?>面向全国招收代理，有意者请联系管理员QQ：<span class="foot-menu"><?php echo C('site_qq');?></span> ，验证信息注明：代理。</p>
       		  </div>
            </div>
        </div>

    </div>
</div>
<div class="erwei" title="微信扫一扫">
	<span class="hudongzhushou">官方微信</span>
	<div class="erwei_big" style="display:none;"><img src="<?php echo C('erwei');?>" >
		<p>扫一扫，关注<?php echo C('site_name');?>官方微信，体验<?php echo C('site_name');?>智能服务<br>
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo C('site_qq');?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></p>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var erwei_time = null;
		$(".erwei").hover(function(){
			$(".erwei_big").show();
		}).mouseleave(function(){
				erwei_time = setTimeout(function(){
					$(".erwei_big").hide();
				},1000);
			});
		$(".erwei_big").mouseenter(function(){
			if(erwei_time){
				clearTimeout(erwei_time);
			}
		}).mouseleave(function(){
				erwei_time = setTimeout(function(){
					$(".erwei_big").hide();
				},1000);
			});
	});
</script>
<!--QQ咨询-->

<div class="footer">
	<div class="footer-content clearfix">
		<div class="foot-menu">
			<p>
				<a href="<?php echo C('site_url');?>"><?php echo C('site_name');?>首页</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Index/reg');?>" target="_blank">申请入驻</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Home/Index/about');?>" target="_blank">渠道代理</a>&nbsp;|&nbsp;
				<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">接口定制</a>&nbsp;|&nbsp;
				<a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo C('site_qq');?>&site=qq&menu=yes" target="_blank">微信托管</a>&nbsp;|&nbsp;
				<a href="<?php echo U('Home/Index/about');?>" target="_blank">关于<?php echo C('site_name');?></a>&nbsp;|&nbsp;
				
			</p>
			<p>客服QQ：<?php echo C('site_qq');?>&nbsp;&nbsp;&nbsp;邮箱：<?php echo C('site_email');?></p>
		</div>
		<div class="copyright">
			Copyright © 2013-2014 <?php echo C('site_url');?>. All Rights Reserved <?php echo C('site_name');?>版权所有 </br> <a href="http://www.miitbeian.gov.cn" target="_blank" ><?php echo C('ipc');?>首页</a>
		</div>
	</div>
</div>
</body>
</html>
<div style="display:none">
<?php echo C('counts');?>
</div>
</body></html>