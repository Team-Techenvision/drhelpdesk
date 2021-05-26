<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Order Detail</h3> <br>
    <h4 >Shipping Address:-</h4>
    <b>{{$order1->user_name}},
       {{$order1->user_address}}<br>
       {{$order1->pin_code}}, 
       {{$order1->user_city}}<br>
       {{$order1->user_state}},
     {{$order1->user_country}},
     {{$order1->user_phone}}</b>
  </div> 
 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Product Image</th> 
          <th>Order Id</th>   
          <th>Sub Order Id</th>   
          <th>Product Details</th> 
          <th>Extra Discount</th> 
          <th>Total Amount</th>  
          <th>Order Status</th> 
          <th>Report Upload</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        @php 
        $count = 1;  

        @endphp 
        @foreach($order as $r)
          <?php  
      		$delivery_boy = DB::table('delivery_boys')->orderBy('id','desc')->get();  
            if($r->type == 1 ||$r->type == 2){
              $status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 

              $image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();

              $product_category = DB::table('products')->where('products_id', $r->prod_id)->pluck('brand')->first();
              $vendor = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('brand', $product_category)->select('vendors.*')->get();  
 
            }elseif($r->type == 3){
              $status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 
              $image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first();  
              $brand = DB::table('brands')->where('parent_id', 15)->get(); 
            //dd($brand);
              foreach($brand as $brand1){
              	$vendor = DB::table('vendor_brands')->join('vendors','vendors.vendors_id','vendor_brands.vendor_id')->where('brand', $brand1->id)->get();  
              	//dd($vendor);
              }
              
            }
          ?>
        <tr>
          <td>{{$count++}}</td>
          <td>
            @if(($r->type == 1 ||$r->type == 2) && file_exists(public_path($image)))
            <img src="{{ asset($image) }}" style="width:80px;"> 
            @elseif($r->type == 3 && file_exists(public_path($image)))
            <img src="{{ asset($image) }}" style="width:80px;"> 
            @else
            <img src="{{asset('UI/images/product_default1.png')}}" style="width:80px;">
            @endif 
          </td>
          <td>{{$r->order_id}} </td> 
          <td>{{$r->sub_order_id}} </td>  
          <td><b>Product Name</b> : {{$r->prod_name}} <br> 
              <b>Quantity</b> :{{$r->quantity}}<br> 
              <b>Amount</b> :{{$r->sub_total}} 
          </td> 
          <td>
            @if($r->extra_discount != null)
                <?php $discount = ($r->sub_total * $r->extra_discount)/100 ; //dd($discount); ?>
            {{$r->extra_discount}} <b>% Per Item </b>
            {{$discount}} <b> Rs Per Item</b>
            @else
            0 %
            @endif
          </td> 
          <td>
            @if($r->extra_discount != null) 
            {{$r->quantity * $r->sub_total - $discount * $r->quantity}}  
            @else
            {{$r->quantity * $r->sub_total}} 
            @endif
          </td>  
          <td> 
            @if($r->type == 1 ||$r->type == 2)
            {{ucfirst($status->status_name)}}  
            @elseif($r->type == 3)
            {{ucfirst($status->status_name)}}  
            @endif
          </td>  
          <td>
            @if($r->lab_report != null) 
              @if(file_exists(public_path($r->lab_report)))
                <center><a href="{{asset($r->lab_report)}}" download target="_blank"><i class="fa fa-download fa-2x"></i> </a></center>
              @else
                <b>No Report Uploaded</b>
              @endif 
            @else
            <b>No Report Uploaded</b>
            @endif
          </td>
          <td> 
          	 @if($r->type == 1)
              @php $order_status = DB::table('order_status')->where('type',1)->where('status_name', '!=' ,'pending')->where('id', '!=' , 6)->get();  @endphp
            @elseif($r->type == 2 ||$r->type == 3)
              @php $order_status = DB::table('order_status')->where('type',2)->where('status_name', '!=' ,'pending')->where('id', '!=' , 10)->get(); @endphp 
            @endif
            <b>Order Status</b>:
            <form action="{{url('order-status-change')}}" method="post">
              {{csrf_field()}} 
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
            @if(!empty($r->order_status) && $r->order_status!='6')
              <select  name="order_status" class="form-control price_sorting">
                <option>select</option>
              
                @foreach($order_status as $r1)
                <option value="{{$r1->status_value}}"  @if($r->order_status == $r1->status_value) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r1->status_name)}}</button>
                </option>
                @endforeach 
              </select>  
            @endif
            </form> 
            <b>Vendor Assign</b>:
            <form action="{{url('vendor-assign')}}" method="post">
              {{csrf_field()}}  
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
              <select  name="assign_vendor_id" class="form-control price_sorting1">
                <option>select</option>
                @foreach($vendor as $r2) 
                <option value="{{$r2->user_id}}"  @if($r->assign_vendor_id == $r2->user_id) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r2->vendor_name)}}</button>
                </option>
                @endforeach 
              </select>  
            </form>  
          	@if($r->type == 1)
          	<b>Delivery Boy Assign</b>:
            <form action="{{url('delivery-boy-assign')}}" method="post">
              {{csrf_field()}}  
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
              <select  name="assign_delivery_boy_id" class="form-control price_sorting1">
                <option>select</option>
                @foreach($delivery_boy as $r5) 
                <option value="{{$r5->user_id}}"  @if($r->assign_delivery_boy_id == $r5->user_id) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r5->delivery_boy_name)}}</button>
                </option>
                @endforeach 
              </select>  
            </form>  
          @endif

          
            <form action="{{url('order-status-cancle')}}" method="post">
              {{csrf_field()}} 
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
            @if(!empty($r->order_status))
              <!-- <select  name="order_status" class="form-control price_sorting">
                <option>select</option> -->
              
                <!-- @foreach($order_status as $r1)
                <option value="{{$r1->status_value}}"  @if($r->order_status == $r1->status_value) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r1->status_name)}}</button>
                </option>
                @endforeach  -->
                
                <input type="hidden" name="order_status" value="3">
                <input type="hidden" name="order_status1" value="6">
                <button type="submit" class="btn btn-xs bg-primary text-white"> Order Cancel</button>
              </select>  
            @endif
            </form> 
