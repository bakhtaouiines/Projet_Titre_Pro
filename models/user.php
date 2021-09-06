<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class User
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $pseudo = '';
    public $mail = '';
    public $password_hash = '';
    public $avatar = '';
    public $hash = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

    /**
     * Methode permettant d'enregistrer un utilisateur
     *
     * @return boolean
     */
    public function addUser()
    {
        $pdoStatment = $this->pdo->prepare(
            'INSERT INTO `user`(`pseudo`, `mail`, `password_hash`, `hash`) 
            VALUES(:pseudo, :mail, :password_hash, :hash)'
        );
        $pdoStatment->bindValue(':pseudo', $this->pseudo, PDO::PARAM_STR);
        $pdoStatment->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatment->bindValue(':password_hash', $this->password_hash, PDO::PARAM_STR);
        $pdoStatment->bindValue(':hash', $this->hash, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $this->pdo->lastInsertId();
    }
    /**
     * Méthode permettant de récupérer les informations d'un utilisateur via l'ID
     *
     * @return string
     */
    public function getUserInfoById()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `id`, `pseudo`, `avatar`
            FROM `user`
            WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
        // On retourne une ligne depuis un jeu de résultats associé à l'objet 
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Methode permettant de récupérer la clé de hachage du mot de passe
     * @return string
     */
    public function getUserHash()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `password_hash` 
            FROM `user` 
            WHERE `mail` = :mail'
        );
        $pdoStatment->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatment->execute();
        // On retourne un tableau contenant la/les ligne(s) du jeu d'enregistrements. Le tableau représente chaque ligne comme soit un tableau de valeurs des colonnes, soit un objet avec des propriétés correspondant à chaque nom de colonne.
        // FETCH_OBJ retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats
        return $pdoStatment->fetch(PDO::FETCH_OBJ)->password_hash;
    }


    /**
     * Méthode permettant de récupérer les informations d'un utilisateur via le mail
     *
     * @return string
     */
    public function getUserInfoByMail()
    {
        $pdoStatment = $this->pdo->prepare(
            'SELECT `pseudo`, `mail`
            FROM `user` 
            WHERE `mail` = :mail'
        );
        $pdoStatment->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $pdoStatment->execute();
        return $pdoStatment->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Méthode pour modifier les infos d'un utilisateur
     *
     * @return string
     */
    public function updateUserInfo()
    {
        $pdoStatment = $this->pdo->prepare(
            'UPDATE `user` 
             SET `pseudo` = :pseudo, `avatar` = :avatar 
             WHERE `id` = :id'
        );
        $pdoStatment->bindValue(':pseudo', $this->lastname, PDO::PARAM_STR);
        $pdoStatment->bindValue(':avatar', $this->firstname, PDO::PARAM_STR);
        $pdoStatment->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatment->execute();
    }
}
