<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../config.php');

$type = $_POST['type'];

if ($type == "remove"){
    $id = $_POST['id'];
    $req = $bdd->prepare("DELETE FROM `fines_bcso` WHERE ID = ?");
    $req->execute(array($id));
    echo "success";
}

if ($type == "add"){
    $factureid = $_POST['factureid'];
    $civilid = $_POST['civil'];
    $officierid = $_POST['agent'];
    $value = $_POST['value'];
    $datetime = $_POST['datetime'];
    $note = $_POST['note'];
    $datetime2 = date("Y-m-d H:i:s", strtotime($datetime));
    $req = $bdd->prepare("INSERT INTO `fines_bcso`(`factureid`, `civilid`, `officierid`, `value`, `datetime`, `note`) VALUES (?,?,?,?,?,?)");
    $req->execute(array($factureid, $civilid, $officierid, $value, $datetime2, $note));
    echo "success";
}

if ($type == "loadcivil") {
    $id = $_POST['id'];
    $req = $bdd->prepare('SELECT * FROM civils_bcso WHERE ID = ?');
    $req->execute(array($id));
    echo json_encode($req->fetchAll());
}