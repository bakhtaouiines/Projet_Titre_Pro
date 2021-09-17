<?php
include 'parts/header.php';
require_once 'controllers/userSettingsCtrl.php' ?>

<div class="container bg-dark text-light my-5 p-5">
    <p class="lead text-success fs-2"><?= $successMessage ?></p>
    <form method="POST" enctype="multipart/form-data">
        <div class="row row-cols-1 row-cols-md-2 g-5">
            <div class="col form-group p-3">
                <label for="avatar" title="Recherchez le fichier à uploader !">Envoyer l'image:</label>
                <input name="avatar" type="file" id="avatar">
                <input type="submit" name="submitAvatar" value="Télécharger">
            </div>

            <div class="col form-group">
                <label for="updatePseudo" class="form-label">Pseudo</label>
                <input type="text" class="form-control" id="updatePseudo" name="updatePseudo" value="<?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?>">
                <?php
                if (!empty($error['updatePseudo'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $error['updatePseudo']; ?></p>
                <?php
                }
                ?>
            </div>

            <div class="col form-group">
                <label for="updateMail" class="form-label">Adresse Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="mailPrepend">@</span>
                    <input type="text" class="form-control" id="updateMail" name="updateMail" aria-describedby="mailPrepend" value="<?= isset($_SESSION['user']['mail']) ? $_SESSION['user']['mail'] : '' ?>">
                    <?php
                    if (!empty($error['updateMail'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $error['updateMail']; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col form-group">
                <label for="oldPassword" class="form-label">Ancien Mot de Passe</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                <?php
                if (!empty($error['oldPassword'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $error['oldPassword']; ?></p>
                <?php
                }
                ?>
                <label for="updatePassword" class="form-label">Nouveau Mot de Passe</label>
                <input type="password" class="form-control" id="updatePassword" name="updatePassword">
                <?php
                if (!empty($error['updatePassword'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $error['updatePassword']; ?></p>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="d-flex justify-content-around p-5">
            <button type="submit" id="updateUser" class="btn btn-sm btn-outline-success px-3 me-5" name="updateUser">Enregistrer les modifications</button>
            <a href="profilPage.php" type="button" class="btn btn-sm btn-outline-secondary px-3 me-5">Annuler</a>

        </div>
    </form>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProfile">
        Supprimer mon profil
    </button>
</div>

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

<?php include 'parts/footer.php'; ?>