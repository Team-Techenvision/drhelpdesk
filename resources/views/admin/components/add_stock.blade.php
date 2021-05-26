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
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>   
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
                            <div class="box-body">
                            <form action="{{url('submit-stock')}}" name="submit_stock" method="post" onsubmit ="return validate()">
                            @csrf
                            <div class="row ">
                                <div class="col-sm-3">
                                </div>
                                    <div class="col-sm-12 form-group m-auto">
                                    <label class="control-label">Select Store</label>
                                                <select name="shop_id" class="form-control rounded product_id" required>
                                                <option value="">Select Store</option>
                                                @foreach($shop_list as $row) 
                                                    <option value="{{$row->id}}">{{$row->shop_name}}</option>
                                                @endforeach                 
                                                </select>
                                    </div>

                                    <div class="form-group col-sm-12">
                                                <label class="control-label">Product</label>
                                            <select name="product_name" class="form-control rounded " id="product_name" required>
                                            <option value="">Select Product</option>
                                                @foreach($product as $row)
                                                <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                                                @endforeach                  
                                            </select>
                                        </div>
                                    <div class="form-group col-sm-12">                                            
                                            <label class="control-label">Attribute </label>
                                            <select name="attribute_id" class="form-control rounded " id="attribute" required>
				                            </select>
                                    </div>

                                    <div class="form-group col-sm-12">                                            
                                        <label class="control-label">Available Quantity </label>
                                        <input type="number" name="p_qty" class="form-control text-center product_attribute_qty" readonly>
                                </div>

                                    <div class="form-group col-sm-12">
                                        <label class="control-label">Quantity</label> <br>
                                        <span>If tablets then total number of tablets ) Ex : 4 strip and tablet per strip is 10 : add as  quantity as 40 </span>
                                        <input type="number" name="p_qty" class="form-control text-center productqty"   value="1" min="1" required>
                                            <span class="model_error_sms text-danger">
                                                Quantity must be less than or equal to available quantity
                                            </span>
                                            </div>

                                    <div class="form-group col-sm-12">
                                        <label class="control-label">Expiry Date</label>
                                        <input type="date" name="exp_date" class="form-control" >
                                        </div>
                                    <input type="hidden" name="status" value="1">
                            </div>
                            </br>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <button class="btn btn-primary mr-1 mt-5 submit_btn" type="submit" >Add Stock</button>
                                    {{-- for apply quantity validation on enble this function onsubmit="validate()" --}}
                                    <button class="btn btn-light mt-5 ml-3" type="reset">Reset</button>
                                </div>
                            </div>
                             	
                            </div>
                        </form>
                    </div> 
                </div>    
            </div>  
        </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Stock List</h3>
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Store name</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($stock_list as $row)
                                <tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$row->shop_name}}</td>
                                    <td>{{$row->product_name}}</td>
                                    <td>{{$row->avl_quantity}}</td>
                                    <td>{{$row->expiry_date}}</td>     
                                    <td><a href="{{url('delete-shop-stock/'.$row->stock_id)}}" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></a></td>                               
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
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->


{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('select[name="product_name"]').on('change', function() {
            var products_id = $(this).val();
            // alert(products_id);
            if(products_id) {
                $.ajax({
                    url: '/Fetch-Attibutes/'+products_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {   
                        // alert(data);   
                        console.log(data);  
                        $('.product_attribute').text(data);  
                                                     
                        // $('select[name="product_attribute"]').empty();
                        // $.each(data, function(key, value) {
                        // $('.product_attribute').append('<option value="'+ key +'">'+ value +'</option>');
                        // });
                    }
                    // $columns.find('.product_price').val(response['data'][i].special_price);
                });
            }else{
                $('select[name="product_attribute"]').empty();
            }
        });
    });
</script> --}}


{{-- <script type="text/javascript">
function validate(){
   var max = parseInt(document.getElementById('points1st').value);
   var min = parseInt(document.getElementById('conversionpoints1st').value);
   if(min >= max){
       alert('Points should be greater than conversion points for 1st winner.');
        return false;
       $("#points1st").focus();
   }else{
    return validate1()
   }
}
</script> --}}


<script>
                $(document).ready(function () {
                    $(".model_error_sms").css("display", "none");
                $('#product_name').on('change', function () {
                let products_id = $(this).val();
                $('#attribute').empty();
                $('#attribute').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: 'GET',
                url: '/Fetch-Attibutes/' + products_id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);  
                // alert(response['0']['quantity']);
                $('.product_attribute_qty').val(response['0']['quantity']); 
                $('#attribute').empty();
                // $('#attribute').append(`<option value="0" disabled selected>Select Attributes*</option>`);
                response.forEach(element => {
                    $('#attribute').append(`<option style="background-color:${element['product_color']}" value="${element['id']}">${element['size_name']}</option>`);
                    });
                }
            });
        });
    });
    </script>

    
{{-- 
    vaidation working code for quantity 20-04-2021
<script type="text/javascript">
    function validate(){
        // alert();
                  var availablle_qty = $('.product_attribute_qty').val();
                  var assign_qty = $('.productqty').val();
                //   alert(assign_qty);
      if(assign_qty <= availablle_qty){
          return true;
      }
      else {
        //    alert('model_error_sms');
           $(".model_error_sms").css("display", "block");
            $(".model_error_sms").fadeOut(7000);
          return false;
      }
    } 
    
        </script> --}}


