<ul style="max-height: 250px;">

    <?php
    foreach($s as $item) {?>
    <li class="" style="false">
        <label class="">
            <input type="checkbox" data-name="selectItem" value="<?php echo $item->class_name;?>" name="course_class1[]">
            <span><?php echo $item->class_name;?></span>
        </label>
        <?php }?>
    </li>

</ul>