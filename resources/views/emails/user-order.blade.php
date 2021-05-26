@php 
	$dt = new DateTime($order_detail->created_at);
	$tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after 
	$dt->setTimezone($tz);
	$start_date = $dt->format("d-m-Y"); 
	$order_item = DB::table('order_items')->where('order_id',$order_detail->order_id)->get(); 
	$f = 0;
	$copoun1= 0;
	$extra_discount = 0;
	$extra_discount_1 = 0;
	$total_amount = 0;
	$total = 0;
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head> 
	<title>Order Placed</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 ">
	<meta name="format-detection" content="telephone=no">
	<!--[if !mso]><!-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<!--<![endif]-->
	<style type="text/css">
		body {
			margin: 0 !important;
			padding: 0 !important;
			-webkit-text-size-adjust: 100% !important;
			-ms-text-size-adjust: 100% !important;
			-webkit-font-smoothing: antialiased !important;
		}
		img {
			border: 0 !important;
			outline: none !important;
		}
		p {
			Margin: 0px !important;
			Padding: 0px !important;
		}
		table {
			border-collapse: collapse;
			mso-table-lspace: 0px;
			mso-table-rspace: 0px;
		}
		td, a, span {
			border-collapse: collapse;
			mso-line-height-rule: exactly;
		}
		.ExternalClass * {
			line-height: 100%;
		}
		.em_defaultlink a {
			color: inherit !important;
			text-decoration: none !important;
		}
		span.MsoHyperlink {
			mso-style-priority: 99;
			color: inherit;
		}
		span.MsoHyperlinkFollowed {
			mso-style-priority: 99;
			color: inherit;
		}
		@media only screen and (min-width:481px) and (max-width:699px) {
			.em_main_table {
				width: 100% !important;
			}
			.em_wrapper {
				width: 100% !important;
			}
			.em_hide {
				display: none !important;
			}
			.em_img {
				width: 100% !important;
				height: auto !important;
			}
			.em_h20 {
				height: 20px !important;
			}
			.em_padd {
				padding: 20px 10px !important;
			}
		}
		@media screen and (max-width: 480px) {
			.em_main_table {
				width: 100% !important;
			}
			.em_wrapper {
				width: 100% !important;
			}
			.em_hide {
				display: none !important;
			}
			.em_img {
				width: 100% !important;
				height: auto !important;
			}
			.em_h20 {
				height: 20px !important;
			}
			.em_padd {
				padding: 20px 10px !important;
			}
			.em_text1 {
				font-size: 16px !important;
				line-height: 24px !important;
			}
			u + .em_body .em_full_wrap {
				width: 100% !important;
				width: 100vw !important;
			}
		}
	</style>