<!--             @if($r->type == 2 && !empty($r->lab_report) && ($r->lab_report > 0)) 
              <a href="#" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#myModal{{$r->id}}"  title="report upload">Report Upload</a> 
            @elseif($r->type == 3 && !empty($r->lab_report) && ($r->lab_report > 0))  
              <a href="#" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#myModal{{$r->id}}"  title="report upload">Report Upload</a> 
            @endif -->
			@if($r->type != 1 && $r->lab_report == null) 
              <a href="#" class="btn btn-primary btn-xs"  data-toggle="modal" data-target="#myModal{{$r->id}}"  title="report upload">Report Upload</a>  
            @endif
          	<div class="modal fade" id="myModal{{$r->id}}" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content"> 
                  <div class="modal-header">
                    <h4 class="modal-title">Testing Report Uploaded</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div> 
                  <div class="modal-body"> 
                    <form role="form" action="{{url('testing-report-submit')}}" enctype="multipart/form-data" method="post">
                    @csrf
                      <div class="box-body">
                        <input type="hidden" name="id" value="{{$r->id}}">  
                        <div class="form-group"> 
                          <label>Testing Report Uploaded</label><br>
                          <input type="file" name="lab_report" id="deal"al class="form-control" value="{{$r->lab_report}}" required>  
                        </div> 
                      </div> <!-- /.box-body -->  
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div> 
                    </form>
                  </div>  
                </div>
              </div>
            </div> 
          </td>   
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Product Image</th> 
          <th>Order Id</th>   
          <th>Sub Order Id</th>   
          <th>Product Details</th> 
          <th>Extra Discount</th> 
          <th>Total Amount</th>  
          <th>Order Status</th> 
          <th>Report Upload</th> 
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>  