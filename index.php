<?php
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();
    
    //Require Controller ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/controller/controller.php');

    //Rooter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try{
        //Comment Post +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        if(isset($_GET['action']) && isset($_GET['idChapter']) && isset($_GET['db'])) {    
            if($_GET['action'] === 'comment' && $_GET['db'] === 'ok') {
                if(isset($_POST['commentContent']) && isset($_POST['checkUserCondition'])) {
                    if($_POST['commentContent'] !== "" && $_POST['checkUserCondition'] === "ok") {    
                        postComment();
                    }
                    //Error ******************************************************************************************
                    else {
                        throw new Exception('Champs obligatoires manquants');
                    }
                }
                //Error **********************************************************************************************
                else {
                    throw new Exception('Vous n\'avez pas pris connaissances des conditions d\'utilisations de l\'espace commentaire');
                }
            }
            //Error **************************************************************************************************
            else {
                throw new Exception('Retour variables inatendu');
            }
        }
        //Chapter target Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     
        elseif(isset($_GET['action']) && isset($_GET['idChapter'])) {            
            if($_GET['action'] === 'post' && $_GET['idChapter'] >0){
                post();
            }
            //Error ***************************************************************************************************
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
            
        }

        elseif(isset($_GET['action']) && isset($_GET['db'])) {
            //Data Base Account +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'inscription' && $_GET['db'] === 'ok') {
                //Data Base Inscription +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp']) && isset($_POST['checkHuman'])) {   
                    if($_POST['pseudo'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "" && $_POST['checkHuman']) {
                        if($_POST['password'] === $_POST['passwordComp'] && $_POST['checkHuman'] === "ok" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            inscriptionDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
                    //Error *******************************************************************************************
                    else {
                        throw new Exception('Champs Obligatoire Manquant');
                    }
                }
                //Error ***********************************************************************************************
                else {
                    throw new Exception('Retour variables inatendu');
                }
            }
            //Data Base Connection ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection' && $_GET['db'] === 'ok') {
                if(isset($_POST['emailConnect']) && isset($_POST['passwordConnect'])) {    
                    if($_POST['emailConnect'] !== "" && $_POST['passwordConnect'] !== "" ) {
                        connectionDb();
                    }
                    //Error *******************************************************************************************
                    else {
                        throw new Exception('Erreur lors du remplissage d\'un champs');
                    }
                }
                //Error ***********************************************************************************************
                else {
                    throw new Exception('Retour variable intendu');
                }
            }
            //Data Base Account Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountModification' && $_GET['db'] === 'ok') {
                if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordComp'])) {
                    // All field modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    if($_POST['firstName'] !== "" && $_POST['lastName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== ""){
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            modificationAccountDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
                    //Firstname, Lastname & Email modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" && $_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            modificationNameEmailDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Email incorect');
                        }
                    }
                    //Firstname, Lastname & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" &&  $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationNamePassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
                    //Firstname, Email & Password ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                            modificationFirstnameEmailPassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
                    //Lastname, Email & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationLastnameEmailPassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou Email incorect');
                        }
                    }
                    //Firstname & Lastname modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['lastName'] !== "" ) {
                        modificationNameDb();
                    }
                    //Firstname & Email modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                            modificationFirstmailEmailDb();
                        }
                        else {
                            throw new Exception('Champs Email incorect');
                        } 
                    }
                    //Firstname & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== ""){
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationFirstnamePassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
                    //Lastname & Email modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['email'] !==""){
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {    
                            modificationLastnameEmailDb();
                        }
                        //Error **************************************************************************************
                        else {
                            throw new Exception('Champs Email incorect');
                        }
                    }
                    //Lastname & Password modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationLastnamePassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe incorect');
                        }
                    }
                    //Email & Password modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['email'] !== "" && $_POST['password'] !== "" && $_POST['passwordComp'] != "") {
                        if($_POST['password'] === $_POST['passwordComp'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
                            modificationEmailPassDb();
                        }
                        //Error ***************************************************************************************
                        else {
                            throw new Exception('Champs Mot de Passe ou email incorect');
                        }
                    }
                    //Firstname modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['firstName'] !== "") {
                        modificationFirstnameDb();
                    }
                    //Lastname modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['lastName'] !== "") {
                        modificationLastnameDb();
                    }
                    //Email Modification +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['email'] !== "") {
                        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                            modificationEmailDb();
                        }
                        //Error **************************************************************************************
                        else {
                            throw new Exception('Champs email incorect');
                        }
                    }
                    //Password Modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    elseif($_POST['password'] !== "" && $_POST['passwordComp'] !== "") {
                        if($_POST['password'] === $_POST['passwordComp']) {
                            modificationPassDb();
                        }
                        //Error **************************************************************************************
                        else {
                            throw new Exception('Champs Password incorect');
                        }
                    }
                }
                //Error **********************************************************************************************
                else {
                    throw new Exception('Retour variable intendu');
                }
            }

            //Error ***************************************************************************************************
            else {
                throw new Exception('Erreur de redirection');
            }
        }

        elseif(isset($_GET['action']) && isset($_GET['idComment'])){
            //Comment Warning ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'alert'){
                alertComment();
            }
        }

        elseif(isset($_GET['action'])){
            //Chapters Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] === 'chapter'){
                chapter();
            }
            //Inscription Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'inscription'){
                inscription();
            }
            //Connection Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'connection'){
                connection();
            }
            //Unconnection Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'unconnection'){
                unconnection();
            }
            //Account Management ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'account'){
                accountManagement();
            }
            //Account Management Avatar Upload ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'uploadAvatar'){
                avatarUpload();
            }
            //Account Management modification ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'accountModification'){
                accountModification();
            }
            //User Condition +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'userCondition') {
                userCondition();
            }
            //Admin Panel Index +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'admin' && $_SESSION['statue'] === 'Admin') {
                adminPanel();
            }
            //Admin Panel Write New Chapter +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] === 'writeChapter' && $_SESSION['statue'] === 'Admin') {
                writeChapter();
            }
            //Error ***************************************************************************************************
            else {
                throw new Exception('Erreur de redirection');
            }            
        }

        //Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        else{
            index();
        }
    }
    
    //If error, echo message ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    catch(Exception $e){
        echo '<h3 class="error">Erreur : '. $e->getMessage() .'</h3>';
        index();       
    }