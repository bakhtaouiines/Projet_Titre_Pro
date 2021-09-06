<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/user.php';

$article = new Article();
$articlesList = $article->getArticlesList();