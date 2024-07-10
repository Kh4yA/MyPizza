<?php

// class ingredient gerant les objets ingredient dans la bdd

namespace utils;

use utils\parentClass;

class ingredients extends parentClass
{

    // On valorises les attributs 
    protected $table = "ingredients";
    protected $fields = ["nom", "description", "prix", "photo"];
    protected $id = 0;

}

