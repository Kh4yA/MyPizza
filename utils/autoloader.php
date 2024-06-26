<?php

namespace core;

class autoloader
{
    /**
     * Function qui enregister l'autoloader
     */
    static function registrer()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
    /**
     * function qui cherche le fichier a inclure
     * @param $class (string) le nom de la class a charger 
     */
    static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
            // je creer des modeles de chemins et test si ils exixtent
            $cheminModeles = __DIR__ . '/../modeles' . $class . '.php';
            $cheminInit = __DIR__ . '/../init' . $class . '.php';
            $cheminParentClass = __DIR__ . '/../parentClass' . $class . '.php';
            if (file_exists($cheminModeles)) {
                include $cheminModeles;
                echo "je charge $cheminModeles";
                return;
            } elseif (file_exists($cheminInit)) {
                include $cheminInit;
                echo "je charge $cheminInit";
                return;
            } elseif ($cheminParentClass) {
                include $cheminParentClass;
                echo "je charge $cheminParentClass";
                return;
            }
        }
    }
}
