<?php
require './db.php';
$type = $_POST['diabetesType'];
$insuranceProvider = $_POST['insuranceProvider'];
$dateServed = $_POST['dateServed'];
$insulinName = $_POST['insulinName'];
$injectType = $_POST['insulinType'];
$size = $_POST['size'];
$gauge = $_POST['gauge'];
$volume = $_POST['volume'];
$pumpProvider = $_POST['pumpProvider'];
$pills = $_POST['pills'];
$email = $_POST['email'];

$sql = "insert into list (title,content,author) VALUES ('$title','$content','$username')";
$res = mysqli_query($con, $sql);
?>