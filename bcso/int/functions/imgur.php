<?php
// Connexion à la base de données MySQL
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ('../../config.php');


// Récupérer l'image de la base de données
$req = $bdd->prepare("SELECT picback, ID FROM civil WHERE ID = 77");
$req -> execute();

while ($row = $req->fetch()) {
    $image = $row["picback"];
    echo '<img class="d-block w-100" src="data:image/jpeg;base64,'.($image).'" alt="Third slide" height=500px>';
    

    // Télécharger l'image sur Imgur en utilisant l'API Imgur
    $client_id = "3e5d1e80649fa1c"; // Remplacer par votre propre client ID Imgur
    $url = 'https://api.imgur.com/3/image';
    $headers = array("Authorization: Client-ID $client_id");
    $image_data = array('image' => $image);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_POST => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $image_data
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $response_data = json_decode($response);
    $imgur_link = $response_data->data->link;

    echo "<br>L'image a été téléchargée sur Imgur avec succès. Le lien est : " . $imgur_link;
    $req2 = $bdd->prepare('UPDATE civil SET picback2 = :picback2 WHERE ID = :ID');
    $req2->execute(array(
        'picback2' => $imgur_link,
        'ID' => $row['ID']
        ));
}
?>
