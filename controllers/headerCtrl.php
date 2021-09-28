<?php
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
$logMsg = [];
$registerMsg = [];
$success = '';
$error = '';

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
            $registerMsg['checkPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    }

    //Si il n'y a pas d'erreur sur le formulaire...
    if ($registerForm->isValid()) {
        $userExists = $user->checkUserExists();
        if ($userExists == 1) {
            $registerMsg['pseudo']['mail'] = 'Utilisateur déjà existant! Veuillez vous reporter au formulaire de connexion.';
        } else {
            $user->__set('pseudo', $pseudo);
            // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
            // Donc je crée une clé de hachage pour le mot de passe
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $user->__set('password_hash', $hashPassword);
            $user->__set('mail', $mail);
            // On génère le token qui servira à la validation du compte 
            $user->token = random_int(1, 999);
            if ($user->addUser() != 0) {
                $success = 'Votre compte a bien été crée! Vous pouvez vous connecter.';
                //prévoir pour envoyer un mail de validation de l'inscription grâce au token
            } else {
                $message = implode($registerForm->error);
            }
        }
    }
}

/**
 * Vérification du formulaire de CONNEXION
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
        $userExists = $user->checkUserExists();
        // on vérifie l'existence de l'utilisateur, grâce à la méthode checkUserExists; s'il n'existe pas (0), on renvoie un message d'erreur
        if ($userExists == 0) {
            $logMsg['mail'] = 'Utilisateur Inconnu.';
        }
        $user->__set('mail', $mail);
        // on vérifie la concordance entre le mdp indiqué et celui inscrit dans la bdd
        $passwordHash = $user->getUserHash();
        if (!password_verify($password, $passwordHash)) {
            $logMsg['password'] = 'Mot de passe non reconnu.';
        } else {
            // après vérification des informations du formulaire...
            // ...GESTION DE LA SESSION:
            $_SESSION['user']['isConnected'] = true;
            $userInfo = $user->getUserInfoByMail();
            // on enregistre les paramètres de notre visiteur comme variables de session
            $_SESSION['user']['id'] = $userInfo->id;
            $_SESSION['user']['pseudo'] = $userInfo->pseudo;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['levelAccess'] = $userInfo->level;
            $_SESSION['user']['avatar'] = $userInfo->avatar;
            //...puis on redirige vers la page de profil
            header('location: ../profilPage.php');
            exit;
        }
    } else {
        $message = implode($loginForm->error);
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