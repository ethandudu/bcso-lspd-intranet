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

    <title>Saisies - BCSO</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Casiers de saisie</h1>
                    <div class="row">

                    <!-- list of weapons -->
                        <div class="col-lg-6">
                        <!-- list of weapons -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Drogue</h6>
                                </div>
                                <ul>
                                    <li>1501 à 1510 : Pochon de Weed</li>
                                    <li>1511 à 1520 : Pochon de Cocaïne</li>
                                    <li>1521 à 1530 : Pochon de Meth</li>
                                    <li>1531 à 1535 : Autres drogues</li>
                                    <li>1536 à 1537 : Tortue</li>
                                    <li>1538 à 1539 : Aileron de requin</li>
                                    <li>1540 à 1541 : Chair d'espadon</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Communication</h6>
                                </div>
                                <ul>
                                    <li>1542 : Téléphone</li>
                                    <li>1543 à 1544 : Radio</li>
                                    <li>1545 à 1547 : Braquage</li>
                                    <li>1548 à 1549 : Autres saisies</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Armes Blanches</h6>
                                </div>
                                <ul>
                                    <li>1550 : Cran d'arrêt</li>
                                    <li>1551 : Machette</li>
                                    <li>1552 : Couteau</li>
                                    <li>1553 : Dague</li>
                                    <li>1554 : Poing Américain</li>
                                    <li>1555 : Batte</li>
                                    <li>1556 : Queue de billard</li>
                                    <li>1557 à 1559 : Autres armes blanches</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                               <div class="card-header py-3">
                                   <h6 class="m-0 font-weight-bold text-primary">Divisions</h6>
                               </div>
                               <ul>
                                    <li>1701 : S.W.A.T.</li>
                                    <li>1702 : S.A.H.P.</li>
                                    <li>1703 : B.E.</li>
                                    <li>1704 : Henry</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Armes à Feu</h6>
                                </div>
                                <ul>
                                    <li>1560 : Pistolet</li>
                                    <li>1561 : Pistolet céramique</li>
                                    <li>1562 : Pistolet SNS</li>
                                    <li>1563 : Pistolet Lourd</li>
                                    <li>1564 : Pistolet .50</li>
                                    <li>1565 : Micro SMG</li>
                                    <li>1566 : Machine Pistol</li>
                                    <li>1567 : Combat PDW</li>
                                    <li>1568 : Assaut SMG</li>
                                    <li>1569 : Bullpup Rifle</li>
                                    <li>1570 : Assaut Rifle</li>
                                    <li>1571 : Carabine Rifle</li>
                                    <li>1572 : Fusil à pompe de combat</li>
                                    <li>1573 : Sawn off shotgun</li>
                                    <li>1574 : Fusil à pompe</li>
                                    <li>1575 : Mini SMG</li>
                                    <li>1576 : SMG</li>
                                    <li>1577 : Compact Rifle</li>
                                </ul>
                            </div>
                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Munitions</h6>
                                </div>
                                <ul>
                                    <li>1580 : Cal. 50 AE</li>
                                    <li>1581 : Cal. 45 ACP</li>
                                    <li>1582 : Cal. 7.62mm</li>
                                    <li>1583 : Cal. 12 Gauge</li>
                                    <li>1584 : Cal. 9mm</li>
                                    <li>1585 : Cal. 5.56mm</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                               <div class="card-header py-3">
                                   <h6 class="m-0 font-weight-bold text-primary">Autres</h6>
                               </div>
                               <ul>
                                    <li>1599 : Papiers d'identité</li>
                                    <li>1600 : Argent sale</li>
                                    <li>1601 : Commun BCSO</li>
                                    <li>1602 : Boissons BCSO</li>
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