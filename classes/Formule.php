<?php
    namespace Classes;
class Formule
{
    public $param1;
    public $param2;
    public function __construct($param1, $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
    }
    public function insertFormule(){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("INSERT INTO `formule`(`formule`,`formule_2`) VALUES (\"$this->param1\", \"$this->param2\")");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function updateFormule($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("UPDATE `formule` SET `formule` = \"$this->param1\", `formule_2` = \"$this->param2\" WHERE id = $id");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function deleteFormule($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("DELETE FROM `formule` WHERE id = $id");
            $bdd = null;
        }
        catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }
}