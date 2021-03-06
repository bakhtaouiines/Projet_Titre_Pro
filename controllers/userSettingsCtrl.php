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
define('WIDTH_MAX', 1920);   // Largeur max de l'image en pixels
define('HEIGHT_MAX', 1080); // Hauteur max de l'image en pixels

// Tableaux de données
$extensionArray = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisées
$avatarInfos = []; // j'initialise un tableau vide pour stocker les informations relatives à l'avatar
// Variables
$user = new User(); // création d'une instance de classe; création d'un nouvel objet
$updateForm = new Form();
$updateArray = []; // j'initialise un tableau vide pour y stocker les modifications
$extension = '';
$message = '';
$avatarName = '';

/**
 * Vérification formulaire de modification de l'avatar
 */
if (isset($_POST['updateAvatar'])) {
    // On verifie si le champ est rempli
    if (!empty($_FILES['avatar']['name'])) {
        $avatar = $_FILES['avatar']['name'];
        // Recuperation de l'extension du fichier
        $extension = pathinfo($avatar, PATHINFO_EXTENSION);
        // On verifie que l'extension du fichier existe dans notre tableau d'extensions autorisées
        if (in_array(strtolower($extension), $extensionArray)) {
            // On recupere les dimensions du fichier
            $avatarInfos = getimagesize($_FILES['avatar']['tmp_name']); // tmp_name correspond au nom temporaire du fichier

            // On verifie le type de l'image
            if ($avatarInfos[2] >= 1 && $avatarInfos[2] <= 14) {
                // On verifie les dimensions et taille de l'image (0 = largeur, 1 = hauteur)
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
                            $_SESSION['user']['avatar'] = $avatarName;
                            $user->__set('avatar', $avatarName);
                            $user->__set('id', $_SESSION['user']['id']);
                            $user->updateAvatar();
                            $message = 'Upload réussi !';
                            // si tout est ok, je redirige l'utilisateur vers sa page de profil
                            header('Location: ../profilPage.php');
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Problème lors de l\'upload !';
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image ! Elles ne doivent pas dépasser 200x200 px.';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte ! Sont autorisés uniquement: jpg, gif, png, jpeg.';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
    }
}

/**
 * Vérification formulaire de modification des informations de l'utilisateur (pseudo,mail)
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
        if (!isset($updateForm->error['pseudo'])) {
            $updateArray['pseudo'] = $updatePseudo;
        } else {
            $updateForm->error['pseudo'];
        }
    }
    if (isset($_POST['updateMail'])) {
        $updateMail = htmlspecialchars($_POST['updateMail']);
        //Je vérifie le mail
        $updateForm->isUnique('mail', $updateMail, 'user');
        $updateForm->isValidEmail('mail', $updateMail);
        if (!isset($updateForm->error['mail'])) {
            $updateArray['mail'] = $updateMail;
        } else {
            $updateForm->error['mail'];
        }
    }

    //Si il n'y a pas d'erreur sur le formulaire...
    if (!empty($updateArray)) {
        // je modifie les attributs de la classe grâce au setter
        $user->__set('id', $_SESSION['user']['id']);
        $user->__set('pseudo', $updateArray['pseudo']);
        $user->__set('mail', $updateArray['mail']);
        // ici j'exécute la méthodes updateUserInfo() de l'objet $user, j'y récupère les modifications stockées dans le tableau $updateArray
        $isUpdated = $user->updateUserInfo($updateArray);
        if ($isUpdated) {
            // ici, je mets à jour les informations, visuellement, sur le profil de l'utilisateur en passant par les variables de session
            $_SESSION['user']['mail'] = $updateArray['mail'];
            $_SESSION['user']['pseudo'] = $updateArray['pseudo'];
            // si tout est ok, je redirige l'utilisateur vers sa page de profil
            header('Location: ../profilPage.php');
        } else {
            $message = implode($updateForm->error);
            var_dump($message);
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
 * Vérification formulaire de suppression d'avatar
 */
if (isset($_POST['deleteAvatar'])) {
    // on vérifie  que l'ID de l'utilisateur a bien été récupéré dans l'URL
    if (isset($_SESSION['user']['avatar'])) {
        $user->deleteAvatar();
        unset($_SESSION['user']['avatar']);
        // si tout est ok, on redirige vers la page de profil
        header('Location: profilPage.php');
    } else {
        $message = 'Une erreur est survenue.';
    }
}

/**
 * Vérification formulaire de suppression du compte
 */
if (isset($_POST['deleteProfile'])) {
    // on vérifie  que l'ID de l'utilisateur a bien été récupéré dans l'URL
    if (isset($_SESSION['user']['id'])) {
        $user->deleteAccount();
        unset($_SESSION['user']);
        header('Location: index.php');
        exit;
    } else {
        $message = 'Une erreur est survenue.';
    }
}
