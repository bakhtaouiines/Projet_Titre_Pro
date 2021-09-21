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
 * Affichage de l'article, l'auteur, et les images
 */
$article->id = $_GET['articleID'];
$articleInfo = $article->getArticleInfo();

/**
 *  Vérifications du formulaire d'écriture de commentaire
 */
if (isset($_POST['submitComment'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['content'])) {
        $content = ($_POST['content']);
    }
    //Je vérifie le content du commentaire
    $commentForm->isNotEmpty('content', $content);
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($commentForm->isValid()) {
        $comment->__set('content', $content);
        $comment->__set('id_User', $_SESSION['user']['id']);
        $comment->__set('id_Article', $_GET['articleID']);
        $comment->addComment();
        $message = 'Commentaire Publié!';
    } else {
        echo 'Une erreur a été identifié.';
    }
}

/**
 * Affichage des commentaires
 */
if (!empty($_GET['articleID'])) {
$commentList = $comment->getCommentsList($_GET['articleID']);
}

