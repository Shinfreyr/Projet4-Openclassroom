<?php    
    // Require Manager ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once("project/model/Manager.php");
    // Class ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    class AccountManager extends Manager {
        
        //Data Base Inscription Account ++++++++++++++++++++++++++++++++++++++++++
        function postInscriptionDb($pseudo,$firstname,$lastname,$email,$password) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Insert 
            $request = $db->prepare('INSERT INTO account (pseudo, firstName, lastName, eMail, avatar, pass, accountStatue) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $request -> execute(array($pseudo, $firstname, $lastname, $email, "defautUser.jpg", $password, "User"));
            
            return $request;           
        }

        //Data Base Account Control ++++++++++++++++++++++++++++++++++++++++++++++
        function controlInscription($pseudo,$email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Chapters recuperation 
            $request = $db->prepare('SELECT pseudo, eMail FROM account WHERE pseudo=? OR eMail=?');
            $request -> execute(array($pseudo, $email));
            
            return $request;

        }

        //Data Base Connection Account +++++++++++++++++++++++++++++++++++++++++++
        function postConnectionDb($email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('SELECT * FROM account WHERE eMail= ? ');
            $request -> execute(array($email));
            
            return $request;           
        }

        //Data Base Account Management ++++++++++++++++++++++++++++++++++++++++++
        function requestAccountManagement($email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('SELECT pseudo, firstName, lastName, eMail, avatar FROM account WHERE eMail= ? ');
            $request -> execute(array($email));
            
            return $request;
        }

        //Data Base Avatar Account Management +++++++++++++++++++++++++++++++++++
        function postAvatar($nameImage,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Recuperation 
            $request = $db->prepare('UPDATE account SET avatar = ? WHERE idAccount = ?');
            $request -> execute(array($nameImage, $id));
            
            return $request;
        }

        //Data Base Control Email Update +++++++++++++++++++++++++++++++++++++++
        function updateControl($email) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Email Recuperation
            $request = $db->prepare('SELECT eMail FROM account WHERE eMail=?');
            $request -> execute(array($email));
            
            return $request;
        }
        
        //Data Base Firstname Accounr Management +++++++++++++++++++++++++++++++
        function updateFirstname($firstname,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET firstName = ? WHERE idAccount = ?');
            $request -> execute(array($firstname, $id));
            
            return $request;
        }

        //Data Base Lastname Account Management ++++++++++++++++++++++++++++++++++
        function updateLastname($lastname,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET lastName = ? WHERE idAccount = ?');
            $request -> execute(array($lastname, $id));
            
            return $request;
        }

        //Data Base Email Account Management ++++++++++++++++++++++++++++++++++++++
        function updateEmail($email,$id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET eMail = ? WHERE idAccount = ?');
            $request -> execute(array($email, $id));
            
            return $request;
        }

        //Data Base Password Account Management +++++++++++++++++++++++++++++++++++
        function updatePass($password, $id) {
            //Password Hash
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET pass = ? WHERE idAccount = ?');
            $request -> execute(array($password, $id));
            
            return $request;
        }

        //Count Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function countAccount() {
            // Data Base Connection
            $db=$this->dbConnect();
            // Count Account Recuperation 
            $request = $db->query('SELECT COUNT(*) FROM account');
            
            return $request;
        }

        //Ban Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function banAccountBd($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET accountStatue = ? WHERE idAccount = ?');
            $request -> execute(array("Supp", $id));
            
            return $request;
        }

        //Data Base Control Account Statue ++++++++++++++++++++++++++++++++++++++++++++
        function accountStatueControl($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account and Statue recuperation 
            $request = $db->prepare('SELECT idAccount, accountStatue FROM account WHERE idAccount = ?');
            $request -> execute(array($id));
            
            return $request;
        }

        //All Account View ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        function allAccountView() {
            // Data Base Connection
            $db=$this->dbConnect();
            // All Account recuperation 
            $request = $db->prepare('SELECT idAccount, pseudo, firstName, lastName, eMail, avatar, accountStatue FROM account WHERE pseudo!=? ORDER BY pseudo');
            $request -> execute(array("JeanF."));
           
            return $request;
        }

        //Ban account up to User Statue +++++++++++++++++++++++++++++++++++++++++++++++
        function updateUserStatue($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET accountStatue = ? WHERE idAccount = ?');
            $request -> execute(array("User", $id));
            
            return $request;
        }

        //User account up to Admin Statue ++++++++++++++++++++++++++++++++++++++++++++++
        function updateAdminStatue($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET accountStatue = ? WHERE idAccount = ?');
            $request -> execute(array("Admin", $id));
            
            return $request;
        }

        //Admin account down to User Statue +++++++++++++++++++++++++++++++++++++++++++++
        function downgradeUserStatue($id) {
            // Data Base Connection
            $db=$this->dbConnect();
            // Account Update 
            $request = $db->prepare('UPDATE account SET accountStatue = ? WHERE idAccount = ?');
            $request -> execute(array("User", $id));
            
            return $request;
        }
    }