<?php
//Mise en place du fichier initilisation

use app\controller\controller;

include "utils/init/init.php";

if (isset($_GET["p"])) {
    $p = $_GET["p"];
} else {
    $p = "home";
}

if ($p === "home") {
    $controleur = new controller();
    $controleur->index();
} elseif ($p === "CreerTaPizza") {
    $controleur = new controller();
    $controleur->createPizza();
}
