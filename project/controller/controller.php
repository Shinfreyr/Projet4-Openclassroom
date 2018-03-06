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
