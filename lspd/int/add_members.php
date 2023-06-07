<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

function generatepassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['submit'])) {

    $name = $_POST['inputName'];
    $firstname = $_POST['inputFirstname'];
    $tel = $_POST['inputPhone'];
    $username = $name.$firstname;
    $username = strtolower($username);
    //truncate spaces
    $username = preg_replace('/\s+/', '', $username);
    //truncate accents
    $username = str_replace(
        array('à', 'â', 'ä', 'á', 'ã', 'å', 'ª', 'À', 'Â', 'Ä', 'Á', 'Ã', 'Å'),
        array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A', 'A', 'A'),
        $username
    );
    $grade = $_POST['inputGrade'];
    $password = generatepassword();
    $passwordhashed = hash('sha256', $password);
    $matricule = $_POST['matricule'];

    
    if ($grade == "Commandant"){
        $gradevalue = 9;
    }elseif ($grade == "Capitaine"){
        $gradevalue = 8;
    }elseif ($grade == "Lieutenant"){
        $gradevalue = 7;
    }elseif ($grade == "Sergent-Chef"){
        $gradevalue = 6;
    }elseif ($grade == "Sergent"){
        $gradevalue = 5;
    }elseif ($grade == "Officier III"){
        $gradevalue = 4;
    }elseif ($grade == "Officier II"){
        $gradevalue = 3;
    }elseif ($grade == "Officier I"){
        $gradevalue = 2;
    }elseif ($grade == "Cadet"){
        $gradevalue = 1;
    }


    $req = $bdd->prepare('INSERT INTO members_lspd (matricule, name, firstname, tel, username, grade, gradevalue, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $req->execute(array($matricule, $name, $firstname, $tel, $username, $grade, $gradevalue, $passwordhashed));
    $memberid = $bdd->lastInsertId();

    $stat = "Identifiants pour le compte de " . $name . " " . $firstname . " : " . $username . " / " . $password . " / https://lspd.ethanduault.fr";

    $type = "member";
    $sender = $_COOKIE['id'];
    $receiver = 40;
    $text = "L'agent ". $matricule .' '.$name. " ".$firstname." a été créé";
    $datetime = date("Y-m-d H:i:s");

    $req = $bdd->prepare('INSERT INTO notifications_lspd (type, sender, receiver, text, datetime, civilid) VALUES(?, ?, ?, ?, ?, ?)');
    $req->execute(array($type, $sender, $receiver, $text, $datetime, $memberid));

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
                    <p class="mb-4">Ajouter un agent</p>                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Remplissez les champs ci-dessous</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="newcasier" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label for="matricule" class="col-sm-2 col-form-label">Matricule</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule" required>
                                    </div>
                                    <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nom" required>
                                    </div>
                                    <label for="inputFirstname" class="col-sm-2 col-form-label">Prénom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" placeholder="Prénom" required>
                                    </div>
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Téléphone" required>
                                    </div>
                                    
                                    <label for="inputGrade" class="col-sm-2 col-form-label">Grade</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputGrade" name="inputGrade" required>
                                            <option value="Commandant">Commandant</option>
                                            <option value="Capitaine">Capitaine</option>
                                            <option value="Lieutenant">Lieutenant</option>
                                            <option value="Sergent Chef">Sergent Chef</option>
                                            <option value="Sergent">Sergent</option>
                                            <option value="Officier III">Officier III</option>
                                            <option value="Officier II">Officier II</option>
                                            <option value="Officier I">Officier I</option>
                                            <option value="Cadet" selected>Cadet</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="submit">Ajouter</button>
                                <!-- show the $stat variable in green if set -->
                                <?php
                                    if(isset($stat)) {
                                        echo '<div class="alert alert-success" role="alert">'.$stat.' <button type="button" class="btn btn-primary" onclick="copyToClipboard(\''.$stat.'\')">Copier</button></div>';
                                    }
                                ?>
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
        function copyToClipboard(text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);

            alert("Copié !");
        }
    </script>
</body>

</html>