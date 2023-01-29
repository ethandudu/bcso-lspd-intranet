<?php
session_start();
include('../config.php');



if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}

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


    
    $fileName1 = basename($_FILES["pica"]["name"]);
    $fileType1 = pathinfo($fileName1,PATHINFO_EXTENSION);
    $image1 = $_FILES['pica']['tmp_name'];
    $imgcontent1 = base64_encode(file_get_contents($image1));

    $fileName2 = basename($_FILES["picb"]["name"]);
    $fileType2 = pathinfo($fileName2,PATHINFO_EXTENSION);
    $image2 = $_FILES['picb']['tmp_name'];
    $imgcontent2 = base64_encode(file_get_contents($image2));

    $fileName3 = basename($_FILES["picc"]["name"]);
    $fileType3 = pathinfo($fileName3,PATHINFO_EXTENSION);
    $image3 = $_FILES['picc']['tmp_name'];
    $imgcontent3 = base64_encode(file_get_contents($image3));


    $req = $bdd->prepare('INSERT INTO civil (name, firstname, birthdate, skin, hair, tel, adress, picface, picback, picright, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $req->execute(array($name, $firstname, $birthdate, $skin, $hair, $phone, $address, $imgcontent1, $imgcontent2, $imgcontent3, $note));

    header("Location: civils.php");
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-info badge-counter">0</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifications
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-info">
                                            <i class="fas fa-star text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">12 Janvier 2023</div>
                                        <span class="">Bienvenue sur l'intranet BCSO</span>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Voir toutes les alertes</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-info badge-counter">0</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Messages
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Comming Soon</div>
                                        <div class="small text-gray-500">Admin · 0m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Voir tous les messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo($_SESSION['firstname']);?> <?php echo($_SESSION['name']);?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Paramètres
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Déconnexion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
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
                                        <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Téléphone" required>
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
                                    <label for="pica" class="col-sm-2 col-form-label">Photo de face</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="pica" name="pica" placeholder="Photo de face" accept="image/png, image/jpeg, image/jpg, image/bmp">
                                    </div>
                                    <label for="picb" class="col-sm-2 col-form-label">Photo de profil</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="picb" name="picb" placeholder="Photo de profil" accept="image/png, image/jpeg, image/jpg, image/bmp">
                                    </div>
                                    <label for="picc" class="col-sm-2 col-form-label">Photo de dos</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="picc" name="picc" placeholder="Photo de dos" accept="image/png, image/jpeg, image/jpg, image/bmp">
                                        <small id="picaHelp" class="form-text text-muted">Formats acceptés : .jpg, .jpeg, .png, .bmp</small>
                                        <small id="picaHelp" class="form-text text-muted">Taille maximale : 2Mo</small>
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
                        <span>Copyright &copy; BCSO - Amercian Stories 2023</span><br>
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

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>
</body>

</html>