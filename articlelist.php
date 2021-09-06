<?php
require_once 'controllers/articleListCtrl.php';
include 'parts/header.php';
?>
<div class="container p-5">
    <figure class="text-end">
        <blockquote class="blockquote fs-5 lead">
            <p class="fst-italic text-light">
                "So much of what we do is ephemeral and quickly forgotten, even by ourselves, so it's gratifying to have something you have done linger in people's memories."
            <figcaption class="blockquote-footer">
                John Williams
            </figcaption>
            </p>
        </blockquote>
    </figure>
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