<div class="box"> 
    <div class="box-header"> 
      <h3 class="box-title" style="float:left;">Karnal Shop Order</h3> 
      <span style="float: right;">
        {{-- <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a> --}}
      </span>
    </div> 
    <div class="box-body  table-responsive" id="dvData"> 
      <table id="example1" class="table table-bordered table-striped ordertbl">
        <thead>
          <tr>
            <th>Sr. No.</th> 
            <th>Order Id</th>
            <th>Customer Mobile</th>
            <th>Customer Name</th>
            <th>Order Amount</th> 
            <th>Payment Mode</th>
            <th>Transaction No.</th>     
            <th>D Coin Used</th>      
            <th>Action</th>
          </tr>
        </thead>
        <tbody> 
            @php 
        $count = 1;  
          // dd($order);
        @endphp 
        @foreach($order as $r)
         <tr>
             <td>{{$count++}}</td>
             <td>{{$r->order_id}}</td>
             <td>{{$r->user_phone}}</td>
             <td>{{$r->user_name}}</td>
             <td>{{$r->amount}}</td>
             <td>{{$r->payment_mode}}</td>
             <td>{{$r->payment_id}}</td>
             <td>{{$r->used_Decoin_amt}}</td>
             <td>
              <a href="{{url('view-shop-user-invoice/'.$r->order_id)}}" target="_blank" data-toggle="tooltip" title="download-invoice" class="btn btn-xs btn-warning text-white mt-2"> View Invoice <i class="fa fa-download" aria-hidden="true"></i></a>
             </td>
         </tr>
         @endforeach
        </tbody> 
        <tfoot>
            <tr>
                <th>Sr. No.</th> 
                <th>Order Id</th>
                <th>Customer Mobile</th>
                <th>Customer Name</th>
                <th>Order Amount</th> 
                <th>Payment Mode</th>
                <th>Transaction No.</th>     
                <th>D Coin Used</th>      
                <th>Action</th>
              </tr>
        </tfoot> 
      </table>
    </div> 
  </div>  
  
  