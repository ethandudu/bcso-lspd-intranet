<?php
if (($_COOKIE['grade']=="Commandant") OR ($_COOKIE['grade']=="Capitaine") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['grade']=="Sergent Chef") OR ($_COOKIE['userconnect']=="tyzemike")){

}else{
    header('Location: ../index.php');
}

?>