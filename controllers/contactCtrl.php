<?php
require_once 'models/mainModel.php';
require_once 'classes/form.php';

$contactForm = new Form();
// Prend les caractères alphanumériques + le point et le tiret 6
$regex = "/^[A-Za-z0-9 .'-]+$/";
$error_message = '';
if (isset($_POST['sendMail'])) {
    //Je récupère les données du formulaire
    if (isset($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
    }
    if (isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    }
    if (isset($_POST['firstName'])) {
        $firstName = htmlspecialchars(preg_match($regex, $_POST['firstName']));
    } else {
        $error_message = 'Le prénom que vous avez entré ne semble pas être valide';
    }
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }
        $receiver = 'inesbkht@gmail.com';
        mail($receiver, $subject, $message);
    }