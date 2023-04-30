<?php

if (!isset($_COOKIE['userconnect']) || $_COOKIE['userconnect'] == ""){
    header("Location: login.php");    
}
$req = $bdd->prepare('SELECT password FROM members_bcso WHERE ID = ?');
$req->execute(array($_COOKIE['id']));
$resultat = $req->fetch();

if ($resultat['password'] != $_COOKIE['mdpconnect']){
    header("Location: login.php");
}

$req = $bdd->prepare('SELECT maintenance FROM settings');
$req->execute();
$resultat = $req->fetch();

if ($resultat['maintenance'] == 1){
    $req = $bdd->prepare('SELECT ID FROM members_bcso WHERE ID = ?');
    $req->execute(array($_COOKIE['id']));
    $resultat = $req->fetch();
    if ($resultat['ID'] != 1){
        header("Location: maintenance.php");
    } else {
        echo '<div style="background-color: orange; color: #ffffff"><h1>Mode maintenance actif</h1></div>';
    }
    
}
?>