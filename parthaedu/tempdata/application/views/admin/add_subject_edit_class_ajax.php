<?php
foreach($s as $sc)
{
    ?>
    <!--  <li><input type="checkbox" name="chkbox[]"><?php /*echo $sc->class_name; */?></li>
--><?php
}
?>

<?php foreach($s as $sc) {
    $aa = $sc->class_name;
    $a = explode(",",$aa);
    //print_r($a);
    for($i=0;$i<count(array_filter($a));$i++){
        ?>
        <!-- <option value="<?php /*echo $item->class_name;*/?>"><?php /*echo $item->class_name;*/?></option>-->


        <li><input type="radio" name="course_class1[]" value="<?php echo $a[$i];?>" id="<?php echo $a[$i];?>"><?php echo $a[$i];?></li>
    <?php }} ?>