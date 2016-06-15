<?php /* Smarty version 2.6.22, created on 2011-10-19 17:28:15
         compiled from caches/list.phtml */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_header.lbi", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="col1"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_sidebar.lbi", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<div id="col2">
<div class="location">缓存管理</div>

<div class="massaction">
<a href="<?php echo $this->_tpl_vars['r']; ?>
caches/list">系统缓存</a>  |  
<a href="<?php echo $this->_tpl_vars['r']; ?>
caches/list/ctype/smarty">模板缓存</a>  |  
<a href="<?php echo $this->_tpl_vars['r']; ?>
caches/clear">更新系统缓存</a>  |  
<a href="<?php echo $this->_tpl_vars['r']; ?>
caches/clear/ctype/smarty">清空模板缓存</a>
</div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>文件名</td>
		<td>创建时间</td>
		<td>文件大小</td>
	</tr>
<?php $_from = $this->_tpl_vars['caches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<tr>
		<td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['item']['fname']; ?>
</td>
		<td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['item']['ftime']; ?>
</td>
		<td bgcolor="#F6F6F6"><?php echo $this->_tpl_vars['item']['fsize']; ?>
</td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_footer.lbi", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>