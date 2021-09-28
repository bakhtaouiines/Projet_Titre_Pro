<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';

// si l'utilisateur n'est pas connecté , on le redirige vers l'accueil pour qu'il puisse se connecter
if(!isConnected()){
    header('Location: index.php');
    exit;
}
$pseudo = isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '';
$mail = isset($_SESSION['user']['mail']) ? $_SESSION['user']['mail'] : '';

