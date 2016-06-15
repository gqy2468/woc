<?php
/**
 * 主机管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class HostController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->host = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->host = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->host = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->host = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
		
	public function indexAction(){
		$this->_redirect("/host/list");
	}
	public function addAction() {
		$this->view->msgHost = "";
		$request = $this->getRequest();
		
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$ip = trim($f->filter($request->getPost("ip")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$provider = trim($f->filter($request->getPost("provider")));
			$status = trim($f->filter($request->getPost("status")));
			if($ip == ""){
				$this->view->msgHost = "必填选项不能留空";
			}else if(strlen($ip)> 64){
				$this->view->msgHost = "输入不能大于64个字符";
			}
			if($this->view->msgHost == ""){
				$host = array(
					'ip' => $ip,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'provider' => $provider,
					'status' => $status
				);
				try{
					$res = new User_Host();
					$res->insert($host);
					$this->_redirect('/host/list');
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}
	}
	
	public function editAction() {
		$this->view->msgHost = "";
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
			$ip = trim($f->filter($request->getPost("ip")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$provider = trim($f->filter($request->getPost("provider")));
			$status = trim($f->filter($request->getPost("status")));
			if($ip == ""){
				$this->view->msgHost = "必填选项不能留空";
			}else if(strlen($ip) > 64){
				$this->view->msgHost = "输入不能大于64个字符";
			}
			if($this->view->msgHost == ""){
				$Host = array('ip'=>$ip,'admin' => $admin,'username' => $username,'password' => $password,'provider' => $provider,'status' => $status);
				try{
					$res = new User_Host();
					$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
					$res->update( $Host, $where);
					$this->_redirect('/host/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			$Rs = new User_Host();
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
		$list = new User_Host();
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
			$res = new User_Host();
			try{
				$where = $res->getDefaultAdapter()->quoteInto('id=?',$id);
				$res->delete($where);
				$this->_redirect("/host/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
}

?>