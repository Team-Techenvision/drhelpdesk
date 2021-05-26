@php $page='profile' @endphp
<!-- section start -->
<?php
    $profile = DB::table('user_details')->where('user_id',Auth::user()->id)->first();
    $total_orders =  DB::table('orders')->where('user_id',Auth::user()->id)->get()->count();
    // dd($total_orders);
?>
<section class="section-b-space">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
         @include('UI/components/user/userweb_sidebar')
         </div>
         <div class="col-lg-9">
            <div class="dashboard-right">
               <div class="dashboard">
                  <div class="box-account box-info w-100">
                     <div class="box-head">
                        <div class="row">
                           <div class="col-md-12">
                              <button type="button" class="btn btn-solid" data-toggle="collapse" data-target="#demo">Edit Profile</button>
                              <div id="demo" class="collapse">
                                 <br>
                                 <div class="contact-page">
                                    <form class="theme-form" action="{{url('user-profile-submit')}}" method="post"  enctype="multipart/form-data" >
                                    {{ csrf_field() }}
				                        <input type="hidden" name="user_id" value="{{$profile->user_id}}">
                                       <div class="form-row">
                                          <div class="col-md-6">
                                          <label for="name">Full Name</label>
								                <input type="text" class="form-control"  name="user_name" value="{{$profile->user_name}}" placeholder="Full Name" required>
                                          </div>
                                          <div class="col-md-6">
                                          <label for="profile-email">Email Address</label>
								            <input type="email" class="form-control" id="profile-email" name="email" value="{{$profile->email}}" placeholder="Email Address" readonly>
                                          </div>
                                          <div class="col-md-6">
                                          <label for="checkout-phone">Phone</label>
								                     <input type="text" class="form-control" id="checkout-phone" name="mobile" value="{{$profile->mobile}}" placeholder="Phone" readonly>
                                          </div>
                                          <div class="col-md-6">
                                          <div class="form-group mb-0">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" value="{{$profile->dob}}">
                                        </div>
                                          </div>
                                          <div class="col-md-12">
                                             <p>Gender</p>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio1">
                                                <input type="radio" class="form-check-input" id="radio1" name="gender" value="male" checked>Male
                                                </label>
                                             </div>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio2">
                                                <input type="radio" class="form-check-input" id="radio2" name="gender" value="female">Female
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <button class="btn btn-sm btn-solid" type="submit">Save setting</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                     </div>
					 <br>
                     <div class="box">
                        <div class="row">
                           <div class="col-sm-6">
						            <h3>{{$profile->user_name}}</h3>
                              <address>{{$profile->gender}}<br> {{$profile->mobile}} <br>{{$profile->email}}
                              </address>
                           </div>
						            <div class="col-sm-6">
                                 <address><h3>Total Orders</h3> <h4>{{ $total_orders }}</h4></address>
                              </div>
                        </div>							
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- section end -->