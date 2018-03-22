<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once('project/model/PostManager.php');
    require_once('project/model/CommentManager.php');
    require_once('project/model/AccountManager.php');
    // Function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    // Index View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function index() {
        $postManager= new PostManager();
        $request= $postManager->getRecentPost();

        require('project/view/frontend/indexView.php');
    }

    // All Chapter View +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function chapter() {
        $postManager= new PostManager();
        $request= $postManager->getPosts();

        require('project/view/frontend/chapterView.php');
    }

    // Chapter Target View ++++++++++++++++++++++++++++++++++++++++++++++++++++
    function post() {
        $idChapter = htmlspecialchars($_GET['idChapter']);
        
        $postManager = new PostManager();
        $request = $postManager->getPost();

        $commentManager = new CommentManager();
        $requestCom = $commentManager->getComments($idChapter);

        require('project/view/frontend/postTargetView.php');
    }    

    // Inscription View ++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function inscription() {
        require('project/view/frontend/inscriptionView.php');
    }

    // Inscription Account in Data Base ++++++++++++++++++++++++++++++++++++++
    function inscriptionDb() {
        //control pseudo & email Data Base
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->controlInscription($pseudo,$email);
        
        $result = $request->fetch();
        //If pseudo or email already exist do exception
        if($result['pseudo'] === $pseudo || $result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }        
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->postInscriptionDb($pseudo,$firstname,$lastname,$email,$password);
        
            require('project/view/frontend/inscriptionReadyView.php');
        }
    }

    // Connection View +++++++++++++++++++++++++++++++++++++++++++++++++++++
    function connection() {
        require('project/view/frontend/connectionView.php');
    }

    //Comment Warning increment ++++++++++++++++++++++++++++++++++++++++++++
    function alertComment() {
        $idComment = htmlspecialchars($_GET['idComment']);

        $commentManager = new CommentManager();
        $request = $commentManager->warningComment($idComment);
        
        header("Refresh:0; index.php");
    }