<?php
include '../../../config.php';

//convert pdf to image
$imagick = new Imagick();
$imagick->readImage('wanted.pdf[0]');
$imagick->setImageFormat('png');
$date = date('d-m-Y H:i:s');
$filename = 'wanted'.$date.'png';
$imagick->writeImage($filename);
$imagick->clear();
$imagick->destroy();

//send image to discord
$webhookurl = "https://discord.com/api/webhooks/1064117886156800000/YoWlPb37BvVnQ7rV2yu2QCcf28lIOCIx1PT3vDwF_GEUIE0QREjVN5YpRES9l6MWENWZ";

    //=======================================================================================================
    // Compose message. You can use Markdown
    // Message Formatting -- https://discordapp.com/developers/docs/reference#message-formatting
    //========================================================================================================

    $timestamp = date("c", strtotime("now"));

    if ($checkbox == "") {
        $discord_id = "null";
        $discord_channel = "false";
    } else {
        $discord_id = $donnees['discord_id'];
        $discord_channel = "true";
    }

    $req3 = $bdd->prepare("SELECT * FROM convoys WHERE ID = " . $convoid . "");
    $req3->execute();
    $convoi2 = $req3->fetch();

    $json_data = json_encode([

        // Embeds Array
        "embeds" => [
            [
                // Embed Title
                "title" => "Nouveau Convoi",

                // Embed Type
                "type" => "rich",
                $url = "https://bcso.ethanduault.fr/int/functions/webhook/" . $filename,
                "image" => [
                    "url" => $url
                ],

                "description" => $description,

                // Additional Fields array
                "fields" => [
                    [
                        "name" => "",
                        "value" => $name,
                        "inline" => false
                    ],
                ]
            ]
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

?>