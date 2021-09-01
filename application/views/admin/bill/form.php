<a  href="<?php echo site_url('admin/bill/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php if($id<0){echo "Save";}else { echo "Update";} echo " "; echo str_replace('_',' ','Bill'); ?></h5>
<!--Form to save data-->
<?php echo form_open_multipart('admin/bill/save/'.$bill['id'],array("class"=>"form-horizontal")); ?>
<div class="card">
   <div class="card-body">    
        <div class="form-group"> 
          <label for="First Name" class="col-md-4 control-label">First Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="first_name" value="<?php echo ($this->input->post('first_name') ? $this->input->post('first_name') : $bill['first_name']); ?>" class="form-control" id="first_name" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Last Name" class="col-md-4 control-label">Last Name</label> 
          <div class="col-md-8"> 
           <input type="text" name="last_name" value="<?php echo ($this->input->post('last_name') ? $this->input->post('last_name') : $bill['last_name']); ?>" class="form-control" id="last_name" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Address" class="col-md-4 control-label">Address</label> 
          <div class="col-md-8"> 
           <textarea  name="address"  id="address"  class="form-control" rows="4"/><?php echo ($this->input->post('address') ? $this->input->post('address') : $bill['address']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Contact" class="col-md-4 control-label">Contact</label> 
          <div class="col-md-8"> 
           <input type="text" name="contact" value="<?php echo ($this->input->post('contact') ? $this->input->post('contact') : $bill['contact']); ?>" class="form-control" id="contact" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Service Info" class="col-md-4 control-label">Service Info</label> 
          <div class="col-md-8"> 
           <textarea  name="service_info"  id="service_info"  class="form-control" rows="4"/><?php echo ($this->input->post('service_info') ? $this->input->post('service_info') : $bill['service_info']); ?></textarea> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Cost" class="col-md-4 control-label">Cost</label> 
          <div class="col-md-8"> 
           <input type="text" name="cost" value="<?php echo ($this->input->post('cost') ? $this->input->post('cost') : $bill['cost']); ?>" class="form-control" id="cost" /> 
          </div> 
           </div>
<div class="form-group"> 
          <label for="Bill For" class="col-md-4 control-label">Bill For</label> 
          <div class="col-md-8"> 
           <input type="text" name="bill_for" value="<?php echo ($this->input->post('bill_for') ? $this->input->post('bill_for') : $bill['bill_for']); ?>" class="form-control" id="bill_for" /> 
          </div> 
           </div>
<div class="form-group"> 
                                        <label for="Payment Status" class="col-md-4 control-label">Payment Status</label> 
          <div class="col-md-8"> 
           <?php 
             $enumArr = $this->customlib->getEnumFieldValues('bill','payment_status'); 
           ?> 
           <select name="payment_status"  id="payment_status"  class="form-control"/> 
             <option value="">--Select--</option> 
             <?php 
              for($i=0;$i<count($enumArr);$i++) 
              { 
             ?> 
             <option value="<?=$enumArr[$i]?>" <?php if($bill['payment_status']==$enumArr[$i]){ echo "selected";} ?>><?=ucwords($enumArr[$i])?></option> 
             <?php 
              } 
             ?> 
           </select> 
          </div> 
            </div>

   </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
        <button type="submit" class="btn btn-success"><?php if(empty($bill['id'])){?>Save<?php }else{?>Update<?php } ?></button>
    </div>
</div>
<?php echo form_close(); ?>
<!--End of Form to save data//-->	
<!--JQuery-->
<script>
	$( ".datepicker" ).datepicker({
		dateFormat: "yy-mm-dd", 
		changeYear: true,
		changeMonth: true,
		showOn: 'button',
		buttonText: 'Show Date',
		buttonImageOnly: true,
		buttonImage: '<?php echo base_url(); ?>public/datepicker/images/calendar.gif',
	});
</script>  			