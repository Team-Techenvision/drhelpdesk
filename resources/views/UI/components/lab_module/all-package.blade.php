<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full">
	<div class="container">
		@if(session('message') != null)
	      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        {{session('message')}}
	      </div>
	    @endif 
		<div class="row">
			<?php
	            $package = $package->toArray();
	            $package = $package['data'];
	            $countRecords = count($package);
	            $col1 = array_slice($package, 0, $countRecords/2 + 0.5);
	            $col2 = array_slice($package, $countRecords/2 + 0.5, $countRecords);
	           //dd($package,$col1,$col2);
            ?>
			<div class="col-md-12">
				<div class="float-left">
				<h3>All Packages</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5"> 
				@foreach($col1 as $r)
					@php          
	                    $session = Session::getId();  
	                    $data1=DB::table('temp_carts')->where('product_id',$r['id'])->where('session_id',$session)->where('type',3)->first();  
	                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
	                    $discount = ($r['offer_discount'] * $r['package_cost']) / 100;
	                    $discount1 = $r['package_cost'] - $discount; 
	                 
	                    $package_id = explode(",",$r['package']);    
	               	@endphp 
	               	<?php
						$per = 0;
						if($r['special_price'] >0 && $r['special_price'] != null && $r['package_cost'] > 0){
						    $s = $r['package_cost'] - $r['special_price'];
						    $per = round(($s*100)/$r['package_cost'],2);
						    $per = round($per,2); 
						}                      
					?>
					<!-- <a href="test-detail1.html"> -->
						<div class="alltest-box">
							<div>
								@if(file_exists(public_path($r['image'])))
					                <img class="_1xG27" src="{{asset($r['image'])}}" alt="Package" width="50px">
					            @elseif($r['image'] == null)
					                <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package" width="50px">
					            @else 
					                <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package" width="50px">
					            @endif   
								<!-- @if($r['image'] == null)  
								@else
								<img class="_1xG27" src="{{asset($r['image'])}}" alt="Package" width="50px">
								@endif  -->
								<div class="alltest-content">
									<div class="alltest-heading"><a href="{{url('package-detail/'.$r['id'])}}">{{$r['package_name']}}</a></div>
									<div class="alltest-p">{{$r['short_disc']}}</div>
									<div tabindex="0" role="button" class="_2tdEn _2uX0L _1b_3-"><div class="">Includes {{ count($package_id)}} tests</div><div class="tKMWl"><a href="{{url('package-detail/'.$r['id'])}}" style="color:#55a8a6">Show all</a></div></div> 
									<div class="_3EF-x _3BZ_8">
									@if($r['special_price'] == null)
	                                  <span class="_3eI77">₹{{$r['package_cost']}}</span> 
					                @else
					                    <span class="_3eI77">₹{{$r['special_price']}}</span> 
					                    <span class="_20PV9">₹{{$r['package_cost']}}</span>
					                    <span class="_3NghB">save {{round($per)}}%</span>
					                @endif

									 
					                </div>  
								</div>
							</div><!-- 
							<button class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L">Select</button> -->
							@guest  
								@if($data1 == null)
								    @if(Session::get('location_name')!='notfound')
							 		<a href="{{url('package-add-cart/'.$r['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 	    @else
							 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 		@endif
							 	@else
							 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
							 	@endif
							@else 
								@php
									$cart=DB::table('carts')->where('product_id',$r['id'])->where('user_id',Auth::user()->id)->where('type',3)->first();  
									$check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
								@endphp
								@if($cart==null)
								    @if(Session::get('location_name')!='notfound')
							 		<a href="{{url('package-add-cart/'.$r['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 	    @else
							 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 		@endif
							 	@else
							 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
							 	@endif  
							@endif
						</div>
					<!-- </a>  -->
				@endforeach 
			</div>
			<div class="col-md-5"> 
				@foreach($col2 as $r)
					@php         
	                    $session = Session::getId();  
	                    $data1=DB::table('temp_carts')->where('product_id',$r['id'])->where('session_id',$session)->where('type',3)->first();  
	                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
	                    $discount = ($r['offer_discount'] * $r['package_cost']) / 100;
	                    $discount1 = $r['package_cost'] - $discount; 
	                    $package_id = explode(",",$r['package']);      
	                @endphp 
	                <?php
						$per = 0;
						if($r['special_price'] >0 && $r['special_price'] != null && $r['package_cost'] > 0){
						    $s = $r['package_cost'] - $r['special_price'];
						    $per = round(($s*100)/$r['package_cost'],2);
						    $per = round($per,2); 
						}                      
					?>
					<!-- <a href="test-detail1.html"> -->
						<div class="alltest-box">
							<div>
								@if(file_exists(public_path($r['image'])))
					                <img class="_1xG27" src="{{asset($r['image'])}}" alt="Package" width="50px">
					            @elseif($r['image'] == null)
					                <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package" width="50px">
					            @else 
					                <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package" width="50px">
					            @endif   
								<!-- @if($r['image'] == null)  
								@else
								<img class="_1xG27" src="{{asset($r['image'])}}" alt="Package" width="50px">
								@endif  -->
								<div class="alltest-content">
									<div class="alltest-heading"><a href="{{url('package-detail/'.$r['id'])}}">{{$r['package_name']}}</a></div>
									<div class="alltest-p">{{$r['short_disc']}}</div>
									<div tabindex="0" role="button" class="_2tdEn _2uX0L _1b_3-"><div class="">Includes {{ count($package_id)}} tests</div><div class="tKMWl"><a href="{{url('package-detail/'.$r['id'])}}" style="color:#55a8a6">Show all</a></div></div> 
									<div class="_3EF-x _3BZ_8">
									 
					                @if($r['special_price'] == null)
	                                  <span class="_3eI77">₹{{$r['package_cost']}}</span> 
					                @else
					                    <span class="_3eI77">₹{{$r['special_price']}}</span> 
					                    <span class="_20PV9">₹{{$r['package_cost']}}</span>
					                    <span class="_3NghB">save {{round($per)}}%</span>
					                @endif
					                </div>  
								</div>
							</div><!-- 
							<button class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L">Select</button> -->
							@guest  
								@if($data1 == null)
								    @if(Session::get('location_name')!='notfound')
							 		<a href="{{url('package-add-cart/'.$r['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 	    @else
							 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 		@endif
							 	@else
							 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
							 	@endif
							@else 
								@php
									$cart=DB::table('carts')->where('product_id',$r['id'])->where('user_id',Auth::user()->id)->where('type',3)->first();  
									$check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
								@endphp
								@if($cart==null)
								    @if(Session::get('location_name')!='notfound')
							 		<a href="{{url('package-add-cart/'.$r['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 	    @else
							 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
							 		@endif
							 	@else
							 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
							 	@endif  
							@endif
						</div>
					<!-- </a>  -->
				@endforeach 
			</div>
<!-- 			<div class="col-md-2">
				<div>
					<h5 class="_2zKF7">Order Summary</h5>
					<div class=""><div class="_31z1j">Please select a Package to proceed
						<a href="{{url('/my-cart')}}"  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L ZHQJn">View</a>    
					</div></div> 
				</div>
			</div> --> 
		</div>
		<div class="products-view__pagination"> 
				<nav aria-label="Page navigation example"> 
					<ul class="pagination">  
						{{ $package2->appends($page)->links() }} 
					</ul> 
				</nav> 
			</div>
		<div class="block-space block-space--layout--divider-xs"></div>
		<div class="row">
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
		</div>
		<div class="block-space block-space--layout--divider-xl"></div>
		<div class="row">
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
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>