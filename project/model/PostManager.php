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

        // All Chapter function
        function getPosts(){
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE postStatue!=? OR postStatue!=? ORDER BY idPost');
            $request -> execute(array("Supp","Brou"));
            return $request;
        }

        // Chapter Target function
        function getPost(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters  Target recuperation 
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE idPost=?');
            $request -> execute(array($_GET['idChapter']));
            return $request;
        }

        // Chapter insert
        function chapterInsert() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters  Target recuperation 
            $request = $db->prepare('INSERT INTO posts (titlePost, contentPost, imagePost, datePost, postStatue, idAccount) VALUE (?,?,?,NOW(),?,?)');
            $request -> execute(array($_POST['chapterTitle'],$_POST['chapterContent'],"defautPost.jpg","Rough",$_SESSION['id']));
            return $request;
        }
    }