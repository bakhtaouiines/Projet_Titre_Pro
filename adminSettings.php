<?php
include 'parts/header.php';
require_once 'controllers/adminSettingsCtrl.php';
?>
<div class="container p-5">
    <h1 class="fs-3 text-center fw-lighter">Espace de suppression des utilisateurs, articles, commentaires et mini-posts</h1>
    <div class="d-flex p-5 justify-content-evenly">
        <a class="btn btn-secondary" data-bs-toggle="modal" href="#usersList" role="button">Liste Utilisateurs</a>
        <a class="btn btn-secondary" data-bs-toggle="modal" href="#articlesList" role="button">Liste Articles</a>
        <a class="btn btn-secondary" data-bs-toggle="modal" href="#commentsList" role="button">Liste Commentaires</a>
        <a class="btn btn-secondary" data-bs-toggle="modal" href="#minipostsList" role="button">Liste Mini-Posts</a>
    </div>
</div>
<!-- liste des utilisateurs -->
<div class="modal fade" id="usersList" aria-hidden="true" aria-labelledby="usersListLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersListLabel">Liste des Utilisateurs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Mail</th>
                            <th scope="col"><i class="bi bi-trash"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // On affiche chaque entrée une à une
                        foreach ($usersList as $value) {
                        ?>
                            <tr>
                                <td><?= $value->pseudo ?></td>
                                <td><?= $value->mail ?></td>
                                <td>
                                    <form method="POST">
                                        <button type="submit" class="btn-danger bi bi-trash" name="deleteUser" data-bs-target="#confirmDelete" data-bs-toggle="modal" data-bs-dismiss="modal" onClick="deleteIdUser(<?= $value->id ?>)"></button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- liste des articles -->
<div class="modal fade" id="articlesList" aria-hidden="true" aria-labelledby="articlesListLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="articlesListLabel">Liste des Articles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <?php
                    // On affiche chaque entrée une à une
                    foreach ($articlesList as $value) {
                    ?>
                        <li class="list-group-item"><?= $value->title ?>
                            <button class="btn-danger bi bi-trash" data-bs-target="#confirmDelete" data-bs-toggle="modal" data-bs-dismiss="modal"></button>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- liste des commentaires -->
<div class="modal fade" id="commentsList" aria-hidden="true" aria-labelledby="commentsListLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commentsListLabel">Liste des Commentaires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card border border-secondary" style="width: 18rem;">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Pseudo</h6>
                        <p class="card-text">Contenu du commentaire</p>
                        <button class="btn-danger bi bi-trash" data-bs-target="#confirmDelete" data-bs-toggle="modal" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- liste des mini-posts -->
<div class="modal fade" id="minipostsList" aria-hidden="true" aria-labelledby="minipostsListLabel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="minipostsListLabel">Liste des Mini-posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card border border-danger" style="width: 18rem;">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Pseudo</h6>
                        <p class="card-text">Contenu du mini-post</p>
                        <button class="btn-danger bi bi-trash" data-bs-target="#confirmDelete" data-bs-toggle="modal" data-bs-dismiss="modal"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fenêtre modale de confirmation de suppression -->
<div class="modal fade" id="confirmDelete" aria-hidden="true" aria-labelledby="confirmDelete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel2">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Souhaitez-vous vraiment supprimer cet élément?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Annuler</button>
                <form method="POST" action="">
                    <input type="hidden" id="deleteInfo" name="deleteInfo" value="">
                    <button type="submit" name="deleteInfo" class="btn btn-success">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include 'parts/footer.php'; ?>