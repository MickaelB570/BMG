
        <div id="content">
            <h2>Gestion des ouvrages</h2>
            <div id="object-list">
                                   
                    <div class="corps-form">
                        <fieldset>
                            <legend>Consulter un ouvrage</legend>                        
                            <div id="breadcrumb">
                                <a href="index.php?uc=gererOuvrages&action=ajouterOuvrage">Ajouter</a>&nbsp;
                                <a href="index.php?uc=gererOuvrages&action=modifierOuvrage&id=<?php echo $intID ?>">Modifier</a>&nbsp;
                                <a href="index.php?uc=gererOuvrages&action=supprimerOuvrage&id=<?php echo $intID ?>">Supprimer</a>
                            </div>
                            <table>
                                <tr class="entete">
                                    <td class="h-entete">
                                        ID :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $intID ?>
                                    </td>
                                    <td class="center h-valeur" rowspan="8">
                                    <?php
                                        if ($intID < 172) {
                                            ?>
                                            <img src="img/couvertures/<?php echo $intID ?>.jpg">
                                            <?php
                                        }
                                        else {
                                            ?>
                                            <img src="img/couvertures/0.jpg">
                                            <?php
                                        }
                                        
                                    ?>
                                        </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Titre :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $lOuvrage->getTitre(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Auteur(s) :
                                    </td>
                                    <td class="erreur h-valeur"><?php echo $lOuvrage->getlisteNomsAuteurs();  ?>
                                    </td>
                                    
                                </tr>                                
                                <tr>
                                    <td class="h-entete">
                                        Date d'acquisition :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $lOuvrage->getAcquisition(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Genre :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $lOuvrage->getLeGenre()->getLibelle(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Salle et rayon :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $lOuvrage->getSalle() . ', ' . $lOuvrage->getRayon(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Dernier prêt :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $lOuvrage->getDernierPret(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Disponibilité :
                                    </td>
                                    <td class="h-valeur">
                                        <?php
                                        // affichage image verte ou rouge
                                        if ($lOuvrage->getDisponibilite() == 'D') {
                                            ?>
                                            <img src ="img/dispo.png" alt ="disponible" />
                                            <?php
                                        } else {
                                            ?>
                                            <img src ="img/emprunte.png" alt ="emprunté" />
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>                    
                    </div>
            </div>
        </div>