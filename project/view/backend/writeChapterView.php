<!DOCTYPE html>
<?php $title = "Ecrire un nouvel Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Ecrire un nouvel Episode</h1>


<form action="index.php?action=writeChapter&db=ok" id="writeChapter" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="chapterTitle" id="chapterTitle" placeholder="Titre de l'épisode">
    </div>
    <div class="form-group">    
        <textarea id="textarea" name="chapterContent" >Episode à écrire :</textarea>        
    </div>
    <button type="submit" class="btn btn-primary">Sauvegarder en brouillon</button>
</form>

<?php
    $content = ob_get_clean();
    require('template.php');
?>