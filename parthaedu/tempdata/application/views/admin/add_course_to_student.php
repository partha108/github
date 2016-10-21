
<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />
<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Add Course</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Add Course</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <form method="post" action="<?php echo base_url('index.php/studentlist/add_course_to_student') ?>">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                       <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                        <tr>
                            <td>Academic Year</td>
                            <td><select  name="add_ac_year" id="add_ac_year" onchange="add_show_course(this.value)" >
                                    <option value="0">---Select Academic Year---</option>
                                    <?php
                                        foreach ($academic_year as $item) {
                                    ?>
                                        <option value="<?php echo $item->academic_year;?>"><?php echo $item->academic_year;?></option>
                                    <?php
                                        }
                                    ?>
                                </select>  </td>
                            <td>Course</td>
                            <td><select id="edit_db_course" name="add_course" onchange="add_show_class(this.value);">
                                    <option value="0">---Select Course---</option>

                                </select>
                                <input type="hidden" id="reg_fee_show" name="reg_fee">
                                <input type="hidden" id="reg_fee_vat" name="reg_fee_vat">
                                <input type="hidden" id="reg_fee_vat_amt" name="reg_fee_vat_amt">
                                <input type="hidden" id="reg_fee_tot_amt" name="reg_fee_tot_amt"></td>


                            <td>Class</td>
                            <td><select id="class_id" name="add_class" onchange="add_show_batch(this.value);add_show_subject(this.value);">
                                    <option value="0">---Select class---</option>
                                </select>
                                <input type="hidden" id="exam_fee_show" name="exam_reg_fee">
                                <input type="hidden" id="exam_fee_vat" name="exam_fee_vat">
                                <input type="hidden" id="exam_fee_vat_amt" name="exam_fee_vat_amt">
                                <input type="hidden" id="exam_fee_tot_amt" name="exam_fee_tot_amt">
                            </td>
