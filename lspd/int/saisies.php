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

    <title>Saisies - LSPD</title>

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
                                    <li>01 à 10 : Pochon de Weed</li>
                                    <li>11 à 20 : Pochon de Cocaïne</li>
                                    <li>21 à 30 : Pochon de Meth</li>
                                    <li>31 à 35 : Autres drogues</li>
                                    <li>36 à 37 : Tortue</li>
                                    <li>38 à 39 : Aileron de requin</li>
                                    <li>40 à 41 : Chair d'espadon</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Communication</h6>
                                </div>
                                <ul>
                                    <li>42 : Téléphone</li>
                                    <li>43 à 44 : Radio</li>
                                    <li>45 à 47 : Braquage</li>
                                    <li>48 à 49 : Autres saisies</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Armes Blanches</h6>
                                </div>
                                <ul>
                                    <li>50 : Cran d'arrêt</li>
                                    <li>51 : Machette</li>
                                    <li>52 : Couteau</li>
                                    <li>53 : Dague</li>
                                    <li>54 : Poing Américain</li>
                                    <li>55 : Batte</li>
                                    <li>56 : Queue de billard</li>
                                    <li>57 à 59 : Autres armes blanches</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Armes à Feu</h6>
                                </div>
                                <ul>
                                    <li>60 : Pistolet (Légal)</li>
                                    <li>61 : Pistolet céramique (Légal)</li>
                                    <li>62 : Pistolet SNS (Légal)</li>
                                    <li>63 : Pistolet Lourd (Illégal)</li>
                                    <li>64 : Pistolet .50 (Illégal)</li>
                                    <li>65 : Micro SMG (Illégal)</li>
                                    <li>66 : Machine Pistol (Illégal)</li>
                                    <li>67 : Combat PDW (Illégal)</li>
                                    <li>68 : Assaut SMG (Illégal)</li>
                                    <li>69 : Bullpup Rifle (Illégal)</li>
                                    <li>70 : Assaut Rifle (Illégal)</li>
                                    <li>71 : Carabine Rifle (Illégal)</li>
                                    <li>72 : Fusil à pompe de combat (Illégal)</li>
                                    <li>73 : Sawn off shotgun (Illégal)</li>
                                    <li>74 : Fusil à pompe (Illégal)</li>
                                    <li>75 : Mini SMG (Illégal)</li>
                                    <li>76 : SMG (Illégal - Arme LSPD)</li>
                                    <li>77 : Gillets pare-balle</li>
                                </ul>
                            </div>
                             <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Munitions</h6>
                                </div>
                                <ul>
                                    <li>80 : Cal. 50 AE</li>
                                    <li>81 : Cal. 45 ACP</li>
                                    <li>82 : Cal. 7.62mm</li>
                                    <li>83 : Cal. 12 Gauge</li>
                                    <li>84 : Cal. 9mm</li>
                                    <li>85 : Cal. 5.56mm</li>
                                </ul>
                            </div>
                            <div class="card shadow mb-4">
                               <div class="card-header py-3">
                                   <h6 class="m-0 font-weight-bold text-primary">Autres</h6>
                               </div>
                               <ul>
                                    <li>100 : Argent Sale</li>
                                    <li>201-202 : Nourritures</li>
                                    <li>203-204 : Boisson</li>
                                    <li>205 : Kits de réparation</li>
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