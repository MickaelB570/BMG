<?php
/**
 * Page de gestion des genres

 * @author 
 * @package default
 */
// inclure les bibliothèques de fonctions
require_once 'modele/PdoDao.class.php';
?>
<div id="content">
    <h2>Gestion des genres</h2>
    <a href="index.php?uc=gererGenres&action=ajouterGenre" title="Ajouter">
        Ajouter un genre
    </a>
    <div class="corps-form">
        <!--- afficher la liste des genres -->
        <fieldset>	
            <legend>Genres</legend>
            <div id="object-list">
                <span> <?php echo $nbGenres ?> genre(s) trouvé(s) </span><br /><br />
                <?php
                // afficher un tableau des genres
                if ($nbGenres > 0) {
                    // création du tableau
                    ?>
                    <table>
                        <!-- affichage de l'entete du tableau -->
                        <tr class="entete">
                            <!--création entete tableau avec noms de colonnes  --> 
                            <th>Code</th>
                            <th>Libellé</th>
                        </tr>
                        <!-- affichage des lignes du tableau -->
                        <?php
                        $n = 0;
                        foreach ($lesGenres as $unGenre) {
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
                                <td><a href="index.php?uc=gererGenres&action=consulterGenre&option=<?php echo $unGenre->getCode(); ?>"><?php
                                        echo $unGenre->getCode();
                                        ?></a></td>
                                <!-- afficher les colonnes suivantes -->
                                <td><?php echo $unGenre->getLibelle(); ?></td>
                            </tr>
        <?php
        $n++;
    }
    ?>
                    </table>
                        <?php
                    } else {
                        echo "Aucun genre trouvé !";
                    }
                    ?>
            </div>
        </fieldset>
    </div>
</div>          
