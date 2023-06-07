<?php
include ('../../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['ID'])){
    $ID = $_POST['ID'];
}

$type = $_POST['type'];

if ($type == "reply") {
    $req = $bdd->prepare('SELECT sender, title, sender_type FROM messages_bcso WHERE ID = ?');
    $req->execute(array($ID));
    $data = $req->fetch();
    $sender = $data['sender'];
    $title = $data['title'];
    $sendertype = $data['sender_type'];
    $array = array('sender' => $sender, 'title' => $title, 'sendertype' => $sendertype);
    echo json_encode($array);
}

if ($type == "delete"){
    $req = $bdd->prepare('DELETE FROM messages_bcso WHERE ID = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "deleteall"){
    $req = $bdd->prepare('DELETE FROM messages_bcso WHERE receiver = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "markasread"){
    $req = $bdd->prepare('UPDATE messages_bcso SET markasread = 1 WHERE ID = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "markallasread"){
    $req = $bdd->prepare('UPDATE messages_bcso SET markasread = 1 WHERE receiver = ?');
    $req->execute(array($ID));
    echo "success";
}

if ($type == "send") {
    $sender = $ID;
    $title = $_POST['title'];
    $content = $_POST['content'];
    $bcso = json_decode($_POST['bcso']);
    $lspd = json_decode($_POST['lspd']);
    $sendertype = "BCSO";
    $messagetype = "message";


    //check if the bcso array is empty
    foreach($bcso as $key => $value) {
        $req = $bdd->prepare('INSERT INTO messages_bcso (type, sender, sender_type, receiver, title, text) VALUES(?, ?, ?, ?, ?, ?)');
        $req->execute(array($messagetype, $sender, $sendertype, $value, $title, $content));
    }

    foreach($lspd as $receiver){
        $req = $bdd->prepare('INSERT INTO messages_lspd (type, sender, sender_type, receiver, title, text) VALUES(?, ?, ?, ?, ?, ?)');
        $req->execute(array($messagetype, $sender, $sendertype, $receiver, $title, $content));
    }

    echo "success";
}
?>
