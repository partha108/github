<select id="sub_id" class="sub_id" name="add_subject">
    <option value="0">---Select class---</option>
    <?php foreach ($sub_detail as $sub_name) {
       // $cls_id = $sub_name->subject_id;
        $name  = $sub_name->subject_name;
        ?>
        <option value="<?php echo $name; ?>"><?php echo $name;?></option>
        <?php
    }
    ?>
</select>