<!DOCTYPE html>
<?php $title = "Jean Forteroche, Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>
<h1>Hello World</h1>

<?php

    $content = ob_get_clean();
    require('template.php'); 
    
?>