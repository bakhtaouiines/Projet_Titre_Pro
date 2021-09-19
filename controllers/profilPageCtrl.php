<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/user.php';
if(!isConnected()){
    header('Location: index.php?page=login');
    exit;
}
$pseudo = isset($_SESSION['user']['pseudo']) ? $_SESSION['user']['pseudo'] : '';
$mail = isset($_SESSION['user']['mail']) ? $_SESSION['user']['mail'] : '';

