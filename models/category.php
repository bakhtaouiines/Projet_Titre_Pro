<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Category
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $name = '';
    public $id_OST  = 0;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Méthode permettant de récupérer les informations d'un utilisateur via l'ID
     *
     * @return string
     */
    public function getCategory()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `name`, `id_OST`
            FROM `category`
            WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }

}