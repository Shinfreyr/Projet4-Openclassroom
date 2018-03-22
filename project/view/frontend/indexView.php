<!DOCTYPE html>
<?php $title = "Jean Forteroche, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>


    <!-- Title Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <h1>Billet simple pour l'Alaska</h1>

    <!-- Div Billet simple pourl'Alaska Info ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="infoAlaska container-fluid raw">
        <h2 class="col-12">Le voyage d'une vie :</h2>
        <img class="infoImg col-12 col-md-5" src="project/public/images/billetSimple.jpg" />
        <h3 class="info col-12">
        "Alors, vous rêvez? Vous attendez quoi ici? La neige?"
        <br />        
        Surpris en effet dans un rêve, il sursaute et s'en va, avec un étrange malaise dans la poitrine.
        <br /> 
        Elle, fixe éperdument l'horizon.
        <br /> 
        Elle tire de sa poche un vieux papier jauni, déchiré, froissé, racorni par les âges et le sert contre sa poitrine. 
        Un vieux, très vieux papier qui vient du fond des temps.
        <br /> 
        Du fond de son enfance lorsque son père la prenait sur ses genoux et lui parlait d'un monde merveilleux..
        <br />
        <br />
        Avec "Billet simple pour l'Alaska", l'auteur Jean Forteroche, vous invite à vivre la création d'un roman épisode par épisode.
        <br />
        Venez vivre en direct cette aventure et communiquez vos impressions au fur et à mesure de vos lectures!"
        </h3>
    </div>

    <!-- Div Last Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="lastChapter container-fluid raw">    
        <h2 class="col-12">Derniers Episodes :</h2>

        <?php
            
            // Last chapters view ++++++++++++++++++++++++++++++
            while ($db = $request->fetch()){
                echo '<div class="imageGoogle col-12 col-md-2" ><img class="col-12" alt="Responsive image" src="project/public/images/'.htmlspecialchars($db['imagePost']).'" /></div>' 
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