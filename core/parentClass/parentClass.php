<?php

namespace core\parentClass;
// class parent_class qui contient toutes les methodes generiques

//load($id) = charge un objet par l'id dans la bdd

class parentClass
{

    protected $table = ""; // nom de la table 
    protected $fields = []; // tableau simple des champs
    protected $values = []; // tableau indexé cle valeur au format ["nom"=>"valeur","prenom"=>"valeur",....]
    protected $id = 0;
    /**
     * construit une liste de champs pour la requete
     * @return string retourne une chaine de caractere au format "`nom`, `prenom`, ..."
     */
    function listField(): string 
    {
        $tab = array();
        foreach ($this->fields as $field) {
            $tab[] = `"$field"`;
        }
        return implode(',', $tab);
    }
    /**
     * loadFromTab charge un tableau de données a partir d'un autre tableau
     * @param array ($tab)
     */
    function loadFromTab($tab): bool
    {
        foreach ($this->fields as $fieldName) {
            if (isset($tab[$fieldName])) {
                $this->values[$fieldName] = $tab[$fieldName];
            }
        }
        return true;
    }
    /**
     * charge un objet de la classe courante
     * @param $id de l'objet a charger
     * @return bool true
     */
    function load($id): bool
    {
        $sql = " SELECT " .$this->listField(). " FROM `$this->table` WHERE `id`=:id ";
        $param = [":id" => $id];
        global $bdd;
        $req = $bdd->prepare($sql);
        if (!$req->execute($param)) {
            echo "probleme de requete $sql";
            return false;
        }
        $obj = $bdd->fecth(\PDO::FETCH_OBJ);
        if ($obj) {
            $this->id = $obj["id"];
            foreach ($this->fields as $data) {
                $this->values[$data] = $obj[$data];
            }
            return true;
        }
        return false;
    }
}
