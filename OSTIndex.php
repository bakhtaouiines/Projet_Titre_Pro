<?php
require_once 'controllers/ostIndexCtrl.php';
include 'parts/header.php' ?>
<div class="container-fluid p-5">
    <h1 class="fs-3 text-center">Index des musiques de film</h1>
    <div class="btn-group offset-10 mb-5">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            Trier par:
        </button>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">Ordre Alphabétique</a></li>
            <li><a class="dropdown-item" href="#">Catégorie</a></li>
        </ul>
    </div>
    <?php
    // On affiche chaque entrée une à une
    foreach ($ostIndex as $value) {
    ?>
        <div class="card mb-3 border border-secondary p-3" style="max-width: 540px;">

            <div class="row g-0">
                <div class="col-md-5">
                    <img src="<?= $coverInfo->path ?>" class="img-fluid rounded-start" alt="<?= $coverInfo->alt ?>">
                </div>
                <div class="col-md-6">
                    <div class="card-body text-light">

                        <a href="ost.php?ostID=<?= $value->id ?>" class="fs-5 card-title" value=""><?= $value->name ?></a>
                        <h4 class="card-title">OST Compositeur</h4>
                        <p class="card-text"><?= $value->album ?></p>
                        <p class="card-text"><small class="text-muted"><?= $value->date ?></small></p>
                        <h5 class="card-title"><?= $categoryName->name ?></h5>
                        <form action="" method="POST">
                            <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                        </form>

                    </div>
                </div>
            </div>


        </div>
    <?php
    }
    ?>
</div>

<?php include 'parts/footer.php'; ?>