</tr>
</table>
                    <a href="#" title="" class="add-author"><button>Add</button></a>
                    <script>
                        var counter = 1;

                        jQuery('a.add-author').click(function(event){

                            event.preventDefault();
                            var optionValue='';
                            var optionIdText='';
                            var strr='';
                            var strr1='';
                            $("#sub_id_0 option").each(function()
                            {
                                optionValue= $(this).val() ;
                                optionIdText=$(this).text();
                                strr+='<option value="'+optionValue+'">'+optionIdText+'</option>';
                            });

                            $("#batch_id_0 option").each(function()
                            {
                                optionValue= $(this).val() ;
                                optionIdText=$(this).text();
                                strr1+='<option value="'+optionValue+'">'+optionIdText+'</option>';
                            });
                            counter++;


                            var newRow = '<tr><td>Subject Name</td><td><select id="sub_id_'+counter+'" name="add_subject[]" onchange="subject_id_details('+counter+',this.value);sub_fee('+counter+',this.value);sub_payment_detils('+counter+',this.value);sub_payment_amt('+counter+',this.value);sub_payment_to_date('+counter+',this.value);sub_payment_frm_date('+counter+',this.value);sub_payment_vat('+counter+',this.value);sub_payment_vat_amt('+counter+',this.value);sub_payment_total_amt('+counter+',this.value);" >';
                            newRow += strr;
                            newRow += '</select></td>';
                            newRow += '<td style="display: none" id="subject_id_details_'+counter+'"></td>';
                            newRow += '<td style="display: none" id="payment_head_details_'+counter+'"></td>';
                            newRow +='<td style="display: none" id="payment_head_details_amt_'+counter+'"></td>';
                            newRow +=' <td style="display: none" id="payment_head_details_vat_'+counter+'"></td>';
                            newRow +='<td style="display: none"  id="payment_head_details_vat_amt_'+counter+'"></td>';
                            newRow +='<td style="display: none"  id="payment_head_details_total_amt_'+counter+'"></td>';
                            newRow +='<td style="display: none"  id="payment_head_details_to_dt_'+counter+'"></td>';
                            newRow +='<td style="display: none" id="payment_head_details_frm_dt_'+counter+'"></td>';
                            newRow += '<td>Batch</td><td><select id="batch_id_'+counter+'" name="batch_id[]" >';
                            newRow += strr1;
                            newRow += '</select><i class="icon-minus removee" onclick="rm_tr()"></i></td>';

                           // newRow += '<td><input type="text" id="frm_dt_'+counter+'" name="frm_dt[]" class="from_date" style="width:72%"></td>';
                            //newRow += '<td><input type="text" id="to_dt_'+counter+'" name="to_dt[]" class="to_date" style="width:72%"> </td>';
                           // newRow += '<td><input type="text" id="describ_'+counter+'" name="describ[]" style="width:72%"><i class="icon-minus removee"></i></td>';
                           // newRow += '<td><div class="removee">Remove</div></td>';
                            jQuery('table.authors-list').append(newRow);
                        });
                        function rm_tr()
                        {
                            //alert('hi');
                            $('table').on('click', '.removee', function(){
                                $(this).closest('tr').remove();
                            });
                        }
                    </script>
                    <style>
                        .removee{cursor:pointer;}
                    </style>

                    <table class="table table-striped table-bordered bootstrap-datatable datatable authors-list">

                        <tr>

                            <td>Subject Name</td>
                            <td><select id="sub_id_0" class="sub_id" name="add_subject[]" onchange="subject_id_details(0,this.value);sub_fee(0,this.value);sub_payment_detils(0,this.value);sub_payment_amt(0,this.value);sub_payment_vat(0,this.value);sub_payment_vat_amt(0,this.value);sub_payment_total_amt(0,this.value);sub_payment_to_date(0,this.value);sub_payment_frm_date(0,this.value); /*add_show_subject_fees(this.value)*/">
                                    <option value="0">---Select Subject---</option>
                                </select>

                            </td>
                            <td id="subject_id_details_0" style="display: none"></td>

                            <td id="payment_head_details_0" style="display: none"></td>
                            <td id="payment_head_details_amt_0" style="display: none"></td>
                            <td id="payment_head_details_vat_0" style="display: none"></td>
                            <td id="payment_head_details_vat_amt_0" style="display: none"></td>
                            <td id="payment_head_details_total_amt_0" style="display: none"></td>
                            <td id="payment_head_details_to_dt_0" style="display: none"></td>
                            <td id="payment_head_details_frm_dt_0" style="display: none"></td>

                            <td>Batch</td>
                            <td><select id="batch_id_0" name="batch_id[]">
                                    <option value="0">---Select Batch---</option>
                                </select></td>

                        </tr>


                    </table>
                    <input type="submit" value="Save">
                    <input type="button" value="Back" onclick="javascript: window.history.back();">

                </form>

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
        <div style=" float:center;">
            <button type="submit" class="btn btn-primary">ok</button>
        </div>
    </div>

    </form>
</div>


<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
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


                $("#sub_id_0").load('<?php echo base_url();?>index.php/studentlist/add_subject/'+id);
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
                $("#batch_id_0").load('<?php echo base_url();?>index.php/studentlist/add_batch/'+id);


            }
        });

    }

