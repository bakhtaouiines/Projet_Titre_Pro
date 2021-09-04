<?php
// require 'controllers/profilPageCtrl.php';
include('header.php') ?>
<div class="container my-5 p-5 bg-light">
    <div class="row my-5">
        <div class="col card">
            <div class="image d-flex">
                <div class="avatar bg-secondary">
                    <img src="../assets/images/panxia.png" height="130" width="130">
                </div>
            </div>
            <h4 class="fw-bold mt-5">nom utilisateur</h4>
        </div>

        <div class="col-3">
            <a class="btn bi bi-music-player fs-1" href="playlistList.php"><span class="fs-5">Mes Playlists</span></a>
            <p>nombre</p>
        </div>
        <div class="col-3">
            <a class="btn bi bi-pencil fs-1" href="miniPostList.php"><span class="fs-5">Mes Mini-Posts</span></a>
            <p>nombre</p>
        </div>
        <section class="col-3">
            <i class="btn bi bi-award fs-1"><span class="fs-5">Mes Badges</span></i>
        </section>

    </div>

    <div class="col offset-10">
        <a href="userSettings.php" button type="button" class="btn btn-outline-dark">Éditer mon profil</a>
    </div>

</div>




<?php include('footer.php'); ?>