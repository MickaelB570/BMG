<?php
include 'modele/AuteurDal.class.php';

// variables pour la gestion des messages
$titrePage = 'Gestion des auteurs';
// variables pour la gestion des erreurs
$tabErreurs = array();
$hasErrors = false;



if(isset($_GET["action"]))
{
    $action = $_GET['action'];
}
else
{
    $action = "listerAuteurs";
}

switch ($action) {
    case "listerAuteurs" :
        {
            $lesAuteurs = AuteurDal::loadAuteurs(1);
            $nbAuteurs = count($lesAuteurs);
            include 'vues/v_listerAuteurs.php';

        }
        break;

    case "consulterAuteur" :{
        // variables pour la gestion des erreurs
        $hasErrors = false;

        // récupération du code
        if (isset($_GET["option"]) && $_GET["option"] != "") {
            $strAuteur = strtoupper(htmlentities($_GET["option"]));
            // récupération du libellé dans la base

            $leAuteur = AuteurDal::loadAuteurByID($strAuteur);
            // Si l’entité existe
            if ($leAuteur == null) {
                $tabErreurs[] = "Cet auteur n'existe pas";
                $hasErrors = true;
            }
        } // affichage des erreurs
        else {
            $tabErreurs[""] = "aucun auteur n'a été transmis pour consultation !";
            $hasErrors = true;
        }

        if ($hasErrors) {
            $msg = "La consultation est impossible";
            $lien = '<a href="index.php?uc=gererAuteurs">retour à la saisie</a>';
            include 'vues/_v_afficherErreurs.php';
        } else {
            include "vues/v_consulterAuteur.php";
        }
    }

        break;
    case "ajouterAuteur" :
        {
            $hasErrors = false;
            $strID = '';
            $strPrenom = '';
            $strNom = '';
            $strNote = "";
            $strAlias = "";
            $lesAuteurs = AuteurDal::loadAuteurs(1);


            // traitement de l'option : saisie ou validation ?
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case 'saisirAuteur' :
                    {
                        include 'vues/v_ajouterAuteur.php';
                    }
                    break;
                case 'validerSaisie':
                {
                    $afficherForm = false;
                    if (isset($_POST["cmdValider"])) {
                        // récupération du libellé
                        if (!empty($_POST["txtNom"])) {
                            $strNom = ucfirst(htmlentities($_POST["txtNom"]));
                        }
                        else {
                            $tabErreurs["Erreur"] = 'Un nom d\'auteur est obligatoire';
                            $tabErreurs["Nom"] = $strNom;
                            $hasErrors = true;
                        }
                        // récupération du code
                        if (!empty($_POST["txtPrenom"])) {
                            $strPrenom = strtoupper(htmlentities($_POST["txtPrenom"]));
                        }
                        if (!empty($_POST["txtAlias"])) {
                            $strAlias = strtoupper(htmlentities($_POST["txtAlias"]));
                        }
                        if (!empty($_POST["txtNote"])) {
                            $strNote = strtoupper(htmlentities($_POST["txtNote"]));
                        }


                        if (!$hasErrors) {
                            // ajout dans la base de données
                            try {
                                $res = AuteurDal::addAuteur($strNom, $strPrenom, $strAlias, $strNote);
                                
                                if ($res > 0) {
                                    $msg = 'L\'Auteur ' . $strID . '-' . $strNom . " " .$strPrenom . 'a été ajouté';
                                    include 'vues/_v_afficherMessage.php';
                                    //include 'vues/v_consulterGenre.php

                                } else {
                                    $msg = "L'opération d'ajout n'a pas pu être menée à terme en raison des erreurs suivantes :";
                                    $lien = '<a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Retour à la saisie</a>';
                                    include 'vues/_v_afficherErreurs.php';
                                }
                            } catch (PDOException $e) {
                                $tabErreurs["Erreur"] = 'Une exception PDO a été levée !';
                                $hasErrors = true;
                            }
                        }
                    }
                }
            }
            break;
            
        }
        break;
    case "modifierAuteur" :
    {
        $strNom = "";
        $strPrenom = "";
        $strAlias = "";
        $strNote = "";
        $strID = 0;

        if (isset($_GET["id"]) && $_GET["id"] != null) {
            $intID = intval($_GET["id"]);
            $leAuteur = AuteurDal::loadAuteurByID($intID);
            
            if ($leAuteur == NULL) {
                $tabErreurs["Erreur"] = "cet auteur n'existe pas !";
                $tabErreurs["id"] = $strID;
                $hasErrors = true;
            }
            else {
                $strNom = $leAuteur->getNom();
                $strPrenom = $leAuteur->getPrenom();
                $strAlias = $leAuteur->getAlias();
                $strNote = $leAuteur->getNotes();
            }
        } else {
            $tabErreurs["Erreur"] = "Aucun auteur n'a été transmis pour modification !";
            $hasErrors = true;
        }
        if (!$hasErrors) {
            if (isset($_GET["option"])) {
                $option = htmlentities($_GET["option"]);
            } else {
                $option = 'saisirAuteur';
            }
            switch ($option) {
                case "saisirAuteur":
                    {
                        if ($_GET["id"] != "") {
                            include "vues/v_modifierAuteur.php";
                        }
                       
                    }
                    break;
                case "validerAuteur" :
                    {
                        if (isset($_POST["cmdValider"])) {
                            if (!empty($_POST["txtNom"])) {
                                $strNom = ucfirst(htmlentities($_POST["txtNom"]));                    
                            } else {
                                $tabErreurs["Erreur"] = "un Nom doit être enregistrer";
                                $tabErreurs["Nom"] = $strNom;
                                $hasErrors = true;
                            }
                                $strPrenom = ucfirst(htmlentities($_POST["txtPrenom"]));    
                                $strAlias = ucfirst(htmlentities($_POST["txtAlias"]));    
                                $strNote = ucfirst(htmlentities($_POST["txtNotes"]));       
                                
                            if (!$hasErrors) {
                                $leAuteur->setNom($strNom);
                                $leAuteur->setPrenom($strPrenom);
                                $leAuteur->setAlias($strAlias);
                                $leAuteur->setNotes($strNote);
                                $res = AuteurDal::setAuteur($leAuteur);
                                echo $res;
                                if ($res > 0) {
                                    $msg = "L'auteur " . $leAuteur->getID() . "-" . $leAuteur->getNom() . " a été modifié";
                                    include "vues/_v_afficherMessage.php";
                                } else {
                                    $tabErreurs["Erreur"] = "une erreur s'est produite lors de l'opération de mis à jour";
                                    $tabErreurs["ID"] = $strID;
                                    $tabErreurs["Nom"] = $strNom;
                                    $tabErreurs["SQL"] = $res;
                                    $hasErrors = true;
                                }
                            }
                        }
                    }
                    break;
        }       
        } else 
        {
            $msg = "L'opération de modification n'a pas pu être menée à terme en raison des erreurs suivantes :";
            $lien = '<a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Retour à la saisie</a>';
            include 'vues/_v_afficherErreurs.php';
        }
    }
    break;
    case "supprimerAuteur" : {
        if (isset($_GET["option"])) {
            $strID = strtoupper(htmlentities($_GET["option"]));
            $leAuteur = AuteurDal::loadAuteurByID($strID);
            if ($leAuteur == null) {
                $tabErreurs["Erreur"] = "cet auteur n'existe pas !";
                $tabErreurs["id"] = $strID;
                $hasErrors = true;
            } else {
                $nbAuteur = AuteurDal::countAuteur($leAuteur->getID());
                if ($nbAuteur > 0) {
                    $tabErreurs["Erreur"] = "cet auteur est référencé par des ouvrages, suppresion impossible";
                    $tabErreurs["id"] = $strID;
                    $hasErrors = true;
                }
            }
        } else {
            $tabErreurs["Erreur"] = "Aucun auteur n'a été transmis pour suppression !";
            $hasErrors = true;
        }

        if (!$hasErrors) {
            $res = AuteurDal::delAuteur($leAuteur->getID());
            if ($res > 0) {
                $msg = "l'auteur a été supprimé";
                include "vues/_v_afficherMessage.php";
                $lesAuteurs = AuteurDal::loadAuteurByID(1);
            } else {
                $tabErreurs[] = "Cet auteur à des ouvrages référencés, suppréssion impossible !";
                $hasErrors = true;
                
            }
        }

        if ($hasErrors) {
            $msg = "l'opération de suppresion n'a pa pu être menée à terme en raison des erreurs suivantes :";
            $lien = '<a href="index.php?uc=gererAuteurs">retour à la saisie</a>';
            include 'vues/_v_afficherErreurs.php';
        }
}
        break;
    default:
        include 'vues/v_listerAuteurs.php';
        break;

}