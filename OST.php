<?php
include 'parts/header.php';
require_once 'controllers/ostCtrl.php';
?>
<div class="OSTcontainer container-fluid my-3 p-5">
    <div class="d-flex justify-content-end">
        <a href="OSTIndex.php" class="btn btn-outline-secondary bi bi-collection-play "> Index</a>
    </div>
    <div class="card border border-dark border-3 text-light p-2 mx-auto my-5 shadow-lg " style="max-width: 900px; background: #0F2027; opacity:0.9">
        <div class="row g-0">
            <div class="col-sm-12 col-md-5 my-auto me-2">
                <img src="<?= $ostInfo->path ?>" class="img-fluid rounded-start" alt="<?= $ostInfo->alt ?>">
            </div>
            <div class="col-sm-12 col-md-5">
                <div class="card-body">
                    <h3 class="ostName card-title f4-2"><?= $ostInfo->ostName ?></h3>
                    <h5 class="card-title "><?= $ostInfo->firstname ?> <?= $ostInfo->lastname ?></h4>
                        <p class="card-text"><?= $ostInfo->album ?></p>
                        <p class="card-text fst-italic"><small class="text-muted"><?= $ostInfo->date ?></small></p>
                        <a class="card-link text-decoration-none" href="category.php?categoryID=<?= $ostInfo->categoryID ?>"><?= $ostInfo->categoryName ?></a>
                        <a href="<?= $ostInfo->buy_link ?>" class="m-3 btn btn-outline-light btn-sm" type="button" target="_blank">Lien d'achat</a>
                        <?= $ostInfo->music_link ?>
                        <div class="d-flex justify-content-between my-3 ">
                            <!-- A afficher lorsque l'utilisateur est connecté -->
                            <?php
                            // On récupère nos variables de session
                            if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                            ?>
                                <form action="" method="POST">
                                    <button type="submit" name="submitVote" class="btn btn-lg btn-danger bi bi-heart" title="je vote!"></button>
                                </form>

                                <a href="miniPostCreation.php" title="j'écris un mini-post" class="btn btn-lg btn-secondary bi bi-pencil"></a>
                            <?php
                            }
                            ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'parts/footer.php'; ?>