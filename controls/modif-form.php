<!DOCTYPE html>
<html lang="fr">
<?php
session_start();
    require_once('dbconnect.php');
    require_once ('../classes/Voyage.php');
    require('session.php');
    $erreur = null;
    $uploadStatus = null;
    $url = null;
    if (isset($_GET['edit'])) {
        if($_GET['edit'] != "") {
            $_SESSION['identified'] = $_GET['edit'];
        }
    }
$value = $_SESSION['identified'];

    try{
//        RECUPERATION DES DONNEES DU VOYAGE
        $bdd = new Database();
        $bdd->connect();
        $request = $bdd->connection->prepare("SELECT * FROM `voyage` WHERE `id_voyage` = $value");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_OBJ);
        foreach($response as $row):
            $id_category = $row->id_categorie;
            $id_formule = $row->id_formule;
            $_SESSION['id_category'] = $id_category;
            $_SESSION['id_formule'] = $id_formule;
            $_SESSION['slug'] = $row->image_url;
            $fetchTitle = $row->title;
            $fetchDesc = $row->description;
            $fetchDesc2 = $row->description2;
            $fetchDesc3 = $row->description3;
            $fetchDesc4 = $row->description4;
        endforeach;
        $bdd = null;

//        RECUPERATION DES DONNEES DE CATEGORIE EN FONCTION DES DONNEES DU VOYAGE
        $bdd = new Database();
        $bdd->connect();
        $request = $bdd->connection->prepare("SELECT `theme`,`region` FROM `categories` WHERE `id` = $id_category");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_OBJ);
        foreach($response as $row):
            $fetchTheme = $row->theme;
            $fetchRegion = $row->region;
        endforeach;
        $bdd = null;

