<?php
include ('../../config.php');
$type = $_POST['type'];


if ($type == "add"){
    $model = $_POST['model'];
    $plate = $_POST['plate'];
    $label = $_POST['label'];
    $req = $bdd->prepare('INSERT INTO vehicles_lspd (model, plate, label) VALUES (?, ?, ?)');
    $req->execute(array($model, $plate, $label));
    echo "success";
}

if ($type == "delete"){
    $plate = $_POST['plate'];
    $req = $bdd->prepare('DELETE FROM vehicles_lspd WHERE plate = ?');
    $req->execute(array($plate));
    echo "success";
}

if ($type == "edit"){
    $plate = $_POST['plate'];
    $label = $_POST['label'];
    $owner = $_POST['owner'];
    $req = $bdd->prepare('UPDATE vehicles_lspd SET label = ?, owner = ? WHERE plate = ?');
    $req->execute(array($label, $owner, $plate));
    echo "success";
}

if ($type == "load"){
    $plate = $_POST['plate'];
    $req = $bdd->prepare('SELECT label, owner FROM vehicles_lspd WHERE plate = ?');
    $req->execute(array($plate));
    $result = $req->fetchAll();
    echo json_encode($result);
}
?>