<?php
require 'db.php';
$insuranceProvider = isset($_POST['insuranceProvider']) ? $_POST['insuranceProvider'] : null ;
$dateServed = isset($_POST['dateServed']) ? $_POST['dateServed'] : null ;
$insulinName = isset($_POST['insulinName']) ? $_POST['insulinName'] : null ;
$insulinType = isset($_POST['insulinType']) ? $_POST['insulinType'] : null ;
$size = isset($_POST['size']) ? $_POST['size'] : null ;
$gauge = isset($_POST['gauge']) ? $_POST['gauge'] : null ;
$volume = isset($_POST['volume']) ? $_POST['volume'] : null ;
$pumpProvider = isset($_POST['pumpProvider']) ? $_POST['pumpProvider'] : null ;
$pills = isset($_POST['pills']) ? $_POST['pills'] : null ;

$fastInsulin = isset($_POST['fastInsulin']) ? $_POST['fastInsulin'] : null ;
$slowInsulin = isset($_POST['slowInsulin']) ? $_POST['slowInsulin'] : null;

$diabetesType = isset($_POST['diabetesType']) ? $_POST['diabetesType'] : null ;
$notification =isset($_POST['optionsNotificationsRadios']) ? $_POST['optionsNotificationsRadios'] : null ;
$email = isset($_POST['email']) ? $_POST['email'] : null ;

$createAccount = isset($_POST['optionsPasswordRadios']) ? $_POST['optionsPasswordRadios'] : null;
$pw = isset($_POST['pw']) ? $_POST['pw'] : null ;

//search the plan that match

if($diabetesType == 1){
    $sql1 = "SELECT plan_id FROM 'all plan' 
        WHERE (slow_act_insulin = '" .$slowInsulin. "' and fast_act_insulin = '" .$fastInsulin. "' and insulin_type = '" . $insulinType . "');";
    $res = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_array($res)){
        mysqli_query($con, 'INSERT INTO user_plans VALUES(' . $email. ',' . $row['plan_id'] .')' );

        echo 'provider = '. $row['provider'] . '<br>';
        echo 'tier = '. $row['tier'] . '<br>';
    }
    mailer($res);

}

if($diabetesType == 2){
    $sql1 = "SELECT plan_id, provider, tier FROM type1_plans WHERE pill = '".$pills ."'";
    $res = mysqli_query($con, $sql1);
    while ($row = mysqli_fetch_array($res)){
        mysqli_query($con, "INSERT INTO user_plans VALUES('" . $email. "'," . $row['plan_id'] .")" );

        echo 'provider = '. $row['provider'] . '<br>';
        echo 'tier = '. $row['tier'] . '<br>';
    }
    mailer($res);
}



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailer($res){

    //Load Composer's autoloader
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.sendgrid.net';                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'Philly-Codefest-Test';             // SMTP username
            $mail->Password = '';                 // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('diabeticInsurance@email.com', 'DI Email');
            $mail->addAddress($_SESSION['email'], $_SESSION['name']);     // Add a recipient

            $emailBody = "Hello, we are reaching out to you
                today inform you of the following changes listed below:<br>
                <table>
                    <thead>
                        <th>provider</th>
                        <th>tier</th>
                    </thead>
                
                ";
            while ($row = mysqli_fetch_array($res)){
                $emailBody = $emailBody."
                <tr>
                    <td>". $row['provider'] ."</td>
                    <td>". $row['tier'] ."</td>
                </tr>
                ";
            }

            $emailBody = $emailBody."</table>";

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = $emailBody;

                // Insert changes here via loo
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
    }
    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}




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

mysqli_close($con);
?>