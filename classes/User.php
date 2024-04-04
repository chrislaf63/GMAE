<?php
namespace Classes;
class User
{
    public function login(){
        try{
            $bdd = new Database();
            $bdd->connect();
            $request = $bdd->connection->prepare("SELECT * FROM `users` INNER JOIN `roles` ON users.id_role = roles.id");
            $request->execute();
            $result = $request->fetchAll(\PDO::FETCH_OBJ);
            foreach($result as $row):
                if($row->username == $_POST['username']){
                    if($row->role == "admin"){
                        if($row->password == $_POST['password']){
                            echo "connexion réussie";

                            $_SESSION['username'] = $_POST['password'];
                            header('location: ./controls/menu.php');
                        } else {
                            $_SESSION['invalidPassword'] = "Mot de passe incorrect";
                            $_POST['username'] = null;
                            $_POST['password'] = null;
                            break;
                        }
                    } else {
                        $_SESSION['accessDenied'] = "Accès refusé";
                        $_POST['username'] = null;
                        $_POST['password'] = null;
                        break;
                    }
                }
            endforeach;
           if(empty($_POST['submit'])){
               $_SESSION['incorrectUser'] = "Nom d'utilisateur incorrect";
           }
            $bdd = null;
        }
        catch (\PDOException $e) {
            die("erreur " . $e->getMessage());
        }
    }
}