</script>
<script>


    function chkboxsubject_id(id) {

        $(document).ready(function(){
            $('input[type="checkbox"]').click(function()
            {
                var reg_fee=document.getElementById('reg_fee_show');
                var reg_amt = reg_fee.value;
                var val = parseInt(reg_amt);

                $('input[type="checkbox"]:checked').each(function(){
                    val+=parseInt($(this).val());
                });

                $("#subject_fee").val(val);
            });
        });





       /* var i=0;
        var arr = [];
        $('.ads_Checkbox:checked').each(function () {
            //alert( $(this).val());
           arr[i++] = $(this).val();
            //var a = $(this).val();
        });
        //var sel = a;

        var sel = arr.join();
        //alert(sel);
        var acc_value = $('#add_ac_year').val();
        var course_id = $('#edit_db_course').val();
        var class_id = $('#class_id').val();
        var reg_fees = $('#reg_fee_show').val();
        $.ajax({
                url: "<?php echo base_url();?>index.php/studentlist/subject_amount",
                type: "POST",
                dataType:'json',
                data: {acc_value:acc_value,course_id:course_id,class_id:class_id,sel:sel},
        success: function (data) {
            //if(this.checked) {
                if ($('#subject_fee').val().trim() == '') {
                    var total_val = 0;
                }
                else {
                    var total_val = $('#subject_fee').val();
                }

                var tat =  parseFloat(data.total_amount);
            var total_amount = parseFloat(data.total_amount)+parseFloat(total_val);

            $('#subject_fee').val(total_amount);

        }


    });

   // })*/

    }





   $("#edit_db_course").on("change", function(e) {
        var course_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_reg_amount",
            type: "POST",
            dataType:'text',
            data: {course_id:course_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#reg_fee_show').val(obj.amount);
            }
        });
    });
    $("#edit_db_course").on("change", function(e) {
        var course_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_reg_amt_vat",
            type: "POST",
            dataType:'text',
            data: {course_id:course_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#reg_fee_vat').val(obj.amount);
            }
        });
    });
    $("#edit_db_course").on("change", function(e) {
        var course_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_reg_vat_amt",
            type: "POST",
            dataType:'text',
            data: {course_id:course_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#reg_fee_vat_amt').val(obj.amount);
            }
        });
    });
    $("#edit_db_course").on("change", function(e) {
        var course_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_reg_total_amt",
            type: "POST",
            dataType:'text',
            data: {course_id:course_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#reg_fee_tot_amt').val(obj.amount);
            }
        });
    });



    $("#class_id").on("change", function(e) {
        var acc_value = $('#add_ac_year').val();

        //alert(acc_value);
        var class_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_exam_fee",
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,class_id:class_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#exam_fee_show').val(obj.amount);
            }
        });
    });

    $("#class_id").on("change", function(e) {
        var acc_value = $('#add_ac_year').val();

        //alert(acc_value);
        var class_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_exam_vat",
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,class_id:class_id},
            success: function (data) {
               // alert(data)
                obj = JSON.parse(data);

                $('#exam_fee_vat').val(obj.amount);
            }
        });
    });

    $("#class_id").on("change", function(e) {
        var acc_value = $('#add_ac_year').val();

        //alert(acc_value);
        var class_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_exam_vat_amt",
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,class_id:class_id},
            success: function (data) {
               // alert(data)
                obj = JSON.parse(data);

                $('#exam_fee_vat_amt').val(obj.amount);
            }
        });
    });

    $("#class_id").on("change", function(e) {
        var acc_value = $('#add_ac_year').val();

        //alert(acc_value);
        var class_id = this.value;


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_exam_tot_amt",
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value,class_id:class_id},
            success: function (data) {
                //alert(data)
                obj = JSON.parse(data);

                $('#exam_fee_tot_amt').val(obj.amount);
            }
        });
    });

    function sub_fee(id,value) {
        //alert(value);
        /*$("#sub_id_0").on("change", function (e) {*/
            var acc_value = $('#add_ac_year').val();
            var course_value = $('#edit_db_course').val();
            var class_value = $('#class_id').val();

           // var sub_id = this.value;
        var sub_id = value;
            //alert(sub_id);

            $.ajax({
                url: "<?php echo base_url();?>index.php/studentlist/subject_amount",
                type: "POST",
                dataType: 'text',
                data: {acc_value: acc_value, course_value: course_value, sub_id: sub_id, class_value: class_value},
                success: function (data) {
                    //alert(data)
                    obj = JSON.parse(data);

                    $('#subject_fees_'+id).val(obj.total_amount);
                }
            });
        /*});*/
    }


    function subject_id_details(id,value)
    {
        //alert(value);
        var sub_id = value;
        //alert(sub_id);


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_subject_id",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                //alert(data)

                var arr_sub_id = Object.keys(data).length;
                var html_str_sub_id ='';
                for (i = 0; i < arr_sub_id; i++)
                {
                    var xyz = data[i].subject_id;

                    html_str_sub_id+= '<input type="text" name= "subject_id_detail[]" value="'+xyz+'">';
                }
                $('#subject_id_details_'+id).html(html_str_sub_id);
            }
        });
    }

    function sub_payment_detils(id,value)
    {
        //alert(value);
        var sub_id = value;
        //alert(sub_id);


        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arr = Object.keys(data).length;
                var html_str ='';
                for (i = 0; i < arr; i++)
                {
                    var xyz = data[i].payment_head;
                    html_str+= '<input type="text" name= "payment_detail[]" value="'+xyz+'">';
                }
                $('#payment_head_details_'+id).html(html_str);
            }
        });
    }

   function sub_payment_amt(id,value)
   {
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_amt",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arrr = Object.keys(data).length;

                var html_strr ='';
                for (i = 0; i < arrr; i++)
                {
                    var xyzz = data[i].payment_head_amt;
                     html_strr+= '<input type="text" name= "payment_detail_amt[]" value="'+xyzz+'">';
                }
                $('#payment_head_details_amt_'+id).html(html_strr);
            }
        });
   }


    function sub_payment_vat(id,value)
    {
        //alert(id)
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_vat",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arr_vat = Object.keys(data).length;

                var html_str_vat ='';
                for (i = 0; i < arr_vat; i++)
                {
                    var xyzz = data[i].payment_head_vat;
                    html_str_vat+= '<input type="text" name= "payment_detail_vat[]" value="'+xyzz+'">';
                }
                $('#payment_head_details_vat_'+id).html(html_str_vat);
            }
        });
    }

    function sub_payment_vat_amt(id,value)
    {
        //alert(id)
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_vat_amt",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arr_vat_amt = Object.keys(data).length;

                var html_str_vat_amt ='';
                for (i = 0; i < arr_vat_amt; i++)
                {
                    var xyzz = data[i].payment_head_vat_amt;
                    html_str_vat_amt+= '<input type="text" name= "payment_detail_vat_amt[]" value="'+xyzz+'">';
                }
                $('#payment_head_details_vat_amt_'+id).html(html_str_vat_amt);
            }
        });
    }


    function sub_payment_total_amt(id,value)
    {
        //alert(id)
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_total_amt",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arr_tot_amt = Object.keys(data).length;

                var html_str_tot_amt ='';
                for (i = 0; i < arr_tot_amt; i++)
                {
                    var xyzz = data[i].	payment_head_total_amt;
                    html_str_tot_amt+= '<input type="text" name= "payment_detail_tot_amt[]" value="'+xyzz+'">';
                }
                $('#payment_head_details_total_amt_'+id).html(html_str_tot_amt);
            }
        });
    }


    function sub_payment_to_date(id,value)
    {
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_to_date",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arrrr = Object.keys(data).length;

                var html_strrr ='';
                for (i = 0; i < arrrr; i++)
                {
                    var xyzzz = data[i].payment_head_to_dt;
                    html_strrr+= '<input type="text" name= "payment_detail_to_date[]" value="'+xyzzz+'">';
                }
                $('#payment_head_details_to_dt_'+id).html(html_strrr);
            }
        });
    }

    function sub_payment_frm_date(id,value)
    {
        var sub_id = value;

        $.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/subject_payment_details_frm_date",
            type: "POST",
            dataType: 'json',
            data: {sub_id: sub_id},
            success: function (data)
            {
                var arr_frm = Object.keys(data).length;

                var html_str_frm ='';
                for (i = 0; i < arr_frm; i++)
                {
                    var xyzzz = data[i].payment_head_frm_dt;
                    html_str_frm+= '<input type="text" name= "payment_detail_frm_date[]" value="'+xyzzz+'">';
                }
                $('#payment_head_details_frm_dt_'+id).html(html_str_frm);
            }
        });
    }





    function  chkbox_id(id)
    {
        //var class_id = id;
        var acc_year = $('#add_ac_year').val();
        //alert(acc_year)
        //$("#subject_id").load('<?php echo base_url();?>index.php/studentlist/add_subject/?acc_year='+acc_year+id);
        $('#subject_id').html('');
        jQuery.ajax({
            url: "<?php echo base_url();?>index.php/studentlist/add_subject/",
            data:{id:id,acc_year:acc_year},
            type: "POST",
            success:function(data){
                //alert(data)
                $('#subject_id').html(data);
            }
        });

    }





</script>
<script src="<?php echo base_url();?>assets/multiple-select.js"></script>
<script>
    $(function() {
        $('#selectclassbyacademic').change(function() {
            console.log($(this).val());
        }).multipleSelect({
            width: '64%'
        });
    });
</script>
