    <div id="content">
            <h2>Gestion des genres</h2>
            <div id="object-list">
                    <div class="corps-form">
                        <fieldset>
                            <legend>Consulter un genre</legend>                        
                            <div id="breadcrumb">
                                <a href="index.php?uc=gererGenres&action=ajouterGenre">Ajouter</a>&nbsp;
                                <a href="index.php?uc=gererGenres&action=modifierGenre&id=<?php echo $strGenre ;?>&option=saisirGenre">Modifier</a>&nbsp;
                                <a href="index.php?uc=gererGenres&action=supprimerGenre&option=<?php echo $strGenre ;?>">Supprimer</a>
                            </div>
                            <table>
                                <tr>
                                    <td class="h-entete">
                                        Code :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $strGenre; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h-entete">
                                        Libellé :
                                    </td>
                                    <td class="h-valeur">
                                        <?php echo $leGenre->getLibelle(); ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>                    
                    </div>
            </div>
        </div>