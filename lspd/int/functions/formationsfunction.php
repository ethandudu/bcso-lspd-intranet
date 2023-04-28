<?php
include ('../../config.php');
$type = $_POST['type'];


if ($type == "add"){

    $agent = $_POST['agent'];
    $formation = $_POST['formation'];
    $req = $bdd->prepare('UPDATE members_lspd SET '.$formation.' = 1 WHERE ID = ?');
    $req->execute(array($agent));
    echo "success";
}

if ($type == "delete"){
    $agent = $_POST['agent'];
    $formation = $_POST['formation'];
    $req = $bdd->prepare('UPDATE members_lspd SET '.$formation.' = 0 WHERE ID = ?');
    $req->execute(array($agent));
    echo "success";
}

?>