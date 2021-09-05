<?php
// On charge le fichier du modèle.
require_once '../models/mainModel.php';
require_once '../models/user.php';

$user = new User();
// on stocke l'ID de l'utilisateur
$user->id = $_GET['userID'];
// on stocke dans une variable la fonction qui va appeler toutes les informations de l'utilisateur
$userInfo = $user->getUserInfoById();