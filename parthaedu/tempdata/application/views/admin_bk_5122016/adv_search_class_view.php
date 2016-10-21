<select id="class_id" name="add_class" onchange="add_show_batch(this.value);add_show_subject(this.value);">
    <option value="0">---Select class---</option>
    <?php foreach ($class_detail as $cls_name) {
        $cls_id = $cls_name->class_id;
        $name  = $cls_name->class_name;
    ?>
        <option value="<?php echo $name; ?>"><?php echo $name;?></option>
    <?php
    }
?>
</select>