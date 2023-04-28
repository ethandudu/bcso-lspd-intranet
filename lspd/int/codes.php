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

    <title>10-codes / Alphabet - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">10-Codes / Alphabet phonétique</h1>
                    <div class="row">

                    <!-- list of weapons -->
                        <div class="col-lg-6">
                        <!-- list of weapons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">10-Codes</h6>
                                </div>
                                <ul>
                                    <li>10-01 : Officier à terre</li>
                                    <li>10-3 : Stop aux transmissions</li>
                                    <li>10-4 : Affirmatif</li>
                                    <li>10-5 : Négatif</li>
                                    <li>10-6 : Occupé</li>
                                    <li>10-7 : Fin de service</li>
                                    <li>10-8 : Prise de service / en service</li>
                                    <li>10-9 : Réitérez / Répétez dernier message</li>
                                    <li>10-19 : Retour PDP</li>
                                </ul>
                                <ul>
                                    <li>10-20 : Votre localisation</li>
                                    <li>10-21 : Appelez par téléphone</li>
                                    <li>10-23 : Arrivée sur les lieux</li>
                                    <li>10-24 : Renforts demandés</li>
                                    <li>10-28 : Vérifiez la plaque d'immatriculation / MDT</li>
                                    <li>10-29A : Début de contrôle</li>
                                    <li>10-29B : Fin de contrôle</li>
                                </ul>
                                <ul>
                                    <li>10-30 : Refus d'obtempérer / Délit de fuite</li>
                                    <li>10-32 : Suspect armé</li>
                                </ul>
                                <ul>
                                    <li>10-41 : Début de patrouille</li>
                                    <li>10-42 : Fin de patrouille</li>
                                    <li>10-43 : SitRep</li>
                                </ul>
                                <ul>
                                    <li>10-50 : Accident de la route</li>
                                    <li>10-52 : Demande d'ambulance</li>
                                </ul>
                                <ul>
                                    <li>10-99 : Demande de toutes les unités sur place</li>
                                </ul>
                                <ul>
                                    <li>10-404 : Problème de tête</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Codes</h6>
                                </div>
                                <ul>
                                    <li>CODE 1 : Répondre à l'appel</li>
                                    <li>CODE 2 : Répondre à l'appel sans sirènes ni gyrophares</li>
                                    <li>CODE 3 : Appel urgent sirènes et gyrophares</li>
                                    <li>CODE 4 : Situation sous contrôle fin d'intervention</li>
                                    <li>CODE 6 : Pied à terre a un endroit</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Patrouilles</h6>
                                </div>
                                <ul>
                                    <li>Lincoln : Seul en véhicule</li>
                                    <li>Adam : 2 en véhicule</li>
                                    <li>Tango : 3 en véhicule</li>
                                    <li>Xray : 4 en véhicule (INTERDIT SAUF AUTORISATION)</li>
                                    <li>William : Unité DOA (Unité requise)</li>
                                    <li>Marry : Patrouille motorisée (Unité requise)</li>
                                    <li>Henry : Patrouille héliportée (Formation requise)</li>
                                    <li>Sierra : Patrouille SAHP (Unité requise)</li>
                                    <li>David / Goliath : Véhicule SWAT (Unité requise)</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Alphabet phonétique</h6>
                                </div>
                                <ul>
                                    <li>Alpha</li>
                                    <li>Bravo</li>
                                    <li>Charlie</li>
                                    <li>Delta</li>
                                    <li>Echo</li>
                                    <li>Foxtrot</li>
                                    <li>Golf</li>
                                    <li>Hotel</li>
                                    <li>India</li>
                                    <li>Juliett</li>
                                    <li>Kilo</li>
                                    <li>Lima</li>
                                    <li>Mike</li>
                                    <li>November</li>
                                    <li>Oscar</li>
                                    <li>Papa</li>
                                    <li>Quebec</li>
                                    <li>Romeo</li>
                                    <li>Sierra</li>
                                    <li>Tango</li>
                                    <li>Uniform</li>
                                    <li>Victor</li>
                                    <li>Whiskey</li>
                                    <li>Xray</li>
                                    <li>Yankee</li>
                                    <li>Zulu</li>
                                </ul>
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