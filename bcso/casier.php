<?php
include('config.php');
$exist = 0;
$error = "";
$table = 0;



if (isset($_POST['formcasier'])) {
    $firstname = htmlspecialchars($_POST['firstname']);
    $name = htmlspecialchars($_POST['name']);
    $birthdate = htmlspecialchars($_POST['birthdate']);

    $reqid = $bdd->prepare("SELECT * FROM civil WHERE firstname = ? AND name = ? AND birthdate = ?");
    $reqid->execute(array($firstname, $name, $birthdate));
    $idexist = $reqid->rowCount();
    $civilid = $reqid->fetch();

    if ($idexist == 1) {

        $requser = $bdd->prepare("SELECT * FROM casiers WHERE civilid = ?");
        $requser->execute(array($civilid['ID']));
        $userexist = $requser->rowCount();
        $table = 1;
    
        if ($userexist == 0) {
            $error = "Aucun casier judiciaire trouvé";
        }
    } else {
        $error = "Personne inconnue";
    }

    
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Bienvenue sur le site internet de la LSPD d'American Stories" />
        <title>LSPD - American Stories</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <?php include('functions/navbar.php'); ?>
        <!-- Header-->
        <header class="masthead text-center text-white"  style="background-image: url('assets/img/lspd_front.png');">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">LSPD</h1>
                    <h2 class="masthead-subheading mb-0">Casier judiciaire</h2>
                </div>
            </div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
        <div class="card">
            <div class="card-body container text-center">
                <?php
                if ($exist==0){
                    echo '<font color="red"><h2 class="mt-5">'.$error.'</h2></font>';
                }
                ?>
                <h2>Rechercher son casier judiciaire</h2>
                <form method="POST" name="informations">
                    <input class="form-control" type="text" name="firstname" placeholder="Prénom" required>
                    <br>
                    <input class="form-control" type="text" name="name" placeholder="Nom" required>
                    <br>
                    <input class="form-control" type="date" name="birthdate" placeholder="Date de naissance" required>
                    <br>
                    <input type="submit" value="Rechercher" class="btn btn-primary btn-xl" name="formcasier">
                </form>

                <?php
                if ($table==1){
                    echo '<h2 class="mt-5" id="casier">Casier judiciaire de '.$civilid['firstname'].' '.$civilid['name'].'</h2>';
                    #show table with informations
                    echo '<table class="table table-striped table-hover mt-5">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">Infraction</th>';
                    echo '<th scope="col">Sanction</th>';
                    echo '<th scope="col">Date</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    # get data from the database and display the rows
                    $requser = $bdd->prepare("SELECT * FROM casiers WHERE civilid = ?");
                    $requser->execute(array($civilid['ID']));
                    $results = $requser->fetchAll();
                    
                    foreach ($results as $result) {
                        echo '<tr>';
                        echo '<td>'.$result['crime'].'</td>';
                        echo '<td>'.$result['sanction'].'</td>';
                        $datetime = $result['datetime'];
                        $datetime = date("H:i d/m/Y", strtotime($datetime));
                        echo '<td>'.$datetime.'</td>';
                        echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                    
                }

                ?>
            </div>
        </div>
</section>

        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; LSPD - American Stories 2022</p></div>
            <div class="container px-5"><p class="m-0 text-center text-white small">Made with <i color: Tomato class="fas fa-heart"></i> by <a href="https://github.com/ethandudu">Ethan D.</a></p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
