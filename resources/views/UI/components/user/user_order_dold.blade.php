<div class="block-header block-header--has-breadcrumb block-header--has-title">
    <div class="container">
        <div class="block-header__body">
            <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb__list">
                    <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                    <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Order History </span>
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
                        @if ($order->count()>0)
                        <div class="card-header">
                        <div class="row">
                        	<div class="col-6">
                        		<h5>All Order History</h5>
                        	</div>
                        <div class="col-6 text-right">
                        		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" >
                        	</div>
                        </div>
                            
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-table">

                            <div class="table-responsive">
                                <table id="tbl_order_history" class="table table-bordered table-striped">
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
                                    	
                                    	if(!empty($single_order) || $single_order != null ){
                                        		if($single_order->type == 1 || $single_order->type == 2){ 
                                          			$image = DB::table('product_images')->where('type',2)->where('products_id' , $single_order->prod_id)->pluck('product_image')->first();
                                          			
                                      			}elseif($single_order->type == 3){ 
                                          			$image= DB::table('packages')->where('id',$single_order->prod_id)->pluck('image')->first();  
                                      			}
                                        }
                                      ?>
                                      <tr>
                                        <td>
                                          @if((!empty($image)))
                                          <img src="{{ asset($image) }}"  style="width:50px; height:50px; margin:0 auto; display:block;">  
                                          
                                          @elseif(!empty($image))
                                          <img src="{{ asset($image) }}"  style="width:50px; height:50px; margin:0 auto; display:block;">  
                                          @else
                                          <img src="{{asset('UI/images/product_default1.png')}}"  style="width:50px; height:50px; margin:0 auto; display:block;"> 
                                          @endif 
                                          @if(!empty($single_order) || $single_order != null)
                                          	<span style="font-weight: 500;font-size: 14px;text-align: center;margin: 0 auto;display: block;">{{$single_order->prod_name}}</span>
                                       	 @endif
                                      </td>
                                      <td>{{$r->order_id}} </td>
                                      <td>{{$r->amount}} </td>
                                      <td>
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
                                    </td> 
                                    <td>{{$r->shipping_charge}} Rs </td>
                                    <td><b>Payment Mode</b> :@if($r->payment_mode == 'ON') Online Mode @else {{$r->payment_mode}} @endif <br>
                                        <?php
                                        $order_payment = DB::table('order_payment_transactions')->where('order_id', $r->order_id)->first();
                                        $order_check =  DB::table('orders')->where('order_id', $r->order_id)->first();
                                        ?>
                                        <?php if($r->payment_mode == 'ON'){?>
                                        <b>Payment Id</b> : {{!empty($order_payment->payment_id) ? $order_payment->payment_id : ''}} <br>
                                    
                                        <b>Payment Status</b> : {{!empty($order_payment->staus) && $order_payment->staus=='1' ? 'Success':(!empty($order_payment->staus) && $order_payment->staus=='2'?'Fail':"Fail")}} <br>
										<?php } ?>
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
                                    @if($r->order_status == 2)
                                    <!--<a href="{{url('user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="View Invoice"> <i class="fa fa-file" aria-hidden="true"></i></a>-->
                                    <a href="{{url('download-user-invoice/'.$r->order_id)}}" class="btn btn-xs btn-success mr-2" target="_blank" data-toggle="tooltip" title="download Invoice"> <i class="fa fa-download" aria-hidden="true"></i></a> 
                                    @endif 
									
                                    <?php
                                    	$ordersStaus =  DB::table('order_items')->where('order_id', $r->order_id)->get();
                                    	$isDelete = '0';
                                    	foreach($ordersStaus as $key=>$val){
                                        	if($val->order_status=='5') {
                                            	$isDelete='1';
                                            	break;
                                            } elseif($val->order_status=='4') {
                                            	$isDelete='2';
                                            	break;
                                            }
                                        	
                                        }
                                    	
                                    ?>
                                    @if($isDelete=='0' || $isDelete=='2')
                                    @if($r->order_status != 3)
                                    <?php if($isDelete=='2') {?>
                                    <button type="button" class="btn btn-xs bg-danger text-white" onclick="alert('Due to Covid-19, we are not accepting post dispatch cancellations on orders')"><i class="fa fa-times"></i></button>                                   
                                    <?php } else {?>
                                    	 <form action="{{url('shippingorder-status-update')}}" method="post" class="d-cncl">
                                        {{csrf_field()}}
                                        <input type="hidden" name="order_id" value="{{$r->order_id }}">                                     	
                                        <button type="submit" class="btn btn-xs bg-danger text-white"><i class="fa fa-times"></i></button>
                                    </form> 
                                    <?php } ?>
                                    @endif  
                                   @endif
                                   <a href="{{url('repeat-order/'.$r->order_id)}}" class="btn btn-xs btn-primary mr-2" data-toggle="tooltip" title="Repeat Order">Repeat Order</a> 
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="products-view__pagination"> 
                        <nav aria-label="Page navigation example"> 
                            <ul class="pagination">  
                                {{ $order->appends($page)->links() }} 
                            </ul> 
                        </nav> 
                    </div>
                </div>

                @else
                <div style="padding:12px">Sorry!! No Order found !</div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
<script>
function myFunction() {
  var input, filter, table, tr, td, cell, i, j;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("tbl_order_history");
  tr = table.getElementsByTagName("tr");
  for (i = 1; i < tr.length; i++) {
    // Hide the row initially.
    tr[i].style.display = "none";
  
    td = tr[i].getElementsByTagName("td");
    for (var j = 0; j < td.length; j++) {
      cell = tr[i].getElementsByTagName("td")[j];
      if (cell) {
        if (cell.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          break;
        } 
      }
    }
  }
}
</script>
