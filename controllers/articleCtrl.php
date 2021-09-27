<?php
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/comment.php';
require_once 'classes/form.php';

$article = new Article();
$comment = new Comment();
$commentForm = new Form();
$message = '';

/**
 *  Vérifications du formulaire d'écriture de commentaire
 */
if (isset($_POST['submitComment'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['content'])) {
        $content = ($_POST['content']);
        //Je vérifie le content du commentaire
        $commentForm->isNotEmpty('content', $content);
        $commentForm->isValidLength('content', $content, 1, 255);
    }
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($commentForm->isValid()) {
        $comment->__set('content', $content);
        $comment->__set('id_User', $_SESSION['user']['id']);
        $comment->__set('id_Article', $_GET['articleID']);
        $comment->addComment();
        $message = 'Commentaire Publié!';
    } else {
        $commentForm->error['content'];
    }
}

/**
 * Affichage des commentaires
 */
if (!empty($_GET['articleID'])) {
    $commentList = $comment->getCommentsList($_GET['articleID']);
}

/**
 * Suppression d'un commentaire
 */
if (isset($_POST['deleteComment'])) {
    if (isset($_POST['deleteID'])) {
        $comment->id = $_POST['deleteID'];
        $comment->deleteComment();
        header('Refresh: 0');
    }
}

/**
 * Affichage de l'article, l'auteur, et les images
 */
if (!empty($_GET['articleID'])) {
    $article->id = $_GET['articleID'];
    $articleInfo = $article->getArticleInfo();
}
