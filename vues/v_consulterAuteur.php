    <div id="content">
            <h2>Gestion des Auteurs</h2>
            <div id="object-list">
                    <div class="corps-form">
                        <fieldset>
                            <legend>Consulter un Auteurs</legend>                        
                            <div id="breadcrumb">
                                <a href="index.php?uc=gererAuteurs&action=ajouterAuteur">Ajouter</a>&nbsp;
                                <a href="index.php?uc=gererAuteurs&action=modifierAuteur&id=<?php echo $strAuteur ;?>&option=saisirAuteur">Modifier</a>&nbsp;
                                <a href="index.php?uc=gererAuteurs&action=supprimerAuteur&option=<?php echo $strAuteur ;?>">Supprimer</a>
                            </div>
                            <table>
                                <tr>
                                    <td class="h-entete">
                                        id :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $strAuteur; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Nom :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $leAuteur->getNom(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Prénom :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $leAuteur->getPrenom(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Alias :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $leAuteur->getAlias(); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Notes :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $leAuteur->getNotes(); ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>                    
                    </div>
            </div>
        </div>