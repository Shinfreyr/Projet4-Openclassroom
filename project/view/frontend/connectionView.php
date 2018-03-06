<!DOCTYPE html>
<?php $title = "Connexion, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Connexion</h1>

<!-- Connection Form +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<form action="index.php?action=connection&db=ok" id="connectionForm" method="post">
  <div class="form-group">
    <label for="emailConnect">Email</label>
    <input type="email" class="form-control" name="emailConnect" id="emailConnect" aria-describedby="emailHelp" placeholder="Entrer votre email">
  </div>
  <div class="form-group">
    <label for="passwordConnect">Mot de Passe</label>
    <input type="password" class="form-control" name="passwordConnect" id="passwordConnect" placeholder="Votre Mot de Passe">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
    $content = ob_get_clean();
    require('template.php');

?>