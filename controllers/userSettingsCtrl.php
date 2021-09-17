<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'classes/form.php';
require_once 'models/comment.php';
require_once 'models/playlist.php';

$updateForm = new Form();
$updateArray = [];
$successMessage = '';

/**
 * Modification des informations de l'utilisateur
 */
if (isset($_POST['updateUser'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['updatePseudo'])) {
        $updatePseudo = htmlspecialchars($_POST['updatePseudo']);
        //Je vérifie le pseudo
        $updateForm->isUnique('pseudo', $updatePseudo, 'user');
        $updateForm->isNotEmpty('pseudo', $updatePseudo);
        $updateForm->isValidFormat('pseudo', $updatePseudo, FORM::PATTERN);
        $updateForm->isValidLength('pseudo', $updatePseudo, 3, 20);
        if (!isset($updateForm->error['updatePseudo'])) {
            $updateArray['pseudo'] = $updatePseudo;
        }
    }
    if (isset($_POST['updateMail'])) {
        $updateMail = htmlspecialchars($_POST['updateMail']);
        //Je vérifie le mail
        $updateForm->isUnique('mail', $updateMail, 'user');
        $updateForm->isNotEmpty('mail', $updateMail);
        $updateForm->isValidEmail('mail', $updateMail);
        if (!isset($updateForm->error['mail'])) {
            $updateArray['mail'] = $updateMail;
        }
    }
    // Je vérifie que l'ancien mot de passe correspond bien au hash enregistré dans la BDD
    if (isset($_POST['oldPassword'])) {
        $oldPassword = $_POST['oldPassword'];
        //j'exécute la méthode getUserHash() de l'objet $userPassword et stocke dans une variable nommée $hash le mot de passe hashé enregistré dans la BDD
        $userPassword = new User();
        $hash = $userPassword->getUserHash();
        //   si le mot de passe n'est pas bon (càd, qu'il est différent de celui indiqué dans la BDD)...
        if (!password_verify($_POST['oldPassword'], $hash)) {
            //... j'indique un message d'erreur
            $error['oldPassword'] = 'Mauvais mot de passe';
        }
        //nouveau mot de passe
        if (isset($_POST['updatePassword'])) {
            $updatePassword = $_POST['updatePassword'];
            //Je vérifie l'ancien et nouveau mot de passe
            $updateForm->isNotEmpty('oldPassword', $oldPassword);
            $updateForm->isValidLength('oldPassword', $oldPassword, 6, 255);
            $updateForm->isNotEmpty('updatePassword', $updatePassword);
            $updateForm->isValidLength('updatePassword', $updatePassword, 6, 255);
        } else {
            $error['oldPassword'];
            $error['updatePassword'];
        }
    }


    // vérif avatar
    // if (isset($_POST['submitAvatar'])) {
    //     if (isset($_FILES['avatar'])) {
    //         $avatar = $_FILES['avatar'];
    //     }
    //     $picture->isNotEmpty('avatar', $avatar);
    //     $picture->isValidLength('avatar', $avatar, $widthMax = SELF::WIDTH_MAX, $heightMax = SELF::HEIGHT_MAX);
    //     $picture->isValidFormat('avatar', $avatar, $format = SELF::EXTENSIONS);
    // }

    //Si il n'y a pas d'erreur sur le formulaire...
    if (!empty($updateArray)) {
        //...je crée une instance de classe ; création d'un nouvel objet
        $user = new User();
        // si le nouveau mot de passe est bien différent de l'ancien mot de passe enregistré
        if (($_POST['updatePassword']) != ($_POST['oldPassword'])) {
            // j'hydrate l'attribut password_hash de mon objet $userPassword dans lequel je stocke la saisie, sécurisée grâce à la fonction password_hash(), qui crée une clé de hachage pour le mdp, avec la constante PASSWORD_DEFAULT (qui est un algorithme de hachage)
            $userPassword->password_hash = password_hash($_POST['updatePassword'], PASSWORD_DEFAULT);
            $user->__set('id', $_SESSION['user']['id']);
            $user->__set('pseudo', $updateArray['pseudo']);
            $user->__set('mail', $updateArray['mail']);
            $user->__set('updatePassword', $updateArray['updatePassword']);
            // ici j'exécute les méthodes updateUserInfo() et updateUserHash() des objets $user et $userPassword
            $isUpdated = $user->updateUserInfo($updateArray);
            if ($isUpdated) {
                $_SESSION['user']['mail'] = $updateArray['mail'];
                $_SESSION['user']['pseudo'] = $updateArray['pseudo'];
            }
            $userPassword->updateUserHash();
            $successMessage = 'Modifications enregistrées avec succès!';
        }
    }
}
