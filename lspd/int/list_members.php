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

    <title>Agents - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Agents</h1>
                    <p class="mb-4">Tous les agents enregistrés</p>
                    <p><label>Rechercher:
                            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" onkeyup="myFunction()">
                        </label></p>
                        <input type="button" class="btn btn-primary" value="Ajouter un agent" onclick="window.location.href='add_members.php'">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Ajouter une formation</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Retirer une formation</button>
                    <br><br>
                    
                    
                    <!-- Modal add-->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Ajouter une formation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                            <div class="modal-body">
                                <label for="agent">Agent</label>
                                <select class="form-control" id="agent" name="agent">
                                    <?php
                                    $reqagent = $bdd->prepare("SELECT ID, firstname, name FROM members_lspd ORDER BY gradevalue DESC");
                                    $reqagent->execute();
                                    while($agent = $reqagent->fetch()){
                                        echo '<option value="'.$agent['ID'].'">'.$agent['firstname'].' '.$agent['name'].'</option>';
                                    }
                                    ?>
                                </select>
                                <label for="formation">Formation</label>
                                <select class="form-control" id="formation" name="formation">
                                    <option value="ppa">PPA</option>
                                    <option value="ppa2">PPA 2</option>
                                    <option value="recruteur">Recruteur/Instructeur</option>
                                    <option value="dispatcheur">Dispatcheur</option>
                                    <option value="conduite">Stage conduite sécurité</option>
                                    <option value="negociateur">Négociateur</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-success" onclick="formationadd()">Ajouter</button>
                                <script>
                                    function formationadd(){
                                        var agent = document.getElementById("agent").value;
                                        var formation = document.getElementById("formation").value;
                                        var type = "add";

                                        $.ajax({
                                            type: "POST",
                                            url: "functions/formationsfunction.php",
                                            dataType: "html",
                                            data: {type: type, agent: agent, formation: formation},
                                            success: function(data){
                                                if(data == "success"){
                                                    alert("Formation ajoutée avec succès");
                                                    location.reload();
                                                }else{
                                                    alert("Erreur lors de l'ajout de la formation");
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
                                    <h5 class="modal-title" id="addModalLabel">Retirer une formation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <label for="agent2">Agent</label>
                                    <select class="form-control" id="agent2" name="agent2">
                                        <?php
                                        $reqagent = $bdd->prepare("SELECT ID, firstname, name FROM members_lspd ORDER BY gradevalue DESC");
                                        $reqagent->execute();
                                        while($agent = $reqagent->fetch()){
                                            echo '<option value="'.$agent['ID'].'">'.$agent['firstname'].' '.$agent['name'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <label for="formation2">Formation</label>
                                    <select class="form-control" id="formation2" name="formation2">
                                        <option value="ppa">PPA</option>
                                        <option value="ppa2">PPA 2</option>
                                        <option value="recruteur">Recruteur/Instructeur</option>
                                        <option value="dispatcheur">Dispatcheur</option>
                                        <option value="conduite">Stage conduite sécurité</option>
                                        <option value="negociateur">Négociateur</option>
                                    </select>
                                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" onclick="formationdelete()">Retirer</button>
                                    <script>
                                        function formationdelete(){
                                            var agent = document.getElementById("agent2").value;
                                            var formation = document.getElementById("formation2").value;
                                            var type = "delete";
                                            $.ajax({
                                                type: "POST",
                                                url: "functions/formationsfunction.php",
                                                dataType: "html",
                                                data: {type: type, agent: agent, formation: formation},
                                                success: function(data){
                                                    if(data == "success"){
                                                        alert("Formation retirée avec succès");
                                                        location.reload();
                                                    }else{
                                                        alert("Erreur lors du retrait de la formation");
                                                        }
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Etat Major</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Nom Prénom</th>
                                            <th>Grade</th>
                                            <th>Tel</th>
                                            <th>Date d'entrée</th>
                                            <th>Sanction</th>
                                            <th>Division</th>
                                            <th>PPA</th>
                                            <th>PPA 2</th>
                                            <th>Recruteur / Instructeur</th>
                                            <th>Dispatcheur</th>
                                            <th>Stage conduite sécurité</th>
                                            <th>Négociateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM members_lspd WHERE grade = "Commandant" OR grade = "Capitaine" OR grade = "Lieutenant" OR grade = "Sergent Chef" ORDER BY gradevalue DESC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td class="text-center">' . $data['matricule'] . '</td>';
                                            echo '<td class="text-center">' . $data['name'] . ' ' . $data['firstname'] . '</td>';
                                            echo '<td class="text-center">' . $data['grade'] . '</td>';
                                            echo '<td class="text-center">' . $data['tel'] . '</td>';
                                            echo '<td class="text-center">' . date("d/m/Y", strtotime($data['entrydate'])) . '</td>';
                                            if ($data['sanction'] == "Aucune"){
                                                echo '<td class="text-center"><div style="color: green;">Aucune</div></td>';
                                            } elseif ($data['sanction'] == "Avertissement"){
                                                echo '<td class="text-center"><div style="color: orange;">Avertissement</div></td>';
                                            } elseif ($data['sanction'] == "Blâme"){
                                                echo '<td class="text-center"><div style="color: red;">Blâme</div></td>';
                                            }
                                            echo '<td class="text-center">' . $data['division'] . '</td>';
                                            if ($data['ppa'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['ppa2'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['recruteur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['dispatcheur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['conduite'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['negociateur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            echo '<td class="text-center"><a href="edit_member.php?id='.$data['ID'].'"><i class="fas fa-edit"></i></a> <a href="delete_member.php?id=' . $data['ID'] . '"><i class="fas fa-trash-alt"></i></a></td>';
                                        }
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Officiers</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Nom Prénom</th>
                                            <th>Grade</th>
                                            <th>Tel</th>
                                            <th>Date d'entrée</th>
                                            <th>Sanction</th>
                                            <th>Division</th>
                                            <th>PPA</th>
                                            <th>PPA 2</th>
                                            <th>Recruteur / Instructeur</th>
                                            <th>Dispatcheur</th>
                                            <th>Stage conduite sécurité</th>
                                            <th>Négociateur</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM members_lspd WHERE grade = "Sergent" OR grade = "Officier III" OR grade = "Officier II" OR grade = "Officier I" OR grade = "Cadet" ORDER BY matricule ASC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td class="text-center">' . $data['matricule'] . '</td>';
                                            echo '<td class="text-center">' . $data['name'] . ' ' . $data['firstname'] . '</td>';
                                            echo '<td class="text-center">' . $data['grade'] . '</td>';
                                            echo '<td class="text-center">' . $data['tel'] . '</td>';
                                            echo '<td class="text-center">' . date("d/m/Y", strtotime($data['entrydate'])) . '</td>';
                                            if ($data['sanction'] == "Aucune"){
                                                echo '<td class="text-center"><div style="color: green;">Aucune</div></td>';
                                            } elseif ($data['sanction'] == "Avertissement"){
                                                echo '<td class="text-center"><div style="color: orange;">Avertissement</div></td>';
                                            } elseif ($data['sanction'] == "Blâme"){
                                                echo '<td class="text-center"><div style="color: red;">Blâme</div></td>';
                                            }
                                            echo '<td class="text-center">' . $data['division'] . '</td>';
                                            if ($data['ppa'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['ppa2'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['recruteur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['dispatcheur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['conduite'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['negociateur'] == 1) {
                                                echo '<td class="text-center"><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td class="text-center"><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            echo '<td class="text-center"><a href="edit_member.php?id='.$data['ID'].'"><i class="fas fa-edit"></i></a> <a href="delete_member.php?id=' . $data['ID'] . '"><i class="fas fa-trash-alt"></i></a></td>';
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