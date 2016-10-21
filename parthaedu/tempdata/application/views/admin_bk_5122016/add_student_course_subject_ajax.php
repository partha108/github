<option value="0">---Select subject---</option>
<?php foreach($s as $sc) { ?>
    <option value="<?php echo $sc->subject_id; ?>"><?php echo $sc->subject_name; ?></option>
<?php } ?>