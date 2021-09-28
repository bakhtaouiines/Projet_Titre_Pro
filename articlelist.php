<?php
include 'parts/header.php';
require_once 'controllers/articleListCtrl.php';
?>
<div class="container-fluid py-5 p-5">
<div class="containerRise">
        <h3 class="rise-text">L'espace Lecture</h3>
    </div>
<div class="row row-cols-1 row-cols-md-1 row-cols-md-2 g-5 mt-5">
        <?php
        // On affiche chaque entrée une à une
        foreach ($articlesList as $value) {
        ?>
            <div class="articleList p-3">
                <a href="article.php?articleID=<?= $value->articleID ?>">
                    <div class="card m-2 bg-dark border border-dark shadow-lg" style="max-width: 550px;">
                        <img src="<?= $value->path ?>" alt="<?= $value->alt ?>" title="<?= $value->title ?>" style="opacity: 0.7;">
                        <div class="card-img-overlay mb-0">
                            <h5 class="articlesTitle card-title"><?= $value->articleTitle ?></h5>
                            <p class="card-text mb-0"><?= substr($value->content, 0, 180) ?></p>
                            <small class="mb-0 text-small fst-italic">Lire la suite...</small>
                        </div>
                    </div>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include 'parts/footer.php'; ?>