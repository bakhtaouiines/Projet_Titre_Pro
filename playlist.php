<?php
include 'parts/header.php' ?>
<div class="container-fluid  bg-light p-5 my-2">
    <form action="" method="POST">
        <div class="card-body text-center">
            <h2 class="card-title ">Playlist title</h5>
                <p class="card-text">Playlist description</p>
        </div>
        <hr>
        <div class="card-body">
            <div class="mt-3">
                <i class="fa fa-search"></i>
                <input type="search" class="form-control " placeholder="Search OST...">
                <!-- afficher le résultat dans une liste déroulante-->
                <!-- item sélectionnable grâce à un bouton radio -->
                <div class="d-flex flex-row">
                    <!-- bouton d'ajout dans la liste -->
                    <button class="btn btn-success m-2 bi bi-plus"></button>
                </div>
            </div>
            <hr>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item <i class="btn bi bi-x-circle"></i></li>
                <li class="list-group-item">A second item <i class="btn bi bi-x-circle"></i></li>
                <li class="list-group-item">A third item <i class="btn bi bi-x-circle"></i></li>
            </ul>

        </div>
        <div class="card-footer bg-light">
            <a href="playlistCreation.php" class="btn btn-outline-secondary bi bi-list">Créer une playlist</a>
            <button type="button" class="btn btn-outline-secondary bi bi-list" data-bs-toggle="modal" data-bs-target="#updatePlaylist">Modifier ma playlist</button>
        </div>
    </form>
</div>

<!-- Modal Modif-->
<div class="modal fade" id="updatePlaylist" tabindex="-1" aria-labelledby="updatePlaylistLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePlaylistLabel">Modifier ma playlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="row">

                        <div class="form-group col-6 position-relative">
                            <label for="updatePlaylistTitle" class="form-label">Playlist Title</label>
                            <input type="text" class="form-control" id="updatePlaylistTitle" name="updatePlaylistTitle" value="">
                            <p class="text-danger"></p>
                        </div>

                        <div class="form-group col-6 position-relative">
                            <label for="updatePlaylistDescription" class="form-label">Playlist Description</label>
                            <input type="text" class="form-control" id="updatePlaylistDescription" name="updatePlaylistDescription" value="">
                            <p class="text-danger"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?php include 'parts/footer.php'; ?>