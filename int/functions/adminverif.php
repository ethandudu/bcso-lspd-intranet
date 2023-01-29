<?php
if (($_SESSION['grade']=="Sheriff") OR ($_SESSION['grade']=="Sheriff Adjoint") OR ($_SESSION['grade']=="Major")){

}else{
    header('Location: ../index.php');
}

?>