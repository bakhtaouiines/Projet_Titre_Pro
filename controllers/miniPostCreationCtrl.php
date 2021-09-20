<?php
// Je charge ici les 
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
    $miniPostContent = '';
    $resultSearch = '';
    //Je récupère les données du formulaire
    if (isset($_POST['miniPostContent'])) {
        $miniPostContent = ($_POST['miniPostContent']);
    }
    if (isset($_POST['resultSearch'])) {
        $resultSearch = htmlspecialchars($_POST['resultSearch']);
    }
    //Je vérifie le content du minipost
    $minipostForm->isNotEmpty('miniPostContent', $miniPostContent);
    $minipostForm->isNotEmpty('resultSearch', $resultSearch);
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($minipostForm->isValid()) {
        $minipost->__set('content', $miniPostContent);
        $minipost->__set('id_OST', $resultSearch);
        $minipost->__set('id_User', $_SESSION['user']['id']);
        $minipost->createMiniPost();
        echo $message = 'Mini-post bien publié!';
        // redirection au bout de 3s sur la page des minipost
        header('Refresh:3; url=../miniPost.php?=' . $_GET['minipostID']);
    } else {
        echo $message = 'Une erreur a été identifié.';
    }
}
