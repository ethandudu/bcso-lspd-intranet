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

    <title>Notifications - BCSO</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Notifications</h1>
                    <p class="mb-4">Vos notifications</p>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <input type="button" class="btn btn-success" value="Marquer toutes les notifications comme lues" onclick="markallasread()">
                            <input type="button" class="btn btn-danger" value="Supprimer toutes les notifications" onclick="deleteall()">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Emetteur</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT ID, type, sender, text, datetime, markasread, civilid FROM notifications_bcso WHERE receiver = ? ORDER BY datetime DESC');
                                        $req->execute(array($_COOKIE['id']));
                                        while ($data = $req->fetch()) {
                                            if ($data['type'] == 'civil'){
                                                $data['type'] = 'Civil';
                                                $font = 'text-success';
                                                $url = 'details_civils.php?id='.$data['civilid'];
                                                
                                            } else if ($data['type'] == 'casier'){
                                                $data['type'] = 'Casier';
                                                $font = 'text-warning';
                                                $url = 'edit_casiers.php?id='.$data['civilid'];
                                            } else if ($data['type'] == 'member'){
                                                $data['type'] = 'Agent';
                                                $font = 'text-primary';
                                                $url = 'edit_member.php?id='.$data['civilid'];
                                            } else if ($data['type'] == 'wanted'){
                                                $data['type'] = 'Wanted';
                                                $font = 'text-info';
                                                $url = 'details_wanted.php?id='.$data['civilid'];
                                            }
                                            if ($data['markasread'] == 0){
                                                echo '<tr class="font-weight-bold">';
                                            }
                                            echo '<td class='.$font.'>' . $data['type'].'</td>';
                                            $reqsender = $bdd->prepare('SELECT name, firstname FROM members_bcso WHERE ID = ?');
                                            $reqsender->execute(array($data['sender']));
                                            $datasender = $reqsender->fetch();
                                            echo '<td>' . $datasender['firstname'] . ' ' . $datasender['name'] . '</td>';
                                            echo '<td>' . $data['text'] . '</td>';
                                            echo '<td>' . date("d/m/Y H:i", strtotime($data['datetime'])) . '</td>';
                                            echo '<td><input type="button" class="btn btn-success" value="Voir" onclick="window.location.href=\''.$url.'\'"> <input type="button" class="btn btn-primary" value="Marquer comme lu" onclick="markasread('.$data['ID'].')"> <input type="button" class="btn btn-danger" value="Supprimer" onclick="deletenotif('.$data['ID'].')"></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                        <script>
                                            function deletenotif(id){
                                                $type = "delete";
                                                $.ajax({
                                                    url: 'functions/notifications.php',
                                                    type: 'POST',
                                                    data: {id: id, type: $type},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }

                                            function deleteall(){
                                                $id = <?php echo $_COOKIE['id']; ?>;
                                                $type = "deleteall";
                                                $.ajax({
                                                    url: 'functions/notifications.php',
                                                    type: 'POST',
                                                    data: {type: $type, id: $id},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }
                                            
                                            function markasread(id){
                                                $type = "markasread";
                                                $.ajax({
                                                    url: 'functions/notifications.php',
                                                    type: 'POST',
                                                    data: {id: id, type: $type},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }

                                            function markallasread(){
                                                $id = <?php echo $_COOKIE['id']; ?>;
                                                $type = "markallasread";
                                                $.ajax({
                                                    url: 'functions/notifications.php',
                                                    type: 'POST',
                                                    data: {type: $type, id: $id},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }
                                        </script>
                                        
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