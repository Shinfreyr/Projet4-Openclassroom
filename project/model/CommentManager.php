<?php    
    require_once("project/model/Manager.php");

    class CommentManager extends Manager{
        //TargetChapter Comments 
        function getComments(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $requestCom = $db->prepare('SELECT comments.idComments, comments.contentComment, comments.dateComment, account.pseudo, account.avatar FROM comments INNER JOIN account ON comments.idAccount=account.idAccount WHERE idPost=? AND statueComment!=?');
            $requestCom -> execute(array($_GET['idChapter'],"Supp"));
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

        //Comment Post
        function CommentPostDb() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Insert 
            $request = $db->prepare('INSERT INTO comments (contentComment, dateComment, statueComment, idAccount, idPost) VALUES (?, NOW(), ?, ?, ?)');
            $request -> execute(array($_POST['commentContent'], "Post", $_SESSION['id'], $_GET['idChapter']));
            return $request;
        }

        //Count Comment
        function countComment() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $requestCom = $db->query('SELECT COUNT(*) FROM comments');
            return $requestCom;
        }

        //Count Alert
        function countCommentAlert() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $requestAlert = $db->query('SELECT COUNT(*) FROM comments WHERE alertComment>0');
            return $requestAlert;
        }

        //Alert Comment Management
        function alertManagement(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $request = $db->query('SELECT comments.idComments, comments.contentComment, comments.alertComment, comments.dateComment, comments.idAccount, account.pseudo, account.avatar FROM comments INNER JOIN account ON comments.idAccount=account.idAccount WHERE alertComment>0 ORDER BY alertComment DESC');
            return $request;
        }

        // Supression Linked Comments of Supress Chapter
        function supressionLinkedCommentPost() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idPost=?');
            $request -> execute(array($_GET['idChapter']));
            return $request;
        }

        //Supress Linked Comments of Supress Account
        function supressAccountLinkedCommentPost() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idAccount=?');
            $request -> execute(array($_GET['idAccount']));
            return $request;
        }

        //Supress Alert Comment
        function supressAlertComment() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idComments=?');
            $request -> execute(array($_GET['idComments']));
            return $request;
        }

        //Warning Comment Increment
        function resetCountAlertComment() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $requestCom = $db->prepare('UPDATE comments SET alertComment=?  WHERE idComments = ?');
            $requestCom -> execute(array("0",$_GET['idComments']));
            return $requestCom;
        }
    }