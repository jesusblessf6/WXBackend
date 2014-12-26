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
		<h1 class="Public-h1">经典案例</h1>
		<div class="Public-box clearfix">
			<ul id="nav_lis" class="case-nav left">
				<li data-index="0" data-hash="#case-a">汽车行业</li>
				<li data-index="1" data-hash="#case-b">房地产</li>
				<li data-index="2" data-hash="#case-c">医疗</li>
				<li data-index="3" data-hash="#case-d">酒店</li>
				<li data-index="4" data-hash="#case-e">餐饮</li>
				<li data-index="5" data-hash="#case-f">旅游</li>
				<li data-index="6" data-hash="#case-g">电商</li>
				<li data-index="7" data-hash="#case-h">娱乐生活</li>
				<li data-index="8" data-hash="#case-i">装潢材料</li>
				<li data-index="9" data-hash="#case-j">婚纱摄影</li>
				<li data-index="10" data-hash="#case-k">通讯</li>
				<li data-index="11" data-hash="#case-l">养生美容健身</li>
				<li data-index="12" data-hash="#case-m">金融</li>
		
				<li data-index="14" data-hash="#case-o">零售</li>
				<li data-index="15" data-hash="#case-p">百货商场</li>
				<li data-index="16" data-hash="#case-q">法律行业</li>
				<li data-index="17" data-hash="#case-r">婚庆行业</li>
				<li data-index="18" data-hash="#case-s">IT行业</li>
				<li data-index="19" data-hash="#case-t">教育机构</li>
			</ul>
			<div id="nav_uls" style="overflow:hidden;">
			<!-- 汽车开始 -->
				<div data-index="0" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item"  data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case car2 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">绿地宝马5S</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case car1" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">咸阳尚乘</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case car3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">奔驰世家</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case car4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">沃尔沃丰颐</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case car5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">长安福特阳天</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case car6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">长安铃木</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case car7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_car.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">郑州日产</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="7" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/car/car7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/car/car7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/car/car7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<span class="arrow" id="case_arrow">
						<i class="arrow_out"></i>
						<i class="arrow_in"></i>
					</span>
				</div>
			<!--汽车结束-->
			<!--房地产开始-->
				<div data-index="1" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case est1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">苏州雍景湾</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case est2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">中诚地产</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case est3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">保利达翠堤湾</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case est4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">十里银滩</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case est5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">金地檀溪</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case est6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">绿城蘭园</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case est7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_est.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">悦美国际</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0" >
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    	<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/fdc/fdc7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/fdc/fdc7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/fdc/fdc7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--房地产结束-->
			<!--医疗开始-->
				<div data-index="2" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case med1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">上海复大医院</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case med2" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">美缔整形美容</h4>
						</li>
                        <li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case med3" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">成都万年医院</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case med4" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">玛丽亚妇产医院</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case med5" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">苏州同济医院</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case med6" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">泰安丽人妇产医院</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case med7" style="background-image:url(http://www.fenxiangweb.com/diaoyong//icon_wm_case_yl.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">重庆圣保罗医院</h4>
						</li>
                       
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
                    <div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yl/yl7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yl/yl7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yl/yl7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--医疗结束-->
			<!--酒店开始-->
				<div data-index="3" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">丽彩天禧酒店</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">年代风尚</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">五环大酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">最佳财富西方酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">大城小爱酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">宁波朗逸大酒店</h4>
						</li>
                        <li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case jd7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_jd.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">深圳唐拉雅秀酒店</h4>
						</li>
                        
                      
                        
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd6-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/jd/jd7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/jd/jd7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/jd/jd7-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    
				</div>
			<!--酒店结束-->
			<!--餐饮开始-->
				<div data-index="4" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">海底捞</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">金龙海鲜烧烤</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">麦兜点点</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">南京典尚餐饮</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">黔香阁</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">舌尖上的酸菜鱼</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case cy7"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_cy.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">襄阳甜甜馆</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys10-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys10-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys10-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ys/ys7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ys/ys7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img"> <img id="case_ewm" src="<?php echo RES;?>/images/images/ys/ys7-erwei.jpg" width="180" height="180"></p>
					</div>
				</div>
			<!--餐饮结束-->
			<!--旅游开始-->
				<div data-index="5" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">深圳东部华侨城</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">美地度假</h4>
						</li>
                        <li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">金假期旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">深圳天安旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">西林生态旅游</h4>
						</li>
                        <li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case ly6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ly.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">众信旅游网</h4>
						</li>
                       
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly2-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="2">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                      <div class="default_wrapper wm_case_desc" data-id="3">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                     <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly5-erwei.jpg" width="180" height="180">
						</p>
					</div>
                     <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ly/ly6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ly/ly6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ly/ly6-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--旅游结束-->
			<!--电商开始-->
				<div data-index="6" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ds.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">一号店</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case ds2"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_ds.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">龙飞凤舞</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ds/ds1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ds/ds1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ds/ds1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/ds/ds2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/ds/ds2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/ds/ds2-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--电商结束-->
			<!--娱乐开始-->
				<div data-index="7" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">BBOSS至尊</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">丹东二人转大</h4>
						</li>
						<li class="wm_case_item" name="hgyj" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 classwm_case_item="wm_case_t">名流之星KTV</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">西安倾国倾城</h4>
						</li>
                        <li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">美宝之家</h4>
						</li>
                         <li class="wm_case_item"  data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case yul6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_yul.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">通灵珠宝</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yul/yl1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yul/yl1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yul/yl1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yul/yl2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yul/yl2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yul/yl2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yul/yl3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yul/yl3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yul/yl3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yul/yl4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yul/yl4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yul/yl4-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="4">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/yul/yl5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/yul/yl5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/yul/yl5-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--娱乐结束-->
			<!--装潢开始-->
				<div data-index="8" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case on zh1"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">大涌红木家具</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh2"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">鸿起顺门业</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh3"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">慧能地暖</h4>
						</li>
						<li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh4"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">健威人性家具</h4>
						</li>
						<li class="wm_case_item" data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh5"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">宁波浪琴屿</h4>
						</li>
						<li class="wm_case_item" data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh6"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">欧派木门</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case zh7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_zh.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">欧然墙纸</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/zh/zh7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/zh/zh7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/zh/zh7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--装潢结束-->
			<!--婚纱开始-->
				<div data-index="9" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">爱女神3D婚纱</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">iweddingstudio</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">韩国艺匠</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">美十摄影</h4>
						</li>
						<li class="wm_case_item" data-id="4">
									<span class="icon_wrapper">
										<i class="icon_wm_case hs5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
									</span>
							<h4 class="wm_case_t">星梦奇缘</h4>
						</li>
						<li class="wm_case_item" data-id="5">
									<span class="icon_wrapper">
										<i class="icon_wm_case hs6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
									</span>
							<h4 class="wm_case_t">拍吧视觉</h4>
						</li>
						<li class="wm_case_item" data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case hs7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hs.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">罗门婚纱</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs4-erwei.jpg" width="180" height="180"></p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs6-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/hs/hs7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/hs/hs7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/hs/hs7-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--婚纱结束-->
			<!--通讯开始-->
				<div data-index="10" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_tx.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">衡阳金联合通讯</h4>
						</li>
						<li class="wm_case_item" data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_tx.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">洛阳移动</h4>
						</li>
						<li class="wm_case_item" data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_tx.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">莆田沃体验手机</h4>
						</li>
                        <li class="wm_case_item" data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case tx4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_tx.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">中国电信赣州网厅</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/tx/tx1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/tx/tx1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/tx/tx1-erwei.jpg" width="180" height="180"></p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/tx/tx2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/tx/tx2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/tx/tx2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/tx/tx3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/tx/tx3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/tx/tx3-erwei.jpg" width="180" height="180">
						</p>
					</div>
                    <div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/tx/tx4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/tx/tx4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/tx/tx4-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--通讯结束-->
			<!--美容开始-->
				<div data-index="11" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);" ></i>
							</span>
							<h4 class="wm_case_t">名草泉</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">诗美诗格</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">辰嫣国际微刊</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">凤凰温泉</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">慧之通</h4>
						</li>
						<li class="wm_case_item"  data-id="5">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr6" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">匠人造型</h4>
						</li>
						<li class="wm_case_item"  data-id="6">
							<span class="icon_wrapper">
								<i class="icon_wm_case mr7" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_mr.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">爵士美发</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr7-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr7-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr7-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;" >
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr2-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr3-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr3-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr3-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr4-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr4-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr4-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="5" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr5-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr5-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr5-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="6" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/mr/mr6-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/mr/mr6-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/mr/mr6-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--美容结束-->
			<!--金融开始-->
				<div data-index="12" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case bk1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bk.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">融易宝</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case bk2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bk.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">微诺亚</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0" >
						<img id="case_img_left" src="<?php echo RES;?>/images/images/bk/bk1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/bk/bk1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/bk/bk1-erwei.jpg" width="180" height="180">
						</p>
					</div>
					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/bk/bk2-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/bk/bk2-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">
							<img id="case_ewm" src="<?php echo RES;?>/images/images/bk/bk2-erwei.jpg" width="180" height="180">
						</p>
					</div>
				</div>
			<!--金融结束-->
		
			<!--零售开始-->
				<div data-index="14" class="wm_case_mod_bd right">
					<ul class="wm_case_list">
						<li class="wm_case_item" data-id="0">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis1 on"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_lis.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">安贝儿童座椅</h4>
						</li>
						<li class="wm_case_item"  data-id="1">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_lis.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">拜耳水产</h4>
						</li>
						<li class="wm_case_item"  data-id="2">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_lis.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">超凡计算机</h4>
						</li>
						<li class="wm_case_item"  data-id="3">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_lis.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">牛牛生态水产</h4>
						</li>
						<li class="wm_case_item"  data-id="4">
							<span class="icon_wrapper">
								<i class="icon_wm_case lis5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_lis.png?v=2013-11-08-1);"></i>
							</span>
							<h4 class="wm_case_t">YFAN伊梵</h4>
						</li>
					</ul>
					<div class="default_wrapper wm_case_desc" data-id="0">
						<img id="case_img_left" src="<?php echo RES;?>/images/images/lis/ls1-1.jpg" class="wm_case_desc_img">
						<img id="case_img_right" src="<?php echo RES;?>/images/images/lis/ls1-2.jpg" class="wm_case_desc_img extra">
						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/lis/ls1-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/lis/ls2-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/lis/ls2-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/lis/ls2-erwei.jpg" width="180" height="180">



						</p>
					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/lis/ls3-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/lis/ls3-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/lis/ls3-erwei.jpg" width="180" height="180">



						</p>
					</div>



					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/lis/ls4-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/lis/ls4-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/lis/ls4-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/lis/ls5-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/lis/ls5-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/lis/ls5-erwei.jpg" width="180" height="180">



						</p>



					</div>



				</div>



			<!--零售结束-->
			<!--百货结束-->



				<div data-index="15" class="wm_case_mod_bd right">



					<ul class="wm_case_list">



						<li class="wm_case_item"  data-id="0">



							<span class="icon_wrapper">



								<i class="icon_wm_case bh1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bh.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">潮流百货</h4>



						</li>



						<li class="wm_case_item"  data-id="1">



							<span class="icon_wrapper">



								<i class="icon_wm_case bh2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bh.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">兰州每轮百货</h4>



						</li>



						<li class="wm_case_item" name="shdz" data-id="2">



							<span class="icon_wrapper">



								<i class="icon_wm_case bh3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bh.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">廊坊万达广场</h4>



						</li>



						<li class="wm_case_item" data-id="3">



							<span class="icon_wrapper">



								<i class="icon_wm_case bh4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bh.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">星摩尔购物广场</h4>



						</li>



						<li class="wm_case_item"  data-id="4">



							<span class="icon_wrapper">



								<i class="icon_wm_case bh5"  style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_bh.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">知名度服饰</h4>



						</li>



					</ul>



					<div class="default_wrapper wm_case_desc" data-id="0">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/bh/bh1-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/bh/bh1-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/bh/bh1-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/bh/bh2-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/bh/bh2-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/bh/bh2-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/bh/bh3-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/bh/bh3-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/bh/bh3-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/bh/bh4-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/bh/bh4-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/bh/bh4-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/bh/bh5-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/bh/bh5-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/bh/bh5-erwei.jpg" width="180" height="180">



						</p>



					</div>



				</div>



			<!--百货场结束-->
			<!--法律开始-->



				<div data-index="16" class="wm_case_mod_bd right">



					<ul class="wm_case_list">



						<li class="wm_case_item"  data-id="0">



							<span class="icon_wrapper">



								<i class="icon_wm_case fl1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/con_wm_case_fl.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">大诚律师</h4>



						</li>



					</ul>



					<div class="default_wrapper wm_case_desc" data-id="0">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/ls/ls1-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/ls/ls1-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/ls/ls1-erwei.jpg" width="180" height="180">



						</p>



					</div>



				</div>



			<!--法律结束-->
			<!--婚庆开始-->



				<div data-index="17" class="wm_case_mod_bd right">



					<ul class="wm_case_list">



						<li class="wm_case_item" data-id="0">



							<span class="icon_wrapper">



								<i class="icon_wm_case hq1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hq.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">铂菲婚礼顾问</h4>



						</li>



                        <li class="wm_case_item" data-id="1">



							<span class="icon_wrapper">



								<i class="icon_wm_case hq2 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hq.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">唐山婚庆导航</h4>



						</li>



                        <li class="wm_case_item" data-id="2">



							<span class="icon_wrapper">



								<i class="icon_wm_case hq3 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hq.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">花香阁婚庆花艺</h4>



						</li>



                        <li class="wm_case_item" data-id="3">



							<span class="icon_wrapper">



								<i class="icon_wm_case hq4 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_hq.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">施华洛婚纱婚庆</h4>



						</li>



					</ul>



					<div class="default_wrapper wm_case_desc" data-id="0" >



						<img id="case_img_left" src="<?php echo RES;?>/images/images/hq/hq1-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/hq/hq1-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/hq/hq1-erwei.jpg" width="180" height="180">



						</p>



					</div>



                    <div class="default_wrapper wm_case_desc" data-id="1" >



						<img id="case_img_left" src="<?php echo RES;?>/images/images/hq/hq2-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/hq/hq2-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/hq/hq2-erwei.jpg" width="180" height="180">



						</p>



					</div>



                    <div class="default_wrapper wm_case_desc" data-id="2" >



						<img id="case_img_left" src="<?php echo RES;?>/images/images/hq/hq3-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/hq/hq3-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/hq/hq3-erwei.jpg" width="180" height="180">



						</p>



					</div>



                    <div class="default_wrapper wm_case_desc" data-id="3" >



						<img id="case_img_left" src="<?php echo RES;?>/images/images/hq/hq4-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/hq/hq4-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/hq/hq4-erwei.jpg" width="180" height="180">



						</p>



					</div>



				</div>



			<!--婚庆结束-->
			<!--it开始-->



				<div data-index="18" class="wm_case_mod_bd right">



					<ul class="wm_case_list">



						<li class="wm_case_item" data-id="0">



							<span class="icon_wrapper">



								<i class="icon_wm_case it1 on" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_it.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">艾定义互动</h4>



						</li>



						<li class="wm_case_item"  data-id="1">



							<span class="icon_wrapper">



								<i class="icon_wm_case it2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_it.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">方志电子</h4>



						</li>



						<li class="wm_case_item"  data-id="2">



							<span class="icon_wrapper">



								<i class="icon_wm_case it3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_it.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">前十名</h4>



						</li>



						<li class="wm_case_item" data-id="3">



							<span class="icon_wrapper">



								<i class="icon_wm_case it4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_it.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">易维网络</h4>



						</li>



                        	<li class="wm_case_item" data-id="4">



							<span class="icon_wrapper">



								<i class="icon_wm_case it5" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_it.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">云图信息科技</h4>



						</li>



                        



					</ul>



					<div class="default_wrapper wm_case_desc" data-id="0">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/it/it1-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/it/it1-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/it/it1-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/it/it2-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/it/it2-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/it/it2-erwei.jpg" width="180" height="180">



						</p>
					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/it/it3-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/it/it3-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/it/it3-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/it/it4-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/it/it4-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/it/it4-erwei.jpg" width="180" height="180">



						</p>



					</div>



                    <div class="default_wrapper wm_case_desc" data-id="4" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/it/it5-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/it/it5-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/it/it5-erwei.jpg" width="180" height="180">



						</p>



					</div>



				</div>



			<!--it结束-->
			<!--教育开始-->



				<div data-index="19" class="wm_case_mod_bd right">



					<ul class="wm_case_list">



						<li class="wm_case_item"  data-id="0">



							<span class="icon_wrapper">



								<i class="icon_wm_case on edu1" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_edu.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">阿杰发艺</h4>



						</li>



						<li class="wm_case_item"  data-id="1">



							<span class="icon_wrapper">



								<i class="icon_wm_case  edu2" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_edu.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">见悟修教育</h4>



						</li>



						<li class="wm_case_item"  data-id="2">



							<span class="icon_wrapper">



								<i class="icon_wm_case edu3" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_edu.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">廊坊第六小学</h4>



						</li>



						<li class="wm_case_item"  data-id="3">



							<span class="icon_wrapper">



								<i class="icon_wm_case edu4" style="background-image:url(http://www.fenxiangweb.com/diaoyong/icon_wm_case_edu.png?v=2013-11-08-1);"></i>



							</span>



							<h4 class="wm_case_t">CZ娱乐培训</h4>



						</li>



					</ul>



					<div class="default_wrapper wm_case_desc" data-id="0">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/edu/edu1-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/edu/edu1-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img"><img id="case_ewm" src="<?php echo RES;?>/images/images/edu/edu1-erwei.jpg" width="180" height="180" /></p>



				  </div>



					<div class="default_wrapper wm_case_desc" data-id="1" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/edu/edu2-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/edu/edu2-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/edu/edu2-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="2" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/edu/edu3-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/edu/edu3-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/edu/edu3-erwei.jpg" width="180" height="180">



						</p>



					</div>



					<div class="default_wrapper wm_case_desc" data-id="3" style="display:none;">



						<img id="case_img_left" src="<?php echo RES;?>/images/images/edu/edu4-1.jpg" class="wm_case_desc_img">



						<img id="case_img_right" src="<?php echo RES;?>/images/images/edu/edu4-2.jpg" class="wm_case_desc_img extra">



						<p class="case_ewm_img">



							<img id="case_ewm" src="<?php echo RES;?>/images/images/edu/edu4-erwei.jpg" width="180" height="180">



						</p>
					</div>



				</div>



			<!--教育结束-->
		</div>



	</div>



