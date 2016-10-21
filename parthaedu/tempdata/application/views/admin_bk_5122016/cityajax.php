<select name="city" id="city">
	<option value='0'>----Select City----</option>
<?php
foreach ($s as $state_name)
{
	$s1 = $state_name->city;
?>
	<option value='<?php echo $s1;?>'><?php echo $s1;?></option>
<?php }?>
</select>
