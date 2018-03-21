<!DOCTYPE html>
<?php $title = "Les Episodes, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>



<!-- Titre +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Les Episodes</h1>

<!-- Content ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- Div All Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="allChapters container-fluid raw">    
        <h2 class="col-12">Tous les Episodes :</h2>

        <?php
            
            // All chapters view ++++++++++++++++++++++++++++++
            while ($db = $request->fetch()){
                echo '<img class="col-12 col-md-2" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" />' 
                . '<h3 class="col-12 col-md-6 align-self-center">' .htmlspecialchars($db['titlePost']) . ' : ' 
                . htmlspecialchars($db['datePost']) . '</h3>'
                .'<a class="chapterLink col-12 col-md-4 align-self-center" href="index.php?action=post&idChapter='. htmlspecialchars($db['idPost']) .'">Voir l\'Episode</a>';
            }
        ?>
    </div>

<?php

    $content = ob_get_clean();
    require('template.php'); 
    
?>