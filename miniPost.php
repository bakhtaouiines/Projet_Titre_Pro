<?php
include 'parts/header.php';
require_once 'controllers/miniPostCtrl.php' ?>

<div class="card p-5 mx-auto " style="width: 50rem;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="<?= $minipostInfo->path ?>" title="<?= $minipostInfo->title ?>" class="img-fluid rounded-start" alt="<?= $minipostInfo->alt ?>">
        </div>
        <div class="col-md-8">
            <div class="card-body bg-light">
                <p class="card-text lead">
                    <?= $minipostInfo->content ?>
                </p>
                <a href="miniPostCreation.php" class="btn btn-outline-secondary bi bi-list">Créer un mini-post</a>
            </div>
        </div>
    </div>
</div>

<?php include 'parts/footer.php'; ?>