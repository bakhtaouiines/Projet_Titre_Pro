<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';
require_once 'models/ostPicture.php';
require_once 'models/category.php';
require_once 'models/composerList.php';

/**
 * Récupération des informations de l'article
 */
$ost = new Ost();
$ost->id = $_GET['ostID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$ost->getOSTInfo();

/**
 * Récupération des informations du compositeur
 */


/**
 * Récupération de la catégorie
 */
$category = new Category();
$category->id = $ost->id_OST;
$categoryName = $category->getCategory();

/**
 * Récupération de l'image d'album
 */
$cover = new OstPicture();
$cover->id = $ost->id_OSTPicture;
$coverInfo = $cover->getOSTPicture();