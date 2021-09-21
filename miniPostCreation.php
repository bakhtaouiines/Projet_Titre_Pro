<?php
$controllers = 'controllers/miniPostCreationCtrl.php';
include 'parts/header.php';
?>
<div class="container border border-2 border-secondary px-5 p-3 my-5">
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-outline-secondary bi bi-list fs-5" href="miniPostList.php">
            Mes Mini-Post
        </a>
    </div>
    <form method="POST">
        <div class="row mb-3">
            <div class="col-6">
                <input type="search" name="search" id="search" class="form-control mx-auto" placeholder="Quelle musique recherchez-vous?" onkeyup="searchOst(this.value)">
            </div>
            <!-- affichage du résultat de la recherche-->
            <div class="col-6">
                <select class="form-select" id="resultSearch" name="resultSearch"></select>
            </div>
        </div>
        <div class="col-6 my-5">
            <textarea name="miniPostContent" id="miniPostContent"></textarea>
        </div>
        <!-- bouton de validation -->
        <button type="submit" name="submitMiniPost" class="btn btn-outline-light mt-2">Publier</button>
        <p class="text-lead"><?= $message ?></p>
    </form>
</div>


<?php include 'parts/footer.php'; ?>