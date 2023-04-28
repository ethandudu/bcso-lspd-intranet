<?php
$req = $bdd->prepare('SELECT recruteur FROM members_lspd WHERE ID = ?');
$req->execute(array($_COOKIE['id']));
$donnees = $req->fetch();
$recruteur = $donnees['recruteur'];
if (($_COOKIE['grade']=="Commandant") OR ($_COOKIE['grade']=="Capitaine") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['grade']=="Sergent Chef") OR ($_COOKIE['userconnect']=="tyzemike" OR $recruteur == 1)){

}else{
    header('Location: index.php?error=permission');
}

?>