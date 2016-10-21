<ul style="max-height: 250px;">

<?php
foreach($class as $item) {?>
<li class="" style="false">
<label class="">
<input type="checkbox" data-name="selectItem" value="<?php echo $item->class_name;?>" name="chkbox[]">
<span><?php echo $item->class_name;?></span>
</label>
<?php }?>
</li>
<li class="ms-no-results" style="display: none;">No matches found</li>
</ul>