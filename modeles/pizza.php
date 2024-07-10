<?php

namespace utils;
// class user gerant la pizza dans la bdd
use utils\parentClass;

class pizza extends parentClass
{

    // declaration des attributs

    protected $table = "pizza";
    protected $fields = ["utilisateur", "photo", "taille", "description", "pate", "base"];
    protected $id = 0;

    // Method specifiques
    // perparation d'une methode avec les jointure pour lier les table entre elle
    //      de la table pizza->base
    //      de la table pizza->pate
    //      de la table pizza->taille
    //      de la table pizza->user
    /**
     * reccuperer tout le detaille d'une piiza
     * @param int $id (id de la pizza en question)
     * @return array ($array tableau indexé)
     */
    function getPizza($id)
    {
        $sql = "SELECT `pizza`.`photo`,`pizza`.`taille` as id_taille,`pizza`.`description`,`user`.`nom` as nom_user,`user`.`email` as mail_user,`pate`.`nom` as nom_pate,`base`.`nom` as nom_base,`taille`.`nom` as `nom_taille`, `ingredients`.`nom` as ingredients,
                        `pizza`.`prix`, `taille`.`prix` as taille_prix, `pate`.`prix` as pate_prix
                FROM `pizza` 
                LEFT JOIN `user` ON `pizza`.`utilisateur` = `user`.`id` 
                LEFT JOIN `pate` ON `pizza`.`pate` = `pate`.`id` 
                LEFT JOIN `taille`ON `pizza`.`taille` = `taille`.`id` 
                LEFT JOIN `base` ON `pizza`.`base` = `base`.`id` 
                LEFT JOIN `pizza_ingredients` ON `pizza_ingredients`.`id_pizza` = `pizza`.`id` 
                LEFT JOIN `ingredients`ON `pizza_ingredients`.`id_ingredient` = `ingredients`.`id` 
                WHERE `pizza`.`id`= :id";
        $param = [":id" => $id];
        global $bdd;
        $result = [];
        $obj = $bdd->fetch($sql, $param);
        if ($obj) {
            $result = $obj;
            }
        return $result;
    }
    /**
     *  creer un tableau avec les valeur du left join
     */
    function getTablePizza($id)
    {
        $obj = $this->getPizza($id);
        $table = [
            "photo" => $obj["photo"],
            "description" => $obj["description"],
            "nom_user" => $obj["nom_user"],
            "mail_user" => $obj["mail_user"],
            "pate" => $obj["nom_pate"],
            "base" => $obj["nom_base"],
            "taille" => $obj["nom_taille"],
            "prix" => $obj["prix"],
            "taille_prix" => $obj["taille_prix"],
            "pate_prix" => $obj["pate_prix"],
            "id_taille" => $obj["id_taille"],
        ];
        return $table;
    }
    // methode qui va me retourner le prix donner par la requetye sql selon les choix 
    function getPrixPizza($id)
    {
        $sql = "SELECT `pizza`.`id`, (`taille`.`prix` + `pate`.`prix`) AS prix_total FROM `pizza` LEFT JOIN `taille` ON `pizza`.`taille` = `taille`.`id` LEFT JOIN `pate` ON `pizza`.`pate` = `pate`.`id` WHERE `pizza`.`id` = :id";
        $param = [":id" => $id];
        global $bdd;
        $result = [];
        $obj = $bdd->fetch($sql, $param);
        if ($obj) {
            $result = $obj;
            }
        return $result;
        }
}
