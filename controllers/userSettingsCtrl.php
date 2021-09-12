<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'classes/form.php';

$updateForm = new Form();

$errorMessagePassword = [];
$successMessage = '';
/**
 * Modification des informations de l'utilisateur
 */
if (isset($_POST['updateUser'])) {

    $updatePseudo = '';
    $updateMail = '';
    $oldPassword = '';
    $updatePassword = '';
    //Je récupère les données du formulaire
    if (isset($_POST['updatePseudo'])) {
        $updatePseudo = htmlspecialchars($_POST['updatePseudo']);
    }

    if (isset($_POST['updateMail'])) {
        $updateMail = htmlspecialchars($_POST['updateMail']);
    }
    // verif mot de passe
    // ancien mot de passe
    if (isset($_POST['oldPassword'])) {
        // j'exécute la méthode getUserHash() de l'objet $userPassword et stocke dans une variable nommée $hash le mot de passe hashé enregistré dans la BDD
        $userPassword = new User();
        $hash = $userPassword->getUserHash();
        if (!password_verify($_POST['oldPassword'], $hash)) {
            $errorMessagePassword['oldPassword'] = 'Mauvais mot de passe';
        }
        // nouveau mot de passe
        if (isset($_POST['updatePassword'])) {
            $updatePassword = $_POST['updatePassword'];
        }
    }

    //Je vérifie le pseudo
    $updateForm->isNotEmpty('updatePseudo', $updatePseudo);
    $updateForm->isValidFormat('updatePseudo', $updatePseudo, FORM::PATTERN);
    $updateForm->isUnique('updatePseudo', $updatePseudo, 'user');
    $updateForm->isValidLength('updatePseudo', $updatePseudo, 3, 20);

    //Je vérifie le mail
    $updateForm->isNotEmpty('updateMail', $updateMail);
    $updateForm->isValidEmail('updateMail', $updateMail);
    $updateForm->isUnique('updateMail', $updateMail, 'user');

    //Je vérifie l'ancien et nouveau mdp
    $updateForm->isNotEmpty('oldPassword', $oldPassword);
    $updateForm->isValidLength('oldPassword', $oldPassword, 6, 255);
    $updateForm->isNotEmpty('updatePassword', $updatePassword);
    $updateForm->isValidLength('updatePassword', $updatePassword, 6, 255);

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
    if ($updateForm->isValid()) {
        //...je crée une instance de classe ; création d'un nouvel objet, qui appelle la méthode constructeur 
        $user = new User();
        // si le nouveau mot de passe est bien différent de l'ancien mot de passe enregistré
        if (($_POST['updatePassword']) != ($_POST['oldPassword'])) {
            // j'hydrate l'attribut password_hash de mon objet $userPassword dans lequel je stocke la saisie, sécurisée grâce ) la fonction password_hash(), qui crée une clé de hachage pour le mdp, avec la constante PASSWORD_DEFAULT (qui est un algorithme de hachage)
            $userPassword->password_hash = password_hash($_POST['updatePassword'], PASSWORD_DEFAULT);
            $user->__set('updatePseudo', $updatePseudo);
            $user->__set('updateMail', $updateMail);
            // ici j'exécute les méthodes updateUserInfo() et updateUserHash() des objets $user et $userPassword
            $user->updateUserInfo();
            $userPassword->updateUserHash();
            $successMessage = 'Modifications enregistrées avec succès!';
        }
    }
}
