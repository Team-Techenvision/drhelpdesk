<style>
		
.WLgeU{
        width:200px;
        height:200px;
    }

#sidebarpop{
	     display: none;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 999;
        background: #6c8f96;
        padding: 15px;
        width: 25%;
        height: 100vh;
		}
		#sidebarpop1{
			display: none;
			position: fixed;
		    top: 0;
		    right: 0;
		    z-index: 999;
		    background: white;
            padding: 20px;
            width: 30%;
            height: 100vh;
		}
		.sideform{
		-webkit-box-pack: start;
	    -ms-flex-pack: start;
	    justify-content: flex-start;
	    padding: 15px;
	    background-color: #fff;
	    border: 1px solid #dfe3e6;
	    border-radius: 10px;
	    font-size: 14px;
	    font-weight: 700;
		}
		.iconimg {
	    height: 20px;
	    position: absolute;
	    right: 5px;
	    top: 40px;
	   }

		input {
		    width:100%;
		}
		.iconimg {
	    height: 20px;
	    position: absolute;
	    right: 5px;
	    top: 5px;
	   }
	   .presentationform .form-group{
	   	position: relative;
	   }
	   .inputtext{
	   	position: absolute;
	    top: 5px;
	    left: 10px;
	   }
	   .presentationform h3{
	   	color: white;
	   	font-size: 20px;
	   	margin-bottom: 10px;
	   }
	#sidebarpop .close {
        position: absolute;
        padding: 15px;
        top: 30px;
        left: -43px;
        z-index: 2;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        cursor: pointer;
        background: #6c8f96;
        color: #ffffff;
        opacity: inherit;
        right: auto;
        /* border: 1px solid #1d99b60f; */
    }
    #sidebarpop h3{
     color: white;
    }
    #sidebarpop .form-control {
        border-radius: 2px;
        background-clip: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, background .15s ease-in-out;
        color: #262626;
        background-color: #ebebeb;
        border: 1px solid #ebebeb;
        height: 40px;
        padding: 7.5px 10px;
        font-size: 16px;
        line-height: 19px;
    }
	#sidebarpop1 .close {
	    position: absolute;
	    padding: 15px;
	    top: 30px;
	    left: -43px;
	    z-index: 2;
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    cursor: pointer;
	    background: #1d99b6;
	    color: #8897a2;
	    opacity: inherit;
	    right: auto;
	}
	@media (max-width: 756px) {

#sidebarpop {
    display: none;
    position: fixed;
    top: 0;
    right: 0;
    z-index: 999;
    background: #6c8f96;
    padding: 15px;
    width: 41%;
    height: 100vh;
}
}
  </style>
