<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location:/index.php');
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style-menu.css">
    <title>Menu des destinations</title>
</head>
<body>
<?php include('header.php') ?>
    <main>
        <h1>Bienvenue dans votre interface d'administration des destinations</h1>
        <div class="container">
            <div class="action">
                <p class="action__title">Ajouter une destination</p>
                <a href="ajout.php"><img src="../assets/img/ajouter.jpg" alt="" width="120px"></a>
                <p class="action__comment">J'ajoute une nouvelle destination<br>avec toutes les informations</p>
            </div>
            <div class="action"> 
                <p class="action__title">Modifier une destination</p>
                <a href="modif.php"><img src="../assets/img/edit.webp" alt="" width="120px"></a>
                <p class="action__comment">Je modifie les informations<br>d'une destination existante</p>
            </div>
            <div class="action">
                <p class="action__title">Supprimer une destination</p>
                <a href="delete.php"><img src="../assets/img/supprimer.png" alt="" width="120px"></a>
                <p class="action__comment">Cette destination n'est plus <br> disponible au catalogue</p>
            </div>
        </div>
        <button>Se déconnecter</button>
    </main>
<script src="../assets/script/logout.js"></script>
</body>
</html>