</head> 
<body class="em_body" style="margin:0px; padding:0px;" bgcolor="#efefef">
	<table class="em_full_wrap" valign="top" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#efefef" align="center">
  		<tbody>
  			<tr>
    			<td valign="top" align="center">
    				<table class="em_main_table" style="width:700px;" width="700" cellspacing="0" cellpadding="0" border="0" align="center">
				        <!--Header section-->
				        <tbody>
				        	<tr>
				          		<td style="padding:15px;" class="em_padd" valign="top" bgcolor="#1d99b5" align="center">
				          			<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
				              			<tbody>
				              				<tr>
				                				<td style="font-family:'Open Sans', Arial, sans-serif; font-size:12px; line-height:15px; color:#121943;" valign="top" align="center">DrHelpDesk| <a href="https://www.drhelpdesk.in" target="_blank" style="color:#121943; text-decoration:underline;">View Online</a>
				                				</td>
				              				</tr>
				            			</tbody>
				    				</table>  
				       			</td>
        					</tr>
        					<!--//Header section-->  
        					<!--Banner section-->
					        <tr>
					        	<td valign="top" align="center">
					        		<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="background:#fff;">
					        			<tbody>
					        				<tr>
					        					<td valign="top" align="center"><img class="em_img" alt="Order Success" style="display:block; font-family:Arial, sans-serif; font-size:30px; line-height:34px; color:#000000; background:#fff; max-width:265px;" src="{{asset('UI/images/img/logo.png')}}" width="265" border="0" height="150">
					        					</td>
					        				</tr>
					        			</tbody>
					        		</table>
					        	</td>
					        </tr>
        					<!--//Banner section--> 
    						<!--Content Text Section-->
                 			<tr>
          						<td style="padding:25px 50px 24px; border:1px solid #121943" class="em_padd" valign="top" bgcolor="#fff" align="center">
		  							<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
              							<tbody>
              								<tr>
								                <td style="font-family:'Open Sans', Arial, sans-serif; font-size:22px; line-height:25px;color:121943;font-weight:600" valign="top" align="center">Order Confirmation
								                </td>
								            </tr>
              								<tr>
                								<td style="font-size:0px; line-height:0px; height:15px;" height="15">&nbsp;</td>
												<!--—this is space of 15px to separate two paragraphs ---->
								            </tr>
								            <tr>
								                <td style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:18px; color:#121943;  padding-bottom:12px;" valign="top" align="center">Hey {{ucfirst($order_detail->user_name)}}.<br><br> We've got your order! Your World is about to look
												a whole lot better.<br><br> We'll drop you another email when your order ships.
												</td>
								            </tr>
              								<tr>
                								<td class="em_h20" style="font-size:0px; line-height:0px; height:25px;" height="25">&nbsp;</td>
												<!--—this is space of 25px to separate two paragraphs ---->
              								</tr>
											<tr>
												<td style="font-family:'Open Sans', Arial, sans-serif; font-size:18px; line-height:18px; color:#121943;  padding-bottom:12px;" valign="top" align="center">ORDER NO. {{$order_detail->order_id}}<br><span style="color:#444">{{$start_date}}</span></td>
											</tr> 
            							</tbody>
            						</table>
            					</td>
							</tr>
							<tr>
								<td style="padding:9px 50px 4px; color:#121943; border:1px solid #121943" class="em_padd" valign="top" bgcolor="#fff">Item Order</td>
							</tr>
							<tr style="border-top:1px solid #ccc ; border-bottom:1px solid #ccc;">
								<td style="padding:25px 50px 24px; color:#121943; border:1px solid #121943" class="em_padd" valign="top" bgcolor="#fff" >
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
										<tbody> 
											@if(count($order_item)>0)
												@foreach($order_item as $key=> $r)
													@php 
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
													@endphp
													<tr>
														<td>
															@if(($r->type == 1 ||$r->type == 2) && file_exists(public_path($image)))
															<img src="{{ asset($image) }}" alt="product" width="80" height="90">
															@elseif($r->type == 3 && file_exists(public_path($image)))
															<img src="{{ asset($image) }}" alt="product" width="80" height="90"> 
															@else
							                                <img src="{{asset('UI/images/product_default1.png')}}" alt="product" width="80" height="90">
															@endif
														</td>
														<td>{{$r->prod_name}}</td>
														<td>{{$r->quantity}}</td>
														<td>Rs.{{$r->quantity * $r->sub_total}}</td>
													</tr>
													@php
														$extra_discount+= ($r->sub_total * $r->quantity *  $r->extra_discount)/100;
														$extra_discount_1 = ($r->sub_total * $r->quantity *  $r->extra_discount)/100;
													@endphp
													@php $total_amount+=  
														$r->sub_total  * $r->quantity;   
													@endphp 
														@endforeach
													@else
											            No Record found
													@endif
										</tbody>
									</table>
								</td>
							</tr> 
							<tr style="border-top:1px solid #ccc ; border-bottom:1px solid #ccc;">
								<td style="padding:25px 50px 24px; color:#121943;border:1px solid #121943" class="em_padd" valign="top" bgcolor="#fff" >
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
										<tbody>
											
											<tr>
												<td>Discount (Just in case)</td>
												<td>Rs.{{$extra_discount}}</td>
											</tr> 
											<tr style="line-height:35px;">
												<td>Subtotal</td>
												<td>Rs.{{$total_amount}}</td>
											</tr>
											<tr style="line-height:35px;">
												<td>Shipping Charges</td>
												<td>Rs.@if($order_detail->shipping_charge != null){{$order_detail->shipping_charge}}@else 0 @endif</td>
											</tr>
											@php
												$total+= $total_amount - $extra_discount + $order_detail->shipping_charge;
											@endphp
											<tr style="line-height:35px;">
												<td>Total</td>
												<td>Rs.{{$total}}</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr> 
							<tr >
								<td style="padding:25px 50px 24px; color:#121943; border:1px solid #121943;" class="em_padd" valign="top" bgcolor="#fff" >
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
										<tbody>
											<tr>
												<td style="color:#444;">Payment Info</td>		
											</tr>
											@if($order_detail->payment_mode == 'cod' || $order_detail->payment_mode == 'COD')
											<tr style="line-height:35px;"> 
												<td>Cash On Delivery</td>		
											</tr> 
											@else 
											<tr style="line-height:35px;">
												<td><img src="{{asset('UI/images/img/card.png')}}" alt="card" width="30" height="15">(*************1523)</td>	
												<td>Rs.{{$total}}</td>		
											</tr>
											@endif		
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td style="padding:25px 50px 24px; color:#121943;border:1px solid #121943;" class="em_padd" valign="top" bgcolor="#fff" align="center" >
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
										<tbody>
											<tr>
												<td style="color:#444;">Billing info</td>	
												<td style="color:#444; text-align: center;">Shipping Info</td>		
											</tr>
											<tr style="line-height:35px;">
												<td>@if($order_detail->user_name != null){{ucfirst($order_detail->user_name)}}@endif</td>	
												<td style="text-align: center;">@if($order_detail->user_name != null){{ucfirst($order_detail->user_name)}}@endif</td>		
											</tr>
											<tr style="line-height:35px;">
												<td>@if($order_detail->user_address != null){{ucfirst($order_detail->user_address)}},@endif @if($order_detail->user_apartment != null){{ucfirst($order_detail->user_apartment)}},@endif @if($order_detail->user_city != null){{ucfirst($order_detail->user_city)}},@endif</td>	
												<td style="text-align: center;">@if($order_detail->user_address != null){{ucfirst($order_detail->user_address)}},@endif @if($order_detail->user_apartment != null){{ucfirst($order_detail->user_apartment)}},@endif @if($order_detail->user_city != null){{ucfirst($order_detail->user_city)}},@endif</td>		
											</tr>
											<tr style="line-height:35px;">
												<td>@if($order_detail->user_state != null){{ucfirst($order_detail->user_state)}},@endif @if($order_detail->user_country != null){{ucfirst($order_detail->user_country)}},@endif</td>	
												<td style="text-align: center;">@if($order_detail->user_state != null){{ucfirst($order_detail->user_state)}},@endif @if($order_detail->user_country != null){{ucfirst($order_detail->user_country)}},@endif</td>		
											</tr>
											<tr style="line-height:35px;">
												<td>@if($order_detail->pin_code != null){{$order_detail->pin_code}}@endif</td>	
												<td style="text-align: center;">@if($order_detail->pin_code != null){{$order_detail->pin_code}}@endif</td>		
											</tr>
											<tr style="line-height:35px;">
												<td>@if($order_detail->user_email != null){{$order_detail->user_email}}@endif</td> 
											</tr> 
										</tbody>
									</table>
								</td>
							</tr> 
					        <!--//Content Text Section--> 
					        <!--Footer Section-->
							<tr>
								<td style="padding:38px 30px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center">
									<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
										<tbody>
											<tr>
												<td style="padding-bottom:16px;" valign="top" align="center">
													<table cellspacing="0" cellpadding="0" border="0" align="center">
														<tbody>
															<tr>
																<td valign="top" align="center">
																	<a href="https://www.facebook.com/Dr-HelpDesk-Delivering-Health-Digitally-109097117504824/" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/fb.png')}}" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:26px;" width="26" border="0" height="26"></a>
																</td>
																<td style="width:6px;" width="6">&nbsp;</td>
																<td valign="top" align="center"><a href="https://twitter.com/DrHelpDeskIN" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/tw.png')}}" alt="tw" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:27px;" width="27" border="0" height="26"></a>
																</td>
																<td style="width:6px;" width="6">&nbsp;</td>
																<td valign="top" align="center"><a href="https://www.instagram.com/drhelpdesk.in/" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/in.png')}}" alt="yt" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:26px;" width="26" border="0" height="26"></a>
																</td>
																<td style="width:6px;" width="6">&nbsp;</td>
																<td valign="top" align="center"><a href="https://www.linkedin.com/in/DrHelpDesk" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/li.png')}}" alt="yt" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:27px;" width="27" border="0" height="26"></a>
																</td>                   
																<td style="width:6px;" width="6">&nbsp;</td>
																<td valign="top" align="center"><a href="https://in.pinterest.com/DrHelpDeskIN/" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/p.png')}}" alt="yt" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:26px;" width="26" border="0" height="26"></a>
																</td>                    
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											<td style="padding:8px 258px;" class="em_padd" valign="top" bgcolor="#f6f7f8" align="center">
												<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
													<tbody>
														<tr>
															<td valign="top" align="center">
																<a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/app.png')}}" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:60px;" width="60" border="0" height="18"></a>
															</td>

															<td valign="top" align="center">
																<a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" target="_blank" style="text-decoration:none;"><img src="{{asset('UI/images/img/app2.png')}}" alt="fb" style="display:block; font-family:Arial, sans-serif; font-size:14px; line-height:14px;color:121943; max-width:60px;" width="60" border="0" height="18"></a>
															</td> 
														</tr>
													</tbody>
												</table>
											</td> 
											<tr>
												<td style="font-family:'Open Sans', Arial, sans-serif; font-size:11px; line-height:18px; color:#999999;" valign="top" align="center"><a href="{{url('privacy-policy')}}" target="_blank" style="color:#999999; text-decoration:underline;">PRIVACY STATEMENT</a> | <a href="{{url('term-conditions')}}" target="_blank" style="color:#999999; text-decoration:underline;">TERMS OF SERVICE</a> | <a href="{{url('refund-policy')}}" target="_blank" style="color:#999999; text-decoration:underline;">RETURNS</a>
													<br>
													© 2020 Aensa Health Solutions. All Rights Reserved.<br>
													If you do not wish to receive any further emails from us, please <a href="#" target="_blank" style="text-decoration:none; color:#999999;">unsubscribe</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td class="em_hide" style="line-height:1px;min-width:700px;background-color:#121943fff;"><img alt="" src="images/spacer.gif" style="max-height:1px; min-height:1px; display:block; width:700px; min-width:700px;" width="700" border="0" height="1">
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<div class="em_hide" style="white-space: nowrap; display: none; font-size:0px; line-height:0px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div>
</body>
</html>