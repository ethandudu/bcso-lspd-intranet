<?php
session_start();
include('../config.php');

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

    <title>Armes - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Armes</h1>

                    <!-- list of weapons -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <p><label>Rechercher un numéro de série :
                            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" onkeyup="myFunction()">
                        </label></p>
                            <input type="button" class="btn btn-success" value="Ajouter une arme" data-toggle="modal" data-target="#addWeaponModal">
                            <input type="button" class="btn btn-danger" value="Supprimer une arme" data-toggle="modal" data-target="#deleteWeaponModal">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom Prénom</th>
                                            <th>Arme</th>
                                            <th>Numéro de série</th>
                                            <th>Date d'enregistrement</th>
                                            <th>Saisie</th>
                                            <th>Officier</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nom Prénom</th>
                                            <th>Arme</th>
                                            <th>Numéro de série</th>
                                            <th>Date d'enregistrement</th>
                                            <th>Saisie</th>
                                            <th>Officier</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM weapons ORDER BY name, firstname ASC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td>' . $data['name'] . ' ' . $data['firstname'] . '</td>';
                                            echo '<td>' . $data['weapon_type'] . '</td>';
                                            echo '<td>' . $data['serialnumber'] . '</td>';
                                            echo '<td>' . date("d/m/Y", strtotime($data['datetime'])) . '</td>';
                                            if ($data['saisie'] == 1) {
                                                echo '<td><span class="badge badge-danger">Oui</span></td>';
                                            } else {
                                                echo '<td><span class="badge badge-success">Non</span></td>';
                                            }
                                            if ($data['officier_type'] == "LSPD"){
                                                $req2 = $bdd->prepare('SELECT matricule, name, firstname FROM members_lspd WHERE ID = ?');
                                                $req2->execute(array($data['officier']));
                                                $data2 = $req2->fetch();
                                                echo '<td>' . $data2['matricule'] . ' - ' . $data2['name'] . ' ' . $data2['firstname'] . '</td>';
                                            } else {
                                                $req2 = $bdd->prepare('SELECT name, firstname FROM members_bcso WHERE ID = ?');
                                                $req2->execute(array($data['officier']));
                                                $data2 = $req2->fetch();
                                                echo '<td>' . $data2['name'] . ' ' . $data2['firstname'] . '</td>';
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="text-primary">Armes autorisées avec le PPA</h6>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li>Pistolet</li>
                                    <li>Pistolet en céramique</li>
                                    <li>SNS</li>
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
    <div class="modal fade" id="addWeaponModal" tabindex="-1" role="dialog" aria-labelledby="addWeaponModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="addWeaponModal" id="exampleModalLabel">Ajouter une arme</h5>
                </div>
                <div class="modal-body">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                    <label for="weapon_type">Type d'arme</label>
                    <input type="text" class="form-control" id="weapon_type" name="weapon_type" placeholder="Type d'arme">
                    <label for="serialnumber">Numéro de série</label>
                    <input type="text" class="form-control" id="serialnumber" name="serialnumber" placeholder="Numéro de série">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-warning" type="button" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-success" type="button" onclick="addweapon()">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteWeaponModal" tabindex="-1" role="dialog" aria-labelledby="removeWeaponModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="removeWeaponModal" id="exampleModalLabel">Supprimer une arme</h5>
                </div>
                <div class="modal-body">
                    <label for="sn2">Numéro de série</label>
                    <select class="form-control" id="sn2" name="sn2">
                        <?php
                        $req = $bdd->prepare('SELECT * FROM weapons');
                        $req->execute();
                        while ($data = $req->fetch()) {
                            echo '<option value="' . $data['serialnumber'] . '">' . $data['serialnumber'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-warning" type="button" data-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary btn-success" type="button" onclick="deleteweapon()">Supprimer</button>
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
    <script>
        function addweapon(){
            var type = "add";
            var name = document.getElementById('name').value;
            var firstname = document.getElementById('firstname').value;
            var weapon_type = document.getElementById('weapon_type').value;
            var serialnumber = document.getElementById('serialnumber').value;
            $.ajax({
                url: 'functions/weaponsfunction.php',
                type: 'POST',
                data: {
                    type: type,
                    name: name,
                    firstname: firstname,
                    weapon_type: weapon_type,
                    serialnumber: serialnumber,
                    officier: <?php echo $_COOKIE['id']; ?>
                },
                success: function(data) {
                    alert("Arme ajoutée !");
                    location.reload();
                }
            });
        }

        function deleteweapon(){
            var type = "delete";
            var serialnumber2 = document.getElementById('sn2').value;
            $.ajax({
                url: 'functions/weaponsfunction.php',
                type: 'POST',
                data: {
                    type: type,
                    serialnumber: serialnumber2
                },
                success: function(data) {
                    alert("Arme supprimée !");
                    location.reload();
                }
            });
        }
    </script>
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
    td = tr[i].getElementsByTagName("td")[2];
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