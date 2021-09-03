<?php
require_once 'config.php';
require 'controllers/headerCtrl.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <!-- barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top" id="#menu">
        <div class="container-fluid ">
            <div class="row col-2">
                <a class="navbar-brand text-white col" href="/index.php">Logo</a>
                <span id="subtitle" class="row navbar-text text-white fst-italic ms-2">"l'accord parfait entre musique et cinéma"</span>
            </div>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
                <ul class="navbar-nav mb-lg-0">
                    <!-- bouton d'accès aux articles -->
                    <li class="nav-item me-5 my-2">
                        <a href="../views/articlelist.php" role="button" class="nav-link ms-4 btn btn-outline-light" id="otherContent" role="button" aria-expanded="false">Espace lecture</a>
                    </li>

                    <!-- barre de recherche -->
                    <div class="d-flex align-items-center">
                        <input class="form-control mx-3" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-light me-2" type="submit" title="rechercher"><i class="bi bi-search"></i></button>
                        <a href="#" class="btn btn-outline-light me-5" type="button" title="index"><i class="bi bi-book"></i></a>

                        <!-- A afficher lorsque l'utilisateur est connecté -->
                        <?php
                        // On récupère nos variables de session
                        if (isset($_SESSION['user']['isConnected']) && $_SESSION['user']['isConnected']) { ?>
                            <!-- Menu déroulant utilisateur -->
                            <ul class="navbar-nav me-4 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-white" id="userContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello <?= $_SESSION['user']['pseudo'] ?></a>
                                    <ul class="dropdown-menu bg-dark " aria-labelledby="navbarScrollingDropdown">
                                        <li><a class="dropdown-item text-white" href="profilPage.php?userID=#">Mon profil</a></li>
                                        <li><a class="dropdown-item text-white" href="#">Mes listes d'écoute</a></li>
                                        <li><a class="dropdown-item text-white" href="#">Mes votes</a></li>
                                        <li><a class="dropdown-item text-white" href="#">Mes mini-post</a></li>
                                        <li><a class="dropdown-item text-white" href="?action=disconnect">Me déconnecter</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- bouton accès listes d'écoute -->
                            <a class="btn btn-outline-light px-2" href="#" role="button">
                                <i class="bi bi-music-player fs-3"></i>
                            </a>
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
    <div class="modal fade" id="login" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <p class="modal-title text-uppercase fs-5">Mon compte</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- FORMULAIRE CONNEXION UTILISATEUR -->
                <div class="modal-body p-4 p-md-5">
                    <form method="POST" action="" name="logForm" id="logForm">
                        <div class="mb-3">
                            <div class="icon d-flex align-items-center justify-content-center mb-4">
                                <span>
                                    <i class="bi bi-person-fill"></i>
                                </span>
                            </div>
                            <label for="emailLog" class="form-label">Adresse Email*
                                <input type="email" class="form-control" id="email" name="emailLog" aria-describedby="email" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['emailLog'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['emailLog']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class=" mb-3">
                            <label for="passwordLog" class="form-label">Mot de Passe*
                                <input type="password" class="form-control" id="password" name="passwordLog" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['passwordLog'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['passwordLog']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3 form-check">
                            <p class="fst-italic">Mot de passe oublié?
                                <a href="" class="text-danger">Cliquez ici!</a>
                            </p>
                        </div>
                        <!--validation de formulaire-->
                        <input type="submit" id="loginBtn" name="login" value="Se connecter" class="form-control btn btn-primary rounded submit px-1" disabled="disabled">
                    </form>
                    <hr>
                    <!-- bouton trigger 2e fenêtre modale -->
                    <div class="modal-footer justify-content-center">
                        <p>Vous n'êtes pas membre? <button class="btn btn-primary" data-bs-target="#register" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FORMULAIRE CREATION DE COMPTE UTILISATEUR -->
    <div class="modal fade" id="register" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="register">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down ">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-uppercase">Créer mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php" name="registerForm" id="registerForm">

                        <!-- PSEUDO -->
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Créer mon pseudo*
                                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['pseudo'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['pseudo']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Mon adresse Email*
                                <input type="email" class="form-control" id="emailRegister" name="email" aria-describedby="email" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['email'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['email']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- MOT DE PASSE -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Créer mon mot de passe*
                                <input type="password" class="form-control" id="passwordRegister" aria-required="true" aria-required="true" name="password" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['password'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['password']; ?></p>
                            <?php
                            }
                            ?>
                            <!-- VERIF MOT DE PASSE -->
                            <label for="verifPassword" class="form-label">Vérifier mon mot de passe*
                                <input type="password" class="form-control" id="verifPassword" aria-required="true" name="verifPassword" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['verifPassword'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['verifPassword']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!--validation de formulaire-->
                        <input type="submit" class="btn btn-primary" id="registerBtn" name="register" value="Créer mon compte" disabled="disabled">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Revenir en arrière</button>
                </div>
            </div>
        </div>
    </div>