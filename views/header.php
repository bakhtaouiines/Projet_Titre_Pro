<?php
/* RAPPEL:
setcookie — Envoie un cookie
path — Le chemin sur le serveur sur lequel le cookie sera disponible.
domain — Le (sous-)domaine pour lequel le cookie est disponible.
secure — Indique si le cookie doit uniquement être transmis à travers une connexion sécurisée HTTPS depuis le client.
httponly — Lorsque ce paramètre vaut true, le cookie ne sera accessible que par le protocole HTTP. Cela signifie que le cookie ne sera pas accessible via des langages de scripts
*/
//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];
///////////////////////////////////////////////////////////////vérifications du formulaire de connexion////////////////////////////////////////////////
if (isset($_POST['login'])) {
    if (!empty($_POST['email'])) {
        if (preg_match('#^[A-Za-z0-9]*[\-\.\_\]*@[A-Za-z0-9\-\_]+.[a-zA-Z0-9]{2,3}#', $_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }
    if (empty($formErrorList)) {
        // GESTION DE LA SESSION:
        session_start();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        // on redirige notre visiteur vers la page de compte de l'utilisateur
        header('location: userPage.php');
        // GESTION DES COOKIES UTILISATEURS:
        setcookie('email', $email, time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
        setcookie('password', $password, time() + 60 * 60 * 24 * 30, null, null, false, true);
    }
}

/////////////////////////////////////////////////////vérifications du formulaire d'inscription/////////////////////////////////////////////////
if (isset($_POST['register'])) {
    $regex = '/^[A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç][A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç\-\s\']*$/';

    // verif pseudo
    if (!empty($_POST['pseudo'])) {
        if (preg_match('/^[a-zA-Z0-9.-_]{3,20}$/', $_POST['pseudo'])) { //on contrôle que le pseudo contient 3 à 20 caractères
            $pseudo = htmlspecialchars($_POST['pseudo']);
        } else {
            $formErrorList['pseudo'] = 'Le pseudo doit contenir au moins 3 caractères, sans aucun espace et aucun caractères spéciaux.';
        }
    } else {
        $formErrorList['pseudo'] = 'Pseudo manquant';
    }
    // verif email
    if (!empty($_POST['email'])) {
        if (preg_match('#^[A-Za-z0-9]*[\-\.\_\]*@[A-Za-z0-9\-\_]+.[a-zA-Z0-9]{2,3}#', $_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }
    // verif mdp
    if (!empty($_POST['password']) && !empty($_POST['verifPassword'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // je crée une clé de hachage pour le mot de passe
        $verifPassword = $_POST['verifPassword'];
        if ($password !== $verifPassword) {
            $formErrorList['verifPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }
    if (empty($formErrorList)) {
        // GESTION DE LA SESSION:
        session_start();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        // on redirige notre visiteur vers la page de compte de l'utilisateur
        header('location: userPage.php');
        exit;
        // GESTION DES COOKIES UTILISATEURS:
        setcookie('email', $email, time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
        setcookie('password', $password, time() + 60 * 60 * 24 * 30, null, null, false, true);
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BS CSS -->
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
                    <li class="nav-item me-5 my-2">
                        <a href="../views/articlelist.php" role="button" class="nav-link ms-4 btn btn-outline-light" id="otherContent" role="button" aria-expanded="false">Espace lecture</a>
                    </li>
                    <div class="d-flex align-items-center">
                        <input class="form-control mx-3" type="search" placeholder="Rechercher" aria-label="Search">
                        <button class="btn btn-outline-light me-5" type="submit"><i class="bi bi-search"></i></button>
                        <!-- bouton d'inscription ou log + bouton accès listes -->
                        <!-- Bouton login -->
                        <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-light me-4">Login</button>

                        <!-- A afficher lorsque l'utilisateur est connecté -->
                        <!-- Menu déroulant utilisateur -->
                        <ul class="navbar-nav me-4 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" id="userContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon compte</a>
                                <ul class="dropdown-menu bg-dark " aria-labelledby="navbarScrollingDropdown">
                                    <li><a class="dropdown-item text-white" href="profilPage.php">Mon profil</a></li>
                                    <li><a class="dropdown-item text-white" href="#">Mes listes d'écoute</a></li>
                                    <li><a class="dropdown-item text-white" href="#">Mes votes</a></li>
                                    <li><a class="dropdown-item text-white" href="#">Mes mini-post</a></li>
                                    <li><a class="dropdown-item text-white" href="#">Me déconnecter</a></li>

                                </ul>
                            </li>
                        </ul>
                        <!-- A afficher lorsque l'utilisateur est connecté -->
                        <!-- bouton accès listes d'écoute -->
                        <a class="btn btn-outline-light px-2" href="#" role="button">
                            <i class="bi bi-music-player fs-3"></i>
                        </a>
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
                <div class="modal-body p-4 p-md-5">
                    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <!-------------------------------------------------------------- Formulaire connexion utilisateur---------------------------------------------------->
                    <form method="POST" action="" name="logForm" id="logForm">
                        <div class="mb-3">
                            <div class="icon d-flex align-items-center justify-content-center mb-4">
                                <span>
                                    <i class="bi bi-person-fill"></i>
                                </span>
                            </div>
                            <label for="email" class="form-label">Adresse Email*
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['email'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['email']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class=" mb-3">
                            <label for="password" class="form-label">Mot de Passe*
                                <input type="password" class="form-control" id="password" name="password" aria-required="true" oninput="checkLogForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['password'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['password']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- <div class="mb-3 form-check">
                            <label class="form-check-label fst-italic" for="rememberUser">Se souvenir de moi
                                <input type="checkbox" class="form-check-input" id="rememberUser">
                            </label>
                        </div> -->
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
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <!--------------------------------------------------------------------------------------Formulaire création de compte--------------------------->

    <div class="modal fade" id="register" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="register">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down ">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-uppercase">Créer mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php" name="registerForm" id="registerForm">
                        <div class="mb-3">
                            <!-- NOM DE FAMILLE -->
                            <label for="lastName" class="form-label">Mon nom*
                                <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['lastName'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['lastName']; ?></p>
                            <?php
                            }
                            ?>
                            <!-- PRÉNOM -->
                            <label for="firstName" class="form-label">Mon prénom*
                                <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" aria-required="true" oninput="checkRegisterForm()">
                            </label>
                            <?php
                            if (!empty($formErrorList['firstName'])) {
                            ?>
                                <p class="text-danger"><?= $formErrorList['firstName']; ?></p>
                            <?php
                            }
                            ?>
                        </div>
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
    <!---------------------------------------------------------------------------------------------------------------------------------------------------------------->