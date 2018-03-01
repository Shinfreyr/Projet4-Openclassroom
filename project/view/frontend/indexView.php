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
            Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo.
            Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
        </h3>
    </div>

    <!-- Div Last Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="lastChapter container-fluid raw">    
        <h2 class="col-12">Derniers Episodes :</h2>

        <?php
            
            // Last chapters view ++++++++++++++++++++++++++++++
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