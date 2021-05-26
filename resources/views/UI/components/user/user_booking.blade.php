<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Booking History </span>
                    </li>
                    <li class="breadcrumb__title-safe-area" role="presentation"></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
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
            <div class="col-12 col-lg-9 mt-4 mt-lg-0">
                <div class="dashboard">                             
                    <div class="dashboard__orders card">
                        <div class="card-header">
                            <h5>Lab test/Health packages</h5>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table"> 
                            @if ($order->count()>0)
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr> 
                                            <th>Order&nbsp;Id</th>   
                                            <th>Amount</th> 
                                            <th>Order&nbsp;Status</th> 
                                            
                                            <th>Payment&nbsp;Details</th>  
                                            <th>Date&nbsp;Time</th>
                                            <th>Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order as $r) 
                                    	<?php 
                                                $single_order = DB::table('orders')->where('order_id',$r->order_id)->pluck('order_status')->first(); 
                                    			//dd($single_order);
                                        ?>
                                        <tr>
                                             
                                            <td>{{$r->order_id}} </td> 
                                            <td>{{$r->amount}} </td>  
                                            <td>
                                                @if($single_order == 1)
                                                Pending Collection 
                                                @elseif($single_order == 2)
                                                Report Send
                                            	@elseif($single_order == 3)
                                                Cancelled
                                                @endif
                                            </td> 
                                           
                                            <td><b>Payment Mode</b> : @if($r->payment_mode == 'ON') Online Mode @else {{$r->payment_mode}} @endif<br> 
                                                <?php
                                                $order_payment = DB::table('order_payment_transactions')->where('order_id' , $r->order_id)->first(); 
                                            ?>
                                                <b>Payment Id</b> : {{!empty($order_payment->payment_id) ? $order_payment->payment_id : ''}} <br> 
                                                <b>Payment Status</b> : {{!empty($order_payment->staus) && $order_payment->staus=='1' ? 'Success':(!empty($order_payment->staus) && $order_payment->staus=='2'?'Fail':"")}} <br> 
                                            </td>  
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
                                            	<a href="{{url('user-booking-detail/'.$r->order_id)}}" class="btn btn-xs btn-primary mr-2" data-toggle="tooltip" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                                @if($single_order != 3)
                                    				<!--<a href="{{url('user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="View Invoice"> <i class="fa fa-file" aria-hidden="true"></i></a>-->
                                    				<a href="{{url('download-user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="download Invoice"> <i class="fa fa-download" aria-hidden="true"></i></a> 
                                    			@endif 
<!--                                             	@if($r->order_status != 3)
                                    				<form action="{{url('shippingorder-status-update')}}" method="post" class="d-cncl">
                                        				{{csrf_field()}}
                                        				<input type="hidden" name="order_id" value="{{$r->order_id }}"> 
                                        				<button type="submit" class="btn btn-xs bg-danger text-white"><i class="fa fa-times"></i></button>
                                    				</form> 
                                    			@endif   -->
                                            			 @if($single_order != 3)
                                                            <form action="{{url('shippingorder-status-update')}}" method="post" class="d-cncl">
                                                                {{csrf_field()}}
                                                                <input type="hidden" name="order_id" value="{{$r->order_id }}"> 
                                                                <button type="submit" class="btn btn-xs bg-danger text-white"><i class="fa fa-times"></i></button>
                                                            </form> 
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
<div class="block-space block-space--layout--before-footer"></div>
