<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';

// instance d'un nouvel objet pour ajouter des utilisateurs 
$newUser = new User();

//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];

/**
 *  Vérifications du formulaire d'inscription
 */
if (isset($_POST['register'])) {

    // vérification sur le pseudo 
    if (!empty($_POST['pseudo'])) {
        if (preg_match('/^[a-zA-Z0-9.-_]{3,20}$/', $_POST['pseudo'])) { //on contrôle que le pseudo contient 3 à 20 caractères
            $newUser->pseudo = htmlspecialchars($_POST['pseudo']); // On hydrate l'attribut pseudo de l'objet $newUser et on convertit les caractères spéciaux en entités HTML
        } else {
            $formErrorList['pseudo'] = 'Le pseudo doit contenir au moins 3 caractères, sans aucun espace et aucun caractères spéciaux.';
        }
    } else {
        $formErrorList['pseudo'] = 'Pseudo manquant';
    }

    // vérification sur l'adresse email
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // Ceci valide l'adresse de courriel selon la syntaxe défini par la RFC 822
            $newUser->mail = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }

    // vérification sur le mot de passe
    if (!empty($_POST['password']) && !empty($_POST['verifPassword'])) {
        $hashPassword = $_POST['password'];
        $verifPassword = $_POST['verifPassword'];
        $newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); // je crée une clé de hachage pour le mot de passe
        if ($hashPassword !== $verifPassword) {
            $formErrorList['verifPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }

    // S'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        // ... on exécute la méthode addUser liée à l'instance PDO $newUser qui permet d'ajouter un utlisateur
        // $newUser->addUser();
        // comme le nouvel utilisateur n'est pas indexé...
        if ($newUser->addUser() != 0) {
            // ... on envoie un mail de validation de l'inscription
        }
    }
}

/**
 * Vérification du formulaire de connexion
 */
if (isset($_POST['login'])) {
    if (isset($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }

    if (!isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }

    if (empty($formErrorList)) {
        $connexionUser = new User();
        $passwordHash = $connexionUser->getUserHash();
        if (password_verify($password, $passwordHash)) {

            // GESTION DE LA SESSION:
            session_start();
            $_SESSION['user']['isConnected'] = true;
            $userInfo = $user->getUserInfoByMail();
            $_SESSION['user']['pseudo'] = $userInfo->pseudo;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['user']['avatar'] = $userInfo->avatar;
            $_SESSION['user']['levelAccess'] = $userInfo->level;
            // on redirige notre visiteur vers la page de compte de l'utilisateur
            header('location: profilPage.php');

            //     // GESTION DES COOKIES UTILISATEURS:
            //     setcookie('email', $email, time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
            //     setcookie('password', $hashPassword, time() + 60 * 60 * 24 * 30, null, null, false, true);
        } else {
            header('Location: ../index.php');
        }
    }
}
// lorsque l'on clique sur le bouton déconnexion, la session prend fin et on est redirigé vers la page d'accueil
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'disconnect') {
        unset($_SESSION['user']);
        header('Location: ../index.php');
        exit;
    }
}
