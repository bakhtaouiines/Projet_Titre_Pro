<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class ComposerList
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $id_OST  = 0;
    public $id_Composer = 0;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    public function getComposerAndOST()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `id`, `id_OST`, `id_Composer`
            FROM `composerlist`'
        );
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}