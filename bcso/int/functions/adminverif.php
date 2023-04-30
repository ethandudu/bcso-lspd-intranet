<?php
if (($_COOKIE['grade']=="Sheriff") OR ($_COOKIE['grade']=="Sheriff Adjoint") OR ($_COOKIE['grade']=="Major") OR ($_COOKIE['grade']=="Lieutenant") OR ($_COOKIE['userconnect']=="johncopper")){

}else{
    header('Location: ../index.php');
}

?>