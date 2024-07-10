<?php

namespace utils;

use ErrorException;
use Exception;
use Throwable;

class errorManager
{
    public $error;
    public $errorLine;
    public $errorFile;

    // Constructeur de la classe
    // Enregistre les gestionnaires d'exceptions et d'erreurs
    public function __construct()
    {
        set_exception_handler([$this, 'handleException']);
        set_error_handler([$this, 'handleError']);
    }

    /** Méthode pour afficher un template
     * @param string $template - Chemin du fichier de template à inclure
     * @param array $param - Tableau de paramètres à passer au template (non utilisé ici)
     * @return bool - Retourne true si l'affichage est réussi, false en cas d'erreur
     */
    public function display($template, $param = [])
    {
        try {
            // Démarre la capture de la sortie
            ob_start();
            // Inclut le fichier de template
            include $template;
            // Envoie le contenu du tampon de sortie et termine la capture
            ob_end_flush();
            return true;
        } catch (Throwable $e) {
            // En cas d'exception, enregistre l'erreur et nettoie le tampon de sortie
            $this->logError($e);
            ob_end_clean();
            return false;
        }
    }

    /** Gestionnaire d'exceptions
     * @param Throwable $e - L'exception interceptée
     */
    public function handleException($e)
    {
        // Affiche les détails de l'exception
        echo "Exception interceptée par le handler<br>";
        echo "Erreur : " . $e->getMessage() . " sur " . $e->getFile() . ":" . $e->getLine();
        echo "<b>backTrace</b><pre>";
        print_r($e->getTrace());
        echo "</pre>";

        // Enregistre l'exception dans le fichier de log
        $this->logError($e);
    }

    /** Gestionnaire d'erreurs
     * @param int $errno - Numéro de l'erreur
     * @param string $errmsg - Message de l'erreur
     * @param string $file - Fichier dans lequel l'erreur s'est produite
     * @param int $line - Ligne du fichier où l'erreur s'est produite
     * @param array $context - Contexte de l'erreur (non utilisé ici)
     * @return bool - Retourne true pour indiquer que l'erreur a été traitée
     */
    public function handleError($errno, $errmsg, $file, $line, $context)
    {
        // Affiche les détails de l'erreur
        echo "Erreur $errno ($errmsg) interceptée dans $file:$line par le handler<br>";
        echo "<b>backTrace</b><pre>";
        print_r(debug_backtrace());
        echo "</pre>";

        // Enregistre l'erreur en tant qu'exception dans le fichier de log
        $this->logError(new ErrorException($errmsg, 0, $errno, $file, $line));
        return true;
    }

    /** Méthode pour enregistrer une erreur ou une exception dans le fichier de log
     * @param Throwable $e - L'erreur ou l'exception à enregistrer
     */
    private function logError(Throwable $e)
    {
        //Crée un message d'erreur détaillé
        $errorMessage = sprintf(
            "[%s] %s in %s on line %d\nStack trace:\n%s\n\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $e->getFile(),
            $e->getLine(),
            $e->getTraceAsString()
        );
        // Écrit le message d'erreur dans le fichier de log
        file_put_contents('error.log', $errorMessage, FILE_APPEND);
        // error_log($errorMessage, 3, "error.log");
    }
}
