<!DOCTYPE html>
<?php $title = "Les Episodes, Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>

<!-- Navigation Menu +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<div class="container-fluid">  
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light row">
        <!-- Autor Name ++++++++++++++++++++++++++++++++++++++++++++++ -->
        <a class="navbar-brand col-6 align-sel-start" href="index.php">Jean Forteroche</a>
        <!-- Burger Menu +++++++++++++++++++++++++++++++++++++++++++++ -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Inside Burger ++++++++++++++++++++++++++++++++++++++++++ -->
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav col align-self-end mr-auto">
                <!-- Home ++++++++++++++++++++++++++++++++++++++++++ -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <!-- Chapters ++++++++++++++++++++++++++++++++++++++ -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=chapter">Voir les Episodes</a>
                </li>
                <!-- Connection/Inscription Menu ++++++++++++++++++++++++++++++++ -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Connexion/Inscription</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Connexion</a>
                        <a class="dropdown-item" href="#">Inscription</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Gestion de Compte</a>
                    </div>
                </li>
                <!-- Welcome Account ++++++++++++++++++++++++++++++++++++++ -->
                <?php
                    if(false){     
                        echo    '<li class="nav-item">
                                    <a class="nav-link" href="index.php?action=chapter">Welcome!</a>
                                </li>';
                    }
                ?>
            </ul>
        </div>
    </nav>
</div>

<!-- Titre +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<h1>Les Episodes</h1>

<?php
    //Content Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 

    $content = ob_get_clean();
    require('template.php'); 
    
?>