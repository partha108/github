<div id="content" class="span10">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
                <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
                <li> <a href="#"> Send Sms</a> </li>
            </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                    <h2><i class="icon-user"></i> Send sms</h2>
            </div>
            <div class="box-content">
                <form method="post" action="<?php echo base_url('studentlist/sendSms');?>">
                    <?php
                        foreach ($st_detail as $sd)
                        {
                            @$st_mob = $sd[0]->student_phone_no;
                            $s[] = $st_mob;
                            $s = array_unique($s);

                            @$p_st_mob = $sd[0]->guardian_mobile_no;
                            $p_s[] = $p_st_mob;
                            $p_s = array_unique($p_s);
                        }
                    ?>
                    <table class="table table-striped table-bordered" width="50%">
                        <tr>
                            <td><input type="radio" name="rad" value="student_mobile_no" >Student</td>
                            <td><input type="radio" name="rad" value="parents_mobile_no" checked>Student Parents</td>
                        </tr>

                        <tr id="st_mob_no">
                            <td>Student Mobile Number</td>
                            <td><input type="text" name="st_mobile[]" id="st_no" value="<?php echo implode(",",$s);?>"></td>
                        </tr>

                        <tr id="p_mob_no">
                            <td>Parents Mobile Number</td>
                            <td><input type="text" name="p_st_mobile[]" id="p_st_mobile" value="<?php echo implode(",",$p_s);?>"></td>
                        </tr>

                        <tr>
                            <td>Message</td>
                            <td><textarea name="message" ></textarea></td>
                        </tr>

                        <tr>
                            <td colspan="2" align="center"> <input type="submit" value="Send"></td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[type="radio"]').change (function(){
        if($(this).val() =='student_mobile_no'){
            $('#st_mob_no').show();
            $('#p_mob_no').hide();
        }
        if($(this).val() == 'parents_mobile_no'){
            $('#st_mob_no').hide();
            $('#p_mob_no').show();
        }
    }).change();
</script>