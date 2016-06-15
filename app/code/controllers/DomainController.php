<?php
/**
 * 域名管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class DomainController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->domain = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->domain = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->domain = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->domain = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
		
	public function indexAction(){
		
		$this->_redirect("/domain/list");
	}
	public function addAction() {
		
		$this->view->msgDomain = "";
		$request = $this->getRequest();
		
		if($request->isPost()){
			
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost("name")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$provider = trim($f->filter($request->getPost("provider")));
			$status = trim($f->filter($request->getPost("status")));
			
			
			if($name == ""){
				$this->view->msgDomain = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgDomain = "输入不能大于64个字符";
			}
			
			if($this->view->msgDomain == ""){
				
				$domain = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				
				try{
					$res = new User_Domain();
					$res->insert($domain);
					$this->_redirect('/domain/list');
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}
	}
	
	public function editAction() {
		
		$this->view->msgDomain = "";
		$request = $this->getRequest();
		$id = trim($request->getParam("id"));
		$site_type = new User_Type();
			
		try{			
			$this->view->type = $site_type->fetchAll()->toArray();	
		}catch (Zend_Db_Table_Exception $e){
			throw new Zend_Db_Table_Exception($e);
		}
		if($request->isPost()){
			
			$f = new Zend_Filter_StripTags();
			
			$name = trim($f->filter($request->getPost("name")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$provider = trim($f->filter($request->getPost("provider")));
			$status = trim($f->filter($request->getPost("status")));
			
			if($name == ""){
				$this->view->msgDomain = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgDomain = "输入不能大于64个字符";
			}
			
			if($this->view->msgDomain == ""){
				
				$Domain = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				
				try{
					$res = new User_Domain();
					$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
					$res->update( $Domain, $where);
					$this->_redirect('/domain/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			
			$Rs = new User_Domain();
			
			try{

				$where = $Rs->getDefaultAdapter()->quoteInto('id=?',$id);
				$this->view->rsInfo = $Rs->fetchRow($where)->toArray();
				
			}catch(Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
	
	public function listAction() {
		
		$paginator = "";
		$request = $this->getRequest();
		$numPerPage = 10;
		$page = trim ($request->getParam('page'));
		$id = $request->getParam("id");
		
		if($page == ""){
			$page = 0;
		}else{
			$page = (int)$page;
		}
		$list = new User_Domain();
		if(!$paginator){
			if($id=="")
			$paginator = Zend_Paginator::factory($list->fetchAll());
			else
			$paginator = Zend_Paginator::factory($list->fetchAll($list->getDefaultAdapter()->quoteInto('id=?',$id)));
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
			
			$res = new User_Domain();
			
			try{
				$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
				$res->delete($where);
				$this->_redirect("/domain/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
		
	}
}

?>