<?php
require_once 'controllers/articleListCtrl.php';
include 'parts/header.php';
?>
<div class="container p-5">
    <div class="list-group p-5">
        <?php
        // On affiche chaque entrée une à une
        foreach ($articlesList as $value) {
        ?>
            <a href="article.php?articleID=<?= $value->id ?>" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1 "><?= $value->title ?></h5>
                    <small></small>
                </div>
                <p class="mb-1"><?= substr($value->content, 0, 250) ?></p>
                <small>Lire la suite...</small>
            </a>
        <?php
        }
        ?>
    </div>
</div>
<?php include 'parts/footer.php'; ?>