<?php
include 'parts/header.php' ?>
<div class="container p-5">
    <div class="list-group p-5">
        <?php
        // On affiche chaque entrée une à une
        // foreach ($playlistList as $value) {
        ?>
        <a href="playlist.php?playlistID=" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 ">Playlist Title</h5>
            </div>
            <p class="mb-1">description de la playlist</p>
        </a>
        <?php
        // }
        ?>

    </div>
</div>
<?php include 'parts/footer.php'; ?>