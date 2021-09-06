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
    public $id_OSTPicture  = 0; // FK ostPicture
    public $id_OST = 0; //FK category
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Méthode pour lister les OST
     *
     * @return string
     */
    public function getOSTList()
    {
        // On récupère le contenu qui nous intéresse, de la table ost
        $pdoStatment = $this->pdo->query(
            'SELECT `id`, `name`, `album`, `date` , `buy_link` , `music_link`
           FROM `ost`
           ORDER BY `album` ASC'
        );
        // On retourne un tableau contenant toutes les lignes du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.
        // FETCH_OBJ retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats

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
            'SELECT `id`, `name`, `album`, `date` , `buy_link` , `music_link`
           FROM `ost`
           WHERE `id` = :id'
        );
        $pdoStatment->bindParam(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        $ost = $pdoStatment->fetch(PDO::FETCH_OBJ);
        $this->name = $ost->name;
        $this->album = $ost->album;
        $this->date = $ost->date;
        $this->buy_link = $ost->buy_link;
        $this->music_link = $ost->music_link;
    }
}
