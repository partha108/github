<?php foreach($s as $sc) {
    $aa = $sc->subject_name;
        ?>
        <li><input type="checkbox" name="search_subject[]" value="<?php echo $sc->subject_id;;?>"><?php echo $aa;?></li>
    <?php }?>

<!--</select>-->
