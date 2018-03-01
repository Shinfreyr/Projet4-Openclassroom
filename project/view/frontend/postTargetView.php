<!DOCTYPE html>
<?php $title = "Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start();


    while ($db = $request->fetch()){
        echo '<h1>' . htmlspecialchars($db['titlePost']) . '</h1>';
        echo '<div class=postTarget><img class="imgPost col-12 col-md-8" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" />'
        . '<p class="postContent col-12">' . htmlspecialchars($db['contentPost']) . '</p>' 
        . '<p class="postContent col-12">' . htmlspecialchars($db['datePost']) . '</p>' . '</div>';
        
    }

?>

<h2 class="commentary">Les commentaires :</h2>








<?php

    //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

    $content = ob_get_clean();
    require('template.php'); 
    
?>