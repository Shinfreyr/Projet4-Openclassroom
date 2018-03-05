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
                inscriptionDb();
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