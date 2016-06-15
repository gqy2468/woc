<?php
/**
 * 权限获取
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class Perm  {
	private $_permission;
	private $_rs;
	
	public function __construct( $user){
		if(!$user) return ;
		try{
			$rs_acl = new User_Permission();
			$this->_rs = $rs_acl->getDefaultAdapter()->query("select *from permission where rid='{$user->rid}'")->fetchAll();
		}catch (Zend_Db_Table_Exception $e){
			throw new Zend_Db_Table_Exception($e);
		}
	}

	public function getPerm(){
		return $this->_rs;
	}
}

?>