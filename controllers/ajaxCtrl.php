<?php
require_once '../config.php';
require_once '../models/mainModel.php';
require_once '../models/ost.php';
$ost = new ost;

/**
 * Barre de recherche AJAX
 */
$searchOst = '';
if (!empty($_GET['search'])) {
    $searchOst = htmlspecialchars($_GET['search']);
    $searchOst = trim($_GET['search']);
    echo json_encode($ost->searchOst($searchOst));
}

