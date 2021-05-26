<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View User Data</h3>
    <a href="{{url('add-user-details')}}" class="btn btn-sm btn-success" style="float:right; color:white;">Add User Data</a> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Image</th> 
          <th>Name</th>  
          <th>Contact Details</th>   
          <th>Refer Code</th>   
          <th>Coin</th>   
          <th>Role</th>   
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        @php 
          $count = 1;  
        @endphp  
        @foreach($user as $r)
        @php  
          $coin = DB::table('de_wallets')->where('user_id',$r->id)->first();
          $apply_refer_code = DB::table('apply_refer_codes')->where('user_id',$r->id)->first(); 
        @endphp  
        <tr>
          <td>{{$count++}}</td>
          <td>
            @if($r->image != null)
            <img src="{{ url($r->image) }}" style="width: 80px;">
            @endif
          </td> 
          <td>
            @if($r->name != null)
            {{$r->name}} 
            @endif
          </td>  
          <td>
            @if($r->email != null)<b style="color:red;">Email</b>:&nbsp;&nbsp;{{$r->email}}@endif<br>
            @if($r->phone != null)<b style="color:red;">Mobile Number</b>:&nbsp;&nbsp; {{$r->phone}}@endif <br>
            @if($r->created_at != null)<b style="color:red;">Register Date</b>:&nbsp;&nbsp; {{ date('M j, Y', strtotime($r->created_at)) }}@endif
            
          </td>  
          <td>
            @if($r->refer_code != null)<b style="color:red;">Refer Code</b>:&nbsp;&nbsp;{{$r->refer_code}}</b>@endif<br>
            @if($apply_refer_code != null)<b style="color:red;">Apply Refer Code</b>:&nbsp;&nbsp;{{$apply_refer_code->apply_refer_code}}</b>@endif 
          </td>    
          <td>
            @if($coin != null){{$coin->coin}}</b>@endif 
          </td>    
          <td>
            @if($r->user_type == 2)
            User
            @elseif($r->user_type == 3)
            Doctor
            @endif 
          </td>
          <td>
            <a href="{{url('view-user-details/'.$r->user_details_id)}}" class="btn btn-primary btn-xs" title="show"><i class="fa fa-eye"></i></a>
            <a href="{{url('delete-user-data/'.$r->id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a>
            @if($r->is_block == 0)
              <a href="{{ url('block-account/'.$r->id) }}" class="btn btn-success btn-xs">Block Account</a> <br>
            @else
              <a href="{{ url('un-block-account/'.$r->id) }}" class="btn btn-danger btn-xs">Un-Block Account</a> <br>
            @endif  <br>
            @if($r->user_type == 3 && $r->is_active == 0 && $r->is_block == 0)
              <a href="{{url('approval/'.$r->id)}}" class="btn btn-primary btn-xs">Approve Now</a>
            @endif 
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Image</th> 
          <th>Name</th>  
          <th>Contact Details</th>   
          <th>Refer Code</th>  
          <th>Coin</th> 
          <th>Role</th>   
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div> 