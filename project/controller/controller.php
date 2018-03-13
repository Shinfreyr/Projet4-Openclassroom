<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/model/PostManager.php');
    require('project/model/CommentManager.php');
    require('project/model/AccountManager.php');
    // Function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // Index View
    function index(){
        $postManager= new PostManager();
        $request= $postManager->getRecentPost();

        require('project/view/frontend/indexView.php');
    }

    // All Chapter View
    function chapter(){
        $postManager= new PostManager();
        $request= $postManager->getPosts();

        require('project/view/frontend/chapterView.php');
    }

    // Chapter Target View
    function post(){
        $postManager = new PostManager();
        $request = $postManager->getPost();

        $commentManager = new CommentManager();
        $requestCom = $commentManager->getComments();

        require('project/view/frontend/postTargetView.php');
    }

    // Data Base Post Comment
    function postComment() {
        $commentManager = new CommentManager();
        $request = $commentManager->CommentPostDb();
        header('Refresh:0; index.php?action=post&idChapter='.$_GET['idChapter']);
    }

    // User Condition View
    function userCondition() {
        require('project/view/frontend/userConditionView.php');
    }

    // Inscription View
    function inscription(){
        require('project/view/frontend/inscriptionView.php');
    }

    // Inscription Account in Data Base
    function inscriptionDb(){
        //control pseudo & email Data Base
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->controlInscription();
        $result = $request->fetch();
        if($result['pseudo'] === $pseudo || $result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }        
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->postInscriptionDb();
            require('project/view/frontend/inscriptionReadyView.php');
        }
    }

    // Connection View
    function connection(){
        require('project/view/frontend/connectionView.php');
    }

    // Connection Account Data Base
    function connectionDb(){
        $password = $_POST['passwordConnect'];
        $email = $_POST['emailConnect'];
        $accountManager = new AccountManager();
        $request = $accountManager->postConnectionDb();
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

    //Unconection Session
    function unconnection(){
        session_destroy();
        header("Refresh:0; index.php");
    }

    //Account Management View
    function accountManagement(){
        $accountManager = new AccountManager();
        $request = $accountManager->requestAccountManagement();
        require('project/view/frontend/accountManagementView.php');
    }

    //Comment Warning increment
    function alertComment(){
        $commentManager = new CommentManager();
        $request = $commentManager->warningComment();
        require('project/view/frontend/indexView.php');
    }

    //Avatar Upload
    function avatarUpload(){ 
 
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
        $request = $accountManager->postAvatar($nameImage);
        header("Refresh:0; index.php");
    }

    //Account Modification view
    function accountModification(){
        $accountManager = new AccountManager();
        $request = $accountManager->requestAccountManagement();
        require('project/view/frontend/accountModificationView.php');
    }

    //Data Base Account all Modiffication
    function modificationAccountDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }        
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();
        
        session_destroy();
        require('project/view/frontend/updateReadyView.php');
        
    }

    //Data Base Account Fistname, Lastname & Email Modification
    function modificationNameEmailDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();
        
        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname, Lastname & Password Modification
    function modificationNamePassDb() {
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();
        
        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname, Email & Password Modification
    function modificationFirstnameEmailPassDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();
        
        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    } 

    //Data Base Account Lastname, Email & Password Modification
    function modificationLastnameEmailPassDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname & Lastname Modification
    function modificationNameDb() {
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname & Email Modification
    function modificationFirstmailEmailDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        
        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname & Password Modification
    function modificationFirstnamePassDb() {
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Accout Lastname & Email Modification
    function modificationLastnameEmailDb(){
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Lastname & Password Modification
    function modificationLastnamePassDb() {
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Email & Password Modification
    function modificationEmailPassDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Firstname Modification
    function modificationFirstnameDb() {
        //Firstname
        $accountManager = new AccountManager();
        $request = $accountManager->updateFirstname();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Lastname Modification
    function modificationLastnameDb() {
        //Lastname
        $accountManager = new AccountManager();
        $request = $accountManager->updateLastname();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Email Modification
    function modificationEmailDb() {
        //Email
        $email = $_POST['email'];
        $accountManagerControl = new AccountManager();
        $request= $accountManagerControl->updateControl();
        $result = $request->fetch();
        if($result['eMail'] === $email){
            throw new Exception('Pseudo ou Email déja existant');
        }
        // Insert Data Base
        else{
            $accountManager = new AccountManager();
            $request = $accountManager->updateEmail();
        }

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Data Base Account Password Modification
    function modificationPassDb() {
        //Password
        $accountManager = new AccountManager();
        $request = $accountManager->updatePass();

        session_destroy();
        require('project/view/frontend/updateReadyView.php');
    }

    //Admin Panel
    function adminPanel() {
        require('project/view/backend/backendIndexView.php');
    }

    

    
