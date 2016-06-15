<?php /* Smarty version 2.6.22, created on 2011-10-19 17:29:17
         compiled from my_pagination_control.lbi */ ?>
<?php if ($this->_tpl_vars['pages']->pageCount): ?>
<div class="vpager">
<ul class="pager">
<li><label>当前页记录:</label><?php echo $this->_tpl_vars['pages']->currentItemCount; ?>
</li>
<li><label>总记录:</label><?php echo $this->_tpl_vars['pages']->totalItemCount; ?>
</li>
<li><label>总页数:</label><?php echo $this->_tpl_vars['pages']->pageCount; ?>
</li>
<!-- Previous page link -->
<?php if ($this->_tpl_vars['pages']->previous): ?>  
<li><a href="<?php echo $this->_tpl_vars['pages']->previous; ?>
">    &lt; Previous  </a></li>
<?php else: ?>
<li class="prev">&lt; Previous</li>
<?php endif; ?>
<!-- Numbered page links --> <?php echo $this->_tpl_vars['pages']->current; ?>

<?php $_from = $this->_tpl_vars['pages']->pagesInRange; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>  
<?php if ($this->_tpl_vars['page'] != $this->_tpl_vars['pages']->current): ?>   
<li><a href="<?php echo $this->_tpl_vars['page']; ?>
"> <?php echo $this->_tpl_vars['page']; ?>
 </a></li>
<?php else: ?>
<li  class="active"> <?php echo $this->_tpl_vars['page']; ?>
 </li>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<!-- Next page link -->
<?php if ($this->_tpl_vars['pages']->next): ?>
<li class="next"><a href="<?php echo $this->_tpl_vars['pages']->next; ?>
">    Next &gt;  </a></li>
<?php else: ?>
<li>Next &gt;</li>
<?php endif; ?>
</ul>
</div>
<?php endif; ?>

 
