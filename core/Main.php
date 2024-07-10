<?php

namespace utils;
/**
 * Routeur principal
 */
class Main
{
    public function start()
    {
        // NETOYAGE D'URL POUR EVITER LE DUPLICATE CONTENT
        // on retire le "trailing slash(le dernier slash)" éventuel dans l'url
        $uri = $_SERVER["REQUEST_URI"];
        // on verifie que $uri n'est pas vide et se termine par un slash
        if (!empty($uri) &&$uri != "/" && $uri[-1] === "/") {
            // si oui on enleve le slash
            $uri = substr($uri, 0, -1);
            // on envoie un code de redirection permanente
            http_response_code(301);
            // on redirige vers l'url sans le /
            header('location: '.$uri);
        }
        // on gère les paramètres d'url
        //p=controller/method/parametre
        // on separe dans un tableau les différents paramètre dasn un tableau
        $params = [];
        if(isset($_GET["p"])){
            $params = explode('/', $_GET["p"]);
        }
        if($params[0] != ''){
            // on a au moins 1 parametres
            // On monte un tableau pour reccrer l'url
            // on reccupere le m$nom du controleur a instancier
            // on met une majuscule en premiere lettre on ajoute le namespace complet avant, on ajoute controleur après
            $controller = '\\utils\\controllers\\'.ucfirst(array_shift($params)).'controller';
            // on instancie la classe controller
            $controller = new controller();
            // on recuperer le deuxieme paramètre d'url
            $action = (isset($params[0])) ? array_shift($params) : 'index';
            if(method_exists($controller, $action)){
                // On verifie si il reste en core des paramètres (si oui on les passe a la méthode)
                (isset($params[0])) ? $controller->$action($params) : $controller->$action();
            }else{
                http_response_code(404);
                echo "La page recherchée n'éxiste pas"; 
            }
        }else{
            // on a pas de paramètres
            // on instancie le controlleur par defaut
            $controller = new controller();
            // on appelle la methose index
            $controller->home();
        }
    }
}
