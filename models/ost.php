<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Ost
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $name = '';
    public $album = '';
    public $date = '';
    public $buy_link = '';
    public $music_link = '';
    public $title = '';
    public $path = '';
    public $alt = '';
    public $id_OSTPicture  = 0; // FK ostPicture
    public $id_OST = 0; //FK category
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Méthode pour récupérer les informations d'une OST afin de toutes les lister
     *
     * @return string
     */
    public function getOSTInfo()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `op`.`id`, `ost`.`name` AS `ostName`, `album`, `date` , `buy_link` , `music_link`,  `path` , `title` , `alt` , `id_OSTPicture` , `category`.`name` AS `categoryName` , `category`.`id` , `categorizedby`.`id_OST` , `composerlist`.`id_OST`
           FROM `ost`
           LEFT JOIN `ostpicture` AS `op`
           ON `id_OSTPicture` = `op`.`id`
           LEFT JOIN `categorizedby`
           ON `categorizedby`.`id_OST` = `ost`.`id`
           LEFT JOIN `category`
           ON `category`.`id` = `categorizedby`.`id_OST`
           LEFT JOIN `composerlist`
           ON `ost`.`id` = `composerlist`.`id_OST`
           LEFT Join `composer`
           ON `composer.id` = `id_Composer`
           ORDER BY `album`'
        );
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOneOSTInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `op`.`id`, `ost`.`id` AS `ostId` , `ost`.`name` AS `ostName`, `album`, `date` , `buy_link` , `music_link`,  `path` , `title` , `alt` , `id_OSTPicture` , `category`.`name` AS `categoryName`
           FROM `ost`
           LEFT JOIN `ostpicture` AS `op`
           ON `id_OSTPicture` = `op`.`id`
           LEFT JOIN `categorizedby`
           ON `id_OST` = `ost`.`id`
           LEFT JOIN `category`
           ON `category`.`id` = `id_OST`
           LEFT JOIN `composerlist`
           ON `id_OST` = `ost`.`id`
           LEFT Join `composer`
           ON `composer.id` = `id_Composer`
           AND `ostId` = :ostId'
        );
        $pdoStatment->bindValue(':ostId', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
