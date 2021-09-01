<link rel="stylesheet"
	href="<?php echo base_url(); ?>public/css/custom.css"> 
<span style="float:right;">Date: <?php echo date("Y-m-d");?></span>
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
<table   cellspacing="3" cellpadding="3" width="100%" class="table" align="center">
    <tr>
		<td align="left">
           <?php echo $bill['first_name']; ?> <?php echo $bill['last_name']; ?><br>
           <?php echo $bill['address']; ?><br>
		   <?php echo $bill['contact']; ?><br>
        </td>
    </tr>
    <tr>
		<td align="left">
           <h5>Bill for</h5> <?php echo $bill['bill_for']; ?>
        </td>
    </tr>

</table>

<table align="center" width="100%" border="1">
   <tr>
      <td><?php echo $bill['service_info']; ?></td>
      <td><?php echo $bill['cost']; ?></td></td>
   </tr>
   <tr>
      <td>In Words</td>
      <td><?php 
	     $val = $this->load->library('numbertowordconvertsconver');
		$number = $bill['cost'];
		echo $this->numbertowordconvertsconver->convert_number($number);
	  ?></td></td>
   </tr>
</table>
<!--End of Data display of bill//--> 