<?php
include 'parts/header.php';
require_once 'controllers/miniPostCtrl.php' ?>
<div class="container p-5">
    <div class="card p-5 mx-auto " style="width: 50rem;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= $minipostInfo->path ?>" title="<?= $minipostInfo->title ?>" class="img-fluid rounded-start" alt="<?= $minipostInfo->alt ?>">
            </div>
            <div class="col-md-8 my-auto">
                <div class="card-body bg-light my-auto">
                    <p class="card-text">
                        <?= $minipostInfo->content ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <a href="miniPostCreation.php" class="btn btn-outline-secondary bi bi-list">Créer un mini-post</a>
</div>
<?php include 'parts/footer.php'; ?>