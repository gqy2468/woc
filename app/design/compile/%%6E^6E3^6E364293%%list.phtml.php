<?php /* Smarty version 2.6.22, created on 2011-10-19 17:29:20
         compiled from role/list.phtml */ ?>
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
<div class="location">角色管理</div>
  
<div class="massaction"><a href="<?php echo $this->_tpl_vars['r']; ?>
role/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>编号</td>
		<td>名称</td>
		<td>操作</td>
	</tr>
<?php $_from = $this->_tpl_vars['paginator']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['i']%2 == 0): ?>
	<tr bgcolor="#F6F6F6">
		<td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['r']; ?>
role/edit/id/<?php echo $this->_tpl_vars['item']['rid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['r']; ?>
role/delete/id/<?php echo $this->_tpl_vars['item']['rid']; ?>
">删除</a></td>
	</tr>
	<?php else: ?>
	<tr>
		<td><?php echo $this->_tpl_vars['item']['id']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
		<td><a href="<?php echo $this->_tpl_vars['r']; ?>
role/edit/id/<?php echo $this->_tpl_vars['item']['rid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['r']; ?>
role/delete/id/<?php echo $this->_tpl_vars['item']['rid']; ?>
">删除</a></td>
	</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="3" align="right"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "my_pagination_control.lbi", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
	</tr>
</table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "page_footer.lbi", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>