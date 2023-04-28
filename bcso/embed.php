<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$webhookurl = "https://discordapp.com/api/webhooks/1064117886156800000/YoWlPb37BvVnQ7rV2yu2QCcf28lIOCIx1PT3vDwF_GEUIE0QREjVN5YpRES9l6MWENWZ";

        //=======================================================================================================
        // Compose message. You can use Markdown
        // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
        //========================================================================================================

        $timestamp = date("c", strtotime("now"));

        $json_data = json_encode([

            // Embeds Array
            "embeds" => [
                [
                    "title" => "📕Nouveau casier",

                    "type" => "rich",

                    "fields" => [
                        [
                            "name" => "Nom Prénom",
                            "value" => "John Copper",
                            "inline" => false
                        ],
                        [
                            "name" => "Infraction",
                            "value" => "Vol de charbon",
                            "inline" => false
                        ],

                        [
                            "name" => "Sanction",
                            "value" => "1 mois de prison",
                            "inline" => false
                        ],

                        [
                            "name" => "Date",
                            "value" => "12/12/2019",
                            "inline" => false
                        ],

                        [
                            "name" => "Officier",
                            "value" => "Stanley",
                            "inline" => false
                        ],

                        [
                            "name" => "Note",
                            "value" => "Aucune",
                            "inline" => false
                        ]
                    ]
                ]
            ],
            "content" => ""

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