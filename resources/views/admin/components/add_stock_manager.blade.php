@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">

            <div class="col-md-6"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title}}</h3>	
                        <form action="{{url('submit_stock_manager')}}" method="post">
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
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" value="12345" >                                     
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endif               
                    @if(session()->has('alert-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('alert-danger') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endif
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success">
                            {{ session()->get('alert-success') }}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endif
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Shop List</h3>
                    <table class="table table-bordered" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Stock Manager Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>   
                                <th scope="col">Action</th>                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($stock_manager_list as $row)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <th scope="col">{{$row->name}}</th>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>
                                    <a href="{{url('get-stock-manager-detail/'.$row->id)}}" class="btn btn-info mr-2 edit_shop">Edit</a>                                     
                                    <a href="{{url('delete-stock-manager/'.$row->id)}}" class="btn btn-danger">Delete</a></td>
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