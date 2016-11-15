<?php

/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends Yaf_Bootstrap_Abstract
{

//    public function _initConfig() {
//        $config = Yaf_Application::app()->getConfig();
//        Yaf_Registry::set("config", $config);
//    }
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
}