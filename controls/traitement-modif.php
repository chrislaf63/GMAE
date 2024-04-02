<?php
session_start();
    require_once('dbconnect.php');
    require_once('../classes/Voyage.php');
    require_once('../Classes/Category.php');
    require_once('../Classes/Formule.php');

//    DECLARATION VARIABLES
    $sejour = null;
    $sejour2 = null;
    $titresejour = null;
    $description = null;
    $description1 = null;
    $description2 = null;
    $description3 = null;
    $url = null;

//    VERIFICATIONS DES CHAMPS ET ASSIGNATION DES VALEURS ENVOYEES AUX VARIABLES POUR REINTRODUCTION DANS BDD
    if (!empty($_POST['cate'])) {
        $cate = $_POST['cate'];
    }

    if (!empty($_POST['region'])) {
        $region = $_POST['region'];
    }

    if (!empty($_POST['sejour'])) {
        $sejour = $_POST['sejour'];
    }

    if (isset($_POST['sejour2'])) {
        $sejour2 = $_POST['sejour2'];
    }

    if (!empty($_POST['titresejour'])) {
        $titresejour = $_POST['titresejour'];
    }

    if (!empty($_POST['listing-description'])) {
        $description = $_POST['listing-description'];
    }

    if (!empty($_POST['listing-description1'])) {
        $description1 = $_POST['listing-description1'];
    }

    if (!empty($_POST['listing-description2'])) {
        $description2 = $_POST['listing-description2'];
    }

    if (isset($_POST['listing-description3'])) {
        $description3 = $_POST['listing-description3'];
    }

    if (isset($_FILES['upload'])) {
        $dossier = '../assets/img/';
        $fichier = basename($_FILES['upload']['name']);
        $taille_maxi = 2000000;
        $taille = filesize($_FILES['upload']['tmp_name']);
        $extensions = array('.jpg', '.png', '.jpeg');
        $extension = strrchr($_FILES['upload']['name'], '.');
        //Début des vérifications de sécurité...
        if (!empty($fichier)) {

            if (!in_array($extension, $extensions))
                :
                $erreur = 'Veuillez envoyer un fichier de type jpg, jpeg ou png';
                $uploadStatus = '<span class="invalid">Echec de l\'upload !</span>';
            endif;

            if (!isset($erreur))
            {
                $fichier = strtr($fichier,
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/', '-', $fichier);
                if (move_uploaded_file($_FILES['upload']['tmp_name'], $dossier . $fichier))
                {
                    $url = $dossier . $fichier;
                } else
                {
                    $uploadStatus = '<span>Echec de l\'upload !</span>';
                }
            } else {
                $uploadStatus = '<span>Echec de l\'upload !</span>';
            }
        }
        if (!isset($uploadStatus)):
            $uploadStatus = 'Pas de fichier';
        endif;
    }

//    VERIFICATION DES CHAMPS ET INTRODUCTION DANS LA BDD
    if ($cate != "" && $region != "" && $sejour != "" && $titresejour != "" && $description != "" && $description1 != "" && $description2 != "") {
        if ($url == "") {
            $url = $_SESSION['slug'];
        }
        $category = new Category($cate, $region);
        $category->updateCategorie($_SESSION['id_category']);
        unset($category);
        $formule = new Formule($sejour, $sejour2);
        $formule->upDateFormule($_SESSION['id_formule']);
        unset($formule);
        $travel = new Voyage($titresejour, $url, $description, $description1, $description2, $description3);
        $travel->editVoyage($_SESSION['identified']);
        unset($travel);
        $_SESSION['slug'] = null;
        $_SESSION['identified'] = null;
        sleep(2);
        header('Location: menu.php');
    } else {
        header("location:/modif-form.php");
        exit;
    }

