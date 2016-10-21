<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />
<div id="content" class="span10">
    <!-- content starts -->

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> <?php  echo "Edit Course"; ?></h2>
            </div>
            <div class="box-content">
                <?php echo $this->session->flashdata('emptypost');  ?>
                <?php echo $this->session->flashdata('update_message');  ?>
                <?php
                foreach($edit_course as $ec) {
                    ?>
                    <form method="post" action="<?php echo base_url('index.php/course_module/edit_course'); ?>">

                    <table class="table table-striped table-bordered bootstrap-datatable">

                        <tr>
                            <td>Academic Year</td>

                            <td>
                                <input type="hidden" name="course_id" value="<?php echo $ec->course_id;?>">
                                <select id="academic_year" name="edit_academic_year" onchange="change_class(this.value);shwo_vat(this.value);">
                                    <?php

                                    foreach ($academic_year as $acy) {
                                            @$t = $acy->academic_year;
                                        ?>
                                        <option value="<?php echo $t; ?>" <?php if(@$ec->academin_year == $t){ echo "selected";}?>><?php echo @$t;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Course Name</td>
                            <td><input type="text" name="edit_course_name" value="<?php echo @$ec->course_name;?>"></td>
                        </tr>
                        <tr>
                            <td>Reg Fees</td>
                            <td><input type="text" id="edit_reg_fees" name="edit_reg_fees" value="<?php echo @$ec->course_reg_fee;?>" onkeyup="show_total_amount();"></td>
                        </tr>
                        <tr>
                            <td>Service Tax</td>
                            <td><input type="text" name="edit_service_tax" id="edit_service_tax" value="<?php if($ec->vat == ''){echo '0';}else{echo $ec->vat;};?>">%
                                <input type="text" name="edit_service_tax_amt" id="ser_vat_amt" value="<?php if($ec->vat_amt == ''){echo '0';}else{echo $ec->vat_amt;}?>"></td>
                        </tr>
                        <tr>
                            <td>Total Amount</td>
                            <td><input type="text" name="tot_amt" id="tot_amt" value="<?php if($ec->total_amt == ''){echo '0';}else{echo $ec->total_amt;}?>"</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>
                                <?php $a= explode(',',$ec->class_name); ?>

                                <select class="ms-select-all" id="mul_class" multiple name="course_class[]">

                                    <?php for($i=0;$i<count(array_filter($class));$i++) {
                                        ?>
                                        <option  value="<?php echo @$class[$i]->class_name;?>" <?php for($j=0;$j<count(array_filter($a));$j++){if($class[$i]->class_name==$a[$j]){echo "selected";} }?>>
                                            <?php echo @$class[$i]->class_name;?></option>
                                    <?php } ?>

                                </select>



                            </td>
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
    function openedit_model(id)
    {
        //alert(id);
        if(id){
            var base_url='<?php echo base_url();?>';
            var dataString = 'id='+id ;
            //alert(dataString);
            $.ajax({
                type: "POST",
                dataType:'json',
                url:base_url+"index.php/course_module/edit_fees",
                data: dataString,
                async: false,
                success: function(data) {
                    var edit_fees=data.edit_fees[0];
                    $("#id").val(id);
                    $("#edit_academic_year").val(edit_fees.academin_year);
                    $("#edit_course_name").val(edit_fees.course_name);
                    /*var  a= edit_fees.class_name;

                     var b = a.split(",");

                     var list="";
                     for(var i=0;i< b.length;i++)
                     {
                     list+='<option value="'+b[i]+'">b[i]</option>';
                     }

                     //alert(list);*/
                    $("#edit_class").val(edit_fees.class_name);
                    $("#edit_reg_fees").val(edit_fees.course_reg_fee);
                    /* $("#edit_admission_fees").val(edit_fees.admission_fees);
                     //$("#edit_electric_charge").val(edit_fees.electric_charge);
                     $("#edit_total").val(edit_fees.total);  */
                    $('#myEditModal').modal('show');

                }
            });
        }
        return false;

    }

    function open_add_model()
    {
        $('#myAddModal').modal('show');

    }

    function view_data(id)
    {
        //alert(id)
        window.location = base_url+'index.php/course_module/edit_course_view/'+id;

    }

    function deleteFees(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Fees structure?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/course_module/delete_course",
                    data:{deleteid:id},
                    success:function(msg){


                    }
                });

                $('#myOKModal').modal('show');

            }
        }
    }





    function change_class(id)
    {
        //alert(id);
        //var a = $( "#state option:selected" ).text();
        //alert($("#state option:selected", $(this)).text());
        //$('#hidden_state_name').val(a);
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

<script>
    function shwo_vat(id){

        alert(id)
        var acc_value = $('#academic_year').val();
        $.ajax({
            url: "<?php echo base_url();?>index.php/course_module/show_vat/"+id,
            type: "POST",
            dataType:'text',
            data: {acc_value:acc_value},
            success: function (data) {
                alert(data);
                var obj = JSON.parse(data);
                //alert(obj.amount);
                $('#edit_service_tax').val(obj.amount);



            }
        });


    }

</script>

<script>
    function show_total_amount(id)
    {
        var a = document.getElementById('edit_reg_fees').value;

        var b = document.getElementById('edit_service_tax').value;
        var c = (parseFloat(a) *parseFloat(b))/100;
        if(a== "")
        {
            $('#add_total_amt').val('0');

        }
        else if(b== "")
        {
            $('#tot_amt').val(a);
        }
        else if(a== "" && b== "")
        {
            $('#tot_amt').val('');
        }
        else {
            var d = parseFloat(a)+parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#tot_amt').val(Math.round(d));
            $('#ser_vat_amt').val(Math.round(c));
        }

    }
</script>

