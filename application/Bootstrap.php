<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{
    // 引入helpers快捷方法
    public function _init_helpers()
    {
        require_once APP_PATH . '/application/helpers.php';
    }

    /**
     * 将配置信息加入注册表
     */
    public function _initConfig()
    {
        $app_config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config.app", $app_config);
        $it = new DirectoryIterator(APP_PATH . '/conf');
        foreach ($it as $file) {
            if ($file->getExtension() == 'ini') {
                $config = new Yaf_Config_Ini($file->getRealPath());
                Yaf_Registry::set('config.' . basename($file->getFilename(), '.ini'), $config);
            }
        }
    }
//
//    public function _initDefaultName(Yaf_Dispatcher $dispatcher) {
//        $dispatcher->setDefaultModule("Index")->setDefaultController("Index")->setDefaultAction("index");
//    }

    /**
     * 开启未捕获异常的处理，避免直接抛出异常
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initExceptionCatching(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->catchException(true);
    }

    /**
     * 注册Plugins
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initPlugins(Yaf_Dispatcher $dispatcher)
    {
        $global = new GlobalPlugin();
        $dispatcher->registerPlugin($global);
    }

    /**
     * 初始化路由协议
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initRoutes(Yaf_Dispatcher $dispatcher)
    {
        $router = $dispatcher->getRouter();
//        var_dump($router->getRoutes());
//        exit();
        // 可以添加自定义的route
//        $router->addRoute('my_route',$my_route);
        // 也可以通过配置添加
        $config = new Yaf_Config_Ini(APP_PATH . '/conf/routes.ini');
        $router->addConfig($config);
    }

    /**
     * 使用Smarty作为模板引擎
     * @param Yaf_Dispatcher $dispatcher
     */
    public function _initSmarty(Yaf_Dispatcher $dispatcher)
    {
        return;
        $smarty = new Smarty_Adapter(null, Yaf_Registry::get('config.smarty'));
        $dispatcher->setView($smarty);
    }
}