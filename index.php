<?php
//inclusion du header
include 'parts/header.php';
require_once 'controllers/categoryCtrl.php'
?>
<!-- CORPS DE L'ACCUEIL -->
<div id="subtitle" class="text-center text-uppercase mt-5">
    <h2 class="fs-4">"l'accord parfait entre musique et cinéma"</h2>
</div>

<div class="carousel slide my-2" data-bs-ride="carousel" id="carousel" data-bs-interval="0">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <!-- Premier slide -->
            <div class="card-group p-5 ">
                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="/assets/images/her.png" class="card-img" alt="affiche du film her">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">
                                <a href="category.php?categoryID=1" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Mélancolie</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/shining.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">
                                <a href="category.php?categoryID=2" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Mystère et Suspens</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/theshapeofwater.jpg" class="card-img" alt="affiche du film the shape of water">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=3" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Passion et lyricisme</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/conanlebarbare.jpg" class="card-img" alt="affiche du film conan le barbare">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=4" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Épique/Héroïque</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deuxième slide -->
        <div class="carousel-item">
            <div class="card-group p-5">
                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/castleinthesky.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=5" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Onirisme/Sérénité</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/vforvendetta.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=6" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Pathos</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/platoon.png" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=7" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Chant guerrier</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/starwars5.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=8" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Aventure, Challenge, Courage</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Troisième slide -->
        <div class="carousel-item">
            <div class="card-group p-5">
                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/lordoftherings.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=9" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Fantastique</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/singinintherain.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=10" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Comédie musicale</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/bladerunner.png" class="card-img" alt="affiche du film blade runner">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=11" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Extraterrestre</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card me-2 border-0" style="width: 25rem;">
                    <div class="hover hover-1 text-white rounded">
                        <img src="../assets/images/kikujiro.jpg" class="card-img" alt="affiche du film shining">
                        <div class="hover-1-content">
                            <div class="card-img-overlay">

                                <a href="category.php?categoryID=12" class="card-title text-decoration-none text-white">
                                    <h5 class="hover-1-title card-title mb-5 text-center">Voyage</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--boutons de contrôles du carousel-->
    <button class="carousel-control-prev me-5" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php include 'parts/footer.php'; ?>