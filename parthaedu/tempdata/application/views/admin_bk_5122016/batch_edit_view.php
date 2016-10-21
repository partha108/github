<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />
<div id="content" class="span10">
    <!-- content starts -->

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> <?php  echo "Edit Batch"; ?></h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('emptypost');  ?>
                <?php echo $this->session->flashdata('update_message');  ?>

                <?php
                foreach($edit_batch as $eb) {
                    $c_id = $eb->course_name;
                    @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$c_id);
                   // PRINT_R($course_details);
                    ?>
                    <form method="post" action="<?php echo base_url('index.php/batch_module/edit_batch'); ?>">

                        <table class="table table-striped table-bordered responsive">

                            <tr>
                                <td>Academic Year</td>

                                <td>
                                    <input type="hidden" name="batch_id" value="<?php echo $eb->batch_id;?>">

                                    <select id="academic_year" name="edit_academic_year" onchange="course_edit(this.value);change_class(this.value);">
                                    <option value="0">---Select---</option>
                                        <?php

                                        foreach ($academic_year as $acy) {
                                            $t = $acy->academic_year;

                                            ?>
                                            <option value="<?php echo $t; ?>" <?php if($eb->session == $t){ echo "selected";}?>><?php echo $t;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Course Name</td>
                                <td><select id="db_course">
                                        <?php foreach ($s as $c){?>
                                            <option value="<?php echo $c->course_id;?>" <?php if($course_details[0]->course_name ==  $c->course_id){echo "selected";}?>><?php echo $c->course_name;?></option>
                                        <?php } ?>
                                    </select></td>
                               
                            </tr>
                            <tr>
                                <td>Class</td>
                                <td>
                                    <?php $a= explode(',',$eb->batch_class_name); ?>

                                    <select class="ms-select-all" id="mul_class" multiple name="course_class[]">

                                        <?php for($i=0;$i<count(array_filter($class));$i++) {
                                            ?>
                                            <option  value="<?php echo $class[$i]->rep_cls_name;?>" <?php for($j=0;$j<count(array_filter($a));$j++){if($class[$i]->rep_cls_name==$a[$j]){echo "selected";} }?>><?php echo $class[$i]->class_name;?></option>
                                        <?php } ?>

                                    </select>



                                </td>
                            </tr>
                            <tr>
                                <td>Batch Name</td>
                                <td><input type="text" name="edit_batch_name" value="<?php echo $eb->batch_name;?>"></td>
                            </tr>



                        </table>
                        <input type="submit" value="Update">
                        <input type="button" value="Back" onclick="javascript: window.history.back()">

                    </form>

                    <?php
                }

                ?>


            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>



<!-- -----------------------------------------success modal------------------------------------- -->

<div class="modal hide fade" id="myOKModal" style="width:300px; left:40%"> <?php echo form_open_multipart(); ?>

    <div class="modal-body">
        <h4>The Post has been Deleted !</h4>
        <div style=" float:right;">
            <button type="submit" class="btn btn-primary">ok</button>
        </div>
    </div>

    </form>
</div>

<script src="<?php echo base_url();?>custom_script/fees_validation.js"></script>
<script language="javascript" type="text/javascript">



function course_edit(id) {
    $("#db_course").load('<?php echo base_url();?>index.php/batch_module/course/'+id);
}

    function change_class(id)
    {

        $("#mul_class").load('<?php echo base_url();?>index.php/course_module/course_class/'+id);
        $(".ms-drop").load('<?php echo base_url();?>index.php/course_module/course_class_ul/'+id);
    }

</script>
<script src="<?php echo base_url();?>assets/multiple-select.js"></script>
<script>
    $(function() {
        $('#mul_class').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '32%'
        });
    });
</script>
