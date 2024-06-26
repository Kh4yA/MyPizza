<?php

// class ingredient gerant les objets ingredient dans la bdd

namespace app\modeles;

use core\parentClass\parentClass;

class ingredients extends parentClass{

    // On valorises les attributs 
    protected $table = "ingredients";
    protected $fields = ["nom", "description", "prix", "photo"];
    protected $id_ingredient = 0;

}