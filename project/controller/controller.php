<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/model/PostManager.php');
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
        $postManager= new PostManager();
        $request= $postManager->getPost();

        require('project/view/frontend/postTargetView.php');
    }
