<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<link rel="shortcut icon" href="{{ asset('/1.png') }}">
	<style>
		.table{
			border-collapse: collapse;
			font-family: arial;
		} 
		.table td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 2px;
		  font-family: arial;
		}
		.table th {
		  background-color: #eee; 
		  color: black;
		  font-family: arial;
		}
	</style>
</head>
<body>
<table style="width: 100%; border: none !important;">
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
					<td style="width: 50%; text-align: left;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="font-size: 22px; margin-bottom: 0px; width: 100%; font-weight: 600;"> Tax Invoice</td>
							</tr>
							<tr style="width: 100%;">
								<td style="margin-top: 5px; font-size: 18px; font-weight: 100; width: 100%;">Dr. HelpDesk (DHD)</td>
							</tr>
							<tr style="width: 100%;">
								<td style="margin-top: 5px; font-size: 12px; font-weight: 100; width: 100%;">Dr HelpDesk, Kunjpura road, karnal (haryana)-132001. Phone Number +91-8168234420</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	

	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%; border-top: 4px dotted #000;">
				<tr style="width: 100%;">
					<td  style="width: 30%;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Customer Name : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->user_name}}</span></td>
							</tr>							
                        	<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Invoice Number : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->order_id}}</span></td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Payment Mode : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->payment_mode}}</span></td>
							</tr>
						</table>
					</td>
					<td  style="width: 30%;">
						<table style="width: 100%;">
							<tr style="width: 100%; padding-top:0px!important;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Phone Number : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->user_phone}}</span></td>
							</tr> 					
							<tr style="width: 100%;">								 
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Invoice Date : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->created_at}}</span></td>
							</tr> 
						</table>
					</td>
					<td  style="width: 25%;">
						<table style="width: 100%;">
							<tr style="width: 100%; padding-top:0px!important;">
							<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> Payment Mode : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">{{$orderDetails->payment_mode}}</span></td>
							</tr> 					
							<tr style="width: 100%;">								 
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; "> <!--<Invoice Date : --> <span style="font-weight: 600; font-size: 14px; padding-left:15px;"><!--{{$orderDetails->created_at}}--></span></td>
							</tr> 
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	 
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%; border-bottom: 4px dotted #000;">
				<tr style="width: 100%;">
					<td  style="width: 50%;">
						<table style="width: 100%;">
						<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 14px; text-align: left; font-weight: 600; ">GST Number : <span style="font-weight: 600; font-size: 14px; padding-left:15px;">06AATCA4815B1ZU</span></td>
							</tr>                       
						</table>
					</td>				 
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width: 100%;">
			@if(count($order)>0)
			<table style="width: 100%;" class="table">  
				<tr>
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">Sr.No.</td> 
			 		
					<td style="border: 1px solid black;text-align: center;font-weight: bold;" colspan="4">Product Name</td>
					<!-- <td style="border: 1px solid black;text-align: center;font-weight: bold;">MFR/MKT</td>
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">BATCH</td> -->
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">MRP</td>
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">Discount</td>					
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">GST %</td>
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">Quantity</td>
					<td style="border: 1px solid black;text-align: center;font-weight: bold;">Total Amount</td> 
				</tr> 
				<?php
					$f = 0;
					$copoun1= 0;
					$count = 1;
					$t_gst = 0;
					$dis_count = 0;
				?> 	
			 
				 @foreach($order as $row)					
					<tr>
						<td style="border: 1px solid black;text-align: center;">{{$count++}}</td>	 
						 
						<td style="border:1px solid black;" colspan="4">{{$row->prod_name}} </td> 
						<!-- <td style="border: 1px solid black;text-align: center;">MFR/MKT</td>
						<td style="border: 1px solid black;text-align: center;">BATCH</td> -->
						<td style="border: 1px solid black;text-align: center;">{{$row->price}}</td>
						<td style="border: 1px solid black;text-align: center;">{{round(((($row->price/$row->per_stript_qty) - $row->sub_total) * $row->quantity),3)}}</td>						
												
						<td style="border: 1px solid black;text-align: center;">{{$row->gst_value_percentage}}</td>
						<td style="border: 1px solid black;text-align: center;">{{$row->quantity}}</td>  
						<td style="border: 1px solid black;text-align: center;">{{($row->sub_total * $row->quantity)}}</td> 
						<?php $t_gst = $t_gst + (($row->sub_total/100) * $row->gst_value_percentage) *  $row->quantity ;
							$dis_count = $dis_count + ((($row->price/$row->per_stript_qty) - $row->sub_total) * $row->quantity);
						?> 
					</tr>
				@endforeach 			
				<tr style="width: 100%;">
					<td colspan="7" >
						<table style="width:80%;">
						<tr>
							<td style="font-weight: 400; color: black; text-align: left; font-size:14px;text-align: center; font-weight: bold;">Taxable Amt</td>
							<td style="font-weight: 400; color: black; text-align: left; font-size:14px;text-align: center; font-weight: bold;">SGST %</td>
							<td style="font-weight: 400; color: black; text-align: left; font-size:14px;text-align: center; font-weight: bold;">SGST Amt</td>
							<td style="font-weight: 400; color: black; text-align: left; font-size:14px;text-align: center; font-weight: bold;">CGST %</td>
							<td style="font-weight: 400; color: black; text-align: left; font-size:14px;text-align: center; font-weight: bold;">CGST Amt</td>
						</tr>
						 
						<?php $amt=0;$sgst_amt=0;$cgst_amt=0; ?>
						@foreach($gst_count as $row)
							<tr>
								<td style="text-align: center;  font-size:14px;">{{round($row->total / ((100 + $row->gst_value_percentage)/100),2)}}</td>
								<?php $amt = $amt + round($row->total / ((100 + $row->gst_value_percentage)/100),2); ?>
								<td style="text-align: center;  font-size:14px;">{{$row->gst_value_percentage / 2}}</td>
								<td style="text-align: center;  font-size:14px;">{{round(($row->total - ($row->total / ((100 + $row->gst_value_percentage)/100))) / 2,2)}}</td>
								<?php $sgst_amt = $sgst_amt + round(($row->total - ($row->total / ((100 + $row->gst_value_percentage)/100))) / 2,2); ?>
								<td style="text-align: center;  font-size:14px;">{{$row->gst_value_percentage / 2}}</td>
								<td style="text-align: center;  font-size:14px;">{{round(($row->total - ($row->total / ((100 + $row->gst_value_percentage)/100))) / 2,2)}}</td>
								<?php $cgst_amt = $cgst_amt + round(($row->total - ($row->total / ((100 + $row->gst_value_percentage)/100))) / 2,2); ?>
							</tr>
						@endforeach
						<tr>
								<td style="text-align: center;  font-size:14px;">{{$amt}}</td>
								
								<td style="text-align: center;  font-size:14px;"></td>
								<td style="text-align: center;  font-size:14px;">{{$sgst_amt}}</td>
								<td style="text-align: center;  font-size:14px;"></td>
								<td style="text-align: center;  font-size:14px;">{{$cgst_amt}}</td>
							</tr>
						</table>
					</td>
					<td colspan="3" style="text-align: center;  font-size:14px;"></td>
					<!-- <td colspan="" style="text-align: center;  font-size:14px;"></td>   -->
				</tr>			
				<tr style="width: 100%;">
				<td colspan="7"></td>
					<td colspan="2" style="font-weight: 400; color: black; text-align: left; font-size:14px;">Total Discount
					</td>
					<td style="text-align: center;  font-size:14px;">Rs <?php echo round($dis_count,2); ?></td> 
				</tr>

				<tr style="">
					<td colspan="5" style="text-align: right;"></td>
					<td colspan="2" style="text-align: center; "></td>
					<!-- <td colspan="5" style="text-align: right;">Using Dcoin Amount</td>
					<td colspan="2" style="text-align: center; ">Rs {{round($orderDetails->used_Decoin_amt)}}</td> -->
					<td colspan="2" style="font-weight: 700; color: black;  padding-top:10px; padding-bottom:10px;">TOTAL AMOUNT:</td>
					<td style=" background-color: #eee; text-align: center; padding-top:10px; padding-bottom:10px;">Rs {{round($orderDetails->amount)}}</td> 
				</tr> 
            	<tr style="width: 100%;">
					<td colspan="11" style="font-weight: 700; color: black; text-align: center; ">All prices inclusive of GST as per Applicable Rate.
					</td>
				</tr>
            
			</table>
			@else
	            No Record found
			@endif
		</td>
	</tr>
</table>
<script type="text/javascript">
      window.onload = function() { window.print(); }
 </script>
</body>
</html>