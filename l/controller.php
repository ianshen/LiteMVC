<?php
/**
 * @author Ian
 * abstract controller 控制器抽象基类
 */
abstract class Controller {
    
    /**
     * 模板引擎
     * @var unknown_type
     */
    protected $_view = null;
    
    /**
     * 筛选器，其组织方式子类按自己需求实现
     * @var unknown_type
     */
    protected $filters = array ();
    
    /**
     * 构造函数,final修饰以免子类覆盖,子类需要的初始化操作可以覆盖init实现
     */
    final public function __construct() {
        $viewEngine = App::$settings ['view_engine'];
        $this->_view = new $viewEngine ();
        if (! ($this->_view = new $viewEngine ()) instanceof View) {
            throw new Exception ( "$viewEngine must implements interface View" );
        }
        $this->init ();
    }
    
    /**
     * 子类初始化相关操作
     */
    protected function init() {
    }
    
    public function assign($key, $value = null) {
        $this->_view->assign ( $key, $value );
    }
    
    public function fetch($tpl = null) {
        return $this->_view->fetch ( $tpl );
    }
    
    public function display($tpl = null) {
        $this->_view->display ( $tpl );
    }
    
    /**
     * 获取当前要执行的action方法的过滤器，使用者可根据实际情况在子类中覆盖此方法
     */
    public function filters() {
        return array ();
    }
    
    /**
     * 获取当前模板引擎
     * @return unknown_type
     */
    public function getViewEngine() {
        return $this->_view;
    }
    
    /**
     * 判断是否ajax请求
     * @return boolean
     */
    public static function isAjax() {
        return Context::isAjax ();
    }
    
    /**
     * 子类的资源销毁可覆盖实现
     */
    protected function destroy() {
    }
    
    final public function __destruct() {
        try {
            $this->destroy ();
            Context::clear ();
        } catch ( Exception $e ) {
        
        }
    }
}