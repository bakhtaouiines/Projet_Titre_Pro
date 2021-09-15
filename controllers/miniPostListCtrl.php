<?php
// On charge le fichier du modèle.
require_once 'models/mainModel.php';
require_once 'models/minipost.php';
require_once 'models/ost.php';

$minipost = new MiniPost();
$minipostList = $minipost->getMiniPostList();
