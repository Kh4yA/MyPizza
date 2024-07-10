<?php

namespace utils;
// class parent_class qui contient toutes les methodes generiques

//load($id) = charge un objet par l'id dans la bdd

class parentClass
{

    protected $table = ""; // nom de la table 
    protected $fields = []; // tableau simple des champs
    protected $values = []; // tableau indexé cle valeur au format ["nom"=>"valeur","prenom"=>"valeur",....]
    protected $id = 0;

    //etablir le __constructor pour que quand l'id est passé en parametre il charge l'objet null par defaut
    public function __construct($id = null)
    {
        if ($id) {
            $this->load($id);
        }
    }
    //GETTER
    /**
     * role : reccuperer la valeur d'un atribut
     * @param string 
     * @return string (valeur du champ)
     */
    function get($fieldName)
    {
        if (isset($this->values[$fieldName])) {
            return $this->values[$fieldName];
        } else {
            return null;
        }
    }
    /**
     * recupere la valeur de l'id
     *  @return int (valeur de l'id)
     */
    function getId(): int
    {
        return $this->id;
    }
    //SETTER
    /**
     * role : valoriser un attribut
     * @param string|int $fieldName(valeur a valoriser)
     * @return true (true si accepter false sinon)
     */
    function set($fieldName, $value)
    {
        $this->values[$fieldName] = $value;
        return true;
    }
    /**
     * construit une liste de champs pour la requete
     * @return string retourne une chaine de caractere au format "`nom`, `prenom`, ..."
     */
    function listField(): string
    {
        $tab = array();
        foreach ($this->fields as $field) {
            $tab[] = "`$field`";
        }
        return implode(', ', $tab);
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
        global $bdd;
        $sql = " SELECT `id`," . $this->listField() . " FROM `$this->table` WHERE `id` = :id";
        $param = [":id" => $id];
        $obj = $bdd->fetch($sql, $param);
        if ($obj) {
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
    /**
     * role : inserer des donnée en bdd
     * @param neant
     * @return int id de la derniere pizza inserer
     */
    function insert()
    {
        global $bdd;
        $bdd->insertBDD($this->table, $this->values);
        return $bdd->lastInsertId();
    }
    /**
     * role : modifer des donnée en bdd
     * @param neant
     * @return bool true si ok
     */
    function update(): bool
    {
        global $bdd;
        $bdd->updateBDD($this->table, $this->values, $this->id);
        return true;
    }
    /**
     * creer une liste d'objet contenu dans la base de donnée
     * @param neant
     * @return array 
     */
    function listAll(): array
    {
        global $bdd;
        $sql = " SELECT `id`," . $this->listField() . " FROM `$this->table`";
        $tab = $bdd->fetchAll($sql);
        $list = [];
        foreach ($tab as $data) {
            $class = get_class($this);
            $obj = new $class();
            $obj->loadFromTab($data);
            $obj->id = $data["id"];
            $list[] = $obj;
        }
        return $list;
    }
        /**
     * Rôle : extraire une liste d'objet de cette classe, avec des critères de tri et de filtrage
     * @param array permet de filtrer par nom champs [`nomChmap`= valeur]
     * @param array liste de tri ["+/-nomChamp"]
     * @return return tableau d'objet de la classe courante indexé par l'id
     */
    function  listEtendue(array $filtres = [], array $tris = []): array
    {
        $sql = "SELECT `id` , " . $this->listfield() . " FROM `$this->table` ";
        $param = [];
        $tabFiltre = [];
        foreach ($filtres as $fieldName => $valeur) {
            $tabFiltre[] = "`$fieldName` = :$fieldName";
            $index = ":$fieldName";
            $param[$index] = $valeur;
        }
        if (!empty($tabFiltre)) $sql .= " WHERE " . implode(" AND ", $tabFiltre);
        // Construire la liste des critères de tri
        $tabOrder = [];
        foreach ($tris as $tri) {
            // tri : +nomChamp ou - nomChamp ou nomChamp
            $car1 = substr($tri, 0, 1);
            if ($car1 === "-") {
                $ordre = "DESC";
                $nomField = substr($tri, 1);
            } else if ($car1 === "+") {
                $ordre = "ASC";
                $nomField = substr($tri, 1);
            } else {
                $ordre = "ASC";
                $nomField = $tri;
            }
            $tabOrder[] = "`$nomField` $ordre";
        }
        if (!empty($tabOrder))  $sql .= " ORDER BY " . implode(", ", $tabOrder);
        global $bdd;
        $req = $bdd->sqlExecute($sql, $param);
        $result = [];
        while ($data = $req->fetch(\PDO::FETCH_ASSOC)) {
            $class = get_class($this);
            $obj = new $class();
            $obj->loadFromTab($data);
            $obj->id = $data["id"];
            $result[$obj->id] = $obj;
        }
        return $result;
    }

    /**
     * role : supprime un champ selectionner par l'id
     * @param neant
     * @return true
     */
    function delete(): bool
    {
        $sql = "DELETE FROM `$this->table` WHERE `id` = :id";
        $param = [":id" => $this->id];
        global $bdd;
        $bdd->sqlExecute($sql, $param);
        return true;
    }
}
