<?php
include 'parts/header.php';
require_once 'controllers/articleListCtrl.php';
?>
<div class="container p-5">
    <?php
    // On affiche chaque entrée une à une
    foreach ($articlesList as $value) {
    ?>
        <div class="row py-5" >
            <div class="col-11">
                <a href="article.php?articleID=<?= $value->articleID ?>">
                    <div class="card bg-dark text-white">
                        <img src="<?= $value->path ?>" alt="<?= $value->alt ?>" title="<?= $value->title ?>" style="opacity: 0.4;">
                        <div class="card-img-overlay mb-0">
                            <h5 class="card-title"><?= $value->articleTitle ?></h5>
                            <p class="card-text mb-0"><?= substr($value->content, 0, 250) ?></p>
                            <small class="mb-0 text-small font-italic">Lire la suite...</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<?php include 'parts/footer.php'; ?>