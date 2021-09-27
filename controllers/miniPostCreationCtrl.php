<?php
// Je charge ici les modèles et classes
require_once 'config.php';
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'models/ost.php';
require_once 'classes/form.php';

$minipost = new MiniPost();
$minipostForm = new Form();
$message = '';

/**
 *  Vérifications du formulaire d'écriture de minipost
 */
if (isset($_POST['submitMiniPost'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['miniPostContent'])) {
        $miniPostContent = $_POST['miniPostContent'];
        //Je vérifie le content du minipost
        $minipostForm->isNotEmpty('content', $miniPostContent);
    } else {
        $minipostForm->error['content'];
    }
    if (isset($_POST['resultSearch'])) {
        $resultSearch = htmlspecialchars($_POST['resultSearch']);
        if (empty($resultSearch)) {
            $message = 'Veuillez choisir une musique s\'il vous plait!';
        }
    }
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($minipostForm->isValid()) {
        $minipost->__set('content', $miniPostContent);
        $minipost->__set('id_OST', $resultSearch);
        $minipost->__set('id_User', $_SESSION['user']['id']);
        $minipost->createMiniPost();
        // redirection au bout de 3s sur la page des miniposts
        header('Refresh:3; url=../miniPostList.php');
    } else {
        $message = 'Une erreur est survenue!';
    }
}
