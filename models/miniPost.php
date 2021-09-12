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
}
