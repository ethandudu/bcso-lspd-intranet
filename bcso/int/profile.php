<?php
session_start();
include('../config.php');

include('functions/loginverif.php');

# save note textarea to database
if (isset($_POST['submit']) && $_POST['submit'] == 'Modifier') {
    if ($_POST['newpassword'] == $_POST['newpassword2']){
        $req = $bdd->prepare("SELECT count(ID) FROM members_lspd WHERE ID = ? AND password = ?");
        $req->execute(array($_COOKIE['id'], hash('sha256', $_POST['oldpassword'])));
        $result = $req->fetch();

        if ($result[0] == 1) {
            $req = $bdd->prepare("UPDATE members_lspd SET password = ? WHERE ID = ?");
            $req->execute(array(hash('sha256', $_POST['newpassword']), $_COOKIE['id']));
            $messagepass = 1;
        } else {
            $messagepass = 2;
        }
    } else {
        $messagepass = 3;
    }
}

if (isset($_POST['submittel'])){
    $req = $bdd->prepare("UPDATE members_lspd SET tel = ? WHERE ID = ?");
    $req->execute(array($_POST['tel'], $_COOKIE['id']));
    $messagetel = 1;
}
$data = $bdd->prepare("SELECT * FROM members_lspd WHERE ID = ?");
$data->execute(array($_COOKIE['id']));
$member = $data->fetch();
$vehicle = $bdd->prepare("SELECT * FROM vehicles_lspd WHERE owner = ?");
$vehicle->execute(array($_COOKIE['id']));
$vehicle = $vehicle->fetch();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profil - LSPD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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

            <!-- Divider -->
            

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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Profil</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Mes informations</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="name">Nom</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']?>" disabled>
                                            <label for="firstname">Prénom</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $member['firstname']?>" disabled>
                                            <label for="grade">Grade</label>
                                            <input type="text" class="form-control" id="grade" name="grade" value="<?php echo $member['grade']?>" disabled>
                                            <label for="division">Division</label>
                                            <input type="text" class="form-control" id="division1" name="division1" value="<?php echo $member['division']?>" disabled>
                                            <label for="tel">Téléphone</label>
                                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="(555) 123-4567" value="<?php echo $member['tel']?>"required>
                                                <br>
                                            <input type="submit" class="btn btn-success" name="submittel" value="Enregistrer">
                                            <?php if (isset($messagetel) && $messagetel == 1) {
                                                echo "<br><br><div class='alert alert-success' role='alert'>Le numéro de téléphone a bien été modifié !</div>";
                                            }?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Modifier le mot de passe</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="oldpassword">Ancien mot de passe</label>
                                            <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                                                placeholder="Ancien mot de passe">
                                            <label for="newpassword">Nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword"
                                                placeholder="Nouveau mot de passe">
                                            <label for="newpassword2">Confirmer le nouveau mot de passe</label>
                                            <input type="password" class="form-control" id="newpassword2" name="newpassword2"
                                                placeholder="Confirmer le nouveau mot de passe">
                                                <br>
                                            <input type="submit" class="btn btn-success" name="submit" value="Modifier">
                                            <?php 
                                            if (isset($messagepass) && ($messagepass == 1)) {
                                                echo "<br><br><div class='alert alert-success' role='alert'>Le mot de passe a bien été modifié !</div>";
                                            } elseif (isset($messagepass) && ($messagepass == 2)) {
                                                echo "<br><br><div class='alert alert-danger' role='alert'>L'ancien mot de passe est incorrect !</div>";
                                            }
                                            elseif (isset($messagepass) && ($messagepass == 3)) {
                                                echo "<br><br><div class='alert alert-danger' role='alert'>Les mots de passe ne correspondent pas !</div>";
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="col col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Véhicule attribué</h6>
                                </div>
                                <div class="card-body">
                                    <label for="newpassword">Nom du véhicule</label>
                                    <input type="vehicle" class="form-control" id="vehicle" name="vehicle" placeholder="Aucun véhicule attribué" value="<?php echo $vehicle['label'] ?>" disabled>
                                    <label for="plate">Plaque d'immatriculation</label>
                                    <input type="plate" class="form-control" id="plate" name="plate" placeholder="Aucun véhicule attribué" value="<?php echo $vehicle['plate'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Formations</h6>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>PPA</th>
                                            <th>Stage conduite sécurité</th>
                                            <th>Négociateur</th>
                                            <th>Dispatcheur</th>
                                            <th>Recruteur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT ppa, conduite, negociateur, dispatcheur, recruteur FROM members_lspd WHERE ID = ?');
                                        $req->execute(array($_COOKIE['id']));
                                        while ($data = $req->fetch()) {
                                            echo '<tr>';
                                            if ($data['ppa'] == 1) {
                                                echo '<td><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['conduite'] == 1) {
                                                echo '<td><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['negociateur'] == 1) {
                                                echo '<td><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['dispatcheur'] == 1) {
                                                echo '<td><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            if ($data['recruteur'] == 1) {
                                                echo '<td><i class="fas fa-check" style="color: green;"></i></td>';
                                            } else {
                                                echo '<td><i class="fas fa-times" style="color: red;"></i></td>';
                                            }
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    

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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


    <script src="https://kit.fontawesome.com/bf7b7dc291.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
        $('#summernote').summernote();
        });
    </script>
</body>

</html>