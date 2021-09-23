<?php
require_once 'config.php';
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'models/ost.php';
require_once 'models/category.php';

$category = new Category();
if (!empty($_GET['categoryID'])) {
    $category->id = $_GET['categoryID'];
    $categoryName = $category->getCategoryName();
}

$ost = new Ost();
if (!empty($_GET['categoryID'])) {
    $ostList = $ost->getRandomOST($_GET['categoryID']);
    $ostInfo = $ostList[rand(0, count($ostList) - 1)];
}

$miniPost = new MiniPost();
if (!empty($_GET['categoryID'])) {
    $miniPostInfo = $miniPost->getMiniPosts($_GET['categoryID']);
}
