<?php
include 'parts/header.php';
require_once 'controllers/miniPostCreationCtrl.php';
?>
<div class="container p-5 my-5 bg-light">
    <form method="POST">
        <div class="row">

            <div class="col-6">
                <input type="search" name="search" id="search" class="form-control mx-auto" placeholder="Search OST..." onkeyup="searchOst(this.value)">
            </div>
            <!-- afficher du résultat-->
            <div class="col-6">
                <select class="form-select" id="resultSearch" name="resultSearch">
                </select>
            </div>
        </div>
        <div class="col-3">
            <!-- item sélectionnable grâce à un bouton radio -->
            <div class="form-floating">
            <textarea class="form-control mt-3" name="miniPostContent" id="miniPostContent" style="height: 100px"></textarea>
            </div>
            <!-- bouton de validation -->
            <button type="submit" name="submitMiniPost" class="btn btn-outline-dark m-2">Publier</button>
        </div>
    </form>
</div>
<a class="btn btn-outline-secondary bi bi-pencil fs-3 offset-10" href="miniPostList.php">
    <span class="fs-5">Mes Mini-Post</span>
</a>
</div>

<?php include 'parts/footer.php'; ?>