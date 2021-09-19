<?php
include 'parts/header.php';
require_once 'controllers/ostCtrl.php';
?>

<div class="card border border-dark border-2 bg-dark text-light p-2 mx-auto my-5 shadow-lg " style="width: 900px;">
    <div class="row g-0">
        <div class="col-md-4 my-auto me-2">
            <img src="<?= $ostInfo->path ?>" class="img-fluid rounded-start" alt="<?= $ostInfo->alt ?>">
        </div>
        <div class="col-md-7 ms-5">
            <div class="card-body">
                <h3 class="card-title"><?= $ostInfo->ostName ?></h3>
                <h4 class="card-title"><?= $ostInfo->firstname ?> <?= $ostInfo->lastname ?></h4>
                <p class="card-text"><?= $ostInfo->album ?></p>
                <p class="card-text"><small class="text-muted"><?= $ostInfo->date ?></small></p>
                <a class="fs-5 card-title text-decoration-none" href="category.php?categoryID=<?= $ostInfo->categoryID ?>"><?= $ostInfo->categoryName ?></a>
                <p class="card-text"><a href="<?= $ostInfo->buy_link ?>" class="card-link text-decoration-none mb-3 link-light" target="_blank">Lien d'achat</a></p>
                <?= $ostInfo->music_link ?>
                <div class="d-flex justify-content-between my-3">
                    <form action="" method="POST">
                        <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                    </form>
                    <a href="miniPostCreation.php" class="btn btn-secondary bi bi-pencil">Écrire un mini-post</a>
                </div>
            </div>
        </div>
    </div>
</div>

<a href="OSTIndex.php" class="btn btn-outline-secondary m-5">Index</a>

<?php include 'parts/footer.php'; ?>