<?php
// On charge le fichier du modèle.
require('../models/mainModel.php');
require('../models/user.php');

//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];
/**
 * Vérification du formulaire de connexion
 */
if (isset($_POST['login'])) {
    $plainPassword = '';
    if (isset($_POST['email'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $formErrorList['email'] = 'Votre email n\'est pas au bon format.';
        }
    } else {
        $formErrorList['email'] = 'Le champ "Adresse Email" n\'est pas rempli';
    }

    if (!isset($_POST['password'])) {
        $plainPassword = $_POST['password'];
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }

    if (empty($formErrorList)) {
        $connexionUser = new User();
        $passwordHash = $connexionUser->getUserHash();
        if (password_verify($plainPassword, $passwordHash)) {

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

            // GESTION DES COOKIES UTILISATEURS:
            setcookie('email', $email, time() + 60 * 60 * 24 * 30, null, null, false, true); // Expire dans 30 jours, path=null, domain=null, secure=false,httponly=true
            setcookie('password', $hashPassword, time() + 60 * 60 * 24 * 30, null, null, false, true);
        }
    }
}
// On charge le fichier de la vue (l'affichage), qui va présenter les informations dans une page HTML.
require('../views/header.php');
/* RAPPEL:
setcookie — Envoie un cookie
path — Le chemin sur le serveur sur lequel le cookie sera disponible.
domain — Le (sous-)domaine pour lequel le cookie est disponible.
secure — Indique si le cookie doit uniquement être transmis à travers une connexion sécurisée HTTPS depuis le client.
httponly — Lorsque ce paramètre vaut true, le cookie ne sera accessible que par le protocole HTTP. Cela signifie que le cookie ne sera pas accessible via des langages de scripts
*/