<!DOCTYPE html>
<?php $title = "Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start();

    //Post Content
    while ($db = $request->fetch()){
        echo '<h1>' . htmlspecialchars($db['titlePost']) . '</h1>';
        echo '<div class="postTarget"><img class="imgPost col-12 col-md-8" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" />'
        . '<p class="postContent col-12">' . htmlspecialchars($db['contentPost']) . '</p>' 
        . '<p class="postContent col-12">' . htmlspecialchars($db['datePost']) . '</p>' . '</div>';
        
    }
    

?>

<!-- Commentary -->
<h2 class="commentary">Les commentaires :</h2>

<?php 
    if(isset($_SESSION['pseudo'])){    
        echo '<a type="button" href="#commentPostBtn" class="commentBtn btn btn-info btn-lg btn-block">Laissez un commentaire</a>';
    }
    else{
        echo '<a type="button" href="index.php?action=connection" class="commentBtn btn btn-info btn-lg btn-block">Connectez vous pour laisser un commentaire</a>';
    }


    while ($dbCom = $requestCom->fetch()){
        echo '<div class="commentPost"><h3 class="col-12"><img class="avatar col-2 " src="project/public/images/'.htmlspecialchars($dbCom['avatar']).'" />' 
        . '<span class="col-7">' . htmlspecialchars($dbCom['pseudo']) . '</span>' 
        . '<span class="date col-3">' . htmlspecialchars($dbCom['dateComment']) . '</span></h3>'
        . '<a class="alert" href="index.php?action=alert&idComment='.htmlspecialchars($dbCom['idComments']).'">&Delta;Signaler</a>' 
        . '<p class="commentContent">'. htmlspecialchars($dbCom['contentComment']) . '</p>' 
        . '</div>';
    }


// Comment Form ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
if(isset($_SESSION['pseudo'])){
    echo    
        '<h2 id="commentPostBtn" class="commentary" >Laissez un commentaire!</h2>
        <form class="commentPost" action="index.php?action=comment&idChapter='.$_GET['idChapter'].'&db=ok" id="commentForm" method="post">
            <div class="form-group">
                <label for="commentContent">Votre Commentaire:</label>
                <textarea class="form-control" name="commentContent" id="commentContent" rows="3"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="checkUserCondition" id="checkUserCondition" value="ok">
                <label class="form-check-label" for="checkUserCondition">J\'ai pris connaissance de la <a href="index.php?action=userCondition">charte d\'utilisation</a> de l\'espace commentaire</label>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>';
}


    //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

    $content = ob_get_clean();
    require('template.php');    
?>