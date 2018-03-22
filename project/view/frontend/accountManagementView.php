<!DOCTYPE html>
<?php $title = "Gestion de Compte, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Gestion de Compte</h1>

<!-- Content ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php
    // Admin Link
    if($_SESSION['statue'] === 'Admin') {
       echo '<a type="button" href="index.php?action=admin" class="btn btn-info btn-lg btn-block">Accéder au panneau Admin</a>'; 
    }

    while ($db = $request->fetch()) {
        echo    '<div class="accountManagement">'
                    //Avatar Modification
                    .'<img src="project/public/images/' . htmlspecialchars($db['avatar']) . '" alt="Avatar" />
                    <form enctype="multipart/form-data" action="index.php?action=uploadAvatar" method="post" class="col-12">
                        <fieldset>
                            <legend><h2>Avatar: <span class="infoAvatar"> (800x800 pixel & 1Mo maximum) </span></h2></legend>
                            <p>
                                <label for="uploadFile" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                <input name="file" type="file" id="uploadFile" />
                                <input type="submit" class="btn btn-info" name="submit" value="Uploader" />
                            </p>
                        </fieldset>
                    </form>'
                    //Pseudo info
                    .'<h2 class="accountPseudo col-12" >Pseudo: ' . htmlspecialchars($db['pseudo']) . '</h2>'
                    //Firstname Modification
                    .'<h2 class="accountPseudo col-12" >Prénom: ' . htmlspecialchars($db['firstName']) . '</h2>
                    <a type="button" href="index.php?action=accountModification" class="btn btn-info btn-lg btn-block">Modifier</a>'
                    //Lastname Modification
                    .'<h2 class="accountPseudo col-12" >Nom: ' . htmlspecialchars($db['lastName']) . '</h2>
                    <a type="button" href="index.php?action=accountModification" class="btn btn-info btn-lg btn-block">Modifier</a>'
                    //Email Modification
                    .'<h2 class="accountPseudo col-12" >Email: ' . htmlspecialchars($db['eMail']) . '</h2>
                    <a type="button" href="index.php?action=accountModification" class="btn btn-info btn-lg btn-block">Modifier</a>'
                    //Password Modification
                    .'<h2 class="accountPseudo col-12" >Mot de Passe</h2>
                    <a type="button" href="index.php?action=accountModification" class="btn btn-info btn-lg btn-block">Modifier</a>
                </div>';
    }


    $content = ob_get_clean();
    require('template.php'); 

?>