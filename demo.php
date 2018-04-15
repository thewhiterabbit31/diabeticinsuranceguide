<html>
    <?php
        require 'db.php';
        $res = mysqli_query($con, 'SELECT * FROM plans;');
        $row = mysqli_fetch_array($res);
		
		$dropdown_provider;
		function retrieve($provider_arg)
		{
			global $dropdown_provider = "$provider_arg";
		}

		function dataRefresh()
		{
			
		}
        $provider = "'SELECT (global $dropdown_provider) FROM $row['provider'];'";
        $tier = $row['tier'].'</td>';
        $slow_insulin = $row['slow_act_insulin'].'</td>';
        $fast_insulin = $row['fast_act_insulin'].'</td>';
        $insulin_type = $row['insulin_type'].'</td>';
    ?>
    <select>
        <option value='Insurer1'>Insurer 1</option>
        <option value='Insurer2'>Insurer 2</option>
        <option value='Insurer3'>Insurer 3</option>
    </select>
    <button type='button'>Retrieve Provider Information</button>
    <table>
        <tr>
        </tr>
    </table>
</html>
