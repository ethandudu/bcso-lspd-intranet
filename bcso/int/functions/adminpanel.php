<?php

if (($_COOKIE['grade']=="Sheriff") OR ($_COOKIE['grade']=="Sheriff Adjoint") OR ($_COOKIE['grade']=="Major") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['userconnect']=="johncopper")){


    echo '<div class="sidebar-heading">';
    echo '    Administration';
    echo'</div>';

    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="vehicles.php">
    <i class="fas fa-fw fa-car"></i>
    <span>Véhicules</span></a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="formations.php">
    <i class="fas fa-fw fa-graduation-cap"></i>
    <span>Formations</span></a>';
    echo '</li>';

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
}
?>