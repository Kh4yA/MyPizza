<?php

namespace utils;

use utils\parentClass;

class controller extends parentClass
{
    protected $currentPizza;

    function __construct()
    {
        //instanciatiopn de classe
        $this->currentPizza = new pizza_ingredient();
    }
    /**
     * methode qui affiche l'id de la pizza en cours
     * @param neant
     * @return neant
     */
    function getIdPizza()
    {
        if (!empty($_SESSION["id_pizza"]) == null) {
            $_SESSION["id_pizza"] = $this->createNewPizza();
        } else {
            return $_SESSION["id_pizza"];
        }
    }
    /**
     * Rôle : Donner les actions à effectuer
     *  Paramètre : Néant
     *  Retour : Néant
     */
    public function home()
    {
        $p = "home";
        include ROOT . "/templates/views/home.php";
    }
    /**
     * role : controller et prepare l'affichage du template creer ta pizza
     * @param neant
     * @return neant
     */
    public function createPizza()
    {
        $this->getIdPizza();
        // instanciation des classes 
        $pizza_ingredient = new pizza_ingredient();
        $listeIngredientPizzaCurrent = $pizza_ingredient->getIngredient($this->getIdPizza());
        $pizza = new pizza($this->getIdPizza());
        $pizzaCurrent = $pizza->getPizza($this->getIdPizza());
        $listeIngredient = $this->composition(new ingredients());
        $listeBase = $this->composition(new base());
        $listePate = $this->composition(new pate());
        $listeTaille = $this->composition(new taille());
        $detailPizza = new pizza();
        // On appelle la methode save pizza
        $this->savePizza();
        $this->calculSum();
        include ROOT . "/templates/views/CreerTaPizza.php";
    }
    /**
     * Rôle : Enregistrer les données du formulaire
     * @param neant
     * @return neant
     */
    public function savePizza()
    {
        // Paramètre du controleur: $_POST (base, taille, pate)
        //instanciation des class
        $pizza_ingredient = new pizza_ingredient();
        $listeIngredientPizzaCurrent = $pizza_ingredient->getIngredient($this->getIdPizza());
        $pizza = new pizza($this->getIdPizza());
        $pizzaCurrent = $pizza->getPizza($this->getIdPizza());
        $listeIngredient = $this->composition(new ingredients());
        $listeBase = $this->composition(new base());
        $listePate = $this->composition(new pate());
        $listeTaille = $this->composition(new taille());
        $pizza_ingredient = new pizza_ingredient();
        $detailPizza = new pizza();
        if (!empty($_POST)) {
            $taille = $_POST["taille"];
            $pate = $_POST["pate"];
            $base = $_POST["base"];
            $pizza->set("taille", $taille);
            $pizza->set("pate", $pate);
            $pizza->set("base", $base);    
            $pizza->set("prix", $this->calculSum());
        }
        $this->modifierIngredient();
        $pizza->update();
    }
    //gestion des erreurs
    function error()
    {
        //utilse la methode display pour afficher les errors
        $error = new errorManager();
        $error->display("templates/views/error.php", ["message" => "essai de message"]);
    }
    function composition($nom)
    {
        // Rôle : Afficher la liste des ingrédients
        // Paramètre : Néant
        // Retour : Néant
        $data = $nom;
        $listeData = $data->listAll();
        return $listeData;
    }
    function createNewPizza()
    {
        // creer un nouvelle objet dans la base de donnée 
        // paramètre : Néant
        // retour : Néant
        $pizza = new pizza();
        $pizza->set("utilisateur", "0");
        $pizza->set("taille", "1");
        $pizza->set("base", "2");
        $pizza->set("pate", "2");
        $pizza->set("prix", "7.90");
        $pizza = $pizza->insert();
        return $pizza;
    }
    /**
     * Rôle : Calculer la somme des prix des ingrédients
     * @paran neant
     * @return string $sum(resultat du tableau )
     */
    function calculSum()
    {
        // Rôle : Calculer la somme des prix des ingrédients
        // Paramètre :  neant
        // Retour : num ( la somme du tableau)
        $pizza = new pizza();
        $pizzaCurrent = $pizza->getTablePizza($this->getIdPizza());
        $listeIngredient = $this->currentPizza->getIngredient($this->getIdPizza());
        $prixIngredient = [];

        foreach($listeIngredient as $ingredient){
            $prixIngredient[] = $ingredient["prix"];
        }
        $sumIngredient = array_sum($prixIngredient);
        
        $resultPizza = [
            "taille_prix" => $pizzaCurrent["taille_prix"],
            "pate_prix" => $pizzaCurrent["pate_prix"],
        ];
        $sumPizza = array_sum($resultPizza);
        return $sumPizza + $sumIngredient;
    }
    /**
     * rôle : supprime un ingrédient s'il existe dans la bdd, sinon il l'ajoute
     * @param neant
     * @return neant
     */
    function modifierIngredient()
    {
        // param du controlleur : $_POST["ingredient"]
        //instanciation de la classe pizza ingredient
        $pizza_ingredient = new pizza_ingredient();
        // Liste des ingrédients selectinner par l'id de la pizza
        $allIngredients = $pizza_ingredient->ingredientParPizza($this->getIdPizza());
        // Liste des ingrédients cochés
        $ingredientCoche = isset($_POST["ingredient"]) ? $_POST["ingredient"] : [];
        // Liste des ingrédients à supprimer (ceux non cochés)
        $ingredientsASupprimer = array_diff($allIngredients, $ingredientCoche);
        // Supprimer les ingrédients décochés
        foreach ($ingredientsASupprimer as $value) {
            $ingredient = new pizza_ingredient();
            if ($ingredient->search($value, $this->getIdPizza()) && $_POST != null) {
                $ingredient->load($ingredient->getId());
                $ingredient->delete();
            }
        }
        // Ajouter les ingrédients cochés
        foreach ($ingredientCoche as $value) {
            $ingredient = new pizza_ingredient();
            if (!$ingredient->search($value, $this->getIdPizza())) {
                $ingredient->set("id_ingredient", $value);
                $ingredient->set("id_pizza", $this->getIdPizza());
                $ingredient->insert();
            }
        }
    }
    /**
     * role : enregistre etpreparer le JSON 
     * @param neant
     * @return neant
     */
    function prepareJSON()
    {
        $this->calculSum();
        $this->savePizza();
        $pizza = new pizza();
        $pizzaCurrent = $pizza->getTablePizza($this->getIdPizza());
        $pizza_ingredient = new pizza_ingredient();
        $listeIngrdient = $pizza_ingredient->loadListIngredient($this->getIdPizza());
        $tabIngredient = [];
        foreach ($listeIngrdient as $key => $value) {
            $tabIngredient[$key] = $value;
        };
        $resultPizza = [
            "id_pizza" => $this->getIdPizza(),
            "type_pate" => $pizzaCurrent["pate"],
            "taille" => $pizzaCurrent["taille"],
            "base" => $pizzaCurrent["base"],
            "taille_prix" => $pizzaCurrent["taille_prix"],
            "pate_prix" => $pizzaCurrent["pate_prix"],
            "prix" => $pizzaCurrent["prix"],
        ];
        $result = [
            "ingredients" => $tabIngredient,
            "pizza" => $resultPizza,
        ];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}
