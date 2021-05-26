
<!-- thank-you section start -->
<?php
	$check2 = DB::table('orders')->where('order_id',$booking->order_id)->first(); 
    $order_item = DB::table('order_items')->where('order_id',$booking->order_id)->get();
	if($check2->quick_delivery == 1){
    	$check = DB::table('orders')->where('order_id',$booking->order_id)->where('quick_delivery' , 1)->first(); 
    	$order1 = DB::table('order_items')->where('order_id',$check->order_id)->count(); 
		$order2 = DB::table('order_items')->where('order_id',$check->order_id)->where('type',1)->count();
		$order3 = DB::table('order_items')->where('order_id',$check->order_id)->where('type' , 2)->count(); 
		$order4 = DB::table('order_items')->where('order_id',$check->order_id)->where('type' , 3)->count(); 
    }elseif($check2->quick_delivery == 2){
    	$check = DB::table('orders')->where('order_id',$booking->order_id)->where('quick_delivery' , 2)->first(); 
    }
	
	$check1 = DB::table('orders')->where('order_id',$booking->order_id)->first();
	//dd($booking->order_id); die;
?>
<section class="section-b-space light-layout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
                    <h2>thank you</h2>
                    <p>Payment is successfully processsed and your order is on the way</p>
                    <p>Transaction ID: {{$booking->order_id}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->
<!-- order-detail section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-order">
                    <h3 class="title pt-0">your order details</h3>
                    
                    <div class="row product-order-detail">
                    @foreach($order_item as  $result)
                   <?php $product_image = DB::table('product_images')->where('products_id' , $result->prod_id)->pluck('product_image')->first(); ?>
                        <div class="col-3"><img src="{{asset($product_image)}}" alt="" class="img-fluid "></div>
                        <div class="col-3 order_detail">
                            
                            <div>
                                <h4>product name</h4>
                                <h5>{{$result->prod_name}}</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>quantity</h4>
                                <h5>{{$result->quantity}}</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>price</h4>
                                <h5><i class="fa fa-inr" aria-hidden="true"></i>{{$result->sub_total}}</h5></div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- <div class="row product-order-detail">
                        <div class="col-3"><img src="../assets/images/product/2.jpg" alt="" class="img-fluid "></div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>product name</h4>
                                <h5>Vega MP-01 Make Up Blender Sponge</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>quantity</h4>
                                <h5>1</h5></div>
                        </div>
                        <div class="col-3 order_detail">
                            <div>
                                <h4>price</h4>
                                <h5><i class="fa fa-inr" aria-hidden="true"></i>40.00</h5></div>
                        </div>
                    </div> -->
                    <div class="total-sec">
                        <ul>
                            <?php $sub_total = $booking->amount - $booking->shipping_charge; ?>
                            <li>subtotal <span><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $sub_total ?></span></li>
                            <?php  if($booking->shipping_charge != null){ ?>
                            <li>shipping <span><i class="fa fa-inr" aria-hidden="true"></i>{{$booking->shipping_charge}}</span></li>
                            <?php } ?>
                            <?php  if($booking->shipping_charge == 0){ ?>
                            <li>shipping <span>* Free</span></li>
                            <?php } ?>
                           <?php  if($booking->total_discount != null){ ?>
                            <li>Discount <span><i class="fa fa-inr" aria-hidden="true"></i>{{$booking->total_discount}}</span></li>
                           <?php } ?>
                        </ul>
                    </div>
                    <div class="final-total">
                        <h3>total <span><i class="fa fa-inr" aria-hidden="true"></i>{{$booking->amount}}</span></h3></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row order-success-sec">
                    <div class="col-sm-6">
                        <h4>summery</h4>
                        <ul class="order-detail">
                            <li>order ID: {{$booking->order_id}}</li>
                            <li>Order Date: {{$booking->created_at->format('M d Y ')}}</li>
                            <li>Order Total: <i class="fa fa-inr" aria-hidden="true"></i> {{$booking->amount}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <h4>shipping address</h4>
                        <ul class="order-detail">
                            <li>{{$booking->user_name}}</li>
                            <li>{{$booking->user_address}},</li>
                            <li>{{$booking->user_city}}, {{$booking->user_state}} {{$booking->pin_code}}</li>
                            <li>Contact No. 987456321</li>
                        </ul>
                    </div>
                    <div class="col-sm-12 payment-mode">
                        <h4>payment method</h4>
                        <p>Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking acceptance subject to device availability.</p>
                    </div>
                    <div class="col-md-12">
                        <div class="delivery-sec">
                            <h3>expected date of delivery</h3>
                            <h2>{{$booking->created_at->addDays(5)->format('M d Y ')}}</h2></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->

