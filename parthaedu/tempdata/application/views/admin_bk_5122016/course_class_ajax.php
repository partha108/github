<!--<select class="ms-select-all" id="mul_class" multiple name="course_class[]">-->
<?php foreach($class as $item) {
?>
<li><input type="checkbox" name="chkbox[]" value="<?php echo $item->rep_cls_name;?>"><?php echo $item->class_name;?></li>
                  <?php } ?>

<!--</select>-->