<!DOCTYPE html>
<?php $title = "Gestions des Signalements, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Gestions des Signalements</h1>

<?php
    while ($db = $request->fetch()){
        echo '<div class="commentPost"><h3 class="col-12"><img class="avatar col-2 " src="project/public/images/'.htmlspecialchars($db['avatar']).'" />' 
        . '<span class="col-7">' . htmlspecialchars($db['pseudo']) . '</span>' 
        . '<span class="date col-3">' . htmlspecialchars($db['dateComment']) . '<span class="alertCount"> ' .htmlspecialchars($db['alertComment']) .' signalements</span></span></h3>'
        . '<a class="chapterLink col-12 col-md-4 align-self-center banAccount" href="index.php?action=banAccount&idAccount='.htmlspecialchars($db['idAccount']).'">Bannir le compte</a>'
        . '<a class="chapterLink col-12 col-md-4 align-self-center suppComment" href="index.php?action=suppComment&idComments='.htmlspecialchars($db['idComments']).'">Suprimer le commentaire</a>'
        . '<a class="chapterLink col-12 col-md-4 align-self-center resetAlert" href="index.php?action=resetAlert&idComments='.htmlspecialchars($db['idComments']).'">Remettre à zero le compteur d\'alerte</a>'
        . '<p class="commentContent">'. htmlspecialchars($db['contentComment']) . '</p>' 
        . '</div>';
    }


    $content = ob_get_clean();
    require('template.php');
?>