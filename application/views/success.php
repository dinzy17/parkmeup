  <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<div class="container">

<div class="jumbotron">
	<div class="alert alert-success fade in"  id="alert">
		<a href="#" class="close" data-dismiss="alert" onclick="removeAlert()">&times;</a>
		<strong>Success!</strong> Your Parking Location Information has been added successfully.
	</div>
  <hr class="my-4">
	<div >
	  <a href="<?php echo site_url("property");?>"><button type="button" class="btn btn-info">Add Other Parking Location</button></a>
	</div>
</div>


</div>

<script>
function removeAlert() {
	$("#alert").remove()
}
</script>