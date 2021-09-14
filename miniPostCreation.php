<?php
include 'parts/header.php';
require_once 'controllers/miniPostCreationCtrl.php';
?>
<div class="container p-5 my-5 bg-light">
    <div class="row">
        <form action="" method="POST">
            <div class="col-6">
                <input type="search" name="search" id="search" class="form-control mx-auto" placeholder="Search OST..." onkeyup="searchOst(this.value)">
                <!-- afficher le résultat dans une liste déroulante-->
                <div id="resultSearch"></div>
            </div>
            <div class="col-6">
                <!-- item sélectionnable grâce à un bouton radio -->
                <textarea class="mt-3" name="miniPostContent" id="miniPostContent" msg cols="100" rows="10" class="form-control"></textarea>

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