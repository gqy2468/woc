<?php
/**
 * 角色管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class RoleController extends Action {
	
	public function preDispatch() {
		$this->view->rolelist = "class='active'";	
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
	
	public function indexAction() {
		$this->_redirect ( "/role/list" );
	}
	
	public function addAction() {
		
		$this->view->msgRole = "";
		$request = $this->getRequest();
		$str_res = "";
		if($request->isPost()){
			
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			$res = trim($request->getPost('resource'));

			try{
				$rs = new User_Function();
				$this->view->rs = $rs->listFunction();
		
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			if($name == ""){
				$this->view->msgRole = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgRole = "输入不能大于64个字符";
			}

			if($res == "0"){
				$str_res = $res;
			}else{
				$res_detail = $request->getPost('role');
				$str_res = implode(",",$res_detail);
	
			}
			
			if($this->view->msgRole == ""){
				
				$uid = rand(1,999999*microtime());
				
				$Role = array(
					'rid'  => $uid,
					'name' => $name
				);
				
				$permission = array(
					'rid'  => $uid,
					'perm' => $str_res
				);
				try{
					$perm = new User_Permission();
					$rl = new User_Role();
					$rl->getDefaultAdapter()->beginTransaction();
					$rl->insert($Role);
					$perm->insert($permission);
					$rl->getDefaultAdapter()->commit();
					$this->_redirect("/role/list");
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}else{
			
			try{
				$rs = new User_Function();
				$this->view->rs = $rs->listFunction();
		
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function editAction(){
		
		$this->view->msgRole = "";
		$request = $this->getRequest();
		$id = $request->getParam('id');
		
		if($request->isPost()){
			
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			$r_isall = trim($request->getPost('resource'));
			
			try{
				$rs = new User_Role();
				$res = new User_Function();
				$perm = new User_Permission();
				
				$this->view->res = $res->listFunction();
				$where = $rs->getDefaultAdapter()->quoteInto('rid=?',$id);
				$this->view->rsInfo = $rs->fetchRow($where)->toArray();
				$p_where = $perm->getDefaultAdapter()->quoteInto('rid=?',$this->view->rsInfo['rid']);
				$this->view->permInfo = $perm->fetchRow($p_where);
				$this->view->rs = $rs->listRole();
				
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			
			if($r_isall == "0"){
				$str_res = $r_isall;
			}else{
				$res_detail = $request->getPost('role');
				$str_res = implode(",",$res_detail);
	
			}
		
			if($this->view->msgRole == ""){
				
				$uid = rand(1,999999*microtime());
				
				$Role = array(
					'rid'  => $uid,
					'name' => $name
				);
				
				$permission = array(
					'rid'  => $uid,
					'perm' => $str_res
				);
				try{
					$perm = new User_Permission();
					$rl = new User_Role();
					$rl->getDefaultAdapter()->beginTransaction();
					$where = $rl->getDefaultAdapter()->quoteInto('rid=?',$id);
					$p_where = $perm->getDefaultAdapter()->quoteInto('rid=?',$id);
					$rl->update( $Role, $where);
					$perm->update($permission, $p_where);
					$rl->getDefaultAdapter()->commit();
					$this->_redirect("/role/list");
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
			
		}else{
			try{
				$rs = new User_Role();
				$res = new User_Function();
				$perm = new User_Permission();
				
				$this->view->res = $res->listFunction();
				$where = $rs->getDefaultAdapter()->quoteInto('rid=?',$id);
				$this->view->rsInfo = $rs->fetchRow($where)->toArray();
				$p_where = $perm->getDefaultAdapter()->quoteInto('rid=?',$this->view->rsInfo['rid']);
				$this->view->permInfo = $perm->fetchRow($p_where);
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function listAction(){
		
		$paginator = "";
		$request = $this->getRequest();
		$numPerPage = 15;
		$page = trim ($request->getParam('page'));
		
		if($page == ""){
			$page = 0;
		}else{
			$page = (int)$page;
		}
		$list = new User_Role();
		if(!$paginator){
			$paginator = Zend_Paginator::factory($list->listRole());
		}
		$paginator->setCurrentPageNumber($page)->setItemCountPerPage($numPerPage);
		
		$this->view->paginator = $paginator;
		
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial('my_pagination_control.phtml');
		$this->view->pages = $paginator->getPages();
		$paginator->setView($this->view);
	}
	
	public function deleteAction(){
		
		$request = $this->getRequest();
		$id = $request->getParam("id");
		$this->_helper->viewRenderer->setNoRender();
		if($id != ""){
			
			$rs = new User_Role();
			$pm = new User_Permission();
			
			try{
				$where = $rs->getDefaultAdapter()->quoteInto('rid=?',$id);
				$p_where = $pm->getDefaultAdapter()->quoteInto('rid=?',$id);
				$rs->getDefaultAdapter()->beginTransaction();
					$rs->delete($where);
					$pm->delete($p_where);
				$rs->getDefaultAdapter()->commit();
				$this->_redirect("/role/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
}

?>