<?php

/**
 * Modèle principal
 */

class MainModel
{
    //Les attributs $pdo et $table seront disponibles dans les enfants
    public $pdo = null;
    public $table = null;

    public function __construct()
    {
        try {
            // On se connecte à MySQL pour faire le lien avec la BDD
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
            // En cas d'erreur, on affiche un message et on arrête tout
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Getter permettant d'avoir accès à tous les attributs de la classe
     * 
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            if ($property != 'pdo') {
                return $this->$property;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Setter permettant de modifier les attributs de la classe
     * 
     * @param string $property
     * @param mixed $value
     * @return boolean
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            if ($property != 'pdo') {
                $this->$property = $value;
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Fonction permettant de vérifier si un champ est unique
     *
     * @param [type] $field
     * @param [type] $value
     * @return boolean
     */
    public function isUnique($field, $value)
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT COUNT(*) AS `isUsed` 
            FROM ' . $this->table . ' WHERE ' . $field . ' = :' . $field
        );
        $pdoStatment->bindValue(':' . $field, $value, PDO::PARAM_STR);
        $pdoStatment->execute();
        return !$pdoStatment->fetch(PDO::FETCH_OBJ)->isUsed;
    }
    
    /**
     * Fonction permettant de vérifier si une value existe dans une table
     *
     * @param [type] $field
     * @param [type] $value
     * @return void
     */
    public function doesExist($field, $value)
    {
        $pdoStatment = $this->pdo->prepare('SELECT COUNT(*) AS `isUsed` 
        FROM ' . $this->table . ' WHERE ' . $field . ' = :' . $field);
        $pdoStatment->bindValue(':' . $field, $value, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ)->isUsed;
    }
}
