<?php
class MiniPost extends MainModel
{
    public $id = 0;
    public $content = '';
    public $id_User = 0;
    public $id_OST = 0;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Methode permettant de créer un mini-post
     *
     * @return boolean
     */
    public function createMiniPost()
    {
        $pdoStatment = $this->pdo->prepare(
            'INSERT INTO `minipost`(`content`, `id_User`, `id_OST`)
            VALUES(:content, :id_User, :id_OST)'
        );
        $pdoStatment->bindValue(':content', $this->content, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id_User', $this->id_User, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id_OST', $this->id_OST, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Méthode pour lister les mini-posts d'un utilisateur
     *
     * @return string
     */
    public function getMiniPostList($idUser)
    {
        // On récupère le contenu qui nous intéresse, de la table minipost
        $pdoStatment = $this->pdo->prepare(
            'SELECT `minipost`.`id`, `content`, `id_User`, `id_OST`, `path` , `alt` ,`title`, `ost`.`name` AS `ostName`
           FROM `minipost`
           LEFT JOIN `ost`
            ON `minipost`.`id_OST` = `ost`.`id`
            LEFT JOIN `ostpicture` AS `op`
            ON `op`.`id` = `ost`.`id_OSTPicture`
            WHERE `id_User` = :id_User
           ORDER BY `id`'
        );
        $pdoStatment->bindValue(':id_User', $idUser, PDO::PARAM_STR);
        $pdoStatment->execute();
        // On retourne un tableau contenant toutes les lignes du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.
        // FETCH_OBJ retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour récupérer les informations d'un mini-post
     *
     * @return string
     */
    public function getMiniPostInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `minipost`.`id`, `content`, `id_User` , `pseudo`, `op`.`id`, `path` , `alt` , `id_OST`, `title`, `ost`.`name` AS `ostName`
            FROM `minipost`
            LEFT JOIN `user`
            ON `minipost`.`id_User` = `user`.`id`
            LEFT JOIN `ost`
            ON `minipost`.`id_OST` = `ost`.`id`
            LEFT JOIN `ostpicture` AS `op`
            ON `op`.`id` = `ost`.`id_OSTPicture`
            WHERE `minipost`.`id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Méthode pour modifier un minipost
     *
     * @return void
     */
    public function updateMiniPost()
    {
        $pdoStatment = $this->pdo->prepare(
            'UPDATE `minipost`
            SET `content` = :content
            WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':content', $this->content, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $pdoStatment->execute();
    }

    /**
     * Méthode pour supprimer un minipost
     *
     * @return void
     */
    public function deleteMiniPost()
    {
        $pdoStatment = $this->pdo->prepare(
            'DELETE FROM `minipost`
            WHERE `id`= :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
    }

    /**
     * Méthode pour lister les mini-posts des utilisateurs dans la catégorie sélectionnée
     *
     */
    public function getMiniPosts($idCategory)
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `minipost`.`id`, `content`, `id_User`, `pseudo`, `minipost`.`id_OST`, `path` , `alt` ,`title`, `ost`.`name` AS `ostName`
                FROM `minipost`
            LEFT JOIN `ost`
                ON `minipost`.`id_OST` = `ost`.`id`
            LEFT JOIN `ostpicture` AS `op`
                ON `op`.`id` = `ost`.`id_OSTPicture`
            LEFT JOIN `categorizedby`
                ON `ost`.`id` = `categorizedby`.`id_OST`
            LEFT JOIN `category`
                ON `categorizedby`.`id` = `category`.`id`
            LEFT JOIN `user`
                ON `id_User` = `user`.`id`
            WHERE `category`.`id` = :id
            ORDER BY `ostName`'
        );
        $pdoStatment->bindValue(':id', $idCategory, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode pour afficher les mini-posts dans le dashboard de l'administrateur
     *
     * @return void
     */
    public function miniPosts()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `minipost`.`id` AS `miniPostID`, `content`, `id_User`, `pseudo`, `minipost`.`id_OST`, `path` , `alt` ,`title`, `ost`.`name` AS `ostName`
                FROM `minipost`
            LEFT JOIN `ost`
                ON `minipost`.`id_OST` = `ost`.`id`
            LEFT JOIN `ostpicture` AS `op`
                ON `op`.`id` = `ost`.`id_OSTPicture`
            LEFT JOIN `categorizedby`
                ON `ost`.`id` = `categorizedby`.`id_OST`
            LEFT JOIN `category`
                ON `categorizedby`.`id` = `category`.`id`
            LEFT JOIN `user`
                ON `id_User` = `user`.`id`
            ORDER BY `ostName`'
        );
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }
}
