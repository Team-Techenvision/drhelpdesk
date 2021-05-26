@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Prescription</h3> 
  </div> 
  <div class="box-body  table-responsive"> 
  <table id="example1" class="table table-bordered table-striped">
      <thead>     
        <tr>
          <th>Sr. No.</th> 
          <th>User Name</th> 
          <th>User Phone</th>
          <th>User Email</th>
          <th>User Prescription</th>  
          <th>Medicine </th> 
          <th>User Address</th>          
          <th>Action</th>
        </tr>
      </thead>
      <tbody> 
      @php 
        $count = 1;  
        @endphp 
        @foreach($prescription as $r)
        
        <!-- get User detail and address Details  -->
       <?php $user_name =  DB::table('users')->where('id',$r->user_id)->first();
            $user_address = DB::table('user_addresses')->where('id',$r->user_addresses_id)->first();
       ?>
       @if(!empty($user_name))
      <tr> 
      <td> {{$count++}}  </td>
      
      <td>
      @if($user_address != null)    
      {{$user_address->name}}
        @endif
        </td>
      
      <td>{{$user_name->phone}}</td>
    
      <td>{{$user_name->email}}</td>
      <td>
              @if($r->prescription_image != null)
             <a href="{{ url($r->prescription_image) }}" target="_blank"> <img src="{{ url($r->prescription_image) }}" style="width: 80px;"></a> 
             @endif
            </td>                        
            <td>{{$r->comment}}</td>
            <td>
              @if($user_address != null)
             Address:  {{$user_address->address}} <br>

            <!-- get State and city name  -->
           
             City: {{$user_address->city}} <br>
             Pincode:  {{$user_address->pin_code}} <br>
             State: {{$user_address->state}} <br>
             Country: {{$user_address->country }}
             @endif
            </td>  
            <td>
            
            @if($r->status == 1)
            <form action="{{url('toggle-prescription-status/0/'.$r->id. '/' .$user_name->id)}}" method="post">
              {{csrf_field()}} 
            <select  name="message" class="form-control">
                <option>select</option>
                <option value=" Prescription not clear, please upload again. ">Prescription not clear, please upload again</option>
                <option value=" We can not fulfill your requirement. ">We can not fulfill your requirement.</option>
                <option value=" Our customer support will call you shortly. ">Our customer support will call you shortly.</option>
            </select>
                <button type="submit" class="btn btn-success btn-xs mt-2">Approve</button>
               </form>
                @else
                <!-- <a href="{{ url('toggle-prescription-status/1/'.$r->id. '/' .$user_name->id) }}" class="btn btn-danger btn-xs">Disapprove</a> -->
                <form action="{{url('toggle-prescription-status/1/'.$r->id. '/' .$user_name->id)}}" method="post">
              {{csrf_field()}} 
                <button type="submit" class="btn btn-danger btn-xs">Disapprove</button>
               </form>
                @endif
            </td>    
      
      </tr>
      @endif

      @endforeach
      </tbody> 
      <tfoot>
      <tr>
          <th>Sr. No.</th> 
          <th>User Name</th> 
          <th>User Phone</th>
          <th>User Email</th>
          <th>User Prescription</th>
          <th>Medicine </th>   
          <th>User Address</th>          
          <th>Action</th>
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>   

   </div>
    </section>
@stop      