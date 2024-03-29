<!DOCTYPE html>
<?php
require_once('dbconnect.php');
require_once('../classes/Voyage.php');
require_once('../classes/Category.php');
require_once('../classes/Formule.php');

try {
    $bdd = new Database();
    $bdd->connect();
    $request = $bdd->connection->prepare("SELECT * FROM `voyage` INNER JOIN `formule` ON voyage.id_formule = formule.id INNER JOIN `categories` ON voyage.id_categorie = categories.id");
    $request->execute();
    $response = $request->fetchAll(PDO::FETCH_OBJ);
    $bdd = null;
} catch (PDOException $e) {
    die("erreur " . $e->getMessage());
}

if (isset($_POST['edit'])) {
    $value = $_POST['edit'];
    var_dump($value);

        try {
            $bdd = new Database();
            $bdd->connect();
            $request = $bdd->connection->prepare("SELECT * FROM `voyage` WHERE `id_voyage` = $value");
            $request->execute();
            $response = $request->fetchAll(PDO::FETCH_OBJ);
            foreach ($response as $row):
                $id_category = $row->id_categorie;
                $_SESSION['id_category'] = $id_category;
                $id_formule = $row->id_formule;
                $_SESSION['id_formule'] = $id_formule;
                $_SESSION['slug'] = $row->image_url;
            endforeach;
            $bdd = null;
        } catch (PDOException $e) {
            die("erreur " . $e->getMessage());
        }

    $category = new Category("", "");
    $category->deleteCategorie($id_category);
    unset($category);
    $formule = new Formule("", "");
    $formule->deleteFormule($id_formule);
    unset($formule);
    $travel = new Voyage("", "", "", "", "", "");
    $travel->deleteVoyage($value);
    unset($travel);
    unlink($_SESSION['slug']);
    $_SESSION['slug'] = null;
    $_SESSION['identified'] = null;
    $_POST['edit'] = null;
    sleep(6);
    header('Location: /controls/menu.php');
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/modif.css">
    <title>Suppression</title>
</head>
<body>
<?php include('header.php') ?>
<main>
    <h1>Selectionnez le voyage à supprimer</h1>
    <div class="formSort">
        <form method="POST">
            <label for="sortTheme">Trier par thème</label>
            <select name="sortTheme" id="sorTheme">
                <option value="">Choisir un thème</option>
                <option value="mer">Mer</option>
                <option value="campagne">Campagne</option>
                <option value="montagne">Montagne</option>
            </select>
            <label for="sortRegion">Trier par région</label>
            <select name="sortRegion" id="sorRegion">
                <option value="">Choisir une Région</option>
                <option value="alpes">Alpes</option>
                <option value="alsace">Alsace</option>
                <option value="aquitaine">Aquitaine</option>
                <option value="ardeche">Ardèche</option>
                <option value="aude">Aude</option>
                <option value="aveyron">Aveyron</option>
                <option value="baiedesomme">Baie de somme</option>
                <option value="bassinarcachon">Bassin d'Arcachon</option>
                <option value="bretagne">Bretagne</option>
                <option value="camargue">Camargue</option>
                <option value="correze">Corrèze</option>
                <option value="corse">Corse</option>
                <option value="cotebasque">Côte Basque</option>
                <option value="cotedazur">Côte d'Azur</option>
                <option value="cotelandaise">Côte Landaise</option>
                <option value="cotevermeille">Côte Vermeille</option>
                <option value="dordogne">Dordogne</option>
                <option value="gironde">Gironde</option>
                <option value="hautesavoie">Haute Savoie</option>
                <option value="hautsdefrance">Hauts de France</option>
                <option value="languedoc">Languedoc</option>
                <option value="languedocrousillon">Languedoc Roussilon</option>
                <option value="limousin">Limousin</option>
                <option value="loireatlantique">Loire Atlantique</option>
                <option value="lotetgaronne">Lot et Garonne</option>
                <option value="luberon">Luberon</option>
                <option value="midipyrenee">Midi Pyrénnées</option>
                <option value="paysloire">Pays de la Loire</option>
                <option value="perigord">Périgord</option>
                <option value="poitoucharentes">Poitou Charentes</option>
                <option value="provence">Provence</option>
                <option value="provencecoteazur">Provence Côte d'Azur</option>
                <option value="pyrennees">Pyrénnées</option>
                <option value="savoie">Savoie</option>
                <option value="tarn">Tarn</option>
                <option value="touraine">Touraine</option>
                <option value="vendee">Vendée</option>
            </select>
            <input type="submit" value="trier" class="sortButton">
        </form>
    </div>
    <div class="loader invisible">
        <div class="point1"></div>
        <div class="point2"></div>
        <div class="point3"></div>
    </div>
    <div class="success invisible">Voyage supprimé!</div>
    <form method="POST" action="delete.php" name="deleteForm" id="deleteForm">
        <input type="button" id="delete" value="SUPPRIMER LA SELECTION">
        <div class="container">
            <?php
            foreach ($response as $row):
                if(!isset($_POST['sortTheme']) && !isset($_POST['sortRegion'])){
                include('template.php');
                } elseif(isset($_POST['sortTheme']) || isset($_POST['sortRegion'])){
                    if(($_POST['sortTheme'] == $row->theme) || ($_POST['sortRegion'] == $row->region)){
                        include('template.php');
                    }
                }
            endforeach;
            ?>
        </div>
    </form>
</main>
<script src="../assets/script/delete.js"></script>
</body>
</html>