<?php
/**
 * 用户管理模块
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class User extends Zend_Db_Table {
	protected $_name = "users";
	
	public function listUser(){
		return $this->getDefaultAdapter()->select()->from('users')->order('uid desc');
	}
}

?>