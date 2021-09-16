<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'models/ost.php';

/**
 * Récupération des informations du mini-post + pochette de l'OST et son nom
 */
$minipost = new MiniPost();
$minipost->id = $_GET['minipostID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$minipostInfo = $minipost->getMiniPostInfo();


