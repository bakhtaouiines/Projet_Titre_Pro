<?php
include 'parts/header.php';
require_once 'controllers/profilPageCtrl.php';
?>

<figure class="profile border border-secondary rounded mx-auto my-5">
    <img src="<?= (!empty($_SESSION['user']['avatar']))  ? $_SESSION['user']['avatar'] :  $defaultImage ?>" class="background">
    <img src="<?= (!empty($_SESSION['user']['avatar']))  ? $_SESSION['user']['avatar'] :  $defaultImage ?>" alt="Profil de <?= $_SESSION['user']['pseudo'] ?>" class="img">
    <figcaption>
        <h3 class="text-uppercase">
            <?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?>
        </h3>
        <span>
            <a href="userSettings.php?userID=<?= $_SESSION['user']['pseudo'] ?>" button type="button" class="btn btn btn-outline-light">Éditer mon profil</a>
        </span>
        <div class="icons my-auto">
            <a href="playlistList.php">
                <i class="bi bi-music-player"></i>
            </a>
            <a href="miniPostList.php">
                <i class="bi bi-pencil"></i>
            </a>
            <a href="#">
                <i class="bi bi-award"></i>
            </a>
        </div>
    </figcaption>
</figure>

<?php include 'parts/footer.php'; ?>