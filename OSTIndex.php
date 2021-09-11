<?php
include 'parts/header.php';
require_once 'controllers/ostIndexCtrl.php';
?>
<div class="container-fluid p-5">
    <figure class="text-center p-3">
        <blockquote class="blockquote fs-5 lead">
            <p class="fst-italic text-light">
                "So much of what we do is ephemeral and quickly forgotten, even by ourselves, so it's gratifying to have something you have done linger in people's memories."
            <figcaption class="blockquote-footer text-end">
                John Williams
            </figcaption>
            </p>
        </blockquote>
    </figure>
    <!-- barre de recherche -->
    <div class="row justify-content-end offset-5 my-3 mb-5">
        <div class="col-8 mb-5">
            <form method="GET" action="">
                <div class="input-group rounded">
                    <input type="search" id="searchOst" name="searchOst" class="form-control mx-2" placeholder="Rechercher" aria-label="Search">
                    <button type="submit" id="submitSearchOst" name="submitSearchOst" class="btn btn-outline-light me-2 bi bi-search" title="rechercher"></button>
                    <!-- filtre -->
                    <select id="ostFilter" name="ostFilter[]" class="btn btn-dark dropdown-toggle dropdown-menu-dark" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <option value="" selected disabled> Trier par:</option>
                        <option value="album" class="dropdown-item">Album</option>
                        <option value="category" class="dropdown-item">Catégorie</option>
                        <option value="composer" class="dropdown-item">Compositeur</option>
                    </select>
                </div>
            </form>
        </div>
        <?php
        if ($isCorrectPage) {
        ?>
            <!-- pagination -->
            <div class="col-auto">
                <nav aria-label="navigationOst">
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= ($searchOstList != '') ? '&searchOst=' . $searchOstList . '&ostFilter%5B%5D=' . $ostFilterString :  ''  ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <?php for ($page = 1; $page <= $numberOfPages; $page++) : ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a class="page-link" href="?page=<?= $page ?><?= ($searchOstList != '') ? '&searchOst=' . $searchOstList . '&ostFilter%5B%5D=' . $ostFilterString : '' ?>"><?= $page ?>
                                </a>
                            </li>
                        <?php endfor ?>

                        <li class="page-item <?= ($currentPage == $numberOfPages) ? "disabled" : "" ?>">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= ($searchOstList != '') ? '&searchOst=' . $searchOstList . '&ostFilter%5B%5D=' . $ostFilterString :  ''  ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
    </div>

    <div class="row d-flex justify-content-evenly mt-5">
        <?php
            // On affiche chaque entrée une à une
            foreach ($ostInfo as $value) {
        ?>
            <div class="card mb-3 border border-dark border-2 p-3 shadow-lg" style="max-width: 440px;">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <a href="ost.php?ostID=<?= $value->id ?>"><img src="<?= $value->path ?>" class="img-fluid rounded" alt="<?= $value->alt ?>" title="<?= $value->title ?>"></a>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body text-light">
                            <a href="ost.php?ostID=<?= $value->id ?>" class="fs-5 lead link-light card-title" value=""><?= $value->ostName ?></a>
                            <h4 class="card-title fs-5 fs-5"><?= $value->firstname ?> <?= $value->lastname ?></h4>
                            <p class="card-text fst-italic"><?= $value->album ?></p>
                            <p class="card-text"><small class="text-muted"><?= $value->date ?></small></p>
                            <p class="card-title lead"><?= $value->categoryName ?></p>
                            <form action="" method="POST">
                                <button type="submit" name="submitVote" class="btn btn-success btn-sm bi bi-heart" title="je vote!"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
<?php
        } else { ?>
    <p>Une erreur est survenue lors de l'obtention de cette page.
        <a href="OSTIndex.php" class="btn btn-outline-secondary p-2" role="button">Retour à l'index'</a>
    </p>

<?php
        }
?>
</div>

<?php include 'parts/footer.php'; ?>