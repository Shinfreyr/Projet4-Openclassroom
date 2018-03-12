<?php    
    require_once("project/model/Manager.php");

    class AccountManager extends Manager{
        //Data Base Inscription Account
        function postInscriptionDb(){
            //Password Hash
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Insert 
            $request = $db->prepare('INSERT INTO account (pseudo, firstName, lastName, eMail, avatar, pass, accountStatue) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $request -> execute(array($_POST['pseudo'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], "defautUser.jpg", $password, "User"));
            return $request;           
        }

        //Data Base Account Control
        function controlInscription(){
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT pseudo, eMail FROM account WHERE pseudo=? OR eMail=?');
            $request -> execute(array($_POST['pseudo'], $_POST['email']));
            return $request;

        }

        //Data Base Connection Account
        function postConnectionDb(){
            //Email
            $email = $_POST['emailConnect'];
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('SELECT * FROM account WHERE eMail= ? ');
            $request -> execute(array($email));
            return $request;           
        }

        //Data Base Account Management
        function requestAccountManagement(){
            //Email
            $email = $_SESSION['email'];
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('SELECT pseudo, firstName, lastName, eMail, avatar FROM account WHERE eMail= ? ');
            $request -> execute(array($email));
            return $request;
        }

        //Data Base Avatar Account Management
        function postAvatar($nameImage){
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('UPDATE account SET avatar = ? WHERE idAccount = ?');
            $request -> execute(array($nameImage, $_SESSION['id']));
            return $request;
        }


    }