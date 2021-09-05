<?php
// On charge le fichier du modèle.
require_once '../models/mainModel.php';
require_once '../models/article.php';
require_once '../models/user.php';
require_once '../models/articlePicture.php';

/**
 * Récupération des informations de l'article
 */
$article = new Article();
$article->id = $_GET['articleID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$articleInfo = $article->getArticleInfo();

/**
 * Récupération des informations de l'utilisateur
 */
$user = new User();
$user->id = $article->id_User;
// de même pour les infos de l'utilisateur
$userInfo = $user->getUserInfoById();

/**
 * Récupération des informations de l'image
 */
$picture = new ArticlePicture();
$article->id_Article = $picture->id;
$pictureInfo = $picture->getArticlePictureInfo();
