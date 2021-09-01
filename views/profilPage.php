<?php include('header.php'); ?>
<div class="container my-5 p-5 d-flex justify-content-around">
    <div class="card p-5">
        <div class="image d-flex flex-column justify-content-center align-items-center">
            <button class="avatar btn btn-dark mb-4">
                <img src="../assets/images/panxia.png" height="100" width="100">
            </button>
            <h4 class="fw-bold">Pseudo Utilisateur</h4>
            <div class=" d-flex mt-2">
                <button class="btn btn-outline-dark">Éditer mon profil</button>
            </div>
        </div>
    </div>

    <div class="card p-5">
        <div class="m-4">
            <ul class="list-group list-group-flush">
                <a href="#" class="list-group-item">Mes listes d'écoute</a>
                <a href="#" class="list-group-item">Mes votes</a>
                <a href="#" class="list-group-item">Mes mini-posts</a>
            </ul>
        </div>
        <h4 class="fw-bold">Mes badges:</h4>
        <i class="bi bi-award fs-1"></i>
    </div>
</div>
</div>
<?php include('footer.php'); ?>