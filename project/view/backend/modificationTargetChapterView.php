<!DOCTYPE html>
<?php $title = "Ecrire un nouvel Episode, Billet simple pour l'Alaska"; ?>
<?php ob_start(); 


while ($db = $request->fetch()){
    //Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    echo '<h1  class="h1BackView" >' . htmlspecialchars($db['titlePost']) . '</h1>'
    
    //Post Content modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Avatar Modification
    .'<div class="imageChapter">'    
        .'<img src="project/public/images/' .htmlspecialchars($db['imagePost']).'" />
            <form enctype="multipart/form-data" action="index.php?action=uploadImagePost&idChapter='.htmlspecialchars($db['idPost']).'" method="post" class="col-12">
                <fieldset>
                    <legend><h2>Image Episode: <span class="infoImagePost"> (1920x1080 pixel & 1Mo maximum) </span></h2></legend>
                    <p>
                        <label for="uploadFile" title="Recherchez le fichier à uploader !">Envoyer le fichier :</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                        <input name="file" type="file" id="uploadFile" />
                        <input type="submit" class="btn btn-info" name="submit" value="Uploader" />
                    </p>
                </fieldset>
            </form>'
        .'</div>'
    //TinyMce Area
    .'<form action="index.php?action=modificationTargetChapter&idChapter='.htmlspecialchars($db['idPost']).'&db=ok" id="writeChapter" method="post">
        <div class="form-group">    
            <textarea id="textarea" class="tinyText" name="chapterContent" >' . $db['contentPost'] . '</textarea>        
        </div>
        <button type="submit" class="btn btn-info">Modifier l\'épisode</button>
    </form>';
}

    $content = ob_get_clean();
    require('template.php');
?>