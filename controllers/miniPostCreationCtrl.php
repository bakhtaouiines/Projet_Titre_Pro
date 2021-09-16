<?php
require_once 'config.php';
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';
require_once 'models/ost.php';
require_once 'classes/form.php';

$ost = new ost;
$minipost = new MiniPost();
$minipostForm = new Form();

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
        echo 'Mini-Post Publié!';
    } else {
        echo 'Une erreur a été identifié.';
    }
}
