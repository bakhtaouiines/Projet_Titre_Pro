<?php
require_once 'models/mainModel.php';
require_once 'models/miniPost.php';

$minipost = new MiniPost();

/**
 * Création du mini-post
 */
//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];
if (isset($_POST['submitMiniPost'])) {
    if (!empty($_POST['miniPostContent'])) {
        $minipost->content = htmlspecialchars($_POST['miniPostContent']);
    } else {
        $formErrorList['submitMiniPost'] = 'Contenu manquant';
    }

    if (empty($formErrorList)) {
        $minipost->createMiniPost();
    }
}
