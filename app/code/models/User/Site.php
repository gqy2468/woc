<?php
/**
 * 网站管理模块
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class User_Site extends Zend_Db_Table {
	protected $_name = "site";
	
	public function getSiteInfo($id = ""){
		if($id == "") return;
		return $this->getDefaultAdapter()->select()->from("site","*")->where("site.sid=?",$id)->join("type","type.ptid=site.ptid","type.name as pname")->where("site.ptid=type.ptid")->query()->fetchAll();
	}
}

?>