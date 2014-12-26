<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<script src="<?php echo STATICS;?>/jquery-1.4.2.min.js" type="text/javascript"></script>
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<div id="artlist" class="addn">
<?php if(($info["id"]) > "0"): ?><script src="./tpl/User/default/common/js/date/WdatePicker.js"></script>
			<form action="<?php echo U('Users/edit');?>" method="post" name="form" id="myform">
			<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>">
		<?php else: ?>
			<form action="<?php echo U('Users/add');?>" method="post" name="form" id="myform"><?php endif; ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="addn">

				 <tr>
					<th colspan="5"><?php echo ($title); ?></th>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户名称：</strong></td>
					<td colspan="4" class="lt">
						<input type="text" name="username" class="ipt" size="45" value="<?php echo ($info["username"]); ?>" <?php if(($info["username"]) == "admin"): ?>readonly="readonly"<?php endif; ?>>
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>手机号：</strong></td>
					<td colspan="4" class="lt">
						<input type="text" name="mp" class="ipt" size="45" value="<?php echo ($info["mp"]); ?>" />
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>邮箱：</strong></td>
					<td colspan="4" class="lt">
						<input type="text" name="email" class="ipt" size="45" value="<?php echo ($info["email"]); ?>" />
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户角色：</strong></td>
					<td colspan="4" class="lt">
						<select name="gid" style="width:136px">
							<?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $info["gid"]): ?>selected=""<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>到期时间：</strong></td>
					<td colspan="3" class="lt">
						<input type="text" name="viptime" onClick="WdatePicker()" class="ipt" size="45" value="<?php echo (date("Y-m-d",$info["viptime"])); ?>">
					</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>用户状态：</strong></td>
					<td colspan="4" class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="status" id="status1" <?php if(($info["status"] == 1) OR ($info['status'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="status" id="status2" <?php if(($info["status"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
				</tr>
				<tr>
									 <td height="38" style="text-align:right; color:red">高级功能：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="gjgn" id="gjgn" <?php if(($info["gjgn"] == 1) OR ($info['gjgn'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="gjgn" id="gjgn" <?php if(($info["gjgn"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					
					<td>
					</td>
					<td>
					</td>	
					</td>		 
               </tr>
                
				<tr>
					<td height="48" align="right"><strong>主题活动：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="zthd" id="zthd" <?php if(($info["zthd"] == 1) OR ($info['zthd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zthd" id="zthd" <?php if(($info["zthd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>街景地图：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="jjdh" id="jjdh" <?php if(($info["jjdh"] == 1) OR ($info['jjdh'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jjdh" id="jjdh" <?php if(($info["jjdh"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>极客答题王：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="jkdtw" id="jkdtw" <?php if(($info["jkdtw"] == 1) OR ($info['jkdtw'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jkdtw" id="jkdtw" <?php if(($info["jkdtw"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微招聘：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="wzp" id="wzp" <?php if(($info["wzp"] == 1) OR ($info['wzp'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wzp" id="wzp" <?php if(($info["wzp"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>房产中介：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="xwfc" id="xwfc" <?php if(($info["xwfc"] == 1) OR ($info['xwfc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="xwfc" id="xwfc" <?php if(($info["xwfc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微竞猜：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="wjc" id="wjc" <?php if(($info["wjc"] == 1) OR ($info['wjc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wjc" id="wjc" <?php if(($info["wjc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                <tr>
					
					<td height="48" align="right"><strong>百度直达号：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="bdzd" id="bdzd" <?php if(($info["bdzd"] == 1) OR ($info['bdzd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="bdzd" id="bdzd" <?php if(($info["bdzd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
					<td height="48" align="right"><strong>摇奖：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wyj" id="wyj" <?php if(($info["wyj"] == 1) OR ($info['wyj'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wyj" id="wyj" <?php if(($info["wyj"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
					
				</tr>
				                <tr>
					
					<td height="48" align="right"><strong>微现场：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wxc1" id="wxc1" <?php if(($info["wxc1"] == 1) OR ($info['wxc1'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wxc1" id="wxc1" <?php if(($info["wxc1"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
					
				</tr>
                				<tr>
									 <td height="38" style="text-align:right; color:red">场景应用：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="cjyy" id="cjyy" <?php if(($info["cjyy"] == 1) OR ($info['cjyy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="cjyy" id="cjyy" <?php if(($info["cjyy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
				<tr>
					<td height="48" align="right"><strong>微场景：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wxcj" id="wxcj" <?php if(($info["wxcj"] == 1) OR ($info['wxcj'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wxcj" id="wxcj" <?php if(($info["wxcj"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微众场景：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="wzcj" id="wzcj" <?php if(($info["wzcj"] == 1) OR ($info['wzcj'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wzcj" id="wzcj" <?php if(($info["wzcj"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>微品场景：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wpcj" id="wpcj" <?php if(($info["wpcj"] == 1) OR ($info['wpcj'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wpcj" id="wpcj" <?php if(($info["wpcj"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
					                    <td></td>
					<td></td>
				</tr>
				   <tr ><td height="38" style="text-align:right; color:red">基础设置设置</td>
				                       <td></td>
					<td></td>                    <td></td>
					<td></td>
				   </tr>
				   				<tr>
					<td height="48" align="right"><strong>文本回复：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wbhf" id="wbhf" <?php if(($info["wbhf"] == 1) OR ($info['wbhf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wbhf" id="wbhf" <?php if(($info["wbhf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>图文回复：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="twhf" id="twhf" <?php if(($info["twhf"] == 1) OR ($info['twhf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="twhf" id="twhf" <?php if(($info["twhf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
								   				<tr>
					<td height="48" align="right"><strong>多图文回复：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="dthf" id="dthf" <?php if(($info["dthf"] == 1) OR ($info['dthf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="dthf" id="dthf" <?php if(($info["dthf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>语音回复：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="yyhf" id="yyhf" <?php if(($info["yyhf"] == 1) OR ($info['twhf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yyhf" id="yyhf" <?php if(($info["yyhf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
												   				<tr>
					<td height="48" align="right"><strong>回答不上来：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="hdbsl" id="hdbsl" <?php if(($info["hdbsl"] == 1) OR ($info['hdbsl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="hdbsl" id="hdbsl" <?php if(($info["hdbsl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
					                    <td></td>
					<td></td>
				</tr>
                				<tr>
									 <td height="38" style="text-align:right; color:red">微官网设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="3g" id="3g" <?php if(($info["3g"] == 1) OR ($info['3g'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="3g" id="3g" <?php if(($info["3g"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
				<tr>
					<td height="48" align="right"><strong>高级模板：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="tpl" id="tpl" <?php if(($info["tpl"] == 1) OR ($info['tpl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="tpl" id="tpl" <?php if(($info["tpl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>自定义菜单：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="diy" id="diy" <?php if(($info["diy"] == 1) OR ($info['diy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="diy" id="diy" <?php if(($info["diy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
				<tr>
					<td height="48" align="right"><strong>在线预览：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="zxyl" id="zxyl" <?php if(($info["zxyl"] == 1) OR ($info['zxyl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zxyl" id="zxyl" <?php if(($info["zxyl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
					                    <td></td>
					<td></td>
				</tr>
				<tr>
									 <td height="38" style="text-align:right; color:red">微电商设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wds" id="wds" <?php if(($info["wds"] == 1) OR ($info['wds'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wds" id="wds" <?php if(($info["wds"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
                 
                <tr>
					<td height="48" align="right"><strong>微商圈：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="sq" id="sq" <?php if(($info["sq"] == 1) OR ($info['sq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="sq" id="sq" <?php if(($info["sq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微商盟：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="wsm" id="wsm" <?php if(($info["wsm"] == 1) OR ($info['wsm'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wsm" id="wsm" <?php if(($info["wsm"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				     <tr>
					<td height="48" align="right"><strong>微信商城：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wsc" id="wsc" <?php if(($info["wsc"] == 1) OR ($info['wsc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wsc" id="wsc" <?php if(($info["wsc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微信团购：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="tg" id="tg" <?php if(($info["tg"] == 1) OR ($info['tg'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="tg" id="tg" <?php if(($info["tg"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				                <tr>
					<td height="48" align="right"><strong>淘宝天猫：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="tbtm" id="tbtm" <?php if(($info["tbtm"] == 1) OR ($info['tbtm'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="tbtm" id="tbtm" <?php if(($info["tbtm"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>融合第三方：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="lh" id="lh" <?php if(($info["lh"] == 1) OR ($info['lh'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="lh" id="lh" <?php if(($info["lh"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
								<tr>
									 <td height="38" style="text-align:right; color:red">微促销设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="yx" id="yx" <?php if(($info["yx"] == 1) OR ($info['yx'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yx" id="yx" <?php if(($info["yx"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
                 
                <tr>
					<td height="48" align="right"><strong>大转盘：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="dzp" id="dzp" <?php if(($info["dzp"] == 1) OR ($info['dzp'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="dzp" id="dzp" <?php if(($info["dzp"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>优惠券：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="yhq" id="yhq" <?php if(($info["yhq"] == 1) OR ($info['yhq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yhq" id="yhq" <?php if(($info["yhq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				     <tr>
					<td height="48" align="right"><strong>刮刮卡：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="ggk" id="ggk" <?php if(($info["ggk"] == 1) OR ($info['ggk'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="ggk" id="ggk" <?php if(($info["ggk"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>水果机：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="sgj" id="sgj" <?php if(($info["sgj"] == 1) OR ($info['sgj'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="sgj" id="sgj" <?php if(($info["sgj"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				                <tr>
					<td height="48" align="right"><strong>砸金蛋：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="zjd" id="zjd" <?php if(($info["zjd"] == 1) OR ($info['zjd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zjd" id="zjd" <?php if(($info["zjd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>一站到底：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="yzdd" id="yzdd" <?php if(($info["yzdd"] == 1) OR ($info['yzdd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yzdd" id="yzdd" <?php if(($info["yzdd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
					     <tr>
					<td height="48" align="right"><strong>微信拆红包：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="chb" id="chb" <?php if(($info["chb"] == 1) OR ($info['chb'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="chb" id="chb" <?php if(($info["chb"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>转发有礼：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="zfyl" id="zfyl" <?php if(($info["zfyl"] == 1) OR ($info['zfyl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zfyl" id="zfyl" <?php if(($info["zfyl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				                <tr>
					<td height="48" align="right"><strong>分享达人：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fxdr" id="fxdr" <?php if(($info["fxdr"] == 1) OR ($info['fxdr'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fxdr" id="fxdr" <?php if(($info["fxdr"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>拆盒子：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="chz" id="chz" <?php if(($info["chz"] == 1) OR ($info['chz'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="chz" id="chz" <?php if(($info["chz"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
						<tr>
									 <td height="38" style="text-align:right; color:red">微互动设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="whd" id="whd" <?php if(($info["whd"] == 1) OR ($info['whd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="whd" id="whd" <?php if(($info["whd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
                 
                <tr>
					<td height="48" align="right"><strong>微信签到：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="qd" id="qd" <?php if(($info["qd"] == 1) OR ($info['qd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="qd" id="qd" <?php if(($info["qd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>祝福贺卡：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="hk" id="hk" <?php if(($info["hk"] == 1) OR ($info['hk'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="hk" id="hk" <?php if(($info["hk"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				     <tr>
					<td height="48" align="right"><strong>摇一摇：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="yyl" id="yyl" <?php if(($info["yyl"] == 1) OR ($info['yyl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yyl" id="yyl" <?php if(($info["yyl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>照片墙：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="zpq" id="zpq" <?php if(($info["zpq"] == 1) OR ($info['zpq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zpq" id="zpq" <?php if(($info["zpq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
				                <tr>
					<td height="48" align="right"><strong>微信墙：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wxq" id="wxq" <?php if(($info["wxq"] == 1) OR ($info['wxq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wxq" id="wxq" <?php if(($info["wxq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微名片：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="yq" id="yq" <?php if(($info["yq"] == 1) OR ($info['yq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yq" id="yq" <?php if(($info["yq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
					<tr>
					<td height="48" align="right"><strong>留言板：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="lyb" id="lyb" <?php if(($info["lyb"] == 1) OR ($info['lyb'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="lyb" id="lyb" <?php if(($info["lyb"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微论坛：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="bbs" id="bbs" <?php if(($info["bbs"] == 1) OR ($info['bbs'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="bbs" id="bbs" <?php if(($info["bbs"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
                   
				</tr>
                 <tr>
									 <td height="38" style="text-align:right; color:red">行业应用设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="why" id="why" <?php if(($info["why"] == 1) OR ($info['why'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="why" id="why" <?php if(($info["why"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
			   <tr>
					<td height="48" align="right"><strong>微订餐：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="cy" id="cy" <?php if(($info["cy"] == 1) OR ($info['cy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="cy" id="cy" <?php if(($info["cy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>连锁餐饮：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="lscy" id="lscy" <?php if(($info["lscy"] == 1) OR ($info['lscy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="lscy" id="lscy" <?php if(($info["lscy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                     <tr>
					<td height="48" align="right"><strong>微喜帖：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wxt" id="wxt" <?php if(($info["wxt"] == 1) OR ($info['wxt'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wxt" id="wxt" <?php if(($info["wxt"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微汽车：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="qc" id="qc" <?php if(($info["qc"] == 1) OR ($info['qc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="qc" id="qc" <?php if(($info["qc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                           <tr>
					<td height="48" align="right"><strong>微医疗：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="yl" id="yl" <?php if(($info["yl"] == 1) OR ($info['yl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="yl" id="yl" <?php if(($info["yl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微教育：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="jy" id="jy" <?php if(($info["jy"] == 1) OR ($info['jy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jy" id="jy" <?php if(($info["jy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                           <tr>
					<td height="48" align="right"><strong>微酒店（宾馆）：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="jd" id="jd" <?php if(($info["jd"] == 1) OR ($info['jd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jd" id="jd" <?php if(($info["jd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微房产：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="fc" id="fc" <?php if(($info["fc"] == 1) OR ($info['fc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fc" id="fc" <?php if(($info["fc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                              <tr>
					<td height="48" align="right"><strong>微美容：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="mr" id="mr" <?php if(($info["mr"] == 1) OR ($info['mr'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="mr" id="mr" <?php if(($info["mr"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微健身：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="js" id="js" <?php if(($info["js"] == 1) OR ($info['js'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="js" id="js" <?php if(($info["js"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
        
                                           <tr>
					<td height="48" align="right"><strong>微政务：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="zw" id="zw" <?php if(($info["zw"] == 1) OR ($info['zw'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zw" id="zw" <?php if(($info["zw"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微食品：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="sp" id="sp" <?php if(($info["sp"] == 1) OR ($info['sp'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="sp" id="sp" <?php if(($info["sp"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                               <tr>
					<td height="48" align="right"><strong>微旅游：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="ly" id="ly" <?php if(($info["ly"] == 1) OR ($info['ly'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="ly" id="ly" <?php if(($info["ly"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微花店：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="hd" id="hd" <?php if(($info["hd"] == 1) OR ($info['hd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="hd" id="hd" <?php if(($info["hd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                   <tr>
					<td height="48" align="right"><strong>微物业：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wy" id="wy" <?php if(($info["wy"] == 1) OR ($info['wy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wy" id="wy" <?php if(($info["wy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微ktv：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="ktv" id="ktv" <?php if(($info["ktv"] == 1) OR ($info['ktv'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="ktv" id="ktv" <?php if(($info["ktv"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                      <tr>
					<td height="48" align="right"><strong>微酒吧：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="jb" id="jb" <?php if(($info["jb"] == 1) OR ($info['jb'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jb" id="jb" <?php if(($info["jb"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微装修：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="zx" id="zx" <?php if(($info["zx"] == 1) OR ($info['zx'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zx" id="zx" <?php if(($info["zx"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                              <tr>
					<td height="48" align="right"><strong>微婚庆：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="hq" id="hq" <?php if(($info["hq"] == 1) OR ($info['hq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="hq" id="hq" <?php if(($info["hq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微宠物：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="cw" id="cw" <?php if(($info["cw"] == 1) OR ($info['cw'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="cw" id="cw" <?php if(($info["cw"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                                  <tr>
					<td height="48" align="right"><strong>微家政：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="jz" id="jz" <?php if(($info["jz"] == 1) OR ($info['jz'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="jz" id="jz" <?php if(($info["jz"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微租赁：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="zl" id="zl" <?php if(($info["zl"] == 1) OR ($info['zl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zl" id="zl" <?php if(($info["zl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                   <tr>
					
                    <td height="48" align="right"><strong>微电影：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="dy" id="dy" <?php if(($info["dy"] == 1) OR ($info['dy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="dy" id="dy" <?php if(($info["dy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
							                    <td></td>
					<td></td>
				</tr>
				                 <tr>
									 <td height="38" style="text-align:right; color:red">微游戏设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="game" id="game" <?php if(($info["game"] == 1) OR ($info['game'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="game" id="game" <?php if(($info["game"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
							   <tr>
					<td height="48" align="right"><strong>方言考试：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fyks" id="fyks" <?php if(($info["fyks"] == 1) OR ($info['fyks'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fyks" id="fyks" <?php if(($info["fyks"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>神经猫：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="sim" id="sim" <?php if(($info["sim"] == 1) OR ($info['sim'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="sim" id="sim" <?php if(($info["sim"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
											   <tr>
					<td height="48" align="right"><strong>2048正常版：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="2048" id="2048" <?php if(($info["2048"] == 1) OR ($info['2048'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="2048" id="2048" <?php if(($info["2048"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>2048虐心版：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="2048nx" id="2048nx" <?php if(($info["2048nx"] == 1) OR ($info['2048nx'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="2048nx" id="2048nx" <?php if(($info["2048nx"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
															   <tr>
					<td height="48" align="right"><strong>Flappy 2048：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="flappy" id="flappy" <?php if(($info["flappy"] == 1) OR ($info['flappy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="flappy" id="flappy" <?php if(($info["flappy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>吃粽子大赛：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="czz" id="czz" <?php if(($info["czz"] == 1) OR ($info['czz'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="czz" id="czz" <?php if(($info["czz"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
																			   <tr>
					<td height="48" align="right"><strong>走鹊桥：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="zqq" id="zqq" <?php if(($info["zqq"] == 1) OR ($info['zqq'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zqq" id="zqq" <?php if(($info["zqq"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>摁死小情侣：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="lovers" id="lovers" <?php if(($info["lovers"] == 1) OR ($info['lovers'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="lovers" id="lovers" <?php if(($info["lovers"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
					<tr>
					<td height="48" align="right"><strong>中秋吃月饼：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="autumn" id="autumn" <?php if(($info["autumn"] == 1) OR ($info['autumn'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="autumn" id="autumn" <?php if(($info["autumn"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                   <td height="48" align="right"><strong>点球大战：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="dqdz" id="dqdz" <?php if(($info["dqdz"] == 1) OR ($info['dqdz'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="dqdz" id="dqdz" <?php if(($info["dqdz"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
				</tr>
                     <tr>
									 <td height="38" style="text-align:right; color:red">微应用设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wyy" id="wyy" <?php if(($info["wyy"] == 1) OR ($info['wyy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wyy" id="wyy" <?php if(($info["wyy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>                                       
			   <tr>
					<td height="48" align="right"><strong>微调研：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wdy" id="wdy" <?php if(($info["wdy"] == 1) OR ($info['wdy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wdy" id="wdy" <?php if(($info["wdy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微相册：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="wxc" id="wxc" <?php if(($info["wxc"] == 1) OR ($info['wxc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wxc" id="wzl" <?php if(($info["wxc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                                         <tr>
					<td height="48" align="right"><strong>微投票：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wtp" id="wtp" <?php if(($info["wtp"] == 1) OR ($info['wtp'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wtp" id="wtp" <?php if(($info["wtp"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>360全景：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="360" id="360" <?php if(($info["360"] == 1) OR ($info['360'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="360" id="360" <?php if(($info["360"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                                              <tr>
					<td height="48" align="right"><strong>万能表单：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wnbd" id="wnbd" <?php if(($info["wnbd"] == 1) OR ($info['wnbd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wnbd" id="wnbd" <?php if(($info["wnbd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>在线预订：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="zxyd" id="zxyd" <?php if(($info["zxyd"] == 1) OR ($info['zxyd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="zxyd" id="zxyd" <?php if(($info["zxyd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                                                                                     <tr>
					<td height="48" align="right"><strong>新版微预约：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="xwyy" id="xwyy" <?php if(($info["xwyy"] == 1) OR ($info['xwyy'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="xwyy" id="xwyy" <?php if(($info["xwyy"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>微邀请：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="nc" id="nc" <?php if(($info["nc"] == 1) OR ($info['nc'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="nc" id="nc" <?php if(($info["nc"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                 				        <tr>
						<td height="38" style="text-align:right; color:red">群发消息：</td>
						<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="ts" id="ts" <?php if(($info["ts"] == 1) OR ($info['ts'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="ts" id="ts" <?php if(($info["ts"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
	                 <tr>
                                                                              
					<td height="48" align="right"><strong>群发接口：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="qsjk" id="qsjk" <?php if(($info["qsjk"] == 1) OR ($info['qsjk'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="qsjk" id="qsjk" <?php if(($info["qsjk"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>客服接口：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="kfjk" id="kfjk" <?php if(($info["kfjk"] == 1) OR ($info['kfjk'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="kfjk" id="kfjk" <?php if(($info["kfjk"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
                  <tr>
						<td height="38" style="text-align:right; color:red">粉丝管理：</td>
						<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fs" id="fs" <?php if(($info["fs"] == 1) OR ($info['fs'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fs" id="fs" <?php if(($info["fs"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
					                    <td></td>
					<td></td>
               </tr>                                                                                
	 <tr>
                                                                              
					<td height="48" align="right"><strong>粉丝管理：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fsgl" id="fsgl" <?php if(($info["fsgl"] == 1) OR ($info['fsgl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fsgl" id="fsgl" <?php if(($info["fsgl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>分组管理：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="fzfl" id="fzfl" <?php if(($info["fzfl"] == 1) OR ($info['fzfl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fzfl" id="fzfl" <?php if(($info["fzfl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
		 <tr>
                                                                              
					<td height="48" align="right"><strong>粉丝行为：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fsxw" id="fsxw" <?php if(($info["fsxw"] == 1) OR ($info['fsxw'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fsxw" id="fsxw" <?php if(($info["fsxw"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td height="48" align="right"><strong>渠道：</strong></td>
					<td class="lt"><input type="radio" class="radio" class="ipt" value="1" name="fsqd" id="fsqd" <?php if(($info["fsqd"] == 1) OR ($info['fsqd'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fsqd" id="fsqd" <?php if(($info["fsqd"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭</td>
				</tr>
			 <tr>
                                                                              
					<td height="48" align="right"><strong>分享管理：</strong></td>
					<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="fxgl" id="fxgl" <?php if(($info["fxgl"] == 1) OR ($info['fxgl'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="fxgl" id="fxgl" <?php if(($info["fxgl"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>
                    <td></td>
					<td></td>
				</tr>
	                  <tr>
						<td height="38" style="text-align:right; color:red">数据魔方：</td>
						<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="sjmf" id="sjmf" <?php if(($info["sjmf"] == 1) OR ($info['sjmf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="sjmf" id="sjmf" <?php if(($info["sjmf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>				 
						<td height="38" style="text-align:right; color:red">会员卡设置：</td>
						<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="hyk" id="hyk" <?php if(($info["hyk"] == 1) OR ($info['hyk'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="hyk" id="hyk" <?php if(($info["hyk"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>				 
               </tr>  
			                   				<tr>
									 <td height="38" style="text-align:right; color:red">fiwi设置：</td>
										<td class="lt">
						<input type="radio" class="radio" class="ipt" value="1" name="wf" id="wf" <?php if(($info["wf"] == 1) OR ($info['wf'] == '') ): ?>checked=""<?php endif; ?> >
							启用
							<input type="radio" class="radio" class="ipt"  value="0" name="wf" id="wf" <?php if(($info["wf"]) == "0"): ?>checked=""<?php endif; ?> >
							关闭
					</td>	
                    <td></td>
					<td></td>					
               </tr>
	<tr>
		<td colspan="5">
			<?php if(($info["id"]) > "0"): ?><input class="bginput" type="submit" name="dosubmit" value="修 改" >
				<?php else: ?>
				<input class="bginput" type="submit" name="dosubmit" value="添 加"><?php endif; ?>
			&nbsp;
			<input class="bginput" type="button" onclick="javascript:history.back(-1);" value="返 回" ></td>
	</tr>
</table>
</form>
<br />
<br />
<br />

</div>
</body>
</html>