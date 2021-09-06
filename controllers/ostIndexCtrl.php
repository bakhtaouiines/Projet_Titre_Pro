<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';
require_once 'models/ostPicture.php';
require_once 'models/category.php';
require_once 'models/composerList.php';
require_once 'models/composer.php';


/**
 * Récupération des OST
 */
$ost = new Ost();
$ostIndex = $ost->getOSTList();

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

/**
 * Récupération du compositeur
 */
$composer = new Composer();
$composerList = $composer->getComposerInfo();