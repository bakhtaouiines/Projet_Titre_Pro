<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$user = new User();
$userPassword = new User();
$userInfo = $user->getUserInfoById();
$successMessage = '';
/**
 * Modification des informations de l'utilisateur
 */
// tableau où seront stockées les erreurs
$formErrorList = [];
var_dump($formErrorList);
if (isset($_POST['updateUser'])) {
    $regex = '/^[A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç][A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç\-\s\']*$/';
    // verif pseudo
    // je vérifie que la valeur dans $_POST à la clé "updatePseudo" est différente du pseudo déjà renseigné par l'utilisateur actuel
    if ($_POST['updatePseudo'] != $user->pseudo) {
        // si oui, je vérifie que l'input n'est pas vide et qu'il existe...
        if (!empty($_POST['updatePseudo'])) {
            // ...puis je vérifie qu'il correspond bien aux conditions de la regex
            if (preg_match($regex, $_POST['updatePseudo'])) {
                //...enfin, j'hydrate l'attribut pseudo de l'objet $user et je convertis les caractères spéciaux en entités HTML
                $user->pseudo = htmlspecialchars($_POST['updatePseudo']);
            } else {
                $formErrorList['updatePseudo'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (25) a été atteint.';
            }
        }
    }
    // verif email
    if (!empty($_POST['updateMail'])) {
        if ($_POST['updateMail'] != $user->mail) {
            if (filter_var($_POST['updateMail'], FILTER_VALIDATE_EMAIL)) {
                $user->mail = htmlspecialchars($_POST['updateMail']);
            } else {
                $formErrorList['updateMail'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (100) a été atteint.';
            }
        }
    }
    // verif mot de passe
    // ancien mot de passe
    if (!empty($_POST['oldPassword'])) {
        // j'exécute la méthode getUserHash() de l'objet $userPassword et stocke dans une variable nommée $hash le mot de passe hashé enregistré dans la BDD
        $hash = $userPassword->getUserHash();
        if (!password_verify($_POST['oldPassword'], $hash)) {
            $formErrorList['oldPassword'] = 'Mauvais mot de passe';
        } else {
            $formErrorList['oldPassword'] = 'Veuillez renseigner votre mot de passe actuel';
        }
        // nouveau mot de passe
        if (!empty($_POST['updatePassword'])) {
            $password = $_POST['updatePassword'];
        } else {
            $formErrorList['updatePassword'] = 'Veuillez renseigner votre nouveau mot de passe';
        }
    }


    // s'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        // si le nouveau mot de passe est différent de l'ancien mot de passe enregistré
        if (($_POST['updatePassword']) != ($_POST['oldPassword'])) {
            // j'hydrate l'attribut password_hash de mon objet $userPassword dans lequel je stocke la saisie, sécurisée grâce ) la fonction password_hash(), qui crée une clé de hachage pour le mdp, avec la constante PASSWORD_DEFAULT (qui est un algorithme de hachage)
            $userPassword->password_hash = password_hash($_POST['updatePassword'], PASSWORD_DEFAULT);
            // ici j'exécute les méthodes updateUserInfo() et updateUserHash() des objets $user et $userPassword
            $user->updateUserInfo();
            $userPassword->updateUserHash();
            $successMessage = 'Modifications enregistrées avec succès!';
        } else {
            echo 'Une erreur est survenue';
        }
    }
}
