<?php

namespace utils;
// class user gerant la base de la piiza dans la bdd
use utils\parentClass;

class base extends parentClass{

protected $table = "base";
protected $fields = ["nom", "photo", "prix", "description"];
protected $id = 0;
}