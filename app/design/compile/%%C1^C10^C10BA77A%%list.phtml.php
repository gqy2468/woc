<?php /* Smarty version 2.6.22, created on 2011-10-19 17:29:25
         compiled from site/list.phtml */ ?>
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
<div class="location">网站管理</div>

<div class="massaction"><a href="<?php echo $this->_tpl_vars['r']; ?>
site/add">添加</a></div>
	
<table class="bd_c_1" cellpadding="0" cellspacing="0">
	<tr class="headings">
		<td>编号</td>
		<td>名称</td>
		<td>账号</td>
		<td>密码</td>
		<td>订单数量</td>
		<td>客户数量</td>
		<td>状态</td>
		<td>操作</td>
	</tr>
<?php $_from = $this->_tpl_vars['paginator']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['i'] => $this->_tpl_vars['item']):
?>
<?php if ($this->_tpl_vars['i']%2 == 0): ?>
	<tr bgcolor="#F6F6F6">
		<td><?php echo $this->_tpl_vars['item']['sid']; ?>
</td>
		<td><a target="_blank" href="http://<?php echo $this->_tpl_vars['item']['name']; ?>
/"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['item']['username']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['password']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['mynum']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['mynum2']; ?>
</td>
		<td>
		     <?php if (0 == $this->_tpl_vars['item']['status']): ?>使用中
		     <?php elseif (1 == $this->_tpl_vars['item']['status']): ?>已出错
		     <?php elseif (2 == $this->_tpl_vars['item']['status']): ?>维护中
		     <?php elseif (3 == $this->_tpl_vars['item']['status']): ?>已停用
		     <?php endif; ?>
		</td>
		<td>
		<a target="_blank" href="http://<?php echo $this->_tpl_vars['item']['admin']; ?>
/">管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
site/edit/id/<?php echo $this->_tpl_vars['item']['sid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
site/delete/id/<?php echo $this->_tpl_vars['item']['sid']; ?>
">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
domain/list/id/<?php echo $this->_tpl_vars['item']['dmid']; ?>
">域名</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
host/list/id/<?php echo $this->_tpl_vars['item']['hid']; ?>
">主机</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
data/list/id/<?php echo $this->_tpl_vars['item']['dbid']; ?>
">数据库</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
email/list/id/<?php echo $this->_tpl_vars['item']['eid']; ?>
">邮箱</a>
		</td>
	</tr>
<?php else: ?>
	<tr>
		<td><?php echo $this->_tpl_vars['item']['sid']; ?>
</td>
		<td><a target="_blank" href="http://<?php echo $this->_tpl_vars['item']['name']; ?>
/"><?php echo $this->_tpl_vars['item']['name']; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['item']['username']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['password']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['mynum']; ?>
</td>
		<td><?php echo $this->_tpl_vars['item']['mynum2']; ?>
</td>
		<td>
		     <?php if (0 == $this->_tpl_vars['item']['status']): ?>使用中
		     <?php elseif (1 == $this->_tpl_vars['item']['status']): ?>已出错
		     <?php elseif (2 == $this->_tpl_vars['item']['status']): ?>维护中
		     <?php elseif (3 == $this->_tpl_vars['item']['status']): ?>已停用
		     <?php endif; ?>
		</td>
		<td>
		<a target="_blank" href="http://<?php echo $this->_tpl_vars['item']['admin']; ?>
/">管理</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
site/edit/id/<?php echo $this->_tpl_vars['item']['sid']; ?>
">修改</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
site/delete/id/<?php echo $this->_tpl_vars['item']['sid']; ?>
">删除</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
domain/list/id/<?php echo $this->_tpl_vars['item']['dmid']; ?>
">域名</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
host/list/id/<?php echo $this->_tpl_vars['item']['hid']; ?>
">主机</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
data/list/id/<?php echo $this->_tpl_vars['item']['dbid']; ?>
">数据库</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a href="<?php echo $this->_tpl_vars['r']; ?>
email/list/id/<?php echo $this->_tpl_vars['item']['eid']; ?>
">邮箱</a>
		</td>
	</tr>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
	<tr>
		<td colspan="8" align="right"><?php $_smarty_tpl_vars = $this->_tpl_vars;
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