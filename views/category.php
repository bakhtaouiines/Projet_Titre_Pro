<?php
include 'header.php' ?>
<div class="container-fluid p-5">
    <div class="row d-flex justify-content-between">
        <div class="card" style="width: 18rem;">
            <div class="card-header bg-light">
                Votes
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-footer">
                <button class="btn btn-outline-secondary" data-bs-target="#register" data-bs-toggle="modal" data-bs-dismiss="modal">S'inscrire pour voter</button>
            </div>
        </div>

        <div class="card border border-secondary border-3 p-2 bg-light" style="width: 500px;">
            <div class="row g-0">
                <div class="col-md-5 my-auto me-2">
                    <img src="../assets/images/cover/edward_scissorhands.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h3 class="card-title">OST Name</h3>
                        <h4 class="card-title">OST Compositeur</h4>
                        <h5 class="card-title">OST Catégorie</h5>
                        <p class="card-text"><small class="text-muted">OST Date</small></p>
                        <p class="card-text">OST Summary</p>
                        <p class="card-text"><a href="#" class="card-link mb-3">OST Buy Link</a></p>
                        <iframe src="https://open.spotify.com/embed/track/55n2WpwjQnIM1lvmxkzllb?theme=0" width="100%" height="80" frameBorder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                        <form action="" method="POST">
                            <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="width: 18rem;">
            <div class="card-body bg-light" style="flex: none;">
                <h5 class="card-header card-title">Mini-Post title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>

    </div>
</div>
<?php include 'footer.php'  ; ?>