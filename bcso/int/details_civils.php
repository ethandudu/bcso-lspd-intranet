<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

$req = $bdd->prepare('SELECT * FROM civils_lspd WHERE ID = ?');
$req->execute(array($_GET['id']));
$req = $req->fetch();
$name = $req['name'];
$firstname = $req['firstname'];
$birthdate = $req['birthdate'];
$birthdate = date('d/m/Y', strtotime($birthdate));
$tel = $req['tel'];
$note = $req['note'];
$picface = $req['picface'];
$picback = $req['picback'];
$picright = $req['picright'];
$id = $req['ID'];

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Civils - LSPD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
 .carousel-inner > .item > img,
 .carousel-inner > .item > a > img {
     display: block;
     max-width: 100%;
     height: 100px !important;
 }
 </style>


</head>

<body id="page-top">
<?php include ('functions/matomo.php');?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="assets/logo_lspd.png" width="50" height="50">
                </div>
                <div class="sidebar-brand-text mx-3">LSPD</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php include("functions/sidepanel.php"); ?>

            <?php include("functions/adminpanel.php"); ?>

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

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Civils</h1>
                    <p class="mb-4">Casier judiciaire</p>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
                        </div>
                        <div class="card-body">
                            <!-- show the informations about the person stored in the database -->
                            <label for="name" class="col-sm-2 col-form-label">Nom Prénom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom Prénom" value="<?php  echo $name . " " .$firstname;?>" disabled>
                            </div>
                            <label for="birthdate" class="col-sm-2 col-form-label">Date de naissance</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="Date de naissance" value="<?php  echo $birthdate;?>"disabled>
                            </div>
                            <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone" value="<?php  echo $tel;?>"disabled>
                            </div>
                            <label for="note" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="note" name="note" value="<?php  echo htmlspecialchars($req['note'])?>" disabled>
                            </div>

                            <!-- show pictures stored in the database as base64 in a carousel -->
                            
                            <!-- center the carousel -->
                            <div class="card center">
                            <div id="carouselExampleControls" class="card-body carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    //display picture if there is one
                                    if($picface != ""){
                                        echo '<div class="carousel-item active">
                                        <img class="d-block w-100" src="'.($picface).'" alt="First slide" height=500px>
                                        </div>';
                                    }
                                    //display picture if there is one
                                    if($picback != ""){
                                        echo '<div class="carousel-item">
                                        <img class="d-block w-100" src="'.($picright).'" alt="Second slide" height=500px>
                                        </div>';
                                    }
                                    //display picture if there is one
                                    if($picright != ""){
                                        echo '<div class="carousel-item">
                                        <img class="d-block w-100" src="'.($picback).'" alt="Third slide" height=500px>
                                        </div>';
                                    }
                                    
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Précédent</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Suivant</span>
                                </a>
                            </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="civils.php" class="btn btn-secondary">Retour</a>
                            <a href="export_casier.php?id=<?php echo $id;?>" class="btn btn-info">Casier judiciaire</a>
                            <a href="export_civil.php?id=<?php echo $id;?>" class="btn btn-success">Exporter</a>
                            <a href="edit_civil.php?id=<?php echo $id;?>" class="btn btn-primary">Modifier</a>
                            <a href="delete_civil.php?id=<?php echo $id;?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LSPD - American Stories 2023</span><br>
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