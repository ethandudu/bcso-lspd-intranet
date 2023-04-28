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

    <title>Dispatch - LSPD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
                    <h1 class="h3 mb-2 text-gray-800">Dispatch</h1>
                    <br>
                    

                    <!-- DataTales Example -->
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Unités</h6>
                                </div>
                                <div class="card-body">
                                <button type="button" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#addModal"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Ajouter une unité</span></button><br>
                                <button type="button" class="btn btn-warning btn-icon-split" data-toggle="modal" data-target="#editModal"><span class="icon text-white-50"><i class="fas fa-pen-to-square"></i></span><span class="text">Modifier une unité</span></button><br>
                                <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#deleteModal"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Supprimer une unité</span></button><br>
                                <br><br>
                                    Liste des unités :
                                    <br>
                                    <ul>
                                    <?php
                                    $req = $bdd->prepare('SELECT * FROM dispatch_units_lspd ORDER BY name ASC');
                                    $req->execute();
                                    while($donnees = $req->fetch()) {
                                        echo '<li>'.$donnees['name'].'</li>';
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <iframe src="dispatch_frame.php" width="100%" height="700px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Modal-->
                    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Ajouter une unité</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <label for="label">Nom de l'unité</label>
                                    <input type="text" class="form-control" id="label" name="label" placeholder="Nom de l'unité" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-success" onclick="uniteadd()">Ajouter</button>
                                    <script>
                                        function uniteadd(){
                                            var label = document.getElementById("label").value;
                                            var type = "add";

                                            $.ajax({
                                                type: "POST",
                                                url: "functions/dispatchfunction.php",
                                                dataType: "html",
                                                data: {type: type, label: label},
                                                success: function(data){
                                                    if(data == "success"){
                                                        alert("Unité ajoutée avec succès");
                                                        location.reload();
                                                    }else{
                                                        alert("Erreur lors de l'ajout de l'unité");
                                                    }
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Modifier une unité</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <label for="label2">Unité à modifier</label>
                                    <select class="form-control" id="label2" name="label2" onchange="unitload()">
                                        <option value="0">Aucune unité sélectionnée</option>
                                        <?php
                                            $requnit = $bdd->prepare("SELECT ID, name FROM dispatch_units_lspd ORDER BY name ASC");
                                            $requnit->execute();
                                            while($unit = $requnit->fetch()){
                                                echo '<option value="'.$unit['ID'].'">'.$unit['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <label for="label">Nouveau nom de l'unité</label>
                                    <input type="text" class="form-control" id="label3" name="label3" placeholder="Nouveau nom de l'unité" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-warning" onclick="uniteedit()">Modifier</button>
                                    <script>
                                        function uniteedit(){
                                            var label = document.getElementById("label3").value;
                                            var id = document.getElementById("label2").value;
                                            var type = "edit";

                                            $.ajax({
                                                type: "POST",
                                                url: "functions/dispatchfunction.php",
                                                dataType: "html",
                                                data: {type: type, label: label, id: id},
                                                success: function(data){
                                                    if(data == "success"){
                                                        alert("Unité modifiée avec succès");
                                                        location.reload();
                                                    }else{
                                                        alert("Erreur lors de la modification de l'unité");
                                                    }
                                                }
                                            });
                                        }

                                        function unitload(){
                                            var id = document.getElementById("label2").value;
                                            var type = "load";

                                            $.ajax({
                                                type: "POST",
                                                url: "functions/dispatchfunction.php",
                                                dataType: "html",
                                                data: {type: type, id: id},
                                                success: function(data){
                                                    var unt = JSON.parse(data);
                                                    document.getElementById("label3").value = unt[0].name;
                                                            
                                                }
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Supprimer une unité</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <label for="label4">Nom de l'unité</label>
                                    <select class="form-control" id="label4" name="label4">
                                        <option value="0">Sélectionner une unité</option>
                                    <?php
                                        $requnit = $bdd->prepare("SELECT ID, name FROM dispatch_units_lspd ORDER BY name ASC");
                                        $requnit->execute();
                                            while($unit = $requnit->fetch()){
                                            echo '<option value="'.$unit['ID'].'">'.$unit['name'].'</option>';
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="button" class="btn btn-danger" onclick="unitdelete()">Supprimer</button>
                                    <script>
                                        function unitdelete(){
                                            var id = document.getElementById("label4").value;
                                            var type = "delete";
                                            $.ajax({
                                                type: "POST",
                                                url: "functions/dispatchfunction.php",
                                                dataType: "html",
                                                data: {type: type, id: id},
                                                success: function(data){
                                                    if(data == "success"){
                                                        alert("Unité supprimée avec succès");
                                                        location.reload();
                                                    }else{
                                                        alert("Erreur lors de la suppression de l'unite");
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
</body>

</html>