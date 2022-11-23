<div id="content">
    <h2>Gestion des ouvrages</h2>
    <div id="object-list">
     
    <form action="?uc=gererOuvrages&action=ajouterOuvrage&option=validerSaisie" method="post">
                <div class="corps-form">
                    <fieldset>
                        <legend>Ajouter un ouvrage</legend>
                        <table>
                            <tr>
                                <td>
                                    <label for="txtTitre">
                                        Titre :
                                    </label>
                                </td>
                                <td>
                                    <input 
                                        type="text" id="txtTitre" 
                                        name="txtTitre"
                                        size="50" maxlength="128"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="rbnSalle">Salle :</label>
                                </td>
                                <td>
                                    <input type="radio" id="rbnSalle" name="rbnSalle" value="1"/>
                                    <label>1</label>
                                    <input type="radio" id="rbnSalle" name="rbnSalle" value="2"/>
                                    <label>2</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtRayon">
                                        Rayon :
                                    </label>
                                </td>
                                <td>
                                    <input 
                                        type="text" id="txtRayon" 
                                        name="txtRayon"
                                        size="2" maxlength="2"/>
                                </td>
                            </tr>                                        
                            <tr>
                                <td>
                                    <label for="cbxGenres">
                                        Genre :
                                    </label>

                                </td>
                                <td>
                                <select name="txtGenre">
                                    <?php 
                                    
                                        foreach ($lesGenres as $unGenre) { ?>
                                        
                                        <option value="<?php echo $unGenre->getCode() ?>"><?php echo $unGenre->getLibelle() ?></option>
                                    
                                    <?php
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtDate">
                                        Acquisition :
                                    </label>
                                </td>
                                <td>
                                    <input 
                                        type="date" id="txtDate" 
                                        name="txtDate"/>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
                <div class="pied-form">
                    <p>
                        <input id="cmdValider" name="cmdValider" 
                                type="submit"
                                value="Ajouter"/>
                    </p> 
                </div>
            </form>
    </div>
</div>          