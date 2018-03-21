<?php    
    // Require Manager ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once("project/model/Manager.php");
    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class CommentManager extends Manager {

        //TargetChapter Comments +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function getComments($idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $requestCom = $db->prepare('SELECT comments.idComments, comments.contentComment, comments.dateComment, account.pseudo, account.avatar FROM comments INNER JOIN account ON comments.idAccount=account.idAccount WHERE idPost=? AND statueComment!=?');
            $requestCom -> execute(array($idChapter,"Supp"));
            
            return $requestCom;
        }

        //Warning Comment Increment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function warningComment($idComment) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Comments Update
            $requestCom = $db->prepare('UPDATE comments SET alertComment= alertComment + 1 WHERE idComments = ?');
            $requestCom -> execute(array($idComment));
            
            return $requestCom;
        }

        //Comment Post +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function CommentPostDb($commentContent,$id,$idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Insert 
            $request = $db->prepare('INSERT INTO comments (contentComment, dateComment, statueComment, idAccount, idPost) VALUES (?, NOW(), ?, ?, ?)');
            $request -> execute(array($commentContent, "Post", $id, $idChapter));
            
            return $request;
        }

        //Count Comment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function countComment() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Count Comments Recuperation 
            $requestCom = $db->query('SELECT COUNT(*) FROM comments');
            
            return $requestCom;
        }

        //Count Alert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function countCommentAlert() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Count Alert Comments Recuperation 
            $requestAlert = $db->query('SELECT COUNT(*) FROM comments WHERE alertComment>0');
            
            return $requestAlert;
        }

        //Alert Comment Management +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function alertManagement(){
            // Data Base Connection
            $db=$this->dbConnect();
            // Alert Comment Recuperation
            $request = $db->query('SELECT comments.idComments, comments.contentComment, comments.alertComment, comments.dateComment, comments.idAccount, account.pseudo, account.avatar FROM comments INNER JOIN account ON comments.idAccount=account.idAccount WHERE alertComment>0 ORDER BY alertComment DESC');
            
            return $request;
        }

        // Supression Linked Comments of Supress Chapter +++++++++++++++++++++++++++++++++++++
        function supressionLinkedCommentPost($idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idPost=?');
            $request -> execute(array($idChapter));
            
            return $request;
        }

        //Supress Linked Comments of Supress Account +++++++++++++++++++++++++++++++++++++++++
        function supressAccountLinkedCommentPost($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idAccount=?');
            $request -> execute(array($id));
            
            return $request;
        }

        //Supress Alert Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressAlertComment($idComments) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM comments WHERE idComments=?');
            $request -> execute(array($idComments));
            
            return $request;
        }

        //Warning Comment Increment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function resetCountAlertComment($idComments) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Update Comments
            $requestCom = $db->prepare('UPDATE comments SET alertComment=?  WHERE idComments = ?');
            $requestCom -> execute(array("0",$idComments));
            
            return $requestCom;
        }
    }