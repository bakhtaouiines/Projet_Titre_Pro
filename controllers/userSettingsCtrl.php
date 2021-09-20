<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
require_once 'classes/form.php';
require_once 'models/comment.php';
require_once 'models/playlist.php';

/**
 * Définitions des constantes, tableaux de données et variables
 * 
 */
// Constantes (valeurs qui ne changeront pas)
define('MAX_SIZE', 5242880);  // Taille max de 5mo 
define('WIDTH_MAX', 200);   // Largeur max de l'image en pixels
define('HEIGHT_MAX', 200); // Hauteur max de l'image en pixels

// Tableaux de données
$extensionArray = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
$avatarInfos = array();

// Variables
$user = new User(); // création d'une instance de classe; création d'un nouvel objet
$updateForm = new Form();
$updateArray = [];
$extension = '';
$message = '';
$avatarName = '';

/**
 * Création du répertoire cible, si il est inexistant
 */
if (!is_dir(TARGET)) {
    if (!mkdir(TARGET, 0755)) { //cette permission implique le propriétaire peut lire/écrire/exécuter, les utilisateurs (groupe) peuvent lire/exécuter, les autres peuvent lire/exécuter
        exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement.');
    }
}

/**
 * Vérification formulaire de modification des informations de l'utilisateur (pseudo,mail,avatar)
 */
if (isset($_POST['updateAvatar'])) {
    // On vérifie l'avatar
    // On verifie si le champ est rempli
    if (!empty($_FILES['avatar']['name'])) {
        $avatar = $_FILES['avatar']['name'];
        // Recuperation de l'extension du fichier
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if (in_array(strtolower($extension), $extensionArray)) {
            // On recupere les dimensions du fichier
            $avatarInfos = getimagesize($_FILES['avatar']['tmp_name']);
            var_dump($avatarInfos);
            // On verifie les dimensions et taille de l'image
            // 0 = largeur, 1 = hauteur
            if (($avatarInfos[0] <= WIDTH_MAX) && ($avatarInfos[1] <= HEIGHT_MAX) && (filesize($_FILES['avatar']['tmp_name']) <= MAX_SIZE)) {
                // Parcours du tableau d'erreurs
                if (
                    isset($_FILES['avatar']['error'])
                    && UPLOAD_ERR_OK === $_FILES['avatar']['error']
                ) {
                    // On renomme le fichier grâce au hachage md5, tout en lui donnant un identifiant unique 
                    $avatarName = md5(uniqid()) . '.' . $extension;

                    // Si c'est OK, on teste l'upload et on déplace le fichier
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], TARGET . $avatarName)) {
                        $message = 'Upload réussi !';
                        $updateArray['avatar'] = $avatarName;
                    } else {
                        // Sinon on affiche une erreur systeme
                        $message = 'Problème lors de l\'upload !';
                    }
                } else {
                    $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                }
            } else {
                // Sinon erreur sur les dimensions et taille de l'image
                $message = 'Erreur dans les dimensions de l\'image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
    }
}
/**
 * Vérification formulaire de modification des informations de l'utilisateur (pseudo,mail,avatar)
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

    //Si il n'y a pas d'erreur sur le formulaire...
    if (!empty($updateArray)) {

        // je modifie les attributs de la classe grâce au setter
        $user->__set('id', $_SESSION['user']['id']);
        $user->__set('pseudo', $updateArray['pseudo']);
        $user->__set('mail', $updateArray['mail']);
        $user->__set('avatar', $avatarName);
        // ici j'exécute la méthodes updateUserInfo() de l'objet $user, j'y récupère les modifications stockées dans le tableau $updateArray
        $isUpdated = $user->updateUserInfo($updateArray);
        if ($isUpdated) {
            // ici, je mets à jour les informations, visuellement, sur le profil de l'utilisateur en passant par les variables de session
            $_SESSION['user']['mail'] = $updateArray['mail'];
            $_SESSION['user']['pseudo'] = $updateArray['pseudo'];
            $_SESSION['user']['avatar'] = $avatarName;
            $message = 'Modifications enregistrées avec succès!';
        }
    }
}

/**
 * Vérification formulaire de modification de mot de passe
 */
if (isset($_POST['updateUserPassword'])) {
    // Je vérifie que l'ancien mot de passe correspond bien au hash enregistré dans la BDD
    if (isset($_POST['oldPassword'])) {
        $oldPassword = htmlspecialchars($_POST['oldPassword']);
        //Je vérifie l'ancien mot de passe
        $updateForm->isNotEmpty('password_hash', $oldPassword);
        $updateForm->isValidLength('password_hash', $oldPassword, 6, 255);
        $userPassword = new User();
        $userPassword->__set('id', $_SESSION['user']['id']);
        //j'exécute la méthode getUserHash() de l'objet $userPassword et stocke dans une variable nommée $hash le mot de passe hashé enregistré dans la BDD
        $hash = $userPassword->getUserHash();
        //   si le mot de passe n'est pas bon (càd, qu'il est différent de celui indiqué dans la BDD)...
        if (!password_verify($_POST['oldPassword'], $hash)) {
            //... j'indique un message d'erreur
            $error['oldPassword'] = 'Mauvais mot de passe';
        }
        //nouveau mot de passe
        if (isset($_POST['updatePassword'])) {
            $updatePassword = $_POST['updatePassword'];
            //Je vérifie le nouveau mot de passe            
            $updateForm->isNotEmpty('password_hash', $updatePassword);
            $updateForm->isValidLength('password_hash', $updatePassword, 6, 255);
            if (!isset($updateForm->error['updatePseudo'])) {
                $updateArray['password_hash'] = $updatePassword;
            }
        }
        if (!empty($updateArray)) {
            // si le nouveau mot de passe est bien différent de l'ancien mot de passe enregistré
            if (($_POST['updatePassword']) != ($_POST['oldPassword'])) {
                // j'hydrate l'attribut password_hash de mon objet $userPassword dans lequel je stocke la saisie, sécurisée grâce à la fonction password_hash(), qui crée une clé de hachage pour le mdp, avec la constante PASSWORD_DEFAULT (qui est un algorithme de hachage)
                $userPassword->__set('password_hash', password_hash($_POST['updatePassword'], PASSWORD_DEFAULT));
                $userPassword->updateUserHash();
                $message = 'Mot de passe modifié avec succès!';
            }
        }
    }
}

/**
 * Vérification formulaire de suppression du compte
 */
if (isset($_POST['deleteProfile'])) {
    // on vérifie  que l'ID de l'utilisateur a bien été récupéré dans l'URL
    if (isset($_GET['userID'])) {
        $delete = new User();
        $delete->id = htmlspecialchars($_GET['userID']);
        $deleteProfile = $delete->deleteProfile();
        // si tout est ok, on redirige vers la page d'accueil
        header('Location: index.php');
    }
}
