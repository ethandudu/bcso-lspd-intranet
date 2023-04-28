<?php

include 'config.php';

$req = $bdd->prepare('SELECT recrutement_lspd, defcon_lspd FROM settings');
$req->execute();
$settings = $req->fetch();

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bienvenue sur le site internet de la LSPD d'American Stories" />
        <title>LSPD - American Stories</title>
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
        <header class="masthead text-center text-white"  style="background-image: url('assets/img/lspd_front.jpg');">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">LSPD</h1>
                    <h2 class="masthead-subheading mb-0">Obéir et Survivre</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">En savoir plus</a>
                </div>
            </div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/logo_lspd.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">A propos</h2>
                            <p>La LSPD est une branche des forces de l'ordre de Los Santos, en charge de la juridiction Sud.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Defcon</h2>
                            <div class=""><img class="" src="assets/img/defcon/defcon-header.png"></div>
                            
                            <?php 
                                if ($settings['defcon_lspd'] == 1) {
                                    echo '<div class="">Nous sommes actuellement en :<img class="" src="assets/img/defcon/defcon-1.png" alt="..." /></div>';
                                } elseif ($settings['defcon_lspd'] == 2) {
                                    echo '<div class="">Nous sommes actuellement en :<img class="" src="assets/img/defcon/defcon-2.png" alt="..." /></div>';
                                } elseif ($settings['defcon_lspd'] == 3) {
                                    echo '<div class="">Nous sommes actuellement en :<img class="" src="assets/img/defcon/defcon-3.png" alt="..." /></div>';
                                } elseif ($settings['defcon_lspd'] == 4) {
                                    echo '<div class="">Nous sommes actuellement en :<img class="" src="assets/img/defcon/defcon-4.png" alt="..." /></div>';
                                } elseif ($settings['defcon_lspd'] == 5) {
                                    echo '<div class="">Nous sommes actuellement en :<img class="" src="assets/img/defcon/defcon-5.png" alt="..." /></div>';
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
        <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/46.png" alt="..." height="492px"/></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Nous contacter</h2>
                            <p><i class="fas fa-location-dot"></i> LSPD, Mission Row, Los Santos</p>
                            <p><i class="fas fa-phone"></i> Application Métiers <i class="fas fa-arrow-right"></i> LSPD</p>
                            <p><i class="fas fa-envelope"></i> <a href="https://discord.gg/MTUAA5kDQ8">Discord</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/34.png" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Recrutement</h2>
                            <p>Les recrutements sont actuellement<br>
                                <?php
                                //show if the recruitment is open or not in green or red
                                if ($settings['recrutement_lspd'] == 1) {
                                    echo '<span style="color: green;">OUVERTS</span>';
                                } else {
                                    echo '<span style="color: red;">FERMÉS</span>';
                                }
                                echo '<br>Suivez nous sur les réseaux sociaux afin d\'être prévenu !</p>';
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; LSPD - American Stories 2022</p></div>
            <div class="container px-5"><p class="m-0 text-center text-white small">Made with <i color: Tomato class="fas fa-heart"></i> by <a href="https://github.com/ethandudu">Ethan D.</a></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
