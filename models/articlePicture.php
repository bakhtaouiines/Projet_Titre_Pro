<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class ArticlePicture
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $title = '';
    public $path = '';
    public $alt = '';
    public $id_Article = 0;
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Méthode pour récupérer les informations d'une image
     *
     * @return string
     */
    public function getArticlePicture()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `title`, `path`, `alt`, `id_Article`
           FROM `articlepicture`
           WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
