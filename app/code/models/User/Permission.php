<?php
/**
 * 权限管理模块
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class User_Permission extends Zend_Db_Table {
	protected $_name = "permission";

	public function PermInfo($rid){
		return $this->getDefaultAdapter()->select('permission')->where('rid=?',$rid);
	}
}

?>