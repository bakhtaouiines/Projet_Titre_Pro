<?php
$controllers = 'controllers/miniPostCreationCtrl.php';
include 'parts/header.php';
?>
<div class="container p-5 my-5 bg-dark">
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
        <div class="col-6 offset-3 mt-5">
            <textarea name="miniPostContent" id="miniPostContent"></textarea>
        </div>
        <!-- bouton de validation -->
        <button type="submit" name="submitMiniPost" class="btn btn-outline-light m-2">Publier</button>
        <p class="text-lead"><?= $message ?></p>
    </form>
</div>
<div class="d-flex justify-content-end m-5">
    <a class="btn btn-outline-secondary bi bi-pencil fs-5" href="miniPostList.php">
        Mes Mini-Post
    </a>
</div>

<?php include 'parts/footer.php'; ?>