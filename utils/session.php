<?php


namespace utils;


// Classe session qui gère la session
class session
{
    protected $userConnected;

    public static function session_activation()
    {
        session_start();
        // Si un utilisateur est connecté
        if (self::session_isconnected()) {
            // On charge l'objet utilisateurConnecte
            global $userConnected;
            $userConnected = new user(self::session_idconnect());
        }
    }

    public static function session_isconnected()
    {
        // Vérifie s'il y a une connexion active
        return !empty($_SESSION['id']);
    }

    public static function session_deconnected()
    {
        // Supprime les variables de session
        session_unset();
        // Détruit la session
        session_destroy();
    }

    public static function session_idconnect()
    {
        // Si une session est connectée, retourne l'id
        if (self::session_isconnected()) {
            return $_SESSION['id'];
        }
        return null;
    }

    public function session_set_idconnected($id)
    {
        // Enregistre l'id de l'utilisateur connecté
        $_SESSION['id'] = $id;
    }

    public static function session_userconnect()
    {
        // Retourne l'objet userConnected
        if (self::session_isconnected()) {
            return new user(self::session_idconnect());
        }else{
            return new user();
        }
    }
}

