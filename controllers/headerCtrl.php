<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'classes/form.php';

$registerForm = new Form();
$loginForm = new Form();
$errorMessagePassword = [];
$userCreated = '';
$errorMessage = '';
/**
 *  Vérifications du formulaire d'INSCRIPTION
 */
if (isset($_POST['register'])) {
    $pseudo = '';
    $mail = '';
    $password = '';
    $checkPassword = '';

    //Je récupère les données du formulaire
    if (isset($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
    }
    if (isset($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
    }
    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    }
    if (isset($_POST['checkPassword'])) {
        $checkPassword = htmlspecialchars($_POST['checkPassword']);
    }

    //Je vérifie le pseudo
    $registerForm->isNotEmpty('pseudo', $pseudo);
    $registerForm->isValidFormat('pseudo', $pseudo, FORM::PATTERN);
    $registerForm->isUnique('pseudo', $pseudo, 'user');
    $registerForm->isValidLength('pseudo', $pseudo, 3, 20);
    //Je vérifie le mail
    $registerForm->isNotEmpty('mail', $mail);
    $registerForm->isValidEmail('mail', $mail);
    $registerForm->isUnique('mail', $mail, 'user');
    //Je vérifie le mot de passe et son check
    $registerForm->isNotEmpty('password', $password);
    $registerForm->isValidLength('password', $password, 6, 255);
    $registerForm->isNotEmpty('checkPassword', $checkPassword);
    $registerForm->isValidLength('checkPassword', $checkPassword, 6, 255);

    //Si il n'y a pas d'erreur sur le formulaire...
    if ($registerForm->isValid()) {
        //...et si le mot de passe indiqué dans le check est identique à la valeur du champ password
        if ($password !== $checkPassword) {
            $errorMessagePassword['checkPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
        //...je crée une instance de classe ; création d'un nouvel objet, qui appelle la méthode constructeur 
        $user = new User();
        $user->__set('pseudo', $pseudo);
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        // Donc je crée une clé de hachage pour le mot de passe
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->__set('password_hash', $hashPassword);
        $user->__set('mail', $mail);
        // On génère le hash qui servira à la validation du compte 
        $user->hash = random_int(1, 999);
        if ($user->addUser() != 0) {
            $userCreated = 'Votre compte a bien été crée! Vous pouvez vous connecter.';
            //envoyer un mail de validation de l'inscription
        } else {
            //Laisse ouvert la fenetre modale !!!!! 
        }
    }
}

/**
 * Vérification du formulaire de connexion
 */
if (isset($_POST['login'])) {
    $mail = '';
    $password = '';

    if (isset($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
    }
    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    }

    $loginForm->isNotEmpty('mail', $mail);
    $loginForm->isValidEmail('mail', $mail);
    // $loginForm->isNotEmpty('password', $password);

    // s'il n'y a pas d'erreurs...
    if ($loginForm->isValid()) {
        $user = new User();
        $user->__set('mail', $mail);
        // on vérifie la concordance entre le mdp indiqué et celui inscrit dans la bdd
        $passwordHash = $user->getUserHash();
        if (password_verify($password, $passwordHash)) {
            // on a vérifié les informations du formulaire, à savoir si l'email saisi est bien valide, de même pour le mot de passe
            // GESTION DE LA SESSION:
            $_SESSION['user']['isConnected'] = true;
            $userInfo = $user->getUserInfoByMail();
            // on enregistre les paramètres de notre visiteur comme variables de session
            $_SESSION['user']['id'] = $userInfo->id;
            $_SESSION['user']['pseudo'] = $userInfo->pseudo;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['levelAccess'] = $userInfo->level;
            $_SESSION['user']['avatar'] = $userInfo->avatar;
            // GESTION DES COOKIES UTILISATEURS:
            setcookie('mail', $mail, time() + 3600, null, null, false, true); // Expire dans 1 heure, path=null, domain=null, secure=false,httponly=true
            setcookie('password', $password, time() + 3600, null, null, false, true);
            // on redirige notre visiteur vers la page de compte de l'utilisateur
            header('location: ../profilPage.php');
            exit;
        } else {
            //Laisse ouvert la fenetre modale !!!!!
        }
    }
}
/**
 * lorsque l'on clique sur le bouton déconnexion, la session prend fin et on est redirigé vers la page d'accueil
 */
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'disconnect') {
        // On détruit les variables de notre session
        unset($_SESSION['user']);
        // On redirige le visiteur vers la page d'accueil
        header('Location: ../index.php');
        exit;
    }
}
