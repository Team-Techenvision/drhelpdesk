<style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
       right: 20px;
       position: absolute;
    }
    .includelab li{
        font-size: 14px;
        list-style: none;
        margin-bottom: 5px;
    }
	.lab-det img{ 
    width: 400px;
    height: 500px;
    object-fit: cover;
}
</style>
<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="float-left">
                <h3>Affordable Packages</h3>
                </div>
            </div>
        </div>
        @php  
            $session = Session::getId();  
            $data1=DB::table('temp_carts')->where('product_id',$pck['id'])->where('session_id',$session)->where('type',3)->first();  
            $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
           
            $discount = ($pck['offer_discount'] * $pck['package_cost']) / 100;
            $discount1 = $pck['package_cost'] - $discount;

            $package_id = explode(',',$pck['package']); 
             $lab_page = DB::table('banners')->where('page_name','packagepage')->where('location','promotional')->where('show_on','web')->where('status',0)->first();  
             
       @endphp
        <?php
            
            $per = 0;
            if($pck['special_price'] >0 && $pck['special_price'] != null && $pck['package_cost'] > 0){
                $s = $pck['package_cost'] - $pck['special_price'];
                $per = round(($s*100)/$pck['package_cost'],2);
                $per = round($per,2); 
            }                      
        ?>
        <div class="row">
            <div class="col-md-7">
                <div class="alltest-box-d" style="margin-top: 0px;">
                    <div>
                        @if(file_exists(public_path($pck['image'])))
                            <img class="_1xG27" src="{{asset($pck['image'])}}" alt="Package">
                        @elseif($pck['image'] == null)
                            <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package">
                        @else 
                            <img class="_1xG27" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Package">
                        @endif   
                        <div class="alltest-content">
                            <div class="alltest-heading">{{$pck['package_name']}}</div>
                            <div class="alltest-p">{{ $pck['short_disc']}}</div>
                            <div tabindex="0" role="button" class="_2tdEn _2uX0L _1b_3-"><div class="">Includes {{ count($package_id)}} tests</div></div>
                            <div class="_3EF-x _3BZ_8">
                                @if($pck['special_price'] == null)
                                   <span class="_3eI77">₹{{$pck['package_cost']}}</span> 
                                @else
                                    <span class="_3eI77">₹{{$pck['special_price']}}</span>                                 
                                    <span class="_20PV9">₹{{$pck['package_cost']}}</span>
                                    <span class="_3NghB">save {{round($per)}}%</span>
                                @endif
                            </div>   
                        </div>
                    </div>
                    @guest  
                        @if($data1 == null)
                            @if(Session::get('location_name')!='notfound')
                            <a href="{{url('package-add-cart/'.$pck['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
                            @else
                            <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
                            @endif
                        @else
                            <a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
                        @endif
                    @else 
                        @php
                            $cart=DB::table('carts')->where('product_id',$pck['id'])->where('user_id',Auth::user()->id)->where('type',3)->first();  
                            $check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
                        @endphp
                        @if($cart==null)
                            @if(Session::get('location_name')!='notfound')
                            <a href="{{url('package-add-cart/'.$pck['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
                            @else
                            <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
                            @endif
                        @else
                            <a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
                        @endif  
                    @endif 
                </div>
                <div class="block-space block-space--layout--divider-xs"></div>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingTwo" style="padding: 10px 30px;">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" style="color: black; font-weight: 700; font-size: 18px;"><i class="fa fa-plus"></i>Profile Includes following tests</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample"> 
                            <div class="card-body" style="padding: 0px 30px;">
                                <ul class="includelab">
                                    <?php
                                        $datas = explode(',',$pck['package']);
                                        foreach($datas as $data){
                                            $testing = DB::table('products')->where('products_id',$data)->get();
                                 
                                        ?>       
                                        <li>{{$testing[0]->product_name}}</li>
                                        <?php
                                        }
                                        ?> 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Test Requirement</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Description</a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane fade in active" id="profile" style="opacity: inherit;">
                        <div>
                            <p>{!!$pck['key_features']!!}</p>
                        </div>

                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="buzz">
                        <p style="font-size: 14px;">{!!$pck['long_disc']!!}</p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
            	<div class="lab-det">
                @if(!empty($lab_page->image)) 
                    <a href="{{$lab_page->banner_link}}" target="_blank"><img src="{{asset($lab_page->image)}}" alt=""  class="img-fluid"></a> 
                @endif
            </div>
            </div>
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