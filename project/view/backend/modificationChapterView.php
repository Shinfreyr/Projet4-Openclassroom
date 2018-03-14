<!DOCTYPE html>
<?php $title = "Modifier les Episodes, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<h1>Modifier les Episodes</h1>

<!-- Div All Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="allChapters container-fluid raw">    
        <h2 class="col-12">Tous les Episodes :</h2>

        <?php
            
            // All chapters view ++++++++++++++++++++++++++++++
            while ($db = $request->fetch()){ 
                echo '<img class="col-12 col-md-2" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" />'; ?>
                <h3 class="col-12 col-md-6 align-self-center"><?= htmlspecialchars($db['titlePost']) ?> : <?= htmlspecialchars($db['datePost']) ?> </h3>
                <?php if($db['postStatue'] === "Post") { 
                    echo '<span class="align-self-center">Publié</span>';
                }
                else {
                    echo '<span class="align-self-center">Brouillon</span>';
                } ?>    
                

                <div class="col-12 modificationChapter" >
                    <a class="chapterLink col-12 col-md-4 align-self-center" href="index.php?action=modificationChapter&idChapter=<?= htmlspecialchars($db['idPost']) ?>">Modifier l\'Episode</a>
                    <?php 
                        if($db['postStatue'] === "Rough") { ?>
                            <a class="chapterLink col-12 col-md-4 align-self-center publish" href="index.php?action=publicationChapter&idChapter=<?= htmlspecialchars($db['idPost']) ?>">Publier l\'Episode</a> <?php
                        } ?>
                            <a class="chapterLink col-12 col-md-4 align-self-center supp" href="index.php?action=supressionChapter&idChapter=<?= htmlspecialchars($db['idPost']) ?>">Supprimer l\'Episode</a>
                </div> <?php
            } ?>
        
</div>

<?php
    $content = ob_get_clean();
    require('template.php');
?>