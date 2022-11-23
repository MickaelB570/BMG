<?php 
require_once ('PdoDao.class.php');

class AuteurDal
{
    public static function loadAuteurs($style)
    {
        $cnx = new PdoDao();
        $qry = "select * from auteur";
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOexception')) {
            return PDO_EXCEPTION_VALUE;
        }
        if ($style == 1) {
            $res = array();
            foreach ($tab as $ligne) {
                $unAuteur = new Auteur($ligne->id_auteur, $ligne->nom_auteur, $ligne->prenom_auteur,$ligne->alias,$ligne->notes);
                array_push($res, $unAuteur);

            }
            return $res;
        }
        return $tab;
    }

    /**
     * charge un objet de la classe Genre à partir de son code
     * @param  $id : le code de l'auteur
     * @return  "un objet de la classe Genre
     */
    public static function loadAuteurByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT id_auteur, nom_auteur, prenom_auteur, alias, notes FROM auteur WHERE id_auteur = "'. $id . ' " ';
        $res = $cnx->getRows($qry, array($id), 1);
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $id = $res[0]->id_auteur;
            $nom = $res[0]->nom_auteur;
            $prenom = $res[0]->prenom_auteur;
            $alias = $res[0]->alias;
            $notes = $res[0]->notes;

            return new Auteur($id, $nom,$prenom,$alias,$notes);
        } else {
            return NULL;
        }
    }


    /**
     * ajoute d'un auteur
     * @param string $id : l'ID de l'auteur à ajouter
     * @param string $nom : le nom de l'auteur à ajouter
     * @param string $prenom : le prenom de l'auteur à ajouter
     * @param string $alias : alias de l'auteur à ajotuer
     * @param string $note : note supplémentaire de l'auteur à ajouter
     * @return  le nombre de ligne affecté : si > 0  réussite
     */
    public static function addAuteur($nom, $prenom, $alias, $note)
    {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO auteur (nom_auteur, prenom_auteur, alias, notes) VALUES (?,?,?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
                $nom,
                $prenom,
                $alias,
                $note
            )
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    /**
     * calcule le nombre d'auteur 
     * @param type $id : l'id de l'auteur
     * @return le nombre d'auteur
     */
    public static function countAuteur($id){
        $cnx = new PdoDao();
        $qry = 'SELECT COUNT(*) FROM auteur WHERE id_auteure = "'. $id .'"';
        $res = $cnx->getValue($qry,array($id));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

   /**
     * supprime un auteur
     * @param   int $id : l'id de l'auteur à supprimer
     * @return le nombre de lignes affectées
     */
    public static function delAuteur($id) {
        $cnx = new PdoDao();
        $qry = 'DELETE FROM auteur WHERE id_auteur = '. $id  ;
        $res = $cnx->execSQL($qry,array($id));
        if (is_a($res,'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    public static function setAuteur($unAuteur)
    {
        $cnx = new PdoDao();
        $qry = 'update auteur set nom_auteur = ?, prenom_auteur = ?, alias= ?, notes= ? where id_auteur = ?' ;
        $res = $cnx->execSQL($qry,array($unAuteur->getNom(),$unAuteur->getPrenom(),$unAuteur->getAlias(),$unAuteur->getNotes(),$unAuteur->getID()
        ));
        if (is_a($res, 'PDOException')){
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }

    

}