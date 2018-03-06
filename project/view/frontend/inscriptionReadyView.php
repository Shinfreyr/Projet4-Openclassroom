<!DOCTYPE html>
<?php $title = "Inscription Réussie, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Inscription réussie</h1>

<?php

    $content = ob_get_clean();
    require('template.php'); 

?>