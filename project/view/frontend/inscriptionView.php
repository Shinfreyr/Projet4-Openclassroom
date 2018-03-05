<!DOCTYPE html>
<?php $title = "Inscription, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Inscription</h1>


<form action="index.php?action=inscription&db=ok" method="post">
    <p>
        <label for="pseudo">*Pseudo : </label><br />
        <input type="text" name="pseudo" id="firstName" /><br />    

        <label for="firstName">Prénom : </label><br />
        <input type="text" name="pseudo" id="firstName" /><br />

        <label for="lastName">Nom : </label><br />
        <input type="text" name="lastName" id="lastName" /><br />
                
        <label for="eMail">*Email : </label><br />
        <input type="text" name="eMail" id="eMail" /><br />

        <label for="password">*Mot de Passe : </label><br />
        <input type="password" name="password" id="password" /><br />

        <label for="passComp">*Retappez votre Mot de Passe : </label><br />
        <input type="password" name="passComp" id="passComp" /><br />
                
        <input type="submit" value="Envoyer" />
    </p>
</form>

<?php

    $content = ob_get_clean();
    require('template.php'); 

?>