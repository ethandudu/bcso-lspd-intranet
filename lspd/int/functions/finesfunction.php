<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../../config.php');

$type = $_POST['type'];

if ($type == "remove"){
    $id = $_POST['id'];
    $req = $bdd->prepare("DELETE FROM `fines_lspd` WHERE ID = ?");
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
    $req = $bdd->prepare("INSERT INTO `fines_lspd`(`factureid`, `civilid`, `officierid`, `value`, `datetime`, `note`) VALUES (?,?,?,?,?,?)");
    $req->execute(array($factureid, $civilid, $officierid, $value, $datetime2, $note));

    $type = "fine";
    $sender = $_COOKIE['id'];
    $receiver = 40;
    $req = $bdd->prepare('SELECT name, firstname FROM civils_lspd WHERE ID = ?');
    $req->execute(array($civilid));
    $data = $req->fetch();
    $civilnamefirstname = $data['name'] . " " . $data['firstname'];
    $datetime = date("Y-m-d H:i:s");
    $text = "Une amende impayée d'un montant de ". $value ."$ a été ajoutée pour ". $civilnamefirstname;
    $req = $bdd->prepare('INSERT INTO notifications_lspd (type, sender, receiver, text, datetime, civilid) VALUES (?, ?, ?, ?, ?, ?)');
    $req->execute(array($type, $sender, $receiver, $text, $datetime, $civilid));
    echo "success";
}

if ($type == "loadcivil") {
    $id = $_POST['id'];
    $req = $bdd->prepare('SELECT name,firstname, tel, ID FROM civils_lspd WHERE ID = ?');
    $req->execute(array($id));
    echo json_encode($req->fetchAll());
}