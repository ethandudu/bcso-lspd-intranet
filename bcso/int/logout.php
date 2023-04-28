<?php
session_start();
$_SESSION = array();
//clear cookies
setcookie("userconnect", "", time() - 3600);
setcookie("mdpconnect", "", time() - 3600);
setcookie("id", "", time() - 3600);
setcookie("grade", "", time() - 3600);
setcookie("name", "", time() - 3600);
setcookie("firstname", "", time() - 3600);
setcookie("division", "", time() - 3600);
session_destroy();
header("Location: ../");
?>