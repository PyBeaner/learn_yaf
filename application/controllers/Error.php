<?php
class  ErrorController extends Yaf_Controller_Abstract {
    /**
     * 未捕获的异常流向此处
     * @param $exception
     */
    public function errorAction($exception) {
        echo $exception;
        exit();
    }
}
?>