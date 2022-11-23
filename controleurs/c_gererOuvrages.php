<?php
include 'modele/OuvrageDal.class.php';
include 'include/_metier.lib.php';

// variables pour la gestion des messages
$titrePage = 'Gestion des Ouvrages';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;

if (isset($_GET["action"])) {
    $action = $_GET['action'];
} else {
    $action = "listerOuvrages";
}
switch ($action) {
    case "listerOuvrages": {
            $lesOuvrages = OuvrageDal::loadOuvrages(1);
            $nbOuvrages = count($lesOuvrages);
            include 'vues/v_listerOuvrages.php';
        }
        break;
    case "consulterOuvrage": {
            $hasErrors = false;

            if (isset($_GET["id"])) {

                $intID = intval(htmlentities($_GET["id"]));

                $lOuvrage = OuvrageDal::loadOuvrageByID($intID);

                // connexion à la base de données
                // récupération du libellé dans la base

                // Récupération de l'ouvrage
                if ($lOuvrage == null) {

                    $tabErreurs["Erreur"] = "Cet ouvrage n'existe pas !";
                    $tabErreurs["ID"] = $intID;
                    $hasErrors = true;
                }
                if ($hasErrors) {
                    $msg = "La consultation est impossible";
                    $lien = '<a href="index.php?uc=gererOuvrage">retour à la saisie</a>';
                    include 'vues/_v_afficherErreurs.php';
                } else {
                    include "vues/v_consulterOuvrage.php";
                }
            } else {
                $msg = "La consultation est impossible";
                $lien = '<a href="index.php?uc=gererOuvrage">retour à la saisie</a>';
                $tabErreurs["Erreur"] = "aucun ouvrage n'a été transmis pour consultation !";
                $hasErrors = true;
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;
    case "ajouterOuvrage": {
            $hasErrors = false;
            $noOuvrage = '';
            $titre = '';
            $salle = '';
            $rayon = '';
            $genre = '';
            $Acquisition = '';
            $lesGenres = GenreDal::loadGenres(1);

            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirOuvrage';
            }
            switch ($option) {
                case 'saisirOuvrage': {
                        include 'vues/v_ajouterOuvrage.php';
                    }
                    break;
                case 'validerSaisie': {
                        $afficherForm = false;
                        if (isset($_POST["cmdValider"])) {

                            // récupération du titre
                            if (!empty($_POST["txtTitre"])) {
                                $titre = ucfirst(htmlentities($_POST["txtTitre"]));
                            }
                            // récupération du salle
                            if (!empty($_POST["rbnSalle"])) {
                                $salle = strtoupper(htmlentities($_POST["rbnSalle"]));
                            }
                            // récupération du rayon
                            if (!empty($_POST["txtRayon"])) {
                                $rayon = strtoupper(htmlentities($_POST["txtRayon"]));
                            }
                            // récupération du genre
                            if (!empty($_POST["txtGenre"])) {
                                $genre = strtoupper(htmlentities($_POST["txtGenre"]));
                            }
                            // récupération de la date d'acquisition
                            if (!empty($_POST["txtDate"])) {
                                $strDate = strtoupper(htmlentities($_POST["txtDate"]));
                                $curDate = new DateTime(date('Y-m-d'));
                                $Acquisition = new DateTime($strDate);

                                if ($Acquisition > $curDate) {
                                    $hasErrors = true;
                                    $tabErreurs["Acquisition"] = "La date d'aquisition doit être antérieure ou égale à la date du jour";
                                }
                            }
                            if (!rayonValide($rayon)) {
                                $tabErreurs["gaga Rayon"] = "Le rayon n'est pas valide, il doit comporter une lettre et un chiffre ( ex : A2, B8, R4 )";
                                $hasErrors = true;
                                $tabErreurs["Rayon"] = $rayon;
                            }
                        } else {

                            $msg = "Une erreure s'est produite";
                            $lien = '<a href="index.php?uc=gererOuvrage">retour à la saisie</a>';
                            $tabErreurs["Erreur"] = "Accès interdit";
                            $hasErrors = true;
                            include 'vues/_v_afficherErreurs.php';
                        }

                        // test zones obligatoires
                        if (!empty($titre) and !empty($salle) and !empty($rayon) and !empty($genre) and !empty($Acquisition)) {
                        } else {
                            // une ou plusieurs valeurs n'ont pas été saisies
                            if (empty($titre)) {
                                $tabErreurs["Titre"] = "Le Titre doit être renseigné ! ";
                            }
                            if (empty($salle)) {
                                $tabErreurs["Salle"] = "La Salle doit être renseigné ! ";
                            }
                            if (empty($rayon)) {
                                $tabErreurs["Rayon"] = "Le Rayon doit être renseigné ! ";
                            }
                            if (empty($genre)) {
                                $tabErreurs["Genre"] = "Le Genre doit être renseigné ! ";
                            }
                            if (empty($Acquisition)) {
                                $tabErreurs["Acquisition"] = "L'Acquisition doit être précisé (date) ";
                            }


                            $hasErrors = true;
                        }
                        if (!$hasErrors) {
                            // ajout dans la base de données

                            try {
                                $res = OuvrageDal::addOuvrage($titre, $salle, $rayon, $genre, $strDate);

                                if ($res > 0) {
                                    $msg = "L'ouvrage nommé " . $titre . " dans la salle " . $salle . " aux rayon " . $rayon . " avec le genre " . $genre . " reçu le " . $strDate . " a été ajouté";
                                    include 'vues/_v_afficherMessage.php';
                                    //include 'vues/v_consulterGenre.php

                                } else {
                                    $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                    $lien = '<a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Retour à la saisie</a>';
                                    include 'vues/_v_afficherErreurs.php';
                                }
                            } catch (PDOException $e) {
                                $tabErreurs["Erreur"] = 'Une exception PDO a été levée !';
                                $hasErrors = true;
                            }
                        }
                        if ($hasErrors) {
                            $msg = "l'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes test:";
                            $lien = '<a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">retour à saisie</a>';
                            include "vues/_v_afficherErreurs.php";
                        }
                    }
            }
            break;
        }
        break;
    case "modifierOuvrage": {
            $strTitre = "";
            $strRayon = "";
            $strGenre = "";
            $strDate = "";
            $strID = 0;

            if (isset($_GET["id"]) && $_GET["id"] != null) {
                $intID = intval($_GET["id"]);
                // recupérer l'ouvrage avec cet identifiant
                $leOuvrage = OuvrageDal::loadOuvrageByID($intID);

                if ($leOuvrage == NULL) {
                    $tabErreurs["Erreur"] = "cet ouvrage n'existe pas !";

                    $hasErrors = true;
                } else {
                    // sinon recupérer toutes les valeurs de l'ouvrage
                    $strTitre = $leOuvrage->getTitre();
                    $strRayon = $leOuvrage->getRayon();
                    $strGenre = $leOuvrage->getLeGenre()->getLibelle();
                    $strDate = $leOuvrage->getAcquisition();
                    $lesGenres = GenreDal::loadGenres(1);
                }
            } else {
                $tabErreurs["Erreur"] = "Aucun identifiant d'ouvrage n'a été transmis pour modification !";
                $hasErrors = true;
            }
            if (!$hasErrors) {
                if (isset($_GET["option"])) {
                    $option = htmlentities($_GET["option"]);
                } else {
                    $option = 'saisirOuvrage';
                }
                switch ($option) {
                    case "saisirOuvrage": {
                            if ($_GET["id"] != "") {
                                include "vues/v_modifierOuvrage.php";
                            }
                        }
                        break;
                    case "validerOuvrage": {
                            if (isset($_POST["cmdValider"])) {
                                if (!empty($_POST["txtTitre"])) {
                                    $strTitre = ucfirst(htmlentities($_POST["txtTitre"]));
                                } else {
                                    $tabErreurs["Erreur"] = "un Titre doit être enregistrer";
                                    $tabErreurs["Titre"] = $strTitre;
                                    $hasErrors = true;
                                    include 'vues/_v_afficherErreurs.php';
                                }
                                $strRayon = ucfirst(htmlentities($_POST["txtRayon"]));
                                $strGenre = ucfirst(htmlentities($_POST["txtGenre"]));
                                $strDate = ucfirst(htmlentities($_POST["txtDate"]));
                                $strSalle = ucfirst(htmlentities($_POST["rbnSalle"]));

                                if (!$hasErrors) {
                                    $leOuvrage->setTitre($strTitre);
                                    $leOuvrage->setRayon($strRayon);
                                    $leOuvrage->setSalle($strSalle);
                                    $leOuvrage->setLeGenre($strGenre);
                                    $leOuvrage->setAcquisition($strDate);
                                    $res = OuvrageDal::setOuvrage($leOuvrage);
                                    if ($res > 0) {

                                        $msg = "L'Ouvrage" . $leOuvrage->getNoOuvrage() . "-" . $leOuvrage->getTitre() . " a été modifié";

                                        include "vues/_v_afficherMessage.php";
                                    } else {
                                        $tabErreurs["Erreur"] = "une erreur s'est produite lors de l'opération de mis à jour";
                                        $tabErreurs["ID"] = $strID;
                                        $tabErreurs["Titre"] = $strTitre;
                                        $tabErreurs["SQL"] = $res;
                                        $hasErrors = true;
                                        include 'vues/_v_afficherErreurs.php';
                                    }
                                }
                            } else {
                                $msg = "Une erreur c'est produite";
                                $lien = '<a href="index.php?uc=gererOuvrage">retour à la saisie</a>';
                                $tabErreurs["Erreur"] = "Accès interdit";
                                $hasErrors = true;
                                include 'vues/_v_afficherErreurs.php';
                            }
                        }
                        break;
                }
            } else {
                $msg = "L'opération de modification n'a pas pu être menée à terme en raison des erreurs suivantes :";
                $lien = '<a href="index.php?uc=gererOuvrages&action=modifierOuvrage">Retour à la saisie</a>';
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;
    case "supprimerOuvrage": {
            if (isset($_GET["id"])) {
                $strID = strtoupper(htmlentities($_GET["id"]));
                $leOuvrage = OuvrageDal::loadOuvrageByID($strID);
                if ($leOuvrage == null) {
                    $tabErreurs["Erreur"] = "cet Ouvrage n'existe pas !";
                    $tabErreurs["id"] = $strID;
                    $hasErrors = true;
                }
            } else {
                $tabErreurs["Erreur"] = "Aucun ouvrage n'a été transmis pour suppression !";
                $hasErrors = true;
            }
            if ($leOuvrage->getlisteNomsAuteurs() != null && $leOuvrage->getlisteNomsAuteurs() != "" && $leOuvrage->getlisteNomsAuteurs() != 0 && $leOuvrage->getlisteNomsAuteurs() != "Indéterminé") {
                $tabErreurs["Erreur"] = "Un auteur est déjà référencé pour cet ouvrage";
                $hasErrors = true;
            }

            if (!$hasErrors) {
                $res = OuvrageDal::delOuvrage($leOuvrage->getNoOuvrage());
                if ($res > 0) {
                    $msg = "l'Ouvrage a été supprimé";
                    include "vues/_v_afficherMessage.php";
                    $lesOuvrages = OuvrageDal::loadOuvrageByID(1);
                } else
                {
                    $msg = "Une erreur est survenue";
                    include "vues/_v_afficherMessage.php";
                }
            }

            if ($hasErrors) {
                $msg = "l'opération de suppresion n'a pa pu être menée à terme en raison des erreurs suivantes :";
                $lien = '<a href="index.php?uc=gererOuvrages">retour à la saisie</a>';
                include 'vues/_v_afficherErreurs.php';
            }
        }
        break;

    default:
        include 'vues/v_listerOuvrages.php';
        break;
}
