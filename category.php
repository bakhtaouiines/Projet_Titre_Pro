<?php
include 'parts/header.php';
require_once 'controllers/categoryCtrl.php'
?>
<div class="container-fluid p-3">
    <div class="row mx-auto">
        <!-- VOTES -->
        <div class="card" style="width: 18rem;">
            <div class="card-header bg-light">
                Votes
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-footer">
                <!-- A afficher lorsque l'utilisateur est connecté -->
                <?php
                // On récupère nos variables de session
                if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                ?><?php
                } else {
                    ?>
                <button class="btn btn-outline-light" data-bs-target="#register" data-bs-toggle="modal" data-bs-dismiss="modal">S'inscrire pour voter</button>
            <?php
                }
            ?>
            </div>
        </div>
        <!-- OST -->
        <div class="card border border-dark border-5 text-light p-4 mx-auto shadow-lg" style="max-width: 700px; background: #0F2027">
            <div class="row ">
                <div class="col-sm-5 col-md-10 my-auto mx-auto">
                    <img src="<?= $ostInfo->path ?>" class="img-fluid rounded" alt="<?= $ostInfo->alt ?>">
                </div>
                <div class="col-sm-5 col-md-10 mx-auto">
                    <div class="card-body me-0">
                        <h3 class="card-title fs-5"><?= $ostInfo->ostName ?></h3>
                        <h4 class="card-title fs-5"><?= $ostInfo->firstname ?> <?= $ostInfo->lastname ?></h4>
                        <p class="card-text"><?= $ostInfo->album ?></p>
                        <p class="card-text"><small class="text-muted"><?= $ostInfo->date ?></small></p>
                        <p class="card-text"><a href="<?= $ostInfo->buy_link ?>" class="card-link mb-3 link-light" target="_blank">Lien d'achat</a></p>
                        <?= $ostInfo->music_link ?>
                        <form action="" method="POST">
                            <button type="submit" name="submitVote" class="btn btn-danger bi bi-heart" title="je vote!"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MINI-POST -->
        <?php
        foreach ($miniPostInfo as $value) {
        ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body bg-light" style="flex: none;">
                    <h5 class="card-header card-title"><?= $value->ostName ?></h5>
                    <p class="card-text"><?= $value->content ?></p>
                    <small><?= $value->pseudo ?></small>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php include 'parts/footer.php'; ?>