<div class="site__body">
			<div class="block-space block-space--layout--divider-xs"></div>
			<div class="block block-brands block-brands--layout--columns-6-full">

				<div class="container">
                	<div class="alert alert-success alert-dismissable"id="message" style="display:none; margin-top: 20px;">
		       			 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        		prescriptio upload succesfully
		     		</div>
                    <div class="row">
                 <?php 

                     $prescriptions=DB::table('prescriptions')->where('user_id',Auth::user()->id)->where('status', '1')->orderBy('id','desc')->get();
                        if(!empty($prescriptions)){
                            $result=$prescriptions;
                        }else{
                            $result='Upload Prescription';
                        }
                 ?>
        <div class="col-lg-12">
            <div class="dashboard-right">
               <div class="dashboard">
                  <div class="box-account box-info w-100">
                     <div class="box-head">
                        <div class="row">
                                 @if(Auth::check())
                             @if($result != null)
                           <div class="col-md-12">
                              <!-- <button type="button" class="btn btn-solid" data-toggle="collapse" data-target="#demo">View Status</button> -->
                              <div id="demo" class="collapse">
                                 <br>
                                 <div class="table-responsive">
                                    <table class="table cart-table ">
                                       <thead>
                                          <tr class="table-head">
                                             <th scope="col">Prescription</th>
                                             <th scope="col">Medicine</th>
                                             <th scope="col">status</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($result as  $r1)   
                                          <tr>
                                             <td class="prescription2">
                                                <a href="{{ asset($r1->prescription_image) }}"><img src="{{ asset($r1->prescription_image) }}" class="img-fluid" alt="Prescription"></a>
                                             </td>
                                             <td>
                                                &nbsp;{{$r1->comment}}
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                          @endforeach
                                       </tbody>
                                       <!-- <tbody>
                                          <tr>
                                             <td class="prescription2">
                                                <a href="#"><img src="../assets/images/prescription.jpg" class="img-fluid" alt="1"></a>
                                             </td>
                                             <td>
                                                &nbsp;
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                       </tbody>
                                       <tbody>
                                          <tr>
                                             <td class="prescription2">
                                                <a href="#"><img src="../assets/images/prescription.jpg" class="img-fluid" alt="1"></a>
                                             </td>
                                             <td>
                                                &nbsp;
                                             </td>
                                             <td>
                                                <button class="btn btn-success">Approved</button>
                                             </td>
                                          </tr>
                                       </tbody> -->
                                       @else 
                                       <div class="row cart-buttons">
                                                <div class="col-12"><a href="{{url('/')}}" class="btn btn-solid">continue shopping</a></div>
                                            </div>  
                                        @endif  
			                            @endif
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h2>Existing Prescription</h2>
                     </div>
                     <div class="box">
                        <div class="row">
						<form action="{{url('/prescription-checkout')}}" name="prescription_list_form" method="post" class="row">
                        <?php $i=1; ?>
                        @foreach($result as  $r1)
                                @if($r1->prescription_image != null)
								<div class="col-sm-4 prescription">
													

								<input type="radio" class="form-check-input float-left" style="width:50%!important;" name="prescription_list" value="{{$r1->id}}" required >
                                        <img src="{{ asset($r1->prescription_image) }}" class="img-fluid" alt="prescription">
                                        <div>
											<b>Prescription  <?php echo $i; ?> </b><br><b> <?php echo date('d-m-Y', strtotime($r1->created_at)); ?></b><br>
											<button class="btn btn-solid">Submit</button> &nbsp; 
											<button class="btn btn-solid">Delete</button> 										
                                        </div>	
								</div>

                          		 <!-- <div class="col-sm-4 prescription">                          
                                    <address>									
                                        <input type="radio" class="form-check-input text-left" name="prescription_id" value="{{$r1->id}}">
                                        <img src="{{ asset($r1->prescription_image) }}" class="img-fluid" alt="prescription">
                                        <div>
											<b>Prescription  < ?php echo $i; ?> </b><br><b> < ?php echo date('d-m-Y', strtotime($r1->created_at)); ?></b><br>
                                        	<button class="btn btn-solid">Submit</button> &nbsp; 
											<button class="btn btn-solid">Delete</button> 										
                                        </div>									
                                    </address>                             
                           		</div>   -->
						                        
                           <?php $i++; ?>
                           @endif                          
                            @endforeach
							<input type="hidden" name="user_id" value="{{$r1->user_id}}" >
							</form>
                           <!-- <div class="col-sm-6 prescription">
                              <address>
                                 <input type="radio" class="form-check-input" name="optradio">
                                 <img src="../assets/images/prescription.jpg" class="img-fluid" alt="prescription">
                                 <div><b>Prescription 2</b><br><b>5-Dec-2020</b><br>
                                    <button class="btn btn-solid">Submit</button> &nbsp; <button class="btn btn-solid">Delete</button> 
                                 </div>
                              </address>
                           </div> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

                    </div>
               </div>

            </div>
         </div>
                     </div>
				    <!-- Start Listing -->
				<!-- <div class="row">
					<div class="col-md-12">
						<div class="row">
                        
							<div class="col-md-12">
								<div class="float-left">
								<h3>Prescription List</h3>
								</div>
							</div>
						</div>
						<div class="row">
						<form action="{{url('/prescription-checkout')}}" name="prescription_list_form" method="post">
						@if(is_array($prescription_list) && !empty($prescription_list))
							<div class="col-md-12">
							@foreach($prescription_list as  $key=>$details)
								<div class="custom-control custom-radio prescription_list">
									@php 
										$prescription_image = $details['prescription_image'];

										$exlode_array = explode('/', $prescription_image);

										$exlode_image = end($exlode_array);
									@endphp
									
									@if($key == '0')
										<input type="radio" class="custom-control-input" id="prescription_list_{{$key}}" value="{{$details['id']}}" name="prescription_list" checked>

										
										<label class="custom-control-label" for="prescription_list_{{$key}}">{{$exlode_image}}</label>
										&nbsp
										&nbsp
										<a href="{{asset($details['prescription_image'])}}" download target="_blank"> <i class="fa fa-download" aria-hidden="true"></i> </a>
									@else
										<input type="radio" class="custom-control-input" id="prescription_list_{{$key}}" value="{{$details['id']}}" name="prescription_list">
										<label class="custom-control-label" for="prescription_list_{{$key}}">{{$exlode_image}}</label>
										&nbsp
										&nbsp
										<a href="{{asset($details['prescription_image'])}}" download target="_blank"> <i class="fa fa-download" aria-hidden="true"></i> </a>
									@endif
									@csrf
                                	<input type="hidden" name="prescription_type" value="{{$type}}">
									<input type="hidden" name="user_id" value="{{$details['user_id']}}">
								</div>
								
							@endforeach 
							</div>
							<div class="col-md-6">
    							<div class="_1-Hc6"><button type="submit" id="prescription_select" class="btn btn-primary">submit</button></div>
								</div>
							
						@else
								<div class="col-md-12">
									<div class="float-left">
									<h3>Prescription Not Found</h3>
									</div>
								</div>
						@endif
