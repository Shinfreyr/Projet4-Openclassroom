<?php    
    require_once("project/model/Manager.php");

    class AccountManager extends Manager{
        //Data Base Account
        function postInscriptionDb(){
            //Password Hash
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            // Data Base Connection
            $db=$this->dbConnect();
            // Chapters  Target recuperation 
            $request = $db->prepare('INSERT INTO account (pseudo, firstName, lastName, eMail, avatar, pass, accountStatue) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $request -> execute(array($_POST['pseudo'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], "defautUser.jpg", $password, "User"));
            return $request;
                
              
            
        }
    }