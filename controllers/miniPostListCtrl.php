<?php
require_once 'models/mainModel.php';
require_once 'models/minipost.php';
require_once 'models/ost.php';

$minipost = new MiniPost();
// on fait appel ici à la session pour que l'affichage des mini-posts ne se fassent qu'à leurs auteurs
$minipostList = $minipost->getMiniPostList($_SESSION['user']['id']);
