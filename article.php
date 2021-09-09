<?php
include 'parts/header.php'; 
require_once 'controllers/articleCtrl.php';
?>

<!-- affichage de l'article -->
<div class="article p-5 mt-4">
    <a href="articlelist.php" class="btn btn-outline-dark mb-3 offset-md-10" role="button">Revenir à la liste des articles</a>
    <div class="card mb-3">
        <div class="row">
            <img src="<?= $articleInfo->path ?>" class="figure-img img-fluid rounded" title="<?= $articleInfo->title ?>" alt="<?= $articleInfo->alt ?>">
            <figcaption class="figure-caption text-end"><?= $articleInfo->title ?></figcaption>
        </div>

        <div class="card-body">
            <h1 class="card-title fs-2 fst-italic"><?= $articleInfo->articleTitle ?></h1>
            <p class="card-text"><?= $articleInfo->content ?></p>
            <p class="card-text lead text-end"><?= $articleInfo->pseudo ?></p>
        </div>
    </div>
</div>

<!-- section commentaires -->

<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h2>Commentaires</h2>
                <div class="comment mt-4 text-justify float-left">
                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Jhon Doe</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="text-justify darker mt-4 float-right"> <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Rob Simpson</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="comment mt-4 text-justify"> <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Jhon Doe</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="darker mt-4 text-justify"> <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Rob Simpson</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
            </div>
            <!-- espace d'écriture de commentaire -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="align-form">
                    <div class="form-group">
                        <h4>Laisser un commentaire:</h4>
                        <label for="message">Message</label>
                        <textarea name="msg" id="" msg cols="30" rows="5" class="form-control" style="background-color: white;"></textarea>
                    </div>
                    <button type="submit" id="postComment" name="postComment" class="btn btn-outline-dark my-4">Publier mon commentaire</button>
                    <!-- Bouton login -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-dark me-4">Se connecter pour écrire un commentaire</button>
                </form>
            </div>

        </div>
    </div>
</section>
<?php include 'parts/footer.php'; ?>