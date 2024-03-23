<!DOCTYPE html>
<html lang="fr">
    <?php 
    require_once('dbconnect.php');

    class User{

        public function login(){
            try{
        
            $bdd = new Database();
            $bdd->connect();
            $request = $bdd->connection->prepare("SELECT * FROM `users` INNER JOIN `roles` ON users.id_role = roles.id");
            $request->execute();
            $result = $request->fetchAll(PDO::FETCH_OBJ);
            var_dump($result);
            foreach($result as $row):
                if($row->username == $_POST['username']){
                    if($row->role == "admin"){
                        if($row->password == $_POST['password']){
                            echo "connexion réussie";
                            header('location: /menu.php');
                            // exit();
                            // break;
                        } else {
                            echo "Mot de passe incorrect";
                            $_POST['username'] = null;
                            $_POST['password'] = null;
                            break;
                        }
                    } else {
                        echo "Accès refusé";
                        $_POST['username'] = null;
                        $_POST['password'] = null;
                        break;
                    }
                } 
            endforeach;
            // echo "identifiant incorrect";

            }
            catch (PDOException $e) {
                die("erreur " . $e->getMessage());
            }
        }
    }
    if(isset($_POST['username']) && isset($_POST['password'])){
        $admin = new User;
        $admin->login();
    }

    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style-log.css">
    <title>Login</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/img/Logo-JCP.png" alt="Logo JCP Vacances">
        </div>
    </header>
    <main>
        <div class="login">
            <span class="log-form">CONNECTEZ-VOUS A VOTRE ESPACE</span>
            <form action="" method="POST">
                <label for="username">NOM D'UTILISATEUR</label>
                <input type="text" name="username" id="username">
                <label for="password">MOT DE PASSE</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="connexion">
            </form>
        </div>
    </main>
</body>
</html>