</form>
						</div>
					</div>
				</div> -->
				<!-- End Listing -->
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="float-left">
									<h3>Upload Prescription</h3>
									</div>
								</div>
							</div>
							<! -- <div class="_1ugOt"><img class="WLgeU" src="{{asset('UI/images/Untitled-2.png')}}"></div> - ->
						</div>
						
						<div class="col-md-6">
							<div class="_3-Klh _1lp7v"><div class="_1-Hc6"><button type="button" class="_2FE4Z h1H8I _2Jc-Z _3LBfS" style="width: 100%;" onclick="sidePop()">Upload Prescription</button></div>
							<! --<div class="_1-Hc6"><button class="_2FE4Z _2Jc-Z _2Jc-Z _2N8KX _3LBfS" style="width: 100%;">Select Lab</button></div>- ->
						    </div>
						</div>

					</div> -->



                  




					<!-- <div class="block-space block-space--layout--divider-xs"></div> -->
		<!-- <div class="row">
			<div class="col-md-3">
				<div style="border-right: 1px solid #ccc;">
					<div class="_34lUB"><img src="{{asset('UI/images/trusted.png')}}" alt="Trusted Labs" class="pdcGW "></div>
					<div class="qrwng"><strong>Trusted Labs</strong></div>
					<div class="_2XOfq">Every test booked via Drhelpdesk is conducted by an ISO or NABL certified lab that are 100% verified and trustworthy.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div style="border-right: 1px solid #ccc;">
					<div class="_34lUB"><img src="{{asset('UI/images/homevist.png')}}" alt="Home Visit" class="pdcGW "></div>
					<div class="qrwng"><strong>Home Visit</strong></div>
					<div class="_2XOfq">With Drhelpdesk, you get a FREE sample pick-up* by professional phlebotomists from your home or preferred location.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div style="border-right: 1px solid #ccc;">
					<div class="_34lUB"><img src="{{asset('UI/images/timely.png')}}" alt="Timely and Accurate Reports" class="pdcGW "></div>
					<div class="qrwng"><strong>Timely and Accurate Reports</strong></div>
					<div class="_2XOfq">Once collected, samples will be sent to labs for processing. Detailed reports will be shared within a stipulated timeline.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div>
					<div class="_34lUB"><img src="{{asset('UI/images/upto.png')}}" alt="Up to 70% OFF" class="pdcGW benefitIcon--small"></div>
					<div class="qrwng"><strong>Up to 70% OFF</strong></div>
					<div class="_2XOfq">At Drhelpdesk, you save at every step! On diagnostic tests, get up to 70% OFF on various tests and test packages.</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="block-space block-space--layout--divider-xl"></div> -->
		<!-- <div class="row">
			<div class="col-md-5">
				<div class="_1RHQr">
					<img alt="footer_mobile" src="{{asset('UI/images/DHD02.png')}}">
				</div>
			</div>
			<div class="col-md-7">
				<div style="font-weight: 600; margin-top: 10%; font-size: 27px;">
					<div>Download the App for Free</div>
					 <div class="_19UrT"><a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/3380aedc.png" alt="Google Play" class="iQq1x"><div class="Ut8SA">Google Play</div></a><a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9bf5c576.png" alt="App Store" class="iQq1x"><div class="Ut8SA">App Store</div></a></div>
				</div>
			</div>
		</div> -->
				</div>
			</div>
			<div class="block-space block-space--layout--divider-sm"></div>
			
		</div>
		<!-- site__body / end -->

		<!----sidebarpop start------>
		<div id="sidebarpop">
		    <span class="close">&times;</span>
			<div>
				<form class="presentationform" id="presentationform" method="post" enctype="multipart/form-data">
					<h3>Upload Prescription</h3>
					<div class="form-group">
						<img src="{{asset('UI/images/Gallery.png')}}" alt="" class="iconimg" />
						@csrf
                       <input type="file" name="prescription_image" class="form-control" id="prescription_image" />
                       <input type="hidden" name="prescription_type" value="<?php echo $type; ?>" class="form-control" id="prescription_type" />
                    <!-- 
                       <div class="inputtext">Gallery</div> -->
					</div>
					<!--
					<div class="form-group" onclick="sidePop1()">
						<img src="{{asset('UI/images/Doctor.png')}}" alt="" class="iconimg">
                       <input type="text" class="form-control">
                       <div class="inputtext" class="form-control">DHD Doctor Consultations</div>
					</div>
					<div class="form-group">
						<img src="{{asset('UI/images/User.png')}}" alt="" class="iconimg">
                       <input type="text" class="form-control">
                       <div class="inputtext">Prescriptions Uploaded By You</div>
					</div>
					-->
				
				</form>
			</div>
		</div>
		<div id="sidebarpop1">
		    <span class="close" style="color: black;">&times;</span>
			<!--<div>-->
			<!--	<form class="presentationform">-->
			<!--		<img src="{{asset('UI/images/DHD-Logo.png')}}" style="width: 70%;">-->
			<!--		<h2 class="whS8Y">Quick Login / Register</h2>-->
			<!--		<div class="JWC9H"><div class="_9NYTx"><div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/ddfa883a.svg" alt="value"></div><div class="_2cTfs">Upto<br>70% Off<br>&nbsp;</div></div><div class="_9NYTx"><div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/92fed933.svg" alt="value"></div><div class="_2cTfs">Home Sample<br>Pickup</div></div><div class="_9NYTx"><div><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d69892a2.svg" alt="value"></div><div class="_2cTfs">Trusted<br>Labs</div></div></div>-->
			<!--		<form class="_3pWYN"><div class="_2wtwM"><div class="jss24 jss33 _22kUX"><input class="jss34 _9Rsw_ jss37 form-control" id="mobileNoInput" name="mobile" placeholder="Enter your phone number" required="" type="tel" maxlength="10" value=""></div></div><button class="_2FE4Z _2Jc-Z _2Jc-Z _1UB6b" id="mobileNoSubmitBtn" type="submit" style="width: 100%; margin-top: 20px;">Continue</button></form>-->
			<!--		<div class="_1kg6j">By clicking continue, you agree with our<a class="_3lsSa" href="/privacy-policy"> Privacy Policy </a></div>-->
			<!--	</form>-->
			<!--</div>-->
		</div>
		<div id="sidebarpop">
		    <span class="close">&times;</span>
			<div>
				<!--<form class="presentationform">-->
					<h3>Upload Presciption</h3>
					<div class="form-group">
						<img src="{{asset('UI/images/Doctor.png')}}" alt="" class="iconimg">
                       <input type="file" class="form-control"><!-- 
                       <div class="inputtext">Gallery</div> -->
					</div>
					<div class="form-group" onclick="sidePop1()">
						<img src="{{asset('UI/images/Doctor.png')}}" alt="" class="iconimg">
                       <input type="text" class="form-control">
                       <div class="inputtext" class="form-control">DHD Doctor Consultations</div>
					</div>
					<div class="form-group">
						<img src="{{asset('UI/images/Doctor.png')}}" alt="" class="iconimg">
                       <input type="text" class="form-control">
                       <div class="inputtext">Prescriptions Uploaded By You</div>
					</div>
				<!--</form>-->
			</div>
		</div>


