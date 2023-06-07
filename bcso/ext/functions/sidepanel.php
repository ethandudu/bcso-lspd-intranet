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

<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsebcso"
    aria-expanded="true" aria-controls="collapseinfo">
    <i class="fas fa-fw fa-star"></i>
    <span>BCSO</span>
</a>
<div id="collapsebcso" class="collapse" aria-labelledby="informations" data-parent="#collapsebcso">
    <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="civils_bcso.php">Civils</a>
        <a class="collapse-item" href="casiers_bcso.php">Casiers</a>
        <a class="collapse-item" href="wanted_bcso.php">Wanted</a>
    </div>
</div>
</li>


<hr class="sidebar-divider d-none d-md-block">'
?>