<?php
class Database {
    private $host; 
    private $dbname;
    private $username;
    private $password; 
    public $connection;

    public function __construct()
    {
        $this->host = "localhost";
        $this->dbname = "jcp_vacances";
        $this->username = "root";
        $this->password = "";
    }

    public function connect(){

        try
{
    $this->connection = new PDO(
        "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
        $this->username,
        $this->password
    );
}
catch (Exception $e)
{
    die('Erreur : '. $e->getMessage());
}

    }
}

?>