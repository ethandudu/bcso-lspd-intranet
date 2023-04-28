<?php

include("../../config.php");

$label = $_GET['label'];
$label = $_POST['label'];
$label = htmlspecialchars($label);

$req = $bdd->prepare('SELECT ID, name, firstname FROM civils_lspd WHERE name LIKE :label ORDER BY name, firstname ASC');
$req->execute(array(
    'label' => '%' . $label . '%'
));
echo json_encode($req->fetchAll());