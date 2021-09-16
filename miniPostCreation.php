<?php
include 'parts/header.php';
require_once 'controllers/miniPostCreationCtrl.php';
?>
<div class="container p-5 my-5 bg-light">
    <form method="POST">
        <div class="row mb-3">
            <div class="col-6">
                <input type="search" name="search" id="search" class="form-control mx-auto" placeholder="Search OST..." onkeyup="searchOst(this.value)">
            </div>
            <!-- affichage du résultat de la recherche-->
            <div class="col-6">
                <select class="form-select" id="resultSearch" name="resultSearch">
                </select>
            </div>
        </div>
        <div class="col-6 offset-3">
            <textarea name="miniPostContent" id="miniPostContent"></textarea>
        </div>
        <!-- bouton de validation -->
        <button type="submit" name="submitMiniPost" class="btn btn-outline-dark m-2">Publier</button>
    </form>
</div>
<div class="d-flex justify-content-end">
    <a class="btn btn-outline-secondary bi bi-pencil fs-3" href="miniPostList.php">
        Mes Mini-Post
    </a>
</div>

<?php include 'parts/footer.php'; ?>