<?php
// require 'controllers/articlePageCtrl.php';
include('header.php'); ?>
<!-----------------------------------------------------------corps de la page------------------------------------------->

<!-- affichage de l'article -->
<div class="p-5">
    <a href="articlelist.php" class="btn btn-outline-dark mb-5 offset-md-10" role="button">Revenir à la liste des articles</a>
    <section>
        <header>
            <h1>Title de l'article</h1>
        </header>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut ornare lectus sit amet est placerat in. Tristique et egestas quis ipsum suspendisse ultrices. Nunc scelerisque viverra mauris in aliquam sem fringilla. Egestas quis ipsum suspendisse ultrices gravida dictum fusce ut placerat. Viverra nam libero justo laoreet sit. Accumsan lacus vel facilisis volutpat. Tristique et egestas quis ipsum suspendisse ultrices gravida. Facilisis leo vel fringilla est. Pharetra magna ac placerat vestibulum lectus mauris. Tincidunt dui ut ornare lectus sit amet est placerat. Porta non pulvinar neque laoreet suspendisse interdum consectetur. Hac habitasse platea dictumst vestibulum rhoncus est pellentesque. Ipsum a arcu cursus vitae congue mauris rhoncus aenean. Sed augue lacus viverra vitae congue eu consequat ac felis. Id venenatis a condimentum vitae sapien pellentesque habitant morbi. Arcu dui vivamus arcu felis. At ultrices mi tempus imperdiet nulla malesuada pellentesque. Enim diam vulputate ut pharetra sit. Mattis rhoncus urna neque viverra justo nec ultrices dui sapien.

            Leo a diam sollicitudin tempor. Posuere urna nec tincidunt praesent semper feugiat nibh sed. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor magna. Quis eleifend quam adipiscing vitae. Pharetra pharetra massa massa ultricies mi quis hendrerit dolor. Vitae tempus quam pellentesque nec nam aliquam. Leo in vitae turpis massa sed elementum tempus. Cursus sit amet dictum sit. Pretium quam vulputate dignissim suspendisse in est ante in nibh. Nulla malesuada pellentesque elit eget gravida cum sociis natoque penatibus. Enim diam vulputate ut pharetra sit. Id donec ultrices tincidunt arcu non sodales. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque. Lacus vel facilisis volutpat est velit egestas dui. Nunc pulvinar sapien et ligula ullamcorper. Enim blandit volutpat maecenas volutpat blandit aliquam etiam. Quis lectus nulla at volutpat diam ut. Dolor purus non enim praesent elementum.

            Neque vitae tempus quam pellentesque nec nam aliquam. Lacus suspendisse faucibus interdum posuere lorem. Viverra aliquet eget sit amet tellus cras adipiscing enim eu. Fermentum posuere urna nec tincidunt. Tincidunt lobortis feugiat vivamus at augue eget. Morbi quis commodo odio aenean sed adipiscing diam donec. Consectetur adipiscing elit ut aliquam. Tincidunt eget nullam non nisi est sit amet. Fusce ut placerat orci nulla pellentesque. Egestas integer eget aliquet nibh praesent tristique magna sit.
        </p>
    </section>
</div>
<hr>

<!-- section commentaires -->
<!-- Main Body -->
<section class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
                <h2>Commentaires</h2>
                <div class="comment mt-4 text-justify float-left">
                    <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Jhon Doe</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="text-justify darker mt-4 float-right"> <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Rob Simpson</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="comment mt-4 text-justify"> <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Jhon Doe</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
                <div class="darker mt-4 text-justify"> <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle" width="40" height="40">
                    <h4>Rob Simpson</h4> <span>- 20 October, 2018</span> <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus numquam assumenda hic aliquam vero sequi velit molestias doloremque molestiae dicta?</p>
                </div>
            </div>
            <!-- espace d'écriture de commentaire -->
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form id="align-form">
                    <div class="form-group">
                        <h4>Laisser un commentaire:</h4>
                        <label for="message">Message</label>
                        <textarea name="msg" id="" msg cols="30" rows="5" class="form-control" style="background-color: white;"></textarea>
                    </div>
                    <button type="submit" id="postComment" name="postComment" class="btn btn-outline-dark my-4">Publier mon commentaire</button>
                    <!-- Bouton login -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#login" class="btn btn-outline-dark me-4">Se connecter pour écrire un commentaire</button>
                </form>
            </div>

        </div>
    </div>
</section>
<?php include('footer.php'); ?>