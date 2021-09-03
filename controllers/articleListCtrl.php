<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$article = new Article();
$articleList = $article->getArticlesList();