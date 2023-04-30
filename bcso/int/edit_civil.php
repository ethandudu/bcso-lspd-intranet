<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

if (isset($_POST['submit'])) {

    $birthdate = $_POST['birthdate'];
    $birthdate = date('Y-m-d', strtotime($birthdate));
    $skin = $_POST['skin'];
    $hair = $_POST['hair'];
    $tel = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $id = $_GET['id'];
    $picface = $_POST['picface'];
    $picback = $_POST['picback'];
    $picright = $_POST['picright'];

    $req = $bdd->prepare('UPDATE civils_bcso SET birthdate = ?, skin = ?, hair = ?, tel = ?, address = ?, picface = ?, picback = ?, picright = ?, note = ? WHERE ID = ?');
    $req->execute(array($birthdate, $skin, $hair, $tel, $address, $picface, $picback, $picright, $note, $id));

    header("Location: details_civils.php?id=$id");
}

$req = $bdd->prepare('SELECT * FROM civils_bcso WHERE ID = ?');
$req->execute(array($_GET['id']));
$req = $req->fetch();
$name = $req['name'];
$firstname = $req['firstname'];
$birthdate = $req['birthdate'];
$birthdate = date('Y-m-d', strtotime($req['birthdate']));
$skin = $req['skin'];
$hair = $req['hair'];
$tel = $req['tel'];
$address = $req['address'];
$note = $req['note'];
$id = $req['ID'];
$pic_face = $req['picface'];
$pic_back = $req['picback'];
$pic_right = $req['picright'];

//save pictures in a list

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
                    <p class="mb-4">Modifier les informations d'un civil</p>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modifications</h6>
                        </div>
                        <form method='POST'>
                        <div class="card-body">
                            <!-- show the informations about the person stored in the database -->
                            <label for="name" class="col-sm-2 col-form-label">Nom Prénom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom Prénom" value="<?php  echo $name . " " .$firstname;?>" disabled>
                            </div>
                            <label for="birthdate" class="col-sm-2 col-form-label">Date de naissance</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Date de naissance" value="<?php  echo $birthdate;?>">
                            </div>
                            <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Adresse" value="<?php  echo $address;?>">
                            </div>
                            <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone" value="<?php  echo $tel;?>">
                            </div>
                            <label for="skin" class="col-sm-2 col-form-label">Couleur de peau</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="skin" name="skin" required>
                                            <?php
                                            //select the correct skin color in the list
                                            $skincolors = ["Blanc", "Métis", "Noir", "Autre"];
                                            foreach ($skincolors as $skincolor) {
                                                if ($skincolor == $skin) {
                                                    echo "<option value='$skincolor' selected>$skincolor</option>";
                                                } else {
                                                    echo "<option value='$skincolor'>$skincolor</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                            <label for="hair" class="col-sm-2 col-form-label">Cheveux</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="hair" name="hair" required>
                                    <?php
                                    //select the correct hair color in the list
                                    $haircolors = ["Blond", "Brun", "Noir", "Roux", "Châtain", "Chauve", "Autre"];
                                    foreach ($haircolors as $haircolor) {
                                        if ($haircolor == $hair) {
                                            echo "<option value='$haircolor' selected>$haircolor</option>";
                                        } else {
                                            echo "<option value='$haircolor'>$haircolor</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <label for="img1" class="col-sm-2 col-form-label">Photo de face</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="img1" name="img1" placeholder="URL Photo de face" value="<?php echo $pic_face?>">
                            </div>
                            <label for="img2" class="col-sm-2 col-form-label">Photo de profil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="img2" name="img2" placeholder="URL Photo de profil" value="<?php echo $pic_right?>">
                            </div>
                            <label for="img3" class="col-sm-2 col-form-label">Photo de dos</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="img3" name="img3" placeholder="URL Photo de dos" value="<?php echo $pic_back?>">
                            </div>
                            <label for="note" class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="note" name="note" placeholder="Note" value="<?php  echo $note;?>">
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <a href="civils.php" class="btn btn-secondary">Retour</a>
                            <input type="submit" class="btn btn-success" value="Enregistrer" name="submit">
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

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>
    <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("dataTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>

</html>