<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<h3 class="font-20 mt-15 mb-1"><?php echo str_replace('_',' ','Bill'); ?></h3>
Date: <?php echo date("Y-m-d");?>
<hr>
<!--*************************************************
*********mpdf header footer page no******************
****************************************************-->
<htmlpageheader name="firstpage" class="hide">
</htmlpageheader>

<htmlpageheader name="otherpages" class="hide">
    <span class="float_left"></span>
    <span  class="padding_5"> &nbsp; &nbsp; &nbsp;
     &nbsp; &nbsp; &nbsp;</span>
    <span class="float_right"></span>         
</htmlpageheader>      
<sethtmlpageheader name="firstpage" value="on" show-this-page="1" />
<sethtmlpageheader name="otherpages" value="on" /> 
   
<htmlpagefooter name="myfooter"  class="hide">                          
     <div align="center">
               <br><span class="padding_10">Page {PAGENO} of {nbpg}</span> 
     </div>
</htmlpagefooter>    

<sethtmlpagefooter name="myfooter" value="on" />
<!--*************************************************
*********#////mpdf header footer page no******************
****************************************************-->
<!--Data display of bill-->    
<table   cellspacing="3" cellpadding="3" class="table" align="center">
    <tr>
		<th>First Name</th>
<th>Last Name</th>
<th>Address</th>
<th>Contact</th>
<th>Service Info</th>
<th>Cost</th>
<th>Bill For</th>
<th>Payment Status</th>

    </tr>
	<?php foreach($bill as $c){ ?>
    <tr>
		<td><?php echo $c['first_name']; ?></td>
<td><?php echo $c['last_name']; ?></td>
<td><?php echo $c['address']; ?></td>
<td><?php echo $c['contact']; ?></td>
<td><?php echo $c['service_info']; ?></td>
<td><?php echo $c['cost']; ?></td>
<td><?php echo $c['bill_for']; ?></td>
<td><?php echo $c['payment_status']; ?></td>

    </tr>
	<?php } ?>
</table>
<!--End of Data display of bill//--> 