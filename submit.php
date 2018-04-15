<?php
require 'db.php';
$insuranceProvider = isset($_POST['insuranceProvider']) ? $_POST['insuranceProvider'] : null ;
$dateServed = isset($_POST['dateServed']) ? $_POST['dateServed'] : null ;
$diabetesType = isset($_POST['diabetesType']) ? $_POST['diabetesType'] : null ;
$fastInsulin = isset($_POST['fastInsulin']) ? $_POST['fastInsulin'] : null ;
$slowInsulin = isset($_POST['slowInsulin']) ? $_POST['slowInsulin'] : null;
$insulinType = isset($_POST['insulinType']) ? $_POST['insulinType'] : null ;
$size = isset($_POST['size']) ? $_POST['size'] : null ;
$gauge = isset($_POST['gauge']) ? $_POST['gauge'] : null ;
$volume = isset($_POST['volume']) ? $_POST['volume'] : null ;
$pumpProvider = isset($_POST['pumpProvider']) ? $_POST['pumpProvider'] : null ;
$pills = isset($_POST['pills']) ? $_POST['pills'] : null ;

$hasUseInsulin = $_POST['optionsUseInsulinRadios'] ? true : false;
$notification = $_POST['optionsNotificationsRadios'] ? 1 : 0;
$email = isset($_POST['email']) ? $_POST['email'] : null ;

$createAccount = $_POST['optionsPasswordRadios'] ? true : false;
$pw = isset($_POST['pw']) ? $_POST['pw'] : null ;

//search the plan that match


/*
echo $insuranceProvider.'<br>';
echo $diabetesType.'<br>';
echo $dateServed.'<br>';
echo $insulinType.'<br>';

echo $slowInsulin.'<br>';
echo $fastInsulin.'<br>';

echo $size.'<br>';
echo $gauge.'<br>';
echo $volume.'<br>';
echo $pumpProvider.'<br>';
echo $pills.'<br>';
echo $email.'<br>';
echo $pw.'<br>';
echo $notification.'<br>';
echo $createAccount.'<br>';
*/


$whereInsulinSQL = "WHERE (slow_act_insulin = '" .$slowInsulin. "' 
            and fast_act_insulin = '" .$fastInsulin. "' 
            and insulin_type = '" . $insulinType . "');";

//echo $whereInsulinSQL;


if(($diabetesType == 1) || (($diabetesType == 2) && $hasUseInsulin)){
    echo "Type1";

    $providerSQL = "SELECT provider FROM insulin_plans ".$whereInsulinSQL;

    $tierSQL = "SELECT tier FROM insulin_plans ".$whereInsulinSQL;

    //select best match provider and tier
    $sql = "SELECT provider, tier FROM insulin_plans ".$whereInsulinSQL;

    echo "<br>sql:  ".$sql;
    echo "<br>";
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($res)){
        echo '<br> provider = '. $row['provider'] . '<br>';
        echo 'tier = '. $row['tier'] . '<br>';
        echo '<br>';

        //if user choose to create an account
        if($createAccount){

            //email, pw, diabetesType, slow_act_insulin, fast_act_insulin, insulin_type, pill, subscribe
            try {
                $insert2usersSQL = "INSERT INTO users VALUES('" . $email . "', '" . $pw . "', " . $diabetesType . ", '" . $slowInsulin . "', '" . $fastInsulin . "', '" . $insulinType . "', NULL," . $notification . ")";
                mysqli_query($con, $insert2usersSQL);
            }catch (Exception $e) {
                echo "insert unsuccessful";
            }
            //echo $insert2usersSQL.'<br>';

            //get the best match plan id
            $planIdSQL = "SELECT plan_id FROM all_plans WHERE(provider = '". $row['provider'] ."' and tier = '". $row['tier'] ."' )";
            $planIdRes = mysqli_query($con, $planIdSQL);
            $planId = mysqli_fetch_array($planIdRes);

            $insert2UserPlanSQL = "INSERT INTO user_plans VALUES('" . $email. "', " . $planId['plan_id'] . ", '" . $dateServed ."-01')";
            mysqli_query($con, $insert2UserPlanSQL );
        }

    }
    //sendEmail($res,$email);


}


if($diabetesType == 2 && !$hasUseInsulin){

    echo "Type2";
    //if patient hasn't use insulin
    if(!$hasUseInsulin){

        $providerSQL = "SELECT provider FROM pill_plans WHERE pill = '" . $pills . "'";
        $tierSQL = "SELECT tier FROM pill_plans WHERE pill = '" . $pills . "'";

    }
    $sql = "SELECT provider, tier FROM pill_plans WHERE pill = '" . $pills . "'";
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($res)){

        echo '<br> provider = '. $row['provider'] . '<br>';
        echo 'tier = '. $row['tier'] . '<br>';
        echo '<br>';

        //if user choose to create an account
        if($createAccount){

            //email, pw, diabetesType, slow_act_insulin, fast_act_insulin, insulin_type, pill, subscribe
            try {
                $insert2usersSQL = "INSERT INTO users VALUES('" . $email . "', '" . $pw . "', " . $diabetesType . ", ', NULL, NULL, NULL, '" . $pills. "', " . $notification . ")";
                mysqli_query($con, $insert2usersSQL);
            }catch (Exception $e) {
                echo "insert unsuccessful";
            }
            //echo $insert2usersSQL.'<br>';

            //get the best match plan id
            $planIdSQL = "SELECT plan_id FROM all_plans WHERE(provider = '". $row['provider'] ."' and tier = '". $row['tier'] ."' )";
            $planIdRes = mysqli_query($con, $planIdSQL);
            $planId = mysqli_fetch_array($planIdRes);

            $insert2UserPlanSQL = "INSERT INTO user_plans VALUES('" . $email. "', " . $planId['plan_id'] . ", '" . $dateServed ."-01')";
            echo $insert2UserPlanSQL;
            mysqli_query($con, $insert2UserPlanSQL );
        }
    }
    //sendEmail($res,$email);


}


//How to send the email???
function sendEmail($res, $desEmail){

    $msg = "Plans that select for you:\n
            Insurance Provider / Tier\n";

    while ($row = mysqli_fetch_array($res)){
        echo $row['provider'], $row['tier'];
        $msg = $msg.$row['provider']." / ".$row['tier']."\n";
    }

    echo $msg;



    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg);

    // send email
    mail($desEmail,"Code-fest-2018-test",$msg);

}

mysqli_close($con);
?>