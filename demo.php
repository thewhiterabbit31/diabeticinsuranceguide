<html>
    <table>
        <tr>
            <?php
            require 'db.php';
            $res = mysqli_query($con, 'select * from plans;');
            $row = mysqli_fetch_array($res);

            echo '<td>'.$row['provider'].'</td>';
            echo '<td>'.$row['tier'].'</td>';
            echo '<td>'.$row['slow_act_insulin'].'</td>';
            echo '<td>'.$row['fast_act_insulin'].'</td>';
            echo '<td>'.$row['insulin_type'].'</td>';
            ?>
        </tr>
    </table>
</html>
