<?php

namespace utils;

// class user gerant la bdd
use utils\parentClass;

class user extends parentClass{

protected $table = "user";
protected $fields = ["nom", "email"];
protected $id = 0;
}