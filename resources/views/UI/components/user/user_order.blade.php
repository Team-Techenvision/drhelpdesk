@php $page='orders' @endphp
<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            @include('UI/components/user/userweb_sidebar')
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right wishlist-section section-b-space">
				 <div class="dashboard">
               <div class="row" style="overflow-x: scroll;">
            <div class="col-sm-12">
			<div class="table-responsive">
                <table class="table cart-table ">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">Order Id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Shipping Charges</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order as $r)
                                        <?php
                                         $order_check = DB::table('order_items')->where('order_id',$r->order_id)->where('order_status','<=',4)->count(); 
                                         $single_order = DB::table('order_items')->where('order_id',$r->order_id)->first(); 
                                    	
                                    	if(!empty($single_order) || $single_order != null ){
                                        		if($single_order->type == 1 || $single_order->type == 2){ 
                                          			$image = DB::table('product_images')->where('type',2)->where('products_id' , $single_order->prod_id)->pluck('product_image')->first();
                                          			
                                      			}elseif($single_order->type == 3){ 
                                          			$image= DB::table('packages')->where('id',$single_order->prod_id)->pluck('image')->first();  
                                      			}
                                        }
                                      ?>
                    <tr>
                        <td> order no: <span class="dark-data">{{$r->order_id}}</span>
                        </td>
                        <td><a href="#"> <i class="fa fa-inr" aria-hidden="true"></i> {{$r->amount}}</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <!-- <input type="text" name="quantity" class="form-control input-number" value="1"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <!-- <h4 class="td-color"><i class="fa fa-inr" aria-hidden="true"></i>100.00</h4></div> -->
                                <div class="col-xs-3">
                                    <!-- <h2 class="td-color"> {{$r->amount}}<a href="#" class="icon"><i class="ti-close"></i></a></h2></div> -->
                            </div>
                        </td>
                        <td>
                            <h4>
                                 @if($r->order_status == 1)
                                        In Process
                                        @endif
                                        @if($r->order_status == 2)
                                        Pending
                                        @endif
                                        @if($r->order_status == 3)
                                        Packed
                                        @endif
                                        @if($r->order_status == 4)
                                        Picked
                                        @endif
                                        @if($r->order_status == 5)
                                        Delivered
                                        @endif
                                        @if($r->order_status == 6)
                                        Cancelled
                                        @endif                            
                            </h4></td>
                        <td>
                         <p class="text-center"> <i class="fa fa-inr" aria-hidden="true"></i> {{$r->shipping_charge}}</p> 
                        </td>
                        <td>
                        <b>Payment Mode</b> :@if($r->payment_mode == 'ON') Online Mode @else {{$r->payment_mode}} @endif <br>
                                        <?php
                                        $order_payment = DB::table('order_payment_transactions')->where('order_id', $r->order_id)->first();
                                        $order_check =  DB::table('orders')->where('order_id', $r->order_id)->first();
                                        ?>
                                        <?php if($r->payment_mode == 'ON'){?>
                                        <b>Payment Id</b> : {{!empty($order_payment->payment_id) ? $order_payment->payment_id : ''}} <br>
                                    
                                        <b>Payment Status</b> : {{!empty($order_payment->staus) && $order_payment->staus=='1' ? 'Success':(!empty($order_payment->staus) && $order_payment->staus=='2'?'Fail':"Fail")}} <br>
										<?php } ?>
                        </td>
                        <td>
                            <div class="responsive-data">
                                <a href="{{url('download-user-invoice/'.$r->order_id)}}" data-toggle="tooltip" title="download-invoice"><i class="fa fa-download" aria-hidden="true"></i></a>
                                <span>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="tooltip" title="Track-Order"><i class="fa fa-map-marker" aria-hidden="true"></i></a></span>
								<span>&nbsp;&nbsp;&nbsp;<a href="{{url('user-order-detail/'.$r->order_id)}}" data-toggle="tooltip" title="view"><i class="fa fa-eye" aria-hidden="true"></i></a></span>
								<span>&nbsp;&nbsp;&nbsp;<a href="{{url('repeat-order/'.$r->order_id)}}" data-toggle="tooltip" title="Repeat-Order"><i class="fa fa-repeat" aria-hidden="true"></i></a></span>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <!-- <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/2.jpg" alt=""></a>
                        </td>
                        <td><a href="#">order no: <span class="dark-data">15454841</span> <br>Vega MP-01 Make Up Blender Sponge</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="td-color">₹49.00</h4></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h4>₹49.00</h4></td>
                        <td>
                            <span>Size: L</span>
                            <br>
                            <span>Quntity: 1</span>
                        </td>
                        <td>
                            <div class="responsive-data">
                                <h4 class="price">₹49.00</h4>
                                <span>Size: L</span>|<span>Quntity: 1</span>
                            </div>
                            <span class="dark-data">Delivered</span> (nov 01, 2020)
                        </td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/3.jpg" alt=""></a>
                        </td>
                        <td><a href="#">order no: <span class="dark-data">15454841</span> <br>Lakme Insta Eye Liner</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="td-color">₹130.00</h4></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h4>₹130.00</h4></td>
                        <td>
                            <span>Size: L</span>
                            <br>
                            <span>Quntity: 1</span>
                        </td>
                        <td>
                            <div class="responsive-data">
                                <h4 class="price">₹130.00</h4>
                                <span>Size: L</span>|<span>Quntity: 1</span>
                            </div>
                            <span class="dark-data">Delivered</span> (nov 20, 2020)
                        </td>
                    </tr>
                    </tbody> -->

                   
                </table>
            </div>
			</div>
        </div>
        
        <div class="row cart-buttons">
        {{ $order->links() }}
            <!-- <div class="col-12 pull-right"><a href="#" class="btn btn-solid btn-sm">show all orders</a></div> -->
        </div>
               </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->