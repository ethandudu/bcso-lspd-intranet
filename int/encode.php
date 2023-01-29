<?php

include('../config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])){

    $fileName1 = basename($_FILES["pica"]["name"]);
    $fileType1 = pathinfo($fileName1,PATHINFO_EXTENSION);
    $image1 = $_FILES['pica']['tmp_name'];
    $imgcontent1 = base64_encode(file_get_contents($image1));

    //update the database
    $req = $bdd->prepare('UPDATE civil SET picface = :image WHERE ID = :id');
    $req->execute(array(
        'image' => $imgcontent1,
        'id' => $_POST['id']
    ));

    echo "Image ajoutée avec succès !";
}
?>

<form method='post' enctype="multipart/form-data">
    <input type="file" name="pica" id="pica" class="form-control" required>
    <input type="number" name="id" id="id" class="form-control" required>
    <button type="submit" class="btn btn-success" name="submit">Ajouter</button>
</form>

<img src="data:image/jpeg;base64,<?php echo $imgcontent1; ?>" />