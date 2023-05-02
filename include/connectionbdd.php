<?php
    try{
        $dbname = "cse-lcv";
        $connexion= new PDO('mysql:host=localhost;dbname='.$dbname.'', 'root', '');
    }catch(Exception $e){
        echo "Erreur de connexion.";
    }
?>