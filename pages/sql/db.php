<?php

//     //paramètres de connexion en constantes
//     define("DBHOST", "localhost");  //soit localhost, soit l'IP du serveur
//     define("DBUSER", "root");       //utilisateur de la base (différent de PHPmyAdmin)
//     define("DBPASS", "root");           //mot de passe
//     define("DBNAME", "stackode");  //nom de la base de données

// 	try {
//         //connexion à la base avec la classe PDO et le dsn
// 		$dbh = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS, array(
// // /*Mac*/		1002 => "SET NAMES utf8", //on s'assure de communiquer en utf8
// /*PC*/		//PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", //on s'assure de communiquer en utf8
// 			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //on récupère nos données en array associatif par défaut
// 			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING         //on affiche les erreurs. À modifier en prod. 
// 		));
// 	} catch (PDOException $e) { //attrappe les éventuelles erreurs de connexion
// 		echo 'Erreur de connexion : ' . $e;}
// 	// }->getMessage()

// $user = 'root';
// $password = 'root';
// $db = 'stackode';
// $host = 'localhost';
// $port = 8889;

// $link = mysqli_init();
// $success = mysqli_real_connect(
//    $link, 
//    $host, 
//    $user, 
//    $password, 
//    $db,
//    $port
// );