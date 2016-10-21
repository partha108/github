<?php foreach($class as $item) {
    $aa = $item->class_name;

    $a = explode(',',$aa);

    for($i=0;$i<count($a);$i++){


?>
    <li><input type="checkbox" name="chkbox[]" value="<?php echo $a[$i];?>"><?php echo $a[$i];?></li>
                  <?php } }?>

<!--</select>-->