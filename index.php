<?php
    //Session Start +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    session_start();
    
    //Require Controller ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/controller/controller.php');

    //Visitor screen ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try{

        if(isset($_GET['action']) && isset($_GET['idChapter'])) {
            //Chapter target Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] == 'post' && $_GET['idChapter'] >0){
                post();
            }
            //Error
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
            
        }

        elseif(isset($_GET['action']) && isset($_GET['db'])) {
            //Data Base Inscription +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] == 'inscription' && $_GET['db'] == 'ok') {
                if($_POST['pseudo'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['passwordComp'] != "" && $_POST['checkHuman']) {
                    if($_POST['password'] == $_POST['passwordComp'] && $_POST['checkHuman'] == "ok" && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        inscriptionDb();
                    }
                    //Error
                    else {
                        throw new Exception('Champs Mot de Passe ou Email incorect');
                    }
                }
                //Error
                else {
                    throw new Exception('Champs Obligatoire Manquant');
                }
            }
            //Error
            else {
                throw new Exception('Erreur de redirection');
            }
        }

        elseif(isset($_GET['action'])){
            //Chapters Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            if($_GET['action'] == 'chapter'){
                chapter();
            }
            //Inscription Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            elseif($_GET['action'] == 'inscription'){
                inscription();
            }
        }

        //Index Page ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        else{
            index();
        }
    }
    
    //If error, echo message ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    catch(Exception $e){
        echo 'Erreur : '. $e->getMessage();
    }