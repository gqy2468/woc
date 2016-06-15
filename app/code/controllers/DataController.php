<?php
/**
 * 数据库管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class DataController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->data = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->data = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->data = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->data = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
		
	public function indexAction(){
		
		$this->_redirect("/data/list");
	}
	public function addAction() {
		
		$this->view->msgData = "";
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
				$this->view->msgData = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgData = "输入不能大于64个字符";
			}
			
			if($this->view->msgData == ""){
				
				$data = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				
				try{
					$res = new User_Data();
					$res->insert($data);
					$this->_redirect('/data/list');
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}
	}
	
	public function editAction() {
		
		$this->view->msgData = "";
		$request = $this->getRequest();
		$id = trim($request->getParam("id"));
		$product_type = new User_Type();
			
		try{			
			$this->view->product = $product_type->fetchAll()->toArray();	
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
				$this->view->msgData = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgData = "输入不能大于64个字符";
			}
			
			if($this->view->msgData == ""){
				
				$Data = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				
				try{
					$res = new User_Data();
					$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
					$res->update( $Data, $where);
					$this->_redirect('/data/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			
			$Rs = new User_Data();
			
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
		$list = new User_Data();
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
			
			$res = new User_Data();
			
			try{
				$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
				$res->delete($where);
				$this->_redirect("/data/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
		
	}
}

?>