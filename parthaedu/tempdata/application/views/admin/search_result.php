<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#">Search Result</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Search Result</h2>
             <!--   <a href="<?php /*echo base_url()*/?>index.php/pending_list/excel"><h2 class="down">Download Excel</h2></a>--></span>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                

                <table class="table table-striped table-bordered bootstrap-datatable">
                    <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Academic Year</th>
                        <th>Roll No</th>
                        <th>Student Name</th>
                        <th>Student Mob No</th>
                        <th>Parents Mob No</th>


                        <th>Course</th>
                        <th>Class</th>
                        <th>Subject</th>

                        <th>Batch</th>

                    </tr>
                    </thead>
                    <tbody>



                    <tr>
                        <?php
                        $count = 0;
                        if(!empty($search_details))
                        {
                            foreach(@$search_details as $pd)
                            {
                        //echo "<pre>";
                       // print_r($pd);
                        $course_name = $pd->course_name;
                        @$course_details = $this->common_model->add_course_data('tbl_course','course_id',$course_name);
                        //print_r($course_details);
                                $count = $count+1;
                        ?>
                            <td><?php echo $count; ?></td>
                            <td><?php echo @$pd->academic_year;?></td>
                            <td><?php echo @$pd->roll_no;?></td>
                            <td><?php echo @$pd->first_name." ".$pd->last_name;  ?></td>
                            <td><?php echo @$pd->student_phone_no;?></td>
                            <td><?php echo @$pd->guardian_mobile_no."/<br>".@$pd->guardian_phone_no;?></td>

                            <td><?php echo $course_details[0]->course_name;?></td>
                            <td> <?php echo @$pd->class_name; ?></td>
                            <td><?php echo @$pd->subject_name;?></td>
                            <td><?php echo @$pd->batch_name;?></td>

                        </tr>

                    <?php
                        }
                    }else
                    {
                    ?>
                        <td colspan="8" align="center"><?php echo "<b>no record found";?></td>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>


                    <tr>
                        <td colspan="8"><div id="pagination_container"> <?php //echo @$msg; ?> </div></td>
                    </tr>
                </table>

            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>


</div>
<script>
    function open_payment_view(id){
        window.location = base_url+'index.php/studentlist/add_student_to_payment_view/'+id;
    }
</script>
<script language="javascript" type="text/javascript">

    function pagination_select(value,id)
    {

        var str='<?php echo @$page_str ;?>';
        if(value.trim())
        {
            if(value.trim())
            {

                window.location = base_url+'index.php/pending_list?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/pending_list?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/pending_list?'+id+'='+value;
        }

    }


    function page_func(id)
    {
        //alert('0o');
        loadData(id);
    }

    $('#go_btn').live('click',function(){
        var page = parseInt($('.goto').val());
        var no_of_pages = parseInt($('.total').attr('a'));
        if(page != 0 && page <= no_of_pages){
            loadData(page);
        }
        else
        {
            //alert('Enter a PAGE between 1 and '+no_of_pages);
            $('.goto').val("").focus();
            return false;
        }

    });
</script>

