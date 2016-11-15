<?php

use Db\DatabaseManager;

class UserController extends Yaf_Controller_Abstract
{
    public function indexAction()
    {

    }

    public function usersAction()
    {
        /** @var PDO $db */
        $db = new DatabaseManager();
        $statement = $db->query("select id,username,email from users");
        $users = $statement->fetchAll();
        Yaf_Dispatcher::getInstance()->disableView();
        echo json_encode($users);
    }
}

?>