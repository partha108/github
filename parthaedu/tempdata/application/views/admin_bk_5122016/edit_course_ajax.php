 <select id="edit_db_course" name="batch">
	<option value='0'>----Select Course----</option>
<?php
foreach ($s as $state_name)
{
	$s_id = $state_name->course_id;
	$s1 = $state_name->course_name;
?>
	<option value='<?php echo $s1;?>' state_id="<?php echo $s_id;  ?>"><?php echo $s1;?></option>
<?php }?>
</select>
