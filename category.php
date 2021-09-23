<?php
include 'parts/header.php';
require_once 'controllers/categoryCtrl.php'
?>
<div class="container p-2">
    <div class="containerRise">
        <h3 class="rise-text"><?= $categoryName->name ?></h1>
    </div>
    <div class="row my-5">
        <!-- VOTES -->
        <div class="vCard card my-auto" style="width: 18rem;">
            <div class="card-header">
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
        <div class="card border border-dark border-3 text-light p-4 mx-auto shadow-lg" style="max-width: 700px; background: #0F2027">
            <div class="row ">
                <div class="col-sm-5 col-md-6 mx-auto">
                    <img src="<?= $ostInfo->path ?>" class="img-fluid rounded" alt="<?= $ostInfo->alt ?>">
                </div>
                <div class="col-sm-5 col-md-6 mx-auto">
                    <div class="card-body me-0">
                        <h3 class="ostName card-title fs-5"><?= $ostInfo->ostName ?></h3>
                        <h4 class="card-title fs-5"><?= $ostInfo->firstname ?> <?= $ostInfo->lastname ?></h4>
                        <p class="card-text"><?= $ostInfo->album ?></p>
                        <p class="card-text"><small class="text-muted"><?= $ostInfo->date ?></small></p>
                        <a href="<?= $ostInfo->buy_link ?>" class="mb-3 btn btn-outline-light btn-sm" type="button" target="_blank">Lien d'achat</a>
                        <?= $ostInfo->music_link ?>
                        <!-- A afficher lorsque l'utilisateur est connecté -->
                        <?php
                        // On récupère nos variables de session
                        if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                        ?>
                            <div class="d-flex justify-content-between mt-3">
                                <form action="" method="POST">
                                    <button type="submit" name="submitVote" class="btn btn-danger bi bi-heart" title="je vote!"></button>
                                </form>
                                <a href="miniPostCreation.php" title="j'écris un mini-post" class="btn btn-sm btn-secondary bi bi-pencil"></a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- MINI-POST -->
        <section class="d-flex justify-content-start mt-5" >
            <?php
            foreach ($miniPostInfo as $value) {
            ?>
                <div class="mpCard card">
                    <div class="card-body" style="flex: none;">
                        <img src="<?= $value->path ?>" class="img-thumbnail rounded" alt="<?= $value->alt ?>">
                        <h5 class="card-header card-title"><?= $value->ostName ?></h5>
                        <p class="card-text"><?= $value->content ?></p>
                        <small><?= $value->pseudo ?></small>
                    </div>
                </div>
            <?php
            }
            ?>
        </section>
    </div>
</div>
<?php include 'parts/footer.php'; ?>