//        RECUPERATION DES DONNES DE FORMULE EN FONCTION DES DONNEES DU VOYAGE
        $bdd = new Database();
        $bdd->connect();
        $request = $bdd->connection->prepare("SELECT `formule`,`formule_2` FROM `formule` WHERE `id` = $id_formule");
        $request->execute();
        $response = $request->fetchAll(PDO::FETCH_OBJ);
        foreach($response as $row):
            $fetchSejour = $row->formule;
            $fetchSejour2 = $row->formule_2;
        endforeach;
        $bdd = null;
    }
    catch (PDOException $e) {
        die("erreur " . $e->getMessage());
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style-ajout.css">
    <title>Modifier une destination</title>
</head>
<body>
<?php include('header.php') ?>
    <main>
        <div class="container">
            <form action="traitement-modif.php" method="POST" enctype="multipart/form-data">
                <h2>Listing des destinations</h2>
                <fieldset>
                    <div class="listing__sup">
                        <div>
                            <label for="cate">Thème</label>
                            <select class="mb-10 pb-5 pi-10" name="cate" id="cate">
                                <option value="">Choisir un thème</option>
                                <option <?php if($fetchTheme == "mer") {echo "selected";} ?> value="mer">Mer</option>
                                <option <?php if($fetchTheme == "campagne") {echo "selected";} ?> value="campagne">Campagne</option>
                                <option <?php if($fetchTheme == "montagne") {echo "selected";} ?> value="montagne">Montagne</option>
                            </select>
                            <span><?php if(isset($_POST['cate']) && empty($_POST['cate'])){echo $_SESSION['error'];} ?></span>
                        </div>
                        <div>
                            <label for="region">Region</label>
                            <select  class="mb-10 pb-5 pi-10" name="region" id="region">
                                <option value="">Choisir une Région</option>
                                <option <?php if($fetchRegion == "alpes") {echo "selected";} ?> value="alpes">Alpes</option>
                                <option <?php if($fetchRegion == "alsace") {echo "selected";} ?> value="alsace">Alsace</option>
                                <option <?php if($fetchRegion == "aquitaine") {echo "selected";} ?> value="aquitaine">Aquitaine</option>
                                <option <?php if($fetchRegion == "ardeche") {echo "selected";} ?> value="ardeche">Ardèche</option>
                                <option <?php if($fetchRegion == "aude") {echo "selected";} ?> value="aude">Aude</option>
                                <option <?php if($fetchRegion == "aveyron") {echo "selected";} ?> value="aveyron">Aveyron</option>
                                <option <?php if($fetchRegion == "baiedesomme") {echo "selected";} ?> value="baiedesomme">Baie de somme</option>
                                <option <?php if($fetchRegion == "bassinarcachon") {echo "selected";} ?> value="bassinarcachon">Bassin d'Arcachon</option>
                                <option <?php if($fetchRegion == "bretagne") {echo "selected";} ?> value="bretagne">Bretagne</option>
                                <option <?php if($fetchRegion == "camargue") {echo "selected";} ?> value="camargue">Camargue</option>
                                <option <?php if($fetchRegion == "correze") {echo "selected";} ?> value="correze">Corrèze</option>
                                <option <?php if($fetchRegion == "corse") {echo "selected";} ?> value="corse">Corse</option>
                                <option <?php if($fetchRegion == "cotebasque") {echo "selected";} ?> value="cotebasque">Côte Basque</option>
                                <option <?php if($fetchRegion == "cotedazur") {echo "selected";} ?> value="cotedazur">Côte d'Azur</option>
                                <option <?php if($fetchRegion == "cotelandaise") {echo "selected";} ?> value="cotelandaise">Côte Landaise</option>
                                <option <?php if($fetchRegion == "cotevermeille") {echo "selected";} ?> value="cotevermeille">Côte Vermeille</option>
                                <option <?php if($fetchRegion == "dordogne") {echo "selected";} ?> value="dordogne">Dordogne</option>
                                <option <?php if($fetchRegion == "gironde") {echo "selected";} ?> value="gironde">Gironde</option>
                                <option <?php if($fetchRegion == "hautesavoie") {echo "selected";} ?> value="hautesavoie">Haute Savoie</option>
                                <option <?php if($fetchRegion == "hautsdefrance") {echo "selected";} ?> value="hautsdefrance">Hauts de France</option>
                                <option <?php if($fetchRegion == "languedoc") {echo "selected";} ?> value="languedoc">Languedoc</option>
                                <option <?php if($fetchRegion == "languedocrousillon") {echo "selected";} ?> value="languedocrousillon">Languedoc Roussilon</option>
                                <option <?php if($fetchRegion == "limousin") {echo "selected";} ?> value="limousin">Limousin</option>
                                <option <?php if($fetchRegion == "loireatlantique") {echo "selected";} ?> value="loireatlantique">Loire Atlantique</option>
                                <option <?php if($fetchRegion == "lotetgaronne") {echo "selected";} ?> value="lotetgaronne">Lot et Garonne</option>
                                <option <?php if($fetchRegion == "luberon") {echo "selected";} ?> value="luberon">Luberon</option>
                                <option <?php if($fetchRegion == "midipyrenee") {echo "selected";} ?> value="midipyrenee">Midi Pyrénnées</option>
                                <option <?php if($fetchRegion == "paysloire") {echo "selected";} ?> value="paysloire">Pays de la Loire</option>
                                <option <?php if($fetchRegion == "perigord") {echo "selected";} ?> value="perigord">Périgord</option>
                                <option <?php if($fetchRegion == "poitoucharentes") {echo "selected";} ?> value="poitoucharentes">Poitou Charentes</option>
                                <option <?php if($fetchRegion == "provence") {echo "selected";} ?>value="provence">Provence</option>
                                <option <?php if($fetchRegion == "provencecoteazur") {echo "selected";} ?> value="provencecoteazur">Provence Côte d'Azur</option>
                                <option <?php if($fetchRegion == "pyrennees") {echo "selected";} ?> value="pyrennees">Pyrénnées</option>
                                <option <?php if($fetchRegion == "savoie") {echo "selected";} ?> value="savoie">Savoie</option>
                                <option <?php if($fetchRegion == "tarn") {echo "selected";} ?>value="tarn">Tarn</option>
                                <option <?php if($fetchRegion == "touraine") {echo "selected";} ?> value="touraine">Touraine</option>
                                <option <?php if($fetchRegion == "vendee") {echo "selected";} ?> value="vendee">Vendée</option>
                            </select>
                            <span><?php if(isset($_POST['region']) && empty($_POST['region'])){echo $_SESSION['error2'];} ?></span>
                        </div>
                        <div>
                            <label for="sejour">Type de séjour/hébergement</label>
                            <input class="pb-5 pi-10 mb-10 ml-25 width-250" type="text" name="sejour" id="sejour" value="<?php echo $fetchSejour ?>" placeholder="<?php echo $_SESSION['error3'] ?>">
                            <input class="pb-5 pi-10 mb-10 width-250" type="text" name="sejour2" id="sejour2"  value="<?php echo $fetchSejour2 ?>">
                        </div>
                        <div>
                            <label for="titresejour">Titre du séjour</label>
                            <input class="width-430 mb-10 ml-80 pb-5 pi-10" type="text" name="titresejour" id="titresejour" value="<?php echo $fetchTitle ?>" placeholder="<?php echo $_SESSION['error3'] ?>">
                        </div>
                    </div>
                    <div class="listing__inf">
                        <div class="listing__inf__left">
                            <label for="listing-description">Description</label>
                            <input class="width-430 mt-10 ml-56 pb-5 pi-10" type="text" name="listing-description" id="listing-description" value="<?php echo $fetchDesc ?>" placeholder="<?php echo $_SESSION['error3'] ?>">
                            <div>
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description1" id="listing-description1" value="<?php echo $fetchDesc2 ?>" placeholder="<?php echo $_SESSION['error3'] ?>">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description2" id="listing-description2" value="<?php echo $fetchDesc3 ?>" placeholder="<?php echo $_SESSION['error3'] ?>">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description3" id="listing-description3" value="<?php echo $fetchDesc4 ?>">
                            </div>
                            <div class="pb-20">
                                <label for="upload">Insérer une image</label>
                                <input class="pb-5 pi-10" type="file" name="upload" id="upload">
                                <span><?php echo $uploadStatus." ".$erreur ?></span>
                            </div>
                        </div>
                        <div class="listing__inf__right">
                            <div>
                                <img src="../assets/img/listing.png" alt="image illustration du listing" width="90%">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <input type="submit" value="Soumettre">
            </form>
        </div>
    </main>
</body>