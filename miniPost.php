<?php
$controllers = 'controllers/miniPostCtrl.php';
include 'parts/header.php';
?>
<div class="container-fluid p-5">
    <div class="card mb-3 bg-dark text-white p-2 mx-auto mb-5" style="width: 940px;">
        <div class="row">
            <div class="col-md-7">
                <img src="<?= $minipostInfo->path ?>" class="img-fluid rounded-start" title="<?= $minipostInfo->title ?>" alt="<?= $minipostInfo->alt ?>">
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <button type="button" class="offset-11 btn btn-sm btn-outline-secondary bi bi-pencil" data-bs-toggle="modal" data-bs-target="#updateElement"></button>
                    <h3 class="card-title"><?= $minipostInfo->ostName ?></h3>
                    <p class="card-text"><?= $minipostInfo->content ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto d-flex justify-content-between">
        <a href="miniPostCreation.php" class="btn btn-outline-secondary bi bi-pencil-square"> Créer un mini-post</a>
        <a href="miniPostList.php" class="btn btn-outline-secondary bi bi-list"> Revenir à la liste des minipost</a>
        <button type="button" class="btn btn-outline-danger bi bi-x-circle" data-bs-toggle="modal" data-bs-target="#deleteElement"> Supprimer</button>
    </div>
</div>
<!---------------------------------------------->
<!-- Modal Modification-->
<div class="modal fade" id="updateElement" tabindex="-1" aria-labelledby="updateElementLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="updateElementLabel">Modification du mini-post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <textarea name="updateContent"><?= $minipostInfo->content ?></textarea>
                </div>
                <div class="modal-footer bg-dark text-white">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="updateMiniPost" class="btn btn-success">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Suppression-->
<div class="modal fade" id="deleteElement" tabindex="-1" aria-labelledby="deleteElementLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ddeleteElementLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Voulez-vous vraiment supprimer cet élément?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form method="POST">
                    <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'parts/footer.php'; ?>