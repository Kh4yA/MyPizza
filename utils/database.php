<?php

namespace core;

use \PDO;

class database
{
    protected $bdd;
    protected $db_host;
    protected $db_name;
    protected $user_name;
    protected $password;

    /**
     * Ouverture de la base de données
     * @param string $bdname ()
     * @param string $userName (nom d'utilisateur)
     * @param string $password (Mot de passe )
     */
    function __construct($db_name, $db_host = "localhost", $user_name = "mdaszczynski", $password = "Alt6WH9t%W")
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->user_name = $user_name;
        $this->password = $password;
    }

    private function getPDO()
    {
        if ($this->bdd === null) {
            $bdd = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name;charset=UTF8", $this->user_name, $this->password);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bdd = $bdd;
        }
        return $bdd;
    }
}
