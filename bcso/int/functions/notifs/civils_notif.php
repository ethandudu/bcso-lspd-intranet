<?php

include("../../../config.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$title = "📔 Ajout d'un civil";
$name = $_GET["name"];
$firstname = $_GET["firstname"];
$birthdate = $_GET["birthdate"];
$address = $_GET["address"];
$phone = $_GET["phone"];
$hair = $_GET["hair"];
$skin = $_GET["skin"];
$color = "2e59d9";


// Log vers Discord Public
$webhookurl = "https://discordapp.com/api/webhooks/1081121170260242433/u72kCP9PmkdF9AXEiB8JLfbzJcVFSORyXqRtAinRlvNng3jbJVONBpyUvu9Far-Z80vX";

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([

    "content" => "",

    // Embeds Array
    "embeds" => [
        [
            "title" => $title,

            "type" => "rich",

            "description" => "",

            "fields" => [
                [
                    "name" => "Nom Prénom",
                    "value" => $name . " " . $firstname,
                    "inline" => false
                ],
                [
                    "name" => "Date de naissance",
                    "value" => date("d/m/Y", strtotime($birthdate)),
                    "inline" => false
                ],
                [
                    "name" => "Adresse",
                    "value" => $address,
                    "inline" => false
                ],
                [
                    "name" => "Téléphone",
                    "value" => $phone,
                    "inline" => false
                ],
                [
                    "name" => "Couleur de cheveux",
                    "value" => $hair,
                    "inline" => false
                ],
                [
                    "name" => "Couleur de peau",
                    "value" => $skin,
                    "inline" => false
                ],
                [
                    "name" => "Ajouté par",
                    "value" => $_COOKIE["firstname"] . " " . $_COOKIE["name"],
                    "inline" => false

                ]
            ],

            "color" => hexdec($color),

            "footer" => [
                "text" => "BCSO",
                "icon_url" => "https://bcso.ethanduault.fr/assets/img/logo_bcso.png"
            ],

            "timestamp" => $timestamp,
        ],
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_close($ch);

// Log vers Discord Privé
$webhookurl = "https://discordapp.com/api/webhooks/1082985752108994561/Il4YcsSn7WdRDeROlEFuo_t_fXc15Chno4NeMII0kO7nePwjp5weQa5uOLUYiwD2hvAs";

$timestamp = date("c", strtotime("now"));

$json_data = json_encode([

    "content" => "",

    // Embeds Array
    "embeds" => [
        [
            "title" => $title,

            "type" => "rich",

            "description" => "",

            "fields" => [
                [
                    "name" => "Nom Prénom",
                    "value" => $name . " " . $firstname,
                    "inline" => false
                ],
                [
                    "name" => "Date de naissance",
                    "value" => date("d/m/Y", strtotime($birthdate)),
                    "inline" => false
                ],
                [
                    "name" => "Adresse",
                    "value" => $address,
                    "inline" => false
                ],
                [
                    "name" => "Téléphone",
                    "value" => $phone,
                    "inline" => false
                ],
                [
                    "name" => "Couleur de cheveux",
                    "value" => $hair,
                    "inline" => false
                ],
                [
                    "name" => "Couleur de peau",
                    "value" => $skin,
                    "inline" => false
                ],
                [
                    "name" => "Ajouté par",
                    "value" => $_COOKIE["firstname"] . " " . $_COOKIE["name"],
                    "inline" => false

                ]
            ],

            "color" => hexdec($color),

            "footer" => [
                "text" => "BCSO",
                "icon_url" => "https://bcso.ethanduault.fr/assets/img/logo_bcso.png"
            ],

            "timestamp" => $timestamp,
        ],
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$ch = curl_init($webhookurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_close($ch);

header("Location: ../../civils.php");

?>