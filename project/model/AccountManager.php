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

        //Data Base Connection Account
        function postConnectionDb(){
            //Password and Email
            $password = $_POST['passwordConnect'];
            $email = $_POST['emailConnect'];
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('SELECT idAccount, pseudo, pass FROM account WHERE eMail= ? ');
            $request -> execute(array($email));
            return $request;
            /*
            $result = $request->fetch();
            // Password Verify
            $resultVerify = password_verify($password,$result['pass']);
            // Control and Session creation
            if($resultVerify) {
                $_SESSION['id'] = $result['idAccount'];
                $_SESSION['pseudo'] = $result['pseudo'];
            }
            // Error
            else{
                throw new Exception('Le mot de passe ne correspond pas');
            }
            
            
            */
            
        }


    }