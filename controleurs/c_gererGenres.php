<?php
include 'modele/GenreDal.class.php';

// variables pour la gestion des messages
$titrePage = 'Gestion des genres';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;


if(isset($_GET["action"]))
{
    $action = $_GET['action'];
}
else
{
    $action = "listerGenres";
}
switch ($action) {
    case "listerGenres" :
        {
            $lesGenres = GenreDal::loadGenres(1);
            $nbGenres = count($lesGenres);
            include 'vues/v_listeGenres.php';

        }
        break;

    case "consulterGenre" :
        // variables pour la gestion des erreurs
        $hasErrors = false;

        // récupération du code
        if (isset($_GET["option"]) && $_GET["option"] != "") {
            $strGenre = strtoupper(htmlentities($_GET["option"]));
            // récupération du libellé dans la base

            $leGenre = GenreDal::loadGenreByID($strGenre);
            // Si l’entité existe
            if ($leGenre == null) {
                $tabErreurs[] = 'Le Genre n\'existe pas !';
                $hasErrors = true;
            }
        } // affichage des erreurs
        else {

            $tabErreurs[] = "aucun genre na été transmis pour consultation !";
            $hasErrors = true; 
                }

        if ($hasErrors) {
            $msg = "La consultation est impossible";
            $lien = '<a href="index.php?uc=gererAuteurs">retour à la saisie</a>';
            include 'vues/_v_afficherErreurs.php';
        } else {
            include "vues/v_consulterGenre.php";
        }

        break;
    case "ajouterGenre" :
        {
            $hasErrors = false;
            $strCode = '';
            $strLibelle = '';
            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirGenre';
            }
            switch ($option) {
                case 'saisirGenre' :
                    {
                        include 'vues/v_ajouterGenre.php';
                    }
                    break;
                case 'validerSaisie':
                {
                    $afficherForm = false;
                    if (isset($_POST["cmdValider"])) {
                        // récupération du libellé
                        if (!empty($_POST["txtLibelle"])) {
                            $strLibelle = ucfirst(htmlentities($_POST["txtLibelle"]));
                        }
                        // récupération du code
                        if (!empty($_POST["txtCode"])) {
                            $strCode = strtoupper(htmlentities($_POST["txtCode"]));
                        }
                        // test zones obligatoires
                        if (!empty($strCode) and !empty($strLibelle)) {
                            // les zones obligatoires sont présentes
                            // tests de cohérence
                            // contrôle d'existence d'un genre avec le même code

                            $doublon = GenreDal::loadGenreByID($strCode);
                            // test présence d'un doublon
                            if ($doublon != null) {
                                // signaler l'erreur
                                $tabErreurs["Erreur"] = 'Il existe déjà un genre avec ce code !';
                                $tabErreurs["Genre"] = $strCode;
                                $hasErrors = true;
                            }
                        } else {
                            // une ou plusieurs valeurs n'ont pas été saisies
                            if (empty($strCode)) {
                                $tabErreurs["Code"] = "Le code doit être renseigné !";
                            }
                            if (empty($strLibelle)) {
                                $tabErreurs["Libellé"] = "Le libellé doit être renseigné !";
                            }
                            $hasErrors = true;
                        }
                        if (!$hasErrors) {
                            // ajout dans la base de données

                            try {
                                $res = GenreDal::addGenre($strCode, $strLibelle);

                                if ($res > 0) {
                                    $msg = 'Le genre ' . $strCode . '-' . $strLibelle . 'a été ajouté';
                                    include 'vues/_v_afficherMessage.php';
                                    //include 'vues/v_consulterGenre.php

                                } else {
                                    $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                    $lien = '<a href="index.php?uc=gererGenres&action=ajouterGenre">Retour à la saisie</a>';
                                    include 'vues/_v_afficherErreurs.php';
                                }
                            } catch (PDOException $e) {
                                $tabErreurs["Erreur"] = 'Une exception PDO a été levée !';
                                $hasErrors = true;
                            }
                        }
                    }
                    if ($hasErrors) {
                        $msg = "l'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes test:";
                        $lien = '<a href="index.php?uc=gererGenres&action=ajouterGenre">retour à saisie</a>';
                        include "vues/_v_afficherErreurs.php";
                    }
                }
            }
            break;
        }
        break;
    case "modifierGenre" :
    {
        $strLibelle = "";

        if (isset($_GET["id"])) {
            $strCode = strtoupper(htmlentities($_GET["id"]));
            $leGenre = GenreDal::loadGenreByID($strCode);
            if ($leGenre == NULL) {
                $tabErreurs["Erreur"] = "ce genre n'existe pas !";
                $tabErreurs["code"] = $strCode;
                $hasErrors = true;
            }
        } else {
            $tabErreurs["Erreur"] = "Aucun genre n'a été transmis pour modification !";
            $hasErrors = true;
        }
        if (!$hasErrors) {
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirGenre';
            }
        }

        switch ($option) {
            case "saisirGenre":
                {
                    include "vues/v_modifierGenre.php";
                }
                break;
            case "validerGenre" :
                {
                    if (isset($_POST["cmdValider"])) {
                        if (!empty($_POST["txtLibelle"])) {
                            $strLibelle = ucfirst(htmlentities($_POST["txtLibelle"]));
                        } else {
                            $tabErreurs["Erreur"] = "un libelle doit être enregistrer";

                            $hasErrors = true;
                        }
                        if (!$hasErrors) {
                            $leGenre->setLibelle($strLibelle);
                            $res = GenreDal::setGenre($leGenre);
                            if ($res) {
                                $msg = "Le genre " . $leGenre->getCode() . "-" . $leGenre->getLibelle() . " a été modifié";
                                include "vues/_v_afficherMessage.php";
                            } else {
                                $tabErreurs["Erreur"] = "une errer s'est produite lors de l'opération de mis à jour";
                                $tabErreurs["Code"] = $strCode;
                                $tabErreurs["Libellé"] = $strLibelle;
                                $tabErreurs["SQL"] = $res;
                                $hasErrors = true;
                            }
                        }
                    }
                }
                break;
        }
    }
    break;
    case "supprimerGenre" : {
        if (isset($_GET["option"])) {
            $strCode = strtoupper(htmlentities($_GET["option"]));
            $leGenre = GenreDal::loadGenreByID($strCode);
            if ($leGenre == null) {
                $tabErreurs["Erreur"] = "ce genre n'existe pas !";
                $tabErreurs["code"] = $strCode;
                $hasErrors = true;
            } else {
                $nbOuvrages = GenreDal::countOuvragesGenre($leGenre->getCode());
                if ($nbOuvrages > 0) {
                    $tabErreurs["Erreur"] = "ce genre est référencé par des ouvrages, suppresion impossible";
                    $tabErreurs["code"] = $strCode;
                    $hasErrors = true;
                }
            }
        } else {
            $tabErreurs["Erreur"] = "Aucun genre n'a été transmis pour suppression !";
            $hasErrors = true;
        }

        if (!$hasErrors) {
            $res = GenreDal::delGenre($leGenre->getCode());
            if ($res) {
                $msg = "le genre a était supprimer";
                include "vues/_v_afficherMessage.php";
            } else {
                $tabErreurs[] = "une erreur s'est produite dans l'opération de suppresion";
                $hasErrors = true;
            }
        }

        if ($hasErrors) {
            $msg = "l'opération de suppresion n'a pa pu être menée à terme en raison des erreurs suivantes :";
            $lien = '<a href="index.php?uc=gererGenres">retour à la saisie</a>';
            include 'vues/_v_afficherErreurs.php';
        }
}
        break;
    default:
        include 'vues/v_listeGenres.php';
        break;

}
