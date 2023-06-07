<?php
include ('../../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$type = $_GET['type'];
if ($type == "send") {
    $sender = $_GET['sender'];
    $title = $_GET['title'];
    $content = $_GET['content'];
    $lspdarray = $_GET['lspd'];
    $bcsoarray = $_GET['bcso'];
    $sendertype = "LSPD";
    $messagetype = "message";

    //check if the bcso array is empty
    if ($bcsoarray != []) {
        foreach($bcsoarray as $receiver){
            echo $receiver;
            $req = $bdd->prepare('INSERT INTO messages_bcso (type, sender, sender_type, receiver, title, text, datetime) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $req->execute(array($messagetype, $sender, $sendertype, $receiver, $title, $content, date("Y-m-d H:i:s")));
        }
    }

    if ($lspdarray != []){
        foreach($lspdarray as $receiver){
            $req = $bdd->prepare('INSERT INTO messages_lspd (type, sender, sender_type, receiver, title, text, ) VALUES(?, ?, ?, ?, ?, ?, ?)');
            $req->execute(array($messagetype, $sender, $sendertype, $receiver, $title, $content, date("Y-m-d H:i:s")));
        }
    }
    echo "success";
}
?>