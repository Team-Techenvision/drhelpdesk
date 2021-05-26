<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">Webstore Order</h3> 
    <span style="float: right;">
      {{-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> --}}
    </span>
  </div> 
  <div class="box-body  table-responsive" id="dvData"> 
    <table id="example1" class="table table-bordered table-striped ordertbl">
      <thead>
        <tr>
          <th>Sr. No.</th> 
        <th>Customer Name</th>
          <th>Order Details</th> 
          <th>Order Status</th>   
          <th>Delivery Type</th>   
          <th>De-Wallet</th>  
          <th>Copoun</th>  
          <th>Shipping Charge</th>
          <th>Prescription</th>  
          <th>Payment</th>   
          <th>Amount</th>  
          <th>Action</th>
        </tr>
      </thead>
      <tbody> 
        @php 
        $count = 1;  

        @endphp 
        @foreach($order as $r)
          @php
            $pay =  DB::table('order_payment_transactions')->where('order_id',$r->order_id)->first();
            $copoun_detail =  DB::table('order_coupon_histories')->where('order_id',$r->order_id)->first(); 
          @endphp
        <tr>
          <td>{{$count++}}</td> 
        <?php $username =  DB::table('users')->where('id',$r->user_id)->value('name');   ?>
        <td> <?php echo $username;  ?></td>
          <td>
            <b>Order Id</b>:- {{$r->order_id}}<br>
            <b style="color:red;">Order Date</b>:- {{$r->created_at->format('d-m-Y')}}<br>
            @if($r->Shiprocket_Order_Id != null)
              <b>Shiprocket Order Id</b>:- {{$r->Shiprocket_Order_Id}}<br>
            @endif
            @if($r->Shiprocket_Shipment_Id != null)
              <b>Shiprocket Shipment Id</b>:- {{$r->Shiprocket_Shipment_Id}}<br> 
            @endif
          </td>
          <td>
            @if($r->order_status == 0)
              <small class="label label-warning">Pending </small>
            @elseif($r->order_status == 1)
             <small class="label label-info"> In Procesed  </small>
            @elseif($r->order_status == 2)
              <small class="label label-success">Pending</small>
              @elseif($r->order_status == 3)
              <small class="label label-success">Packed</small>
              @elseif($r->order_status == 4)
              <small class="label label-success">Picked</small>
              @elseif($r->order_status == 5)
              <small class="label label-success">Delivered</small>
            @elseif($r->order_status == 6 )
             <small class="label label-danger"> Cancelled</small>
            @endif
          </td>  
          <td> 
            @if($r->quick_delivery == 1)
              <b style="color:red;">Quick Delivery</b> <br>
              <b>Delivery Time</b> <b style="color:red;">(60 min to 90 min)</b>
            @endif
            @if($r->quick_delivery == 2)
              <b style="color:red;">Shiprocket  Delivery</b> <br>
              <b>Delivery Time</b> <b style="color:red;">(24 hours to 48 hours)</b>
            @endif
          </td>
          <td> 
            @if($r->de_wallet_coin != null)
              <b>Coin</b>:-  {{$r->de_wallet_coin}}<br>
              <b>Amount</b>:-  ₹{{$r->de_wallet_coin  * 0.25}}
            @else
              <b>Coin</b>:-  0<br>
              <b>Amount</b>:-  ₹0
            @endif 
          </td>
          <td> 
            @if(!empty($copoun_detail->coupon_code))
              <b style="color:red;">Copoun&nbsp;Name</b>:&nbsp;{{$copoun_detail->coupon_code}}<br>
              @if($copoun_detail->coupon_type == 'fixed') 
              <b style="color:red;">Copoun&nbsp;Price</b>:&nbsp;₹&nbsp;{{$copoun_detail->coupon_price}}<br>
              @elseif($copoun_detail->coupon_type == 'percentage') 
              @if($r->amount != null)
              <b style="color:red;"> Copoun&nbsp;Percentage</b>:&nbsp;{{$copoun_detail->coupon_price}}<br>
              <?php $total_copoun = ($r->amount / $copoun_detail->coupon_price )/100 ;  ?>
               <b style="color:red;">Copoun&nbsp;Price</b>:&nbsp;₹&nbsp;{{round($r->amount - $total_copoun)}}<br>
              @endif 
              @endif 
            @else
              ₹0 
            @endif 
          </td> 
          <td>
            @if($r->shipping_charge != null)
              ₹{{$r->shipping_charge}} 
            @else 
             ₹0 
            @endif  
          </td> 
          <td>
            @if($r->prescription_id != null)
            <?php
            if($r->prescription_id == 'null'){
              $presciption = 'No Prescription Found';
            }else{ 
              $presciption = DB::table('prescriptions')->where('id',$r->prescription_id)->pluck('prescription_image')->first(); 
            }
            ?>
              @if(file_exists(public_path($presciption)))
                <a href="{{asset($presciption)}}" download target="_blank"><i class="fa fa-download fa-2x"></i> </a>   
              @else 
                <b>Not Found</b>
              @endif
            @elseif($r->prescription_id == 'null')
                <b>Not Found</b>
            @else
            <b>Not Found</b>
            @endif
          </td>
          <td>
          @if(!empty($pay) && $r->payment_mode == 'ON') 
            <b>Payment Mode</b> : Online<br> 
            <b>Payment Transaction Id</b> : @if($pay->payment_id != null){{$pay->payment_id}}@else No Transaction Id @endif <br> 
            <b>Payment Status</b> :@if($pay->status == 1) Success @else Failed @endif<br>   
          @elseif(empty($pay) && $r->payment_mode == 'on') 
            <small class="label label-warning">Pending</small>
          @elseif(empty($pay) && $r->payment_mode == 'ON') 
            <small class="label label-warning">Pending</small>
          @elseif(empty($pay) &&  $r->payment_mode == 'online')) 
            <b>Payment Mode</b> : Online<br> 
            <b>Payment Transaction Id</b> : @if($r->payment_id != null){{$r->payment_id}}@else No Transaction Id @endif <br> 
            <b>Payment Status</b> : {{$r->payment_status}} <br> 
          @elseif(empty($pay) &&  $r->payment_mode == 'Online') 
            <b>Payment Mode</b> : Online<br> 
            <b>Payment Transaction Id</b> : @if($r->payment_id != null){{$r->payment_id}}@else No Transaction Id @endif <br> 
            <b>Payment Status</b> : {{$r->payment_status}} <br> 
          @elseif($r->payment_mode == 'cod' || $r->payment_mode == 'COD') 
             @if($r->payment_mode != null) <small class="label label-success"> COD</small> @endif<br>  
          @endif 
          </td>
          <td>
            @if($r->amount != null)
              ₹{{$r->amount}} 
            @else 
             ₹0 
            @endif  
          </td>  
          <td>  
          @if($r->payment_mode != 'shop')
            @if($r->quick_delivery == 2 && $r->awb_number == null)
              <form action="{{url('awb-number-update')}}" method="post">
                {{csrf_field()}} 
                <input type="hidden" name="order_id" value="{{ $r->order_id }}">
                <label>Awb Number</label>
                <input type="text" name="awb_number">
                <button type="submit" class="btn btn-xs bg-primary text-white">submit</button> 
              </form> 
            @elseif($r->quick_delivery == 2 && $r->awb_number != null) 
              <form action="{{url('trackorder')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="order_id" value="{{$r->order_id}}"> 
                <button type="submit" class="btn btn-xs bg-primary text-white"> Track Order</button>
              </form>
            @elseif($r->quick_delivery == 1)  
              <a href="https://play.google.com/store/apps/details?id=com.expertwebtech.mydhd.dhd"  class="btn btn-xs bg-primary text-white" target="_blank"> Track Order</a> <br><br>
            @endif 
            <a href="{{url('/view-order-details/'.$r->order_id)}}" class="btn btn-xs bg-primary text-white mt-3">Order Details</a> <br><br>
            <a href="{{url('download-user-invoice/'.$r->order_id)}}" data-toggle="tooltip" title="download-invoice" class="btn btn-xs btn-warning text-white mt-2"> Download Invoice <i class="fa fa-download" aria-hidden="true"></i></a>

            @endif
          </td>
          
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th> 
          <th>Order Details</th> 
          <th>Order Status</th>   
          <th>Delivery Type</th>   
          <th>De-Wallet</th>  
          <th>Copoun</th>  
          <th>Shipping Charge</th>
          <th>Prescription</th>  
          <th>Payment</th>   
          <th>Amount</th>  
          <th>Action</th> 
          
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>  

