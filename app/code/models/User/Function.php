<?php
/**
 * 功能管理模块
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class User_Function extends Zend_Db_Table {
	protected $_name = "function";
	private $_select;
	
	public function listFunction(){
		return $this->getDefaultAdapter()->fetchAll($this->getDefaultAdapter()->select()->from('function')->order('Id desc'));
	}
	
	public function FunctionInfo($id){
		return $this->getDefaultAdapter()->fetchAll($this->getDefaultAdapter()->select()->from('function')->where('Id=?',$id));
	}
}

?>