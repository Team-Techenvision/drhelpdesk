@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">

            <div class="col-md-6"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title}}</h3>	
                        <form action="{{url('update-stock-manager')}}" method="post">
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
                                    <input type="text" class="form-control" name="user_name" value="{{$stock_manager->name}}" required>                                     
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$stock_manager->email}}">                                     
                                </div>
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input type="text" class="form-control" name="phone_no" maxlength="10" minlength="10" value="{{$stock_manager->phone}}"  required>                                     
                                </div>
                                <input type="hidden" name="user_id" value="{{$stock_manager->id}}">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary mr-2">
                                    <input type="reset" class="btn btn-sccess">                            
                                </div>
                            </div>
                        </form>	                       	
                    </div> 
                </div>    
            </div>
            
        </div>
    </section>
@stop      