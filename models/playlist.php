<?php
class Playlist extends MainModel
{
    public $id = 0;
    public $name = '';
    public $description = '';
    public $id_User = 0;
    public $id_OST = 0; //table playlistList
    public $id_Playlist = 0; //table playlistList

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Methode permettant de créer une playlist
     *
     * @return boolean
     */
    public function createPlaylist()
    {
        $pdoStatment = $this->pdo->prepare(
            'INSERT INTO `playlistlist`(`playlistlist`.`id`,`id_Playlist`,`id_OST`,`name`,`description`,`id_User`)
            LEFT JOIN `playlist`
            ON `playlist`.`id` = `id_Playlist`
            LEFT JOIN `ost`
            ON `ost`.`id` = `id_OST`
            LEFT JOIN `ostpicture`AS `op`
            VALUES(:id, :name, :id_Playlist,:id_OST, :name, :description, :id_User)'
        );
        $pdoStatment->bindValue(':name', $this->name, PDO::PARAM_STR);
        $pdoStatment->bindValue(':description', $this->description, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id_User', $this->id_User, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $this->pdo->lastInsertId();
    }

    /**
     * Méthode pour lister les playlist
     *
     * @return string
     */
    public function getPlaylistList()
    {
        $pdoStatment = $this->pdo->query(
            'SELECT `playlist`.`id`, `name`, `description`, `id_User`
           FROM `playlist`
           ORDER BY `name`'
        );
        return $pdoStatment->fetchAll(PDO::FETCH_OBJ);
    }
}
