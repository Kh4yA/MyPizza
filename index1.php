<?php

// Mise en place de l'autoloader
include "utils/init.php";



use utils\controller;
use utils\errorManager;


// Récupérer les paramètres en GET
    $p = isset($_GET["p"]) ? $_GET["p"] :"home";



// Instancier le contrôleur
$controleur = new controller();
$error = new errorManager();

// Selon le paramètre, utilseler la bonne méthode de la classe contrôleur
switch ($p) {
    case "home":
        $controleur->index();
        break;
    case "CreerTaPizza":
        $controleur->createPizza();
        break;
    case "error.log":
        $error->display("templates/views/error.php",["message" => "test"]);
        break;
    default:
        echo "Page non trouvée.";
        break;
}