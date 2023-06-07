<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include('functions/loginverif.php');

if (isset($_POST['submit'])) {

    $name = $_POST['inputName'];
    $firstname = $_POST['inputFirstname'];
    $birthdate = $_POST['inputBirthdate'];
    $birthdate = date('Y-m-d', strtotime($birthdate));
    $address = $_POST['inputAddress'];
    $phone = $_POST['inputPhone'];
    $hair = $_POST['inputHair'];
    $skin = $_POST['inputSkin'];
    $note = $_POST['note'];
    $img1 = $_POST['img1'];
    $img2 = $_POST['img2'];
    $img3 = $_POST['img3'];



    $req = $bdd->prepare('INSERT INTO civils_bcso (name, firstname, birthdate, skin, hair, tel, address, picface, picback, picright, note) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $req->execute(array($name, $firstname, $birthdate, $skin, $hair, $phone, $address, $img1, $img2, $img3, $note));
    $civilid = $bdd->lastInsertId();

    $type = "civil";
    $sender = $_COOKIE['id'];
    $text = 'Une nouvelle fiche civil a été créée pour '. $name. " ".$firstname;
    $datetime = date("Y-m-d H:i:s");

    $req = $bdd->prepare('SELECT ID FROM members_bcso WHERE grade = "Sheriff" OR grade = "Sheriff Adjoint" OR grade = "Major" OR grade = "Lieutenant"');
    $req->execute();
    $resultbcso = $req->fetchAll();

    foreach($resultbcso as $row) {
        $receiver = $row['ID'];
        $req = $bdd->prepare('INSERT INTO notifications_bcso (type, sender, receiver, text, datetime, civilid) VALUES (?, ?, ?, ?, ?, ?)');
        $req->execute(array($type, $sender, $receiver, $text, $datetime, $civilid));
    }

    header("Location: civils.php");
    //header("Location: functions/notifs/civils_notif.php?name=$name&firstname=$firstname&birthdate=$birthdate&address=$address&phone=$phone&hair=$hair&skin=$skin");
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

    <title>Civils - BCSO</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Civils</h1>
                    <p class="mb-4">Ajouter un civil</p>                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Remplissez les champs ci-dessous</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="newcasier" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom" required>
                                    </div>
                                    <label for="inputFirstname" class="col-sm-2 col-form-label">Prénom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" placeholder="Prénom" required>
                                    </div>
                                    <label for="inputBirthdate" class="col-sm-2 col-form-label">Date de naissance</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputBirthdate" name="inputBirthdate" placeholder="Date de naissance" required>
                                    </div>
                                    <label for="inputAddress" class="col-sm-2 col-form-label">Adresse</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Adresse" required>
                                    </div>
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="(555) 1234-567" maxlength="14">
                                    </div>
                                    <label for="inputHair" class="col-sm-2 col-form-label">Couleur de cheveux</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputHair" name="inputHair" required>
                                            <option value="Blond">Blond</option>
                                            <option value="Brun">Brun</option>
                                            <option value="Noir">Noir</option>
                                            <option value="Roux">Roux</option>
                                            <option value="Châtain">Châtain</option>
                                            <option value="Autre">Chauve</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                    <label for="inputSkin" class="col-sm-2 col-form-label">Couleur de peau</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputSkin" name="inputSkin" required>
                                            <option value="Blanc">Blanc</option>
                                            <option value="Métis">Métis</option>
                                            <option value="Noir">Noir</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>
                                    <label for="note" class="col-sm-2 col-form-label">Note</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                                    </div>
                                    <label for="img1" class="col-sm-2 col-form-label">Photo de face</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="img1" name="img1" placeholder="URL Photo de face">
                                    </div>
                                    <label for="img2" class="col-sm-2 col-form-label">Photo de profil</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="img2" name="img2" placeholder="URL Photo de profil">
                                    </div>
                                    <label for="img3" class="col-sm-2 col-form-label">Photo de dos</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="img3" name="img3" placeholder="URL Photo de dos">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="submit">Ajouter</button>
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
    <script src="vendor/chart.js/Chart.min.js"></script>


    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>
</body>

</html>