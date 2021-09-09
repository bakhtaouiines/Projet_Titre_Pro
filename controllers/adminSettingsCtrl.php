<?php
//Permet de n'autoriser l'accès à la page que si l'utilisateur est connecté et à les bons niveaux de droits
authorizedAccess(100);
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$users = new User();
$usersList = $users->getUsersList();

$article = new Article();
$articlesList = $article->getArticlesList();
