<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/model/PostManager.php');
    require('project/model/CommentManager.php');
    require('project/model/AccountManager.php');
    // Function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // Index View
    function index(){
        $postManager= new PostManager();
        $request= $postManager->getRecentPost();

        require('project/view/frontend/indexView.php');
    }

    // All Chapter View
    function chapter(){
        $postManager= new PostManager();
        $request= $postManager->getPosts();

        require('project/view/frontend/chapterView.php');
    }

    // Chapter Target View
    function post(){
        $postManager = new PostManager();
        $request = $postManager->getPost();

        $commentManager = new CommentManager();
        $requestCom = $commentManager->getComments();

        require('project/view/frontend/postTargetView.php');
    }

    // Inscription View
    function inscription(){
        require('project/view/frontend/inscriptionView.php');
    }

    // Inscription Account in Data Base
    function inscriptionDb(){
        //control pseudo & email Data Base
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->controlInscription();
        $result = $request->fetch();
        if($result['pseudo'] == $pseudo || $result['eMail'] == $email){
            throw new Exception('Pseudo ou Email déja existant');
        }        
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->postInscriptionDb();
            require('project/view/frontend/inscriptionReadyView.php');
        }
    }

    // Connection View
    function connection(){
        require('project/view/frontend/connectionView.php');
    }

    // Connection Account Data Base
    function connectionDb(){
        $password = $_POST['passwordConnect'];
        $email = $_POST['emailConnect'];
        $accountManager = new AccountManager();
        $request = $accountManager->postConnectionDb();
        $result = $request->fetch();
        // Password Verify
        $resultVerify = password_verify($password,$result['pass']);
        // Control and Session creation
        if($resultVerify) {
            $_SESSION['id'] = $result['idAccount'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['avatar'] = $result['avatar'];
            $_SESSION['email'] = $result['eMail'];
        }
        // Error
        else{
            throw new Exception('Le mot de passe ne correspond pas');
        }
        require('project/view/frontend/indexView.php');        
    }

    //Unconection Session
    function unconnection(){
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Account Management View
    function accountManagement(){
        $accountManager = new AccountManager();
        $request = $accountManager->postAccountManagement();
        require('project/view/frontend/accountManagementView.php');
    }

    //Comment Warning increment
    function alertComment(){
        $commentManager = new CommentManager();
        $request = $commentManager->warningComment();
        require('project/view/frontend/indexView.php');
    }

    function avatarUpload(){ 
 
        /************************************************************
         * Setup
         *************************************************************/
        
        define('TARGET', 'project/public/images/');    // Target Folder
        define('MAX_SIZE', 1000000);    // Max Weight Files (octet)
        define('WIDTH_MAX', 800);    // Max Width Image (pix)
        define('HEIGHT_MAX', 800);    // Max Height Image (pix)
        
        // Data Table
        $tabExt = array('jpg','gif','png','jpeg');    // Authorized extension
        $infosImg = array();
        
        // Variables
        $extension = '';
        $message = '';
        $nameImage = '';
        
        /************************************************************
         * Creation du repertoire cible si inexistant
         *************************************************************/
        if( !is_dir(TARGET) ) {
            if( !mkdir(TARGET, 0755) ) {
                throw new Exception('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
            }
        }
        
        /************************************************************
         * Script d'upload
         *************************************************************/
        if(!empty($_POST)){
            // On verifie si le champ est rempli
            if( !empty($_FILES['file']['name'])){
                // Recuperation de l'extension du fichier
                $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);        
                // On verifie l'extension du fichier
                if(in_array(strtolower($extension),$tabExt)){
                    // On recupere les dimensions du fichier
                    $infosImg = getimagesize($_FILES['file']['tmp_name']);        
                    // On verifie le type de l'image
                    if($infosImg[2] >= 1 && $infosImg[2] <= 14){
                        // On verifie les dimensions et taille de l'image
                        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE)){
                            // Parcours du tableau d'erreurs
                            if(isset($_FILES['file']['error']) && UPLOAD_ERR_OK === $_FILES['file']['error']){
                                // On renomme le fichier
                                $nameImage = md5(uniqid()) .'.'. $extension;        
                                // Si c'est OK, on teste l'upload
                                if(move_uploaded_file($_FILES['file']['tmp_name'], TARGET.$nameImage)){
                                    $message = 'Upload réussi !';
                                }
                                else{
                                    // Sinon on affiche une erreur systeme
                                    throw new Exception('Problème lors de l\'upload !');
                                }
                            }
                            else{
                                throw new Exception('Une erreur interne a empêché l\'uplaod de l\'image');
                            }
                        }
                        else{
                            // Sinon erreur sur les dimensions et taille de l'image
                            throw new Exception('Erreur dans les dimensions de l\'image !');
                        }
                    }
                    else{
                        // Sinon erreur sur le type de l'image
                        throw new Exception('Le fichier à uploader n\'est pas une image !');
                    }
                }
                else{
                    // Sinon on affiche une erreur pour l'extension
                    throw new Exception('L\'extension du fichier est incorrecte !');
                }
            }
            else{
                // Sinon on affiche une erreur pour le champ vide
                throw new Exception('Veuillez remplir le formulaire svp !');
            }
        }
        
        $accountManager = new AccountManager();
        $request = $accountManager->postAvatar($nameImage);
        header("Refresh:0; index.php");
    }
