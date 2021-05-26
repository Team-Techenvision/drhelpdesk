<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Order Success Page</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<?php
	$check2 = DB::table('orders')->where('order_id',$booking->order_id)->first(); 
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
<div class="block">
	<div class="container">
		<div class="row"> 
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12">
								 
                                 <h3><center>Thank You</center></h3> 
                                <!-- <p>Your Order has been booked Successfully!</p> -->
                            	@if($check1->payment_mode == 'ON' || $check1->payment_mode == 'on')
                            	<p style="padding-left: 48px;">Your Order has been booked Successfully! from Online Payment Delivery!</p>
                            	@endif
                            	@if($check1->payment_mode == 'CLD' || $check1->payment_mode == 'cld')
                            	<p style="padding-left: 48px;">Your Order has been booked Successfully! from Contactless Delivery!</p>
                            	@endif
                            	@if($check1->payment_mode == 'COD' || $check1->payment_mode == 'cod')
                            	<p style="padding-left: 48px;">Your Order has been booked Successfully! You will receive an email confirmation shortly.</p>
                            	@endif 
                                <p><strong><center>Order ID: {{$booking->order_id}}</center></strong></p>
                                <!--                                 <a href="{{url('user-invoice/'.$booking->order_id)}}" class="btn btn-primary view-inv-btn">View Invoice</a> -->
                            </div>
						</div>
					</div>
				</div> 
			</div>
			@if($check2->quick_delivery == 1)
			@if($order1 == $order2)
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12"> 
                                <p>1. Weekdays (Mon - Friday)</p>
                                <p>Orders after 6:30 Pm will be delivered Next day.</p>
                                <p>2. Weekends (Sat - Sunday)</p>
                                <p>Orders after 6:30 pm on Saturday & Orders on Sunday will be delivered on Monday.</p> 
							</div>
						</div>
					</div>
				</div> 
			</div>
        	@elseif($order1 == $order3)
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12"> 
                                <p>Your Sample Collection Will Be Done As Required.</p> 
							</div>
						</div>
					</div>
				</div> 
			</div>
			@elseif($order1 == $order4)
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12"> 
                                <p>Your Sample Collection Will Be Done As Required.</p> 
							</div>
						</div>
					</div>
				</div> 
			</div>
			@elseif($order1 == $order2+$order3+$order4)
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12"> 
                                <p>1. Weekdays (Mon - Friday)</p>
                                <p>Orders after 6:30 Pm will be delivered Next day.</p>
                                <p>2. Weekends (Sat - Sunday)</p>
                                <p>Orders after 6:30 pm on Saturday & Orders on Sunday will be delivered on Monday.</p> 
                                <p>Your Sample Collection Will Be Done As Required.</p> 
							</div>
						</div>
					</div>
				</div> 
			</div>
			@elseif($order1 == $order3+$order4)
			<div class="col-12 col-lg-6 mt-4 mt-lg-0"> 					
				<div class="card"> 
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="row no-gutters">
							<div class="col-12 col-lg-6 col-xl-12"> 
                                <p>Your Sample Collection Will Be Done As Required.</p> 
							</div>
						</div>
					</div>
				</div> 
			</div>
			
			@endif

         	@endif
		</div>
	</div>
</div>