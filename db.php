<?php
// Atttempt
define('HOST', 'localhost');     // The host you want to connect to.
define('USER', 'root');       // The database username.
define('PASSWORD', '' );   // The database password.
define('DATABASE', 'forum-demo');   // The database name.
define('PORT', '8889');         // The database port.


$con = mysqli_connect(HOST,USER,PASSWORD,DATABASE);


mysqli_select_db($con,DATABASE) or die("Could not select database :".mysqli_error($con));
mysqli_query($con,"SET NAMES utf8") or die("Could not encode :".mysqli_error($con));//set encode

$conn = mysql_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
  exit("Could not connect:" . mysql_error());
}



?>
