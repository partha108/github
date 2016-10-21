<link rel="stylesheet" href="<?php echo base_url();?>assets/multiple-select.css" />
<div id="content" class="span10"> 
  <!-- content starts -->
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Admin</a> <span class="divider">/</span> </li>
      <li> <a href="#"> <?php echo "Course"; ?></a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-user"></i> <?php  echo "Course"; ?></h2>
      </div>
      <div class="box-content">
       <?php echo $this->session->flashdata('emptypost');  ?>
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
          <a class="btn btn-primary" href="javascript:void(0)" onclick="return open_add_model()" > Add Course </a></div>
      
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
            <th>sl. no. </th>
              <th>Academic Year</th>
              <th>Course</th>   
              <th>Class</th>
              <th>Registration Fees</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php $count=0; foreach($course as $item){
               $count=$count+1;
            ?>
             
            <tr>
             <td ><?php echo $count ; ?></td>
              <td ><?php echo $item->academin_year ;?></td>
              <td ><?php echo $item->course_name?></td>

              <td><?php echo $item->class_name;?></td>
                <td><?php echo $item->course_reg_fee; ?></td>
             
              <td class="center"><a class="btn btn-info" href="#" onclick="return view_data('<?php echo $item->course_id;?>')"> <i class="icon-edit icon-white"></i> Edit </a>
               
                <a class="btn btn-danger" href="#" onclick="deleteFees(<?php echo $item->course_id ;?>)"> <i class="icon-trash icon-white"></i> Delete </a> 
               </td>
            </tr>
            <?php }?>
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





<!-- --------------------------------------Add--------------------------------------------------- -->
<div class="modal hide fade" id="myAddModal" style="width:1000px; left:40%"> 
<?php echo form_open_multipart('course_module/add_course', array('class' => 'form-horizontal', 'id' => 'addFeesStucFrm')); ?>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add </h3>
  </div>
  <div class="modal-body">   
    <div style="width:500px;  float:left;">
      <?php echo $this->session->flashdata('insert_message');?>
        <div class="control-group" id="class_control" >
          <label class="control-label" for="class">Select Academic Year</label>
            <div class="controls">
              <!-- <select id="class" data-rel="chosen" name="class"  > -->
              <select name="add_academic_year" id="add_academic_year" onchange="change_class(this.value);shwo_vat(this.value);">
              <option value="0">---Select Academic Year---</option>
              <?php
              foreach ($academic_year as $acy) {
              ?>
              <option value="<?php echo $acy->academic_year;?>"><?php echo $acy->academic_year;?></option>
              <?php
                }
              ?>
            </select>

                <span class="help-inline" id="class_message" style="display:none;"></span> </div>
            </div>

            <div class="control-group" id="school_fees_control">
              <label class="control-label" for="inputSuccess">Course Name</label>
              <div class="controls">
                <input type="text" id="course_name"  name="add_course_name">
                <span class="help-inline" id="school_fees_message" style="display:none;"></span> </div>
            </div>
            <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Registration Fee </label>
              <div class="controls">
                <input type="text" name="add_reg_fee" autocomplete="off" id="add_reg_fee" onkeyup="show_total_amount();">
                <span class="help-inline" id="name_message" style="display:none;"></span>
              </div></div>

                <div class="control-group" id="name_control" >
                    <label class="control-label" for="inputSuccess">Service Tax </label>
                    <div class="controls">
                        <input type="text" readonly name="add_service_tax" id="add_service_tax"><span>%</span>
                        <input type="hidden" id="vat_amt" name="vat_amt">
                        <span class="help-inline" id="name_message" style="display:none;"></span>
                    </div></div>

                    <div class="control-group" id="name_control" >
                        <label class="control-label" for="inputSuccess">Total Amount</label>
                        <div class="controls">
                            <input type="text" name="add_total_amt" id="add_total_amt">
                            <span class="help-inline" id="name_message" style="display:none;"></span>
                        </div>
                        </div>


        <div class="control-group">
                    <label class="control-label" for="inputSuccess">Class</label>

                    <div class="controls">
                       <!-- <select id="selectclassbyacademic"  multiple="multiple">
                           <option value="0">---Select Class---</option>

                        </select>-->
                        <ul id="class_id" style="list-style: none">
                            <li></li>
                        </ul>
                    </div>
                </div>
            
            
        
        <div class="control-group" id="name_control" >
            <label class="control-label" for="inputSuccess">Status</label>
              <div class="controls">
                <select id="add_status" name="add_status">
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>              
                <span class="help-inline" id="name_message" style="display:none;"></span>
              </div>
        </div>
            
            
           
             
            </div>
            
  </div>
  <div class="modal-footer"> <a href="#" class="btn" data-dismiss="modal">Close</a>
    <button type="submit" class="btn btn-primary" onclick="return validate_form();" >Save changes</button>
  </div>
  </form>
</div>

<!-- --------------------------------------Edit--------------------------------------------------- -->

<!-- -----------------------------------------success modal------------------------------------- -->

<div class="modal hide fade" id="myOKModal" style="width: 284px; margin-block-start: 1%;margin-left: -85px;;margin-top:-72px ; display: block;"> <?php echo form_open_multipart(); ?>
  
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



function validate_edit_form()
{
  if(!validate_edit_ruleCategoryName()){
      $("#edit_rule_name").focus();
      return false;
  } 
return true;
}


function change_class(id)
      {

        $("#class_id").load('<?php echo base_url();?>index.php/course_module/course_class/'+id);
          $(".ms-drop").load('<?php echo base_url();?>index.php/course_module/course_class_ul/'+id);
      }

    function shwo_vat(id){

            //alert(id)
            var acc_value = $('#add_academic_year').val();
            $.ajax({
                url: "<?php echo base_url();?>index.php/course_module/show_vat/"+id,
                type: "POST",
                dataType:'text',
                data: {acc_value:acc_value},
                success: function (data) {
                    //alert(data);
                    var obj = JSON.parse(data);
                    //alert(obj.amount);
                    $('#add_service_tax').val(obj.amount);



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

<script>
    function show_total_amount(id)
    {
        var a = document.getElementById('add_reg_fee').value;

        var b = document.getElementById('add_service_tax').value;
        var c = (parseFloat(a) *parseFloat(b))/100;
        if(a== "")
        {
            $('#add_total_amt').val('0');

        }
        else if(b== "")
        {
            $('#add_total_amt').val(a);
        }
        else if(a== "" && b== "")
        {
            $('#add_total_amt').val('');
        }
        else {
            var d = parseFloat(a)+parseFloat(c);
            //alert(d);
            //document.getElementById('total_fee').innerHTML = d;
            $('#add_total_amt').val(Math.round(d));
            $('#vat_amt').val(Math.round(c));
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

                window.location = base_url+'index.php/course_module?'+str+'&'+id+'='+value;
            }
            else
            {
                window.location = base_url+'index.php/course_module?'+str;
            }

        }
        else
        {
            window.location = base_url+'index.php/course_module?'+id+'='+value;
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


