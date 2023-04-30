<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

$id = $_GET['id'];
$req2 = $bdd->prepare('SELECT * FROM casiers_bcso WHERE ID = ?');
$req2->execute(array($_GET['id']));
$req2 = $req2->fetch();

$req3 = $bdd->prepare('SELECT * FROM civils_bcso WHERE ID = ?');
$req3->execute(array($req2['civilid']));
$req3 = $req3->fetch();

$namefirstname = $req3['name'] . ' ' . $req3['firstname'];

if (isset($_POST['delete-confirmation'])) {
    
    $title = "📁 Casier supprimé";
    $color = "f4b619";
    // Log vers Discord Privé
    $webhookurl = "https://discordapp.com/api/webhooks/1082985752108994561/Il4YcsSn7WdRDeROlEFuo_t_fXc15Chno4NeMII0kO7nePwjp5weQa5uOLUYiwD2hvAs";

    $timestamp = date("c", strtotime("now"));

    $json_data = json_encode([

        "content" => "",

    // Embeds Array
        "embeds" => [
            [
                "title" => $title,

                "type" => "rich",

                "description" => "",

                "fields" => [
                    [
                        "name" => "Nom Prénom",
                        "value" => $req3['name'] . " " . $req3['firstname'],
                        "inline" => false
                    ],
                    [
                        "name" => "Infraction",
                        "value" => $req2['crime'],
                        "inline" => false
                    ],
                    [
                        "name" => "Sanction",
                        "value" => $req2['sanction'],
                        "inline" => false
                    ],
                    [
                        "name" => "Date",
                        "value" => date("d/m/Y H:i", strtotime($req2['date'])),
                        "inline" => false
                    ],
                    [
                        "name" => "Officier",
                        "value" => $req2['officer'],
                        "inline" => false
                    ],
                    [
                        "name" => "Supprimé par",
                        "value" => $_COOKIE["firstname"] . " " . $_COOKIE["name"],
                        "inline" => false

                    ]
                ],

                "color" => hexdec($color),
            
                "footer" => [
                    "text" => "BCSO",
                    "icon_url" => "https://bcso.ethanduault.fr/assets/img/logo_bcso.png"
                ],

                "timestamp" => $timestamp,
            ],
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_close($ch);

    $req = $bdd->prepare('DELETE FROM casiers_bcso WHERE ID = ?');
    $req->execute(array($id));
    header("Location: casiers.php");
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

    <title>Casiers - BCSO</title>

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

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Confirmation</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Voulez-vous vraiment supprimer le casier de <?php echo $namefirstname ?> ?</h1>
                            </div>
                            <form class="user" method="post" name="delete-confirm">
                                <input type="submit" class="btn btn-danger btn-user btn-block" value="Supprimer" name="delete-confirmation">
                                <a href="casiers.php" class="btn btn-secondary btn-user btn-block" value="Annuler">Annuler</a>
                            </form>
                            <hr>
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
                        <span>Copyright &copy; BCSO - American Stories 2022</span><br>
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