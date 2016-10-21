<!--<select class="ms-select-all" id="selectclassbyacademic" multiple name="course_class1[]">-->
    <?php foreach($s as $item) {
        $aa = $item->class_name;
        $a = explode(",",$aa);
        //print_r($a);
        for($i=0;$i<count(array_filter($a));$i++){
        ?>
       <!-- <option value="<?php /*echo $item->class_name;*/?>"><?php /*echo $item->class_name;*/?></option>-->


        <li><input type="checkbox" name="course_class1[]" value="<?php echo $a[$i];?>"><?php echo $a[$i];?></li>
    <?php }} ?>

<!--</select>-->