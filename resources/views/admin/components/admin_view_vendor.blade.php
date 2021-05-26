<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Vendor</h3>
    <a href="{{url('add-vendors')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add Vendor</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Image</th> 
          <th>Brand</th>  
          <th>Contact Details</th>   
          <th>Address Details</th>   
          <th>Website Url</th>   
          <th>Description</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; ?>
        @foreach($vendor as $r)
        @php
          $brand = DB::table('vendor_brands')->where('vendor_id',$r->vendors_id)->get(); 
        @endphp
        <tr>
          <td>{{$count++}}</td>
          <td>{{$r->vendor_name}} </td>  
          <td><img src="{{ url($r->logo) }}" style="width: 80px;"></td> 
          <td>
            @if($brand != null)
            @foreach($brand as $brands)
              @php
                $brand1 = DB::table('brands')->where('id',$brands->brand)->first(); 
              @endphp
          	  @if($brand1 != null)
              <b>{{$brand1->brand_name}},</b><br>
          	  @endif
            @endforeach
            @endif
          </td>
          <td>Email: {{$r->email}}<br> Mobile Number: {{$r->mobile}} <br>@if($r->vendor_password != null)Password: {{$r->vendor_password}} @endif<br> @if($r->landline != null)Landline Number: {{$r->landline}} @endif</td>  
          <td>Address: {{$r->address}}<br> City: {{$r->city}} <br> Pincode: {{$r->pin_code}} <br> State: {{$r->state}}</td>    
          <td>
            @if($r->website_url != null)
              {{$r->website_url}}
            @else
              website Not Found
            @endif

          </td>
          <td> 
              {{$r->description}} 
          </td>
          <td>
            <a href="{{url('edit-vendors/'.$r->vendors_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <a href="{{url('delete-vendors/'.$r->vendors_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->status == 1)
            <a href="{{ url('toggle-vendors-status/0/'.$r->vendors_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-vendors-status/1/'.$r->vendors_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif 
            
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Image</th>   
          <th>Brand</th>   
          <th>Contact Details</th>   
          <th>Address Details</th>   
          <th>Website Url</th>  
          <th>Description</th>  
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 