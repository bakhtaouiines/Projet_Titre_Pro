<?php
include 'parts/header.php';
require_once 'controllers/profilPageCtrl.php';
?>
<div class="container my-5 p-5 bg-dark border border-secondary rounded text-light">
    
        <div class="row my-5">
            <div class="col card">
                <div class="image d-flex">
                    <div class="avatar">
                        <!-- si l'image existe, on l'affiche -->
                        <?php
                        if (file_exists('assets/images/upload/' . $_SESSION['user']['avatar']) && isset($_SESSION['user']['avatar'])) {
                        ?>
                            <img src="<?= 'assets/images/upload/' . $_SESSION['user']['avatar'] ?>" alt="Profil de <?= $_SESSION['user']['pseudo'] ?>" height="170" width="170">
                        <?php
                            // sinon, on affiche l'image par défaut
                        } else {
                        ?>
                            <img src="<?= (!empty($_SESSION['user']['avatar'])) ? $_SESSION['user']['avatar'] :  $defaultImage ?>" height="170" width="170" />
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <h4 class="fw-bold mt-5"><?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?></h4>
            </div>
            <div class="col-auto">
                <a href="userSettings.php?userID=<?= $_SESSION['user']['pseudo'] ?>" button type="button" class="btn btn-sm btn-outline-light">Éditer mon profil</a>
            </div>
        </div>
        <div class="row d-flex justify-content-evenly p-3">
            <div class="col-auto">
                <a class="btn btn-outline-light bi bi-music-player fs-1" href="playlistList.php"><span class="fs-5">Mes Playlists</span></a>
                <p>nombre</p>
            </div>
            <div class="col-auto">
                <a class="btn btn-outline-light bi bi-pencil fs-1" href="miniPostList.php"><span class="fs-5">Mes Mini-Posts</span></a>
                <p>nombre</p>
            </div>
            <section class="col-auto">
                <i class="btn btn-outline-light bi bi-award fs-1"><span class="fs-5">Mes Badges</span></i>
            </section>
        </div>
    
</div>

<?php include 'parts/footer.php'; ?>