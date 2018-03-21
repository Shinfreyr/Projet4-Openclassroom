<?php
 
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();
    
    //Require Controller ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/controller/allUserController.php');
    require('project/controller/userConnectedController.php');
    require('project/controller/adminController.php');
    
    //Rooter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try{
        
        if(isset($_GET['action']) && isset($_GET['idChapter']) && isset($_GET['db'])) {    
#All        //Comment Post +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'comment' && $_GET['db'] === 'ok') {
                if(isset($_POST['commentContent']) && isset($_POST['checkUserCondition'])) {
                    if($_POST['commentContent'] !== "" && $_POST['checkUserCondition'] === "ok") {    
                        postComment();
                    }
#Exception          //Error ******************************************************************************************
                    else {
                        throw new Exception('Champs obligatoires manquants');
                    }
                }
#Exception      //Error **********************************************************************************************
                else {
                    throw new Exception('Vous n\'avez pas pris connaissances des conditions d\'utilisations de l\'espace commentaire');
                }
            }
#Admin      //Admin Chapter Modification Post ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'modificationTargetChapter' && $_GET['db'] === 'ok' && $_SESSION['statue'] === 'Admin') {
                modificationTargetChapterDb();
            }
#Exception  //Error **************************************************************************************************
            else {
                throw new Exception('Retour variables inatendu');
            }
        }     
        elseif(isset($_GET['action']) && isset($_GET['idChapter'])) {            
#All        //Chapter target Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'post' && $_GET['idChapter'] >0) {
                post();
            }
#Admin      //Modification Target Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'modificationTargetChapter' && $_GET['idChapter'] >0 && $_SESSION['statue'] === 'Admin') {
                modificationTargetChapter();
            }
#Admin      //Publication Target Rough Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'publicationTargetChapter' && $_GET['idChapter'] >0 && $_SESSION['statue'] === 'Admin') {
                publicationTargetChapter();
            }
#Admin      //Suppression Target Rough Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'supressionTargetChapter' && $_GET['idChapter'] >0 && $_SESSION['statue'] === 'Admin') {
                supressionTargetChapter();
            }
#Admin      //Upload Image Target Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadImagePost' && $_GET['idChapter'] >0 && $_SESSION['statue'] === 'Admin') {
                uploadImagePost();
            }
#Exception  //Error ***************************************************************************************************
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }            
        }
        elseif(isset($_GET['action']) && isset($_GET['idAccount'])) {
#Admin      //Admin Ban Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if(($_GET['action'] === 'banAccount' || $_GET['action'] === 'banAccountStatue') && $_SESSION['statue'] === 'Admin') {
                banAccount();
            }
#Admin      //Admin Deban +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userUpStatue' && $_SESSION['statue'] === 'Admin') {
                userUpStatue();
            }
#Admin      //Admin up User to Admin ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'adminUpStatue' && $_SESSION['statue'] === 'Admin') {
                adminUpStatue();
            }
#Admin      //Admin down Admin to User ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userDownStatue' && $_SESSION['statue'] === 'Admin') {
                userDownStatue();
            }
#Exception  //Error ***************************************************************************************************
            else {
                throw new Exception('Retour variables inatendu');
            }
            
        }
        elseif(isset($_GET['action']) && isset($_GET['idComments'])) {
#Admin      //Admin Suppress Comment ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++          
            if($_GET['action'] === 'suppComment' && $_SESSION['statue'] === 'Admin') {
                suppComment();
            }
#Admin      //Admin Reset count Alert +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'resetAlert' && $_SESSION['statue'] === 'Admin') {
                resetCountAlert();
            }
#Exception  //Error ***************************************************************************************************
            else {
                throw new Exception('Retour variables inatendu');
            }
        }
        elseif(isset($_GET['action']) && isset($_GET['db'])) {
#All        //Data Base Inscription ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'inscription' && $_GET['db'] === 'ok') {                
                if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp']) && isset($_POST['checkHuman'])) {   
                    if($_POST['pseudo'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "" && $_POST['checkHuman']) {
                        if($_POST['password'] === $_POST['passwordComp'] && $_POST['checkHuman'] === "ok" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            inscriptionDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
#Exception          //Error *******************************************************************************************
                    else {
                        throw new Exception('Champs Obligatoire Manquant');
                    }
                }
#Exception      //Error ***********************************************************************************************
                else {
                    throw new Exception('Retour variables inatendu');
                }
            }
#UserCo     //Data Base Connection ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection' && $_GET['db'] === 'ok') {
                if(isset($_POST['emailConnect']) && isset($_POST['passwordConnect'])) {    
                    if($_POST['emailConnect'] !== "" && $_POST['passwordConnect'] !== "" ) {
                        connectionDb();
                    }
#Exception          //Error *******************************************************************************************
                    else {
                        throw new Exception('Erreur lors du remplissage d\'un champs');
                    }
                }
#Exception      //Error ***********************************************************************************************
                else {
                    throw new Exception('Retour variable intendu');
                }
            }
#UserCo     //Data Base Account Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountModification' && $_GET['db'] === 'ok') {
                if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
#UserCo             // All field modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    if($_POST['firstName'] !== "" && $_POST['lastName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationAccountDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
#UserCo             //Firstname, Lastname & Email modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" && $_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationNameEmailDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Email incorect');
                        }
                    }
