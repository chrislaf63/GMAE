<!DOCTYPE html>
<?php 
    $error = null;
    $error2 = null;
    $error3 = null;
    $theme = null;
    $region = null;
    $sejour = null;

    if(isset($_POST['theme'])){
        if(empty($_POST['theme'])){
            $error = "Veuillez choisir un thème";
        } else {
            $theme = $_POST['theme'];
        }
    }

    if(isset($_POST['region'])){
        if(empty($_POST['region'])){
            $error2 = "Veuillez choisir une région";
        } else {
            $region = $_POST['region'];
        }
    }

    if(isset($_POST['sejour'])){
        if(empty($_POST['sejour'])){
            $error3 = "Champs_obligatoire";
        } else {
            $sejour = $_POST['sejour'];
        }
    }
    
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style-ajout.css">
    <title>Ajouter une destination</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/img/Logo-JCP.png" alt="Logo JCP Vacances">
        </div>
    </header>
    <main>
        <div class="container">
            <form action="" method="POST">
                <h2>Listing des destinations</h2>
                <fieldset>
                    <div class="listing__sup">
                        <div>
                            <label for="theme">Thème</label>
                            <select class="mb-10 pb-5 pi-10" name="theme" id="theme">
                                <option value="">Choisir un thème</option>
                                <option value="mer">Mer</option>
                                <option value="campagne">Campagne</option>
                                <option value="montagne">Montagne</option>
                            </select>
                            <span><?php echo $error ?></span>
                        </div>
                        <div>
                            <label for="region">Region</label>
                            <select  class="mb-10 pb-5 pi-10" name="region" id="region">
                                <option value="">Choisir une Région</option>
                                <option value="alpes">Alpes</option>
                                <option value="alsace">Alsace</option>
                                <option value="aquitaine">Aquitaine</option>
                                <option value="ardeche">Ardèche</option>
                                <option value="aude">Aude</option>
                                <option value="aveyron">Aveyron</option>
                                <option value="mer">Mer</option>
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
                            <span><?php echo $error2 ?></span>
                        </div>
                        <div>
                            <label for="sejour">Type de séjour/hébergement</label>
                            <input class="pb-5 pi-10 mb-10 ml-25 width-250" type="text" name="sejour" id="sejour" placeholder=<?php echo $error3 ?>>
                            <input class="pb-5 pi-10 mb-10 width-250" type="text" name="sejour2" id="sejour2">
                        </div>
                        <div>
                            <label for="titresejour">Titre du séjour</label>
                            <input class="width-430 mb-10 ml-80 pb-5 pi-10" type="text" name="titresejour" id="titresejour">
                        </div>
                    </div>
                    <div class="listing__inf">
                        <div class="listing__inf__left">
                            <label for="listing-description">Description</label>
                            <input class="width-430 mt-10 ml-56 pb-5 pi-10" type="text" name="listing-description" id="listing-description">
                            <div>
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description1" id="listing-description1">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description2" id="listing-description2">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description3" id="listing-description3">
                            </div>
                            <div class="pb-20">
                                <label for="listing-picture">Insérer une image</label>
                                <input class="pb-5 pi-10" type="file" name="listing-picture" id="listing-picture">
                            </div>
                        </div>
                        <div class="listing__inf__right">
                            <div>
                                <img src="assets/img/listing.png" alt="image illustration du listing" width="90%">
                            </div>
                        </div>
                    </div>
                </fieldset>

            <input type="submit" value="Soumettre">
            </form>
        </div>
    </main>
</body>
</html>