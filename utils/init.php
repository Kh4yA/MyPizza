<?php

// initialisation a inclure en debut de fichier

// gestion des erreurs

use core\database;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// appel de la base de donnée
include "bdd.php";
global $bdd;
$bdd = new database("projets_pizza_mdaszczynski");

// Mise en place de l'auto loader
require '../app/autoloader.php';
core\autoloader::registrer();

var_dump($bdd);