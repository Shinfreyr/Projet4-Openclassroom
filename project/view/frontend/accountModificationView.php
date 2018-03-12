<!DOCTYPE html>
<?php $title = "Modifiction des Informations de Compte, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Modifiction des Informations de Compte</h1>

<h2 class="accountManagement">Ne remplir que les champs à modifier</h2>

<?php
    while ($db = $request->fetch()) {
        // Form Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
        echo    
            '<form action="index.php?action=accountModification&db=ok" id="inscriptionForm" method="post">
                <div class="form-group">
                    <label for="firstName">Prénom: ' . htmlspecialchars($db['firstName']) . '</label>
                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Votre Prénom">
                </div>
                <div class="form-group">
                    <label for="lastName">Nom: ' . htmlspecialchars($db['lastName']) . '</label>
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Votre Nom">
                </div>    
                <div class="form-group">
                    <label for="email">Email: ' . htmlspecialchars($db['eMail']) . '</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Votre Email">
                    <small id="emailHelp" class="form-text text-muted">Votre email restera confidentiel</small>
                </div>
                <div class="form-group">
                    <label for="password">Mot de Passe</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre Mot de Passe">
                </div>
                <div class="form-group">
                    <label for="passwordComp">Retapez votre Mot de Passe</label>
                    <input type="password" class="form-control" name="passwordComp" id="passwordComp" placeholder="Retapez Votre Mot de Passe">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>';
    }


    $content = ob_get_clean();
    require('template.php');
?>