<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style-menu.css">
    <title>Menu des destinations</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/img/Logo-JCP.png" alt="Logo JCP Vacances">
        </div>
    </header>
    <main>
        <h1>Bienvenue dans votre interface d'administration des destinations</h1>
        <div class="container">
            <div class="action">
                <p class="action__title">Ajouter une destination</p>
                <a href="ajout.php"><img src="assets/img/ajouter.jpg" alt="" width="120px"></a>
                <p class="action__comment">J'ajoute une nouvelle destination<br>avec toutes les informations</p>
            </div>
            <div class="action"> 
                <p class="action__title">Modifier une destination</p>
                <a href=""><img src="assets/img/edit.webp" alt="" width="120px"></a>
                <p class="action__comment">Je modifie les informations<br>d'une destination existante</p>
            </div>
            <div class="action">
                <p class="action__title">Supprimer une destination</p>
                <a href=""><img src="assets/img/supprimer.png" alt="" width="120px"></a>
                <p class="action__comment">Cette destination n'est plus <br> disponible au catalogue</p>
            </div>
        </div>
        <button>Se déconnecter</button>
    </main>
</body>
</html>