<?php
include 'parts/header.php';
require_once 'controllers/userSettingsCtrl.php' ?>

<div class="container bg-light my-5 p-4">
<p class="lead text-success"><?= $successMessage ?></p>
    <form method="POST" enctype="multipart/form-data" action="">
        <legend class="fs-2">Éditer mon profil</legend>
        <div class="row">
            <div class="col-12 form-group p-3 position-relative">
                <label for="avatar" title="Recherchez le fichier à uploader !">Envoyer l'image:</label>
                <input name="avatar" type="file" id="avatar">
                <input type="submit" name="submit" value="Télécharger">
            </div>

            <div class="col form-group position-relative">
                <label for="updatePseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="updatePseudo" name="updatePseudo" value="<?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?>">
                <?php
                if (!empty($formErrorList['updatePseudo'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $formErrorList['updatePseudo']; ?></p>
                <?php
                }
                ?>
            </div>

            <div class="col form-group position-relative">
                <label for="updateMail" class="form-label">Adresse Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="mailPrepend">@</span>
                    <input type="text" class="form-control" id="updateMail" name="updateMail" aria-describedby="mailPrepend" value="<?= isset($_SESSION['user']['mail']) ? $_SESSION['user']['mail'] : '' ?>">
                    <?php
                    if (!empty($formErrorList['updateMail'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $formErrorList['updateMail']; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col form-group position-relative">
                <label for="oldPassword" class="form-label">Ancien Mot de Passe</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                <?php
                    if (!empty($formErrorList['oldPassword'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $formErrorList['oldPassword']; ?></p>
                    <?php
                    }
                    ?>
                <label for="updatePassword" class="form-label">Nouveau Mot de Passe</label>
                <input type="password" class="form-control" id="updatePassword" name="updatePassword">
                <?php
                    if (!empty($formErrorList['updatePassword'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $formErrorList['updatePassword']; ?></p>
                    <?php
                    }
                    ?>
            </div>
        </div>

        <div class="row m-5 p-5">
            <div class="col-4">
                <h3>Mes Playlist :</h3>
                <ul class="list-group list-group-flush col-auto">
                    <li class="list-group-item">Playlist Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Playlist Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Playlist Title <i class="bi bi-x-circle btn"></i></li>
                </ul>
            </div>
            <div class="col-4">
                <h3>Mes Mini-Post :</h3>
                <ul class="list-group list-group-flush col-auto">
                    <li class="list-group-item">Mini-Post Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Mini-Post Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Mini-Post Title <i class="bi bi-x-circle btn"></i></li>
                </ul>
            </div>
            <div class="col-4">
                <h3>Mes Commentaires :</h3>
                <ul class="list-group list-group-flush col-auto">
                    <li class="list-group-item">Commentaire Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Commentaire Title <i class="bi bi-x-circle btn"></i></li>
                    <li class="list-group-item">Commentaire Title <i class="bi bi-x-circle btn"></i></li>
                </ul>
            </div>
        </div>

        <div class="d-flex justify-content-around p-5">
            <button type="submit" id="updateUser" class="btn btn-outline-success px-3 me-5" name="updateUser">Enregistrer les modifications</button>
            <a href="profilPage.php" type="button" class="btn btn-outline-secondary px-3 me-5">Annuler</a>
            
        </div>
    </form>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProfile">
        Supprimer mon profil
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteProfile" tabindex="-1" aria-labelledby="deleteProfileLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProfileLabel">Suppression de votre profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        Voulez-vous vraiment supprimer votre profil? <br>Cela supprimera toutes les informations relatives à votre compte (mini-posts, commentaires, votes...)?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'parts/footer.php'; ?>