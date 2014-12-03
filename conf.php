<?php
$hebergeur= 'localhost';
$namedb='mlr3';
$user='root';
$pass='root'; 
$port='3306';

/*Connexion a la base de données*/

try {
$bdd = new PDO ('mysql:host='.$hebergeur.';dbname='.$namedb.';port='.$port, $user, $pass);
}catch(Exception $e){
	die ('Erreur de connexion a la base de données : '.$e->getMessage());
}

include('./includes/dbquery/class.association.php');
include('./includes/dbquery/class.formation.php');
include('./includes/dbquery/class.membre.php');



?>