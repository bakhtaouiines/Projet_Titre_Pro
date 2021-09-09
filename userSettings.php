<?php
include 'parts/header.php';
require_once 'controllers/userSettingsCtrl.php' ?>

<div class="container bg-light my-5 p-4">
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
                <input type="text" class="form-control" id="updatePseudo" name="updatePseudo" value="<?= $_SESSION['user']['pseudo'] ?>">
                <?php
                if (!empty($formErrorList['updatePseudo'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $formErrorList['updatePseudo']; ?></p>
                <?php
                }
                ?>
            </div>

            <div class="col form-group position-relative">
                <label for="updatePassword" class="form-label">Mot de Passe</label>
                <input type="password" class="form-control" id="updatePassword" name="updatePassword">
                <?php
                if (!empty($formErrorList['updatePassword'])) {
                ?>
                    <p class="fst-italic text-danger"><?= $formErrorList['updatePassword']; ?></p>
                <?php
                }
                ?>
            </div>

            <div class="col form-group position-relative">
                <label for="updateMail" class="form-label">Adresse Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="mailPrepend">@</span>
                    <input type="text" class="form-control" id="updateMail" name="updateMail" aria-describedby="mailPrepend" value="<?= $_SESSION['user']['mail'] ?>">
                    <?php
                    if (!empty($formErrorList['updateMail'])) {
                    ?>
                        <p class="fst-italic text-danger"><?= $formErrorList['updateMail']; ?></p>
                    <?php
                    }
                    ?>
                </div>
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

        <div class="d-flex justify-content-between m-5">
            <button type="submit" id="updateUser" class="btn btn-outline-success btn-sm px-3" name="updateUser">Enregistrer les modifications</button>
            <a href="profilPage.php" type="button" class="btn btn-secondary btn-sm px-3">Annuler</a>
        </div>
    </form>
</div>

<?php include 'parts/footer.php'; ?>