<!DOCTYPE html>
<?php 
    require_once('dbconnect.php');

     try{
            $bdd = new Database();
            $bdd->connect();
            $request = $bdd->connection->prepare("SELECT * FROM `voyage` INNER JOIN `formule` ON voyage.id_formule = formule.id");
            $request->execute();
            $response = $request->fetchAll(PDO::FETCH_OBJ);
            $bdd = null;
            }
            catch (PDOException $e) {
                die("erreur " . $e->getMessage());
            }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/modif.css">
    <title>Modication</title>
</head>
<body>
    <?php include('header.php') ?>
    <main>
        <h1>Selectionnez le voyage à modifier</h1>
        <form method="GET" action="modif-form.php">
            <input type="submit" value="MODIFIER LA SELECTION" id="edit">
                <div class="container">

                <?php
                foreach($response as $row):
                    include('template.php');
                endforeach;
                ?>
            </div>
        </form>
    </main>
</body>
</html>