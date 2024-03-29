<!DOCTYPE html>
<html lang="fr">
    <?php
    session_start();
    require_once('controls/dbconnect.php');
    require_once('classes/user.php');
    $_SESSION['invalidPassword'] = null;
    $_SESSION['accessDenied'] = null;
    $_SESSION['incorrectUser'] = null;

    if(isset($_POST['username']) && isset($_POST['password'])){
        $admin = new User;
        $admin->login();
        $admin = null;
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
                <input type="text" name="username" id="username"><br>
                <small><?php echo $_SESSION['incorrectUser']?></small>
                <label for="password">MOT DE PASSE</label>
                <input type="password" name="password" id="password"><br>
                <small><?php echo $_SESSION['invalidPassword'] ?></small><br>
                <input type="submit" value="connexion">
                <p class="denied"><?php echo  $_SESSION['accessDenied'] ?></p>
            </form>
        </div>
    </main>
</body>
</html>