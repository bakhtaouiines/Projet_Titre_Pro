<?php
include('header.php') ?>

<div class="container bg-light my-5 p-3">

    <div class="row p-5">
        <form action="" method="POST" class="col-auto">
            <label for="playlistTitle" class="form-label">Titre de ma Playlist*</label>
            <input type="text" class="form-control" id="playlistTitle" name="playlistTitle">
            <label for="playlistDescription" class="form-label">Description</label>
            <textarea name="playlistDescription" id="playlistDescription" msg cols="50" rows="5" class="form-control"></textarea>
            <div class="mt-3">
                <i class="fa fa-search"></i>
                <input type="search" class="form-control " placeholder="Search OST...">
                <!-- afficher le résultat dans une liste déroulante-->
                <!-- item sélectionnable grâce à un bouton radio -->
                <div class="d-flex flex-row">
                    <!-- bouton d'ajout dans la liste -->
                    <button class="btn btn-success m-2"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </form>
        <!-- les ost se rajoutent au fur et à mesure après validation -->
        <div class="col-6">
            <ul class="list-group">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
            </ul>
        </div>
    </div>
    <a class="btn btn-outline-secondary bi bi-music-player fs-2" href="playlistList.php"><span class="fs-5">Mes listes d'écoute</span></a>
</div>


<?php include('footer.php'); ?>