<?php

namespace app\controller;

use app\modeles\ingredients;
use core\parentClass\parentClass;

class controller extends ParentClass{

    public function index(){
        $ingredient = new ingredients();
        $ingredient->load(1);
    }

    public function createPizza(){
        
    }
}