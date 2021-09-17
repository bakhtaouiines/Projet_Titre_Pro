<?php
include 'parts/header.php';
require_once 'controllers/miniPostListCtrl.php';
?>

<div class="container p-5">
<span class="d-flex justify-content-end my-5">
    <a href="miniPostCreation.php" class="btn btn-outline-secondary bi bi-list ">Créer un mini-post</a>
</span>
    <div class="row row-cols-1 row-cols-md-3 g-5 mt-5">
        <?php
        foreach ($minipostList as $value) {
        ?>
            <div class="card m-2 h-100" style="max-width: 300px;">
                <a href="miniPost.php?minipostID=<?= $value->id ?>" class="list-group-item list-group-item-action bg-dark" aria-current="true">
                    <img class="card-img" src="<?= $value->path ?>" alt="<?= $value->alt ?>" title="<?= $value->title ?>" style="max-width: 300px;">
                    <div class="card-body lead text-center">
                        <p><?= $value->ostName ?></p>
                        <p>Lire...</p>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include 'parts/footer.php'; ?>