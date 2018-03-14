<!DOCTYPE html>
<?php $title = "Succès de la création d'un nouveau brouillon, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Vous avez créé un nouveau brouillon avec succès</h1>

<?php
    $content = ob_get_clean();
    require('template.php');
?>