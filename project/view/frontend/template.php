<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $title ?></title>		
		<meta name="description" content="Jean Forteroche, Billet simple pour l'Alaska" />
		<meta name="keywords" content="Jean, Forteroche, Billet, simple, Alaska, Livre, Book, Blog, eBook" />
		<!-- Meta Facebook +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->        
        <meta property="og:title" content="Jean Forteroche, Billet simple pour l'Alaska" />
        <meta property="og:url" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <meta property="og:site_name" content="WebAgency.fr" />
        <meta property="og:description" content="Un livre proche de ses lecteurs!" />
        <meta property="og:image" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
		<!-- Meta Twitter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->             
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="Jean Forteroche, Billet simple pour l'Alaska" />
        <meta name="twitter:url" content="" /><!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <meta name="twitter:descritpion" content="Un livre proche de ses lecteurs!" />
        <meta name="twitter:image" content="" /> <!-- !!!!!!!!!!!!!!!!!!!!! A remplir lors de la MeL -->
        <!-- Stylesheet Bootstrap v4 ++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Stylesheet Google Font Indie+Flower, Kaushan+Script and Lato +++++++++++ -->
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Kaushan+Script|Lato" rel="stylesheet"> 
        <!-- Stylesheet +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link href="project/public/css/style.css" rel="stylesheet" /> 

    </head>

        
    <!-- Template Content ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <body>

        <!-- Navigation Menu +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <header class="container-fluid sticky-top">  
            <nav class="navbar navbar-expand-lg navbar-light bg-light row">
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
        </header>
    
        <?= $content ?>

        <footer class="container-fluid raw">
            <p>footer</p>
            <p>footer</p>
            <p>footer</p>
        </footer>

        <!-- Script Bootstrap V4 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    </body>

</html>