<?php
require_once 'config.php';
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'models/ost.php';
require_once 'models/category.php';

/**
 * Affichage du nom de la catégorie
 */
$category = new Category();
if (!empty($_GET['categoryID'])) {
    $category->id = $_GET['categoryID'];
    $categoryName = $category->getCategoryName();
}
/**
 * Affichage aléatoire des musiques
 */
$ost = new Ost();
if (!empty($_GET['categoryID'])) {
    $ostList = $ost->getRandomOST($_GET['categoryID']);
    $ostInfo = $ostList[rand(0, count($ostList) - 1)];
}
/**
 * Affichage des mini-posts
 */
$miniPost = new MiniPost();
if (!empty($_GET['categoryID'])) {
    $miniPostInfo = $miniPost->getMiniPosts($_GET['categoryID']);
}
