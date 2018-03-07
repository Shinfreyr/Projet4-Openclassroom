<!DOCTYPE html>
<?php $title = "Gestion de Compte, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Gestion de Compte</h1>


<?php

    $content = ob_get_clean();
    require('template.php'); 

?>