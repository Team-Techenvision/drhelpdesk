@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">

            <div class="col-md-6"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title}}</h3>
                        <!-- ==================================================== -->
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
                        <!-- ==================================================== -->
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @if(session()->has('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('alert-danger') }}
                        </div>
                        @endif
                        @if(session()->has('alert-success'))
                            <div class="alert alert-success">
                                {{ session()->get('alert-success') }}
                            </div>
                        @endif
                    </div>
                    <!-- ==================================================== -->
                        <form action="{{url('submit_shop')}}" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Shop Name</label>
                                    <input type="text" class="form-control" name="shop_name" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="text" class="form-control" name="contact_no" maxlength="10" minlength="10" required>                                     
                                </div> 
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">                                     
                                </div>
                                <div class="form-group">
                                    <label>City</label>                                  
                                    <input type="text" class="form-control" name="city" required>                                     
                                </div>
                                <div class="form-group">                                   
                                <label>State</label>
                                <select id="checkout-state" name="state" class="form-control" required>
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
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>GST No</label>
                                    <input type="text" class="form-control" name="gst_no" >                                     
                                </div>
                                <!-- <div class="form-group">
                                    <label>Shop Logo</label>
                                    <input type="file" name="shop_logo" >                                     
                                </div>                                  -->
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary mr-2">
                                    <input type="reset" class="btn btn-sccess">                            
                                </div>
                            </div>
                        </form>		
                    </div> 
                </div>    
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Store List</h3>
                    <table class="table table-bordered" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Store name</th>
                                <th scope="col">City</th>
                                <th scope="col">Opration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($shop_list as $row)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$row->shop_name}}</td>
                                    <td>{{$row->city}}</td>
                                    <td>
                                    <a href="{{url('get-shop-detail/'.$row->id)}}" class="btn btn-info mr-2 edit_shop">Edit</a>                                     
                                    <a href="{{url('delete-shop/'.$row->id)}}" class="btn btn-danger" disabled>Delete</a></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>        
    </section>
@stop    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table_id').DataTable();     

       $(".any_message").fadeOut(4500);    
    });    
</script>