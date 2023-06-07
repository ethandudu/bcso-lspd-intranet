<?php
session_start();
include('../config.php');

include('functions/loginverif.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Amendes - BCSO</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .result-card {
            
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="assets/logo_bcso.png" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3">BCSO</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php include("functions/sidepanel.php"); ?>
            
            <?php include("functions/adminpanel.php"); ?>

            <!-- Divider -->
            

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include("functions/navbar.php"); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Calculateur d'amendes</h1>
                    <p class="mb-4">Normalement ça devrait marcher un jour peut-être</p>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Sélection</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Infractions</h6>
                                        </div>
                                        <div class="card-body">
                                           <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Infractions"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Délits mineurs</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Delits_mineurs"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Délits majeurs</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Delits_majeurs"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Crimes (Non cumulable)</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Crimes"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Objets</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Objets"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Prison</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes WHERE type = "Prison"');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="'.$donnees['ID'].'" name="'.$donnees['ID'].'" onclick="calculer()">
                                                <label class="custom-control-label" for="'.$donnees['ID'].'">'.$donnees['name'].'</label>
                                                </div>');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Modificateurs</h6>
                                </div>
                                <div class="card-body">
                                    <h6 class="m-0 font-weight-bold text-primary">Modificateurs positifs</h6>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod+-1" name="mod+-1" onclick="calculer()">
                                        <label class="custom-control-label" for="mod+-1">Tolérance (30%)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod+-2" name="mod+-2" onclick="calculer()">
                                        <label class="custom-control-label" for="mod+-2">Coopération (25%)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod+-3" name="mod+-3" onclick="calculer()">
                                        <label class="custom-control-label" for="mod+-3">Nouvelles informations recueillies (20%)</label>
                                    </div>
                                    <br>
                                    <h6 class="m-0 font-weight-bold text-primary">Modificateurs négatifs</h6>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod--1" name="mod--1" onclick="calculer()">
                                        <label class="custom-control-label" for="mod--1">Récidive (25%)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod--2" name="mod--2" onclick="calculer()">
                                        <label class="custom-control-label" for="mod--2">En groupe (25%)</label>
                                    </div>
                                    <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mod--3" name="mod--3" onclick="calculer()">
                                        <label class="custom-control-label" for="mod--3">Préméditation (50%)</label>
                                    </div>

                                </div>
                            </div>
                            <!-- let the card move with the page -->

                            <div class="card shadow mb-4 result-card">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Résultats</h6>
                                </div>
                                <div class="card-body">
                                    <script>
                                        function calculer(){
                                            var total = 0;
                                            var note = "";
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('if (document.getElementById("'.$donnees['ID'].'").checked == true) {
                                                    total = total + '.$donnees['value'].';
                                                    if (note == "") {note = note + " '.$donnees['other'].'";}else{note = note + " / '.$donnees['other'].'";}
                                                }');
                                            }
                                            ?>
                                            if (document.getElementById("mod+-1").checked == true) {total = total * 0.7;}
                                            if (document.getElementById("mod+-2").checked == true) {total = total * 0.75;}
                                            if (document.getElementById("mod+-3").checked == true) {total = total * 0.8;}
                                            if (document.getElementById("mod--1").checked == true) {total = total * 1.25;}
                                            if (document.getElementById("mod--2").checked == true) {total = total * 1.25;}
                                            if (document.getElementById("mod--3").checked == true) {total = total * 1.5;}
                                            total = Math.round(total);
                                            document.getElementById("total").innerHTML = total + " $";
                                            document.getElementById("note").innerHTML = note;
                                        }

                                        function reset(){
                                            <?php
                                            $req = $bdd->prepare('SELECT * FROM amendes');
                                            $req->execute();
                                            while ($donnees = $req->fetch()) {
                                                echo('document.getElementById("'.$donnees['ID'].'").checked = false;');
                                            }
                                            ?>
                                            document.getElementById("mod+-1").checked = false;
                                            document.getElementById("mod+-2").checked = false;
                                            document.getElementById("mod+-3").checked = false;
                                            document.getElementById("mod--1").checked = false;
                                            document.getElementById("mod--2").checked = false;
                                            document.getElementById("mod--3").checked = false;
                                            document.getElementById("total").innerHTML = "0 $";
                                            document.getElementById("note").innerHTML = "";
                                        }
                                    </script>
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <h1 class="text-center" id="total">0 $</h1>
                                            <h6 class="text-center" id="note"></h6>
                                        </div>
                                    </div>
                                    <input type="button" class="btn btn-danger btn-block" value="Réinitialiser" onclick="reset()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BCSO - American Stories 2023</span><br>
                        <span>Made with <i class="fas fa-heart"></i> by <a href="https://github.com/ethandudu">Ethan D.</a></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Déconnexion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Êtes vous sûr de vouloir vous déconnecter ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-warning" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary btn-success" href="logout.php">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>

</body>

</html>