<?php

// initialisation a inclure en debut de fichier

// gestion des erreurs

use utils\autoloader;
use utils\database;
use utils\session;

ini_set('display_errors', 1);
error_reporting(E_ALL);

// utilsel de la base de donnée
require "database.php";
try {
    global $bdd;
    $bdd = new database("projets_pizza_mdaszczynski");
} catch (Throwable $exception) {
    echo "Erreur dans la database $exception <br>";
}
// on definit  une constante avec le dossier racine du projet
define('ROOT', dirname(__DIR__));


// Mise en place de l'auto loader
require 'autoloader.php';
if (class_exists("utils\autoloader")) {
    autoloader::register();
} else {
    echo "Erreur : class autoloader pas trouvée. <br>";
}
// echo "<pre>";
// session_set_cookie_params(0);
// print_r(session_get_cookie_params());
// echo "</pre>";
// // on demarre la session
// session_cache_limiter("private");
// $session1 = session_cache_limiter();
// session_cache_expire(30);
// $session2 = session_cache_expire();
if (class_exists('utils\session')) {
    session::session_activation();
} else {
    echo "Erreur : La classe session n'a pas été trouvée.<br>";
}
// print_r($session1);
// print_r($session2);
// print_r($_SESSION);
