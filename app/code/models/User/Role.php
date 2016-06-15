<?php
/**
 * 角色管理模块
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class User_Role extends Zend_Db_Table {
	protected $_name = "role";
	
	public function listRole(){
		return $this->getDefaultAdapter()->select()->from('role')->order('id desc');
	}
	
	public function RoleInfo($id){
		return $this->getDefaultAdapter()->select()->from('role')->where('id=?',$id);
	}
}

?>