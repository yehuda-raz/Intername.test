<?php

include './config.php';

class MySQL_dbCON {
	private static $instance;
    public $connection;

    private function __construct()
    {
        $this->connection = new \mysqli(InternameConfigDB::$server_name,InternameConfigDB::$db_username,InternameConfigDB::$db_password,InternameConfigDB::$db_name);
        $this->connection->set_charset("utf8");
    }

    public function __destruct()
    {
        $this->connection->close();
    }

    public function getInstance()
    {
        if(MySQL_dbCON::$instance==null)
        {
            MySQL_dbCON::$instance = new MySQL_dbCON();
        }
        return MySQL_dbCON::$instance;
    }

}
?>







