<?php    
    require_once("project/model/Manager.php");

    class CommentManager extends Manager{
        //TargetChapter Comments 
        function getComments(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $requestCom = $db->prepare('SELECT comments.idComments, comments.contentComment, comments.dateComment, account.pseudo, account.avatar FROM comments INNER JOIN account ON comments.idAccount=account.idAccount WHERE idPost=?');
            $requestCom -> execute(array($_GET['idChapter']));
            return $requestCom;
        }

        //Warning Comment Increment
        function warningComment(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $requestCom = $db->prepare('UPDATE comments SET alertComment= alertComment + 1 WHERE idComments = ?');
            $requestCom -> execute(array($_GET['idComment']));
            return $requestCom;
        }
    }