<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

    <title>Procédures - BCSO</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Procédures</h1>
                    <div class="row">

                    <!-- list of weapons -->
                        <div class="col-lg-6">
                        <!-- list of weapons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Arrestation</h6>
                                </div>
                                <ul>
                                    <li>Interpellation</li>
                                    <li>Palpation de sécurité</li>
                                    <li>Menottage</li>
                                    <li>Lecture des droits et fouille complète (en cas de danger, lecture et fouille au poste)</li>
                                    <li>Vérification de la saisie et fouille complète</li>
                                    <li>Création de la fiche civil (le cas échéant). Photos torse nu et avec l'appli Appareil photo du téléphone</li>
                                    <li>Mise en cellule, verbalisation</li>
                                    <li>Libération une fois la peine effectuée (le cas échéant)</li>
                                    <li>Faire vérifier le casier et la fiche civil a un supérieur pour les Juniors</li>
                                </ul>
                                <div class="card-footer py-3">
                                Le détenu peut demander à exercer un droit à n'importe quel moment.
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Droits Miranda</h6>
                                </div>
                                Monsieur ou Madame (nom, prénom), nous sommes le (date) il est actuellement (heure).
                                <br>
                                <ul>
                                    <li>Je vous arrêtes pour les faits suivants (faits reprochés). Cette liste est non exhaustive.</li>
                                    <li>Vous avez le droit de garder le silence, tous ce que vous pourriez dire pourra et sera retenu contre vous devant une cour de justice.</li>
                                    <li>Vous avez  droit à un avocat, si vous n'en avez pas les moyens, un avocat vous sera commis d'office durant votre interrogatoire.</li>
                                    <li>Vous avez droit à de quoi vous restaurer et à une assistance médicale si nécessaire.</li>
                                    <li>Avez vous bien compris vos droits ?</li>
                                </ul>
                                Les droits sont considérés comme acquis à la troisième relecture
                                <div class="card-footer py-3">
                                    Les droits doivent être lus dans les 15 minutes suivant l'arrestation
                                </div>
                            </div>
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