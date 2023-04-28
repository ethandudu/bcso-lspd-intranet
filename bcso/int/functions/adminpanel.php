<?php
$reqadmin = $bdd->prepare('SELECT recruteur FROM members_lspd WHERE ID = ?');
$reqadmin->execute(array($_COOKIE['id']));
$donnees = $reqadmin->fetch();
$recruteur = $donnees['recruteur'];

if (($_COOKIE['grade']=="Commandant") OR ($_COOKIE['grade']=="Capitaine") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['grade']=="Sergent Chef") OR ($_COOKIE['userconnect']=="tyzemike")){


    echo '<div class="sidebar-heading">';
    echo '    Administration';
    echo'</div>';

    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="vehicles.php">
    <i class="fas fa-fw fa-car"></i>
    <span>Véhicules</span></a>';
    echo '</li>';

    



    echo '<li class="nav-item"><a class="nav-link" href="https://docs.google.com/spreadsheets/d/1NSgF5BnLNBfqYgThPw6NXFWEoFVhKfSZ6BqyP2ivprk/edit?usp=sharing" target="_blank">
        <i class="fas fa-fw fa-graduation-cap"></i>
        <span>Formations</span></a></li>';

    echo '<li class="nav-item">';
        echo '<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin2"';
            echo 'aria-expanded="true" aria-controls="collapseAdmin2">';
            echo '<i class="fas fa-fw fa-list"></i>';
            echo '<span>Utilisateurs</span>';
        echo '</a>';
        echo '<div id="collapseAdmin2" class="collapse" aria-labelledby="headingAdmin2" data-parent="#accordionSidebar">';
            echo'<div class="bg-white py-2 collapse-inner rounded">';
                echo'<a class="collapse-item" href="list_members.php">Liste</a>';
                echo '<a class="collapse-item" href="add_members.php">Ajouter</a>';
            echo '</div>';
        echo '</div>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="settings.php">
    <i class="fas fa-fw fa-gear"></i>
    <span>Paramètres</span></a>';
    echo '</li>';
    echo '<hr class="sidebar-divider d-none d-md-block">';
} elseif ($recruteur == 1){
    echo '<div class="sidebar-heading">Administration</div>';
    echo '<li class="nav-item"><a class="nav-link" href="formations.php">
        <i class="fas fa-fw fa-graduation-cap"></i>
        <span>Formations</span></a></li>';
}
?>