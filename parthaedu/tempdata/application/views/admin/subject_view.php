<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> Subject</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> Subject</h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('update_message');  ?>
       <div>
           <table class="tblborder">
               <tr>
                   <td width="50%" colspan="2" style=" text-align:left">

                       <select style="width:50%" id="per_page"  onchange="pagination_select(this.value,this.id)">
                           <option value="">Select</option>
                           <option value="10" <?php if($per_page==10)  { echo 'selected';} ?>>10</option>
                           <option value="50" <?php if($per_page==50)  { echo 'selected';} ?>>50</option>
                           <option value="100" <?php if($per_page==100) { echo 'selected';} ?>>100</option>
                           <option value="500" <?php if($per_page==500) { echo 'selected';} ?>>500</option>
                           <option value="1000" <?php if($per_page==1000){ echo 'selected';} ?>>1000</option>

                       </select></td>
               </tr>
           </table>
           <a class="btn btn-primary" href="javascript:void(0)" onclick="return go_to_add_view()" > Add Subject </a>

       <span align="center"><a style="float: right" class="btn btn-primary" id="active_unit" href="javascript:void(0)" onclick="active_sub_admin()" >
       <i class="icon-edit icon-white"></i> Active </a>
       <a style="float: right"  class="btn btn-primary" id="in_active_unit" href="javascript:void(0)" onclick="in_active_sub_admin()" >
       <i class="icon-edit icon-white"></i> In-Active </a></span>
              </div>

        <table class="table table-striped table-bordered">
          <thead>
            <tr>
            <th><input type="checkbox" name="" id="parent_check_id" onclick="parent_check_checked(this.checked,this.id)" /> </th>
              <th> Sl No</th>
              <th>Academic Year</th>
              <th>Course Name</th>
              <th>Subject Name/Class Name</th>

              <th>Status</th>
             <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <tr>
           <?php
           $count = 0;
           foreach($sub as $sub_name)
           {
           @$course_id = $sub_name->course_name_by_subject;
           @$course_name =$this->common_model->add_course_data('tbl_course','course_id',$course_id);
           //print_r($course_name);
              @$count = $count+1;
          ?>
           <td style="width:1px"><input type="checkbox" name="check_id" id="<?php echo $sub_name->subject_id;?>"  class="chtest_test" 
           onClick="single_check_box_checked(this.checked,this.id)" value="<?php echo $sub_name->subject_id;?>"/></td>
          <td><?php echo @$count; ?></td>
          <td><?php echo @$sub_name->academic_year; ?></td>

              <td><?php echo @$course_name[0]->course_name;?></td>
          <td><?php echo @$sub_name->subject_name."/".$sub_name->class_name;?></td>



          <td style="text-align:center" ><?php  if($sub_name->status =='active'){?>
                    <span class="label label-success">Active</span>
                    <?php }else{?>
                    <span class="label label-important">Inactive</span>
                    <?php }?>
                </td>
          <td class="center"><a class="btn btn-info" href="#" onclick="return openedit_model('<?php echo $sub_name->subject_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-danger" href="#" onclick="delete_academic(<?php echo $sub_name->subject_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a>
               </td>

          
           
          </tr>
          <?php
           }
              ?>
          <td colspan="8"><div id="pagination_container"> <?php echo @$msg; ?> </div></td>
           </tbody>
        </table>
        
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
<script language="javascript" type="text/javascript">

    /*function delete_data(id)
    {
        if(confirm('Are you sure do you want to delete it?')){
            window.location = 	base_url+'index.php/subject_module/delete_subject/'+id;
        }
    }*/

    function delete_academic(id)
    {
        //alert(id);
        if(id)
        {
            var base_url='<?php echo base_url();?>';
            if(confirm('Are you sure do you want to delete this Academic Year?')){
                $.ajax({
                    type:"POST",
                    url: "<?php echo base_url() ?>index.php/subject_module/delete_subject",
                    data:{deleteid:id},
                    success:function(msg){


                    }
                });

                $('#myOKModal').modal('show');

            }
        }
    }

    function go_to_add_view()
    {
        window.location = base_url+'index.php/subject_module/add_subject_view/';
    }





var base_url='<?php echo base_url();?>';
function open_add_model()
{
 // $("#myaddmodel").modal('show');
}

function open_addBook_model(id)
{
  //alert(id);
  if(id)
  {
    var dataString='id='+id;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url:base_url+"index.php/admin/get_subject_book",  
        data: dataString,
        async: false,  
        success: function(data) {
            var booklist = data.BookList;
            var selected_book_list = data.selected_book_list;
            console.log(data);
            var html_string="";
            var i=0;
            var j=0;
            for(i=0;i<booklist.length;i++)
            {
              html_string+="<input   type='checkbox' name='books[]' id='check"+booklist[i].book_id+"'  value='"+booklist[i].book_id+"'/>&nbsp;<span>"+booklist[i].book_name+"</span><br />";
                
              
            }
            
            $('#book_html').html(html_string);
            for(j=0;j<selected_book_list.length;j++){ 
                        
              $("#check"+selected_book_list[j].book_id).attr('checked','checked');
            }
        }
    })
  }
  $("#subid").val(id);
  $("#myaddBookmodel").modal('show'); 
}

