<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';

// instance de classe ; création d'un nouvel objet, qui appelle la méthode constructeur 
$user = new User();
//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];

/**
 * 
 *  Vérifications du formulaire d'inscription
 * 
 */
if (isset($_POST['register'])) {

    // vérification sur le pseudo 
    if (!empty($_POST['pseudo'])) {
        if (preg_match('/^[a-zA-Z0-9.-_]{3,20}$/', $_POST['pseudo'])) { //on contrôle que le pseudo contient 3 à 20 caractères
            $user->pseudo = htmlspecialchars($_POST['pseudo']); // On hydrate l'attribut pseudo de l'objet $user et on convertit les caractères spéciaux en entités HTML
        } else {
            $formErrorList['pseudo'] = 'Le pseudo doit contenir au moins 3 caractères, sans aucun espace et aucun caractères spéciaux.';
        }
    } else {
        $formErrorList['pseudo'] = 'Pseudo manquant';
    }

    // vérification sur l'adresse email
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // Ceci valide l'adresse de courriel selon la syntaxe défini par la RFC 822
            $user->mail = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }

    // vérification sur le mot de passe
    if (!empty($_POST['password']) && !empty($_POST['checkPassword'])) {
        $password = $_POST['password'];
        $checkPassword = $_POST['checkPassword'];
        // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
        $user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); // je crée une clé de hachage pour le mot de passe
        // On génère le hash qui servira à la validation du compte 
        $user->hash = random_int(1, 999);
        if ($password !== $checkPassword) {
            $formErrorList['checkPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }

    // S'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        // ... on exécute la méthode addUser liée à l'instance PDO $user qui permet d'ajouter un utlisateur
        // et comme le nouvel utilisateur n'est pas indexé...
        if ($user->addUser() != 0) {
            // ... on envoie un mail de validation de l'inscription
        }
    }
}

/**
 * 
 * Vérification du formulaire de connexion
 * 
 */
if (isset($_POST['login'])) {
    if (isset($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['mail']);
        } else {
            $formErrorList['mail'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['mail'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }

    if (!isset($_POST['password'])) {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }
    // s'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        // on vérifie la concordance entre le mdp indiqué et celui inscrit dans la bdd
        $passwordHash = $user->getUserHash();
        if (password_verify($_POST['password'], $passwordHash)) {
            // on a vérifié les informations du formulaire, à savoir si l'email saisi est bien valide, de même pour le mot de passe
            // GESTION DE LA SESSION:
            $_SESSION['user']['isConnected'] = true;
            $userInfo = $user->getUserInfoByMail();
            // on enregistre les paramètres de notre visiteur comme variables de session
            $_SESSION['user']['id'] = $userInfo->id;
            $_SESSION['user']['pseudo'] = $userInfo->pseudo;
            $_SESSION['user']['mail'] = $userInfo->mail;
            $_SESSION['user']['levelAccess'] = $userInfo->level;
            $_SESSION['user']['avatar'] = $userInfo->avatar;

            // // GESTION DES COOKIES UTILISATEURS:
            // setcookie('mail', $mail, time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
            // setcookie('password', $password, time() + 60 * 60 * 24 * 30, null, null, false, true);
            // on redirige notre visiteur vers la page de compte de l'utilisateur
            header('location: ../profilPage.php');
            exit;
        } else {
            header('Location: ../index.php');
            exit;
        }
    } else {
        //Laisse ouvert la fenetre modale !!!!!
    }
}

/**
 * lorsque l'on clique sur le bouton déconnexion, la session prend fin et on est redirigé vers la page d'accueil
 * 
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
