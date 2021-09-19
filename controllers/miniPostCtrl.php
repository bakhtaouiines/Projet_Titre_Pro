<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'classes/form.php';

$minipostForm = new Form();
$minipost = new MiniPost();
/**
 * Récupération des informations du mini-post + pochette de l'OST et son nom
 */
$minipost->id = $_GET['minipostID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$minipostInfo = $minipost->getMiniPostInfo();

/**
 * Modification du minipost
 */
if (isset($_POST['updateMiniPost'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['updateContent'])) {
        $updateContent = $_POST['updateContent'];
        //Je vérifie le contenu du minipost
        $minipostForm->isNotEmpty('content', $updateContent);
        //Si il n'y a pas d'erreur sur le formulaire...
        if ($minipostForm->isValid()) {
            $minipost->__set('content', $updateContent);
            $minipost->updateMiniPost();
            header('Refresh:0');
        }
    }
}

/**
 * Suppression du minipost
 */
if (isset($_POST['delete'])) {
    // on vérifie  que l'ID du minipost a bien été récupéré dans l'URL
    if (isset($_GET['minipostID'])) {
        $delete = new MiniPost();
        $delete->id = htmlspecialchars($_GET['minipostID']);
        $deleteMinipost = $delete->deleteMiniPost();
        // si tout est ok, on redirige vers la page de la liste des miniposts
        header('Location: miniPostList.php');
    }
}

