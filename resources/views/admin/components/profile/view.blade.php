@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            <div class="box"> 
                
                <form enctype="multipart/form-data" method="post" action="{{url('profile')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="box-body"> 
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control"  name="name" value="{{$user->name}}" >
                    </div> 
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control"  name="email" value="{{$user->email}}" >
                    </div> 
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control"  name="phone" value="{{$user->phone}}" >
                    </div> 
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control"  name="old_password" value="" >
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="text" class="form-control"  name="new_password" value="" >
                    </div>
                    </div><!-- /.box-body --> 
                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
               
            </div>   

        </div>
    </section>
@stop      