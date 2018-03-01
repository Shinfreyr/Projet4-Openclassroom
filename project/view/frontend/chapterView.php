<!DOCTYPE html>
<?php $title = "Les Episodes, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>



<!-- Titre +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Les Episodes</h1>

<?php
    //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

    $content = ob_get_clean();
    require('template.php'); 
    
?>