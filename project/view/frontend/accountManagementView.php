<!DOCTYPE html>
<?php $title = "Gestion de Compte, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Gestion de Compte</h1>

<?php

    while ($db = $request->fetch()) {
        echo    '<div class="accountManagement">
                    <img src="project/public/images/' . htmlspecialchars($db['avatar']) . '" />
                    <form enctype="multipart/form-data" action="index.php?action=upload" method="post" class="col-12">
                        <fieldset>
                            <legend><h2>Avatar: <span class="infoAvatar"> (800x800 pixel & 1Mo maximum) </span></h2></legend>
                            <p>
                                <label for="uploadFile" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                <input name="file" type="file" id="uploadFile" />
                                <input type="submit" class="btn btn-info" name="submit" value="Uploader" />
                            </p>
                        </fieldset>
                    </form>
                    <h2 class="accountPseudo" >Pseudo: ' . htmlspecialchars($db['pseudo']) . '</h2>
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
                    <h2 class="accountPseudo" >Prénom: ' . htmlspecialchars($db['firstName']) . '</h2>
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
                    <h2 class="accountPseudo" >Nom: ' . htmlspecialchars($db['lastName']) . '</h2>
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
                    <h2 class="accountPseudo" >Email: ' . htmlspecialchars($db['eMail']) . '</h2>
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
                    <h2 class="accountPseudo" >Mot de Passe</h2>
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
                    

                </div>';
    }


    $content = ob_get_clean();
    require('template.php'); 

?>