<?php
include 'parts/header.php';
require_once 'controllers/articleCtrl.php';
?>

<!-- affichage de l'article -->
<div class="article p-5 mt-4">
    <a href="articlelist.php" class="btn btn-outline-dark mb-3 offset-md-10" role="button">Revenir à la liste des articles</a>
    <div class="card mb-3">
        <div class="row">
            <img src="<?= $articleInfo->path ?>" class="figure-img img-fluid rounded" title="<?= $articleInfo->title ?>" alt="<?= $articleInfo->alt ?>">
            <figcaption class="figure-caption text-end"><?= $articleInfo->title ?></figcaption>
        </div>

        <div class="card-body">
            <h1 class="card-title fs-2 fst-italic"><?= $articleInfo->articleTitle ?></h1>
            <p class="card-text"><?= $articleInfo->content ?></p>
            <p class="card-text lead text-end"><?= $articleInfo->pseudo ?></p>
        </div>
    </div>
</div>

<!-- section commentaires -->

<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h2>Commentaires</h2>
                <?php
                // On affiche chaque entrée une à une
                foreach ($commentList as $value) {
                ?>
                    <div class="comment mt-4 text-justify float-left">
                        <img src="<?= $value->avatar ?>" alt="" class="rounded-circle" width="40" height="40">
                        <h4><?= $value->pseudo ?></h4><small class="text-muted fst-italic ms-3"><?= date('d-m-Y', strtotime($value->date)) ?></small>
                        <p><?= $value->content ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- espace d'écriture de commentaire -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form method="POST" id="align-form">
                    <div class="form-group p-3">
                        <h4>Laisser un commentaire:</h4>
                        <small class="fst-italic">Merci de rester bienveillant!</small>
                        <textarea name="content" id="" content cols="30" rows="5" class="form-control mt-3" style="background-color: white;"></textarea>
                    </div>
                    <!-- A afficher lorsque l'utilisateur est connecté -->
                    <?php
                    // On récupère nos variables de session
                    if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                    ?>
                        <button type="submit" id="submitComment" name="submitComment" class="btn btn-outline-dark my-4">Publier</button>
                </form>
            <?php
                    } else {
            ?>
                <!-- Bouton login -->
                <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-dark me-4">Se connecter pour écrire un commentaire</button>
            <?php
                    }
            ?>
            </div>
        </div>
    </div>
</section>
<?php include 'parts/footer.php'; ?>