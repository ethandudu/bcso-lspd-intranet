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

    <title>Messages - BCSO</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Messages</h1>
                    <p class="mb-4">Vos messages</p>
                    

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <input type="button" class="btn btn-success" value="Marquer tous les messages comme lus" onclick="markallasread()">
                            <input type="button" class="btn btn-danger" value="Supprimer tous les messages" onclick="deleteall()">
                            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#writeModal"><span class="icon text-white-50"><i class="fas fa-pen-nib"></i></span><span class="text">Ecrire un message</span></button>
                        </div>
                        <div class="modal fade" id="writeModal" tabindex="-1" role="dialog" aria-labelledby="writeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="writeModalLabel">Ecrire un message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#destModal"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Sélectionner un destinataire</span></button>
                                        <br>
                                        <label for="title">Sujet</label>
                                        <input type="text" class="form-control" id="title" placeholder="Sujet" required autocomplete="off">
                                        <label for="editor">Message</label>
                                        <textarea id="editor" name="editor" class="form-control" placeholder="Message"></textarea>
                                        <input type="hidden" id="officier_lspd" name="officier_lspd">
                                        <input type="hidden" id="officier_bcso" name="officier_bcso">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="button" class="btn btn-success" onclick="messagesend()">Envoyer</button>
                                        <input type="hidden" id="officier_lspd" name="officier_lspd">
                                        <input type="hidden" id="officier_bcso" name="officier_bcso">
                                        <script>
                                            function messagesend(){
                                                if (document.getElementById("officier_lspd").value == "" && document.getElementById("officier_bcso").value == ""){
                                                    alert("Veuillez sélectionner au moins un destinataire");
                                                    return;
                                                }
                                                var title = document.getElementById("title").value;
                                                var content = document.getElementById("editor").value;
                                                // get the json from the other modal
                                                var bcso = officierselect("bcso");
                                                var lspd = officierselect("lspd");
                                                console.log(bcso);
                                                console.log(lspd);

                                                var ID = <?php echo $_COOKIE['id']; ?>;
                                                var type = "send";
                                                    $.ajax({
                                                    type: "POST",
                                                    url: "functions/messages.php",
                                                    dataType: "html",
                                                    data: {type: type, title: title, content: content, bcso: bcso, lspd: lspd, ID: ID},
                                                    success: function(data){
                                                        if(data == "success"){
                                                            alert("Message envoyé avec succès");
                                                            location.reload();
                                                        }else{
                                                            alert(data);
                                                        }
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="destModal" tabindex="-1" role="dialog" aria-labelledby="destModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="destModalLabel">Destinataires</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <h6 class="m-0 font-weight-bold text-primary">LSPD</h6>
                                                <?php
                                                    $req2 = $bdd->query('SELECT ID, name, firstname, matricule FROM members_lspd ORDER by matricule ASC');
                                                    $req2->execute();
                                                    while ($member = $req2->fetch()){
                                                        echo('<div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="lspd-'.$member['ID'].'" name="'.$member['ID'].'">
                                                        <label class="custom-control-label" for="lspd-'.$member['ID'].'">'.$member['matricule']. ' - '.$member['firstname'].' '.$member['name'].'</label>
                                                        </div>');
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <h6 class="m-0 font-weight-bold text-primary">BCSO</h6>
                                                <?php
                                                    $req2 = $bdd->query('SELECT ID, name, firstname FROM members_bcso ORDER by name ASC');
                                                    $req2->execute();
                                                    while ($member = $req2->fetch()){
                                                        echo('<div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="bcso-'.$member['ID'].'" name="'.$member['ID'].'">
                                                        <label class="custom-control-label" for="bcso-'.$member['ID'].'">'.$member['firstname'].' '.$member['name'].'</label>
                                                        </div>');
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="closemodal()">Ajouter</button>
                                        <script>
                                            function closemodal(){
                                                document.getElementById("officier_lspd").value = officierselect("lspd");
                                                document.getElementById("officier_bcso").value = officierselect("bcso");
                                                $('#destModal').modal('hide');
                                            }
                                            function officierselect(type){
                                                if (type == "lspd"){
                                                    var officier_lspd = [];
                                                    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
                                                    for (var i = 0; i < checkboxes.length; i++) {
                                                        if(checkboxes[i].id.includes("lspd")){
                                                            officier_lspd.push(checkboxes[i].name);
                                                        }
                                                    }
                                                    //if an array is empty, we put a 0 in it
                                                    if(officier_lspd.length == 0){
                                                        officier_lspd.push(0);
                                                    }
                                                    return JSON.stringify(officier_lspd);
                                                } else {
                                                    var officier_bcso = [];
                                                    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
                                                    for (var i = 0; i < checkboxes.length; i++) {
                                                        if(checkboxes[i].id.includes("bcso")){
                                                            officier_bcso.push(checkboxes[i].name);
                                                        }
                                                    }
                                                    //if an array is empty, we put a 0 in it
                                                    if(officier_bcso.length == 0){
                                                        officier_bcso.push(0);
                                                    }
                                                    return JSON.stringify(officier_bcso);
                                                }
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
                                            <th>Expéditeur</th>
                                            <th>Titre</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- get infos from database -->
                                        <?php
                                        $req = $bdd->prepare('SELECT * FROM messages_bcso WHERE receiver = ? ORDER BY datetime DESC');
                                        $req->execute(array($_COOKIE['id']));
                                        while($data = $req->fetch()){
                                            if ($data['sender_type'] == "LSPD"){
                                                $req2 = $bdd->prepare('SELECT ID, name, firstname, matricule, grade FROM members_lspd WHERE ID = ?');
                                                $req2->execute(array($data['sender']));
                                                $data2 = $req2->fetch();
                                            }elseif ($data['sender_type'] == "BCSO"){
                                                $req2 = $bdd->prepare('SELECT ID, name, firstname, grade FROM members_bcso WHERE ID = ?');
                                                $req2->execute(array($data['sender']));
                                                $data2 = $req2->fetch();
                                            }
                                            if($data['markasread'] == 0){
                                                $read = "<span class='badge badge-danger'>Non lu</span>";
                                            } else {
                                                $read = "<span class='badge badge-success'>Lu</span>";
                                            }
                                            echo "<tr>";
                                            echo "<td>".$data2['grade']." - "; if ($data['sender_type'] == "LSPD"){echo $data2['matricule']. " - ";} echo"". $data2['name'] . " ". $data2['firstname']."</td>";
                                            echo "<td>" . $data['title'] . "</td>";
                                            echo "<td>" . $data['text'] . "</td>";
                                            echo "<td>" . date("d/m/Y H:i", strtotime($data['datetime'])) . "</td>";
                                            echo "<td>" . $read . " <a href='javascript:deletemessage(" . $data['ID'] . ")'><i class='fas fa-trash'></i></a> <a href='javascript:markasread(" . $data['ID'] . ")'><i class='fas fa-check'></i></a> <a href='javascript:reply(" . $data['ID'] . ")'><i class='fas fa-reply'></i></a></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                        <script>
                                            function deletemessage(id){
                                                $type = "delete";
                                                $.ajax({
                                                    url: 'functions/messages.php',
                                                    type: 'POST',
                                                    data: {ID: id, type: $type},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }

                                            function deleteall(){
                                                $id = <?php echo $_COOKIE['id']; ?>;
                                                $type = "deleteall";
                                                $.ajax({
                                                    url: 'functions/messages.php',
                                                    type: 'POST',
                                                    data: {type: $type, ID: $id},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }
                                            
                                            function markasread(id){
                                                $type = "markasread";
                                                $.ajax({
                                                    url: 'functions/messages.php',
                                                    type: 'POST',
                                                    data: {ID: id, type: $type},
                                                    success: function(data){
                                                        if(data == "success"){
                                                            location.reload();
                                                        }else{
                                                            alert(data);
                                                        }
                                                    }
                                                });
                                            }

                                            function markallasread(){
                                                $id = <?php echo $_COOKIE['id']; ?>;
                                                $type = "markallasread";
                                                $.ajax({
                                                    url: 'functions/messages.php',
                                                    type: 'POST',
                                                    data: {type: $type, ID: $id},
                                                    success: function(data){
                                                        location.reload();
                                                    }
                                                });
                                            }

                                            function reply(messageid){
                                                // open the send modal and fill the subject and the receiver
                                                $('#writeModal').modal('show');
                                                $type = "reply";
                                                $.ajax({
                                                    url: 'functions/messages.php',
                                                    type: 'POST',
                                                    data: {ID: messageid, type: $type},
                                                    success: function(data){
                                                        var obj = JSON.parse(data);
                                                        document.getElementById("title").value = "RE: " + obj.title;
                                                        $('#writeModal').modal('show');
                                                        if (obj.sendertype == "LSPD"){
                                                            //check the checkbox
                                                            $checkboxid = "lspd-" + obj.sender;
                                                            document.getElementById($checkboxid).checked = true;
                                                            document.getElementById("officier_lspd").value = officierselect("lspd");
                                                        }else if (obj.sendertype == "BCSO"){
                                                            //check the checkbox
                                                            $checkboxid = "bcso-" + obj.sender;
                                                            document.getElementById($checkboxid).checked = true;
                                                            document.getElementById("officier_lspd").value = officierselect("bcso");
                                                        }
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