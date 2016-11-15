<?php

class  ErrorController extends Yaf_Controller_Abstract
{
    /**
     * 未捕获的异常流向此处
     * @param $exception
     */
    public function errorAction(Exception $exception)
    {
        var_dump($exception);
        exit();
        if ($exception instanceof Yaf_Exception_LoadFailed_Controller) {
            header('Status: 500 Internal Server Error');
            echo "500 Server Error";
            exit();
        }
        exit();
    }
}

?>