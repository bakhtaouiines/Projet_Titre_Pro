<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Composer
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $lastname = '';
    public $firstname = '';

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    public function getComposerInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `lastname`, `firstname`
            FROM `composer`
            WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}