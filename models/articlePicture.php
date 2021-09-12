<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class ArticlePicture extends MainModel
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
        parent::__construct();
    }

    /**
     * Méthode pour récupérer les informations d'une image
     *
     * @return string
     */
    public function getArticlePicture()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `id`, `title`, `path`, `alt`, `id_Article`
           FROM `articlepicture`'
        );  
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
