<?php /* Smarty version 2.6.18, created on 2014-07-13 03:54:24
         compiled from 6/eigrjh1397208241/footer.html */ ?>
<?php if (! $this->_tpl_vars['homepage']): ?>

<p class="subbottom" id="subbottom">

    <a href="sms:<?php echo $this->_tpl_vars['company']['mp']; ?>
" title="短信" class="subsms">短信</a>

    <a href="http://site.tg.qq.com/forwardToPhonePage?siteId=1&phone=<?php echo $this->_tpl_vars['company']['tel']; ?>
" title="电话" class="subtel">电话</a>

    <a href="http://api.map.baidu.com/marker?location=<?php echo $this->_tpl_vars['company']['latitude']; ?>
,<?php echo $this->_tpl_vars['company']['longitude']; ?>
&title=<?php echo $this->_tpl_vars['company']['name']; ?>
&name=<?php echo $this->_tpl_vars['company']['name']; ?>
&content=<?php echo $this->_tpl_vars['company']['address']; ?>
&output=html&src=weiba|weiweb" title="地图" class="submap">地图</a>

</p>

<?php else: ?>

<p class="bottom"></p>

<?php endif; ?>

<!--menu start-->

<?php if ($this->_tpl_vars['showPlugMenu']): ?>

<link rel="stylesheet" href="/tpl/Wap/default/common/css/flash/css/plugmenu.css">

<div class="plug-div">

        <div class="plug-phone">

            <div class="plug-menu themeStyle" style="background:<?php echo $this->_tpl_vars['site']['plugmenucolor']; ?>
"><span class="close"></span></div> 

               <?php $_from = $this->_tpl_vars['plugmenus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['vo']):
?>

                        <div class="themeStyle plug-btn plug-btn<?php echo $this->_tpl_vars['k']+1; ?>
 close" style="background:<?php echo $this->_tpl_vars['site']['plugmenucolor']; ?>
">

							<a  href="<?php echo $this->_tpl_vars['vo']['url']; ?>
">

								<span style="background-image: url(/tpl/Wap/default/common/css/flash/images/img/<?php echo $this->_tpl_vars['vo']['name']; ?>
.png);" ></span>

							</a>

						</div>

                     <?php endforeach; endif; unset($_from); ?>

<div class="plug-btn plug-btn5 close"></div>

                    </div>

</div>

<script src="/tpl/Wap/default/common/css/flash/js/zepto.min.js" type="text/javascript"></script>

<script src="/tpl/Wap/default/common/css/flash/js/plugmenu.js" type="text/javascript"></script>

<?php endif; ?>

<!--menu end-->

</body>

</html>