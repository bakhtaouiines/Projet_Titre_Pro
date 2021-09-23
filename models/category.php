<?php
class Category extends MainModel
{
    public $id = 0;
    public $name = '';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Méthode permettant de récupérer les noms des catégories
     */
    public function getCategoryName()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `name`
            FROM `category`
            WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
