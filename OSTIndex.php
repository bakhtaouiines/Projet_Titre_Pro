<?php
include 'parts/header.php';
require_once 'controllers/ostIndexCtrl.php';
?>
<div class="container-fluid p-5">
    <figure class="text-center p-3">
        <blockquote class="blockquote fs-5 lead">
            <p class="fst-italic text-light">
                "So much of what we do is ephemeral and quickly forgotten, even by ourselves, so it's gratifying to have something you have done linger in people's memories."
            <figcaption class="blockquote-footer text-end">
                John Williams
            </figcaption>
            </p>
        </blockquote>
    </figure>
    <div class="btn-group offset-11 mb-5">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            Trier par:
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">Ordre Alphabétique</a></li>
            <li><a class="dropdown-item" href="#">Catégorie</a></li>
        </ul>
    </div>
    <div class="row d-flex justify-content-evenly mt-4">
        <?php
        // On affiche chaque entrée une à une
        foreach ($ostInfo as $value) {
        ?>
            <div class="card mb-3 border border-dark border-2 p-3 shadow-lg" style="max-width: 440px;">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <a href="ost.php?ostID=<?= $value->id ?>"><img src="<?= $value->path ?>" class="img-fluid rounded" alt="<?= $value->alt ?>" title="<?= $value->title ?>"></a>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body text-light">
                            <a href="ost.php?ostID=<?= $value->id ?>" class="fs-5 lead link-light card-title" value=""><?= $value->ostName ?></a>
                            <h4 class="card-title fs-5 fs-5"><?= $value->firstname ?> <?= $value->lastname ?></h4>
                            <p class="card-text fst-italic"><?= $value->album ?></p>
                            <p class="card-text"><small class="text-muted"><?= $value->date ?></small></p>
                            <p class="card-title lead"><?= $value->categoryName ?></p>
                            <form action="" method="POST">
                                <button type="submit" name="submitVote" class="btn btn-success btn-sm bi bi-heart" title="je vote!"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include 'parts/footer.php'; ?>