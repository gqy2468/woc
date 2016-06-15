<?php /* Smarty version 2.6.22, created on 2011-10-19 17:07:16
         compiled from page_header.lbi */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'page_header.lbi', 27, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WOC Website Operations Center</title>
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
skin/js/jquery.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/layer.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/TableSorter.js"></script>
<script language="text/javascript" src="<?php echo $this->_tpl_vars['r']; ?>
skin/js/viewNote.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['r']; ?>
skin/style/css.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['r']; ?>
skin/style/style.css">
<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['r']; ?>
skin/style/web.css">
</head>
<body>
<div id="mask"></div>
<div id="append_parent"></div>
<div id="float_window"></div>
<div id="header">
	  <h1 class="logo"><a href="<?php echo $this->_tpl_vars['r']; ?>
">logo</a></h1>
	  <ul class="header_right">
	   <li>Logged in as </li>
	   <li><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</li>
	   <li class="logOut"><a href="<?php echo $this->_tpl_vars['r']; ?>
auth/logout">logOut</a></li>
	  </ul>
</div>  
<div class="messageBox">
<div id="_x"></div>
</div>
<div id="pg_margins">