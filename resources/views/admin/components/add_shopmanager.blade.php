@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">

            <div class="col-md-6"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title}}</h3>	
                        <form action="{{url('submit-shop-manager')}}" method="post">
                        @csrf
                            <div class="box-body">
                                <!-- <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" required>                                     
                                </div> -->
                                <!-- <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" required>                                     
                                </div>  -->
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" name="user_name" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">                                     
                                </div>
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input type="text" class="form-control" name="phone_no" maxlength="10" minlength="10" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>Store Name</label>
                                    <!-- <input type="text" class="form-control" name="store_name" required>  -->
                                    <select name="shop_id" id="shop_id" class="form-control rounded" required>
                                        <option value="">Select Shop</option>
                                        @foreach($shop_detail as $row) 
                                            <option value="{{$row->id}}">{{$row->shop_name}}</option>
                                         @endforeach                   
                                    </select>                                  
                                </div>                               
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" value="12345">                                     
                                </div>
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
                <div class="any_message mt-1">
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
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
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Shop List</h3>
                    <table class="table table-bordered" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Manager Name</th>
                                <th scope="col">Shop name</th>
                                <th scope="col">City</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($shop_manager_list as $row)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <th scope="col">{{$row->name}}</th>
                                    <td>{{$row->shop_name}}</td>
                                    <td>{{$row->city}}</td>
                                    <td>
                                    <!-- <a href="{{url('get-shop-manager/'.$row->id)}}" class="btn btn-info mr-2 edit_shop" disabled>Edit</a>                                     
                                    <a href="{{url('delete-manager/'.$row->id)}}" class="btn btn-danger" disabled>Delete</a></td> -->
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