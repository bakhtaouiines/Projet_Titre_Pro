<?php
require_once 'config.php';
require_once 'models/mainModel.php';
require_once 'models/playlist.php';
require_once 'classes/form.php';

$playlist = new Playlist();
$playlistForm = new Form();

/**
 *  Vérifications du formulaire d'écriture de minipost
 */
if (isset($_POST['submitPlaylist'])) {
    $playlistName = '';
    $playlistDescription = '';
    $resultSearch = '';
    //Je récupère les données du formulaire
    if (isset($_POST['playlistName'])) {
        $playlistName = htmlspecialchars($_POST['playlistName']);
    }
    if (isset($_POST['playlistDescription'])) {
        $playlistDescription = htmlspecialchars($_POST['playlistDescription']);
    }
    if (isset($_POST['resultSearch'])) {
        $resultSearch = htmlspecialchars($_POST['resultSearch']);
    }
    //Je vérifie le content de la playlist
    $playlistForm->isNotEmpty('playlistName', $playlistName);
    $playlistForm->isNotEmpty('playlistDescription', $playlistDescription);
    $playlistForm->isNotEmpty('resultSearch', $resultSearch);
    //Si il n'y a pas d'erreur sur le formulaire...
    if ($playlistForm->isValid()) {
        $playlist->__set('pName', $playlistName);
        $playlist->__set('description', $playlistDescription);
        $playlist->__set('id_OST', $resultSearch);
        $playlist->__set('id_User', $_SESSION['user']['id']);
        $playlist->createPlaylist();
        echo 'Playlist Crée!';
    } else {
        echo 'Une erreur a été identifié.';
    }
}

$ost = new Playlist();
$ostList = $ost->getOst();
