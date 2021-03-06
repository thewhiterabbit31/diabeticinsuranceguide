<?php
require 'db.php';
//require 'mailer.php';
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

$hasUseInsulin = $_POST['optionsUseInsulinRadios'];

$notification = $_POST['optionsNotificationsRadios'] ? 1 : 0;
$email = isset($_POST['email']) ? $_POST['email'] : null ;

$createAccount = $_POST['optionsPasswordRadios'];
$pw = isset($_POST['pw']) ? $_POST['pw'] : null ;
?>



<?php
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

/*
echo "type = ".gettype($hasUseInsulin);
echo "<br>";
echo $hasUseInsulin;
if(($diabetesType=="1")){
    echo "<br>yes, type 1";
}
if(($diabetesType=="2")){
    echo "yes, type 2<br>";
}
if(($hasUseInsulin=="true")){
    echo "yes, use insulin<br>";
}
if(($hasUseInsulin=="false")){
    echo "no, do not use insulin<br>";
}

*/

$whereInsulinSQL = "WHERE (slow_act_insulin = '" .$slowInsulin. "' 
            and fast_act_insulin = '" .$fastInsulin. "' 
            and insulin_type = '" . $insulinType . "');";

//echo $whereInsulinSQL;





?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Results - Diabetes Insurance Guide</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="conditionalFields.js"></script>
        <link href="album.css" rel="stylesheet">
        <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/album/">
    </head>

    <body>
    <div class="topNav">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <form class="form-inline">
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email"> <input type="password" class="form-control"
                                                             id="exampleInputPassword1" placeholder="Password"
                                                             autocomplete="off"
                                                             style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                    <button class="btn" type="submit" style="font-size:90%; padding: 4px;">Login</button>
                </form>
            </div>
            <div class="col-sm-6 col-md-6">
                <div style="float:right">
                    <img src="images/logo-updated.png" class="logo"/>
                </div>
            </div>
        </div>
    </div>

    <img src="images/header_background3.jpg" style="width:100%"/>

    <section>
    <div class="container">
    <div class="row">
        <h2 class="text-center">Results For:<br> <?php echo $email;?></h2>
        <hr/>
    </div>

    <?php


    if(($diabetesType == "1") || (($diabetesType == "2") && ($hasUseInsulin == "true") ) ) {
        //echo "Type1";

        $providerSQL = "SELECT provider FROM insulin_plans " . $whereInsulinSQL;

        $tierSQL = "SELECT tier FROM insulin_plans " . $whereInsulinSQL;

        //select best match provider and tier
        $sql = "SELECT provider, tier FROM insulin_plans " . $whereInsulinSQL;

        //echo "<br>sql:  " . $sql;
        //echo "<br>";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {

            $planIdSQL = "SELECT plan_id, price FROM all_plans WHERE(provider = '" . $row['provider'] . "' and tier = '" . $row['tier'] . "' )";
            $planIdRes = mysqli_query($con, $planIdSQL);
            $planMatch = mysqli_fetch_array($planIdRes);

            //if user choose to create an account
            if ($createAccount) {

                //email, pw, diabetesType, slow_act_insulin, fast_act_insulin, insulin_type, pill, subscribe
                try {
                    $insert2usersSQL = "INSERT INTO users VALUES('" . $email . "', '" . $pw . "', " . $diabetesType . ", '" . $slowInsulin . "', '" . $fastInsulin . "', '" . $insulinType . "', NULL," . $notification . ")";
                    mysqli_query($con, $insert2usersSQL);
                } catch (Exception $e) {
                    ;
                }
                //echo $insert2usersSQL.'<br>';

                //get the best match plan id


                $insert2UserPlanSQL = "INSERT INTO user_plans VALUES('" . $email . "', " . $planMatch['plan_id'] . ", '" . $dateServed . "-01')";
                mysqli_query($con, $insert2UserPlanSQL);
            }

            echo '<div class="row">';
            echo '<div class="col-sm-6 col-md-4">';
            echo '<div class="thumbnail results_bottom_border">';
            echo '<h4>' . $row['provider'] . '-' . $row['tier'] . '</h4>';
            echo '<p>Price: '. $planMatch['price'].'</p>';
            echo '<div class="clearfix"></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        }
    }

    else{
        //type 2, no using insulin

        //echo "Type2";
        //if patient hasn't use insulin
        if (!$hasUseInsulin) {

            $providerSQL = "SELECT provider FROM pill_plans WHERE pill = '" . $pills . "'";
            $tierSQL = "SELECT tier FROM pill_plans WHERE pill = '" . $pills . "'";

        }



        $sql = "SELECT provider, tier FROM pill_plans WHERE pill = '" . $pills . "'";
        $res = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($res)) {

            $planIdSQL = "SELECT plan_id, price FROM all_plans WHERE(provider = '" . $row['provider'] . "' and tier = '" . $row['tier'] . "' )";
            $planIdRes = mysqli_query($con, $planIdSQL);
            $planMatch = mysqli_fetch_array($planIdRes);

            //if user choose to create an account
            if ($createAccount) {

                //email, pw, diabetesType, slow_act_insulin, fast_act_insulin, insulin_type, pill, subscribe
                try {
                    $insert2usersSQL = "INSERT INTO users VALUES('" . $email . "', '" . $pw . "', " . $diabetesType . ", ', NULL, NULL, NULL, '" . $pills . "', " . $notification . ")";
                    mysqli_query($con, $insert2usersSQL);
                } catch (Exception $e) {
                    echo "insert unsuccessful";
                }
                //echo $insert2usersSQL.'<br>';



                $insert2UserPlanSQL = "INSERT INTO user_plans VALUES('" . $email . "', " . $planMatch['plan_id'] . ", '" . $dateServed . "-01')";
                //echo $insert2UserPlanSQL;
                mysqli_query($con, $insert2UserPlanSQL);
            }


            echo '<div class="row">';
            echo '<div class="col-sm-6 col-md-4">';
            echo '<div class="thumbnail results_bottom_border">';
            echo '<h4>' . $row['provider'] . '-' . $row['tier'] . '</h4>';
            echo '<p>Price: '. $planMatch['price'].'</p>';
            echo '<div class="clearfix"></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    ?>
        <!--
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail results_bottom_border">
                        <h4>[Insurance Provider] - [Tier]</h4>
                        <p>Price: [PRICE]</p>
                        <p>Tier: [TIER]</p>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            -->
        </div>
    </section>


    <br>


    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Philly Codefest 2018</p>
        </div>
    </footer>

    <?php
        //mailer($email);
        mysqli_close($con);
    ?>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
        $(function () {
            Holder.addTheme("thumb", { background: "#55595c", foreground: "#eceeef", text: "Thumbnail" });
        });
    </script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>