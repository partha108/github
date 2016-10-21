<option value="0">---Select Batch---</option>
<?php foreach($s as $sc) {  ?>
    <option value="<?php echo $sc->rep_batch_name ?>"><?php echo $sc->batch_name ?></option>
<?php } ?>