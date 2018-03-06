<!DOCTYPE html>
<?php $title = "Inscription, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Inscription</h1>

<!-- Form Inscription ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<form action="index.php?action=inscription&db=ok" id="inscriptionForm" method="post">
    <div class="form-group">
        <label for="pseudo">Pseudo*</label>
        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Votre Pseudo">
    </div>
    <div class="form-group">
        <label for="firstName">Prénom</label>
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="Votre Prénom">
    </div>
    <div class="form-group">
        <label for="lastName">Nom</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Votre Nom">
    </div>    
    <div class="form-group">
        <label for="email">Email*</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Votre Email">
        <small id="emailHelp" class="form-text text-muted">Votre email restera confidentiel</small>
    </div>
    <div class="form-group">
        <label for="password">Mot de Passe*</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Votre Mot de Passe">
    </div>
    <div class="form-group">
        <label for="passwordComp">Retapez votre Mot de Passe*</label>
        <input type="password" class="form-control" name="passwordComp" id="passwordComp" placeholder="Retapez Votre Mot de Passe">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="checkHuman" id="checkHuman" value="ok">
        <label class="form-check-label" for="checkHuman">Je ne suis pas un robot</label>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<?php

    $content = ob_get_clean();
    require('template.php'); 

?>