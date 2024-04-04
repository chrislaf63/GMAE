<?php
namespace Classes;
class Voyage
{
    public $param1;
    public $param2;
    public $param3;
    public $param4;
    public $param5;
    public $param6;

    public function __construct($param1, $param2, $param3, $param4, $param5, $param6)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        $this->param4 = $param4;
        $this->param5 = $param5;
        $this->param6 = $param6;
    }

    public function insertVoyage(){
        try{
            $bdd = new Database();
            $bdd->connect();
            $request = $bdd->connection->prepare("SELECT `id` FROM `categories` ORDER BY `id` DESC LIMIT 1 ");
            $request->execute();
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            foreach($response as $row):
                $id_categorie = $row->id;
            endforeach;
            $request = $bdd->connection->prepare("SELECT `id` FROM `formule` ORDER BY `id` DESC LIMIT 1 ");
            $request->execute();
            $response = $request->fetchAll(\PDO::FETCH_OBJ);
            foreach($response as $row):
                $id_formule = $row->id;
            endforeach;
            $bdd->connection->query("INSERT INTO `voyage`(`id_categorie`,`id_formule`,`title`,`image_url`,`description`,`description2`,`description3`,`description4`) VALUES (\"$id_categorie\", \"$id_formule\", \"$this->param1\", \"$this->param2\", \"$this->param3\", \"$this->param4\", \"$this->param5\", \"$this->param6\")");
            $bdd = null;
        }
        catch (\PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function editVoyage($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("UPDATE `voyage` SET `title`=\"$this->param1\",`image_url`=\"$this->param2\",`description`=\"$this->param3\",`description2`=\"$this->param4\",`description3`=\"$this->param5\",`description4`=\"$this->param6\" WHERE $id = `id_voyage`");
        }
        catch (\PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }

    public function deleteVoyage($id){
        try{
            $bdd = new Database();
            $bdd->connect();
            $bdd->connection->query("DELETE FROM `voyage` WHERE $id = `id_voyage`");
        }
        catch (\PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }
}