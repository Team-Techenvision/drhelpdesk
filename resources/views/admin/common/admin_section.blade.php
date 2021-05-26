<?php
use Carbon\Carbon;
?>
@php  
  $new_order = DB::table('orders')->whereDate('created_at', Carbon::today())->orderby('id','desc')->limit(5)->count();
  $total_order = DB::table('orders')->count();

  $new_lab_test = DB::table('products')->whereDate('created_at', Carbon::today())->where('categories',15)->count();
  $total_lab_test = DB::table('products')->where('categories',15)->count();

  $total_store = DB::table('shop_infos')->count();
  $total_store_manger = DB::table('users')->where('role',1)->count();


  $new_user = DB::table('users')->whereDate('created_at', Carbon::today())->where('user_type',2)->count();
  $total_user = DB::table('users')->where('user_type',2)->count();
  $new_doctor = DB::table('users')->whereDate('created_at', Carbon::today())->where('user_type',3)->count();
  $total_doctor = DB::table('users')->where('user_type',3)->count();
  $total_product = DB::table('packages')->count();
@endphp 
  

@if(Auth::user()->role == null)
  <div class="row">
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#1f9f9e;">
        <div class="inner">
          <h3>{{$new_order}}</h3>
          <p><b>New Order</b></p>
        </div>
        <div class="icon">
          <i class="fa fa-certificate"></i>
        </div>
        <a href="{{url('view-order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#3775c0;">
        <div class="inner">
          <h3>{{$total_order}}</h3>
          <p>Total Order</p>
        </div>
        <div class="icon">
          <i class="fa fa-cubes"></i>
        </div>
        <a href="{{url('view-order')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>  
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$new_user}}</h3>
          <p>New User</p>
        </div>
        <div class="icon">
           <i class="fa fa-user"></i>
        </div>
        <a href="{{url('view-user-data')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
  </div>
  <div class="row">
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#3775c0;">
        <div class="inner">
          <h3>{{$total_user}}</h3>
          <p>Total User</p>
        </div>
        <div class="icon">
           <i class="fa fa-user"></i>
        </div>
        <a href="{{url('view-user-data')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#1f9f9e;">
        <div class="inner">
          <h3>{{$new_doctor}}</h3>
          <p>New Doctor</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-md"></i>
        </div>
        <a href="{{url('view-user-data')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>  -->
    <!-- <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#3775c0;">
        <div class="inner">
          <h3>{{$total_doctor}}</h3>
          <p>Total Doctor</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-md"></i>
        </div>
        <a href="{{url('view-user-data')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>  -->
  </div>
  <!-- <div class="row">  
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$new_lab_test}}</h3>
          <p>New Lab Tests</p>
        </div>
        <div class="icon">
          <i class="fa fa-vial"></i>
        </div>
        <a href="{{url('view-product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#3775c0;">
        <div class="inner">
          <h3>{{$total_lab_test}}</h3>
          <p>Total Lab Tests</p>
        </div>
        <div class="icon">
          <i class="fa fa-vial"></i>
        </div>
        <a href="{{url('view-product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#1f9f9e;">
        <div class="inner">
          <h3>{{$total_product}}</h3>
          <p><b>Total Packages</b></p>
        </div>
        <div class="icon">
          <i class="fa fa-stack"></i>
        </div>
        <a href="{{url('view-packages')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div> -->

  <div class="row">
      <div class="col-lg-12 col-xs-12"> 
        <h2>  Store  </h2> 
     </b>   </div>
  </div>
  <div class="row">  
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$total_store}}</h3>
          <p>Store</p>
        </div>
        <div class="icon">
          <i class="fa fa-vial"></i>
        </div>
        <a href="{{url('add_shop')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
    <div class="col-lg-4 col-xs-4"> 
      <div class="small-box" style="background-color:#3775c0;">
        <div class="inner">
          <h3>{{$total_store_manger}}</h3>
          <p>Store Manager</p>
        </div>
        <div class="icon">
          <i class="fa fa-vial"></i>
        </div>
        <a href="{{url('add_shop_manager')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div> 
   
  </div>
  
 @endif