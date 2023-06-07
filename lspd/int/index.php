<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../config.php');

include('functions/loginverif.php');


# save note textarea to database
if (isset($_POST['submit'])) {
    $note = ($_POST['editor']);
    $reqnote = $bdd->prepare("UPDATE members_lspd SET note = ? WHERE ID = ?");
    $reqnote->execute(array($note, $_COOKIE['id']));
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accueil - LSPD</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="css/calculator.css" rel="stylesheet">

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
                        <h1 class="h3 mb-0 text-gray-800">Accueil</h1>
                    </div>
                    <?php
                        if (isset($_GET['error']) AND $_GET['error'] == "permission") {
                            echo '<div class="alert alert-danger" role="alert">
                            Vous n\'avez pas les droits pour accéder à cette page.
                          </div>';
                        }
                    ?>
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Agents</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $reqagent = $bdd->prepare('SELECT COUNT(*) FROM members_lspd');
                                            $reqagent->execute();
                                            $agentnb=$reqagent->fetch();
                                            echo($agentnb[0]);
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Civils recensés</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $reqcivils = $bdd->prepare('SELECT COUNT(*) FROM civils_lspd');
                                            $reqcivils->execute();
                                            $civilsnb=$reqcivils->fetch();
                                            echo($civilsnb[0]);
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="civils.php"><i class="fas fa-book fa-2x text-gray-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Casiers</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                                                    $reqcasiers = $bdd->prepare('SELECT COUNT(*) FROM casiers_lspd');
                                                    $reqcasiers->execute();
                                                    $casiersnb=$reqcasiers->fetch();
                                                    echo($casiersnb[0]);
                                                    ?></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="casiers.php"><i class="fas fa-folder-open fa-2x text-gray-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Wanted
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                                                    $reqcasiers = $bdd->prepare('SELECT COUNT(*) FROM wanted_lspd');
                                                    $reqcasiers->execute();
                                                    $casiersnb=$reqcasiers->fetch();
                                                    echo($casiersnb[0]);
                                                    ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="wanted.php"><i class="fas fa-handcuffs fa-2x text-gray-300"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!-- Content Row -->

                    <div class="row">
                    
                        <!-- Area Chart -->
                        <div class="col-xl col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Actions rapides</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body align-items-center justify-content-between">
                                    <!-- add buttons here -->
                                    <a href="radio.php" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-walkie-talkie"></i>
                                        </span>
                                        <span class="text">Radios</span>
                                    </a>
                                    <a href="add_civils.php" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-book"></i>
                                        </span>
                                        <span class="text">Ajouter un civil</span>
                                    </a>
                                    <a href="add_casier.php" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-folder-open"></i>
                                        </span>
                                        <span class="text">Ajouter un casier</span>
                                    </a>
                                    <a href="add_wanted.php" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-handcuffs"></i>
                                        </span>
                                        <span class="text">Ajouter un wanted</span>
                                    </a>
                                    <br>
                                    <br>
                                    <a href="amendes.php" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </span>
                                        <span class="text">Amendes</span>
                                    </a>
                                    <a href="saisies.php" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        <span class="text">Casiers de saisie</span>
                                    </a>
                                    <button type="button" class="btn btn-dark btn-icon-split" data-toggle="modal" data-target="#calculatrice">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-calculator"></i>
                                        </span>
                                        <span class="text">Calculatrice</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal fade" id="calculatrice" tabindex="-1" role="dialog" aria-labelledby="calculatriceLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="calculatriceLabel">Calculatrice</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="calculator" >
                                                <tr>
                                                    <td colspan="3"><input class="display-box" type="text" id="result" disabled /></td>
                                                    <!-- clearScreen() function clears all the values -->
                                                    <td> <input class="btn-calc" type="button" value="C" onclick="clearScreen()" id="btn" /> </td>
                                                </tr>
                                                <tr>
                                                    <!-- display() function displays the value of clicked button -->
                                                    <td> <input class="btn-calc" type="button" value="1" onclick="display('1')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="2" onclick="display('2')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="3" onclick="display('3')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="/" onclick="display('/')" /> </td>
                                                    </tr>
                                                <tr>
                                                    <td> <input class="btn-calc" type="button" value="4" onclick="display('4')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="5" onclick="display('5')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="6" onclick="display('6')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="-" onclick="display('-')" /> </td>
                                                </tr>
                                                <tr>
                                                    <td> <input class="btn-calc" type="button" value="7" onclick="display('7')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="8" onclick="display('8')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="9" onclick="display('9')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="+" onclick="display('+')" /> </td>
                                                </tr>
                                                <tr>
                                                    <td> <input class="btn-calc" type="button" value="." onclick="display('.')" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="0" onclick="display('0')" /> </td>
                                                    <!-- calculate() function evaluates the mathematical expression -->
                                                    <td> <input class="btn-calc" type="button" value="=" onclick="calculate()" id="btn" /> </td>
                                                    <td> <input class="btn-calc" type="button" value="*" onclick="display('*')" /> </td>
                                                </tr>
                                            </table>
                                            <script type="text/javascript" src="js/calculator.js"></script>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-6 mb-4">
                                    <?php
                                        $req = $bdd->prepare('SELECT defcon_lspd FROM settings');
                                        $req->execute();
                                        $defcon=$req->fetch();

                                        if ($defcon['defcon_lspd'] == 5){
                                            $text = '<span class="badge badge-success">5</span>';
                                            $color = 'success';
                                            $pic = 'defcon-5.png';
                                        } elseif ($defcon['defcon_lspd'] == 4){
                                            $text = '<span class="badge badge-info">4</span>';
                                            $color = 'info';
                                            $pic = 'defcon-4.png';
                                        } elseif ($defcon['defcon_lspd'] == 3){
                                            $text = '<span class="badge badge-purple">3</span>';
                                            $color = 'purple';
                                            $pic = 'defcon-3.png';
                                        } elseif ($defcon['defcon_lspd'] == 2){
                                            $text = '<span class="badge badge-warning">2</span>';
                                            $color = 'warning';
                                            $pic = 'defcon-2.png';
                                        } elseif ($defcon['defcon_lspd'] == 1){
                                            $text = '<span class="badge badge-danger">1</span>';
                                            $color = 'danger';
                                            $pic = 'defcon-1.png';
                                        }
                                    ?>
                                    <div class="card border-left-<?php echo $color?> shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-<?php echo $color?> text-uppercase mb-1">Defcon LSPD</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php
                                                                echo '<br><img src="../assets/img/defcon/'.$pic.'" width="auto" height="160px">';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                            

                        <div class="col-xl col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <form method="post" name="savenote" >
                                    <!-- display text editor -->
                                        <textarea id="summernote" name="editor"><?php
                                        $req = $bdd->prepare('SELECT note FROM members_lspd WHERE ID = ?');
                                        $req->execute(array($_COOKIE['id']));
                                        $note = $req->fetch();
                                        echo(htmlspecialchars($note[0]));
                                        ?>
                                        </textarea>
                                    <input type="submit" name="submit" value="Enregistrer" class="btn btn-primary btn-success btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        
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