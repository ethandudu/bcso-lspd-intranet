<?php

echo '<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>';

    $reqnotif = $bdd->prepare('SELECT * FROM notifications_bcso WHERE receiver = ? AND markasread = 0 ORDER BY datetime DESC');
    $reqnotif->execute(array($_COOKIE['id']));
    $data = $reqnotif->fetchAll();
    $count = $reqnotif->rowCount();
    echo '<!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-info badge-counter">'.$count.'</span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown"';
        if ($count > 2) {
            echo 'style="max-height: 550px; overflow-y: scroll;"';
        }
        echo'>
            <h6 class="dropdown-header">Notifications</h6>';
            if ($count > 0) {
                foreach ($data as $notif){
                    echo '<a class="dropdown-item d-flex align-items-center"><div class="mr-3">';
                        if ($notif['type'] == "civil"){
                            echo '<div class="icon-circle bg-success"><i class="fas fa-book text-white"></i></div>';
                        }
                        elseif ($notif['type'] == "casier"){
                            echo '<div class="icon-circle bg-warning"><i class="fas fa-folder-open text-white"></i></div>';
                        }elseif ($notif['type'] == "wanted"){
                            echo '<div class="icon-circle bg-info"><i class="fas fa-handcuffs text-white"></i></div>';
                        }elseif ($notif['type'] == "member"){
                            echo '<div class="icon-circle bg-primary"><i class="fas fa-user text-white"></i></div>';
                        }
                        echo '</div>
                        <div>
                            <div class=" text-gray-500">'. date("d/m/Y H:i", strtotime($notif['datetime'])).'</div>
                            <span class="">'. htmlspecialchars($notif['text']).'</span>
                        </div>
                    </a>';
                }
            }else{
                echo '<a class="dropdown-item d-flex align-items-center"><div class="mr-3">
                <div><span class="">Aucune notification non lue</span></div></div>
                </a>';
            }
        echo '<a class="dropdown-item text-center small text-gray-500" href="notifications.php">Voir toutes les alertes</a>
        </div>
    </li>';

    $reqmessage = $bdd->prepare('SELECT * FROM messages_bcso WHERE receiver = ? AND markasread = 0 ORDER BY datetime DESC');
    $reqmessage->execute(array($_COOKIE['id']));
    $datamessage = $reqmessage->fetchAll();
    $countmessage = $reqmessage->rowCount();

    echo '<!-- Nav Item - Messages -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <!-- Counter - Messages -->
            <span class="badge badge-info badge-counter">'.$countmessage.'</span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Messages</h6>';
            if ($countmessage > 0) {
                foreach ($datamessage as $message){
                    echo '<a class="dropdown-item d-flex align-items-center"><div class="mr-3">';
                        if ($message['type'] == "annonce"){
                            echo '<div class="icon-circle bg-warning"><i class="fas fa-bullhorn text-white"></i></div>';
                        }elseif ($message['type'] == "message"){
                            echo '<div class="icon-circle bg-primary"><i class="fas fa-envelope text-white"></i></div>';
                        }
                        if ($message['sender_type'] == "LSPD"){
                            $sendername = $bdd->prepare('SELECT ID, name, firstname FROM members_lspd WHERE ID = ?');
                            $sendername->execute(array($message['sender']));
                            $sendername = $sendername->fetch();
                        }elseif ($message['sender_type'] == "BCSO"){
                            $sendername = $bdd->prepare('SELECT ID, name, firstname FROM members_bcso WHERE ID = ?');
                            $sendername->execute(array($message['sender']));
                            $sendername = $sendername->fetch();
                        }
                        echo '</div>
                        <div>
                            <div class=" text-gray-500">'. $sendername['name']. " ". $sendername['firstname'] ." " . date("d/m/Y H:i", strtotime($message['datetime'])).'</div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">'. htmlspecialchars($message['title']).'</div>
                            </div>
                            <span class="">'. ($message['text']).'</span>
                        </div>
                    </a>';
                }
            }else{
                echo '<a class="dropdown-item d-flex align-items-center"><div class="mr-3">
                <div><span class="">Aucun message non lu</span></div></div>
                </a>';
            }
            
            echo '<a class="dropdown-item text-center small text-gray-500" href="messages.php">Voir tous les messages</a>
        </div>
    </li>';

    echo '<div class="topbar-divider d-none d-sm-block"></div>';

    echo '<!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$_COOKIE['grade']." ".$_COOKIE['firstname']. " ".$_COOKIE['name'].'</span>
            <img class="img-profile rounded-circle"
                src="img/undraw_profile.svg">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="profile.php">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profil
            </a>';
            /*<a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Paramètres
            </a>*/
            echo'<div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Déconnexion
            </a>
        </div>
    </li>

</ul>

</nav>';

?>