<?php

namespace utils;
// class user gerant la taille de la piiza dans la bdd
use utils\parentClass;

class taille extends parentClass{

protected $table = "taille";
protected $fields = ["nom","photo","prix"];
protected $id = 0;
}