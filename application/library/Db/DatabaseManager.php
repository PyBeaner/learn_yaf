<?php
namespace Db;
use PDO;
use Yaf_Config_Ini;
class DatabaseManager
{
    /** @var  PDO */
    private $_db;

    /**
     * DatabaseManager constructor.
     */
    public function __construct()
    {
        if ($this->_db) {
            return;
        }
        $config = new Yaf_Config_Ini(APP_PATH . '/conf/db.ini');
        $this->_db = new PDO(sprintf('mysql:host=%s;dbname=%s', $config['host'], $config['database']),
            $config['username'], $config['password']);
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->_db, $name], $arguments);
    }
}