<?php

class Category
{
    public $param1;
    public $param2;
    public function __construct($param1, $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }
    public function insertCategorie(){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("INSERT INTO `categories`(`theme`,`region`) VALUES (\"$this->param1\", \"$this->param2\")");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function updateCategorie($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("UPDATE `categories` SET `theme` = \"$this->param1\", `region` = \"$this->param2\" WHERE id = $id");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function deleteCategorie($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("DELETE FROM `categories` WHERE id = $id");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }
}