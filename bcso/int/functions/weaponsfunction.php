<?php
include('../../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$type = $_POST['type'];


if ($type == "add"){
    $req = $bdd->prepare('INSERT INTO weapons (name, firstname, serialnumber, weapon_type, officier, officier_type) VALUES (?, ?, ?, ?, ?, ?)');
    $req->execute(array($_POST['name'], $_POST['firstname'], $_POST['serialnumber'], $_POST['weapon_type'], $_POST['officier'], "BCSO"));
    echo "success";
}

if ($type == "delete"){
    $req = $bdd->prepare('DELETE FROM weapons WHERE serialnumber = ?');
    $req->execute(array($_POST['serialnumber']));
    echo "success";
}

if ($type == "load"){
    $req = $bdd->prepare('SELECT * FROM weapons WHERE serialnumber = ?');
    $req->execute(array($_POST['serialnumber']));
    $result = $req->fetch();
    echo json_encode($result);
}
?>