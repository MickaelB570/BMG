
        <div id="content">
            <h2>Gestion des ouvrages</h2>
            <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Ajouter</a>&nbsp;
            </a>
            <div class="corps-form">
                <!--- afficher la liste des ouvrages -->
                <fieldset>	
                    <legend>Ouvrages</legend>
                    <div id="object-list">
                       
                        <span><?php echo $nbOuvrages ?> ouvrage(s) trouvé(s)</span><br /><br />
                        <?php
                        // afficher un tableau des ouvrages
                        if ($nbOuvrages > 0) {
                            // création du tableau
                            ?>

                            <table>
                                <!--affichage de l'entête du tableau -->
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Genre</th>
                                    <th>Auteur</th>
                                    <th>Salle</th>
                                    <th>Rayon</th>                                    
                                    <th>Dernier prêt</th>
                                    <th>Disponibilité</th>
                                </tr>
                                <?php
                                // affichage des lignes du tableau
                                $n = 0;
                                foreach ($lesOuvrages as $unOuvrage) {
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
                                        <td><a href="index.php?uc=gererOuvrages&action=consulterOuvrage&id=<?php echo $unOuvrage->getNoOuvrage() ?>">
                                                <?php echo $unOuvrage->getNoOuvrage() ?></a></td>
                                        <!-- afficher les colonnes suivantes -->
                                        <td><?php echo $unOuvrage->getTitre() ?> </td>
                                        <td><?php echo $unOuvrage->getLeGenre()->getLibelle() ?> </td>
                                         
                                        <?php
                                        
                                            if ($unOuvrage->getlisteNomsAuteurs() == null) {
                                                ?>
                                                <td class="erreur">Indéterminé </td>
                                                <?php
                                            } else {
                                                ?>
                                                
                                                <td><?php echo $unOuvrage->getlisteNomsAuteurs() ?> </td>
                                                <?php
                                            }
                                            
                                            ?>
                                        <td><?php echo $unOuvrage->getSalle() ?> </td>
                                        <td><?php echo $unOuvrage->getRayon() ?> </td>
                                        <td><?php echo $unOuvrage->getAcquisition() ?> </td>
                                        
                                        <?php
                                        
                                        if ($unOuvrage->getDisponibilite() == 'D') {
                                            ?><td class="center"><img src="img/dispo.png"></td>
                                            <?php
                                        } else {
                                            ?>
                                            <td class="center"><img src="img/emprunte.png"></td>
                                                <?php
                                            }
                                            ?>
                                    </tr>
                                    <?php
                                    $n++;
                                }
                            
                            }
                                ?>
                            </table>
                    </div>
                </fieldset>
            </div>
            
        </div>    