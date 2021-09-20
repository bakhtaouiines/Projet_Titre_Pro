<?php
//Permet de n'autoriser l'accès à la page que si l'utilisateur est connecté et à les bons niveaux de droits
authorizedAccess(100);
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$users = new User();
$usersList = $users->getUsersList();

$article = new Article();
$articlesList = $article->getArticlesList();


/**
 * Vérification formulaire de suppression du compte
 */
if (isset($_POST['deleteUser'])) {
    // on vérifie  que l'ID de l'utilisateur a bien été récupéré dans l'URL
    if (isset($_GET['userID'])) {
        $users = new User();
        $users->id = htmlspecialchars($_GET['userID']);
        $deleteProfile = $users->deleteProfile();
        // si tout est ok, on redirige vers la page d'accueil
        header('Location: index.php');
    }
}
