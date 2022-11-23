<?php
require_once ('PdoDao.class.php');
require_once ('GenreDal.class.php');

class OuvrageDal
{
    /**
     * charge un objet de la classe PDO à partir de son code
     * @param $style : le code du ouvrage
     * @return un tableau d'ouvrages
     */
    public  static  function  loadOuvrages($style)
    {
        $cnx = new PdoDao();
        $qry = "SELECT * "
        . "FROM v_ouvrages "
        . "ORDER BY titre;";
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOexception')) {
            return PDO_EXCEPTION_VALUE;
        }
        if ($style == 1) {
            $res = array();
            foreach ($tab as $ligne) {
                $unOuvrage = new Ouvrage(
                    $ligne->no_ouvrage, 
                    $ligne->titre,
                    $ligne->salle,    
                    $ligne->rayon, 
                    GenreDal::loadGenreByID($ligne->code_genre),
                    $ligne->acquisition,
                    $ligne->dernier_pret,
                    $ligne->disponibilite,
                   
                );
                
                $unOuvrage->setListNomAuteurs($ligne->auteur);
                array_push($res, $unOuvrage);

            }
            return $res;
        }
        return $tab;
    }
/**
 * recupère toutes les informations d'un ouvrage par rapport un son id
 * @param $id : id des ouvrage
 * @return un objet ouvrage
 */
    public static function loadOuvrageByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT * from v_ouvrages WHERE v_ouvrages.no_ouvrage ='. $id;
        $res = $cnx->getRows($qry, array($id), 1);

        if (is_a($res, 'PDOException')) {

            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $ouvrage = $res[0]->no_ouvrage;
            $titre = $res[0]->titre;
            $salle = $res[0]->salle;
            $rayon = $res[0]->rayon;
            $genre = GenreDal::loadGenreByID($res[0]->code_genre);
            $date = $res[0]->acquisition;
            $auteur = $res[0]->auteur;
            $dernierPret = $res[0]->dernier_pret;
            $disponibilite = $res[0]->disponibilite;
            $temp = new Ouvrage($ouvrage,$titre,$salle,$rayon,$genre,$date,$dernierPret, $disponibilite);
            $temp->setListNomAuteurs($auteur);
            return $temp;
        } else {
            return NULL;
        }
    }
/**
 * Compte le nombre d'ouvrage
 * @param $code
 * @return le nombre d'ouvrage
 */
    public static function countOuvrages($code){
        $cnx = new PdoDao();
        $qry = 'SELECT COUNT(*) FROM ouvrage ';
        $res = $cnx->getValue($qry,array($code));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

/**
 * Ajoute un ouvrage dans la table ouvrage
 * @param les attributs d'un ouvrage
 * @return le nombre ligne affectés si la requête à réussi
 */
    public static function addOuvrage($titre,$salle,$rayon,$genre,$dateAcquisition) {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO ouvrage (titre,salle,rayon,code_genre,date_acquisition) VALUES (?,?,?,?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
                
                $titre,
                $salle,
                $rayon,
                $genre,
                $dateAcquisition
            )
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    /**
     * supprime un ouvrage de la table ouvrage
     * @param $noOuvrage : le numéro de l'ouvrage
     * @return le numéro de l'ouvrage supprimé si la requête à réussi
     */
    public static function delOuvrage($noOuvrage) {
        $cnx = new PdoDao();
        $qry = 'DELETE FROM ouvrage WHERE no_ouvrage = '.$noOuvrage;
        
        $res = $cnx->execSQL($qry,array($noOuvrage));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    /**
     * met à jour un ouvrage
     * @param $unOuvrage : recupère un ouvrage
     * @return le resultat s'il à réussi
     */
    public static function setOuvrage($unOuvrage)
    {
        $cnx = new PdoDao();
        $qry = 'UPDATE ouvrage SET titre ="'. $unOuvrage->getTitre() .'", Salle="'.$unOuvrage->getSalle() .'", Rayon="'.$unOuvrage->getRayon() .'", code_genre="'.$unOuvrage->getLeGenre() .'", date_Acquisition="'.$unOuvrage->getAcquisition() .'" where no_ouvrage = "'. $unOuvrage->getNoOuvrage() .'"';
        $res = $cnx->execSQL($qry,array($unOuvrage->getNoOuvrage(),$unOuvrage->getTitre(),$unOuvrage->getSalle(),$unOuvrage->getRayon(),$unOuvrage->getLeGenre(),$unOuvrage->getAcquisition()
        ));
        if (is_a($res, 'PDOException')){
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

/**
 * récupère l'ouvrage avec le plus grand id
 * @param $id : l'id de l'ouvrage
 * @return le résultat s'il à réussi
 */
    public static function getMaxid($id)
    {
        $cnx = new PdoDao();
        $qry = "SELECT MAX(?) from ouvrage";
        $res = $cnx->execSQL($qry,array($id->getNoOuvrage()
        ));
        if (is_a($res, 'PDOException')){
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

}
