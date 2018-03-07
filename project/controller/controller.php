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
        $accountManager = new AccountManager();
        $request = $accountManager->postInscriptionDb();
        require('project/view/frontend/inscriptionReadyView.php');
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
            $_SESSION['pass'] = $result['pass'];
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
        require('project/view/frontend/accountManagementView.php');
    }
