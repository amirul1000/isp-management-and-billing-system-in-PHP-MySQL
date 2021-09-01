<a  href="<?php echo site_url('admin/bill/index'); ?>" class="btn btn-info"><i class="arrow_left"></i> List</a>
<h5 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Bill'); ?></h5>
<!--Data display of bill with id--> 
<?php
	$c = $bill;
?> 
<table class="table table-striped table-bordered">         
		<tr><td>First Name</td><td><?php echo $c['first_name']; ?></td></tr>

<tr><td>Last Name</td><td><?php echo $c['last_name']; ?></td></tr>

<tr><td>Address</td><td><?php echo $c['address']; ?></td></tr>

<tr><td>Contact</td><td><?php echo $c['contact']; ?></td></tr>

<tr><td>Service Info</td><td><?php echo $c['service_info']; ?></td></tr>

<tr><td>Cost</td><td><?php echo $c['cost']; ?></td></tr>

<tr><td>Bill For</td><td><?php echo $c['bill_for']; ?></td></tr>

<tr><td>Payment Status</td><td><?php echo $c['payment_status']; ?></td></tr>

<tr><td>Created At</td><td><?php echo $c['created_at']; ?></td></tr>

<tr><td>Updated At</td><td><?php echo $c['updated_at']; ?></td></tr>


</table>
<!--End of Data display of bill with id//--> 