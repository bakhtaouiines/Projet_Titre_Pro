<!-----------------------------------------------------------footer------------------------------------------->

<footer class="text-white" style="background-color: #102128;">
    <div class="me-5 mb-4 p-4 pb-0 d-flex justify-content-end ">
        <!-- page de contact -->
        <a href="../contact.php" role="button" class="contact p-2 text-decoration-none text-uppercase me-5">Me contacter</a>
    </div>
    <div class="p-4" style="background-color: #0a1519">
        <section class="social row mb-0">
            <!-- titre + logo -->
            <div class="col-auto mx-auto">
                <a href="index.php" class="text-decoration-none"><img class="navbar-brand col" src="assets/images/logo.png" style="width: 8rem; opacity: 0.2">
                    <span id="title" class="text-uppercase text-light me-2">orpheus</span><span id="collection">collection</span>
                </a>
            </div>
            <div class="col-auto my-auto">
                <!-- Section: Social media -->
                <!-- Spotify -->
                <a class="btn btn-sm btn-floating " style="background-color: #1FD35E;" href="#!" role="button"><i class="fa fa-spotify"></i></a>
                <!-- Deezer -->
                <a class="btn btn-sm btn-floating " style="background-color: #FFD9ED;" href="#!" role="button"><i class="fab fa-deezer"></i></a>
                <!-- Twitter -->
                <a class="btn btn-sm btn-floating " style="background-color: #55acee;" href="#!" role="button"><i class="fa fa-twitter"></i></a>
                <!-- Instagram -->
                <a class="btn btn-sm btn-floating " style="background-color: #ac2bac;" href="#!" role="button"><i class="fa fa-instagram"></i></a>
                <!--Flux RSS-->
                <a class="btn btn-sm btn-floating " style="background-color: #E14B0C;" href="#!" role="button"><i class="fas fa-rss-square"></i></a>
            </div>
        </section>
    </div>
</footer>

<script src="/assets/scripts/script.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>
<!-- JQUERY -->
<script src="/assets/scripts/jquery-3.6.0.min.js"></script>
<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/d6f0d1e82c.js" crossorigin="anonymous"></script>

</body>

</html>