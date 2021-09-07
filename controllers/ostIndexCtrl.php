<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';
require_once 'models/ostPicture.php';
require_once 'models/composerList.php';
require_once 'models/composer.php';


/**
 * Récupération des OST avec leur catégorie, leur image d'album
 */
$ost = new Ost();
$ostInfo = $ost->getOSTInfo();

/**
 * Récupération du compositeur
 */
$composer = new Composer();
$composerList = $composer->getComposerInfo();
