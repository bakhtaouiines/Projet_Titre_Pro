<?php
include 'parts/header.php';
require_once 'controllers/profilPageCtrl.php';
?>
<div class="container my-5 p-5 bg-light">
    <div class="row my-5">
        <div class="col card">
            <div class="image d-flex">
                <div class="avatar">
                    <img src="<?= (!empty($_SESSION['user']['avatar']))  ? $_SESSION['user']['avatar'] :  $defaultImage ?>" height="130" width="130">
                </div>
            </div>
            <h4 class="fw-bold mt-5"><?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?></h4>
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
        <a href="userSettings.php?userID=<?= $_SESSION['user']['pseudo'] ?>" button type="button" class="btn btn-outline-dark">Éditer mon profil</a>
    </div>

</div>

<?php include 'parts/footer.php'; ?>