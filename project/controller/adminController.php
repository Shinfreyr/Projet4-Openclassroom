<?php
    // Require Model ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require_once('project/model/PostManager.php');
    require_once('project/model/CommentManager.php');
    require_once('project/model/AccountManager.php');
    // Function +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    //Admin Panel +++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function adminPanel() {
        $accountManager = new AccountManager();
        $request = $accountManager->countAccount();

        $commentManager = new CommentManager();
        $requestCom = $commentManager->countComment();

        $commentManagerAlert = new CommentManager();
        $requestAlert = $commentManager->countCommentAlert();
        
        require('project/view/backend/backendIndexView.php');
    }

    //Admin Write Chapter View +++++++++++++++++++++++++++++++++++++++++
    function writeChapter() {
        require('project/view/backend/writeChapterView.php');
    }

    //Admin Write Chapter DB +++++++++++++++++++++++++++++++++++++++++++
    function writeChapterDb() {
        $chapterTitle = htmlspecialchars($_POST['chapterTitle']);
        $chapterContent = htmlspecialchars($_POST['chapterContent']);
        $id = htmlspecialchars($_SESSION['id']);
        
        $postManager= new PostManager();
        $request= $postManager->chapterInsert($chapterTitle,$chapterContent,$id);
        
        require('project/view/backend/postInsertReady.php');
    }

    //Admin Modification Chapter View ++++++++++++++++++++++++++++++++++
    function modificationChapter() {
        $postManager= new PostManager();
        $request= $postManager->getPostsAdmin();
        
        require('project/view/backend/modificationChapterView.php');
    }

    //Admin Modification Target Chapter View +++++++++++++++++++++++++++
    function modificationTargetChapter() {
        $postManager= new PostManager();
        $request= $postManager->getPost();
        
        require('project/view/backend/modificationTargetChapterView.php');
    }

    //Admin Modification Target Chapter Data Base ++++++++++++++++++++++
    function modificationTargetChapterDb() {
        $chapterContent = htmlspecialchars($_POST['chapterContent']);
        $idChapter = htmlspecialchars($_GET['idChapter']);
        
        $postManager= new PostManager();
        $request= $postManager->chapterModificationPost($chapterContent,$idChapter);
        
        require('project/view/backend/modificationChapterReady.php');
    }

    //Admin Publication Target Chapter Data Base ++++++++++++++++++++++++
    function publicationTargetChapter() {
        $idChapter = htmlspecialchars($_GET['idChapter']);
        
        $postManager= new PostManager();
        $request= $postManager->publicationModificationPost($idChapter);
        
        header("Refresh:0; index.php?action=modificationChapter");
    }

    //Admin Supression Target Chapter and linked Comments Data Base ++++
    function supressionTargetChapter() {
        $idChapter = htmlspecialchars($_GET['idChapter']);
        
        $commentManager= new CommentManager();
        $request= $commentManager->supressionLinkedCommentPost($idChapter);

        $postManager= new PostManager();
        $request= $postManager->supressionChapterPost($idChapter);
        
        header("Refresh:0; index.php?action=modificationChapter");
    }

    //Admin Upload Image Chapter ++++++++++++++++++++++++++++++++++++++
    function uploadImagePost() {
        /************************************************************
         * Setup
         *************************************************************/
        
        define('TARGET', 'project/public/images/');    // Target Folder
        define('MAX_SIZE', 1000000);    // Max Weight Files (octet)
        define('WIDTH_MAX', 1920);    // Max Width Image (pix)
        define('HEIGHT_MAX', 1080);    // Max Height Image (pix)
        
        // Data Table
        $tabExt = array('jpg','gif','png','jpeg');    // Authorized extension
        $infosImg = array();
        
        // Variables
        $extension = '';
        $message = '';
        $nameImage = '';
        $idChapter = htmlspecialchars($_GET['idChapter']);
        
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
        
        $postManager= new PostManager();
        $request= $postManager->updateImageChapter($nameImage,$idChapter);
        
        header("Refresh:0; index.php?action=modificationChapter");
    }

    //Admin Chapter Rough ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function roughChapter() {
        $postManager= new PostManager();
        $request= $postManager->getChapterRough();
        require('project/view/backend/roughChapterView.php');
    }

    //Admin Alert Management +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function alertManagement() {
        $commentManager = new CommentManager();
        $request = $commentManager->alertManagement();
        require('project/view/backend/alertManagementView.php');
    }
    
    //Admin Ban Account ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function banAccount() {
        $id = htmlspecialchars($_GET['idAccount']);
        
        $accountManagerControl = new AccountManager();
        $request = $accountManagerControl->accountStatueControl($id);
        
        $result = $request->fetch();
        //If account statue is Admin do exception
        if($result['accountStatue'] === 'Admin' ) {
            throw new Exception('Vous ne Pouvez pas Bannir un Administrateur... Vous devez dabord lui baisser ses droits dans la gestion de compte !');
        }
        //Supress comment and ban account
        else {
            $commentManager= new CommentManager();
            $request= $commentManager->supressAccountLinkedCommentPost($id);
        
            $accountManager = new AccountManager();
            $request = $accountManager->banAccountBd($id);
            
            if($_GET['action'] === 'banAccountStatue') {
                header("Refresh:0; index.php?action=adminAccountManagement");
            }
            else {
                require('project/view/backend/alertManagementView.php');
            }                
        }
    }
    
    //Suppress Comment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function suppComment() {
        $idComments = htmlspecialchars($_GET['idComments']);
        
        $commentManager= new CommentManager();
        $request= $commentManager->supressAlertComment($idComments);
        
        require('project/view/backend/alertManagementView.php');
    }

    //Reset Count Alert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function resetCountAlert() {
        $idComments = htmlspecialchars($_GET['idComments']);
        
        $commentManager= new CommentManager();
        $request= $commentManager->resetCountAlertComment($idComments);
        
        header("Refresh:0; index.php?action=alertManagement");
    }

    //Admin Account Management ++++++++++++++++++++++++++++++++++++++++++++++++++
    function adminAccountManagement() {
        $accountManager = new AccountManager();
        $request = $accountManager->allAccountView();
        
        require('project/view/backend/backAccountManagementView.php');
    }

    //Admin Account Management up Ban account to User ++++++++++++++++++++++++++++
    function userUpStatue() {
        $id = htmlspecialchars($_GET['idAccount']);

        $accountManager = new AccountManager();
        $request = $accountManager->updateUserStatue($id);
        
        header("Refresh:0; index.php?action=adminAccountManagement");
    }

    // Admin Account Management up User account to Admin +++++++++++++++++++++++++
    function adminUpStatue() {
        $id = htmlspecialchars($_GET['idAccount']);
        
        $accountManager = new AccountManager();
        $request = $accountManager->updateAdminStatue($id);
        
        header("Refresh:0; index.php?action=adminAccountManagement");
    }

    // Admin Account Managemnt down Admin to User +++++++++++++++++++++++++++++++++
    function userDownStatue() {
        $id = htmlspecialchars($_GET['idAccount']);

        $accountManager = new AccountManager();
        $request = $accountManager->downgradeUserStatue($id);
        
        header("Refresh:0; index.php?action=adminAccountManagement");
    }