<!DOCTYPE html>
<?php $title = "Jean Forteroche, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>


    <!-- Title Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <h1>Billet simple pour l'Alaska</h1>

    <div class="lastChapter container-fluid raw">    
        <h2 class="col-12">Dernier Episode :</h2>

        <?php
            //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 
            
            // Last chapter view ++++++++++++++++++++++++++++++
            while ($db = $request->fetch()){
                echo '<img class="col-12 col-md-2" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" />' 
                . '<h3 class="col-12 col-md-6 align-self-center">' .htmlspecialchars($db['titlePost']) . ' : ' 
                . htmlspecialchars($db['datePost']) . '</h3>'
                .'<a class="chapterLink col-12 col-md-4 align-self-center" href="index.php?action=post&billet='. htmlspecialchars($db['idPost']) .'">Voir l\'Episode</a>';
            }
        ?>
    </div>

<?php

    $content = ob_get_clean();
    require('template.php'); 
    
?>