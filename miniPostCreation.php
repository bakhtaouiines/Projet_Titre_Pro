<?php
include 'parts/header.php' ?>

<div class="container p-5 my-5 bg-light">
    <div class="row p-3">
        <form action="" method="POST">
            <div class="mt-3">
                <i class="fa fa-search"></i>
                <input type="search" class="form-control " placeholder="Search OST...">
                <!-- afficher le résultat dans une liste déroulante-->
                <!-- item sélectionnable grâce à un bouton radio -->
                <textarea class="mt-3" name="miniPostContent" id="miniPostContent" msg cols="150" rows="10" class="form-control"></textarea>
            </div>
            <!-- bouton de validation -->
            <button type="submit" name="submitMiniPost" class="btn btn-success m-2">Publier</button>
        </form>
    </div>
    <a class="btn btn-outline-secondary bi bi-music-player fs-2" href="miniPostList.php">
        <span class="fs-5">Mes Mini-Post</span>
    </a>
</div>

<?php include 'parts/footer.php'; ?>