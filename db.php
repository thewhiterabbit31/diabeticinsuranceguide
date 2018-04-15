<?php
// Atttempt
define('HOST', 'localhost');     // The host you want to connect to.
define('USER', 'root');       // The database username.
define('PASSWORD', '' );   // The database password.
define('DATABASE', 'rxhelper');   // The database name.
define('PORT', '');         // The database port.

$con = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

if (!$con) {
    exit("Could not connect:" . mysqli_error($con));
}

mysqli_select_db($con,DATABASE) or die("Could not select database :".mysqli_error($con));
mysqli_query($con,"SET NAMES utf8") or die("Could not encode :".mysqli_error($con));//set encode





?>
