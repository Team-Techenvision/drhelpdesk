<!DOCTYPE html>
<html>
<head>
	<title>invoice</title>
</head>
<body>
	<table style="width: 100%; border: none !important;">
		<tr style="width: 100%;">
			<td style="width: 100%;">
				<table style="width: 100%;">
					<tr style="width: 100%;">
						<td style="width: 30%; text-align: left;">
							<img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid" style="width: 100%; height: 100px;">
						</td>
						<td style="width: 70%; text-align: right;">
							<h1 style="font-size: 22px; margin-bottom: 0px;">Tax Invoice/Bill of Supply/Cash Memo</h1>
						    <h6 style="margin-top: 5px; font-size: 18px; font-weight: 100;">AENSA Health Solutions Private Limited</h6>
						</td>
					</tr>
				</table>
				<table style="width: 100%;">
					<tr style="width: 100%;">
						<td style="width: 50%;">
							<h1 style="margin-bottom: 0px; font-size: 22px;">Shipping Address:</h1>
							@if($orderDetails->user_name != null)
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">{{$orderDetails->user_name}}</p>
		                	@endif
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">@if($orderDetails->user_address != null){{$orderDetails->user_address}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">@if($orderDetails->user_apartment != null){{$orderDetails->user_apartment}},@endif @if($orderDetails->user_city != null){{$orderDetails->user_city}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">@if($orderDetails->user_state != null){{$orderDetails->user_state}},@endif @if($orderDetails->user_country != null){{$orderDetails->user_country}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">@if($orderDetails->pin_code != null){{$orderDetails->pin_code}}@endif</p>

							<!-- <p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">Appario Retail Private Ltd</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">Unit No. 1, Khewat/ Khata No: 373/ 400 Mustatil</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">No 31,, Village Taoru, Tehsil Taoru, District</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">Mewat,, On Bilaspur Taoru Road</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">Mewat, Haryana, 122105</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px;">IN</p> -->
						</td>
						<td style="width: 50%; vertical-align: text-top;">
							<h1 style="margin-bottom: 0px; font-size: 22px; text-align: right; vertical-align: text-top;">Billing Address:</h1>
							@if($orderDetails->user_name != null)
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">{{$orderDetails->user_name}}</p>
		                	@endif
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">@if($orderDetails->user_address != null){{$orderDetails->user_address}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">@if($orderDetails->user_apartment != null){{$orderDetails->user_apartment}},@endif @if($orderDetails->user_city != null){{$orderDetails->user_city}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">@if($orderDetails->user_state != null){{$orderDetails->user_state}},@endif @if($orderDetails->user_country != null){{$orderDetails->user_country}},@endif</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">@if($orderDetails->pin_code != null){{$orderDetails->pin_code}}@endif</p>

							<!-- <p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">Rajnesh kumar</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">Sector 45 Chandigarh</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">road</p> -->
						</td>
					</tr>
				</table>
				<table style="width: 100%;">
					<tr style="width: 100%;">
						<td  style="width: 50%;">
							<h1 style="margin-top: 0px; font-size: 22px; margin-bottom: 0px;">PAN No: <span style="font-weight: 100; font-size: 14px;">AATCA4815B</span></h1>
			                <h1 style="margin-top: 0px; font-size: 22px; margin-bottom: 0px;">GST Registration No: <span style="font-weight: 100; font-size: 14px;">03AATCA8158B1Z0</span></h1>
						</td>
						<td  style="width: 50%;">
							<h1 style="margin-bottom: 0px; font-size: 22px; text-align: right;">Order Number:<span style="font-weight: 100; font-size: 14px;">{{$orderDetails->order_id}}</span></h1>
							<?php 
			                	$dt = new DateTime($orderDetails->created_at);
		                        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

		                        $dt->setTimezone($tz);
		                        $start_date = $dt->format("d-m-Y H:i:s");   
			                    $ex = explode(" ",$orderDetails->created_at)
			                ?>
							<h1 style="margin-bottom: 0px; font-size: 22px; text-align: right;">Order Date:<span style="font-weight: 100; font-size: 14px;">{{$start_date}}</span></h1>
							<!-- <p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">Rajnesh kumar</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">Sector 45 Chandigarh</p>
							<p style="margin-bottom: 0px; margin-top: 0px; font-size: 17px; text-align: right;">road</p> -->
						</td>
					</tr>
				</table>
				<!-- <table style="width: 100%;">
					<tr style="width: 100%;">
						
						<td  style="width: 50%;">
							<h1 style="margin-top: 0px; font-size: 22px; margin-bottom: 0px;">Order Number: <span style="font-weight: 100; font-size: 14px;">{{$orderDetails->order_id}}</span></h1>
							<?php 
			                	$dt = new DateTime($orderDetails->created_at);
		                        $tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

		                        $dt->setTimezone($tz);
		                        $start_date = $dt->format("d-m-Y H:i:s");   
			                    $ex = explode(" ",$orderDetails->created_at)
			                ?>
			                <h1 style="margin-top: 0px; font-size: 22px; margin-bottom: 0px;">Order Date: <span style="font-weight: 100; font-size: 14px;">{{$start_date}}</span></h1>
						</td>
						<td  style="width: 50%;">
							<h1 style="margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Invoice Number:<span style="font-weight: 100; font-size: 14px;"> DEL2-264709</span></h1>
							<h1 style="margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Invoice Details:<span style="font-weight: 100; font-size: 14px;"> HR-DEL2-1034-1718</span></h1>
							<h1 style="margin-top: 0px; margin-bottom: 0px; font-size: 22px; text-align: right;">Invoice Date: <span style="font-weight: 100; font-size: 14px;">25.01.2018</span></h1>
						</td>
					</tr>
				</table> -->
				<table style="font-family: arial, sans-serif; border-collapse: collapse; width: 100%; margin-top: 20px; " class="table">
					<tr>
						<thead>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Sr. No.</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Product Image</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Order Id</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Sub Order Id</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Product Name</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Quantity</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Amount</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Extra Discount</th>
							<th style="background-color: #eee; color: black;  border: 1px solid black;">Total Amount</th>
							<!-- <th style="background-color: #eee; color: black;  border: 1px solid black;">Total Amount</th> -->
						</thead>
					</tr>
					<?php
						$f = 0;
						$copoun1= 0;
						?>
					@if(count($order)>0)
						@foreach($order as $key=> $r)
							<?php 
								$count = $key+1;  
								if($r->type == 1 ||$r->type == 2){
								$status = DB::table('order_status')->where('status_value',$r->order_status)->first();  
								$image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
								$product_category = DB::table('products')->where('products_id',$r->prod_id)->first(); 
								//dd($product_category);
								$vendor = DB::table('vendors')->where('main_category',$product_category->categories)->get();   
								}elseif($r->type == 3){
									$status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 
									$image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first(); 
									$vendor = DB::table('vendors')->where('main_category',15)->get();  
								}

								$copoun = DB::table('order_coupon_histories')->where('order_id',$r->order_id)->first();  
							?>
							<tr>
								<td style="border: 1px solid black;">{{$count++}}</td>
								<td style="border: 1px solid black;"> 
									@if(($r->type == 1 ||$r->type == 2) && file_exists(public_path($image)))
									<img src="{{ asset($image) }}" style="width:80px;"> 
									@elseif($r->type == 3 && file_exists(public_path($image)))
									<img src="{{ asset($image) }}" style="width:80px;"> 
									@else
                                    <img src="{{asset('UI/images/product_default1.png')}}" style="width:80px;">
									@endif
								</td>
								<td style="border: 1px solid black;">{{$r->order_id}} </td> 
								<td style="border: 1px solid black;">{{$r->sub_order_id}} </td>  
								<td style="border:1px solid black;">{{$r->prod_name}} </td> 
								<td style="border: 1px solid black;">{{$r->quantity}}</td> 
								<td style="border: 1px solid black;">{{$r->sub_total}}</td>  
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
									{{$r->quantity * $r->sub_total - $discount * $r->quantity}}  
									@else
									<?php
									$f = $f+$r->quantity * $r->sub_total;
									?>
									{{$r->quantity * $r->sub_total}} 
									@endif
								</td>    
								<!-- <td style="border: none;">Seagate Backup Plus Slim 2TB Portable External Hard Drive (Blue) (STDR2000302) | B00GO0I7B4( B00GO0I7B4 )HSN:8471<br>Shipping Charges</td>
								<td style="border: 1px solid black;">???4,999.15<br>???42.37</td>
								<td style="border: 1px solid black;">???0.00<br>-???42.37</td>
								<td rowspan="2" style="border: 1px solid black;">1</td>
								<td style="border: 1px solid black;">???4,999.15<br>???0.00</td>
								<td style="border: 1px solid black;">18%<br>18</td>
								<td style="border: 1px solid black;">IGST<br>IGST</td>
								<td style="border: 1px solid black;">???899.85<br>???0.00</td>
								<td style="border: 1px solid black;">???5,899.00<br>???0.00</td> -->
							</tr>
					@endforeach
					<!-- <tr>
						<td colspan="8" style="font-weight: 700; color: black; border: 1px solid black;">TOTAL:</td>
						<td style=" background-color: #eee; border: 1px solid black;">???899.85</td>
						<td style=" background-color: #eee; border: 1px solid black;">???5,899.00</td>
					</tr>
					<tr>
						<td colspan="10" style="font-weight: 700; color: black; border: 1px solid black;">Amount in Words:<br>Five Thousand Eight Hundred And Ninety-nine only</td>
					</tr> -->
					<tr>
							<td colspan="8" style="font-weight: 700; color: black;">SUB TOTAL:</td>
							<td style=" background-color: #eee;">???{{$f}}</td> 
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">COUPON AMOUNT:</td>
							@if($copoun != null) 
								@php
									$copoun = DB::table('coupons')->where('copoun_code',$copoun->coupon_code)->first(); 
								@endphp
								@if(!empty($copoun) && $copoun->type == 'fixed') 
								<td style=" background-color: #eee;">???{{round($copoun1 = $copoun->amount,2)}}</td> 
								@elseif(!empty($copoun) && $copoun->type == 'percentage') 
								<td style=" background-color: #eee;">???{{ round($copoun1 = $f * $copoun->amount/100 ,2)}}</td>
								@endif
							
							@else
							<td style=" background-color: #eee;">???0</td> 
							@endif
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">DEWALLET AMOUNT:</td>
							@if($orderDetails->de_wallet_coin != null) 
							<td style=" background-color: #eee;">???{{$orderDetails->de_wallet_coin  * 0.25}}</td> 
							@else
							<td style=" background-color: #eee;">???0</td> 
							@endif
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">SHIPPING CHARGES:</td>
							@if($orderDetails->shipping_charge != null)
							<td style=" background-color: #eee;">???{{$orderDetails->shipping_charge}}</td> 
							@else
							<td style=" background-color: #eee;">???0</td> 
							@endif
						</tr>
						@php
							$f = $f-$orderDetails->de_wallet_coin  * 0.25 - $copoun1 + $orderDetails->shipping_charge;
						@endphp
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">TOTAL AMOUNT:</td>
							<td style=" background-color: #eee;">???{{round($f,2)}}</td> 
						</tr>
					<tr>
                    adasdasd
						<td colspan="10" style="font-weight: 700; color: black; text-align: right; border: 1px solid black;">Aensa Health Solutions Private Limited:<br><img src="{{asset('UI/images/invoice-signature.jpeg')}}" style="width: 100px; border: 1px solid black;"> <br>Authorized Signatory</td>
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