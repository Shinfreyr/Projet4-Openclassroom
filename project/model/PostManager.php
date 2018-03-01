<?php    
    require_once("project/model/Manager.php");

    class PostManager extends Manager{
        // Last Chapter function
        function getRecentPost(){
            // Data Base Connection
            $db=$this->dbConnect();

            // Last Chapters recuperation (5)
            $request = $db->query('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts ORDER BY idPost DESC LIMIT 0, 5');
    
            return $request;
        }
    }