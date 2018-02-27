<?php


class Manager{

    protected function dbConnect(){
        // Connexion à la base de données
        $db = new PDO('mysql:host=localhost;dbname=base_alaska;charset=utf8', 'root', '');
        return $db;
    }
}