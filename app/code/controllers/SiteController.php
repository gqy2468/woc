<?php
/**
 * 站点管理控制器
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */

class SiteController extends Action {

	public function preDispatch() {
		if($this->getRequest()->getActionName() == "add"){
			$this->view->site = "class='active'";
		}
		if($this->getRequest()->getActionName() == "list"){
			$this->view->site = "class='active'";
		}
		if($this->getRequest()->getActionName() == "edit"){
			$this->view->site = "class='active'";
		}
		if($this->getRequest()->getActionName() == "delete"){
			$this->view->site = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
		
	public function indexAction(){
		$this->_redirect("/site/list");
	}

	public function addAction() {
		$this->view->msgSite = "";
		$request = $this->getRequest();
		try{
			$product = new User_Type();
			$this->view->type = $product->fetchAll()->toArray();
			$domain = new User_Domain();
			$this->view->domain = $domain->fetchAll()->toArray();
			$host = new User_Host();
			$this->view->host = $host->fetchAll()->toArray();
			$data = new User_Data();
			$this->view->data = $data->fetchAll()->toArray();
			$email = new User_Email();
			$this->view->email = $email->fetchAll()->toArray();
		}catch(Zend_Db_Table_Exception $e){
			throw new Zend_Db_Table_Exception($e);
		}
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost("name")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$method = trim($f->filter($request->getPost("method")));
			$status = trim($f->filter($request->getPost("status")));
			$type_id = trim($f->filter($request->getPost("site_type")));
			$domain_id = trim($f->filter($request->getPost("domain")));
			$host_id = trim($f->filter($request->getPost("host")));
			$data_id = trim($f->filter($request->getPost("data")));
			$email_id = trim($f->filter($request->getPost("email")));
			if($name == ""){
				$this->view->msgSite = "必填选项不能留空";
			}else if(strlen($name)> 64){
				$this->view->msgSite = "输入不能大于64个字符";
			}
			if($this->view->msgSite == ""){
				$site = array(
					'name' => $name,
					'admin' => $admin,
					'username' => $username,
					'password' => $password,
					'method' => $method,
					'status' => $status,
					'tid' => $type_id,
					'dmid' => $domain_id,
					'hid' => $host_id,
					'dbid' => $data_id,
					'eid' => $email_id
				);
				$rnum = array(
					'sname' => $name,
					'onum'=>0,
					'cnum'=>0
				);
				try{
					$res = new User_Site();
					$res->insert($site);
					$res2 = new User_Rnum();
					$res2->insert($rnum);
					$this->_redirect('/site/list');
				}catch (Zend_Db_Table_Exception $re){
					throw new Zend_Db_Table_Exception($re);
				}
			}
		}
	}
	
	public function editAction() {
		$this->view->msgSite = "";
		$request = $this->getRequest();
		$id = trim($request->getParam("id"));
		try{
		    $sitet_type = new User_Type();
			$this->view->type = $sitet_type->fetchAll()->toArray();	
			$domain = new User_Domain();
			$this->view->domain = $domain->fetchAll()->toArray();
			$host = new User_Host();
			$this->view->host = $host->fetchAll()->toArray();
			$data = new User_Data();
			$this->view->data = $data->fetchAll()->toArray();
			$email = new User_Email();
			$this->view->email = $email->fetchAll()->toArray();
		}catch (Zend_Db_Table_Exception $e){
			throw new Zend_Db_Table_Exception($e);
		}
		if($request->isPost()){
			$f = new Zend_Filter_StripTags();
			$name = trim($f->filter($request->getPost("name")));
			$admin = trim($f->filter($request->getPost("admin")));
			$username = trim($f->filter($request->getPost("username")));
			$password = trim($f->filter($request->getPost("password")));
			$method = trim($f->filter($request->getPost("method")));
			$status = trim($f->filter($request->getPost("status")));
			$onum = trim($f->filter($request->getPost("onum")));
			$cnum = trim($f->filter($request->getPost("cnum")));
			$type_id = trim($f->filter($request->getPost("site_type")));
			$domain_id = trim($f->filter($request->getPost("domain")));
			$host_id = trim($f->filter($request->getPost("host")));
			$data_id = trim($f->filter($request->getPost("data")));
			$email_id = trim($f->filter($request->getPost("email")));
			$oldname = trim($f->filter($request->getPost("oldname")));
			if($name == ""){
				$this->view->msgSite = "必填选项不能留空";
			}else if(strlen($name) > 64){
				$this->view->msgSite = "输入不能大于64个字符";
			}
			if($this->view->msgSite == ""){
				$Site = array('name'=>$name,'admin' => $admin,'username' => $username,'password' => $password,'method' => $method,'status' => $status,'tid'=>$type_id,'dmid' => $domain_id,'hid' => $host_id,'dbid' => $data_id,'eid' => $email_id);
				$Rnum = array('sname'=>$name,'onum'=>$onum,'cnum'=>$cnum);
				try{
					$res = new User_Site();
					$where = $res->getDefaultAdapter()->quoteInto('sid=?',$id);
					$res->update( $Site, $where);
					$res2 = new User_Rnum();
					$where2 = $res2->getDefaultAdapter()->quoteInto('sname=?',$oldname);
					$res2->update( $Rnum, $where2);
					$this->_redirect('/site/list');
				}catch (Zend_Db_Table_Exception $e){
					throw new Zend_Db_Table_Exception($e);
				}
			}
		}else{
			$Rs = new User_Site();
			$Rs2 = new User_Rnum();
			try{
				$where = $Rs->getDefaultAdapter()->quoteInto('sid=?',$id);
				$this->view->rsInfo = $Rs->fetchRow($where)->toArray();
				$where2 = $Rs2->getDefaultAdapter()->quoteInto('sname=?',$this->view->rsInfo['name']);
				$this->view->rsNum = $Rs2->fetchRow($where2)->toArray();
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
		if($page == ""){
			$page = 0;
		}else{
			$page = (int)$page;
		}
		$list = new User_Site();
		$sites = $list->fetchAll()->toArray();
		foreach ($sites as $key => $site) {
			$res = new User_Rnum(); 
			$where = $res->getDefaultAdapter()->quoteInto('sname = ?', $site['name']); 
			$row = $res->fetchRow($where)->toArray(); 
			$sites[$key]['mynum'] = $row['onum']; 
			$sites[$key]['mynum2'] = $row['cnum']; 
		}
		if(!$paginator){
			$paginator = Zend_Paginator::factory($sites);
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
			$res = new User_Site();
			$res2 = new User_Rnum();
			try{
				$where = $res->getDefaultAdapter()->quoteInto('sid=?',$id);
				$row = $res->fetchRow($where)->toArray();
				$res->delete($where);
				$where2 = $res2->getDefaultAdapter()->quoteInto('sname=?',$row['name']);
				$res2->delete($where2);
				$this->_redirect("/site/list");	
			}catch (Zend_Db_Table_Exception $e){
				throw new Zend_Db_Table_Exception($e);
			}
		}
	}
}

?>