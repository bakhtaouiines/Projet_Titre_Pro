<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/article.php';
require_once 'models/comment.php';
require_once 'classes/form.php';

$message = '';
/**
 * Récupération des informations de l'article + auteur + images
 */
$article = new Article();
$article->id = $_GET['articleID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'article
$articleInfo = $article->getArticleInfo();

/**
 * Création d'un commentaire et son affichage
 */
$comment = new Comment();
$commentForm = new Form();
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

$commentList = $comment->getCommentsList($idArticle);
var_dump($idArticle);
