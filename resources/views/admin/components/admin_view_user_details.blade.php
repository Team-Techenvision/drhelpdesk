<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View User Details</h3>
<!--     <a href="{{url('add-user-details')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add User Details</a>  -->
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Image</th>   
          <th>Contact Details</th>   
          <th>Address Details</th>   
          
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        <?php $count = 1; 
             
        ?>
         
        <tr>
          <td>{{$count++}}</td>
            <td>@if($user_detail->user_name != null)
                    {{$user_detail->user_name}} 
                @endif<br>
            	@if($user_detail->gender != null)
                    Gender:{{$user_detail->gender}} 
                @endif
            	
            </td>  
          <td>
              @if($user_detail->image != null)
              <img src="{{ url($user_detail->image) }}" style="width: 80px;">
             @endif
            </td> 
          <td>Email: 
          @if($user_detail->email != null){{$user_detail->email}}@endif<br> Mobile Number: @if($user_detail->mobile != null){{$user_detail->mobile}}@endif</td>  
          <td>Address: @if($user_detail->address != null){{$user_detail->address}}@endif<br> City: @if($user_detail->city != null){{$user_detail->city}}@endif <br> Pincode: @if($user_detail->pin_code != null){{$user_detail->pin_code}} @endif<br> State: @if($user_detail->state != null){{$user_detail->state}}@endif <br> Country: @if($user_detail->country != null){{$user_detail->country}}@endif</td>    
           
          <td>
            <a href="{{url('edit-user-details/'.$user_detail->user_details_id)}}" class="btn btn-primary btn-xs" title="edit"><i class="fa fa-edit"></i></a>
            <!-- <a href="{{url('delete-user-details/'.$user_detail->user_details_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a> -->
            <!-- @if($user_detail->status == 1)
            <a href="{{ url('toggle-user-details-status/0/'.$user_detail->user_details_id) }}" class="btn btn-danger btn-xs">Deactivate</a>
            @else
            <a href="{{ url('toggle-user-details-status/1/'.$user_detail->user_details_id) }}" class="btn btn-success btn-xs">Activate</a>
            @endif  -->
            
          </td>
        </tr>
         
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Name</th>   
          <th>Image</th>   
          <th>Contact Details</th>   
          <th>Address Details</th>   
          
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 