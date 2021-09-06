<?php
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
    <div class="card mb-3 border border-secondary p-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="assets/images/cover/edward_scissorhands.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <a href="OST.php" class="fs-5 card-title" value="">OST Name</a>
                    <p class="card-text">OST Summary</p>
                    <p class="card-text"><small class="text-muted">OST Date</small></p>
                    <a href="#" class="card-link">OST Buy Link</a>
                    <form action="" method="POST">
                        <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'parts/footer.php'; ?>