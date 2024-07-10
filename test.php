<?php

include "utils/init.php";

// test

use utils\controller;
use utils\ingredients;
use utils\pate;
use utils\pizza;
use utils\pizza_ingredient;
use utils\user;

// echo "<pre>";
// $pizza = new pizza(22);
// $pizza->set("description", "votre pizza est vide !");
// $pizza->set("taille", "3");
// -$result = $pizza->update();
// print_r($result);
// echo "</pre>";



// print_r($_COOKIE);
// $_SESSION["id"] = $_COOKIE["PHPSESSID"];
// print_r($_SESSION);
// $date = date("Y-m-d h:i:s");
// echo $date;

$ingredient = new pizza_ingredient();
$result = $ingredient->ingredientParPizza(45);
print_r($result);