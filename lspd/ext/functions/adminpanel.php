<?php

if ($_SESSION['grade']=="BCSO"){


    echo '<div class="sidebar-heading">';
    echo '    Administration';
    echo'</div>';

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
    echo '<hr class="sidebar-divider d-none d-md-block">';
}
?>