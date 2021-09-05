<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Article
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $title = '';
    public $content = '';
    public $id_User = 0;
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Méthode pour lister les articles
     *
     * @return string
     */
    public function getArticlesList()
    {
        // On récupère le contenu qui nous intéresse, de la table article
        $pdoStatment = $this->pdo->query(
            'SELECT `id`, `title`, `content`
           FROM `article`
           ORDER BY `id` ASC'
        );
        // On retourne un tableau contenant toutes les lignes du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.
        // FETCH_OBJ retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats
        
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour récupérer les informations d'un article
     *
     * @return string
     */
    public function getArticleInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `title`, `content` 
           FROM `article`
           WHERE `id` = :id'
        );
        $pdoStatment->bindParam(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
