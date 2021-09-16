<?php
include 'parts/header.php';
require_once 'controllers/playlistCreationCtrl.php'; ?>

<div class="container-fluid bg-light p-5 my-2">
    <div class="d-flex justify-content-end">
        <a class="btn btn-outline-secondary bi bi-music-player fs-5" href="playlistList.php"> Mes Playlist</a>
    </div>
    <div class="row p-5">
        <form method="POST" class="col-6">
            <label for="playlistName" class="form-label">Titre*</label>
            <input type="text" class="form-control" id="playlistName" name="playlistName">
            <label for="playlistDescription" class="form-label">Desciption</label>
            <input type="text" name="playlistDescription" id="playlistDescription" class="form-control">
            <div class="mt-3">
                <i class="fa fa-search"></i>
                <input type="search" class="form-control" placeholder="Search OST..." onkeyup="searchOst(this.value)">

                <!-- affichage du résultat de la recherche-->
                <div class="col-6">
                    <select class="form-select" id="resultSearch" name="resultSearch"></select>
                </div>
                <!-- bouton d'ajout dans la liste d'affichage des OST-->
                <button type="submit" name="submitOst" class="btn btn-success m-2 fa fa-plus"></button>
            </div>

            <div class="d-flex justify-cpntent-start">
                <!-- bouton pour finaliser et créer la playlist  -->
                <button type="submit" name="submitPlaylist" class="btn btn-outline-secondary my-5">Créer ma playlist</button>
            </div>
        </form>
        <!-- les ost se rajoutent au fur et à mesure après validation -->
        <div class="col-6">
            <ul class="list-group">
                <?php
                foreach ($ostList as $value) {
                ?>
                    <li class="list-group-item">
                        <a href="<?= $value->id_OST ?>">
                            <img src="<?= $value->path ?>" title="<?= $value->title ?>" alt="<?= $value->alt ?>" class="img-thumbnail">
                            <?= $value->ostName ?>
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>

</div>
<?php include 'parts/footer.php'; ?>