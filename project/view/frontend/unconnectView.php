<!DOCTYPE html>
<?php $title = "Unconnect, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Vous êtes déconnecté !</h1>

<?php
    $content = ob_get_clean();
    require('template.php');
?>