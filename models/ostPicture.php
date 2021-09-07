<?php
// une classe est un modèle de données définissant la structure commune à tous les objets qui seront créés à partir d'elle. c'est un "moule" 
class OstPicture
{
    // liste d'attributs (ou "données membres")
    public $id = 0;
    public $title = '';
    public $path = '';
    public $alt = '';
    public $id_OSTPicture = 0;
    public $pdo = null;

    public function __construct()
    {
        $this->pdo = MainModel::getPdo();
    }

}
