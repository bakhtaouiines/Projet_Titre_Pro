<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/user.php';

/**
 * Récupération des informations de l'article + auteur + images
 */
$article = new Article();
$article->id = $_GET['articleID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$articleInfo = $article->getArticleInfo();






