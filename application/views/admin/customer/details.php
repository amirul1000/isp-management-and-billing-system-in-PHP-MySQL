<a  href="<?php echo site_url('admin/customer/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Customer'); ?></h5>
<!--Data display of customer with id--> 
<?php
	$c = $customer;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>First Name</td><td><?php echo $c['first_name']; ?></td></tr>

<tr><td>Last Name</td><td><?php echo $c['last_name']; ?></td></tr>

<tr><td>NID</td><td><?php echo $c['NID']; ?></td></tr>

<tr><td>Address</td><td><?php echo $c['address']; ?></td></tr>

<tr><td>Service Name</td><td><?php echo $c['service_name']; ?></td></tr>

<tr><td>Cost</td><td><?php echo $c['cost']; ?></td></tr>

<tr><td>Start Date</td><td><?php echo $c['start_date']; ?></td></tr>

<tr><td>End Date</td><td><?php echo $c['end_date']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of customer with id//--> 