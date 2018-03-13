<!DOCTYPE html>
<?php $title = "Panneau Admin, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>



<?php
    $content = ob_get_clean();
    require('template.php');
?>