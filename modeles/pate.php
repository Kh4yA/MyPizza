<?php

namespace utils;
// class user gerant la pate de la pizza dans la bdd
use utils\parentClass;

class pate extends parentClass{

protected $table = "pate";
protected $fields = ["nom", "photo", "prix", "description"];
protected $id = 0;
}