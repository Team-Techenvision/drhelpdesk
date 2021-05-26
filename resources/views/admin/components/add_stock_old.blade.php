@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">

            <div class="col-md-12"> 
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
                            <div class="box-body">
                            <form action="{{url('submit-stock')}}" name="submit_stock" method="post">
                            @csrf
                            <div class="row text-center">
                                <div class="col-sm-3">
                                </div>
                                    <div class="col-sm-6 form-group m-auto">
                                    <label class="control-label">Select Store</label>
                                                <select name="shop_id" class="form-control rounded product_id" required>
                                                <option value="">Select Store</option>
                                                @foreach($shop_list as $row) 
                                                    <option value="{{$row->id}}">{{$row->shop_name}}</option>
                                                @endforeach                 
                                                </select>
                                    </div>
                            </div>
                            </br>
                            
                            <table class="form-table w-100" id="customFields">
                                <tr valign="center" class="row addrows">
                                    <td class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label">Product</label>
                                            <select name="product_name[]" class="form-control rounded " required>
                                            <option value="">Select Product</option>
                                                @foreach($product as $row)
                                                <option value="{{$row->products_id}}">{{$row->product_name}}</option>
                                                @endforeach                  
                                            </select>
                                        </div>
                                    </td>  
                                    <td class="col-sm-3">
                                        <div class="form-group">
                                                <label class="control-label">Attribute</label>
                                            <select name="product_attribute[]" class="form-control rounded  product_attribute" required>
                                           
				                            </select>
                                        </div>
                                    </td>   
                                <!-- <td class="col-sm-3">
                                    <div class="form-group">
                                        <label class="control-label">Barcode</label>
                                        <input type="number" name="barcode[]" class="form-control text-center product_price"  >
                                    </div>
                                </td>             -->
                                <td class="col-sm-2">
                                    <div class="form-group">
                                    <label class="control-label">Quantity</label>
                                    <input type="number" name="p_qty[]" class="form-control text-center productqty"   value="1" min="1" required>
                                    </div>
                                </td>

                                <!-- <td class="col-sm-2">
                                        <div class="form-group">
                                                <label class="control-label">GST %</label>
                                            <select name="tax[]" class="form-control rounded " required>
                                            <option value="">Select GST %</option>
                                                @foreach($gst as $row)
                                                <option value="{{$row->gst_id }}">{{$row->gst_value_percentage}}</option>
                                                @endforeach                  
                                            </select>
                                        </div>
                                    </td>    -->

                                <td class="col-sm-2">
                                        <div class="form-group">
                                        <label class="control-label">Expiry Date</label>
                                        <input type="date" name="exp_date[]" class="form-control" >
                                        </div>
                                </td> 
                                <td class="col-sm-1">                  
                                    <a href="javascript:void(0);" id="addproductrow" class="btn btn-info">Add</a>
                                </td>
                                </tr>
                            </table>  

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <button class="btn btn-primary mr-1 mt-5 submit_btn" type="submit">Add Stock</button>
                                    <button class="btn btn-light mt-5 ml-3" type="reset">Reset</button>
                                </div>
                            </div>
                             	
                            </div>
                        </form>
                    </div> 
                </div>    
            </div>            
        </div>        
    </section>
@stop    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
<script>
    $(document).ready(function () {

//         $('.submit_btn').click(function(){
//     $('.submit_btn').removeAttr("type").attr("type", "submit");
//   });

       

       $("#addproductrow").click(function()
   {
       $("#customFields").append('<tr valign="center" class="row addrows"><td class="col-sm-3"> <select name="product_name[]" class="form-control rounded product_id" required> <option value="">Select Product</option>@foreach($product as $row)<option value="{{$row->products_id}}">{{$row->product_name}}</option>@endforeach</select></td><td class="col-sm-3"><div class="form-group"><label class="control-label">Attribute</label><select name="product_attribute[]" class="form-control rounded " required></select></div></td><td class="col-sm-2"><input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" min="1" required></td><td class="col-sm-2"><input type="date" class="form-control text-center expirydate" name="exp_date[]"></td><td class="col-sm-1"> <a href="javascript:void(0);" class="removeproductrow btn btn-danger">Remove</a></td></tr>');
       
   });

   $("#customFields").on('click', '.removeproductrow', function()
   {
       $(this).parent().parent().remove();
      
   }); 
   $('#table_id').DataTable();     

$(".any_message").fadeOut(4500);   
    });   
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="product_name[]"]').on('change', function() {
            var products_id = $(this).val();
            var $row = jQuery(this).closest('tr');
            var $columns = $row.find('td');
            // alert(products_id);
            if(products_id) {
                $.ajax({
                    url: '/Fetch-Attibutes/'+products_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {   
                        // alert(data);   
                        console.log(data);                                        
                        $('select[name="product_attribute[]"]').empty();
                        $.each(data, function(key, value) {
                        $columns.find('.product_attribute').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                    // $columns.find('.product_price').val(response['data'][i].special_price);
                });
            }else{
                $('select[name="product_attribute[]"]').empty();
            }
        });
    });
</script>

