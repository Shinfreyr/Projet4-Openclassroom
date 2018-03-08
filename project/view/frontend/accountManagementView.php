<!DOCTYPE html>
<?php $title = "Gestion de Compte, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Gestion de Compte</h1>

<?php

    while ($db = $request->fetch()) {
        echo    '<div class="accountManagement">
                    <img src="project/public/images/' . htmlspecialchars($db['avatar']) . '" />
                    <button type="button" class="btn btn-info btn-lg btn-block">Modifier</button>
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