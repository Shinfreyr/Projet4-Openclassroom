<!DOCTYPE html>
<?php $title = "Ecrire un nouvel Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start(); 

//Post Content modification
    while ($db = $request->fetch()){
        echo '<h1>' . htmlspecialchars($db['titlePost']) . '</h1>'
        .'<form action="index.php?action=modificationTargetChapter&idChapter='.htmlspecialchars($db['idPost']).'&db=ok" id="writeChapter" method="post">
            <div class="form-group">    
                <textarea id="textarea" class="tinyText" name="chapterContent" >' . $db['contentPost'] . '</textarea>        
            </div>
            <button type="submit" class="btn btn-primary">Modifier l\'épisode</button>
        </form>';
    }


    $content = ob_get_clean();
    require('template.php');
?>