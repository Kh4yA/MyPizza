<?php

namespace utils;

use utils\parentClass;

// class user gerant la bdd

class pizza_ingredient extends parentClass
{

    protected $table = "pizza_ingredients";
    protected $fields = ["id_pizza", "id_ingredient"];
    protected $id = 0;
    //
    /**
     * moethode qui verifie si l'ingredient existe dans la liste
     * @param $id_ingredient (valeur a verifie)
     * @param $id_pizza (valeur a verifie)
     */
    public function exist($id_ingredient, $id_pizza)
    {
        $sql = " SELECT " . $this->listField() . " FROM $this->table WHERE `id_ingredient` = :id_ingredient AND `id_pizza` = :id_pizza ";
        $param = [":id_ingredient" => $id_ingredient, ":id_pizza" => $id_pizza];
        global $bdd;
        $req = $bdd->fetch($sql, $param);
        if ($req) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * afficher tous les ingredients selectionner par l'id de la pizza
     * @param int ($id_pizza)
     * @return array (tableau indexé avec les ingredient)
     */
    public function getIngredient($id_pizza)
    {
        $sql = "SELECT `pizza_ingredients`.`id_ingredient`, `ingredients`.`nom` as nom, `ingredients`.`prix` as prix
                FROM`pizza_ingredients` 
                LEFT JOIN `ingredients` ON `pizza_ingredients`.`id_ingredient` = `ingredients`.`id` 
                WHERE `pizza_ingredients`.`id_pizza` = :id_pizza";
        $param = [":id_pizza" => $id_pizza];
        global $bdd;
        $req = $bdd->fetchAll($sql, $param);
        $tab = [];
        foreach ($req as $data) {
            $tab[] = $data;
        }
        return $tab;
    }
    /**
     * camparer 2 tableaux et retourner les resultat different 
     * @param int id_pizza courrant
     * @param array $array2(tableau avec lequel on veux le comparer)
     * @return array Retourne un tableau contenant toutes les entités du tableau array qui ne sont présentes dans aucun des autres tableaux
     */
    function ingredientParPizza($id_pizza)
    {
        $sql = "SELECT `id`,`id_ingredient` FROM `$this->table` WHERE id_pizza =:id_pizza";
        $param = [":id_pizza"=>$id_pizza];
        global $bdd;
        $req = $bdd->fetchAll($sql, $param);
        $tab = [];
        foreach($req as $data){
            $tab[] = $data["id_ingredient"];
        }
        return $tab;
    }
    /**
     * charger la liste d'ingredient par pizza
     * @param int $id_pizza
     * @return array $result (liste d'ingredient )
     */
    function loadlistIngredient($id_pizza, $id_ingredient = null) {
        $sql = "SELECT `pizza_ingredients`.`id` as id_pizza_ingredient, `pizza_ingredients`.`id_ingredient`, `pizza_ingredients`.`id_pizza`, `ingredients`.`nom` as nom,`ingredients`.`id`, `ingredients`.`prix`as prix_ingredient
                FROM `pizza_ingredients` 
                LEFT JOIN `ingredients` ON `pizza_ingredients`.`id_ingredient` = `ingredients`.`id`
                WHERE `id_pizza` = :id_pizza";
        $param = [":id_pizza" => $id_pizza];
    
        if ($id_ingredient != null) {
            $sql .= " AND `id_ingredient` = :id_ingredient";
            $param[":id_ingredient"] = $id_ingredient;
        }
    
        global $bdd;
        $req = $bdd->fetchAll($sql, $param);
        $ingredients = [];
    
        foreach ($req as $data) {
            $ingredients[] = [
                "id_pizza_ingredient" => $data["id_pizza_ingredient"],
                "id_ingredient" => $data["id_ingredient"],
                "ingredient_nom" => $data["nom"],
                "prix_ingredient" => $data["prix_ingredient"],
            ];
        }
        return $ingredients;
    }
    function search($id_ingredient, $id_pizza){
        $sql = "SELECT `id` FROM `pizza_ingredients` WHERE `id_ingredient`=:id_ingredient AND `id_pizza`=:id_pizza";
        $param = [":id_ingredient"=>$id_ingredient, ":id_pizza"=>$id_pizza];
        global $bdd;
        $req = $bdd->fetch($sql, $param);
        if($req){
            $this->id = $req["id"];
            return true;
        }else{
            return false;
        }
    }
}
