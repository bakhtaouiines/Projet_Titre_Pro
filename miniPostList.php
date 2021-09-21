<?php
include 'parts/header.php';
require_once 'controllers/miniPostListCtrl.php';
?>
<div class="container p-2">
    <div class="containerRise">
        <h3 class="rise-text">Mes Mini-Posts</h1>
    </div>
    <?php
    // On récupère nos variables de session
    if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
    ?>
        <span class="d-flex justify-content-end my-5">
            <a href="miniPostCreation.php" class="btn btn-outline-secondary bi bi-pencil-square ">Créer un mini-post</a>
        </span>
        <div class="row row-cols-sm-1 row-cols-2 row-cols-md-4 mt-5">
            <?php
            foreach ($minipostList as $value) {
            ?>
                <div class="card text-center p-2 m-2 " style="max-width: 300px;">
                    <a href="miniPost.php?minipostID=<?= $value->id ?>" class="list-group-item list-group-item-action" aria-current="true" style="background: #05171e">
                        <img class="card-img" src="<?= $value->path ?>" alt="<?= $value->alt ?>" title="<?= $value->title ?>" style="max-width: 300px;">
                        <div class="card-body lead text-center text-light">
                            <p><?= $value->ostName ?></p>
                        </div>
                    </a>
                </div>
            <?php
            }
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