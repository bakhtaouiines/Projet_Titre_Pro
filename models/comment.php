<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Comment extends MainModel
{

    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $content = '';
    public $date = '';
    public $id_User = 0;
    public $id_Article = 0;
    public $pseudo = '';
    public $avatar = '';
    public $table = 'comment';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Methode permettant d'enregistrer un commentaire
     *
     * @return boolean
     */
    public function addComment()
    {
        $pdoStatment = $this->pdo->prepare(
            'INSERT INTO `comment`(`comment`.`id`, `content`, `date`, `id_User`, `id_Article`) 
            VALUES(:id, :content, :date, :id_User, :id_Article)'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_STR);
        $pdoStatment->bindValue(':content', $this->content, PDO::PARAM_STR);
        $pdoStatment->bindValue(':date', $this->date, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id_User', $this->id_User, PDO::PARAM_INT);
        $pdoStatment->bindValue(':id_Article', $this->id_Article, PDO::PARAM_INT);
        $pdoStatment->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Methode permettant de lister les commentaires
     *
     * @return boolean
     */
    public function getCommentsList()
    {
        // On récupère tout le contenu de la table patients
        $pdoStatment = $this->pdo->query(
            'SELECT `comment`.`id`, `content`, `date`, `user`.`id`, `pseudo`, `avatar`
            FROM `comment`
            LEFT JOIN `user`
            ON `comment`.`id_User` = `user`.`id`
            ORDER BY `date`'
        );
        // On retourne un tableau contenant toutes les lignes du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.
        // FETCH_OBJ retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }
}