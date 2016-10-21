<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
            <li> <a href="#"> Edit Subject</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Edit Subject</h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('update_message');  ?>
                <form method="post" action="<?php echo base_url('index.php/subject_module/edit_subject') ?>">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <tr>
                            <th>Academic Year</th>
                            <th>Course</th>
                            <th>Class</th>
                            <th>Subject Name</th>
                        </tr>
                        <tr>
                            <?php
                            foreach($edit_sub as $res){

                            ?>
                            <td>
                                <input type="hidden" name="subject_id" value="<?php echo $res->subject_id; ?>">
                                <select id="add_ac_year" name="add_ac_year" onchange="add_show_course(this.value);add_show_vat(this.value)">

                                    <?php
                                    foreach ($academic_year as $item)
                                    {
                                        $ac = $item->academic_year;
                                        ?>
                                        <option value="<?php echo $ac?>" <?php if($res->academic_year == $ac){ echo "selected";}?>><?php echo $ac?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            <td>
                                <select id="edit_db_course" name="add_course" onchange="add_show_class(this.value);show_course_amt(this.value);show_course_vat(this.value);show_course_vat_amt(this.value);show_course_tot_amt(this.value);">
                                    <?php
                                    foreach ($course as $course_list)
                                    {
                                       echo $cl = $course_list->course_name;
                                        ?>
                                        <option value="<?php echo $course_list->course_id;?>" <?php if($res->course_name_by_subject == $cl){ echo "selected";}?>><?php echo $cl?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <input type="text" style="display: none" id="course_amt" name="course_amt" value="<?php echo $res->course_fee;?>">
                                <input type="text" style="display: none" id="course_vat" name="course_vat" value="<?php echo $res->course_vat;?>">
                                <input type="text" style="display: none" id="course_vat_amt" name="course_vat_amt" value="<?php echo $res->course_vat_amt;?>">
                                <input type="text"  style="display: none" id="course_tot_amt" name="course_tot_amt" value="<?php echo $res->course_tot_amt;?>" >
                            </td>

                            <td>
                                <select id="class_id" name="add_sub_class">
                                    <?php


                                    foreach ($Classes as $class_list)
                                    {
                                        $cls = $class_list->class_name;

                                        $a = explode(",",$cls);
                                        for($i=0;$i<count($a);$i++)
                                        {

                                            ?>
                                            <option value="<?php echo $a[$i]?>" <?php if($res->class_name == $a[$i]){ echo "selected";}?>><?php echo $a[$i]?></option>
                                            <?php
                                        }}
                                    ?>
                                </select>
                            </td>

                            <td><input type="text" name="add_subject" value="<?php echo $res->subject_name; ?>"></td>



                        </tr>
                    </table>
                   





                    <a href="#" title="" class="add-author"><button>Add</button></a>


                    <table class="table table-striped table-bordered bootstrap-datatable datatable authors-list">
                        <tr>
                            <th style="width: 12%">Payment Head</th>
                            <th style="width: 12%">Amount</th>
                            <th style="width: 12%">Vat</th>
                            <th style="width: 12%">Total Amount</th>
                            <th style="width: 10%">from Data</th>
                            <th style="width: 10%">To Date</th>
                            <th style="width: 12%">Description</th>
                            <!-- <th style="width: 12%"></th> -->
                        </tr>
                        <div class="test1" id="addHotel_0">
                            <?php
                            $c = 0;
                            foreach($payment_head as $ph) {
                                //echo $ph->payment_head;
                                //print_r($payment_head);
                                ?>
                                <tr>
                                    <td><select id="payment_head_<?php echo $c;?>" name="payment_head[]" style="width:90%">

                                            <?php foreach($payment as $phy) {
                                                $p = $phy->payment_head_name;
                                                $p_id = $phy->payment_id;
                                                ?>
                                                <option
                                                    value="<?php echo $p_id; ?>"<?php if($ph->payment_head == $p_id){echo "selected";} ?> ><?php echo $p;?></option>
                                            <?php } ?>
                                        </select></td>

                                    <td><input type="text" autocomplete="off" id="ammount_<?php echo $c;?>" name="amount[]" style="width:72%" value="<?php echo $ph->payment_head_amt; ?>" onkeyup="show_total_amount(<?php echo $c;?>);"></td>
                                    <td><input type="text"  readonly name="vat[]" class="vat" id="vat_<?php echo $c;?>" style="width:72%;" value="<?php echo $ph->payment_head_vat;?>"><span>%</span>
                                        <input type="text" readonly name="vat_amt[]"  id="vat_amt_<?php echo $c;?>" style="width:72%" value="<?php echo $ph->payment_head_vat_amt; ?>"> </td>
                                    <td><input type="text" id="total_ammount_<?php echo $c;?>" name="total_amount[]" class="sub_fee" autocomplete="off" style="width:72%" value="<?php echo $ph->payment_head_total_amt;?>"></td>
                                    <td><input type="text" class="from_date" id="frm_dt_<?php echo $c;?>" name="frm_dt[]"
                                               style="width:72%" value="<?php echo $ph->payment_head_frm_dt; ?>"></td>

                                    <td><input type="date" id="to_dt_<?php echo $c;?>" name="to_dt[]" class="to_date"
                                               style="width:72%" value="<?php echo $ph->payment_head_to_dt; ?>"></td>
                                    <td><input type="text" id="describ_<?php echo $c;?>" name="describ[]" style="width:72%" value="<?php echo $ph->payment_head_des; ?>"><?php if($c>0){?><i class="icon-minus removee"></i><?php } ?></td>

                                    <!-- <td><div class="removee" >Remove</div></td> -->

                                </tr>
                                <?php
                                $c++;
                            }
                            echo "<input type='hidden' id='last_id' value='$c'>";
                            ?>
                        </div>



                    </table>
                    <?php } ?>
                    <input type="submit" value="Update">
                    <input type="button" value="Back" onclick="javascript: window.history.back();">

                </form>

            </div>



        </div>
        <!--/span-->

    </div>
    <!--/row-->

    <!-- content ends -->
</div>


<!------------------------------------------------Add Subject---------------------------------------------------------->
</div>
<style>
    .removee{cursor:pointer;}
</style>
<script>
    function add_show_course(id)
    {
        $("#edit_db_course").load('<?php echo base_url();?>index.php/subject_module/add_course_model/'+id);

    }
    function add_show_vat(id)
    {
        //alert(id)
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_vat/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                //alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('.vat').val(obj.amount);



            }
        });




        //$("#edit_db_course").load('<?php echo base_url();?>index.php/subject_module/add_course_model/'+id);
    }
    function add_show_class(id)
    {
        //alert(id);

        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_class/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                //alert(data)

                $("#class_id").load('<?php echo base_url();?>index.php/subject_module/add_class/'+id);
            }
        });
        //$("#class_id").load('<?php echo base_url();?>index.php/subject_module/add_class/'+id);
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



