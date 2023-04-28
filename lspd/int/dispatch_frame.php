<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('../config.php');

$req = $bdd->prepare('SELECT ID, matricule, name, firstname, grade, division, dispatch_unit FROM members_lspd ORDER BY name ASC');
$req->execute();
$members = $req->fetchAll();

header("refresh: 120");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dispatch LSPD</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    body {
 	font-family:helvetica, arial;
	 font-size:12px
  }
.scrumboard{
	margin:0 auto;
	width:835px;
}
h1{
	margin-left:20px;
	font-size:2rem;
}
  .column {
    width: 220px;
    float: left;
		border: solid 4px black;
		min-height: 500px;
    
  }
  .portlet {
    margin: 0 1em 1em 0;
    padding: 0.3em;
  }
  .portlet-header {
    padding: 0.2em 0.3em;
    margin-bottom: 0.5em;
    position: relative;
  }
  .portlet-toggle {
    position: absolute;
    top: 50%;
    right: 0;
    margin-top: -8px;
  }
  .portlet-content {
    padding: 0.4em;
  }
  .portlet-placeholder {
    border: 1px dotted black;
    margin: 0 1em 1em 0;
    height: 50px;
  }
  </style>
</head>
<body>
  <!--<form method="post">-->
    <div class="row">
      <div class="col-lg-2">
        Actualisation dans <span id="countdown">2:00</span>
        <script>
          var seconds = 120;
          function secondPassed() {
            var minutes = Math.round((seconds - 30)/60);
            var remainingSeconds = seconds % 60;
            if (remainingSeconds < 10) {
              remainingSeconds = "0" + remainingSeconds;
            }
            document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
            if (seconds == 0) {
              clearInterval(countdownTimer);
              document.getElementById('countdown').innerHTML = "0:00";
              location.reload();
            } else {
              seconds--;
            }
          }
          var countdownTimer = setInterval('secondPassed()', 1000);
        </script>
        <input type="button" name="submit" value="Enregistrer" class="btn btn-primary btn-success btn-block" onclick="update()"></input><br>
        <script>
          function update(){
            <?php
            foreach($members as $member) {
              echo 'var id = "agent-'.$member['ID'].'";';
              echo 'var unit = document.getElementById(id).parentNode.id;';
              echo 'unit = unit.substring(5);';
              echo 'id = id.substring(6);';
              echo 'var type = "update_dispatch";';
              echo '$.ajax({
                type: "POST",
                url: "functions/dispatchfunction.php",
                dataType: "html",
                data: {type: type, id: id, unit: unit},
              });';
            }
            ?>
            alert("Enregistré !");
            location.reload();
          }
        </script>
      </div>
    </div>
    <div class="scrumboard row">
      <div class="column flex" id="unit-0">
	      <h1>Liste des agents</h1>
        <?php
        foreach ($members as $member) {
          if($member['dispatch_unit'] == 0) {
            echo '<div class="portlet" id="agent-'.$member['ID'].'">
          <div class="portlet-header" style="color: #e02d1b;">'.$member['name'].' '.$member['firstname'].'</div>
          <div class="portlet-content">Matricule : '.$member['matricule'].'<br>
            Grade : '.$member['grade'].'<br>
            Division : '.$member['division'].'<br></div>
          </div>';
          }
        }
        ?> 
      </div>
      <?php
      $req2 = $bdd->prepare('SELECT ID, name FROM dispatch_units_lspd ORDER BY name ASC');
      $req2->execute();
      $dispatch_unit = $req2->fetchAll();
      foreach ($dispatch_unit as $unit) {
        echo '<div class="column flex" id="unit-'.$unit['ID'].'">
          <h1>'.$unit['name'].'</h1>';
        $req3 = $bdd->prepare('SELECT ID, name, matricule, firstname, grade, division, dispatch_unit FROM members_lspd WHERE dispatch_unit = ? ORDER BY name ASC');
        $req3->execute(array($unit['ID']));
        $members = $req3->fetchAll();
        foreach ($members as $member) {
          echo '<div class="portlet" id="agent-'.$member['ID'].'">
          <div class="portlet-header">'.$member['name'].' '.$member['firstname'].'</div>
          <div class="portlet-content">Matricule : '.$member['matricule'].'<br>
            Grade : '.$member['grade'].'<br>
            Division : '.$member['division'].'<br></div>
          </div>';
        }
        echo '</div>';
      }
      ?>	
    </div>
  <!--</form>-->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
  
  <script>
    $(function() {
    $( ".column" ).sortable({
      connectWith: ".column",
      handle: ".portlet-header",
      cancel: ".portlet-toggle",
      placeholder: "portlet-placeholder ui-corner-all"
    });
 
    $( ".portlet" )
      .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
      .find( ".portlet-header" )
        .addClass( "ui-widget-header ui-corner-all" )
       
 
    $( ".portlet-toggle" ).click(function() {
      var icon = $( this );
      icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
      icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
    });
  });
  </script>
</body>
</html>
