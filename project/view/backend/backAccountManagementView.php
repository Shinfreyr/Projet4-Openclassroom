<!DOCTYPE html>
<?php $title = "Gestion des Comptes, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1 class="h1BackView" >Gestion des Comptes</h1>
   
<!-- Content +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->    
<?php            
    // All account view ++++++++++++++++++++++++++++++
    while ($db = $request->fetch()) { 
        if($db['accountStatue'] === "User") {
            echo '<div class="allChapters container-fluid raw user">';
        }
        elseif($db['accountStatue'] === "Admin") {
            echo '<div class="allChapters container-fluid raw admin">';
        }
        else {
            echo '<div class="allChapters container-fluid raw ban">';
        }
            echo '<div class="col-12 col-md-2 imageGoogle" ><img class="col-12" src="project/public/images/'.htmlspecialchars($db['avatar']).'" alt="Avatar" /></div>'; ?>
            <h3 class="col-12 col-md-6 align-self-center"><?= htmlspecialchars($db['pseudo']) ?> : <?= htmlspecialchars($db['eMail']) ?> </h3>
            <?php 
                if($db['accountStatue'] === "Admin") { 
                    echo '<span class="align-self-center statue">Admin</span>';
                }
                elseif($db['accountStatue'] === "User") {
                    echo '<span class="align-self-center statue">User</span>';
                }
                else {
                    echo '<span class="align-self-center statue">Banni</span>';
                } 
            ?>
            <div class="col-12 modificationChapter" >
                <?php 
                    if($db['accountStatue'] === "User") { ?>
                        <a class="chapterLink col-12 col-md-4 align-self-center upStatue" href="index.php?action=adminUpStatue&idAccount=<?=htmlspecialchars($db['idAccount'])?>">Promouvoir en tant qu'Administrateur</a> 
                        <a class="chapterLink col-12 col-md-4 align-self-center banStatue" href="index.php?action=banAccountStatue&idAccount=<?=htmlspecialchars($db['idAccount'])?>">Bannir le compte</a><?php
                    }
                    elseif($db['accountStatue'] === "Admin") { ?>
                        <a class="chapterLink col-12 col-md-4 align-self-center downStatue" href="index.php?action=userDownStatue&idAccount=<?=htmlspecialchars($db['idAccount'])?>">Abaisser les droit en tant qu'Utilisateur</a> <?php
                    }
                    else { ?>
                        <a class="chapterLink col-12 col-md-4 align-self-center userStatue" href="index.php?action=userUpStatue&idAccount=<?=htmlspecialchars($db['idAccount'])?>">Réintégrer en tant qu'utilisateur</a> <?php
                    }
                ?>
            </div>
        </div> <?php
        } 
    ?>

<?php
    $content = ob_get_clean();
    require('template.php');
?>