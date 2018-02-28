<?php
    //Require Controller ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    require('project/controller/controller.php');

    //Visitor screen ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    try{
        if(isset($_GET['action'])){
            if($_GET['action'] == 'chapter'){
                chapter();
            }
        }

        else{
            index();
        }
    }
    
    //If error, echo message ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    catch(Exception $e){
        echo 'Erreur : '. $e->getMessage();
    }