</div>
<div class="erwei" title="微信扫一扫">



	<span class="hudongzhushou">官方微信</span>



	<div class="erwei_big" style="display:none;">



		<p>扫一扫，关注<?php echo C('site_name');?>官方微信，体验<?php echo C('site_name');?>智能服务</p>



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



<div style="display:none;"><script type="text/javascript" src="../../www.120fd.com/tongji/ga/huishuo.js"></script></div>



<script type="text/javascript">



	$(document).ready(function(){



		var hash=window.location.hash || "#case-a";



		if(hash){



			var lis=$("#nav_lis>li"),



				divs=$("#nav_uls>div");



			lis.each(function(index, v) {



				if(hash == v.getAttribute("data-hash")){



					v.className="hover";



					//.var divs = $("#nav_uls>div");



					for(var i=0,ci; ci = divs[i]; i++){



						if(index == ci.getAttribute("data-index")){



							$(ci).addClass("show");



						}else{



							$(ci).removeClass("show");



						}



					}



					/*divs.removeAttr("data-on").each(function(k,vv){



						if(index == vv.getAttribute("data-index")){



							vv.setAttribute("data-on", "true");



							return;



						}



					});*/



				}



			});



		}
	$("#nav_lis").on("mouseover", function(e){



			$(this).find("li").removeClass("hover");



			e.target.className = "hover";



			var index = e.target.getAttribute("data-index");



			//



			var divs = $("#nav_uls>div");



			for(var i=0,ci; ci = divs[i]; i++){



				if(index == ci.getAttribute("data-index")){



					$(ci).addClass("show");



				}else{



					$(ci).removeClass("show");



				}



			}
		});




		$("#nav_uls>div").each(function(k,v){



			function show_case(id, thi, pause) {



				if(pause){return;}



				$(thi).parent().find(".on").removeClass("on");



				$(thi).find(".icon_wm_case").addClass("on");



				var divs=$(thi).closest("div").find(".wm_case_desc");



				divs.css("display", "none")[id].style.display="";



			};



			(function(){



				var lis=$(v).find(".wm_case_item");



				var index=0;



				var pause=false;



				//



				$(v).on("mouseover", function(){



					pause=true;



				}).on("mouseout", function(){



						pause=false;



					}).find(".wm_case_item").hover(function () {



						index=$(this).attr("data-id");



						show_case(index, this);



					});



				//



				var timer=setInterval(function(){



					index=++index>=lis.length? 0: index;



					show_case(index, lis[index], pause);



				}, 3000);



			})();



		});



	});



</script>

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