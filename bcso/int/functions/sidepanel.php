<?php
echo '<li class="nav-item active">
<a class="nav-link" href="./">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Accueil</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">

</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
    aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-folder-open"></i>
    <span>Casiers</span>
</a>
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="casiers.php">Liste</a>
        <a class="collapse-item" href="add_casier.php">Ajouter</a>
    </div>
</div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
    aria-expanded="true" aria-controls="collapseThree">
    <i class="fas fa-fw fa-book"></i>
    <span>Civils</span>
</a>
<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="civils.php">Liste</a>
        <a class="collapse-item" href="add_civils.php">Ajouter</a>
    </div>
</div>

</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
        <i class="fas fa-fw fa-handcuffs"></i>
        <span>Wanted</span>
    </a>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="wanted.php">Liste</a>
            <a class="collapse-item" href="add_wanted.php">Ajouter</a>
        </div>
    </div>
</li>

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselspd"
    aria-expanded="true" aria-controls="collapseinfo">
    <i class="fas fa-fw fa-star"></i>
    <span>LSPD</span>
</a>
<div id="collapselspd" class="collapse" aria-labelledby="informations" data-parent="#collapselspd">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="civils_lspd.php">Civils</a>
        <a class="collapse-item" href="casiers_lspd.php">Casiers</a>
        <a class="collapse-item" href="wanted_lspd.php">Wanted</a>
    </div>
</div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Utiles
</div>



<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetwo"
    aria-expanded="true" aria-controls="collapseinfo">
    <i class="fas fa-fw fa-info"></i>
    <span>Informations</span>
</a>
<div id="collapsetwo" class="collapse" aria-labelledby="informations" data-parent="#collapsetwo">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="codepenal.php">Code Pénal</a>
        <a class="collapse-item" href="miranda.php">Droits Miranda</a>
        <a class="collapse-item" href="amendes.php">Amendes</a>
        <a class="collapse-item" href="phone.php">Numéros</a>
        <a class="collapse-item" href="saisies.php">Casiers de saisie</a>
        <a class="collapse-item" href="radio.php">Radio</a>
        <a class="collapse-item" href="weapons.php">Armes</a>
        <a class="collapse-item" href="maps.php">Carte</a>
    </div>
</div>
</li>
<li class="nav-item">
    <a class="nav-link" href="procedures.php">
    <i class="fas fa-fw fa-file"></i>
    <span>Procédures</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="dispatch.php">
    <i class="fas fa-fw fa-headset"></i>
    <span>Dispatch</span></a>
</li>

<hr class="sidebar-divider d-none d-md-block">';

include('divisions_panel.php');
?>