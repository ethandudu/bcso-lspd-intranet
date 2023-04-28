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

    <title>Plaintes - LSPD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Plaintes</h1>
                    <p class="mb-4">Toutes les plaintes enregistrées</p>
                    <p><label>Rechercher:
                            <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable" onkeyup="myFunction()">
                        </label></p>
                    <br>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal" value="Ajouter une plainte">
                        </div>
                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addModalLabel">Ajouter une plainte</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="req">Nom du requérant</label>
                                        <input type="text" class="form-control" id="req" name="req" placeholder="Nom Prénom" required>
                                        <label for="acc">Nom de l'accusé</label>
                                        <input type="text" class="form-control" id="acc" name="acc" placeholder="Nom Prénom" required>
                                        <label for="subject">Sujet</label>
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" required maxlength=255>
                                        <label for="datetime">Date et heure</label>
                                        <input type="datetime-local" class="form-control" id="datetime" name="datetime" required>
                                        <label for="officier">Officier</label>
                                        <select class="form-control" id="officier" name="officier" required>
                                            <?php
                                                $req = $bdd->prepare("SELECT ID, name, firstname FROM members_lspd ORDER BY name ASC");
                                                $req->execute();
                                                while($data = $req->fetch()){
                                                echo '<option value="'.$data['ID'].'">'.$data['name'].' '.$data['firstname'].'</option>';
                                                }
                                            ?>
                                        </select>
                                        <label for="summernote">Plainte</label>
                                        <textarea id="summernote" name="editor"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-success" onclick="plainteadd()">Ajouter</button>
                                        <script>
                                            function plainteadd(){
                                                var req = document.getElementById("req").value;
                                                var acc = document.getElementById("acc").value;
                                                var subject = document.getElementById("subject").value;
                                                var datetime = document.getElementById("datetime").value;
                                                var officier = document.getElementById("officier").value;
                                                var plainte = $('#summernote').summernote('code');
                                                var type = "add";

                                                $.ajax({
                                                    type: "POST",
                                                    url: "functions/complaintsfunction.php",
                                                    dataType: "html",
                                                    data: {type: type, req: req, acc: acc, subject: subject, datetime: datetime, officier: officier, plainte: plainte},
                                                    success: function(data){
                                                    if(data == "success"){
                                                        alert("Plainte ajoutée avec succès");
                                                        location.reload();
                                                    }else{
                                                        alert("Erreur lors de l'ajout de la plainte");
                                                        }
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Requérant</th>
                                            <th>Accusé</th>
                                            <th>Sujet</th>
                                            <th>Responsable</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Requérant</th>
                                            <th>Accusé</th>
                                            <th>Sujet</th>
                                            <th>Responsable</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM complaints_lspd ORDER BY ID DESC');
                                        $req->execute();
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            echo '<td>' . $data['req'] . '</td>';
                                            echo '<td>' . $data['violator'] . '</td>';
                                            echo '<td>'.$data['subject']. '</td>';
                                            $data2 = $bdd->prepare('SELECT name, firstname FROM members_lspd WHERE ID = ?');
                                            $data2->execute(array($data['officier']));
                                            $data2 = $data2->fetch();
                                            $officier = $data2['firstname']. ' ' . $data2['name'];
                                            echo '<td>' . $officier . '</td>';
                                            $date = date_create($data['datetime']);
                                            echo '<td>' . date_format($date, 'd/m/Y') . '</td>';
                                            echo '<td><a href="#" data-toggle="modal" data-target="#viewModal" data-id="'.$data['ID'].'"><i class="fas fa-eye"></i></a> <a href="edit_enquete.php?id=' . $data['ID'] . '"><i class="fas fa-edit"></i></a> <a href="delete_enquete.php?id=' . $data['ID'] . '"><i class="fas fa-trash-alt"></i></a></td>';
                                        }
                                        ?>
                                        
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ViewModalLabel">Détails de la plainte</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <label for="req">Nom du requérant</label>
                                    <input type="text" class="form-control" id="req" name="req" placeholder="Nom Prénom" disabled>
                                    <label for="acc">Nom de l'accusé</label>
                                    <input type="text" class="form-control" id="acc" name="acc" placeholder="Nom Prénom" disabled>
                                    <label for="subject">Sujet</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" disabled>
                                    <label for="datetime">Date et heure</label>
                                    <input type="datetime-local" class="form-control" id="datetime" name="datetime" disabled>
                                    <label for="officier">Officier</label>
                                    <select class="form-control" id="officier" name="officier" disabled>
                                        
                                    </select>
                                    <label for="summernote">Plainte</label>
                                    <textarea id="summernote2" name="editor" disabled></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#summernote2').summernote();
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>

</html>