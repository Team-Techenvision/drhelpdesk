@php $page='address' @endphp
<!-- section start -->
<section class="section-b-space">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
         @include('UI/components/user/userweb_sidebar')   
         </div>

         @php 
            $user = DB::table('user_addresses')->where('user_id' , Auth::user()->id)->get(); 
            $cities = DB::table('cities')->orderBy('city_name','asc')->get();
         @endphp 
         <div class="col-lg-9">
            <div class="dashboard-right">
               <div class="dashboard">
                  <div class="box-account box-info w-100">
                     <div class="box-head">
                        <div class="row">
                           <div class="col-md-12">
                              <button type="button" class="btn btn-solid" data-toggle="collapse" data-target="#demo">Add New Address</button>
                              <div id="demo" class="collapse">
							         <br>
                                 <div class="contact-page">
                                    <form class="theme-form" action="{{url('/user-address-submit')}}" method="post" name="add_address" enctype="multipart/form" >
                                    @csrf 
                                    <input type="hidden" name="url" value="{{url()->previous()}}">
                                       <div class="form-row">
                                          <div class="col-md-6">
                                             <input type="text" class="form-control" id="name" placeholder="Enter Your name" name="name" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control notext" maxlength="10"  placeholder="Enter your number" name="phone" id="phone" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="number" class="form-control"  placeholder="Pincode" min="100000" max="999999" name="pin_code" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="Locality" name="locality" required="">
                                          </div>
                                          <div class="col-md-12">
                                             <textarea class="form-control" placeholder="Address (Area and Street)" id="exampleFormControlTextarea1" name="address" required rows="4"></textarea>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="Email" id="checkout-email" name="email" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="City/District/Town" name="city" required>
                                          </div>
                                          <div class="col-md-6">
                                             <select id="checkout-state" name="country" class="form-control" style="height:42px" required>
                                                <option>Select a country...</option>
					                                 <option value="india" selected="">India</option>
                                             </select>
                                          </div>
                                          <div class="col-md-6">
                                             <select id="checkout-state" name="state" class="form-control" style="height:42px" required>
                                             <option value="" disabled="">Select State</option>
                                                   <option value="andaman_nicobar_island">Andaman &amp; Nicobar Islands</option>
                                                   <option value="andhra_pradesh">Andhra Pradesh</option>
                                                   <option value="arunachal_pradesh" >Arunachal Pradesh</option>
                                                   <option value="assam">Assam</option>
                                                   <option value="bihar">Bihar</option>
                                                   <option value="chandigarh" >Chandigarh</option>
                                                   <option value="chhattisgarh"  >Chhattisgarh</option>
                                                   <option value="dadra_nagar_haveli" >Dadra &amp; Nagar Haveli</option>
                                                   <option value="daman_and_diu" >Daman and Diu</option><option value="delhi">Delhi</option>
                                                   <option value="goa">Goa</option>
                                                   <option value="gujarat" >Gujarat</option>
                                                   <option value="haryana">Haryana</option>
                                                   <option value="himachal_pradesh" >Himachal Pradesh</option>
                                                   <option value="jammu_kashmir">Jammu &amp; Kashmir</option>
                                                   <option value="jharkhand" >Jharkhand</option>
                                                   <option value="karnataka">Karnataka</option>
                                                   <option value="kerala">Kerala</option>
                                                   <option value="lakshadweep">Lakshadweep</option>
                                                   <option value="madhya_pradesh">Madhya Pradesh</option>
                                                   <option value="maharashtra" >Maharashtra</option>
                                                   <option value="manipur">Manipur</option>
                                                   <option value="meghalaya">Meghalaya</option>
                                                   <option value="mizoram">Mizoram</option>
                                                   <option value="nagaland">Nagaland</option>
                                                   <option value="odisha">Odisha</option>
                                                   <option value="puducherry">Puducherry</option>
                                                   <option value="punjab">Punjab</option>
                                                   <option value="rajasthan">Rajasthan</option>
                                                   <option value="sikkim">Sikkim</option>
                                                   <option value="tamil_nadu">Tamil Nadu</option>
                                                   <option value="telangana">Telangana</option>
                                                   <option value="tripura">Tripura</option>
                                                   <option value="uttarakhand">Uttarakhand</option>
                                                   <option value="uttar_pradesh">Uttar Pradesh</option>
                                                   <option value="west_bengal">West Bengal</option>
                                             </select>
                                          </div>
                                          <div class="col-md-6 mt-3">
                                             <input type="text" class="form-control"  placeholder="landmark(optional)" name="landmark" required="">
                                          </div>
                                          <div class="col-md-6 mt-3">
                                             <input type="text" class="form-control"  placeholder="Alternate phone number(optional)" name="phone_alt">
                                          </div>
                                         
                                          <div class="col-md-12">
                                             <p>Address Type</p>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio1">
                                                <input type="radio" class="form-check-input" id="radio1" name="address_type" value="Home" checked>Home
                                                </label>
                                             </div>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio2">
                                                <input type="radio" class="form-check-input" id="radio2" name="address_type" value="Work">Work
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <button class="btn btn-solid" id="add_address" type="submit">Save</button>&nbsp;&nbsp;<button class="btn btn-solid" type="reset">Cancel</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <h2>Address Book</h2>
                     </div>
                     	
                     <div class="box">
                        <div class="row">
                           @if($user->count()>0) 
                              @php $count=1;  @endphp
                              @foreach($user as $r) 
                              @php $defaultadd = $r->selected=="1"?'checked="checked"':''; @endphp
                                 <div class="col-sm-6 mb-2">
                                    <h6>{{$r->address_type}}</h6>
                                    <address><input type="radio" class="form-check-input" name="address_id" value="{{$r->id}}" {{$defaultadd}} ><b>{{$r->name}}</b><br> {{$r->address}} <br>  {{$r->city}}
                                          <br>{{$r->state}},{{$r->country}} , {{$r->pin_code}}
                                       <br><a href="{{url('/user-address-edit/'.$r->id)}}">Edit</a>&nbsp;&nbsp;<a href="{{url('/user-address-delete/'.$r->id)}}">Delete </a>
                                    </address>
                                 </div>

                                 @if(session('prescription_submit') != null)
				     @php   $prescription_id=Session::get('prescription_submit'); @endphp
					 <form action="{{url('/prescription-final-submit')}}" method="post">
						<div class="form-row">
							<div class="form-group col-md-12 text-center mt-3">	
							<input type="hidden" id="newprescriptionaddress" name="user_addresses_id" value="{{$r->id}}">	 	
							<input type="hidden" name="prescription_id" value="<?php echo $prescription_id; ?>">
								<button type="submit" id="prescription_submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
						@endif

                                 <?php $count++ ?>

                              @endforeach 
							      @endif 
                        </div>
                           <!-- <div class="col-sm-6">
                              <h6>Home</h6>
                              <address><input type="radio" class="form-check-input" name="optradio"><b>Gulnazz</b><br>123,<br> Phase 11, Sector 66, Mohali, <br>Punjab-160066
                                 <br><a href="#">Edit</a>&nbsp;&nbsp;<a href="#">Delete </a>
                              </address>
                           </div> -->
                     </div>



                     
                  </div>                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- section end -->