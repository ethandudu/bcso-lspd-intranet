<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

if (isset($_POST['submit'])){
    $datebdd = date('Y-m-d H:i:s', strtotime($_POST['date']));
    $req = $bdd->prepare('UPDATE wanted_bcso SET datetime = ?, reason = ?, officier = ?, note = ?, public = ? WHERE ID = ?');
    $req->execute(array($datebdd, $_POST['motif'], $_POST['officier'], $_POST['note'], $_POST['public'], $_GET['id']));
    header("Location: wanted.php");
}

if (isset($_GET['id'])) {
    $req = $bdd->prepare('SELECT * FROM wanted_bcso WHERE ID = ?');
    $req->execute(array($_GET['id']));
    $req = $req->fetch();

    $civil = $bdd->prepare('SELECT * FROM civils_bcso WHERE ID = ?');
    $civil->execute(array($req['civilid']));
    $civil = $civil->fetch();
    $datelocal = date('Y-m-d\TH:i', strtotime($req['datetime']));
    $ID = $_GET['id'];
    
}else{
    header("Location: wanted.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wanted - BCSO</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Wanted</h1>
                    <p class="mb-4">Modifier un wanted</p>                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Modifiez les champs ci-dessous</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="newcasier">
                                <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nom Prénom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom Prénom" value="<?php  echo $civil['name'] . " ". $civil['firstname']?>" disabled>
                            </div>
                            <label for="date" class="col-sm-2 col-form-label">Date de publication</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="form-control" id="date" name="date" placeholder="Date de publication" value="<?php  echo $req['datetime'];?>">
                            </div>
                            <label for="reason" class="col-sm-2 col-form-label">Motif</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="motif" name="motif" placeholder="Motif" value="<?php  echo $req['reason'];?>">
                            </div>
                            <label for="officier" class="col-sm-2 col-form-label">Officier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="officier" id="officier" required>
                                            <?php
                                                # show all officier in the list and select the one who did the sanction
                                                $req2 = $bdd->query('SELECT * FROM members_bcso');
                                                while($officier = $req2->fetch()){
                                                    if($officier['ID'] == $req['officier']){
                                                        echo '<option value="'.$officier['ID'].'" selected>'.$officier['firstname'].' '.$officier['name'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$officier['ID'].'">'.$officier['firstname'].' '.$officier['name'].'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                            <label for="note" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="note" name="note" placeholder="/" value="<?php  echo $req['note'];?>">
                            </div>
                            <label for="public" class="col-sm-2 col-form-label">Public</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="public" id="public" required>
                                    <?php
                                        if($req['public'] == 1){
                                            echo '<option value="1" selected>Oui</option>';
                                            echo '<option value="0">Non</option>';
                                        }else{
                                            echo '<option value="1">Oui</option>';
                                            echo '<option value="0" selected>Non</option>';
                                        }
                                    ?>
                                </select>
                                <small id="publicHelp" class="form-text text-muted">Si le wanted est public, il sera visible par tous les citoyens.</small>
                            <button type="submit" class="btn btn-success" name="submit">Modifier</button>
                            </form>
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

    <!-- Page level plugins -->

    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>
</body>

</html>