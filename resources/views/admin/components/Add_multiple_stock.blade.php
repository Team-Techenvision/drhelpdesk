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
                            <form action="{{url('submit-multiple-stock')}}" name="submit_stock" method="post">
                            @csrf
                            <div class="row ">

                                <div class="col-sm-12 form-group m-auto">
                                    <label class="control-label">Select Store</label>
                                                <select name="shop_id" class="form-control rounded" required>
                                                <option value="">Select Store</option>
                                                @foreach($shop_list as $row) 
                                                    <option value="{{$row->id}}">{{$row->shop_name}}</option>
                                                @endforeach                 
                                                </select>
                                    </div>

                                <table class="form-table w-100" id="customFields">
                                    <tr valign="top" class="row addrows">
                                    <td class="col-sm-2">
                                        <div class="form-group">
                                              <label class="control-label">BarCode</label>
                                             <input type="text" class="form-control product_brcodes" name="product_brcode[]" required>
                                        </div>
                                      </td>                
                                      <td class="col-sm-3">
                                        <div class="form-group">
                                              <label class="control-label">Product Name</label>
                                              <input type="text" class="form-control text-center product_name" name="product_name[]" readonly>
                                              <input type="hidden" class="form-control text-center products_id" name="products_id[]" readonly>                       
                                              <input type="hidden" class="form-control text-center attribute_id" name="attribute_id[]" readonly>                       
                                        </div>
                                      </td>
                                      <td class="col-sm-2">
                                        <div class="form-group">
                                              <label class="control-label">Avl Quantity</label>
                                              <input type="text" class="form-control text-center avl_qty p-0" name="avl_quantity[]"  value="" readonly>
                                        </div>
                                      </td>
                                      
                                      <td class="col-sm-2">
                                        <div class="form-group">
                                          <label class="control-label">Quantity</label>
                                          <input type="number" class="form-control text-center productqty" name="p_qty[]"  value="1" min="1" required>
                                        </div>
                                      </td>
                                      
                                      <td class="col-sm-2">
                                        <div class="form-group">
                                        <label class="control-label">Expiry Date</label>
                                        <input type="date" name="exp_date[]" class="form-control" required>
                                        </div>
                                </td> 

                                      <td class="col-sm-1">                  
                                        <a href="javascript:void(0);" id="addCF" class="btn btn-info mt-4">Add</a>
                                      </td>
                                    </tr>
                                  </table>

                            </div>    
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <button  type="submit" class="btn btn-primary mr-1 mt-5 " >Add Stock</button>
                                    <button class="btn btn-light mt-5 ml-3" type="reset">Reset</button>
                                </div>
                            </div>
                             	
                            
                        </form>
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

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->

<script>
   
    $(document).ready(function()
    {
   
    //  $('.submit_btn').click(function(){
    //    $('.submit_btn').removeAttr("type").attr("type", "submit");
    //  });
    
     // ====================================
       $("#addCF").click(function()
       {
           $("#customFields").append('<tr class="row addrows mb-1"><td class="col-sm-2"><input type="text" class="form-control product_brcodes" name="product_brcode[]" required></td><td class="col-sm-3"> <input type="text" class="form-control text-center product_name" name="product_name[]" readonly><input type="hidden" class="form-control text-center products_id" name="products_id[]" readonly><input type="hidden" class="form-control text-center attribute_id" name="attribute_id[]" readonly></td><td class="col-sm-1"><input type="text" class="form-control text-center avl_qty p-0" name="avl_quantity[]"  value="" readonly></td><td class="col-sm-1"><input type="text" class="form-control text-center productqty" name="p_qty[]" value="1" min="1"></td><td class="col-sm-2"><input type="date"  class="form-control text-center" name="exp_date[]"  required></td><td class="col-sm-1"> <a href="javascript:void(0);" class="remCF btn btn-danger">Remove</a></td></tr>');
        //    final_amount();
       });
     // =========================
       $("#customFields").on('click', '.remCF', function()
       {
           $(this).parent().parent().remove();
        //    final_amount();
       });
    }); 
</script>

<script>
     $(document).ready(function()
    {
        // alert();
    $('#customFields').on("keyup", ".product_brcodes", function(event)
  { 
  // $(".product_brcodes").focusout(function(){
    // alert($(this).val());
    $len = $(this).val().length;
    var $row = jQuery(this).closest('tr');
    var $columns = $row.find('td');
        // alert($len);
    if($len >= 10 )
    {
    //   alert($(this).val());
      $.ajax({
                type: "post",          
                url: "{{ url('br-product-detail') }}",
                dataType: "json",
                data: {"_token": "{{ csrf_token() }}",
                      "barcode": $(this).val()},
                success : function(response){ 
                  var len = 0;
                //   alert(response);
                  console.log(response);
                 // tr.find('.product_price').val(response["special_price"]);
                 $columns.find('.p_expiry option').remove(); 
                  if(response['data'] != null)
                  {
                    len = response['data'].length;
                    if(len > 0 )
                    {
                      for(var i = 0;i < len;i++)
                      {
                       
                       if(response['data'][i].special_price)
                       {
                          // $columns.find('.product_price').val(response['data'][i].special_price);
                          $columns.find('.product_price').val(response['data'][i].price_per_pic);                         

                       }
                       else
                       {
                          // $columns.find('.product_price').val(response['data'][i].price); 
                          $columns.find('.product_price').val(response['data'][i].price_per_pic);                       

                       }
                       $p_name  = "";
                       if(response['data'][i].size_name)
                       {
                        $p_name = response['data'][i].product_name + ' '+response['data'][i].size_name;
                       }
                       else
                       {
                          $p_name = response['data'][i].product_name;
                       }
                      //  $columns.find('.product_name').val(response['data'][i].product_name);
                      // $columns.find( ".product_name1" ).prepend($p_name);
                    //   if(i==0)
                    //   {
                    //   $columns.find(".product_name1").prepend(`<option value="${response['data'][i].id}" selected>
                    //                    ${$p_name}
                    //               </option>`);
                    //   } 
                      
                      $columns.find('.product_name').val($p_name);
                      $columns.find('.products_id').val(response['data'][i].products_id);
                      $columns.find('.attribute_id').val(response['data'][i].id);
                    //  $columns.find('.avl_stock').val(response['data'][i].avl_quantity); 


                    //    $columns.find('.product_gst').val(response['data'][i].gst_value_percentage);
                       $columns.find('.avl_qty').val(response['data'][i].quantity);
                      //  ===============================================

                      $columns.find('.p_expiry').prepend(`<option value="${response['data'][i].expiry_id}" selected>
                       ${response['data'][i].Expiry}
                                  </option>`);
                        var avl_Qty = response['data'][i].quantity;          
                      $columns.find('.productqty').attr("max",avl_Qty); 
                    //   $columns.find('.avl_stock').val(response['data'][i].avl_Qty); 

                      // ==============================================

                       $columns.find('.productqty').val(1);
                       

                            // $price = $columns.find('.product_price').val();
                            // $gst = $columns.find('.product_gst').val();
                             

                            // $total = $price * 1;
                            // // $gst_amt = ($price * 1)/100 * 10;
                            // // $final_amt =$total + $gst_amt;                            
                            // $columns.find('.amount').val($total.toFixed(2));
                            // final_amount();                             
                      }
                    }
                  }
                }
            });
    }
  });
});
</script>



    

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
    
        </script>


