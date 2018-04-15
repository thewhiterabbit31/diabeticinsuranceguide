<?php
require 'db.php';
$insuranceProvider = isset($_POST['insuranceProvider']) ? $_POST['insuranceProvider'] : null ;
$dateServed = isset($_POST['dateServed']) ? $_POST['dateServed'] : null ;
$insulinName = isset($_POST['insulinName']) ? $_POST['insulinName'] : null ;
$injectType = isset($_POST['insulinType']) ? $_POST['insulinType'] : null ;
$size = isset($_POST['size']) ? $_POST['size'] : null ;
$gauge = isset($_POST['gauge']) ? $_POST['gauge'] : null ;
$volume = isset($_POST['volume']) ? $_POST['volume'] : null ;
$pumpProvider = isset($_POST['pumpProvider']) ? $_POST['pumpProvider'] : null ;
$pills = isset($_POST['pills']) ? $_POST['pills'] : null ;

$fastInsulin = isset($_POST['fastInsulin']) ? $_POST['fastInsulin'] : null ;
$slowInsulin = isset($_POST['slowInsulin']) ? $_POST['slowInsulin'] : null;

$diabetesType = isset($_POST['diabetesType']) ? $_POST['diabetesType'] : null ;
$email = isset($_POST['email']) ? $_POST['email'] : null ;
$pw = isset($_POST['pw']) ? $_POST['pw'] : null ;

//search the plan that match
if($diabetesType == 2){
    $sql = "SELECT plan_id FROM type2_plans WHERE pill = 'Biguanides' ";
}

if(!is_null ($pw)){
    //user choose to create an account

    $sql = "INSERT INTO 'users' (email, diabetesType, )' ";
}

$res = mysqli_query($con, $sql);

/*
echo $type;
echo $insuranceProvider;
echo $dateServed;
echo $insulinName;
echo $injectType;
echo $size;
echo $gauge;
echo $volume;
echo $pumpProvider;
echo $pills;
echo $email;
*/
?>