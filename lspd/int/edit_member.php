<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

if (isset($_POST['reset'])) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $password = hash('sha256', $randomString);
    $req = $bdd->prepare('UPDATE members_lspd SET password = ? WHERE ID = ?');
    $req->execute(array($password, $_GET['id']));
    $stat = "Identifiants pour le compte de " . $name . " " . $firstname . " : " . $username . " / " . $randomString;
}

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $grade = $_POST['grade'];
    $tel = $_POST['phone'];
    $division = $_POST['division'];
    $matricule = $_POST['matricule'];
    $id = $_GET['id'];

    if ($grade == "Commandant"){
        $gradevalue = 9;
    }elseif ($grade == "Capitaine"){
        $gradevalue = 8;
    }elseif ($grade == "Lieutenant"){
        $gradevalue = 7;
    }elseif ($grade == "Sergent-Chef"){
        $gradevalue = 6;
    }elseif ($grade == "Sergent"){
        $gradevalue = 5;
    }elseif ($grade == "Officier III"){
        $gradevalue = 4;
    }elseif ($grade == "Officier II"){
        $gradevalue = 3;
    }elseif ($grade == "Officier I"){
        $gradevalue = 2;
    }elseif ($grade == "Cadet"){
        $gradevalue = 1;
    }

    $req = $bdd->prepare('UPDATE members_lspd SET matricule = ?, name = ?, firstname = ?, grade = ?, gradevalue = ?, tel = ?, division = ? WHERE ID = ?');
    $req->execute(array($matricule, $name, $firstname, $grade, $gradevalue, $tel, $division, $id));
    header("Location: list_members.php");
}

$req = $bdd->prepare('SELECT * FROM members_lspd WHERE ID = ?');
$req->execute(array($_GET['id']));
$req = $req->fetch();


?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agents - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Agents</h1>
                    <p class="mb-4">Détails de l'agent</p>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifications</h6>
                        </div>
                        <form method='POST'>
                        <div class="card-body">
                            <!-- show the informations about the person stored in the database -->
                            <label for="matricule" class="col-sm-2 col-form-label">Matricule</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule" value="<?php  echo $req['matricule']?>" required>
                            </div>
                            <label for="name" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom Prénom" value="<?php  echo $req['name']?>" required>
                            </div>
                            <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom" value="<?php  echo $req['firstname']?>" required>
                            </div>
                            <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="grade" name="grade" required>
                                    <?php
                                    $ranklist = ["Commandant", "Capitaine", "Lieutenant", "Sergent Chef", "Sergent", "Officier III", "Officier II", "Officier I", "Cadet"];
                                    foreach ($ranklist as $rank) {
                                        if ($rank == $req['grade']) {
                                            echo "<option value='$rank' selected>$rank</option>";
                                        } else {
                                            echo "<option value='$rank'>$rank</option>";
                                        }
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone" value="<?php  echo $req['tel'];?>" required>
                            </div>
                            <label for="division" class="col-sm-2 col-form-label">Division</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="division" name="division" required>
                                    <?php $divisionlist = ["Aucune", "SWAT", "SAHP", "Henry", "DOA"];
                                    foreach ($divisionlist as $division) {
                                        if ($division == $req['division']) {
                                            echo "<option value='$division' selected>$division</option>";
                                        } else {
                                            echo "<option value='$division'>$division</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>                
                        </div>
                        <div class="card-footer">
                            <a href="list_members.php" class="btn btn-secondary">Retour</a>
                            <input type="submit" class="btn btn-warning" value="Réinitialiser le mot de passe" name="reset">
                            <input type="submit" class="btn btn-success" value="Enregistrer" name="submit">
                            <?php if(isset($stat)) {
                                    echo '<div class="alert alert-success" role="alert">'.$stat.'</div>';
                                }
                                    ?>
                        </div>
                        </form>
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