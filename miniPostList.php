<?php
include 'parts/header.php' ?>
<div class="container p-5">
    <div class="list-group p-5">
        <?php
        // On affiche chaque entrée une à une
        // foreach ($miniPostList as $value) {
        ?>
            <a href="miniPost.php?minipostID=" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">
                    <small>OST Title</small>
                </div>
                <p class="mb-1">début du mini post...</p>
                <small>Lire la suite...</small>
            </a>
        <?php
        // }
        ?>

    </div>
</div>
<?php include 'parts/footer.php'; ?>