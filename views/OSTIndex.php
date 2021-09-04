<?php
include('header.php') ?>
<div class="container-fluid p-5">
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
            <div class="col-md-4">
                <img src="../assets/images/cover/edward_scissorhands.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <a href="OST.php" class="fs-5 card-title" value="">OST Name</a>
                    <p class="card-text">OST Summary</p>
                    <p class="card-text"><small class="text-muted">OST Date</small></p>
                    <div class="card-footer">
                        <a href="#" class="card-link">OST Buy Link</a>
                        <a href="#" class="card-link">OST Music Link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>