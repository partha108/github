<select id="batch_id" name="batch_id">
    <option value="0">---Select class---</option>
    <?php foreach ($batch_detail as $batch_name) {
       // $cls_id = $batch_name->batch_id;
       // $rep_name = $batch_name->rep_batch_name;
        $name  = $batch_name->batch_name;
        ?>
        <option value="<?php echo $name; ?>"><?php echo $name;?></option>
        <?php
    }
    ?>
</select>