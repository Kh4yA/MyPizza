<?php

// on inclus le fichier init 
include_once "utils/init.php";

use utils\Main;

// on instncie Main
//main est le routeur
$app = new Main;

//On demarre 
$app->start();