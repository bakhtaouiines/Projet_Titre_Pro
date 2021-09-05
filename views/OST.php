<?php
include 'header.php' ?>

<div class="card border border-secondary border-3 p-2 mx-auto my-5" style="width: 900px;">
    <div class="row g-0">
        <div class="col-md-4 my-auto me-2">
            <img src="../assets/images/cover/edward_scissorhands.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-7">
            <div class="card-body">
                <h3 class="card-title">OST Name</h3>
                <h4 class="card-title">OST Compositeur</h4>
                <h5 class="card-title">OST Catégorie</h5>
                <p class="card-text"><small class="text-muted">OST Date</small></p>
                <p class="card-text">OST Summary</p>
                <p class="card-text"><a href="#" class="card-link mb-3">OST Buy Link</a></p>
                <iframe src="https://open.spotify.com/embed/track/55n2WpwjQnIM1lvmxkzllb?theme=0" width="100%" height="80" frameBorder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                <form action="" method="POST">
                    <button type="submit" name="submitVote" class="btn btn-success bi bi-heart" title="je vote!" ></button>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="OSTIndex.php" class="btn btn-outline-secondary m-5">Index</a>

<?php include('footer.php'); ?>