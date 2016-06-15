<?php /* Smarty version 2.6.22, created on 2011-10-19 17:39:03
         compiled from auth/login.phtml */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录WOC网站运营中心</title>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/yahoo-dom-event.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/yahoo.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/event.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/connection.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/json.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/login.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/jquery.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['r']; ?>
skin/style/login.css">
</head>
<body onload="document.getElementById('name').focus();">
<form name="login" action="<?php echo $this->_tpl_vars['r']; ?>
auth/login" method="post">
	<div id="conter">
	<div id="left"></div>
	<div id="right">
	<div id="right_logo">登录WOC网站运营中心</div>
	<div id="right_search">
	<div id="right_search1">用户名<br><input type="text" id="name" name="name" value="<?php echo $this->_tpl_vars['Name']; ?>
" size="25"/></div>
	<div id="right_search2">密码<br><input type="password" name="password" id="pass" value="" size="25"/></div>
	<div class="clear"></div>
	<div style="font-size:12px; color:#ff0000; margin-top:10px;"><?php echo $this->_tpl_vars['msgName']; ?>
<?php echo $this->_tpl_vars['msgPass']; ?>
<?php echo $this->_tpl_vars['msgError']; ?>
</div>
	</div>
	<div id="right_anniu"><input type="image" name="slogin" src="<?php echo $this->_tpl_vars['r']; ?>
skin/images/an.gif"/></div>
	<div id="right_foot">WOC ™ is a trademark of WOC. . Copyright © 2007-2011 WOC Software Inc(YJZZJ.COM).</div>
	</div>
	</div>
</form>
</body>
</html>