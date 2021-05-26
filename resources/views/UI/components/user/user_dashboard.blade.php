<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Dashboard </span>
                    </li>
                    <li class="breadcrumb__title-safe-area" role="presentation"></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@php   
    $order2 = DB::table('orders')->where('user_id',Auth::id())->get();
    
 
    $booking1 = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type IN(2)  group by order_id) and user_id='".Auth::id()."'")); 
    $booking = collect($booking1);
    //dd($booking);

    $package1 = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type IN(3) group by order_id) and user_id='".Auth::id()."'")); 
    $package = collect($package1); 
@endphp 
<div class="block">
    <div class="container">
        @if(session('msg') != null)
        <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{session('msg')}}
        </div>
        @endif
       
        <div class="row">
            @include('UI/components/user/user_sidebar')
            <div class="col-md-12 col-lg-8 col-xl-9"> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="card dash-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-4">
                                          
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar1">
                                                    <div class="circle-graph1" data-percent="75">
                                                        <img src="{{asset('UI/images/icon-01.png')}}" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Order</h6>
                                                    <h3 class="text-center"> </h3>
                                                    <p class="text-muted">{{$order2->count()}}</p>
                                                </div>
                                            </div>
                                         
                                    </div>
                                    
                                    <div class="col-md-12 col-lg-4">
                                         
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="{{asset('UI/images/icon-02.png')}}" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Lab Booking</h6>
                                                    <h3 class="text-center"> </h3>
                                                    <p class="text-muted">{{$booking->count()}}</p>
                                                </div>
                                            </div>
                                        
                                    </div> 

                                    <div class="col-md-12 col-lg-4">
                                         
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar2">
                                                    <div class="circle-graph2" data-percent="65">
                                                        <img src="{{asset('UI/images/icon-02.png')}}" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Package Booking</h6>
                                                    <h3 class="text-center"> </h3>
                                                    <p class="text-muted">{{$package->count()}}</p>
                                                </div>
                                            </div>
                                         
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row"> 
                    <div class="col-md-12">
                        <div class="dashboard">
                            <div class="dashboard__orders card">
                                <div class="card-header">
                                    <h5>Recent 5 Orders</h5>
                                </div>
                                <div class="card-divider"></div>
                                <div class="card-table">
                                    @if ($order->count()>0)
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    				<th>Order Id</th>
                                   					 <th>Amount</th>
                                    				<th>Order&nbsp;Status</th>
                                   					 <th>Shipping&nbsp;Charge</th>
                                    				<th>Payment&nbsp;Detail</th>                                    
                                    				<th>Delivery&nbsp;Status</th>
                                    				<th>Date&nbsp;Time</th>
                                                     <th>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order as $r)
                                            	<?php
                                                    $order_check = DB::table('order_items')->where('order_id',$r->order_id)->where('order_status','<=',4)->count(); 
                                                    $single_order = DB::table('order_items')->where('order_id',$r->order_id)->first(); 
                                                    if($single_order->type == 1 ||$single_order->type == 2){ 
                                                      $image = DB::table('product_images')->where('type',2)->where('products_id' , $single_order->prod_id)->pluck('product_image')->first();
                                                        
                                                    }elseif($single_order->type == 3){ 
                                                      $image= DB::table('packages')->where('id',$single_order->prod_id)->pluck('image')->first();  
                                                    }
                                                ?>
                                                <tr>
                                                    <td>
													  @if(file_exists(public_path($image)))
                                                    	<img src="{{ asset($image) }}"  style="width:50px; height:50px; margin:0 auto; display:block;">  
                                                    
                                                      @elseif($image != null || !empty($image) || $image->count() > 0)
                                                        <img src="{{ asset($image) }}"  style="width:50px; height:50px; margin:0 auto; display:block;">  
                                                      @else
                                                         <img src="{{asset('UI/images/product_default1.png')}}"  style="width:50px; height:50px; margin:0 auto; display:block;"> 
                                                      @endif 
                                                    <span style="font-weight: 500;font-size: 14px;text-align: center;margin: 0 auto;display: block;">{{$single_order->prod_name}}</span>
                                                    </td>
                                                    <td>{{$r->order_id}} </td>
                                                    <td>{{$r->amount}} </td>
                                                    <td>
                                                       	@if($r->order_status == 1)
                                                        In Process
                                                        @endif
                                                        @if($r->order_status == 2)
                                                        Delivered
                                                        @endif
                                                        @if($r->order_status == 3)
                                                        Cancelled
                                                        @endif
                                                    </td> 
                                                    <td>{{$r->shipping_charge}} Rs </td>
                                                    <td><b>Payment Mode</b> : @if($r->payment_mode == 'ON') Online Mode @else {{$r->payment_mode}} @endif <br>
                                                        <b>Payment Id</b> : {{$r->payment_id}} <br>
                                                        <b>Payment Status</b> : {{$r->payment_status}} <br>
                                                        <b>Payment Request Id</b> : {{$r->payment_req_id}} <br>
                                                    </td>
                                                	<td>@if($r->quick_delivery == 1) Quick Delivery @elseif($r->quick_delivery == 2) 24 hours Delivery  @endif</td>
                                                    <td>
                                        				<?php
                                            				$dt = new DateTime($r->created_at);
                                            				$tz = new DateTimeZone('Asia/Kolkata'); 
                                            				$dt->setTimezone($tz);
                                            				$start_date = $dt->format("d-m-Y H:i:s"); 
                                       					 ?>
                                        				{{$start_date}}
                                    				</td>
                                                    <td>
                                                       <a href="{{url('user-order-detail/'.$r->order_id)}}" class="btn btn-xs btn-primary mr-2" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                                        @if($r->order_status != 3)
                                                            @if($r->awb_number != null)  
                                                            <form action="{{url('trackorder')}}" method="post">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="order_id" value="{{$r->order_id }}"> 
                                                                <button type="submit"><i class="fa fa-map-marker" aria-hidden="true"></i> </button>
                                                            </form>
                                                            @elseif($r->quick_delivery == 1)  
                                                              <a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd" class="btn btn-xs bg-primary text-white" target="_blank" data-toggle="tooltip" title="Track"><i class="fa fa-map-marker" aria-hidden="true"></i></a>  
                                                            @endif
                                                        @endif
                                                    	@if($r->order_status != 3)
                                                           <!-- <a href="{{url('user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="View Invoice"> <i class="fa fa-file" aria-hidden="true"></i></a>-->
                                                            <a href="{{url('download-user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="download Invoice"> <i class="fa fa-download" aria-hidden="true"></i></a> 
                                                        @endif 
                                                       
                                                         @if($r->order_status != 3)
                                                        @if($order_check > 0) 
                                                           <button type="button" class="btn btn-xs bg-danger text-white" data-toggle="modal" data-target="#myModal3"><i class="fa fa-times"></i></button> 
                                                        @else 
                                                            <form action="{{url('shippingorder-status-update')}}" method="post" class="d-cncl">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="order_id" value="{{$r->order_id }}"> 
                                                                <button type="submit" class="btn btn-xs bg-danger text-white"><i class="fa fa-times"></i></button>
                                                            </form> 
                                                        @endif  
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
<div class="modal fade" id="myModal3">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> </h4>
         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Due to Covid-19 , we are not accepting post-dispatch cancellations on orders.
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>