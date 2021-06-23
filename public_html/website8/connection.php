<?php

$username = "id14037329_root";
$password = "Raj9@gmail.com";
$server = 'localhost';
$db = 'id14037329_first_db';  


$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
     echo "Connection Error";

}

?>