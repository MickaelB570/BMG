
        <div id="content">
            <h2>Gestion des auteurs</h2>
           
                <form action="supprimerAuteur.php?id=<?php echo $intID ?>" method="post">                   
                    <input type="hidden" name="hidID" value="<?php echo $leAuteur->getID(); ?>" />
                    <input type="hidden" name="hidNom" value="<?php echo $leAuteur->getNom(); ?>" />
                    <input type="hidden" name="hidPrenom" value="<?php echo $leAuteur->getPrenom(); ?>" />                       
                    <div class="corps-form">
                        <fieldset>
                            <legend>Supprimer un auteur</legend>
                            <table>
                                <tr>
                                    <td>
                                        <span>
                                            ID :
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <?php  echo $leAuteur->getID();  ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Nom :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php  echo $leAuteur->getNom();  ?> 
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <span>
                                            Prénom :
                                        </span>
                                    </td>
                                    <td>
                                        <span> 
                                            <?php  echo $leAuteur->getPrenom();  ?> 
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
