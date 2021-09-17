<?php
include 'parts/header.php';
require_once 'controllers/categoryCtrl.php'
?>
<div class="container-fluid p-5">
    <div class="row d-flex justify-content-between">
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
                <button class="btn btn-outline-secondary" data-bs-target="#register" data-bs-toggle="modal" data-bs-dismiss="modal">S'inscrire pour voter</button>
            <?php
                }
            ?>
            </div>
        </div>
        <!-- OST -->
        <div class="card border border-dark border-2 bg-dark text-light p-2 mx-auto shadow-lg" style="width: 700px;">
            <div class="row g-0">
                <div class="col-md-6 my-auto me-2">
                    <img src="<?= $ostInfo->path ?>" class="img-fluid rounded-start" alt="<?= $ostInfo->alt ?>">
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h3 class="card-title"><?= $ostInfo->ostName ?></h3>
                        <h4 class="card-title"><?= $ostInfo->firstname ?> <?= $ostInfo->lastname ?></h4>
                        <p class="card-text"><?= $ostInfo->album ?></p>
                        <p class="card-text"><small class="text-muted"><?= $ostInfo->date ?></small></p>
                        <p class="card-text"><a href="<?= $ostInfo->buy_link ?>" class="card-link mb-3 link-light" target="_blank">Lien d'achat</a></p>
                        <?= $ostInfo->music_link ?>
                        <form action="" method="POST">
                            <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MINI-POST -->
        <div class="card" style="width: 18rem;">
            <div class="card-body bg-light" style="flex: none;">
                <h5 class="card-header card-title">Mini-Post title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>

    </div>
</div>
<?php include 'parts/footer.php'; ?>