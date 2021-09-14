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
    $content = '';
    //Je récupère les données du formulaire
    if (isset($_POST['miniPostContent'])) {
        $miniPostContent = htmlspecialchars($_POST['miniPostContent']);
    }
    //Je vérifie le content du commentaire
    $minipostForm->isNotEmpty('miniPostContent', $miniPostContent);
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($minipostForm->isValid()) {
 
        $comment->__set('miniPostContent', $miniPostContent);
        $comment->createMiniPost();
    }
}
