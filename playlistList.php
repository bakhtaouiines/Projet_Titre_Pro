<?php
include 'parts/header.php' ?>
<div class="container p-2">
    <div class="containerRise">
        <h3 class="rise-text">Mes Playlists</h1>
    </div>
    <?php
    // On récupère nos variables de session
    if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
    ?>
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
    <?php
    } else {
    ?>
        <p class="lead text-center text-danger">Il n'y a rien ici!</p>
    <?php
    }
    ?>
</div>
<?php include 'parts/footer.php'; ?>