<?php /* Smarty version 2.6.18, created on 2014-11-12 04:25:58
         compiled from 4/pwxgwg1415609879/channel_picture.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['header'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="clear"></div>

<div class="sub">

	<div class="subbtn">

        <a href="http://api.map.baidu.com/marker?location=<?php echo $this->_tpl_vars['company']['latitude']; ?>
,<?php echo $this->_tpl_vars['company']['longitude']; ?>
&title=<?php echo $this->_tpl_vars['company']['name']; ?>
&name=<?php echo $this->_tpl_vars['company']['name']; ?>
&content=<?php echo $this->_tpl_vars['company']['address']; ?>
&output=html&src=weiba|weiweb" title="地图" class="mapbtn"><p>地图</p></a>

        <a href="tel:<?php echo $this->_tpl_vars['company']['tel']; ?>
" title="电话" class="telbtn"><p>电话</p></a>

        <a href="<?php echo $this->_tpl_vars['homeurl']; ?>
"  title="首页" class="homebtn"><p>首页</p></a>

    </div>		   

        <ul class="productul">

        <?php if ($this->_tpl_vars['contents']): ?>

			<?php $_from = $this->_tpl_vars['contents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['a']):
?>

		        <li>

            <div>

                <a href="<?php echo $this->_tpl_vars['a']['link']; ?>
"  title="<?php echo $this->_tpl_vars['a']['title']; ?>
" class="proimg"><img src="<?php echo $this->_tpl_vars['a']['thumb']; ?>
"  alt="<?php echo $this->_tpl_vars['a']['title']; ?>
"></a>

                <p><a href="<?php echo $this->_tpl_vars['a']['link']; ?>
"  title="<?php echo $this->_tpl_vars['a']['title']; ?>
" class="heighta"><?php echo $this->_tpl_vars['a']['title']; ?>
</a></p>

                <div class="clear"></div>

            </div>

        </li>

        <?php endforeach; endif; unset($_from); ?>

		  <?php endif; ?>

          

		       

		    </ul>

    <div class="clear"></div>

    <div class="pages">

				<a class="next-left" href="<?php echo $this->_tpl_vars['previousPageLink']; ?>
">&lt;</a>

		<span><?php echo $this->_tpl_vars['currentPage']; ?>
/<?php echo $this->_tpl_vars['totalPage']; ?>
</span>

		<a class="pre-left" href="<?php echo $this->_tpl_vars['nextPageLink']; ?>
" >&gt;</a>

	        <div class="clear"></div>

    </div>

	</div>

<p class="subbottombg"></p>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['footer'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>