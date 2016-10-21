<div id="content" class="span10">
  <div>
    <ul class="breadcrumb">
      <li> <a href="#">Manage Category</a> <span class="divider">/</span> </li>
      <li> <a href="#">Add Category</a> </li>
    </ul>
  </div>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <div class="box-icon"> </div>
      </div>
      <div class="box-content"> <?php echo form_open('admin/addcategory_post', array('class' => 'form-horizontal', 'id' => 'addcategory')); ?>
        <fieldset>
          <legend>Add Category</legend>
          <div class="control-group" id="category_name_control">
            <label class="control-label" for="inputSuccess">Parent Category Name</label>
            <div class="controls">
              <select name="parent_category" id="parent_category">
              	<option value="0">---select Category---</option>
                <option value="1">Eyes</option>
                <option value="2">Face and body</option>
                <option value="3">Lips</option>
                <option value="4">Nails</option>
                <option value="5">Make Up</option>
                <option value="6">Skin Care</option>
              </select>
              <span class="help-inline" style="display:none;"></span> </div>
          </div>
          <div class="control-group" id="category_name_control">
            <label class="control-label" for="inputSuccess">Category Name</label>
            <div class="controls">
              <input type="text" id="category_name" name="category_name" onblur="category_name_onblur()"/>
              <span class="help-inline" id="category_name_message" style="display:none;"></span> </div>
          </div>
          <div class="control-group" id="category_desc_control">
            <label class="control-label" for="inputSuccess">Category Description</label>
            <div class="controls">
              <textarea id="category_desc" name="category_desc" onblur="category_desc_onblur()"></textarea>
              <span class="help-inline" id="category_desc_message" style="display:none;"></span> </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary" onclick="return form_validation()">Save changes</button>
            <button type="reset" class="btn">Cancel</button>
          </div>
        </fieldset>
        </form>
      </div>
    </div>
    <!--/span--> 
    
  </div>
</div>
<script language="javascript" type="text/javascript">
function validate_category_name()
{
	var category_name = $.trim($("#category_name").val());
	if(category_name==''){
		$("#category_name_message").text("Please enter Category Name");
		$("#category_name_message").show();
		$("#category_name_control").removeClass();
		$("#category_name_control").addClass("control-group error");
		return false;
	}
	else
	{
		$("#category_name_message").text("Valid");
		$("#category_name_message").show();
		$("#category_name_control").removeClass();
		$("#category_name_control").addClass("control-group success");
		return true;	
	}
		
}


function category_name_onblur(){
	if(!validate_category_name())
		$("#category_name").focus();
}


function form_validation()
{
		if(!validate_category_name()){
			$("#category_name").focus();
			return false;
		}
		
		if(!validate_category_desc()){
			$("#category_desc").focus();
			return false;
		}
		
		return true;
}
</script>