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
            'INSERT INTO `comment`(`content`, `id_User`, `id_Article`) 
            VALUES(:content, :id_User, :id_Article)'
        );
        $pdoStatment->bindValue(':content', $this->content, PDO::PARAM_STR);
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
    public function getCommentsList($idArticle)
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `comment`.`id`, `content`, `date`, `id_User`, `pseudo`, `avatar`, `id_Article`
            FROM `comment`
            LEFT JOIN `user`
            ON `comment`.`id_User` = `user`.`id`
            WHERE `id_Article` = :id_Article
            ORDER BY `date`'
        );
        $pdoStatment->bindValue(':id_Article', $idArticle, PDO::PARAM_INT);
        $pdoStatment->execute();
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode permettant de supprimer un commentaire
     */
    public function deleteComment($idArticle, $idComment)
    {
        $pdoStatment = $this->pdo->prepare(
            'DELETE FROM `comment`
            WHERE `id`= :id 
            AND `id_Article` = :id_Article'
        );
        $pdoStatment->bindValue(':id_Article', $idArticle, PDO::PARAM_INT);
        $pdoStatment->bindValue(':id', $idComment, PDO::PARAM_INT);
        $pdoStatment->execute();
    }
}
