<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

if (isset($_POST['submitsettings'])) {
    //get the value of the checkbox recrutement
    if (isset($_POST['recrutement'])) {
        $recrutement = 1;
    } else {
        $recrutement = 0;
    }
    $req = $bdd->prepare('UPDATE settings SET recrutement_lspd = ?, freq_lspd = ?, freq_lspd_op = ?, freq_ems = ?, freq_harmony = ?, defcon_lspd = ?');
    $req->execute(array($recrutement, $_POST['freq_lspd'], $_POST['freq_lspd_op'], $_POST['freq_ems'], $_POST['freq_harmony'], $_POST['defcon_lspd']));
}

if (isset($_POST['submitannonce'])) {
    $annoncetitle = $_POST['title'];
    $annoncecontent = $_POST['editor'];
    $reqlistmember = $bdd->prepare('SELECT ID FROM members_lspd');
    $reqlistmember->execute();
    $listmember = $reqlistmember->fetchAll();
    foreach ($listmember as $member) {
        $req = $bdd->prepare('INSERT INTO messages_lspd (type, sender, receiver, title, text, datetime) VALUES (?, ?, ?, ?, ?, ?)');
        $req->execute(array('annonce', $_COOKIE['id'], $member['ID'], $annoncetitle, $annoncecontent, date("Y-m-d H:i:s")));
    }
}

$req2 = $bdd->prepare('SELECT * FROM settings');
$req2->execute();
$settings = $req2->fetch();


?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Paramètres - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Paramètres</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Modification des paramètres</h6>
                        </div>
                        <!-- show the settings with switch -->
                        <div class="card-body">
                            <h1>Recrutement</h1>
                            <form method="post">
                                <div class="custom-control custom-switch">
                                <?php if($settings['recrutement_lspd'] == 1) {
                                    echo '<input type="checkbox" class="custom-control-input" id="recrutement" name="recrutement" checked>';
                                } else {
                                    echo '<input type="checkbox" class="custom-control-input" id="recrutement" name="recrutement">';} ?>
                                    <label class="custom-control-label" for="recrutement">Activer</label>
                                </div>
                                <h1>Fréquences</h1>
                                <div class="form-group">
                                    <label for="freq_lspd">LSPD</label>
                                    <input type="text" class="form-control" name="freq_lspd" placeholder="Fréquence" value=<?php echo $settings['freq_lspd']; ?>>
                                    <label for="freq_lspd">LSPD OP</label>
                                    <input type="text" class="form-control" name="freq_lspd_op" placeholder="Fréquence" value=<?php echo $settings['freq_lspd_op']; ?>>
                                    <label for="freq_ems">EMS</label>
                                    <input type="text" class="form-control" name="freq_ems" placeholder="Fréquence" value=<?php echo $settings['freq_ems']; ?>>
                                    <label for="freq_harmony">Harmony</label>
                                    <input type="text" class="form-control" name="freq_harmony" placeholder="Fréquence" value=<?php echo $settings['freq_harmony']; ?>>
                                </div>

                                <h1>Defcon</h1>
                                <div class="form-group">
                                    <label for="defcon_lspd">Defcon LSPD</label>
                                    <select class="form-control" name="defcon_lspd">
                                        <option value="1" <?php if($settings['defcon_lspd'] == 1) { echo 'selected'; } ?>>1</option>
                                        <option value="2" <?php if($settings['defcon_lspd'] == 2) { echo 'selected'; } ?>>2</option>
                                        <option value="3" <?php if($settings['defcon_lspd'] == 3) { echo 'selected'; } ?>>3</option>
                                        <option value="4" <?php if($settings['defcon_lspd'] == 4) { echo 'selected'; } ?>>4</option>
                                        <option value="5" <?php if($settings['defcon_lspd'] == 5) { echo 'selected'; } ?>>5</option>
                                    </select>
                                </div>
                                <br>
                                <input type="submit" class="btn btn-success" name="submitsettings" value="Sauvegarder">
                            </form>
                        </div>  
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Annonce</h6>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <label for="title">Titre</label>
                                <input type="text" class="form-control" name="title" required>
                                <label for="content">Contenu</label>
                                <textarea class="form-control" id="summernote" name="editor"></textarea>
                                <br>
                                <input type="submit" class="btn btn-success" name="submitannonce" value="Envoyer">
                            </form>
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
        $(document).ready(function() {
        $('#summernote').summernote();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>

</html>