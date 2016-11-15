<?php
class AuthController extends Yaf_Controller_Abstract {
    public function loginAction() {
        $dispatcher = Yaf_Dispatcher::getInstance();
        $dispatcher->disableView();
        echo 'Login Page';
    }
}
?>