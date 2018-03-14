<!DOCTYPE html>
<?php $title = "Panneau Admin, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Bienvenue <?= $_SESSION['pseudo'] ?></h1>

<?php
    while ($db = $request->fetch()) {
        echo '<h2 class="infoIndexBack" >Il y a un total de ' . htmlspecialchars($db[0]) . ' inscrits sur le site,</h2>';
    }
    while ($db = $requestCom->fetch()) {
        echo '<h2 class="infoIndexBack" >' . htmlspecialchars($db[0]) . ' commentaires </h2>';
    }
    while ($db = $requestAlert->fetch()) {
        echo '<h2 class="infoIndexBack" >dont ' . htmlspecialchars($db[0]) . ' en cours de signalement. </h2>';
    }
?>

<?php
    $content = ob_get_clean();
    require('template.php');
?>