<?php
session_start();
include('../config.php');
include('functions/adminverif.php');

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

    <title>Véhicules - BCSO</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Véhicules</h1>
                    <p class="mb-4">Véhicules du garage BCSO</p>
                    <p><label>Rechercher:
                            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" onkeyup="myFunction()">
                        </label></p>
                    <br>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Ajouter un véhicule</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal">Modifier un véhicule</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Supprimer un véhicule</button>

                            <!-- Modal add-->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Ajouter un véhicule</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="label">Nom du véhicule</label>
                                            <input type="text" class="form-control" id="label" name="label" placeholder="Nom du véhicule" required>
                                            <label for="plate">Plaque d'immatriculation</label>
                                            <input type="text" class="form-control" id="plate" name="plate" placeholder="Plaque d'immatriculation" required>
                                            <label for="model">Modèle</label>
                                            <select class="form-control" id="model" name="model">
                                                <option value="FordMustang">Ford Mustang</option>
                                                <option value="Vic">Vic</option>
                                                <option value="Policeb">Moto</option>
                                                <option value="VapidTarv">Vapid Tarv</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-success" onclick="vehicleadd()">Ajouter</button>
                                            <script>
                                                function vehicleadd(){
                                                    var label = document.getElementById("label").value;
                                                    var plate = document.getElementById("plate").value;
                                                    var model = document.getElementById("model").value;
                                                    var type = "add";

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "functions/vehiclesfunction.php",
                                                        dataType: "html",
                                                        data: {type: type, label: label, plate: plate, model: model},
                                                        success: function(data){
                                                            if(data == "success"){
                                                                alert("Véhicule ajouté avec succès");
                                                                location.reload();
                                                            }else{
                                                                alert("Erreur lors de l'ajout du véhicule");
                                                            }
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal edit-->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Modifier un véhicule</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="plate2">Plaque d'immatriculation</label>
                                            <select class="form-control" id="plate2" name="plate2" onchange="vehload()">
                                                <option value="0">Sélectionner une plaque</option>
                                            <?php
                                                $reqveh = $bdd->prepare("SELECT ID, plate, label FROM vehicles_bcso ORDER BY label ASC");
                                                $reqveh->execute();
                                                while($plate = $reqveh->fetch()){
                                                    echo '<option value="'.$plate['plate'].'">'.$plate['plate'].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label for="label2">Nom du véhicule</label>
                                            <input type="text" class="form-control" id="label2" name="label2" placeholder="">
                                            <label for="owner2">Propriétaire</label>
                                            <select class="form-control" id="owner2" name="owner2">
                                                <option value="0">Non attribué</option>
                                            <?php
                                                $reqowner = $bdd->prepare("SELECT ID, firstname, name FROM members_bcso ORDER BY name ASC");
                                                $reqowner->execute();
                                                while($owner = $reqowner->fetch()){
                                                    echo '<option value="'.$owner['ID'].'">'.$owner['firstname'].' '.$owner['name'].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-success" onclick="vehicleedit()">Modifier</button>
                                            <script>
                                                function vehload(){
                                                    var plate = document.getElementById("plate2").value;
                                                    var type = "load";

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "functions/vehiclesfunction.php",
                                                        dataType: "html",
                                                        data: {type: type, plate: plate},
                                                        success: function(data){
                                                            var veh = JSON.parse(data);
                                                            document.getElementById("label2").value = veh[0].label;
                                                            document.getElementById("owner2").value = veh[0].owner;
                                                            
                                                        }
                                                    });
                                                }
                                                function vehicleedit(){
                                                    var plate = document.getElementById("plate2").value;
                                                    var label = document.getElementById("label2").value;
                                                    var owner = document.getElementById("owner2").value;

                                                    var type = "edit";

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "functions/vehiclesfunction.php",
                                                        dataType: "html",
                                                        data: {type: type, label: label, plate: plate, owner: owner},
                                                        success: function(data){
                                                            if(data == "success"){
                                                                alert("Véhicule modifié avec succès");
                                                                location.reload();
                                                            }else{
                                                                alert("Erreur lors de la modification du véhicule");
                                                            }
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal delete-->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Supprimer un véhicule</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="plate3">Plaque d'immatriculation</label>
                                            <select class="form-control" id="plate3" name="plate3" onchange="vehload2()">
                                                <option value="0">Sélectionner une plaque</option>
                                            <?php
                                                $reqveh = $bdd->prepare("SELECT ID, plate, label FROM vehicles_bcso ORDER BY label ASC");
                                                $reqveh->execute();
                                                while($plate = $reqveh->fetch()){
                                                    echo '<option value="'.$plate['plate'].'">'.$plate['plate'].'</option>';
                                                }
                                            ?>
                                            </select>
                                            <label for="label3">Nom du véhicule</label>
                                            <input type="text" class="form-control" id="label3" name="label3" placeholder="Nom du véhicule" disabled>
                                            <label for="owner3">Propriétaire</label>
                                            <select class="form-control" id="owner3" name="owner3" disabled>
                                                <option value="0">Non attribué</option>
                                            <?php
                                                $reqowner = $bdd->prepare("SELECT ID, firstname, name FROM members_bcso ORDER BY name ASC");
                                                $reqowner->execute();
                                                while($owner = $reqowner->fetch()){
                                                    echo '<option value="'.$owner['ID'].'">'.$owner['firstname'].' '.$owner['name'].'</option>';
                                                }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-danger" onclick="vehicledelete()">Supprimer</button>
                                            <script>
                                                function vehload2(){
                                                    var plate = document.getElementById("plate3").value;
                                                    var type = "load";

                                                    $.ajax({
                                                        type: "POST",
                                                        url: "functions/vehiclesfunction.php",
                                                        dataType: "html",
                                                        data: {type: type, plate: plate},
                                                        success: function(data){
                                                            var veh = JSON.parse(data);
                                                            document.getElementById("label3").value = veh[0].label;
                                                            document.getElementById("owner3").value = veh[0].owner;
                                                            
                                                        }
                                                    });
                                                }
                                                function vehicledelete(){
                                                    var plate = document.getElementById("plate3").value;
                                                    var type = "delete";
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "functions/vehiclesfunction.php",
                                                        dataType: "html",
                                                        data: {type: type, plate: plate},
                                                        success: function(data){
                                                            if(data == "success"){
                                                                alert("Véhicule supprimé avec succès");
                                                                location.reload();
                                                            }else{
                                                                alert("Erreur lors de la suppression du véhicule");
                                                            }
                                                        }
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Plaque</th>
                                            <th>Modèle</th>
                                            <th>Propriétaire</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Plaque</th>
                                            <th>Modèle</th>
                                            <th>Propriétaire</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM vehicles_bcso ORDER BY label ASC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td>' . $data['label'] .'</td>';
                                            echo '<td>' . $data['plate'] . '</td>';
                                            echo '<td>' . $data['model'] . '</td>';
                                            if ($data['owner'] == 0) {
                                                echo '<td>Non attribué</td>';
                                            } else {
                                                $req2 = $bdd->prepare('SELECT name, firstname FROM members_bcso WHERE ID = ?');
                                                $req2->execute(array($data['owner']));
                                                $owner = $req2->fetch();
                                                echo '<td>' . $owner['name'] . ' ' . $owner['firstname'] . '</td>';
                                            }
                                        }
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
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
    td = tr[i].getElementsByTagName("td")[1];
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