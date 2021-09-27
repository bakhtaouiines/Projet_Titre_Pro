<?php
require_once 'config.php';
require_once 'controllers/headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style/style.css">
    <!-- Tiny MCE -->
    <script src=" https://cdn.tiny.cloud/1/0ovoaprxuy8l9dx3lgrrwdl5ec0fj54v4s5eu8n05a2tfe88/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <!-- barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id="#menu">
        <div class="container-fluid me-5">
            <!-- titre + logo -->
            <div class="col-auto">
                <a href="index.php" class="text-decoration-none"><img class="navbar-brand col" src="assets/images/logo.png" style="width: 5rem; height:auto">
                    <span id="title" class="text-uppercase text-light me-2">orpheus</span><span id="collection">collection</span>
                </a>
            </div>
            <!--Menu Burger-->
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
                <ul class="navbar-nav mb-lg-0">
                    <div class="actionMenu d-flex align-items-center text-uppercase">
                        <a href="ostindex.php" class="btn btn-outline-light rounded me-5 bi bi-collection-play" type="button" title="index"> Index</a>
                        <!-- bouton d'accès aux articles -->
                        <li class="nav-item me-5">
                            <a href="../articlelist.php" role="button" class="btn btn-outline-light bi bi-book" id="otherContent" role="button" aria-expanded="false"> Espace lecture</a>
                        </li>
                        <!-- A afficher lorsque l'utilisateur est connecté -->
                        <?php
                        // On récupère nos variables de session
                        if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) {
                        ?>
                            <!-- Menu déroulant item -->
                            <li class="nav-item dropdown me-5">
                                <i class="bi bi-menu-app fs-3 text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end text-center text-uppercase">
                                    <?php
                                    // On récupère nos variables de session
                                    if (isset($_SESSION['user']['levelAccess']) && $_SESSION['user']['levelAccess'] == ROLE_ADMIN) {
                                    ?>
                                        <!-- A afficher lorsque l'administrateur est connecté-->
                                        <a class="dropdown-item fw-bolder" href="adminSettings.php">Gestion du site</a>
                                    <?php
                                    }
                                    ?>
                                    <a class="dropdown-item" href="playlistList.php">Playlists</a>
                                    <a class="dropdown-item" href="miniPostList.php">Mini-Post</a>
                                </ul>
                            </li>
                            <!-- Menu déroulant utilisateur -->
                            <li class="nav-item dropdown">
                                <div class="avatar-toggle dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <!-- si l'image existe, on l'affiche, sinon on affiche l'image par défaut-->
                                    <img src="<?= (!empty($_SESSION['user']['avatar'])) ? TARGET . $_SESSION['user']['avatar'] : $defaultImage ?>" alt="Profil de <?= $_SESSION['user']['pseudo'] ?>" class="navAvatar">
                                </div>
                                <ul class="dropdown-menu text-center">
                                    <li class="helloUser dropdown-item">Hello <?= $_SESSION['user']['pseudo'] ?>
                                    </li>
                                    <a href="profilPage.php?userID=<?= $_SESSION['user']['pseudo'] ?>" class="dropdown-item" href="<?= $_SESSION['user']['pseudo'] ?>">Mon profil</a>
                                    <a class="dropdown-item" href="userSettings.php?userID=<?= $_SESSION['user']['pseudo'] ?>">Éditer mon profil</a>
                                    <li><a class="dropdown-item" href="playlistCreation.php">Créer une playlist</a></li>
                                    <li><a class="dropdown-item" href="miniPostCreation.php">Créer un mini-post</a></li>
                                    <li><a class="dropdown-item" href="?action=disconnect">Me déconnecter</a></li>
                                </ul>
                            </li>

                        <?php
                        } else {
                        ?>
                            <!-- Bouton login -->
                            <button type="submit" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-light me-4">Connexion/Inscription</button>
                        <?php
                        }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Fenêtre modale du bouton login -->
    <div class="modal fade" id="login" role="dialog" tabindex="-1" aria-labelledby="login" aria-hidden="true" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <p class="modal-title text-uppercase fs-5">Mon compte</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- FORMULAIRE CONNEXION UTILISATEUR -->
                <div class="modal-body p-4 p-md-5 text-light">
                    <form method="POST" action="" name="logForm" id="logForm">
                        <!-- EMAIL -->
                        <div class="mb-3">
                            <div class="icon d-flex align-items-center justify-content-center mb-4">
                                <span>
                                    <i class="bi bi-person-fill"></i>
                                </span>
                            </div>
                            <label for="mail" class="form-label">Adresse Email
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="email" class="form-control" id="mail" name="mail" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($loginForm->error['mail'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $message; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- MOT DE PASSE -->
                        <div class=" mb-3">
                            <label for="password" class="form-label">Mot de Passe
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="password" class="form-control" id="password" name="password" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($loginForm->error['password'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $message; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!--validation de formulaire-->
                        <input type="submit" name="login" id="loginBtn" value="Se connecter" class="form-control btn btn-primary rounded submit px-1" disabled="disabled">
                        <p class="fst-italic text-danger"><?= $errorMessage ?></p>
                    </form>
                    <!-- bouton trigger 2e fenêtre modale -->
                    <div class="footerLog modal-footer justify-content-center">
                        <p>Vous n'êtes pas membre?
                            <button class="btn btn-primary" data-bs-target="#register" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE CREATION DE COMPTE UTILISATEUR -->
    <div class="modal fade" id="register" aria-hidden="true" aria-labelledby="register">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-uppercase">Créer mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php" name="registerForm" id="registerForm">
                        <!-- PSEUDO -->
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Créer mon pseudo
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($registerForm->error['pseudo'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $message ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label for="mail" class="form-label">Mon adresse Email
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="email" class="form-control" id="mailRegister" name="mail" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($registerForm->error['mail'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $message ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- MOT DE PASSE -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Créer mon mot de passe
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="password" class="form-control" id="password" aria-required="true" aria-required="true" name="password" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($registerForm->error['password'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $message ?></p>
                            <?php
                            }
                            ?>
                            <!-- VERIF MOT DE PASSE -->
                            <label for="checkPassword" class="form-label">Vérifier mon mot de passe
                                <span class="mandatory">
                                    <p class="text-muted mb-0">ce champ est obligatoire</p>
                                </span>
                                <input type="password" class="form-control" id="checkPassword" aria-required="true" name="checkPassword" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($errorMessagePassword['checkPassword'])) {
                            ?>
                                <p class="fst-italic text-danger"><?= $errorMessagePassword['checkPassword']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!--validation de formulaire-->
                        <input type="submit" class="btn btn-primary" id="registerBtn" name="register" value="Créer mon compte" disabled="disabled" onclick="snackbarValidation()">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Revenir en arrière</button>
                </div>
            </div>
        </div>
    </div>
    <!-- message dans une snackbar, informant que le compte a bien été crée -->
    <div id="snackbar">
        <?= $message; ?>
    </div>