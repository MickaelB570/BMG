<?php

/** 
 * 
 * BMG
 * © GroSoft
 * 
 * References
 * Classes métier
 *
 *
 * @package 	default
 * @author 	dk
 * @version    	1.0
 */

/*
 *  ====================================================================
 *  Classe Genre : représente un genre d'ouvrage 
 *  ====================================================================
*/

class Genre
{
    private $_code;
    private $_libelle;

    /**
     * Constructeur 
     */
    public function __construct(
        $p_code,
        $p_libelle
    ) {
        $this->setCode($p_code);
        $this->setLibelle($p_libelle);
    }

    /**
     * Accesseurs
     */
    public function getCode()
    {
        return $this->_code;
    }

    public function getLibelle()
    {
        return $this->_libelle;
    }

    /**
     * Mutateurs
     */
    public function setCode($p_code)
    {
        $this->_code = $p_code;
    }

    public function setLibelle($p_libelle)
    {
        $this->_libelle = $p_libelle;
    }
}
class Auteur
{
    private $_id;
    private $_nom;
    private $_prenom;
    private $_alias;
    private $_notes;

    /**
     * Constructeurs
     */
    public function __construct($id, $nom, $prenom, $alias, $notes)
    {
        $this->setID($id);
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setAlias($alias);
        $this->setNotes($notes);
    }

    /**
     * Accesseurs
     */
    public function getID()
    {
        return $this->_id;
    }
    public function getNom()
    {
        return $this->_nom;
    }
    public function getPrenom()
    {
        return $this->_prenom;
    }
    public function getAlias()
    {
        return $this->_alias;
    }
    public function getNotes()
    {
        return $this->_notes;
    }

    /**
     * modificateurs
     */

    public function setID($id)
    {
        $this->_id = $id;
    }
    public function setNom($nom)
    {
        $this->_nom = $nom;
    }
    public function setPrenom($prenom)
    {
        $this->_prenom = $prenom;
    }
    public function setAlias($alias)
    {
        $this->_alias = $alias;
    }
    public function setNotes($notes)
    {
        $this->_notes = $notes;
    }
}

class Ouvrage
{
    private $_noOuvrage;
    private $_titre;
    private $_salle;
    private $_rayon;
    private $_leGenre; // objet de la class genre
    private $_dateAcquision;
    // champ de la vue v_ouvrage
    private $_lesAuteurs;
    private $_dernierPret;
    private $_disponibilite;
    private $_listeNomsAuteurs;

    

    // Constructeur

    public function __construct(
        $p_num,
        $p_titre,
        $p_salle,
        $p_rayon,
        $p_leGenre,
        $p_Acquisition = null,
        $p_dernierPret,
        $p_disponibilite
        
    ) {
        $this->setNoOuvrage($p_num);
        $this->setTitre($p_titre);
        $this->setSalle($p_salle);
        
        $this->setRayon($p_rayon);
        $this->setLeGenre($p_leGenre);
        $this->setAcquisition($p_Acquisition);
        $this->_lesAuteurs = array();
        $this->setDernierPret($p_dernierPret);
        $this->setDisponibilite($p_disponibilite);
        
    }

    /**
     * Accesseurs
     */
    public function getNoOuvrage()
    {
        return $this->_noOuvrage;
    }
    public function getTitre()
    {
        return $this->_titre;
    }
    public function getSalle()
    {
        return $this->_salle;
    }

    public function getRayon()
    {
        return $this->_rayon;
    }
    public function getLeGenre()
    {
        return $this->_leGenre;
    }
    public function getAcquisition()
    {
        return $this->_dateAcquision;
    }
    public function getDernierPret()
    {
        return $this->_dernierPret;
    }
    public function getDisponibilite()
    {
        return $this->_disponibilite;
    }
    public function getlisteNomsAuteurs()
    {
        return $this->_listeNomsAuteurs;
    }


    /**
     * modificateurs
     */

    public function setNoOuvrage($num)
    {
        $this->_noOuvrage = $num;
    }
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }
    public function setSalle($salle)
    {
        $this->_salle = $salle;
    }
    public function setRayon($rayon)
    {
        $this->_rayon = $rayon;
    }
    public function setLeGenre($leGenre)
    {
        $this->_leGenre = $leGenre;
    }
    public function setAcquisition($dateAcquisition)
    {
        $this->_dateAcquision = $dateAcquisition;
    }
    public function setDernierPret($dernierPret)
    {
        $this->_dernierPret = $dernierPret;
    }
    public function setDisponibilite($disponibilite)
    {
        $this->_disponibilite = $disponibilite;
    }
    public function setListNomAuteurs($listeNomsAuteurs)
    {
        $this->_listeNomsAuteurs = $listeNomsAuteurs;
    }

}
