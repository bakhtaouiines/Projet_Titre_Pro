<?php
//Je vérifie la page demandée
function authorizedAccess($levelMin){
    if(!isset($_SESSION['user']['isConnected']) || !$_SESSION['user']['isConnected'] || $_SESSION['user']['levelAccess'] < $levelMin){
        header('Location: index.php');
        exit;
    }
}