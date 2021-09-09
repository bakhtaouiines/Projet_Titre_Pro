<?php
session_start();
//Création des constantes de configuration de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'projet_titre_pro');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

/**
 * fonction pour contrôler l'accès à certaines pages ; on contrôle en fonction du niveau de rôle de l'utilisateur
 * 
 */
function authorizedAccess($levelMin)
{
    if (!isset($_SESSION['user']['isConnected']) || !$_SESSION['user']['isConnected'] || $_SESSION['user']['levelAccess'] < $levelMin) {
        header('Location: ../index.php');
        exit;
    }
}

var_dump($_SESSION);