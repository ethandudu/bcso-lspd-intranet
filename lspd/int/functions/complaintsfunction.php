<?php

include('../../config.php');
$type = $_POST['type'];

if ($type == "add"){
    $reqe = $_POST['req'];
    $acc = $_POST['acc'];
    $subject = $_POST['subject'];
    $officier = $_POST['officier'];
    $datetime = $_POST['datetime'];
    $plainte = $_POST['plainte'];
    $req = $bdd->prepare('INSERT INTO complaints (datetime, req, violator, officier, subject, object) VALUES (?, ?, ?, ?, ?, ?)');
    $req->execute(array($datetime, $reqe, $acc, $officier, $subject, $plainte));
    echo "success";
}


?>