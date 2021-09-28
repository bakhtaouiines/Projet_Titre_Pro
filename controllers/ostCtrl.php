<?php

require_once 'models/mainModel.php';
require_once 'models/ost.php';

/**
 * Récupération des informations de l'OST
 */
$ost = new Ost();
$ost->id = $_GET['ostID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'OST
$ostInfo = $ost->getOSTInfo();


