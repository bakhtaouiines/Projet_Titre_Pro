<?php

/**
 * Modèle principal
 */

class MainModel
{
    //L'attribut $pdo sera disponible dans ses enfants
    public $pdo = null;
    // attribut $instancep rivé et statique qui conservera l'instance unique de la classe.
    private static $instance = null;

    public function __construct()
    {

        try {
            // On se connecte à MySQL pour faire le lien avec la BDD
            $this->pdo = new PDO('mysql:host=localhost;dbname=projet_titre_pro;charset=utf8', 'root', '');
            // En cas d'erreur, on affiche un message et on arrête tout
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Méthode statique permettant de retourner l'unique instance créée 
     *
     */
    public static function getPdo()
    {
        if (is_null(self::$instance)) {
            self::$instance = new MainModel();
        }
        return self::$instance->pdo;
    }
}
