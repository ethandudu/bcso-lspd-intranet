<?php
session_start();
include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('functions/loginverif.php');

if (isset($_POST['submit'])) {
    $civilid = $_POST['inputName'];
    if ($civilid != 0) {
    $crime = $_POST['crime'];
    $sanction = $_POST['sanction'];
    $date = $_POST['date'];
    # convert it to mariadb datetime format
    $date2 = date('Y-m-d H:i:s', strtotime($date));
    $officier = $_POST['officier'];
    $note = $_POST['note'];
    $saisie = $_POST['saisie'];
    $officiers_presents = $_POST['officiers_presents'];

    $req = $bdd->prepare('INSERT INTO casiers_lspd (civilid, crime, sanction, datetime, officier, note, saisie, officiers_presents) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $req->execute(array($civilid, $crime, $sanction, $date2, $officier, $note, $saisie, $officiers_presents));
    $casierid = $bdd->lastInsertId();

    $req = $bdd->prepare('SELECT name, firstname FROM civils_lspd WHERE ID = ?');
    $req->execute(array($civilid));
    $result = $req->fetch();

    $type = "casier";
    $sender = $_COOKIE['id'];
    $receiver = 40;
    $text = 'Un nouveau casier a été créé pour '. $result['name']. " ".$result['firstname'];
    $datetime = date("Y-m-d H:i:s");

    $req = $bdd->prepare('INSERT INTO notifications_lspd (type, sender, receiver, text, datetime, civilid) VALUES (?, ?, ?, ?, ?, ?)');
    $req->execute(array($type, $sender, $receiver, $text, $datetime, $casierid));

    header("Location: casiers.php");
    //header("Location: functions/notifs/casiers_notif.php?name=$result[name]&firstname=$result[firstname]&reason=$crime&sanction=$sanction&date=$date");
    }else{
        header("Location: add_casiers.php?error=1");
    }
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

    <title>Casiers - LSPD</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Casiers judiciaires</h1>
                    <p class="mb-4">Ajouter un casier</p>                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p>Remplissez les champs ci-dessous</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="newcasier" autocomplete="off">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="inputName" name="inputName" required>
                                            
                                        </select>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#searchModal">Rechercher</button>
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <button type="button" class="btn btn-success" onclick="civilselect()">Sélectionner</button>
                                                        <script>
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
                                                                //close the modal
                                                                $('#searchModal').modal('hide');
                                                            }
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="crime" class="col-sm-2 col-form-label">Infraction</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="crime" name="crime" placeholder="Infraction" required>
                                    </div>
                                    <label for="sanction" class="col-sm-2 col-form-label">Amende & sanction</label>    
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sanction" name="sanction" placeholder="Sanction" required>
                                    </div>
                                    <label for="saisie" class="col-sm-2 col-form-label">Saisie</label>    
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="saisie" name="saisie" placeholder="Saisie" required>
                                    </div>
                                    <label for="date" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                                    </div>
                                    <label for="officier" class="col-sm-2 col-form-label">Officier</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="officier" id="officier" required>
                                            <?php
                                                $req2 = $bdd->query('SELECT ID, name, firstname FROM members_lspd WHERE ID = '.$_COOKIE['id'].'');
                                                while($data = $req2->fetch()){
                                                    echo('<option value="'.$_COOKIE['id'].'">'.$data['firstname'].' '.$data['name'].'</option>');
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <label for="officier_present" class="col-sm-2 col-form-label">Officier(s) présent(s)</label>
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#officierModal">Ajouter</button>
                                        <div class="modal fade" id="officierModal" tabindex="-1" role="dialog" aria-labelledby="officierModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="officierModalLabel">Ajouter un officier présent</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        // show one checkbox for each member of the LSPD
                                                        $req2 = $bdd->query('SELECT ID, name, firstname, matricule FROM members_lspd ORDER by matricule ASC');
                                                        $req2->execute();
                                                        while ($member = $req2->fetch()){
                                                            echo('<div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="'.$member['ID'].'" name="'.$member['ID'].'">
                                                            <label class="custom-control-label" for="'.$member['ID'].'">'.$member['matricule']. ' - '.$member['firstname'].' '.$member['name'].'</label>
                                                            </div>');
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" onclick="officierselect()">Ajouter</button>
                                                        <script>
                                                            function officierselect(){
                                                                // get the id of each checkbox checked and send it into an json array
                                                                var officier = [];
                                                                var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
                                                                for (var i = 0; i < checkboxes.length; i++) {
                                                                    officier.push(checkboxes[i].id);
                                                                }
                                                                // send the json array into a hidden input
                                                                document.getElementById("officiers_presents").value = JSON.stringify(officier);
                                                                // close the modal
                                                                $('#officierModal').modal('hide');
                                                            }
                                                        </script>
                                                        <input type="hidden" id="officiers_presents" name="officiers_presents">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for="note" class="col-sm-2 col-form-label">Note</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="note" name="note" placeholder="Note">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="submit">Ajouter</button>
                            </form>
                            <?php
                            if (isset ($_GET['error']) AND $_GET['error'] == 1){
                                echo('<div class="alert alert-danger" role="alert">Aucun civil sélectionné</div>');
                            }
                            ?>
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