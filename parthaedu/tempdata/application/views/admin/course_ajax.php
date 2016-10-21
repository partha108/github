 <select id="db_course" name="batch">
	<option value='0'>----Select Course----</option>
<?php
foreach ($s as $state_name)
{
	$s_id = $state_name->course_id;
	$s1 = $state_name->course_name;
	$s2 = $state_name->replace_course
?>
	<option value='<?php echo $s_id;?>'><?php echo $s1;?></option>
<?php }?>
</select>
