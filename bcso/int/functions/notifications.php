<?php
include ('../../config.php');

$ID = $_POST['id'];
$type = $_POST['type'];

if ($type == "delete"){
    $req = $bdd->prepare('DELETE FROM notifications_bcso WHERE ID = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "deleteall"){
    $req = $bdd->prepare('DELETE FROM notifications_bcso WHERE receiver = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "markasread"){
    $req = $bdd->prepare('UPDATE notifications_bcso SET markasread = 1 WHERE ID = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "markallasread"){
    $req = $bdd->prepare('UPDATE notifications_bcso SET markasread = 1 WHERE receiver = ?');
    $req->execute(array($ID));
    echo "success";
}

?>
