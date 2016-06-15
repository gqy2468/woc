<?php
/**
 * 系统初始化
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19
 * @version    1.2 
 */

require_once 'Zend/Controller/Plugin/Abstract.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Controller/Request/Abstract.php';
require_once 'Zend/Controller/Action/HelperBroker.php';
require_once 'Zend/Cache.php';
 

/**
 * 
 * Initializes configuration depndeing on the type of environment 
 * (test, development, production, etc.)
 *  
 * This can be used to configure environment variables, databases, 
 * layouts, routers, helpers and more
 *   
 */
class Initializer extends Zend_Controller_Plugin_Abstract
{
    /**
     * @var Zend_Config
     */
    protected  $_config;

    /**
     * @var string Current environment
     */
    protected $_env;

    /**
     * @var Zend_Controller_Front
     */
    protected $_front;

    /**
     * @var string Path to application root
     */
    protected $_root;

    /**
     * 
     * @var object Database
     */
    protected $_db;

    /**
     * 
     * @var Zend_Cache
     */
    protected $_cache;

    /**
     * Constructor
     *
     * Initialize environment, root path, and configuration.
     * 
     * @param  string $env 
     * @param  string|null $root 
     * @return void
     */
    public function __construct($env = 'development', $root = null)
    {
        $this->setEnv($env);
        $root = (null === $root)?realpath(dirname(__FILE__).'/../'):$root;
        $this->_root = $root;
        $this->initPhpConfig();
    }

    /**
     * Initialize environment
     * 
     * @param  string $env 
     * @return void
     */
    protected function setEnv($env) 
    {
		$this->_env = $env;    	
    }

    /**
     * Initialize php config
     * 
     * @return void
     */
    public function initPhpConfig()
    {
		set_time_limit(60);
		error_reporting(E_ALL);
		ini_set('display_errors',1);
		ini_set('memory_limit','64M');
		date_default_timezone_set('Asia/Shanghai');
    }
    
    /**
     * Route startup
     * 
     * @return void
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {
       	$this->initCache();
       	$this->initConfig();
        $this->initModels();
        $this->initViews();
        $this->initControllers();
        $this->initHelpers();
        $this->initPlugins();
        $this->initRoutes();
    }
    
    /**
     * Initialize caches
     * 
     * @return void
     */
    public function initCache()
    {
		$fopt = array(
		    'master_file' => 'index.php',
			'automatic_serialization' => true
		);
		$bopt = array(
			'cache_dir' => 'cache'
		);
		$this->_cache = Zend_Cache::factory('File','File',$fopt,$bopt);
    }
    
    /**
     * Initialize databases
     * 
     * @return void
     */
    public function initConfig()
    {
		if (!$result = $this->_cache->load('config')) {
			try{
				$this->_config = new Zend_Config_Xml("./app/etc/config.xml");
			}catch (Zend_Config_Exception $config){
				throw new Exception($config);
			} 
			$this->_cache->save($this->_config,'config');
		} else {
			$this->_config = $result;
		}
    	try{
    		$this->_db=Zend_Db::factory($this->_config->database->adapter,$this->_config->database->params->toArray());
    	}catch (Zend_Db_Exception $db){
    		echo $db->getMessage();
    	}
    	Zend_Db_Table::setDefaultAdapter($this->_db);
    	$this->_db->query("set names 'utf8'");
    	Zend_Registry::set("db",$this->_db);
    	Zend_Registry::set("root",$this->_config->website->root);
    	Zend_Registry::set("engine",$this->_config->viewer->engine);
    }
    
    /**
     * Initialize models 
     * 
     * @return void
     */
    public function initModels()
    {
        set_include_path('./app/code/models' . PATH_SEPARATOR . get_include_path());
        $this->_front = Zend_Controller_Front::getInstance();
    }
    
    /**
     * Initialize view 
     * 
     * @return void
     */
    public function initViews()
    {
		if ($this->_config->viewer->engine == 'smarty') {
			//支持smarty，缓存默认关闭（caching为0）
			$frontViewer = new Zend_View_Smarty();
			$frontViewer->setConfig(array(
				'template' => 'app/design/templates',
				'compile' => 'app/design/compile',
				'cache' => 'app/design/cache',
				'caching' => $this->_config->viewer->cache
			));
			$frontViewer->setScriptPath('app/design/templates');
			$viewHelper = new Zend_Controller_Action_Helper_ViewRenderer($frontViewer);
			$viewHelper->setViewSuffix('phtml');
			Zend_Controller_Action_HelperBroker::addHelper($viewHelper);
			Zend_Registry::set("views",$frontViewer);
		} else {
			//不支持smarty
			$viewRenderer = Zend_Controller_Action_HelperBroker::getExistingHelper('viewRenderer');
			$viewRenderer->initView();
			$frontViewer = $viewRenderer->view;
			$frontViewer->setScriptPath('app/design/scripts');
			Zend_Registry::set("views",$frontViewer);
			Zend_Layout::startMvc(array(
				'layoutPath' => $this->_root . '/app/design/layouts',
				'layout' => 'main'
			));
		}
    }

    /**
     * Initialize controllers 
     * 
     * @return void
     */
    public function initControllers()
    {
    	$this->_front->setBaseUrl(Zend_Registry::get("root"));
    	$this->_front->addControllerDirectory($this->_root . '/app/code/controllers', 'default');
    }

    /**
     * Initialize helpers
     * 
     * @return void
     */
    public function initHelpers()
    {
    	Zend_Controller_Action_HelperBroker::addPath($this->_root . '/app/code/helpers', 'Zend_Controller_Action_Helper');
    }
    
    /**
     * Initialize plugins 
     * 
     * @return void
     */
    public function initPlugins()
    {   	
    }
    
    /**
     * Initialize routes
     * 
     * @return void
     */
    public function initRoutes()
    {
    }
}
?>