#UserCo             //Firstname, Lastname & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" &&  $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationNamePassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
#UserCo             //Firstname, Email & Password ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationFirstnameEmailPassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
#UserCo             //Lastname, Email & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationLastnameEmailPassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
#UserCo             //Firstname & Lastname modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" ) {
                        modificationNameDb();
                    }
#UserCo             //Firstname & Email modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                            modificationFirstmailEmailDb();
                        }
                        else {
                            throw new Exception('Champs Email incorect');
                        } 
                    }
#UserCo             //Firstname & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationFirstnamePassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
#UserCo             //Lastname & Email modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['email'] !=="") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                            modificationLastnameEmailDb();
                        }
#Exception              //Error **************************************************************************************
                        else {
                            throw new Exception('Champs Email incorect');
                        }
                    }
#UserCo             //Lastname & Password modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationLastnamePassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
#UserCo             //Email & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] != "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
                            modificationEmailPassDb();
                        }
#Exception              //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou email incorect');
                        }
                    }
#UserCo             //Firstname modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "") {
                        modificationFirstnameDb();
                    }
#UserCo             //Lastname modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "") {
                        modificationLastnameDb();
                    }
#UserCo             //Email Modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationEmailDb();
                        }
#Exception              //Error **************************************************************************************
                        else {
                            throw new Exception('Champs email incorect');
                        }
                    }
#UserCo             //Password Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationPassDb();
                        }
#Exception              //Error **************************************************************************************
                        else {
                            throw new Exception('Champs Password incorect');
                        }
                    }
                }
#Exception      //Error **********************************************************************************************
                else {
                    throw new Exception('Retour variable intendu');
                }
            }
#Admin      //Admin Write Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'writeChapter' && $_GET['db'] === 'ok' && $_SESSION['statue'] === 'Admin') {
                if(isset($_POST['chapterTitle']) && isset($_POST['chapterContent'])) {    
                    if($_POST['chapterTitle'] !== "" && $_POST['chapterContent'] !== "") {
                        writeChapterDb();
                    }
#Exception          //Error ******************************************************************************************
                    else {
                        throw new Exception('Champs Non Rempli');
                    }
                }
#Exception      //Error ***********************************************************************************************
                else {
                    throw new Exception('Retour variable intendu');
                }
            }
#Exception  //Error ***************************************************************************************************
            else {
                throw new Exception('Erreur de redirection');
            }
        }

        elseif(isset($_GET['action']) && isset($_GET['idComment'])) {
#All        //Comment Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'alert'){
                alertComment();
            }
        }

        elseif(isset($_GET['action'])) {
#All        //Chapters Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'chapter') {
                chapter();
            }
#All        //Inscription Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'inscription') {
                inscription();
            }
#All        //Connection Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection') {
                connection();
            }
#UserCo     //Unconnection Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'unconnection') {
                unconnection();
            }
#UserCo     //Account Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'account') {
                accountManagement();
            }
#UserCo     //Account Management Avatar Upload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadAvatar') {
                avatarUpload();
            }
#UserCo     //Account Management modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountModification') {
                accountModification();
            }
#UserCo     //User Condition +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userCondition') {
                userCondition();
            }
#Admin      //Admin Panel Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'admin' && $_SESSION['statue'] === 'Admin') {
                adminPanel();
            }
#Admin      //Admin Panel Write New Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'writeChapter' && $_SESSION['statue'] === 'Admin') {
                writeChapter();
            }
#Admin      //Admin Panel Modification Chapter ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'modificationChapter' && $_SESSION['statue'] === 'Admin') {
                modificationChapter();
            }
#Admin      //Admin Panel Rough +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'rough' && $_SESSION['statue'] === 'Admin') {
                roughChapter();
            }
#Admin      //Admin Panel Alert Comment Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'alertManagement' && $_SESSION['statue'] === 'Admin') {
                alertManagement();
            }
#Admin      //Admin Panel Account Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'adminAccountManagement' && $_SESSION['statue'] === 'Admin') {
                adminAccountManagement();
            }
#Exception  //Error ***************************************************************************************************
            else {
                throw new Exception('Erreur de redirection');
            }            
        }

#All    //Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        else {
            index();
        }
    }
    
    //If error, echo message and index return++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    catch(Exception $e) {
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        index();       
    }