<script>
    var counter = $('#last_id').val();
    jQuery('a.add-author').click(function(event){

        event.preventDefault();
        var optionValue='';
        var optionIdText='';
        var strr='';
        $("#payment_head_0 option").each(function()
        {
            optionValue= $(this).val() ;
            optionIdText=$(this).text();
            strr+='<option value="'+optionValue+'">'+optionIdText+'</option>';
        });
        //show_course_vat(this.value);show_course_vat_amt(this.value);
        var vat_amt = $("#vat_0").val();
        counter++;
        var newRow = '<tr><td><select id="payment_head_'+counter+'" name="payment_head[]" style="width:90%" >';
        newRow += strr;
        newRow += '</select></td>';
        newRow += '<td><input type="text" autocomplete="off"  id="ammount_'+counter+'" name="amount[]" style="width:72%" onkeyup="show_total_amount('+counter+');"></td>';
        newRow += '<td><input type="text" readonly name="vat[]" class="vat" id="vat_'+counter+'" value="'+vat_amt+'" style="width:72%" ><span>%</span><input type="text" readonly name="vat_amt[]"  id="vat_amt_'+counter+'" style="width:72%" > </td>';
        newRow += '<td><input type="text" id="total_ammount_'+counter+'" name="total_amount[]" class="sub_fee" autocomplete="off" style="width:72%"></td>';
        newRow += '<td><input type="text" id="frm_dt_'+counter+'" name="frm_dt[]" class="from_date" style="width:72%"></td>';

        newRow += '<td><input type="text" id="to_dt_'+counter+'" name="to_dt[]" class="to_date" style="width:72%"> </td>';
        newRow += '<td><input type="text" id="describ_'+counter+'" name="describ[]" style="width:72%"><i class="icon-minus removee"></i></td>';
        // newRow += '<td><div class="removee">Remove</div></td>';
        jQuery('table.authors-list').append(newRow);
    });
    $('table').on('click', '.removee', function(){
        $(this).closest('tr').remove();
    });

</script>

<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!-- Javascript -->

<script type="text/javascript">
    $(function() {

        $(document).on("click",".from_date",function(){

            $(this).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            }).datepicker("show");
        });

    });


    $(function() {

        $(document).on("click",".to_date",function(){

            $(this).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
            }).datepicker("show");
        });

    });



    function show_course_amt(id)
    {
        //alert(id);
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_course_fee/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                //alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('#course_amt').val(obj.amount);
            }
        });

    }

    function show_course_vat(id)
    {
        //alert(id);
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_course_vat/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                //alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('#course_vat').val(obj.amount);
            }
        });

    }

    function show_course_vat_amt(id)
    {
        //alert(id);
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_course_vat_amt/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                // alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('#course_vat_amt').val(obj.amount);
            }
        });

    }

    function show_course_tot_amt(id)
    {
        //alert(id);
        var acc_value = $('#add_ac_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/subject_module/add_course_tot_amt/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                // alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('#course_tot_amt').val(obj.amount);
            }
        });

    }


</script>
<script>

    function show_total_amount(id)
    {
       // alert(id)
        var a = document.getElementById('ammount_'+id).value;

        var b = document.getElementById('vat_'+id).value;
        var c = (parseFloat(a) *parseFloat(b))/100;
        if(a== "")
        {
            $('#total_ammount_'+id).val('0');

        }
        else if(b== "")
        {
            $('#total_ammount_'+id).val(a);
        }
        else if(a== "" && b== "")
        {
            $('#total_ammount_'+id).val('');
        }
        else {
            var d = parseFloat(a)+parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#total_ammount_'+id).val(Math.round(d));
            $('#vat_amt_'+id).val(Math.round(c));
        }

    }
</script>