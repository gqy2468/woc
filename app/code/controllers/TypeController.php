<?php
/**
 * 分类管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class TypeController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->type = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->type = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->type = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->type = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}

	public function indexAction() {
		$this->_redirect ( "/type/list" );
	}
	
	public function addAction() {
		$this->view->msgPT = "";
		$request = $this->getRequest();
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			try{
				$rs = new User_Site();
				$this->view->rs = $rs->fetchAll()->toArray();
		
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			if($name == ""){
				$this->view->msgPT = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgPT = "输入不能大于64个字符";
			}
			if($this->view->msgPT == ""){
				$uid = rand(1,999999*microtime());
				$Pro = array(
					'tid'  => $uid,
					'name' => $name
				);
				try{
					$rl = new User_Type();
					$rl->getDefaultAdapter()->beginTransaction();
					$rl->insert($Pro);
					$rl->getDefaultAdapter()->commit();
					$this->_redirect("/type/list");
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}else{
			try{
				$rs = new User_Site();
				$this->view->rs = $rs->fetchAll()->toArray();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function editAction(){
		$this->view->msgPT = "";
		$request = $this->getRequest();
		$id = $request->getParam('id');
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost('name')));
			try{
				$rs = new User_Type();
				$where = $rs->getDefaultAdapter()->quoteInto('tid=?',$id);
				$this->view->rsInfo = $rs->fetchRow($where);
				$this->view->rs = $rs->fetchAll();
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
			if($this->view->msgPT == ""){		
				$PT = array(
					'name' => $name
				);
				try{
					$rl = new User_Type();
					$rl->getDefaultAdapter()->beginTransaction();
					$where = $rl->getDefaultAdapter()->quoteInto('tid=?',$id);
					$rl->update( $PT, $where);
					$rl->getDefaultAdapter()->commit();
					$this->_redirect("/type/list");
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}else{
			try{
				$rs = new User_Type();
				$where = $rs->getDefaultAdapter()->quoteInto('tid=?',$id);
				$this->view->rsInfo = $rs->fetchRow($where)->toArray();
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
		$list = new User_Type();
		if(!$paginator){
			$paginator = Zend_Paginator::factory($list->fetchAll());
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
			$rs = new User_Type();
			try{
				$where = $rs->getDefaultAdapter()->quoteInto('tid=?',$id);
				$rs->getDefaultAdapter()->beginTransaction();
				$rs->delete($where);
				$rs->getDefaultAdapter()->commit();
				$this->_redirect("/type/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
}

?>