<?php
require_once 'models/mainModel.php';
require_once 'models/ost.php';

/**
 * Récupération des OST avec leur catégorie, leur image d'album, compositeur
 */
$ost = new Ost();

/**
 * Barre de recherche
 */
$searchOstList = '';
$ostFilter = ['album'];
if (!empty($_GET['searchOst'])) {
    if (!empty($_GET['ostFilter'])) {
        $ostFilter = $_GET['ostFilter'];
    }
    $ostFilterString = implode('&ostFilter%5B%5D=', $ostFilter); // rassemble les éléments d'un tableau en une chaîne, %5B%5D = []
    $searchOstList = htmlspecialchars($_GET['searchOst']);
    $searchOstList = trim($searchOstList); // supprime les espaces dans la requête AVANT ou APRES
    
}

/**
 * Pagination
 */
// On détermine le nombre d'OST par page
$numberOSTPerPage = 9;
// On détermine sur quelle page on se trouve
// On récupère le nombre d'OST
$numberOfPages = $ost->totalPagesOST($searchOstList, $numberOSTPerPage, $ostFilter);
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
    $ostList = $ost->infoPageOST($firstsOst, $numberOSTPerPage, $searchOstList, $ostFilter);
}