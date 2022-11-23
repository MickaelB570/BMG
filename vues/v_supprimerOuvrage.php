        <div id="content">
            <h2>Gestion des ouvrages</h2>
                <form action="supprimerOuvrage.php&id=<?php echo $intID ?>" method="post">
                    <input type="hidden" name="hidTitre" value="<?php echo $unOuvrage->getTitre(); ?>" />
                    <input type="hidden" name="hidSalle" value="<?php echo $unOuvrage->getSalle(); ?>" />
                    <input type="hidden" name="hidRayon" value="<?php echo $unOuvrage->getRayon(); ?>" />
                    <input type="hidden" name="hidLeGenre" value="<?php echo $unOuvrage->getLeGenre(); ?>" />
                    <input type="hidden" name="hidAcquisition" value="<?php echo $unOuvrage->getAcquisition(); ?>" />
                    <div class="corps-form">
                        <fieldset>
                            <legend>Supprimer un ouvrage</legend>
                            <table>
                                
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Titre :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php echo $unOuvrage->getTitre();?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Salle :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php  echo $unOuvrage->getSalle(); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Rayon :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php echo $unOuvrage->getRayon(); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>
                                            Genre :
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $unOuvrage->getLeGenre(); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>
                                            Acquisition :
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $unOuvrage->getAcquisition(); ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="pied-form">
                        <p>
                            <input id="cmdValider" name="cmdValider" 
                                   type="submit"
                                   value="Supprimer"
                                   />
                        </p> 
                    </div>
                </form>
        </div>          