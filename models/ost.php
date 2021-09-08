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
    public $id_Composer = 0; //FK composerList
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
    public function getOSTList()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `op`.`id`, `ost`.`id` , `ost`.`name` AS `ostName`, `album`, `date` , `path` , `title` , `alt` , `category`.`name` AS `categoryName` , `categorizedby`.`id_OST` , `composerlist`.`id_OST` , `lastname` , `firstname` , `id_Composer`
           FROM `ost`
           LEFT JOIN `ostpicture` AS `op`
           ON `id_OSTPicture` = `op`.`id`
           LEFT JOIN `categorizedby`
           ON `ost`.`id` = `categorizedby`.`id_OST`
           LEFT JOIN `category`
           ON `categorizedby`.`id` = `category`.`id`
           LEFT JOIN `composerlist`
           ON `ost`.`id` = `composerlist`.`id_OST`
        LEFT JOIN `composer`
            ON `composer`.`id` = `id_Composer`
           ORDER BY `album`'
        );
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }

    public function getOSTInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `op`.`id`, `ost`.`id` , `ost`.`name` AS `ostName`, `album`, `date` , `buy_link` , `music_link` , `path` , `title` , `alt` , `category`.`name` AS `categoryName` , `categorizedby`.`id_OST` , `composerlist`.`id_OST` , `lastname` , `firstname` , `id_Composer`
            FROM `ost`
            LEFT JOIN `ostpicture` AS `op`
            ON `id_OSTPicture` = `op`.`id`
            LEFT JOIN `categorizedby`
            ON `ost`.`id` = `categorizedby`.`id_OST`
            LEFT JOIN `category`
            ON `categorizedby`.`id` = `category`.`id`
            LEFT JOIN `composerlist`
            ON `ost`.`id` = `composerlist`.`id_OST`
         LEFT JOIN `composer`
             ON `composer`.`id` = `id_Composer`
             WHERE `ost`.`id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }
}
