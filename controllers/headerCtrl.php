<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'classes/form.php';

// j'ai crée une variable $controllers avec le chemin fichier 'controllers/...Ctrl.php', qui sera appelé dans la vue la nécessitant; je vérifie au préalable qu'elle existe, puis je l'appelle

if (isset($controllers)) {
    require $controllers;
}
$user = new User();
$registerForm = new Form();
$loginForm = new Form();
$errorMessagePassword = [];
$errorMessage = '';
$message = '';

/**
 *  Vérifications du formulaire d'INSCRIPTION
 */
if (isset($_POST['register'])) {
    //Je récupère les données du formulaire

    //Je vérifie le pseudo
    if (isset($_POST['pseudo'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $registerForm->isNotEmpty('pseudo', $pseudo);
        $registerForm->isValidFormat('pseudo', $pseudo, FORM::PATTERN);
        $registerForm->isUnique('pseudo', $pseudo, 'user');
        $registerForm->isValidLength('pseudo', $pseudo, 3, 20);
    } else {
        $registerForm->error['pseudo'];
    }
    //Je vérifie le mail
    if (isset($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $registerForm->isValidEmail('mail', $mail);
        $registerForm->isUnique('mail', $mail, 'user');
    } else {
        $registerForm->error['mail'];
    }
    //Je vérifie le mot de passe et son check
    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $registerForm->isNotEmpty('password', $password);
        $registerForm->isValidLength('password', $password, 6, 255);
    } else {
        $registerForm->error['password'];
    }
    if (isset($_POST['checkPassword'])) {
        $checkPassword = htmlspecialchars($_POST['checkPassword']);
        // Je vérifie que le mot de passe indiqué dans le check est identique à la valeur du champ password
        if ($password !== $checkPassword) {
            $errorMessagePassword['checkPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    }

    //Si il n'y a pas d'erreur sur le formulaire...
    if ($registerForm->isValid()) {
        //...je crée une instance de classe ; création d'un nouvel objet
        $user->__set('pseudo', $pseudo);
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        // Donc je crée une clé de hachage pour le mot de passe
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->__set('password_hash', $hashPassword);
        $user->__set('mail', $mail);
        // On génère le hash qui servira à la validation du compte 
        $user->token = random_int(1, 999);
        if ($user->addUser() != 0) {
            $message = 'Votre compte a bien été crée! Vous pouvez vous connecter.';
            //prévoir pour envoyer un mail de validation de l'inscription
        }
    } else {
        //Laisse ouvert la fenetre modale !!!!! ASAP
        $message = implode($registerForm->error);
    }
}

/**
 * Vérification du formulaire de connexion
 */
if (isset($_POST['login'])) {
    if (isset($_POST['mail'])) {
        $mail = htmlspecialchars($_POST['mail']);
        $loginForm->isNotEmpty('mail', $mail);
        $loginForm->isValidEmail('mail', $mail);
    } else {
        $loginForm->error['mail'];
    }
    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
        $loginForm->isNotEmpty('password', $password);
        $loginForm->isValidLength('password', $password, 6, 255);
    } else {
        $loginForm->error['password'];
    }
    // s'il n'y a pas d'erreurs...
    if ($loginForm->isValid()) {
                $user->__set('mail', $mail);
        // on vérifie la concordance entre le mdp indiqué et celui inscrit dans la bdd
        $user->checkUserExists();
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
            header('location: ../profilPage.php');
            exit;
        } else {
            //Laisse ouvert la fenetre modale !!!!!
            $message = implode($loginForm->error);
            $errorMessage = 'Mot de passe non reconnu.';
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

//  $user = new User();
//  $user->__set('id', 80);
//  $user->__set('password_hash', password_hash('141095',PASSWORD_DEFAULT));
//  $user->updateUserHash();