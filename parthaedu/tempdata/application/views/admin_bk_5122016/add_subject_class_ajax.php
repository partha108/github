<select id="class_id" name="add_sub_class">
<option value="0">---Select Class---</option>
<?php foreach($s as $sc) {
    $aa = $sc->class_name;
    $a = explode(",",$aa);
    //print_r($a);
    for($i=0;$i<count(array_filter($a));$i++){
        ?>
        <option value="<?php echo $a[$i];?>"><?php echo $a[$i];?></option>

    <?php }} ?>