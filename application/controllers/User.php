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

    // Create new user
    public function createAction()
    {
        disable_view();
        /** @var Yaf_Request_Simple $request */
        $request = $this->getRequest();
        $username = $request->getPost('username');
        $email = $request->getPost('email');
        /** @var PDO $db */
        $db = new DatabaseManager();
        $data = compact('username', 'email');
        $statement = $db->prepare("insert into users(username,email) values(:username,:email)");
        $statement->execute($data);
        $data['id'] = $db->lastInsertId();
        echo json_encode($data);
    }

    // Save user info
    public function saveAction()
    {
        disable_view();
        $id = intval($_REQUEST['id']);
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

    // 删除用户
    public function deleteAction()
    {
        disable_view();
        $id = intval($_REQUEST['id']);
        /** @var PDO $db */
        $db = new DatabaseManager();
        $db->exec("delete from users where id=$id");
        echo json_encode(['status' => true]);
    }
}

?>