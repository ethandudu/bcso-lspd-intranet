<?php

if (($_COOKIE['grade']=="Sheriff") OR ($_COOKIE['grade']=="Sheriff Adjoint") OR ($_COOKIE['grade']=="Major") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['userconnect']=="johncopper") OR ($_COOKIE['division']=="B.E.")){


    echo '<div class="sidebar-heading">';
    echo '    Bureau d\'enquêtes';
    echo'</div>';

    echo '<li class="nav-item">';
        echo '<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdminBE"';
            echo 'aria-expanded="true" aria-controls="collapseAdminBE">';
            echo '<i class="fas fa-fw fa-magnifying-glass"></i>';
            echo '<span>Enquêtes</span>';
        echo '</a>';
        echo '<div id="collapseAdminBE" class="collapse" aria-labelledby="headingAdminBE" data-parent="#accordionSidebar">';
            echo'<div class="bg-white py-2 collapse-inner rounded">';
                echo'<a class="collapse-item" href="enquetes_list.php">Liste</a>';
                echo '<a class="collapse-item" href="add_enquete.php">Ajouter</a>';
            echo '</div>';
        echo '</div>';
    echo '</li>';
    echo '<hr class="sidebar-divider d-none d-md-block">';
}
