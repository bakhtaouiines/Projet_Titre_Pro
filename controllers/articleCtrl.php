<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/user.php';
require_once 'models/comment.php';
require_once 'classes/form.php';

/**
 * Récupération des informations de l'article + auteur + images
 */
$article = new Article();
$article->id = $_GET['articleID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$articleInfo = $article->getArticleInfo();
$comment = new Comment();
$commentList = $comment->getCommentsList();
$commentForm = new Form();
/**
 *  Vérifications du formulaire d'écriture de commentaire
 */
if (isset($_POST['submitComment'])) {
    $content = '';
    //Je récupère les données du formulaire
    if (isset($_POST['content'])) {
        $content = htmlspecialchars($_POST['content']);
    }
    //Je vérifie le content du commentaire
    $commentForm->isNotEmpty('content', $content);
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($commentForm->isValid()) {
 
        $comment->__set('content', $content);
        $comment->addComment();
    }
}

