<?php

use Db\DatabaseManager;

class UserController extends Yaf_Controller_Abstract
{
    public function indexAction()
    {
        $db = new DatabaseManager();
        var_dump($db);
        exit();
    }
}

?>