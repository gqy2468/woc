<?php /* Smarty version 2.6.22, created on 2011-10-19 17:07:16
         compiled from page_sidebar.lbi */ ?>


   <div class="tabs_menu">
	<h3>运营管理</h3>
	<?php if ($this->_tpl_vars['permission']['0']['perm']): ?>
	<ul>
		<?php if ("/网站管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
site/" <?php echo $this->_tpl_vars['site']; ?>
>网站管理</a></li>
		<?php endif; ?>
		<?php if ("/域名管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
domain/" <?php echo $this->_tpl_vars['domain']; ?>
>域名管理</a></li>
		<?php endif; ?>
		<?php if ("/主机管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
host/" <?php echo $this->_tpl_vars['host']; ?>
>主机管理</a></li>
		<?php endif; ?>
		<?php if ("/数据管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
data/" <?php echo $this->_tpl_vars['data']; ?>
>数据管理</a></li>
		<?php endif; ?>
		<?php if ("/邮箱管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
email/" <?php echo $this->_tpl_vars['email']; ?>
>邮箱管理</a></li>
		<?php endif; ?>
	</ul>
	<?php else: ?>
	<ul>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
site/" <?php echo $this->_tpl_vars['site']; ?>
>网站管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
domain/" <?php echo $this->_tpl_vars['domain']; ?>
>域名管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
host/" <?php echo $this->_tpl_vars['host']; ?>
>主机管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
data/" <?php echo $this->_tpl_vars['data']; ?>
>数据管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
email/" <?php echo $this->_tpl_vars['email']; ?>
>邮箱管理</a></li>
	</ul>
	<?php endif; ?>
	<h3>系统管理</h3>
	<?php if ($this->_tpl_vars['permission']['0']['perm']): ?>
	<ul>
		<?php if ("/用户管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>		
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
user/" <?php echo $this->_tpl_vars['userlist']; ?>
>用户管理</a></li>
		<?php endif; ?>
		<?php if ("/角色管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>	
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
role/" <?php echo $this->_tpl_vars['rolelist']; ?>
>角色管理</a></li>
		<?php endif; ?>
		<?php if ("/分类管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
type/" <?php echo $this->_tpl_vars['type']; ?>
>分类管理</a></li>
		<?php endif; ?>
		<?php if ("/功能管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
function/" <?php echo $this->_tpl_vars['func']; ?>
>功能管理</a></li>
		<?php endif; ?>
		<?php if ("/缓存管理/" == $this->_tpl_vars['permission']['0']['perm']): ?>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
caches/" <?php echo $this->_tpl_vars['cac']; ?>
>缓存管理</a></li>
		<?php endif; ?>
	</ul>
	<?php else: ?>
	<ul>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
user/" <?php echo $this->_tpl_vars['userlist']; ?>
>用户管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
role/" <?php echo $this->_tpl_vars['rolelist']; ?>
>角色管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
type/" <?php echo $this->_tpl_vars['type']; ?>
>分类管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
function/" <?php echo $this->_tpl_vars['func']; ?>
>功能管理</a></li>
			<li><a href="<?php echo $this->_tpl_vars['r']; ?>
caches/" <?php echo $this->_tpl_vars['cac']; ?>
>缓存管理</a></li>
	</ul>
	<?php endif; ?>

</div>