function openedit_model(id)
{

        window.location = base_url+'index.php/subject_module/subject_edit/'+id;

  /*if(id){
     
    var dataString = 'id='+ id ;
    //alert(dataString)
    $.ajax({
          type: "POST",
          dataType:'json',  
          url:base_url+"index.php/subject_module/subject_edit",
          data: dataString,
          async: false,  
         success: function(data) {             
           var edit_fees=data.edit_fees[0];   
           /!* $("#id").val(id);
            $("#edit_class_id").val(edit_fees.class_name);
            $("#edit_subject_name").val(edit_fees.subject_name);
            $("#edit_status").val(edit_fees.status);
            $("#edit_batch").val(edit_fees.batch_name);*!/
            /!*$("#edit_admission_fees").val(edit_fees.admission_fees);
            //$("#edit_electric_charge").val(edit_fees.electric_charge);
            $("#edit_total").val(edit_fees.total);  *!/
            $('#myEditModal').modal('show');
            
        }  
          
    });
  }*/
}



function deleteitem(id)
{
  var base_url='<?php echo base_url();?>'; 
  var id=id;
  var tablename='tblsubject';
  var column='id';
  var page='admin/subjects';
  if(confirm('Are you sure do you want to Delete it?')){
      window.location = base_url+'index.php/admin/deleteitem?id='+id+'&table='+tablename+'&column='+column+'&page='+page;
    }
  
}


</script>
<script language="javascript" type="text/javascript">


    function filterInactiveActive(id)
    {

        window.location = base_url+'index.php/subject_module/'+id;

    }
    /*function delete_data(id)
    {
        if(confirm('Are you sure do you want to delete it?'))
        {
            window.location = base_url+'index.php/subject_module/sub_admin_delete/'+id;
        }
    }
*/


    function unitActivateInactive(id,value)
    {
        $.post(base_url+'index.php/subject_module/sub_admin_active_inactive/',
            {
                id:id,
                value:value
            },
            function(data,status)
            {
                //alert(value)
                if(value.trim()=='Y')
                {
                    alert("Sub-admin has been Activate successfully ");
                }
                else
                {
                    alert("Sub-admin has been In-activate successfully ");
                }
            });
    }
</script>

<script>

    function single_check_box_checked(isChecked,id)
    {

        if(isChecked==true)
        {
            $("#select_"+id).addClass('selectCheck');
            $("#"+id).parent().addClass('checked');
            $("#"+id).attr('checked',true);

        }
        else if(isChecked==false)
        {
            $("#select_"+id).removeClass('selectCheck');
            $("#"+id).parent().removeClass('checked');
            $("#"+id).attr('checked', false);
        }

    }


    function parent_check_checked(isChecked,id)
    {
        //alert(isChecked)
        if(isChecked==true)
        {
            $("#"+id).attr('checked',true);
            $(".select").addClass('selectCheck');
            $(".chtest_test").parent().addClass('checked');
            $('.chtest_test').attr('checked','checked');

        }
        else if(isChecked==false)
        {
            $("#"+id).attr('checked',false);
            $(".select").removeClass('selectCheck');
            $(".chtest_test").parent().removeClass('checked');
            $('.chtest_test').attr('checked', false);
        }
    }




    function active_sub_admin()
    {
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            $.post(base_url+'index.php/subject_module/sub_admin_active_more_than_one_id/',
                {
                    sub_admin_id:checkboxValue
                },
                function(data,status)
                {
                    $(".selectCheck").html('<img src="'+base_url+'img/active.png" width="26" >');
                    $("#parent_check_id").parent().removeClass('checked');
                    $('#parent_check_id').attr('checked', false);
                    $(".chtest_test").parent().removeClass('checked');
                    $('.chtest_test').attr('checked', false);
                    $(".select").removeClass('selectCheck');
                    alert('Unit has been Activated successfully.');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

    }



    function in_active_sub_admin()
    {	//alert("hi");
        var checkboxValue =[];
        var checkboxId=[];
        $.each($("input[name='check_id']:checked"), function()
        {
            checkboxValue.push($(this).val());
            checkboxId.push(this.id);
        });
        var checkboxId=checkboxId.join(", ");
        var checkboxValue=checkboxValue.join(", ");
        if(checkboxValue!='')
        {
            //alert(checkboxValue);
            $.post(base_url+'index.php/subject_module/sub_admin_in_active_more_than_one_id/',
                {
                    sub_admin_id:checkboxValue
                },
                function(data,status)
                {
                    $(".selectCheck").html('<img src="'+base_url+'img/inactive.png" width="26" >');
                    $("#parent_check_id").parent().removeClass('checked');
                    $('#parent_check_id').attr('checked', false);
                    $(".chtest_test").parent().removeClass('checked');
                    $('.chtest_test').attr('checked', false);
                    $(".select").removeClass('selectCheck');

                    var split=checkboxId.split(',');
                    var length=split.length;
                    var i=0;
                    for(i=0;i<length;i++)
                    {
                        //var status_id=split[i];

                        //$('#status_'+split[i]).html('tgreye');
                        //alert(status_id);
                    }
                    alert('Unit has been Successfully Inactivated.');
                    location.reload();
                });
        }
        else
        {
            alert('Please Select at least one check box.');
        }

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

                window.location = base_url+'index.php/subject_module?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/subject_module?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/subject_module?'+id+'='+value;
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
