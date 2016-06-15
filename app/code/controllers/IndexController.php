<?php
/**
 * IndexController
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */


class IndexController extends Action 
{
	public function preDispatch() {
	}
	
    public function indexAction() 
    {
    	$this->_redirect("/site");
    }
}
