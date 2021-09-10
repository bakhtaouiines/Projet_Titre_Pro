<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'models/article.php';

$user = new User();
$user->id = $_SESSION['user']['id'];
$successMessage = '';
/**
 * Modification des informations de l'utilisateur
 */
// tableau où seront stockées les erreurs
$formErrorList = [];
if (isset($_POST['updateUser'])) {
    $regex = '/^[A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç][A-Za-zÉÈËéèëÀÂÄàäâÎÏïîÔÖôöÙÛÜûüùÆŒÇç\-\s\']*$/';

    // verif pseudo
    if (!empty($_POST['updatePseudo'])) {
        if (preg_match($regex, $_POST['updatePseudo'])) {
            $user->pseudo = htmlspecialchars($_POST['updatePseudo']); // On hydrate l'attribut pseudo de l'objet $user et on convertit les caractères spéciaux en entités HTML
        } else {
            $formErrorList['updatePseudo'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (25) a été atteint.';
        }
    }

    // verif email
    if (!empty($_POST['updateMail'])) {
        if (filter_var($_POST['updateMail'], FILTER_VALIDATE_EMAIL)) {
            $user->mail = htmlspecialchars($_POST['updateMail']);
        } else {
            $formErrorList['updateMail'] = 'Les caractères saisis ne sont pas valides et/ou le nombre de caractère limite (100) a été atteint.';
        }
    }

    // // verif mot de passe
    // if (!empty($_POST['updatePassword'])) {
    //     $password = $_POST['updatePassword'];
    //     $user->password_hash = password_hash($_POST['updatePassword'], PASSWORD_DEFAULT);
    //     $user->hash = random_int(1, 999);
    // }

    // s'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        $user->updateUserInfo();
        $successMessage = 'Modifications enregistrées avec succès!';
    }
}
