<?php
include 'parts/header.php';
require_once 'controllers/articleCtrl.php';
?>

<!-- affichage de l'article -->
<div class="container article p-3 mt-4">
    <a href="articlelist.php" class="btn btn-outline-light mb-3 offset-md-10" role="button">Revenir à la liste des articles</a>
    <div class="container mb-3">
        <div class="row g-0">
            <div class="col-md-5 my-auto">
                <img src="<?= $articleInfo->path ?>" class="figure-img rounded" title="<?= $articleInfo->title ?>" alt="<?= $articleInfo->alt ?>">
                <figcaption class="figure-caption text-center"><?= $articleInfo->title ?></figcaption>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h1 class="card-title fs-2 fst-italic"><?= $articleInfo->articleTitle ?></h1>
                    <p class="card-text"><?= $articleInfo->content ?></p>
                    <p class="author text-end"><?= $articleInfo->pseudo ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section commentaires -->
<section class="p-5">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-sm-5 col-md-6 col-12 p-5">
                <h2 class="text-light fs-5">Commentaires</h2>
                <?php
                // On affiche chaque entrée une à une
                foreach ($commentList as $value) {
                ?>
                    <div class="comment mt-4 text-justify float-left border border-light">
                        <?php
                        if (file_exists('assets/images/upload/' . $_SESSION['user']['avatar']) && isset($_SESSION['user']['avatar'])) {
                        ?>
                            <img src="<?= $value->avatar ?>" class="rounded-circle" alt="Profil de <?= $value->pseudo ?>" height="20" width="20">
                        <?php
                            // sinon, on affiche l'image par défaut
                        } else {
                        ?>
                            <img src="<?= $defaultImage ?>" class="rounded-circle" height="40" width="40">
                        <?php
                        }
                        ?>
                        <h4><?= $value->pseudo ?></h4><small class="text-muted fst-italic ms-3"><?= date('d-m-Y', strtotime($value->date)) ?></small>
                        <p><?= $value->content ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
            <!-- espace d'écriture de commentaire -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4 ">
                <form method="POST" id="align-form">
                    <div class="form-group p-3 text-center border border-light">
                        <h4>Laisser un commentaire:</h4>
                        <small class="fst-italic ">Merci de rester bienveillant!</small>
                        <textarea name="content" id="content" class="form-control mt-3"></textarea>
                    </div>
                    <!-- A afficher lorsque l'utilisateur est connecté -->
                    <?php
                    // On récupère nos variables de session
                    if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                    ?>
                            <div class="popup">
                                <button type="submit" id="submitComment" name="submitComment" class="btn btn-outline-light my-4" onclick="popup()">Publier</button>
                                <span class="popuptext" id="avatarPopup"><?= $message ?></span>
                            </div>
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