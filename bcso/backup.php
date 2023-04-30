<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php');

//export database to file

$hostname = "api.ethanduault.fr";
$username = "bcso";
$password = "bcso";
$namebase = "bcso";

$backup_file = "/tmp/backup-" . date("Y-m-d-H-i-s") . '.sql';
$command = "mysqldump --opt -h $hostname -u $username -p$password $namebase > $backup_file";
system($command);


?>