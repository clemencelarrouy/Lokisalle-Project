<?php

define('PRODUCTION', $_SERVER['HTTP_HOST'] !== 'localhost');

if (PRODUCTION) {
    define('DSN', 'mysql:host=lokisai1.mysql.db;dbname=lokisai1;charset=utf8');
    define('USER', 'lokisai1');
    define('PASSWORD', 'Patatenoisette58');
} else {
    define('DSN', 'mysql:host=localhost;dbname=lokisalle;charset=utf8');
    define('USER', 'root');
    define('PASSWORD', '');
}

//BDD
$pdo = new PDO(DSN, USER, PASSWORD, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);

//SESSION
session_start();

//CHEMIN 
define("RACINE_SITE","/lokisalle/");

//VARIABLES 
$contenu ="";

// FONCTIONS
include("fonction.inc.php");
