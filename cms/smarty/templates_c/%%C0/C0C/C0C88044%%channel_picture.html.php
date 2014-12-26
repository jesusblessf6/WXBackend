<?php /* Smarty version 2.6.18, created on 2014-11-12 22:43:04
         compiled from 1/piawnl1410399190/channel_picture.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['header'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><div class="sub">
<?php if ($this->_tpl_vars['subChannels']): ?>
		<div class="clickbtn">
        <div class="classbtn"><p>打开分类</p></div>
        <div class="classbtn2"><p>关闭分类</p></div>
    </div>
	<div class="clear"></div>
    <ul class="subnav">
	 <?php $_from = $this->_tpl_vars['subChannels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sc']):
?>
          <li><a href="<?php echo $this->_tpl_vars['sc']['link']; ?>
" tppabs="/3g/product.php?tid=3" class="ui-bar-g" data-ajax="false"><?php echo $this->_tpl_vars['sc']['name']; ?>
</a></li>
          <?php endforeach; endif; unset($_from); ?>
                <div class="clear"></div>
    </ul>
	<?php endif; ?>
	<div class="clear"></div>
	    	<ul class="productul" style="margin-top:20px;">
			<?php if ($this->_tpl_vars['contents']): ?>
			<?php $_from = $this->_tpl_vars['contents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['a']):
?>
		    	<li><center>
        	<a href="<?php echo $this->_tpl_vars['a']['link']; ?>
"><img src="<?php echo $this->_tpl_vars['a']['thumb']; ?>
" alt="<?php echo $this->_tpl_vars['a']['title']; ?>
"></a>
        	<p><a href="<?php echo $this->_tpl_vars['a']['link']; ?>
"><?php echo $this->_tpl_vars['a']['title']; ?>
</a></p>
        </center></li>
		    	 <?php endforeach; endif; unset($_from); ?>
			 <?php endif; ?>
		    </ul>
    <div class="clear"></div>
					<div class="pages">
						<a href="<?php echo $this->_tpl_vars['previousPageLink']; ?>
" title="上一页"<?php if ($this->_tpl_vars['previousPageLink'] == 'javascript:void(0)'): ?> class="no_prev"<?php else: ?> class="prev"<?php endif; ?>>上一页</a>
						<a href="#bg" title="分页列表" class="page"><span><?php echo $this->_tpl_vars['currentPage']; ?>
/<?php echo $this->_tpl_vars['totalPage']; ?>
</span></a>
						<a href="<?php echo $this->_tpl_vars['nextPageLink']; ?>
" title="下一页"<?php if ($this->_tpl_vars['previousPageLink'] == 'javascript:void(0)'): ?> class="no_next"<?php else: ?> class="next"<?php endif; ?>>下一页</a>
					</div>
		<ul class="topages">
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['totalPage']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?> 
									<li><a href="<?php echo $this->_tpl_vars['channel']['link']; ?>
&page=<?php echo $this->_sections['loop']['index']+1; ?>
" title="第<?php echo $this->_sections['loop']['index']+1; ?>
页">第<?php echo $this->_sections['loop']['index']+1; ?>
页</a></li>
			<?php endfor; endif; ?>
								</ul>
		<a class="bg" id="bg" href="#subbottom"></a>
			</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['footer'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>