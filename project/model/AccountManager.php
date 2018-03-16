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

        //Data Base Control Email Update
        function updateControl() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT eMail FROM account WHERE eMail=?');
            $request -> execute(array($_POST['email']));
            return $request;
        }
        
        //Data Base Firstname Accounr Management
        function updateFirstname() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET firstName = ? WHERE idAccount = ?');
            $request -> execute(array($_POST['firstName'], $_SESSION['id']));
            return $request;
        }

        //Data Base Lastname Account Management
        function updateLastname() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET lastName = ? WHERE idAccount = ?');
            $request -> execute(array($_POST['lastName'], $_SESSION['id']));
            return $request;
        }

        //Data Base Email Account Management
        function updateEmail() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET eMail = ? WHERE idAccount = ?');
            $request -> execute(array($_POST['email'], $_SESSION['id']));
            return $request;
        }

        //Data Base Password Account Management
        function updatePass() {
            //Password Hash
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET pass = ? WHERE idAccount = ?');
            $request -> execute(array($password, $_SESSION['id']));
            return $request;
        }

        //Count Account
        function countAccount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->query('SELECT COUNT(*) FROM account');
            return $request;
        }

        //Ban Account
        function BanAccount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET accountStatue = ? WHERE idAccount = ?');
            $request -> execute(array("Supp", $_GET['idAccount']));
            return $request;
        }

        //Data Base Control Email Update
        function accountStatueControl() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT idAccount, accountStatue FROM account WHERE idAccount = ?');
            $request -> execute(array($_GET['idAccount']));
            return $request;
        }

    }