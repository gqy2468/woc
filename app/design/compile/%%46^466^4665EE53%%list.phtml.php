<?php /* Smarty version 2.6.22, created on 2011-10-19 17:29:22
         compiled from user/list.phtml */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'user/list.phtml', 29, false),)), $this); ?>
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
<div class="location">用户管理</div>  

<div class="massaction"><a href="<?php echo $this->_tpl_vars['r']; ?>
user/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
		<tr class="headings">
		<td>编号</td>
		<td>真实姓名</td>
		<td>所属分组</td>
		<td>电子邮箱</td>
		<td>联系电话</td>
		<td>状态</td>
		<td>最后登陆时间</td>
		<td>最后登陆ip</td>
		<td>操作</td>	
	</tr>
<?php $_from = $this->_tpl_vars['paginator']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['i']%2 == 0): ?>
		<tr bgcolor="#F6F6F6">
			<td><?php echo $this->_tpl_vars['item']['uid']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['rname']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['email']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['telphone']; ?>
</td>
			<td><?php if ($this->_tpl_vars['item']['status']): ?>启用<?php else: ?>禁止<?php endif; ?></td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['access'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['ip']; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['r']; ?>
user/edit/id/<?php echo $this->_tpl_vars['item']['uid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['r']; ?>
user/delete/id/<?php echo $this->_tpl_vars['item']['uid']; ?>
">删除</a></td>
		</tr>
	<?php else: ?>
		<tr>
			<td><?php echo $this->_tpl_vars['item']['uid']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['name']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['rname']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['email']; ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['telphone']; ?>
</td>
			<td><?php if ($this->_tpl_vars['item']['status']): ?>启用<?php else: ?>禁止<?php endif; ?></td>
			<td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['access'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</td>
			<td><?php echo $this->_tpl_vars['item']['ip']; ?>
</td>
			<td><a href="<?php echo $this->_tpl_vars['r']; ?>
user/edit/id/<?php echo $this->_tpl_vars['item']['uid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['r']; ?>
user/delete/id/<?php echo $this->_tpl_vars['item']['uid']; ?>
">删除</a></td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="9" align="right"><?php $_smarty_tpl_vars = $this->_tpl_vars;
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