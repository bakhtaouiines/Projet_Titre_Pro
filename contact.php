<?php
include 'parts/header.php';
require_once 'controllers/contactCtrl.php'
?>
<div class="wrapper rounded d-flex align-items-stretch">
    <div class="bg-red">
        <div class="text-white"><i class="bi bi-envelope"></i></div>
        <div class="pt-5 cursive text-white">Merci de m'envoyer tout avis, suggestion... j'en prendrai connaissance dès que possible!</div>
    </div>
    <div class="contact-form m-3">
        <h3>Say Hello!</h3>
        <form method="POST" action="contact.php">
            <div class="form-group pt-3">
                <label for="subject">Sujet</label>
                <input type="text" name="subject" class="form-control" required>
                <label for="message">Message</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>
            <div class="d-flex align-items-center flex-wrap justify-content-between pt-4">
                <div class="form-group pt-lg-2 pt-3">
                    <label for="firstName">Votre Prénom</label>
                    <input type="text" name="firstName" class="form-control" required>
                </div>
                <div class="form-group pt-lg-2 pt-3">
                    <label for="email">Votre Mail</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="d-flex align-items-center flex-wrap justify-content-between pt-lg-5 mt-lg-4 mt-5">
                <button class="btn btn-primary" type="submit" name="sendMail" data-bs-toggle="modal" data-bs-target="#myModal">Envoyer</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Merci!<i class="bi bi-suit-heart"></i></h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ps-2">Merci pour votre message!</div>
            </div>
        </div>
    </div>
</div>
<?php include 'parts/footer.php'; ?>