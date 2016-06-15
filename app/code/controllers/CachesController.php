<?php
/**
 * 缓存管理
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2 
 */



class CachesController extends Action
{
	public function preDispatch() {
		if($this->getRequest()->getActionName() == "list"){
			$this->view->cac = "class='active'";
		}
		if($this->getRequest()->getActionName() == "clear"){
			$this->view->cac = "class='active'";
		}
		if($this->_engine !== "smarty"){
			$response = $this->getResponse ();
			$response->insert ( "sidebar", $this->view->render ( "sidebar.phtml" ) );
		}
	}
	
	public function indexAction() {
		$this->_redirect ( "/caches/list" );
	}
	
	public function listAction() {
		$request = $this->getRequest();
		$ctype = $request->getParam("ctype") ? $request->getParam("ctype") : "zend";
		$key = 0;
		if ($ctype=='zend') $cache_dir = opendir("cache");
		else $cache_dir = opendir("app/design/cache");
		while (($cache_file = readdir($cache_dir)) !== false)
		{
			if ($cache_file !== '.' && $cache_file !== '..') {
				$caches[$key]['fname'] = $cache_file;
				if ($ctype=='zend') $caches[$key]['ftime'] = date("Y-m-d H:i:s", filemtime("cache/".$cache_file));
				else $caches[$key]['ftime'] = 'N/A';
				if ($ctype=='zend') $caches[$key]['fsize'] = filesize("cache/".$cache_file);
				else $caches[$key]['fsize'] = 'N/A';
				$key++;
			}
		}
		closedir($cache_dir);
		if (isset($caches)) $this->view->caches = $caches;
	}

	public function clearAction() { 
		$request = $this->getRequest();
		$ctype = $request->getParam("ctype") ? $request->getParam("ctype") : "zend";
		try{
			if ($ctype=='zend') {
				$cache_dir = "cache/";
				$cache_handle = opendir("cache");
			} else {
				$cache_dir = "app/design/cache/";
				$cache_handle = opendir("app/design/cache");
			}
			while (($cache_file = readdir($cache_handle)) !== false)
			{
				unlink($cache_dir.$cache_file);
			}
			closedir($cache_dir);
			$this->_redirect("/caches/list/ctype/" . $ctype);	
		}catch (Zend_Db_Table_Exception $e){
			echo 'Clear Cache Error!';
		}
	}
}
