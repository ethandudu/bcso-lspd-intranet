<?php

include("../../config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = $bdd->prepare("DELETE FROM casiers WHERE ID = ?");
    $req->execute(array($id));
    header("Location: ../casiers.php");
}