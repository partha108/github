<?php foreach($s as $sc) {
    $aa = $sc->batch_name;
    ?>
    <li><input type="checkbox" name="search_batch[]" value="<?php echo $sc->rep_batch_name;?>"><?php echo $aa;?></li>
<?php }?>

<!--</select>-->
