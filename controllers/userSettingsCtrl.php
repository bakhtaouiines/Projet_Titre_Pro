<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$user = new User();
$user->id = $_SESSION['user']['id'];
/**
 * Modification des informations de l'utilisateur
 */
// tableau où seront stockées les erreurs
$formErrorList = [];
if (isset($_POST['updateUser'])) {
    $regex = '/^[A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç][A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç\-\s\']*$/';

    // verif nom
    if (isset($_POST['updatePseudo'])) {
        if (preg_match($regex, $_POST['updatePseudo'])) {
            $user->pseudo = htmlspecialchars($_POST['updatePseudo']); // On hydrate l'attribut lastname de l'objet $user et on convertit les caractères spéciaux en entités HTML
        } else {
            $errors['updatePseudo'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (25) a été atteint.';
        }
    }

    // verif email
    if (isset($_POST['updateMail'])) {
        if (filter_var($_POST['updateMail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['updateMail']);
        } else {
            $errors['updateMail'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (100) a été atteint.';
        }
    }

    // verif mot de passe
    if (isset($_POST['updatePassword'])) {
        $password = $_POST['updatePassword'];
        $user->password_hash = password_hash($_POST['updatePassword'], PASSWORD_DEFAULT);
        $user->hash = random_int(1, 999);
    }
    // s'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        $user->updateUserInfo();
    }
}
