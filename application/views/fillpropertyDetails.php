  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
            	<?php
                    $errors = validation_errors();
                    if($errors && count($errors) > 0) {
            	?>
            	<div class="alert alert-danger">
            	<?php
            	    echo $errors; 
            	?>
            	</div>
            	<?php
                    } 
            	?>
            	<form class="form-horizontal" action="<?php echo base_url() ?>property" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Add Location Form</legend>

                        <div class="form-group">
                            <span class="col-md-3 text-right">Location Name: <span class="required">*</span></span>
                            <div class="col-md-8">
                                <input id="pname" value="<?php echo set_value('pname'); ?>" name="pname" type="text" placeholder="Enter Location Name" class="form-control">
                               
                            </div>
                        </div>
                        
                        <div class="form-group address-group">
                            <span class="col-md-3 text-right">Address: <span class="required">*</span></span>
                            <div class="col-md-8">
                                <textarea class="form-control" id="address" name="address" placeholder="Enter Address" rows="7"><?php echo set_value('address'); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-3 text-right"><label for="exampleFormControlFile1">Upload Property Photo</label></span>
                             <div class="col-md-8">
                               <input type="file" multiple class="form-control-file" id="exampleFormControlFile1" name="images[]">
                             </div>
                        </div>
                          
                          
                        <div class="form-group">
                            <span class="col-md-3 text-right">Two wheeler Charge: <span class="required">*</span></span>
                            <div class="col-md-8">
                                <input id="two_wheeler_charge" value="<?php echo set_value('two_wheeler_charge'); ?>" name="two_wheeler_charge" type="number" placeholder="Enter Two wheeler Charge" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-3 text-right">Four wheeler Charge: <span class="required">*</span></span>
                            <div class="col-md-8">
                                <input id="four_wheeler_charge" value="<?php echo set_value('four_wheeler_charge'); ?>" name="four_wheeler_charge" type="number" placeholder="Enter Four wheeler Charge" class="form-control" />
                            </div>
                        </div>
                        
                        
                        <div class="form-group">  
                       	  <span class="col-md-3 text-right">Parking Floors and capacity: <span class="required">*</span></span>
                          <div class="col-md-8 table-responsive">  
                               <table class="table" id="dynamic_field">  
                                    <tr>
                                    	<th><small>Floor Name</small></th>
                                    	<th><small>2 Wheeler capacity</small></th>
                                    	<th><small>4 Wheeler capacity</small></th>
                                    	<th><small>Operation</small></th>
                                    </tr>
                                    <?php for($i=0; $i < count($this->input->post("level")) || $i < 1 ; $i++ ){?>
                                    <tr>  
                                         
                                         <td><input type="text" name="level[]" value="<?php echo set_value('level['.$i.']'); ?>" placeholder="Enter Level name" class="form-control name_list" /></td> 
                                         <td><input type="number" name="twcapacity[]" value="<?php echo set_value('twcapacity['.$i.']'); ?>" placeholder="Enter Two wheeler capacity" class="form-control name_list" /></td>  
                                         <td><input type="number" name="fourwcapacity[]" value="<?php echo set_value('fourwcapacity['.$i.']'); ?>" placeholder="Enter Four Wheeler capacity" class="form-control name_list" /></td>   
                                         <?php if($i==0) { ?><td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td> <?php } else { ?>
                                         <td><button type="button" name="remove" id="<?php echo $i; ?>" onclick="$(this).parent().parent().remove();" class="btn btn-danger btn_remove">X</button></td>  <?php } ?>
                                    </tr>
                                     <?php } ?>
                                      
                               </table>  
                              
                          </div>  
                    
                </div>  
                        
                        
                        <div class="form-group">
                            <span class="col-md-3 text-right">Minimum Deposit: <span class="required">*</span></span>
                            <div class="col-md-8">
                                <input id="mindeposit" name="mindeposit" value="<?php echo set_value('mindeposit'); ?>" type="number" placeholder="Enter Minimum Deposit" class="form-control">
                            </div>
                        </div>
                        
                         
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="level[]" placeholder="Enter Level number" class="form-control name_list" /></td><td><input type="text" name="twcapacity[]" placeholder="Enter Two wheeler capacity" class="form-control name_list" /></td><td><input type="text" name="fourwcapacity[]" placeholder="Enter Four Wheeler capacity" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){
    	  var button_id = $(this).attr("id");   
	      $('#row'+button_id+'').remove();
      });  
      
 }); 
 function removeRow(el) {
	 
	   
 } 
 </script>
   