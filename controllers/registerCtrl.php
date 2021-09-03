<?php
// On charge le fichier du modèle.
require('../models/mainModel.php');
require('../models/user.php');

// instance d'un nouvel objet pour ajouter des utilisateurs 
$addUser = new User();

//on initialise un tableau qui contiendra les messages d'erreurs
$formErrorList = [];

/**
 *  Vérifications du formulaire d'inscription
 */
if (isset($_POST['register'])) {

    // vérification sur le pseudo 
    if (!empty($_POST['pseudo'])) {
        if (preg_match('/^[a-zA-Z0-9.-_]{3,20}$/', $_POST['pseudo'])) { //on contrôle que le pseudo contient 3 à 20 caractères
            $addUser->pseudo = htmlspecialchars($_POST['pseudo']); // On hydrate l'attribut pseudo de l'objet $addUser et on convertit les caractères spéciaux en entités HTML
        } else {
            $formErrorList['pseudo'] = 'Le pseudo doit contenir au moins 3 caractères, sans aucun espace et aucun caractères spéciaux.';
        }
    } else {
        $formErrorList['pseudo'] = 'Pseudo manquant';
    }

    // vérification sur l'adresse email
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { // Ceci valide l'adresse de courriel selon la syntaxe défini par la RFC 822
            $addUser->mail = htmlspecialchars($_POST['email']);
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
        $addUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); // je crée une clé de hachage pour le mot de passe
        if ($hashPassword !== $verifPassword) {
            $formErrorList['verifPassword'] = 'Le mot de passe indiqué ne correspond pas.';
        }
    } else {
        $formErrorList['password'] = 'Le champ "Mot de Passe" n\'est pas rempli';
    }
    // S'il n'y a pas d'erreurs...
    if (empty($formErrorList)) {
        // ... on exécute la méthode addUser liée à l'instance PDO $addUser qui permet d'ajouter un utlisateur
        $addUser->addUser();
        // comme le nouvel utilisateur n'est pas indexé...
        if ($addUser->addUser() != 0) {
            // ... on envoie un mail de validation de l'inscription
        }
    }
}
// On charge le fichier de la vue (l'affichage), qui va présenter les informations dans une page HTML.
require('../views/header.php');
