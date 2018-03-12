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
        echo '<a type="button" href="#commentPost" class="commentBtn btn btn-info btn-lg btn-block">Laissez un commentaire</a>';
    }


    while ($dbCom = $requestCom->fetch()){
        echo '<div class="commentPost"><h3 class="col-12"><img class="avatar col-2 " src="project/public/images/'.htmlspecialchars($dbCom['avatar']).'" />' 
        . '<span class="col-7">' . htmlspecialchars($dbCom['pseudo']) . '</span>' 
        . '<span class="date col-3">' . htmlspecialchars($dbCom['dateComment']) . '</span></h3>' 
        . '<p class="commentContent">'. htmlspecialchars($dbCom['contentComment']) . '</p>' 
        . '<a class="alert" href="index.php?action=alert&idComment='.htmlspecialchars($dbCom['idComments']).'">&Delta;Signaler</a>'
        . '</div>';
    }

?>
<!-- Comment Form +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h2 id="commentPost" class="commentary" >Laissez un commentaire!</h2>
<form class="commentPost" >
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php 
    //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

    $content = ob_get_clean();
    require('template.php');    
?>