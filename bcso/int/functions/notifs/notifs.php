<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BCSO - Annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body>
    <form method="post">
        <input type="text" name="title" placeholder="Titre">
        <textarea id="summernote" name="editor"></textarea>
        <input type="text" name="type" placeholder="Type">
        <input type="submit" value="Envoyer">
    </form>


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#summernote').summernote();
        });
    </script>
</body>
<?php

session_start();
include("../../../config.php");

$title = $_POST['title'];
$descripton = $_POST["editor"];
$image = $_GET['image'];
$type = $_POST['type'];

if ($type == "civil") {
    $color = "2e59d9";
} elseif ($type == "wanted") {
    $color = "e02d1b";
} elseif ($type == "casier") {
    $color = "f4b619";
} elseif ($type == "annonce") {
    $color = "1b9e02";
} else {
    $color = "000000";
}

echo $color;

if ($image == "null") {
    $image = "";
} else {
    $image = $_POST["image"];
}

$webhookurl = "https://discordapp.com/api/webhooks/1081121170260242433/u72kCP9PmkdF9AXEiB8JLfbzJcVFSORyXqRtAinRlvNng3jbJVONBpyUvu9Far-Z80vX";

//=======================================================================================================
// Compose message. You can use Markdown
// Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
//========================================================================================================

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([

    "content" => "",

    // Embeds Array
    "embeds" => [
        [
            "title" => $title,

            "image" => [
                "url" => $image
            ],

            "type" => "rich",

            "description" => $descripton,

            "color" => hexdec($color),

            "footer" => [
                "text" => "BCSO",
                "icon_url" => "https://bcso.ethanduault.fr/assets/img/logo_bcso.png"
            ],

            "timestamp" => $timestamp,
        ],
    ],

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
curl_close($ch);
?>
