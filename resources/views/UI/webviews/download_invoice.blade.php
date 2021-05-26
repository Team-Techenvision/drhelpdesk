<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
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
					<td style="width: 30%; text-align: left;">
						<img src="{{public_path('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid" style="height: 150px;">
					</td>
                <td style="width: 10%; text-align: right;"></td>
					<td style="width: 50%; text-align: right;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="font-size: 22px; margin-bottom: 0px; width: 100%; font-weight: 700;">Tax Invoice/Bill of Supply/Cash Memo</td>
							</tr>
							<tr style="width: 100%;">
								<td style="margin-top: 5px; font-size: 18px; font-weight: 100; width: 100%;">AENSA Health Solutions Private Limited</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
					<td style="width: 50%;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; font-size: 22px; font-weight: 700;">Shipping Address:</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">@if($orderDetails->user_name != null){{$orderDetails->user_name}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->user_address != null){{$orderDetails->user_address}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->user_apartment != null){{$orderDetails->user_apartment}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->user_city != null){{$orderDetails->user_city}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->user_state != null){{$orderDetails->user_state}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->user_country != null){{$orderDetails->user_country}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px;">
								@if($orderDetails->pin_code != null){{$orderDetails->pin_code}}@endif</td>
							</tr> 
						</table>
					</td>
					<td style="width: 50%; vertical-align: text-top;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; font-size: 22px; text-align: right; vertical-align: text-top; font-weight: 700;">Billing Address:</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_name != null){{$orderDetails->user_name}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_address != null){{$orderDetails->user_address}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_apartment != null){{$orderDetails->user_apartment}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_city != null){{$orderDetails->user_city}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_state != null){{$orderDetails->user_state}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->user_country != null){{$orderDetails->user_country}}@endif</td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">
								@if($orderDetails->pin_code != null){{$orderDetails->pin_code}}@endif</td>
							</tr>  
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr> 
	<tr style="width: 100%;">
		<td style="width: 100%;">
			<table style="width: 100%;">
				<tr style="width: 100%;">
					<td  style="width: 50%;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; font-size: 22px; margin-bottom: 0px;">PAN No:<span style="font-weight: 100; font-size: 14px;">AATCA4815B</span></td>
							</tr>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; font-size: 22px; margin-bottom: 0px;">GST Registration No:<span style="font-weight: 100; font-size: 14px;">03AATCA4815B1Z0</span></td>
							</tr>
						</table>
					</td>
					<td  style="width: 50%;">
						<table style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Order Number:<span style="font-weight: 100; font-size: 14px;">{{$orderDetails->order_id}}</span></td>
							</tr>
							<?php 
			                	$dt = new DateTime($orderDetails->created_at);
		                        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

		                        $dt->setTimezone($tz);
		                        $start_date = $dt->format("d-m-Y H:i:s");   
			                    $ex = explode(" ",$orderDetails->created_at)
			                ?>
							<tr style="width: 100%;">
								<td style="width: 100%; margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Order Date:<span style="font-weight: 100; font-size: 14px;">{{$start_date}}</span></td>
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
					<td style="border: 1px solid black;">Sr.No.</td> 
			 		<!-- <td style="border: 1px solid black;">Order Id</td>
					<td style="border: 1px solid black;">Sub Order Id</td> -->
					<td style="border: 1px solid black;" colspan="4">Product Name</td>
					<td style="border: 1px solid black;">Quantity</td>
					<td style="border: 1px solid black;">Amount</td>
					<td style="border: 1px solid black;">Extra Discount</td>
					<td style="border: 1px solid black;">Total Amount</td> 
				</tr> 
				<?php
					$f = 0;
					$copoun1= 0;
				?> 
				
				@foreach($order as $key=> $r)
					<?php 
						$count = $key+1;  
						if($r->type == 1 ||$r->type == 2){
						$status = DB::table('order_status')->where('status_value',$r->order_status)->first();  
						$image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
						$product_category = DB::table('products')->where('products_id',$r->prod_id)->first(); 
						    
						}elseif($r->type == 3){
							$status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 
							$image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first();  
						}

						$copoun = DB::table('order_coupon_histories')->where('order_id',$r->order_id)->first();  
					?>
					<tr>
						<td style="border: 1px solid black;">{{$count++}}</td>
						 
						<!-- <td style="border: 1px solid black;">{{$r->order_id}} </td> 
						<td style="border: 1px solid black;">{{$r->sub_order_id}} </td>   -->
						<td style="border:1px solid black;" colspan="4">{{$r->prod_name}} <br> Sub Order Id : {{$r->sub_order_id}}  </td> 
						<td style="border: 1px solid black;">{{$r->quantity}}</td> 
						<td style="border: 1px solid black;">Rs {{$r->sub_total}}</td>  
						<td style="border: 1px solid black;">
							@if($r->extra_discount != null)
							<?php $discount = ($r->sub_total * $r->extra_discount)/100 ; //dd($discount); ?>
							{{$r->extra_discount}} <b>% Per Item </b>
							{{$discount}} <b> Rs Per Item</b>
							@else
							0 %
							@endif
						</td> 
						<td style="border: 1px solid black;">
							@if($r->extra_discount != null)
							<?php
							$f = $f + $r->quantity * $r->sub_total - $discount * $r->quantity;
							?>
							Rs {{$r->quantity * $r->sub_total - $discount * $r->quantity}}  
							@else
							<?php
							$f = $f+$r->quantity * $r->sub_total;
							?>
							Rs {{$r->quantity * $r->sub_total}} 
							@endif
						</td> 
					</tr>
				@endforeach 
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">SUB TOTAL:</td>
					<td style=" background-color: #eee;">Rs{{$f}}</td> 
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">COUPON AMOUNT:</td>
					@if($copoun != null) 
						@php
							$copoun = DB::table('coupons')->where('copoun_code',$copoun->coupon_code)->first(); 
						@endphp
						@if(!empty($copoun) && $copoun->type == 'fixed') 
						<td style=" background-color: #eee;">Rs{{round($copoun1 = $copoun->amount,2)}}</td> 
						@elseif(!empty($copoun) && $copoun->type == 'percentage') 
						<td style=" background-color: #eee;">Rs{{ round($copoun1 = $f * $copoun->amount/100 ,2)}}</td>
						@endif
					
					@else
					<td style=" background-color: #eee;">Rs0</td> 
					@endif
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">DEWALLET AMOUNT:</td>
					@if($orderDetails->de_wallet_coin != null) 
					<td style=" background-color: #eee;">Rs{{$orderDetails->de_wallet_coin  * 0.25}}</td> 
					@else
					<td style=" background-color: #eee;">Rs0</td> 
					@endif
				</tr>
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">SHIPPING CHARGES:</td>
					@if($orderDetails->shipping_charge != null)
					<td style=" background-color: #eee;">Rs{{$orderDetails->shipping_charge}}</td> 
					@else
					<td style=" background-color: #eee;">Rs0</td> 
					@endif
				</tr>
				@php
					$f = $f-$orderDetails->de_wallet_coin  * 0.25 - $copoun1 + $orderDetails->shipping_charge;
				@endphp
				<tr>
					<td colspan="8" style="font-weight: 700; color: black;">TOTAL AMOUNT:</td>
					<td style=" background-color: #eee;">Rs{{round($f,2)}}</td> 
				</tr> 
				<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: right; ">For Aensa Health Solutions Private Limited:<br> <br> <img src="{{public_path('UI/images/invoice-signature.jpeg')}}" style="width: 100px; border: 1px solid black;"> <br>Authorized Signatory
					</td>
				</tr>
            	<tr style="width: 100%;">
					<td colspan="9" style="font-weight: 700; color: black; text-align: center; ">All prices inclusive of GST as per Applicable Rate.
					</td>
				</tr>
            
			</table>
			@else
	            No Record found
			@endif
		</td>
	</tr>
</table>
</body>
</html>