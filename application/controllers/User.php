<?php

use Db\DatabaseManager;

class UserController extends Yaf_Controller_Abstract
{
    public function indexAction()
    {

    }

    // User list
    public function usersAction()
    {
        /** @var PDO $db */
        $db = new DatabaseManager();
        $statement = $db->query("select id,username,email from users");
        $users = $statement->fetchAll();
        echo json_encode($users);
    }

    // Save user info
    public function saveAction()
    {
        disable_view();
        $id = $_REQUEST['id'];
        // TODO:validate user_id match with current user
        /** @var Yaf_Request_Simple $request */
        $request = $this->getRequest();
        /** @var PDO $db */
        $db = new DatabaseManager();
        $statement = $db->prepare('update users set username=:username,email=:email where id=:id');
        $username = $request->getPost('username');
        $email = $request->getPost('email');
        $data = compact('username', 'email', 'id');
        $statement->execute($data);
        echo $data;
    }
}

?>