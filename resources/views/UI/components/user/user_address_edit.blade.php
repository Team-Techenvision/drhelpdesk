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
                  <div class="box-account box-info">
                     <div class="box-head">
                        <div class="row">
                           <div class="col-md-12">
                              <!-- <button type="button" class="btn btn-solid" data-toggle="collapse" data-target="#demo">Add New Address</button>
                              <div id="demo" class="collapse"> -->
                              <h2>Edit Address</h2>
							  <br>
                                 <div class="contact-page">
                                    <form class="theme-form" action="{{url('/user-address-submit')}}" method="post" name="add_address" enctype="multipart/form" >
                                    @csrf 
                                    <input type="hidden" name="url" value="{{url()->previous()}}">
					                <input type="hidden" name="id" value="{{$address->id}}">
                                       <div class="form-row">
                                          <div class="col-md-6">
                                             <input type="text" class="form-control" id="name" placeholder="Enter Your name" name="name" value="{{$address->name}}" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control notext" maxlength="10"  placeholder="Enter your number" name="phone" id="phone" value="{{$address->phone}}"  required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="number" class="form-control"  placeholder="Pincode" min="100000" max="999999" name="pin_code" value="{{$address->pin_code}}" required>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="Locality" name="locality" required="" value="{{$address->locality}}">
                                          </div>
                                          <div class="col-md-12">
                                             <textarea class="form-control" placeholder="Address (Area and Street)" id="exampleFormControlTextarea1" name="address" required rows="4">{{$address->address}}  </textarea>
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="Email" id="checkout-email" name="email" value="{{$address->email}}" required >
                                          </div>
                                          <div class="col-md-6">
                                             <input type="text" class="form-control"  placeholder="City/District/Town" name="city" value="{{$address->city}}" required>
                                          </div>
                                          <div class="col-md-6">
                                             <select id="checkout-state" name="country" class="form-control" style="height:42px"  required>
                                                <option>Select a country...</option>
					                                 <option value="india" selected="">India</option>
                                             </select>
                                          </div>
                                          <div class="col-md-6">
                                             <select id="checkout-state" name="state" class="form-control" style="height:42px"  required>
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
                                             <input type="text" class="form-control"  placeholder="landmark(optional)" name="landmark" value="{{$address->landmark}}" required="">
                                          </div>
                                          <div class="col-md-6 mt-3">
                                             <input type="text" class="form-control"  placeholder="Alternate phone number(optional)" name="phone_alt" value="{{$address->phone_alt}}" required="">
                                          </div>
                                         
                                          <div class="col-md-12">
                                             <p>Address Type</p>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio1">
                                                <input type="radio" class="form-check-input" id="radio1" name="address_type" value="Home" <?php if(($address->address_type)=='Home'){ echo 'checked'; }?> >Home
                                                </label>
                                             </div>
                                             <div class="form-check-inline">
                                                <label class="form-check-label" for="radio2">
                                                <input type="radio" class="form-check-input" id="radio2" name="address_type" value="Work" <?php if(($address->address_type)=='Work'){ echo 'checked'; }?> >Work
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-12">
                                             <button class="btn btn-solid" id="add_address" type="submit">Save</button>&nbsp;&nbsp;<button class="btn btn-solid" type="reset">Cancel</button>
                                          </div>
                                       </div>
                                    </form>
                                 </div>
                              <!-- </div> -->
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