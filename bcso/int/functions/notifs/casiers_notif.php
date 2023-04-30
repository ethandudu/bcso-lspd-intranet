<?php

include("../../../config.php");

$title = "📁 Ajout d'un casier judiciaire";
$name = $_GET["name"];
$firstname = $_GET["firstname"];
$reason = $_GET["reason"];
$sanction = $_GET["sanction"];
$date = $_GET["date"];
$color = "f4b619";

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

            "type" => "rich",

            "description" => "",

            "fields" => [
                [
                    "name" => "Nom Prénom",
                    "value" => $name . " " . $firstname,
                    "inline" => false
                ],
                [
                    "name" => "Infraction",
                    "value" => $reason,
                    "inline" => false
                ],
                [
                    "name" => "Sanction",
                    "value" => $sanction,
                    "inline" => false
                ],
                [
                    "name" => "Date",
                    "value" => date("d/m/Y H:i", strtotime($date)),
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

$response = curl_exec($ch);
// If you need to debug, or find out why you can't send message uncomment line below, and execute script.
// echo $response;
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
                    "name" => "Infraction",
                    "value" => $reason,
                    "inline" => false
                ],
                [
                    "name" => "Sanction",
                    "value" => $sanction,
                    "inline" => false
                ],
                [
                    "name" => "Date",
                    "value" => date("d/m/Y H:i", strtotime($date)),
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


header("Location: ../../casiers.php");

?>