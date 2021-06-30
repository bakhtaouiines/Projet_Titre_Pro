<?php
// GESTION DES COOKIES UTILISATEURS
/* RAPPEL:
setcookie — Envoie un cookie
path — Le chemin sur le serveur sur lequel le cookie sera disponible.
domain — Le (sous-)domaine pour lequel le cookie est disponible.
secure — Indique si le cookie doit uniquement être transmis à travers une connexion sécurisée HTTPS depuis le client.
httponly — Lorsque ce paramètre vaut true, le cookie ne sera accessible que par le protocole HTTP. Cela signifie que le cookie ne sera pas accessible via des langages de scripts
*/
$formErrorList = [];
if (isset($_POST['login'])) {

    if (!empty($_POST['logEmail'])) {
        if (preg_match('#^[A-Za-z0-9]*[\-\.\_\]*@[A-Za-z0-9\-\_]+.[a-zA-Z0-9]{2,3}#', $_POST['logEmail'])) {
            $login = htmlspecialchars($_POST['logEmail']);
        } else {
            $formErrorList['logEmail'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['logEmail'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }
    if (!empty($_POST['logPassword'])) {
        $password = $_POST['logPassword'];
    } else {
        $formErrorList['logPassword'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }
    if (empty($formErrorList)) {
        setcookie('logEmail', $_POST['logEmail'], time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
        setcookie('logPassword', $_POST['logPassword'], time() + 60 * 60 * 24 * 30, null, null, false, true);
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
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Projet Titre Pro</title>
</head>

<body>
    <!-- barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
        <div class="container-fluid ">
            <div class="row col-2">
                <a class="navbar-brand text-white col" href="index.html">Logo</a>
                <span id="subtitle" class="row navbar-text text-white fst-italic ms-2">"l'accord parfait entre musique et cinéma"</span>
            </div>
            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll " style="--bs-scroll-height: 100px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white ms-4" id="otherContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">Autre contenu</a>
                        <ul class="dropdown-menu bg-dark text-white" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item text-white" href="#">Un peu d'histoire...</a></li>
                            <li><a class="dropdown-item text-white" href="#">Des anecdotes...</a></li>
                            <li><a class="dropdown-item text-white" href="#">Supports insolites...</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light me-5" type="submit">Search</button>
                    <!-- bouton d'inscription ou log + bouton accès listes -->
                    <!-- Bouton login -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-light me-4">Login</button>
                    <!-- Menu déroulant utilisateur -->
                    <ul class="navbar-nav me-4 my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" id="userContent" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mon compte</a>
                            <ul class="dropdown-menu bg-dark " aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item text-white" href="#">Mon profil</a></li>
                                <li><a class="dropdown-item text-white" href="#">Mes listes d'écoute</a></li>
                                <li><a class="dropdown-item text-white" href="#">Mes votes</a></li>
                                <li><a class="dropdown-item text-white" href="#">Me déconnecter</a></li>

                            </ul>
                        </li>
                    </ul>
                    <!-- bouton accès listes d'écoute -->
                    <a class="btn btn-outline-light px-3" href="#" role="button">
                        <i class="fas fa-music" type="button"></i>
                    </a>

                </div>
            </div>
        </div>
    </nav>
    <!-- Fenêtre modale du bouton login -->
    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login">Mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-------------------------------------------------------------- Formulaire connexion utilisateur---------------------------------------------------->
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="logEmail" class="form-label">Adresse Email<input type="email" class="form-control" id="logEmail" aria-describedby="logEmail" aria-required="true"></label>
                            <?php
                            if (!empty($formErrorList['logEmail'])) {
                            ?>
                                <p><span class="text-danger"><?= $formErrorList['logEmail']; ?></span></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="logPassword" class="form-label">Mot de Passe<input type="password" class="form-control" id="logPassword" aria-required="true"></label>
                            <?php
                            if (!empty($formErrorList['logPassword'])) {
                            ?>
                                <p><span class="text-danger"><?= $formErrorList['logPassword']; ?></span></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="mb-3 form-check">

                            <label class="form-check-label fst-italic" for="rememberUser">Se souvenir de moi<input type="checkbox" class="form-check-input" id="rememberUser"></label>
                        </div>
                        <input type="submit" name="login" value="Se connecter" class="btn btn-primary">
                    </form>
                    <hr>
                    <p class="divider-text text-center">ou</p>
                    <button class="btn btn-primary mb-3" data-bs-target="#signIn" data-bs-toggle="modal" data-bs-dismiss="modal">Créer un compte</button>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenêtre</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------------------------------------------------------------Formulaire création de compte--------------------------->
    <div class="modal fade" id="signIn" aria-hidden="true" aria-labelledby="signIn" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down ">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title" id="signIn">Créer mon compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Mon nom
                                <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastName" aria-required="true" oninput="checkName()">
                            </label>
                            <p id="formErrorName"></p> <!-- on affiche msg d'erreur s'il y en a -->
                            <label for="inputFirstName" class="form-label">Mon prénom
                                <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" aria-required="true" oninput="checkName()">
                            </label>
                            <p id="formErrorName"></p><!-- on affiche msg d'erreur s'il y en a -->
                        </div>
                        <div class="mb-3">
                            <label for="inputPseudo" class="form-label">Créer mon pseudo
                                <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo" aria-required="true">
                            </label>
                            <p id="formErrorPseudo"></p><!-- on affiche msg d'erreur s'il y en a -->
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Mon adresse Email
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" aria-required="true" oninput="checkMail()">
                            </label>
                            <!-- <p><span id="formErrorEmail"></span></p> -->
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Créer mon mot de passe
                                <input type="password" class="form-control" id="inputPassword" aria-required="true" aria-required="true" oninput="checkPassword()">
                            </label>
                            <label for="inputPassword" class="form-label">Vérifier mon mot de passe
                                <input type="password" class="form-control" id="verifPassword" aria-required="true">
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary" name="register" value="Créer mon compte" onclick="verif(inputPassword, verifPassword)">
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-target="#login" data-bs-toggle="modal" data-bs-dismiss="modal">Revenir en arrière</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer la fenêtre</button>
                </div>
            </div>
        </div>
    </div>

    <!--------------------------------------------------------------------------------- Corps de l'accueil-------------------------------------------------------------->
    <div class="carousel slide my-5" data-bs-ride="carousel" id="carousel" data-bs-interval="0">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- Premier slide -->
                <div class="card-group p-5 ">
                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/her.png" class="card-img" alt="affiche du film her">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "> <span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Mélancolie</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/shining.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Horreur/Mystère</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/theshapeofwater.jpg" class="card-img" alt="affiche du film the shape of water">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Romance/Passion</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/conanlebarbare.jpg" class="card-img" alt="affiche du film conan le barbare">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Épique/Héroïque</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Deuxième slide -->
            <div class="carousel-item">
                <div class="card-group p-5">
                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/castleinthesky.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Onirisme/Sérénité</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/vforvendetta.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Pathos</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/platoon.png" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Guerre/Bataille</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/starwars5.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Aventure/Challenge</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Troisième slide -->
            <div class="carousel-item">
                <div class="card-group p-5">
                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/lordoftherings.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Fantastique</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/singinintherain.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Chanter, chanter, chanter...</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/bladerunner.png" class="card-img" alt="affiche du film blade runner">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">Sci-Fi</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card me-2 border-0" style="width: 25rem;">
                        <div class="hover hover-1 text-white rounded">
                            <img src="assets/images/twinpeaks.jpg" class="card-img" alt="affiche du film shining">
                            <div class="hover-1-content">
                                <div class="card-img-overlay">
                                    <h3 class="hover-1-title text-uppercase font-weight-bold text-muted "><span class="font-weight-light">Image </span>Caption</h3>
                                    <a href="#" class="card-title text-decoration-none text-white">
                                        <h5 class="hover-1-description card-title mb-5 text-center">? OVNI ?</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--boutons de contrôles du carousel-->
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon me-5" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon ms-5" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-----------------------------------------------------------footer------------------------------------------->
    <footer class="bg-dark text-center text-white">
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Spotify -->
                <a class="btn btn-floating m-1" style="background-color: #1FD35E;" href="#!" role="button"><i class="fa fa-spotify"></i></a>
                <!-- Deezer -->
                <a class="btn btn-floating m-1" style="background-color: #FFD9ED;" href="#!" role="button"><i class="fab fa-deezer"></i></a>
                <!-- Twitter -->
                <a class="btn btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i class="fa fa-twitter"></i></a>
                <!-- Instagram -->
                <a class="btn btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fa fa-instagram"></i></a>
                <!--Flux RSS-->
                <a class="btn btn-floating m-1" style="background-color: #E14B0C;" href="#!" role="button"><i class="fas fa-rss-square"></i></a>
            </section>
        </div>
        <!-- Copyright à rédiger-->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);"></div>
        <!-- Fin Copyright -->
    </footer>
    <script src="assets/scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/d6f0d1e82c.js" crossorigin="anonymous"></script>

</body>

</html>