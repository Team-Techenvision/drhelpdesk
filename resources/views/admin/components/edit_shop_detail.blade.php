@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            <div class="col-md-6"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                            <h3 class="box-title">{{$page_title}}</h3>
                        <div class="any_message">      	
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <!-- ==================================================== -->
                        <!-- @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif -->
                        <!-- ==================================================== -->
                            <form action="{{url('update-shop-info')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="box-body">
                                <div class="form-group">
                                        <label>Shop Id</label>
                                        <input type="text" class="form-control" name="shop_id" value="{{$shop_detail->id}}" readonly>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Shop Name</label>
                                        <input type="text" class="form-control" name="shop_name" value="{{$shop_detail->shop_name}}" required>                                     
                                    </div>
                                    <div class="form-group">
                                        <label>Contact No</label>
                                        <input type="text" class="form-control" name="contact_no" value="{{$shop_detail->phone}}" maxlength="10" minlength="10" required>                                     
                                    </div> 
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{$shop_detail->email}}">                                     
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>                                  
                                        <input type="text" class="form-control" name="city" value="{{$shop_detail->city}}" required>                                     
                                    </div>
                                    <div class="form-group">                                   
                                    <label>State</label>
                                     <!-- <input type="text" name="state" class="form-control" value="{{$shop_detail->state}}" readonly>  -->
                                     <select id="checkout-state" name="state" class="form-control" required>
                                        <option value="">Select State</option>
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
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$shop_detail->address}}" required>                                     
                                    </div>
                                    <div class="form-group">                                   
                                    <label>Country</label>
                                     <input type="text" name="country" class="form-control" value="{{$shop_detail->country}}" readonly>                                     
                                    </div>
                                    <div class="form-group">
                                    <label>GST No</label>
                                    <input type="text" class="form-control" name="gst_no" value="{{$shop_detail->gst_no}}" >                                     
                                </div>                                                                
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mr-2">                                        
                                        <a href="{{url('add_shop')}}" class="btn btn-outline-dark">Close</a>                                                                   
                                    </div>
                                </div>
                            </form>                       	
                        </div> 
                    </div>    
                </div>             
            </div>
        </div>
    </section>
@stop      