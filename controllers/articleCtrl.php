<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/user.php';
require_once 'models/articlePicture.php';

/**
 * Récupération des informations de l'article
 */
$article = new Article();
$article->id = $_GET['articleID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$article->getArticleInfo();

/**
 * Récupération des informations de l'utilisateur
 */
$author = new User();
// on stocke l'id de l'utilisateur
$author->id = $article->id_User;
// de même pour les infos de l'utilisateur
$authorInfo = $author->getUserInfoById();

/**
 * Récupération de l'image
 */
$picture = new ArticlePicture();
$picture->id_Article = $article->id;
$pictureInfo = $picture->getArticlePicture();
