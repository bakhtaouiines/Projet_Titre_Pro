<?php
include 'parts/header.php';
require_once 'controllers/miniPostListCtrl.php';
?>
<div class="container p-5">
    
        <?php
        // On affiche chaque entrée une à une
        foreach ($minipostList as $value) {
        ?>
            <div class="card" style="max-width: 300px;">
                <a href="miniPost.php?minipostID=<?= $value->id ?>" class="list-group-item list-group-item-action" aria-current="true">
                    <img class="card-img" src="<?= $value->path ?>" alt="<?= $value->alt ?>" title="<?= $value->title ?>" style="max-width: 300px;">
                    <div class="card-body">
                        <p class="mb-1"><?= substr($value->content, 0, 250) ?></p>
                        <small>Lire la suite...</small>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>

    
</div>
<?php include 'parts/footer.php'; ?>