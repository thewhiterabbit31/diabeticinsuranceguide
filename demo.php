<html>
    <?php
        require 'db.php';
        $res = mysqli_query($con, 'select * from plans;');
        $row = mysqli_fetch_array($res);

        $provider = $row['provider'].'</td>';
        $tier = $row['tier'].'</td>';
        $slow_insulin = $row['slow_act_insulin'].'</td>';
        $fast_insulin = $row['fast_act_insulin'].'</td>';
        $insulin_type = $row['insulin_type'].'</td>';
    ?>
    <select>
        <option>Insurer 1</option>
        <option>Insurer 2</option>
        <option>Insurer 3</option>
    </select>
    <button type='button'>Retrieve Provider Information</button>
    <table>
        <tr>
        </tr>
    </table>
</html>
