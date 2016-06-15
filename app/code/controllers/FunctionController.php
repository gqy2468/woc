<?php
/**
 * 功能管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class FunctionController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->func = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->func = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->func = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->func = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
	
	public function indexAction() {
		$this->_redirect ( "/function/list" );
	}
	
	public function addAction() {
		$this->view->msgFunction = "";
		$request = $this->getRequest();
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost("name")));
			if($name == ""){
				$this->view->msgFunction = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgFunction = "输入不能大于64个字符";
			}
			if($this->view->msgFunction == ""){
				$function = array(
					'name' => $name
				);
				try{
					$res = new User_Function();
					$res->insert($function);
					$this->_redirect('/function/list');
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}
	}
	
	public function editAction() {
		$this->view->msgFunction = "";
		$request = $this->getRequest();
		$id = trim($request->getParam("id"));
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost("name")));
			if($name == ""){
				$this->view->msgFunction = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgFunction = "输入不能大于64个字符";
			}
			if($this->view->msgFunction == ""){
				$Func = array('name'=>$name);
				try{
					$res = new User_Function();
					$where = $res->getDefaultAdapter()->quoteInto('Id=?',$id);
					$res->update( $Func, $where);
					$this->_redirect('/function/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			$Rs = new User_Function();
			try{
				$this->view->RsInfo= $Rs->FunctionInfo($id);
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function listAction() {
		$paginator = "";
		$request = $this->getRequest();
		$numPerPage = 15;
		$page = trim ($request->getParam('page'));
		if($page == ""){
			$page = 0;
		}else{
			$page = (int)$page;
		}
		$list = new User_Function ();
		if(!$paginator){
			$paginator = Zend_Paginator::factory($list->listFunction());
		}
		$paginator->setCurrentPageNumber($page)->setItemCountPerPage($numPerPage);
		$this->view->paginator = $paginator;
		Zend_Paginator::setDefaultScrollingStyle('Sliding');
		Zend_View_Helper_PaginationControl::setDefaultViewPartial('my_pagination_control.phtml');
		$this->view->pages = $paginator->getPages();
		$paginator->setView($this->view);
	}

	public function deleteAction() { 
		$request = $this->getRequest();
		$id = $request->getParam("id");
		$this->_helper->viewRenderer->setNoRender();
		if($id != ""){
			$res = new User_Function();
			try{
				$where = $res->getDefaultAdapter()->quoteInto('Id=?',$id);
				$res->delete($where);
				$this->_redirect("/function/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
}

?>