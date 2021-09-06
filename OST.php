<?php
require_once 'controllers/ostCtrl.php';
include 'parts/header.php' ?>

<div class="card border border-secondary border-3 p-2 mx-auto my-5" style="width: 900px;">
    <div class="row g-0">
        <div class="col-md-4 my-auto me-2">
            <img src="../assets/images/cover/edward_scissorhands.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h3 class="card-title"><?= $ost->name ?></h3>
                <h4 class="card-title">OST Compositeur</h4>
                <p class="card-text"><?= $ost->album ?></p>
                <p class="card-text"><small class="text-muted"><?= $ost->date ?></small></p>
                <h5 class="card-title">OST Catégorie</h5>
                <p class="card-text"><a href="<?= $ost->buy_link ?>" class="card-link mb-3" target="_blank">Lien d'achat</a></p>
                <?= $ost->music_link ?>
                <form action="" method="POST">
                    <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="OSTIndex.php" class="btn btn-outline-secondary m-5">Index</a>

<?php include 'parts/footer.php'; ?>