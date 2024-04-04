<!DOCTYPE html>
<?php 
    session_start();
    require('session.php');
    $erreur = null;
    $cate = null;
    $region = null;
    $sejour = null;
    $sejour2 = null;
    $titresejour = null;
    $description = null;
    $description1 = null;
    $description2 = null;
    $description3 = null;
    $uploadStatus = null;
    $url = null;

    require '../vendor/autoload.php';

    if(!empty($_POST['cate'])){
            $cate = $_POST['cate'];
    }

    if(!empty($_POST['region'])){
            $region = $_POST['region'];
    }

    if(!empty($_POST['sejour'])){
            $sejour = $_POST['sejour'];
    }
    
    if(isset($_POST['sejour2'])){
            $sejour2 = $_POST['sejour2'];
    }

    if(!empty($_POST['titresejour'])){
            $titresejour = $_POST['titresejour'];
    }

    if(!empty($_POST['listing-description'])){
            $description = $_POST['listing-description'];
    }

    if(!empty($_POST['listing-description1'])){
            $description1 = $_POST['listing-description1'];
    }

    if(!empty($_POST['listing-description2'])){
            $description2 = $_POST['listing-description2'];
    }

    if(isset($_POST['listing-description3'])){
            $description3 = $_POST['listing-description3'];
    }

    if(isset($_FILES['upload']))
            { 
                $dossier = '../assets/img/';
                $fichier = basename($_FILES['upload']['name']);
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['upload']['tmp_name']);
                $extensions = array('.jpg', '.png', '.jpeg');
                $extension = strrchr($_FILES['upload']['name'], '.'); 
                //Début des vérifications de sécurité...
                if(!empty($fichier)){

                    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
                    :
                        $erreur = 'Veuillez envoyer un fichier de type jpg, jpeg ou png';
                        $uploadStatus = '<span class="invalid">Echec de l\'upload !</span>';
                    endif;

                    // if($taille>$taille_maxi) 
                    // :
                    //     $erreur = 'Le fichier est trop gros, 2 Mo maxi ...';
                    //     $uploadStatus = '<span class="invalid">Echec de l\'upload !</span>';
                    // endif;
                    
                    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
                    {
                        //On formate le nom du fichier ici...
                        $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/', '-', $fichier);
                        if(move_uploaded_file($_FILES['upload']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                        {
//                        $uploadStatus = '<span>Envoie effectué avec succès</span>';
                        $url = $dossier.$fichier;
                        }
                        else //Sinon (la fonction renvoie FALSE).
                        {
                        $uploadStatus = '<span>Echec de l\'upload !</span>';
                        }
                    }
                    else
                    {
                        $uploadStatus = '<span>Echec de l\'upload !</span>';
                    }
                }
                if(!isset($uploadStatus)):
                    $uploadStatus = 'Pas de fichier';
                endif;
            }

            if($cate != "" && $region != "" && $sejour != "" && $titresejour != "" && $description != "" && $description1 != "" && $description2 != ""){
                $theme = new Classes\Category($cate, $region);
                $theme->insertCategorie();
                unset($theme);
                $formule = new Classes\Formule($sejour, $sejour2);
                $formule->insertFormule();
                unset($formule);
                $travel = new Classes\Voyage($titresejour, $url, $description, $description1, $description2, $description3);
                $travel->insertVoyage();
                unset($travel);
                sleep(5);
            }
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/style-ajout.css">
    <title>Ajouter une destination</title>
</head>
<body>
<?php include('header.php') ?>
    <main>
        <div class="container">
            <form action="" method="POST" enctype="multipart/form-data">
                <h2>Listing des destinations</h2>
                <fieldset>
                    <div class="listing__sup">
                        <div>
                            <label for="cate">Thème</label>
                            <select class="mb-10 pb-5 pi-10" name="cate" id="cate">
                                <option value="">Choisir un thème</option>
                                <option value="mer">Mer</option>
                                <option value="campagne">Campagne</option>
                                <option value="montagne">Montagne</option>
                            </select>
                            <span><?php if(isset($_POST['cate']) && empty($_POST['cate'])){echo $_SESSION['error'];}; ?></span>
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
                            <span><?php if(isset($_POST['region']) && empty($_POST['region'])){echo $_SESSION['error2'];}; ?></span>
                        </div>
                        <div>
                            <label for="sejour">Type de séjour/hébergement</label>
                            <input class="pb-5 pi-10 mb-10 ml-25 width-250" type="text" name="sejour" id="sejour" placeholder="<?php if(isset($_POST['sejour']) && empty($_POST['sejour'])){echo $_SESSION['error3'];}; ?>">
                            <input class="pb-5 pi-10 mb-10 width-250" type="text" name="sejour2" id="sejour2">
                        </div>
                        <div>
                            <label for="titresejour">Titre du séjour</label>
                            <input class="width-430 mb-10 ml-80 pb-5 pi-10" type="text" name="titresejour" id="titresejour" placeholder="<?php if(isset($_POST['titresejour']) && empty($_POST['titresejour'])){echo $_SESSION['error3'];}; ?>">
                        </div>
                    </div>
                    <div class="listing__inf">
                        <div class="listing__inf__left">
                            <label for="listing-description">Description</label>
                            <input class="width-430 mt-10 ml-56 pb-5 pi-10" type="text" name="listing-description" id="listing-description" placeholder="<?php if(isset($_POST['listing-description']) && empty($_POST['listing-description'])){echo $_SESSION['error3'];}; ?>">
                            <div>
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description1" id="listing-description1" placeholder="<?php if(isset($_POST['listing-description1']) && empty($_POST['listing-description1'])){echo $_SESSION['error3'];}; ?>">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description2" id="listing-description2" placeholder="<?php if(isset($_POST['listing-description2']) && empty($_POST['listing-description2'])){echo $_SESSION['error3'];}; ?>">
                                <input class="width-430 mb-10 ml-169 pb-5 pi-10" type="text" name="listing-description3" id="listing-description3">
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

            <input type="submit" value="Soumettre" id="addTravel">
            </form>
            <div class="loader invisible">
                <div class="point1"></div>
                <div class="point2"></div>
                <div class="point3"></div>
            </div>
            <div class="success invisible">Ajout réalisé avec succès!!</div>
        </div>
    </main>
<script src="../assets/script/ajout.js"></script>
</body>
</html>