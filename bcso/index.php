<?php

include 'config.php';

$req = $bdd->prepare('SELECT recrutement_bcso FROM settings');
$req->execute();
$recrutement = $req->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bienvenue sur le site internet du BCSO d'American Stories" />
        <title>BCSO - American Stories</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php include('functions/navbar.php'); ?>
        <!-- Header-->
        <header class="masthead text-center text-white"  style="background-image: url('assets/img/bcso_paleto_front.png');">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">BCSO</h1>
                    <h2 class="masthead-subheading mb-0">Servir et protéger</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">En savoir plus</a>
                </div>
            </div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/logo_bcso.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">A propos</h2>
                            <p>Le BCSO est une branche des forces de l'ordre de Los Santos, en charge de la juridiction Nord.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/suv_bcso.png" alt="..." height="492px"/></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Nous contacter</h2>
                            <p><i class="fas fa-location-dot"></i> BCSO, Paleto Boulevard, Paleto Bay</p>
                            <p><i class="fas fa-phone"></i> Application Métiers <i class="fas fa-arrow-right"></i> BCSO</p>
                            <p><i class="fas fa-envelope"></i> <a href="https://discord.gg/CNaUDcSqsz">Discord</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/officier_bcso.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Recrutement</h2>
                            <p>Les recrutements sont actuellement
                                <?php
                                //show if the recruitment is open or not in green or red
                                if ($recrutement['recrutement_bcso'] == 1) {
                                    echo '<span style="color: green;">ouverts</span>';
                                } else {
                                    echo '<span style="color: red;">fermés</span>';
                                }
                                echo ', suivez nous sur les réseaux sociaux afin d\'être prévenu !</p>';
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; BCSO - American Stories 2022</p></div>
            <div class="container px-5"><p class="m-0 text-center text-white small">Made with <i color: Tomato class="fas fa-heart"></i> by <a href="https://github.com/ethandudu">Ethan D.</a></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
