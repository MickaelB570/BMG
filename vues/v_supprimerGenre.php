<div id="content">
            <h2>Gestion des genres</h2>
                <form action="supprimerGenre.php" method="post">
                    <input type="hidden" name="hidCode" value="<?php echo $leGenre->getCode(); ?>" />
                    <input type="hidden" name="hidLib" value="<?php echo $leGenre->getLibelle(); ?>" />
                    <div class="corps-form">
                        <fieldset>
                            <legend>Supprimer un genre</legend>
                            <table>
                                <tr>
                                    <td>
                                        <span>
                                            Code :
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php echo $leGenre->getCode();?>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Libellé :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php echo $leGenre->getLibelle();  ?>
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
