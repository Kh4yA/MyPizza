<?php

namespace utils;

class Autoloader
{
    /**
     * Rôle : Charge automatiquement les classes
     * @param string $class
     */
    public static function autoloader($class)
    {
        // Vérifie si la classe commence par le namespace actuel
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            // Supprime le namespace du nom de classe
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            // Remplace les backslashes par des slashes dans le chemin de classe
            $classModele = str_replace('\\', '/', $class);
            // Création d'un tableau de chemins
            $chemins = [
                __DIR__ . '/utils/' . $classModele . '.php',
                __DIR__ . '/../modeles/' . $classModele . '.php',
                __DIR__ . '/../controllers/' . $classModele . '.php',
                __DIR__ . '/../config/' . $classModele . '.php',
                __DIR__ . '/../core/' . $classModele . '.php',
                __DIR__ . '/' . $classModele . '.php',
            ];
            foreach ($chemins as $chemin) {
                if (file_exists($chemin)) {
                    include $chemin;
                    return;
                }
            }
        }
        echo "je ne trouve aucune classe";
    }

    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoloader']);
    }
}