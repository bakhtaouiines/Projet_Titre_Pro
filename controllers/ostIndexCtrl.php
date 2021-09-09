<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/ost.php';

/**
 * Récupération des OST avec leur catégorie, leur image d'album, compositeur
 */
$ost = new Ost();
$ostInfo = $ost->getOSTList();

/**
 * Barre de recherche
 */
$searchOst = '';
$ostFilter = ['album'];
if (!empty($_GET['searchOst'])) {
    if (!empty($_GET['ostFilter'])) {
        $ostFilter = $_GET['ostFilter'];
    }
    $ostFilterString = implode('&ostFilter%5B%5D=', $ostFilter);
    $searchOst = htmlspecialchars($_GET['searchOst']);
    $searchOst = trim($searchOst); // supprime les espaces dans la requête AVANT ou APRES
    
}

/**
 * Pagination
 */
// On détermine le nombre d'articles par page
$numberOSTPerPage = 10;
// On détermine sur quelle page on se trouve
// On récupère le nombre de patients
$numberOfPages = $ost->totalPagesOST($searchOst, $numberOSTPerPage, $ostFilter);
$isCorrectPage = true;
if (!empty($_GET['page'])) {
    if ($_GET['page'] >= 1 && $_GET['page'] <= $numberOfPages) {
        $currentPage = htmlspecialchars($_GET['page']);
    } else {
        $isCorrectPage = false;
    }
} else {
    $currentPage = 1;
}
if ($isCorrectPage) {
    // Calcul du 1er affichage de la page
    $firstsOst = ($currentPage * $numberOSTPerPage) - $numberOSTPerPage;
    // On récupère les valeurs
    $ostList = $ost->infoPageOST($firstsOst, $numberOSTPerPage, $searchOst, $ostFilter);
}