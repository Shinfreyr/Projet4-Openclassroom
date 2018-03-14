<!DOCTYPE html>
<?php $title = "Ecrire un nouvel Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Ecrire un nouvel Episode</h1>

<?php
    $content = ob_get_clean();
    require('template.php');
?>