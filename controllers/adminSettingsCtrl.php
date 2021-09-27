<?php
//Permet de n'autoriser l'accès à la page que si l'utilisateur est connecté et à les bons niveaux de droits
authorizedAccess(100);
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';
require_once 'models/minipost.php';

$users = new User();
$articles = new Article();
$miniposts = new MiniPost();

/**
 * Vérification formulaire de suppression
 */
if (isset($_POST['deleteElement'])) {
    // on vérifie que l'ID de l'élément à supprimer a bien été récupéré
    if (isset($_POST['deleteID'])) {
        $users->id = $_POST['deleteID'];
        $users->deleteProfile();
        $articles->id = $_POST['deleteID'];
        $articles->deleteArticle();
        $miniposts->id = $_POST['deleteID'];
        $miniposts->deleteMiniPost();
    }
}

/**
 * Affichage des utilisateurs, articles, mini-posts
 */
$usersList = $users->getUsersList();
$articlesList = $articles->getArticlesList();
$minipostList = $miniposts->miniPosts();