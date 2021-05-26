@php $page='notification' @endphp
<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
        <div class="col-lg-3">
            @include('UI/components/user/userweb_sidebar')                
        </div>
            <div class="col-lg-9">
                <div class="dashboard-right ">
				 <div class="dashboard">
              <div class="row">
			    <div class="col-md-12">
			        <div class="not">
                        <ul>
                        @foreach($order as $r)
                        <li><i class="fa fa-stop-circle-o" aria-hidden="true"></i> Your order no: {{$r->order_id}}  has been @if($r->order_status == 1)
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
                                        @endif   .</li>
                        <!-- <li><i class="fa fa-stop-circle-o" aria-hidden="true"></i> Your Order Dabur Shampoo has been delivered.</li> -->
                        @endforeach
                        </ul>
			        </div>
                   
			    </div>
               
			</div> <br> <br>
            {{ $order->links() }}
            </div>                    
            </div>
        </div>
        </div>
    </div>
</section>
<!-- section end -->