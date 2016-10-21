<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Search</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Search</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <div>
                </div>
                <form method="post" action="<?php echo base_url('index.php/search/result'); ?>">
                <table class="table table-striped table-bordered responsive">
                    <tr>
                        <th>Acadamic Year</th>
                        <td>
                            <select name="search_acc_year" id="search_acc_year" onchange="add_show_course(this.value)">
                                <option value="0">---Select Acadamic Year</option>
                                <?php
                                foreach ($academic_year as $item) {
                                    ?>
                                    <option value="<?php echo $item->academic_year;?>"><?php echo $item->academic_year;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Course</th>
                        <td><select id="edit_db_course" name="search_course" onchange="add_show_class(this.value);">
                                <option value="0">---Select Course---</option>

                            </select>
                            </td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td><select id="class_id" name="search_class" onchange="add_show_batch(this.value);add_show_subject(this.value);">
                                <option value="0">---Select class---</option>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td><select id="sub_id" class="sub_id" name="search_subject" onchange="subject_id_details(this.value);">>
                                <option value="0">---Select Subject---</option>
                            </select></td>
                    </tr>


                    <tr>
                        <th>Batch</th>
                        <td><select id="batch_id" name="search_batch">
                                <option value="0">---Select Batch---</option>
                            </select></td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"  ><input type="submit" name="sub" value="search"> </td>
                    </tr>


                </form>
                </table>

            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<?php $tags= json_encode($where);?>

<script>
    $(function() {

        var  availableTags= <?php echo $tags; ?>;
        $("#search_name1").autocomplete({

            source: availableTags,
            autoFocus:true
        });
    });


   /* function add_show_course(id)
    {

        $("#edit_db_course").load('<?php echo base_url();?>index.php/subject_module/add_course_model/'+id);
        $("#class_id").load('<?php echo base_url();?>index.php/search/add_class/'+id);
        $("#sub_id").load('<?php echo base_url();?>index.php/search/add_subject/'+id);
        $("#batch_id").load('<?php echo base_url();?>index.php/search/add_batch/'+id);

    }*/
    function add_show_course(id)
    {
        // alert(id);
        $("#edit_db_course").load('<?php echo base_url();?>index.php/subject_module/add_course_model/'+id);
        $('#subject_fee').val('0');
        $('#reg_fee_show').val('0');
    }

    function add_show_class(id)
    {
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_class/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                //alert(data)
                //var obj =JSON.parse(data);

                //$('#reg_fee_show').val(obj.amount);

                $("#class_id").load('<?php echo base_url();?>index.php/studentlist/add_class/'+id);
            }
        });

    }

    function add_show_subject(id)
    {
        var acc_value = $('#add_ac_year').val();
        var course_value = $('#edit_db_course').val();
        //var class_value = $('#class_id').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_subject/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,course_value:course_value},
            success: function (data) {
                //alert(data)


                $("#sub_id").load('<?php echo base_url();?>index.php/studentlist/add_subject/'+id);
                //$("#batch_id_0").load('<?php echo base_url();?>index.php/studentlist/add_batch/'+id);


            }
        });

    }

    function add_show_batch(id)
    {
        var acc_value = $('#add_ac_year').val();
        var course_value = $('#edit_db_course').val();
        //var class_value = $('#class_id').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_batch/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,course_value:course_value},
            success: function (data) {
                //alert(data)
                //$("#sub_id_0").load('<?php echo base_url();?>index.php/studentlist/add_subject/'+id);
                $("#batch_id").load('<?php echo base_url();?>index.php/studentlist/add_batch/'+id);


            }
        });

    }

</script>