<?php
include ('../../config.php');
$type = $_POST['type'];


if ($type == "update_dispatch"){
    $ID = $_POST['id'];
    $unit = $_POST['unit'];
    $req = $bdd->prepare('UPDATE members SET dispatch_units_bcso = ? WHERE ID = ?');
    $req->execute(array($unit, $ID));
    echo $unit . " " . $ID;
}

if ($type == "add"){
    $name = $_POST['label'];
    $req = $bdd->prepare('INSERT INTO dispatch_units_bcso (name) VALUES (?)');
    $req->execute(array($name));
    echo "success";
}

if ($type == "edit"){
    $name = $_POST['label'];
    $ID = $_POST['id'];
    $req = $bdd->prepare('UPDATE dispatch_units_bcso SET name = ? WHERE ID = ?');
    $req->execute(array($name, $ID));
    echo "success";
}

if ($type == "delete"){
    $ID = $_POST['id'];
    $req = $bdd->prepare('DELETE FROM dispatch_units_bcso WHERE ID = ?');
    $req->execute(array($ID));
    $req = $bdd->prepare('UPDATE members_bcso SET dispatch_units_bcso = 0 WHERE dispatch_unit = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "load"){
    $ID = $_POST['id'];
    $req = $bdd->prepare('SELECT ID, name FROM dispatch_units_bcso WHERE ID = ?');
    $req->execute(array($ID));
    $result = $req->fetchAll();
    echo json_encode($result);
}
?>