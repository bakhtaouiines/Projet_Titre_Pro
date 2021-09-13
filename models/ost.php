<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class Ost extends MainModel
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
        parent::__construct();
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

    /**
     * Méthode pour récupérer les informations d'une OST
     *
     * @return string
     */
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

    /**
     * Méthode permettant d'avoir le nombre de pages à afficher. Elle a besoin de plusieurs paramètres pour fonctionner.
     *
     * @param string $searchOstList = l'input de recherche
     * @param integer $numberOSTPerPage = nombre d'ost par page
     * @param array $ostFilter = filtre les ost , 'album' indique le filtre par défaut (au cas où rien est sélectionné)
     * @return int
     */
    public function totalPagesOST($searchOstList, $numberOSTPerPage = 8, $ostFilter = ['album'])
    {
        $where = '';
        if ($searchOstList != '') {
            $whereArray = [];
            foreach ($ostFilter as $filter) {
                // ceci va permettre d'avoir par exemple : `album` LIKE `:searchOstList`(etc)
                $whereArray[] = '`' . $filter . '` LIKE :searchOstList ';
            }
            // implode = transforme le tableau whereArray en chaîne de caractères 
            $where = 'WHERE ' . implode(' OR ', $whereArray);
        }
        $totalPages = $this->pdo->prepare(
            'SELECT COUNT(*) / :numberOSTPerPage
            AS numberPages
        FROM `ost` ' . $where
        ); // nombre de pages = nombre d'ost totales divisé par nombre d'ost par page
        // on concatène avec une chaîne vide (s'il n'y a pas de recherches) ou avec ce qui a été recherché ($whereArray)
        $totalPages->bindValue(':numberOSTPerPage', $numberOSTPerPage, PDO::PARAM_INT);
        if ($searchOstList != '') {
            $totalPages->bindValue(':searchOstList', '%' . $searchOstList . '%', PDO::PARAM_STR);
        }
        $totalPages->execute();
        $result = $totalPages->fetch(PDO::FETCH_OBJ);
        return ceil($result->numberPages); // ceil = arrondit au supérieur
    }
    public function infoPageOST($firstsOst, $numberResultsPage, $searchOstList, $ostFilter = ['album'])
    {
        $where = '';
        if ($searchOstList != '') {
            $whereArray = [];
            foreach ($ostFilter as $filter) {
                $whereArray[] = '`' . $filter . '` LIKE :searchOstList ';
            }
            $where = 'WHERE ' . implode(' OR ', $whereArray);
        }
        $infoPage = $this->pdo->prepare(
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
             ON `composer`.`id` = `id_Composer`'
                . $where
                . 'ORDER BY `album`
            LIMIT :numberResultsPage
            OFFSET :firstsOst'
        );
        $infoPage->bindValue(':numberResultsPage', $numberResultsPage, PDO::PARAM_INT);
        $infoPage->bindValue(':firstsOst', $firstsOst, PDO::PARAM_INT);
        if ($searchOstList != '') {
            $infoPage->bindValue(':searchOstList', '%' . $searchOstList . '%', PDO::PARAM_STR);
        }
        $infoPage->execute();
        return $infoPage->fetchAll(PDO::FETCH_OBJ);
    }
}
