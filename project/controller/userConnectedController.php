<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once('project/model/PostManager.php');
    require_once('project/model/CommentManager.php');
    require_once('project/model/AccountManager.php');
    // Function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    // Data Base Post Comment +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function postComment() {
        $commentContent = htmlspecialchars($_POST['commentContent']);
        $id = htmlspecialchars($_SESSION['id']);
        $idChapter = htmlspecialchars($_GET['idChapter']);
            
        $commentManager = new CommentManager();
        $request = $commentManager->CommentPostDb($commentContent,$id,$idChapter);
        
        header('Refresh:0; index.php?action=post&idChapter='.$_GET['idChapter']);
    }

    // User Condition View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function userCondition() {
        require('project/view/frontend/userConditionView.php');
    }

    // Connection Account Data Base ++++++++++++++++++++++++++++++++++++++++++++++++++++
    function connectionDb() {
        $password = $_POST['passwordConnect'];
        $email = htmlspecialchars($_POST['emailConnect']);
        
        $accountManager = new AccountManager();
        $request = $accountManager->postConnectionDb($email);
        
        $result = $request->fetch();
        // Contol statue
        if($result['accountStatue'] === "Supp") {
            throw new Exception('Compte Banni');
        }
        else {
            // Password Verify
            $resultVerify = password_verify($password,$result['pass']);
            // Control and Session creation
            if($resultVerify) {
                $_SESSION['id'] = $result['idAccount'];
                $_SESSION['pseudo'] = $result['pseudo'];
                $_SESSION['avatar'] = $result['avatar'];
                $_SESSION['email'] = $result['eMail'];
                $_SESSION['statue'] = $result['accountStatue'];
            }
            // Error
            else{
                throw new Exception('Le mot de passe ne correspond pas');
            }
            header("Refresh:0; index.php");
        }        
    }

    //Unconection Session +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function unconnection() {
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Account Management View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function accountManagement() {
        $email = htmlspecialchars($_SESSION['email']);
        
        $accountManager = new AccountManager();
        $request = $accountManager->requestAccountManagement($email);
        
        require('project/view/frontend/accountManagementView.php');
    }

    //Account Modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    
    //Avatar Upload +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function avatarUpload() { 
 
        /************************************************************
         * Setup
         *************************************************************/
        
        define('TARGET', 'project/public/images/');    // Target Folder
        define('MAX_SIZE', 1000000);    // Max Weight Files (octet)
        define('WIDTH_MAX', 800);    // Max Width Image (pix)
        define('HEIGHT_MAX', 800);    // Max Height Image (pix)
        
        // Data Table
        $tabExt = array('jpg','gif','png','jpeg');    // Authorized extension
        $infosImg = array();
        
        // Variables
        $extension = '';
        $message = '';
        $nameImage = '';
        $id = htmlspecialchars($_SESSION['id']);

        /************************************************************
         * New Folder if doesn't exist
         *************************************************************/
        if( !is_dir(TARGET) ) {
            if( !mkdir(TARGET, 0755) ) {
                throw new Exception('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
            }
        }
        
        /************************************************************
         * Upload Script
         *************************************************************/
        // Verify Field
        if(!empty($_POST)){
            if( !empty($_FILES['file']['name'])){                
                $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);        
                
                if(in_array(strtolower($extension),$tabExt)){
                    $infosImg = getimagesize($_FILES['file']['tmp_name']);        
                    
                    if($infosImg[2] >= 1 && $infosImg[2] <= 14){
                        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE)){
                            if(isset($_FILES['file']['error']) && UPLOAD_ERR_OK === $_FILES['file']['error']){
                                $nameImage = md5(uniqid()) .'.'. $extension;        
                                
                                if(move_uploaded_file($_FILES['file']['tmp_name'], TARGET.$nameImage)){
                                    $message = 'Upload réussi !';
                                }
                                else{
                                    throw new Exception('Problème lors de l\'upload !');
                                }
                            }
                            else{
                                throw new Exception('Une erreur interne a empêché l\'uplaod de l\'image');
                            }
                        }
                        else{
                            throw new Exception('Erreur dans les dimensions de l\'image !');
                        }
                    }
                    else{
                        throw new Exception('Le fichier à uploader n\'est pas une image !');
                    }
                }
                else{
                    throw new Exception('L\'extension du fichier est incorrecte !');
                }
            }
            else{
                throw new Exception('Veuillez remplir le formulaire svp !');
            }
        }
        
        $accountManager = new AccountManager();
        $request = $accountManager->postAvatar($nameImage,$id);
        
        header("Refresh:0; index.php");
    }

    //Account Modification view +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function accountModification() {
        $email = htmlspecialchars($_SESSION['email']);
        
        $accountManager = new AccountManager();
        $request = $accountManager->requestAccountManagement($email);
        
        require('project/view/frontend/accountModificationView.php');
    }

    //Data Base Account all Modiffication +++++++++++++++++++++++++++++++++++++++++++++++
    function modificationAccountDb() {
        $email = htmlspecialchars($_POST['email']);
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);

        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }        
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);
        
        session_destroy();
        header("Refresh:0; index.php");        
    }

    //Data Base Account Fistname, Lastname & Email Modification ++++++++++++++++++++++++++
    function modificationNameEmailDb() {
        $email = htmlspecialchars($_POST['email']);
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $id = htmlspecialchars($_SESSION['id']);
        
        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);
        
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname, Lastname & Password Modification +++++++++++++++++++++++
    function modificationNamePassDb() {
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);
        

        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);
        
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname, Email & Password Modification +++++++++++++++++++++++++++
    function modificationFirstnameEmailPassDb() {
        $email = htmlspecialchars($_POST['email']);
        $firstname = htmlspecialchars($_POST['firstName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);

        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);
        
        session_destroy();
        header("Refresh:0; index.php");
    } 

    //Data Base Account Lastname, Email & Password Modification +++++++++++++++++++++++++++++
    function modificationLastnameEmailPassDb() {
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);

        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname & Lastname Modification ++++++++++++++++++++++++++++++++++++
    function modificationNameDb() {
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $id = htmlspecialchars($_SESSION['id']);

        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname & Email Modification +++++++++++++++++++++++++++++++++++++++
    function modificationFirstmailEmailDb() {        
        $email = htmlspecialchars($_POST['email']);
        $firstname = htmlspecialchars($_POST['firstName']);
        $id = htmlspecialchars($_SESSION['id']);

        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname & Password Modification ++++++++++++++++++++++++++++++++++++++
    function modificationFirstnamePassDb() {
        $firstname = htmlspecialchars($_POST['firstName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);
        
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Accout Lastname & Email Modification +++++++++++++++++++++++++++++++++++++++++++
    function modificationLastnameEmailDb() {
        $email = htmlspecialchars($_POST['email']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $id = htmlspecialchars($_SESSION['id']);
        
        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Lastname & Password Modification +++++++++++++++++++++++++++++++++++++++
    function modificationLastnamePassDb() {
        $lastname = htmlspecialchars($_POST['lastName']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);

        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Email & Password Modification ++++++++++++++++++++++++++++++++++++++++++
    function modificationEmailPassDb() {        
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);
        //Email
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Firstname Modification ++++++++++++++++++++++++++++++++++++++++++++++++++
    function modificationFirstnameDb() {
        $firstname = htmlspecialchars($_POST['firstName']);
        $id = htmlspecialchars($_SESSION['id']);

        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname($firstname,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Lastname Modification +++++++++++++++++++++++++++++++++++++++++++++++++++
    function modificationLastnameDb() {
        $lastname = htmlspecialchars($_POST['lastName']);
        $id = htmlspecialchars($_SESSION['id']);

        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname($lastname,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Email Modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function modificationEmailDb() {
        //Email
        $email = htmlspecialchars($_POST['email']);
        
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl($email);
        
        $result = $request->fetch();
        //If email already exist do exception
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail($email,$id);
        }

        session_destroy();
        header("Refresh:0; index.php");
    }

    //Data Base Account Password Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++
    function modificationPassDb() {
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $id = htmlspecialchars($_SESSION['id']);

        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass($password,$id);

        session_destroy();
        header("Refresh:0; index.php");
    }