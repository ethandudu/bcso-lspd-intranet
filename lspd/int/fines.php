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

    <title>Amendes impayées - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Amendes impayées</h1>
                    <p class="mb-4">Liste des amendes impayées</p>
                    <p><label>Rechercher :
                            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" onkeyup="myFunction()">
                        </label></p>
                    <br>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addModal"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Ajouter une amende impayée</span></button>

                            <!-- Modal add-->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Ajouter une amende impayée</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="civil">Civil</label>   
                                            <select class="form-control" id="inputName" name="inputName" required></select>
                                            <button type="button" class="btn btn-primary" onclick="showsearch()">Rechercher</button>
                                            <br>
                                            <label for="factureid">N° de facture</label>
                                            <input type="number" class="form-control" id="factureid" name="factureid" placeholder="" required min="0">
                                            <label for="value">Montant</label>
                                            <input type="number" class="form-control" id="value" name="value" placeholder="" required min="0">
                                            <label for="datetime">Date</label>
                                            <input type="datetime-local" class="form-control" id="datetime" name="datetime" placeholder="" required autocomplete="off">
                                            <label for="note">Note</label>
                                            <input type="text" class="form-control" id="note" name="note" placeholder="" required autocomplete="off">
                                            <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="searchModalLabel">Rechercher un civil</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="label">Nom Prénom</label>
                                                            <input type="text" class="form-control" id="label" name="label" placeholder="" required autocomplete="off">
                                                            <label for="search">Résultats</label>
                                                            <select class="form-control" id="search" name="search" required>
                                                                <option value="0">Aucun résultat</option>
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" onclick="closesearch()">Annuler</button>
                                                            <button type="button" class="btn btn-success" onclick="civilselect()">Sélectionner</button>
                                                            <script>
                                                            function closesearch() {
                                                                $('#searchModal').modal('hide')
                                                            }
                                                            function showsearch() {
                                                                $('#searchModal').modal('show');
                                                            }

                                                            //detect when a key is pressed in the search bar
                                                            var type = "search";
                                                            document.getElementById("label").addEventListener("keyup", function(event) {
                                                                //if the key pressed is the enter key
                                                                if (event.keyCode === 13) {
                                                                    //prevent the form from being submitted
                                                                    event.preventDefault();
                                                                }
                                                                var label = document.getElementById("label").value;
                                                                //
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "functions/civilsearch.php",
                                                                    dataType: "html",
                                                                    data: {type: type, label: label},
                                                                    success: function(data){
                                                                    var res = JSON.parse(data);
                                                                    var select = document.getElementById("search");
                                                                    select.innerHTML = "";
                                                                    for (var i = 0; i < res.length; i++) {
                                                                        var option = document.createElement("option");
                                                                        option.value = res[i].ID;
                                                                        option.text = res[i].name + " " + res[i].firstname;
                                                                        select.appendChild(option);
                                                                    }
                                                                    
                                                                }
                                                                });
                                                            });
                                                            function civilselect(){
                                                                //get the value from "search" select and put it in "inputName" select
                                                                var select = document.getElementById("search");
                                                                var input = document.getElementById("inputName");
                                                                input.innerHTML = "";
                                                                var option = document.createElement("option");
                                                                option.value = select.value;
                                                                //alert the value of the option
                                                                option.text = select.options[select.selectedIndex].text;
                                                                input.appendChild(option);
                                                                $('#searchModal').modal('hide');
                                                            }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="button" class="btn btn-success" onclick="addfine()">Ajouter</button>
                                            <script>
                                                    function addfine(){
                                                        $type = "add";
                                                        $agent = <?php echo $_COOKIE['id']; ?>;
                                                        $civil = document.getElementById("inputName").value;
                                                        $value = document.getElementById("value").value;
                                                        $datetime = document.getElementById("datetime").value;
                                                        $note = document.getElementById("note").value;
                                                        $factureid = document.getElementById("factureid").value;

                                                        //check if one of the fields is empty
                                                        if ($civil == "" || $value == "" || $datetime == "" || $factureid == "") {
                                                            alert("Veuillez remplir tous les champs");
                                                            return;
                                                        }
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "functions/finesfunction.php",
                                                            dataType: "html",
                                                            data: {type: $type, agent: $agent, civil: $civil, value: $value, datetime: $datetime, note: $note, factureid: $factureid},
                                                            success: function(data){
                                                                alert('Amende ajoutée');
                                                                location.reload();
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
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Montant</th>
                                            <th>Officier</th>
                                            <th>Date</th>
                                            <th>Note</th>
                                            <th>Actions</th>
                                            <th>État</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom Prénom</th>
                                            <th>Montant</th>
                                            <th>Officier</th>
                                            <th>Date</th>
                                            <th>Note</th>
                                            <th>Actions</th>
                                            <th>État</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM fines_lspd ORDER BY factureid ASC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td>' . $data['factureid'] . '</td>';
                                            $reqcivil = $bdd->prepare('SELECT name, firstname from civils_lspd WHERE ID = ?');
                                            $reqcivil->execute(array($data['civilid']));
                                            $civil = $reqcivil->fetch();
                                            echo '<td>' . $civil['name'] ." ".$civil['firstname'].'</td>';
                                            echo '<td>' . $data['value'] . ' $</td>';
                                            $reqofficer = $bdd->prepare('SELECT name, firstname, matricule from members_lspd WHERE ID = ?');
                                            $reqofficer->execute(array($data['officierid']));
                                            $officer = $reqofficer->fetch();
                                            if ($officer['name'] == NULL) {
                                                $officer['name'] = "Inconnu";
                                                $officer['firstname'] = "";
                                            }
                                            echo '<td>' . $officer['matricule']. " - " .$officer['name'] ." ".$officer['firstname'].'</td>';
                                            echo '<td>' . date("d/m/Y H:i", strtotime($data['datetime'])) . '</td>';
                                            echo '<td>' . $data['note'] . '</td>';
                                            echo "<td> <a href='javascript:loadcivil(".$data['civilid'].")'><i class='fas fa-eye'></i></a> <a href='javascript:removefine(" . $data['ID'] . ")'><i class='fas fa-trash'></i></a></td>";
                                            // check if the fine is more than 48 hours old
                                            $date = new DateTime($data['datetime']);
                                            $now = new DateTime();
                                            $interval = $date->diff($now);
                                            if ($interval->format('%a') >= 2) {
                                                echo '<td><span class="badge badge-danger">Retard</span></td>';
                                            } else {
                                                echo '<td><span class="badge badge-warning">En attente</span></td>';
                                            }
                                            echo '</tr>';
                                        }
                                        ?>
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
    <div class="modal fade" id="civilModal" tabindex="-1" role="dialog" aria-labelledby="civilModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="civilModalLabel">Détails du civil</h5>
                </div>
                <div class="modal-body">
                    <label for="namedetail">Nom Prénom</label>
                    <input type="text" class="form-control" id="namedetail" name="namedetail" placeholder="" required autocomplete="off" disabled>
                    <label for="phonedetail">Téléphone</label>
                    <input type="text" class="form-control" id="phonedetail" name="phonedetail" placeholder="" required autocomplete="off" disabled>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-info" value="Casier judiciaire" onclick="window.location.href='export_casier.php?id='+$id">
                    <input type="button" class="btn btn-primary" value="Fiche civil" onclick="window.location.href='details_civils.php?id='+$id">
                    <button type="button" class="btn btn-secondary" onclick="closecivil()">Fermer</button>
                    <script>
                        function closecivil() {
                            $('#civilModal').modal('hide')
                        }

                        function loadcivil(id) {
                            $id = id;
                            $type = "loadcivil";
                            $.ajax({
                                type: "POST",
                                url: "functions/finesfunction.php",
                                dataType: "html",
                                data: {id: $id, type: $type},
                                success: function(data){
                                    var res = JSON.parse(data);
                                    document.getElementById("namedetail").value = res[0].name + " " + res[0].firstname;
                                    document.getElementById("phonedetail").value = res[0].tel;
                                    $('#civilModal').modal('show');
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

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
        function removefine(fineid){
            $type = "remove";
            $.ajax({
                type: "POST",
                url: "functions/finesfunction.php",
                dataType: "html",
                data: {type: $type, id: fineid},
                success: function(data){
                    if(data == "success"){
                        alert("Amende supprimée avec succès");
                        location.reload();
                    }else{
                        alert("Erreur lors de la suppression de l'amende");
                    }
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
