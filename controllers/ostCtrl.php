<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';
require_once 'models/ostPicture.php';
require_once 'models/category.php';
require_once 'models/composerList.php';

/**
 * Récupération des informations de l'OST
 */
$ost = new Ost();
$ost->ostId = $_GET['ostID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'OST
$ostInfo = $ost->getOneOSTInfo();

/**
 * Récupération des informations du compositeur
 */
