<?php    
    // Require Manager ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once("project/model/Manager.php");
    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class PostManager extends Manager{
        
        // Last Chapter function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function getRecentPost() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Last Chapters recuperation (5)
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE postStatue=? ORDER BY idPost DESC LIMIT 0, 5');
            $request -> execute(array("Post"));
            
            return $request;
        }

        // All Chapter function ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function getPosts() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE postStatue=? ORDER BY idPost');
            $request -> execute(array("Post"));
            
            return $request;
        }

        // Chapter Target function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function getPost() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters Target recuperation 
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE idPost=?');
            $request -> execute(array($_GET['idChapter']));
            
            return $request;
        }

        // Chapter insert ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function chapterInsert($chapterTitle,$chapterContent,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters  Insert Chapter 
            $request = $db->prepare('INSERT INTO posts (titlePost, contentPost, imagePost, datePost, postStatue, idAccount) VALUE (?,?,?,NOW(),?,?)');
            $request -> execute(array($chapterTitle,$chapterContent,"defautPost.jpg","Rough",$id));
            
            return $request;
        }

         // Admin All Chapter function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
         function getPostsAdmin() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->query('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts ORDER BY idPost');
            
            return $request;
        }

        // Update Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function chapterModificationPost($chapterContent,$idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters Update Content Post 
            $request = $db->prepare('UPDATE posts SET contentPost=? WHERE idPost=?');
            $request -> execute(array($chapterContent,$idChapter));
            
            return $request;
        }

        // Update Statue Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function publicationModificationPost($idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters Update Post Statue 
            $request = $db->prepare('UPDATE posts SET postStatue=? WHERE idPost=?');
            $request -> execute(array("Post",$idChapter));
            
            return $request;
        }

        // Supress Target Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function supressionChapterPost($idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Supress Comment 
            $request = $db->prepare('DELETE FROM posts Where idPost=?');
            $request -> execute(array($idChapter));
            
            return $request;
        }

        // Upload Image Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function updateImageChapter($nameImage,$idChapter) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Update Posts
            $request = $db->prepare('UPDATE posts SET imagePost=? WHERE idPost=?');
            $request -> execute(array($nameImage,$idChapter));
            
            return $request;
        }

        // Rough Chapter View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function getChapterRough() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters Rough recuperation 
            $request = $db->prepare('SELECT idPost, titlePost, contentPost, imagePost, datePost, postStatue, idAccount FROM posts WHERE postStatue=? ORDER BY idPost');
            $request -> execute(array("Rough"));
            
            return $request;
        }

    }