<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';

/**
 * Récupération des OST avec leur catégorie, leur image d'album, compositeur
 */
$ost = new Ost();
$ostInfo = $ost->getOSTList();
