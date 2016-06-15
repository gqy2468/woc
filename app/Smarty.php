<?php
/**
 * Smarty封装类
 * 
 * @author     yjzzj.com 
 * @date       2011-10-19 
 * @version    1.2
 */

require_once 'Zend/View/Abstract.php';
require_once 'Smarty/Smarty.class.php';

class Zend_View_Smarty extends Zend_View_Abstract
{
    /**
    * Smarty对象
    * @var Smarty
    */
    protected $_smarty;

    /**
     * 构造方法
     * 
     * @param  string   $tplPath 
     * @param  array    $extParams 
     * @return void
     */
    public function __construct($tplPath = null, $extParams = array())
    {
        $this->_smarty = new Smarty;
		if ($tplPath !== null) $this->setPath($tplPath);
		foreach ($extParams as $key => $value) {
			$this->_smarty->$key = $value;
		}
    }

    /**
     * 返回模板引擎对象
     * 
     * @return class
     */
    public function getEngine()
    {
        return $this->_smarty;
    }

    /**
     * Prevent E_NOTICE for nonexistent values
     *
     * If {@link strictVars()} is on, raises a notice.
     *
     * @param  string $key
     * @return null
     */
    public function __get($key)
    {
        if ($this->_strictVars) {
            trigger_error('Key "' . $key . '" does not exist', E_USER_NOTICE);
        }

        return null;
    }

    /**
     * Assign a variable to the view
     *
     * @param string $key The variable name.
     * @param mixed $val The variable value.
     * @return void
     */
    public function __set($key,$val)
    {
        $this->_smarty->assign($key,$val);
        if ('_' != substr($key, 0, 1)) {
            $this->$key = $val;
            return;
        }

        require_once 'Zend/View/Exception.php';
        throw new Zend_View_Exception('Setting private or protected class members is not allowed', $this);
    }

    /**
     * Allows testing with empty() and isset() to work
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        $var = $this->_smarty->get_template_vars($key);
        if($var)
            return true;
        
        return false;
    }

    /**
     * Allows unset() on object properties to work
     *
     * @param string $key
     * @return void
     */
    public function __unset($key)
    {
        $this->_smarty->clear_assign($key);
        if ('_' != substr($key, 0, 1) && isset($this->$key)) {
            unset($this->$key);
        }
    }

    /**
     * Accesses a helper object from within a script.
     *
     * If the helper class has a 'view' property, sets it with the current view
     * object.
     *
     * @param string $name The helper name.
     * @param array $args The parameters for the helper.
     * @return string The result of the helper output.
     */
    public function __call($name, $args)
    {
        // is the helper already loaded?
        $helper = $this->getHelper($name);

        // call the helper method
        return call_user_func_array(
            array($helper, $name),
            $args
        );
    }

    /**
     * 配置Smarty参数
     * 
     * @param  array   $config 
     * @return void
     */
    public function setConfig($config)
    {
		if (is_readable($config['template']) && is_readable($config['compile']) && is_readable($config['cache'])) {
			$this->_smarty->template_dir = $config['template'];
			$this->_smarty->compile_dir = $config['compile'];
			$this->_smarty->cache_dir = $config['cache'];
			$this->_smarty->caching = $config['caching'];
			return;
		}
		throw new Exception('Invalid path provided');
    }

    /**
     * 向模板中批量分配一个变量
     * 
     * @param  string||array   $spec 
     * @param  string          $value 
     * @return all
     */
    public function assign($spec, $value = null)
    {
		if (is_array($spec)) {
			$this->_smarty->assign($spec);
			return;
		}
		$this->_smarty->assign($spec, $value);
    }

    /**
     * 获取结果
     * 
     * @param  string   $name 
     * @return string
     */
    public function render($name)
    {
		return $this->_smarty->fetch($name);
    }

    /**
     * Clear all assigned variables
     *
     * Clears all variables assigned to Zend_View either via {@link assign()} or
     * property overloading ({@link __set()}).
     *
     * @return void
     */
    public function clearVars()
    {
        $this->_smarty->clear_all_assign();
        $vars   = get_object_vars($this);
        foreach ($vars as $key => $value) {
            if ('_' != substr($key, 0, 1)) {
                unset($this->$key);
            }
        }
    }

    /**
     * Use to include the view script in a scope that only allows public
     * members.
     *
     * @return mixed
     */
    protected function _run()
    {
    }

    /**
     * 析构方法
     * 
     * @return void
     */
    public function __destruct()
    {
		$this->_smarty = null;
    }

}
?>



