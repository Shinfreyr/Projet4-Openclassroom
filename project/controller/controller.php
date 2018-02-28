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

    // Chapter View
    function chapter(){
        require('project/view/frontend/chapterView.php');
    }
