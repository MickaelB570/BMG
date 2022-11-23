<?php
/**
 * Page de gestion des auteurs

 * @author 
 * @package default
 */
// inclure les bibliothèques de fonctions
require_once 'modele/PdoDao.class.php';
?>
        <div id="content">
            <h2>Gestion des auteurs</h2>
            <a href="index.php?uc=gererAuteurs&action=ajouterAuteur" title="Ajouter">
                Ajouter un auteur
            </a>
            <div class="corps-form">
                <!--- afficher la liste des auteurs -->
                <fieldset>	
                    <legend>Auteurs</legend>
                    <div id="object-list">
                      
                        <span><?php echo $nbAuteurs ?> auteur(s) trouvé(s)</span><br /><br />
                        <!-- afficher un tableau des auteurs -->
                        <table>
                        <!-- affichage de l'entete du tableau -->
                        <tr class="entete">
                            <!--création entete tableau avec noms de colonnes  --> 
                            <th>id</th>
                            <th>nom</th>

                        </tr>
                        <!-- affichage des lignes du tableau -->
                        <?php
                        $n = 0;
                        foreach ($lesAuteurs as $unAuteur) {
                            if (($n % 2) == 1) {
                                ?>
                                <tr class="impair">
                                    <?php
                                } else {
                                    ?>
                                <tr class="pair">
                                    <?php
                                }
                                // afficher la colonne 1 dans un hyperlien
                                ?>
                                <td><a href="index.php?uc=gererAuteurs&action=consulterAuteur&option=<?php echo $unAuteur->getID(); ?>"><?php
                                        echo $unAuteur->getID();
                                        ?></a></td>
                                <!-- afficher les colonnes suivantes -->
                                
                    
                                <td><?php
                            $temp = $unAuteur->getAlias();
                            if ($temp != null) {
                                echo $unAuteur->getNom() , " ", $unAuteur->getPrenom(), " ( ", $unAuteur->getAlias() ," )" ;

                            }
                            else {
                                echo $unAuteur->getNom() , " ", $unAuteur->getPrenom();

                            }
                            ?>
                                </td>
 
                            </tr>
        <?php
        $n++;
    }
   

    ?>
                    </table>
                       
                    </div>
                </fieldset>
            </div>
        </div>          
