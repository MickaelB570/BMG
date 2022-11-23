
        <div id="content">
            <h2>Gestion des ouvrages</h2>
            <div id="object-list">
                                     
                <form action="index.php?uc=gererOuvrages&action=modifierOuvrage&id=<?php echo $intID; ?>&option=validerOuvrage" method="post">
                    <div class="corps-form">
                        <fieldset>
                            <legend>Modifier un ouvrage</legend>
                            <table>
                                <tr>
                                    <td>
                                        <label for="txtID">
                                            ID :
                                        </label>
                                    </td>
                                    <td>
                                        <input 
                                            type="text" id="txtID" 
                                            name="txtID"
                                            size="5"
                                            readonly="readonly"
                                            value="<?php echo $intID ?>"
                                            />
                                    </td>
                                </tr>                                        
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
                                            size="50" maxlength="128"
                                            value="<?php echo $strTitre ?>"
                                            />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="rbnSalle">Salle :</label>
                                    </td>
                                    <td>
                                        <?php
                                        if ($leOuvrage->getSalle() == 1) {
                                            ?>

                                            <input type="radio" checked  id="rbnSalle" name="rbnSalle" value="1"/>
                                            <label>1</label>
                                                
                                            <input type="radio" id="rbnSalle" name="rbnSalle" value="2"/>
                                            <label>2</label>
                                            <?php
                                        }
                                        else{
                            
                                        ?>
                                        <input type="radio"   id="rbnSalle" name="rbnSalle" value="1"/>
                                        <label>1</label>
                                        <input type="radio"  checked id="rbnSalle" name="rbnSalle" value="2"/>
                                        <label>2</label>
                                        <?php
                                    }
                                    ?>
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
                                            size="2" maxlength="2"  
                                            value ="<?php echo $strRayon ?>"/>
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
                                    
                                        foreach ($lesGenres as $unGenre) { 
                                            if($unGenre->getLibelle() == $strGenre)
                                            {
                                            ?>
                                            <option value="<?php echo $unGenre->getCode() ?>" selected ><?php echo $unGenre->getLibelle() ?></option>

                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                        <option value="<?php echo $unGenre->getCode() ?>"><?php echo $unGenre->getLibelle() ?></option>
                                    
                                    <?php
                                    }
                                } 
                                    ?>
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
                                            name="txtDate" 
                                            <?php
                                            if (!empty($strDate)) {
                                                ?>
                                                value ="<?php echo $strDate ?>"
                                                <?php
                                            } else {
                                                ?> 
                                                value = "<?php echo date('Y-m-d') ?>"
                                                <?php
                                            }
                                            ?>
                                            />
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div class="pied-form">
                        <p>
                            <input id="cmdValider" name="cmdValider" 
                                    type="submit"
                                    value="Modifier"/>
                        </p> 
                    </div>
                </form>
            </div>
        </div>          