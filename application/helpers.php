<?php
if (!file_exists('disable_view')) {
    function disable_view()
    {
        Yaf_Dispatcher::getInstance()->disableView();
    }
}