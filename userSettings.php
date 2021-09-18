<?php
include 'parts/header.php';
require_once 'controllers/userSettingsCtrl.php' ?>

<div class="container bg-dark border border-secondary rounded text-light my-5 p-5">
    <p class="lead text-success fs-2"><?= $successMessage ?></p>
    <form method="POST" enctype="multipart/form-data">
        <div class="row row-cols-1 row-cols-md-2 g-5">
            <div class="col-lg-6 mx-auto">
                <!-- Upload d'image-->
                <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                    <input id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                    <label id="upload-label" for="upload" class="font-weight-light text-muted">Choisir une image</label>
                    <div class="input-group-append">
                        <label for="upload" class="btn btn-light m-0 rounded-pill px-4"><i class="bi bi-cloud-arrow-up fs-5 text-muted"></i></label>
                    </div>
                </div>
                <!-- Zone d'affichage de l'image téléchargé-->
                <div class="image-area mt-4">
                    <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                </div>
            </div>
            <div class="d-flex justify-content-evenly">
                <div class="col-auto form-group ">
                    <label for="updatePseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control px-2 py-2" id="updatePseudo" name="updatePseudo" value="<?= isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '' ?>">
                    <?php
                    if (!empty($error['updatePseudo'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $error['updatePseudo']; ?></p>
                    <?php
                    }
                    ?>
                    <label for="updateMail" class="form-label">Adresse Email</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="mailPrepend">@</span>
                        <input type="text" class="form-control px-2 py-2" id="updateMail" name="updateMail" aria-describedby="mailPrepend" value="<?= isset($_SESSION['user']['mail']) ? $_SESSION['user']['mail'] : '' ?>">
                        <?php
                        if (!empty($error['updateMail'])) {
                        ?>
                            <p class="fst-italic text-danger"><?= $error['updateMail']; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="updateUser" class="mt-3 btn btn-outline-success text-center" name="updateUser">Enregistrer les modifications</button>
    </form>

    <!-- Button trigger modal modification mot de passe -->
    <div class="d-flex justify-content-end mb-5">
        <button type="button" class="btn btn-secondary btn-sm my-auto" data-bs-toggle="modal" data-bs-target="#updatePassword">
            Modifier mon mot de passe
        </button>
    </div>
    <hr>
    <div class="d-flex justify-content-between p-2 mt-5">
        <!-- Button trigger modal suppression du compte-->
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProfile">
            Supprimer mon profil
        </button>
        <a href="profilPage.php" type="button" class="btn btn-sm btn-outline-secondary px-3 me-5">Annuler</a>
    </div>
</div>
<!-- Modale modification du mot de passe-->
<div class="modal fade" id="updatePassword" tabindex="-1" aria-labelledby="updatePasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-sm-down">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasswordLabel">Modification de votre mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="col form-group">
                        <label for="oldPassword" class="form-label">Ancien Mot de Passe</label>
                        <input type="password" class="form-control px-2 py-2" id="oldPassword" name="oldPassword">
                        <?php
                        if (!empty($error['oldPassword'])) {
                        ?>
                            <p class="fst-italic text-danger"><?= $error['oldPassword']; ?></p>
                        <?php
                        }
                        ?>
                        <label for="updatePassword" class="form-label">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control px-2 py-2" id="updatePassword" name="updatePassword">
                        <?php
                        if (!empty($error['updatePassword'])) {
                        ?>
                            <p class="fst-italic text-danger"><?= $error['updatePassword']; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="submit" name="updateUserPassword" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modale Confirmation Suppression du compte-->
<div class="modal fade" id="deleteProfile" tabindex="-1" aria-labelledby="deleteProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content bg-dark text-light text-center ">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="deleteProfileLabel">Suppression de votre profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">
                    Voulez-vous vraiment supprimer votre profil? <br>Cela supprimera définitivement toutes les informations relatives à votre compte (mini-posts, commentaires, votes...)?
                </p>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<?php include 'parts/footer.php'; ?>