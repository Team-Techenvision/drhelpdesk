<?php  
 	$location_name = DB::table('locations')->where('location_name',$map_location)->first();  
?>
<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="checkout-page">
            <div class="checkout-form">
                <form action="{{url('checkout-submit')}}" method="POST" enctype="multipart/form-data"  onsubmit="return checkForm(this);">
                    <div class="row">                    
                                <?php  
								    $addr = 0;
		                        	$user = DB::table('user_addresses')->where('user_id' , Auth::user()->id)->orderby('id','desc')->get();  
		                        ?>  
                        @if($user->count()>0)
                        @php 
								        $addr=$user->count(); 
										$count=1; 
										$i = 0;
									@endphp
                        <div class="col-lg-6 col-sm-12 col-xs-12"> 
                        <div class="checkout-title">
                                <h3>Billing Details</h3>
                        </div>
                            <div class="row check-out ml-1">  
                        @php $count=1; @endphp
                              @foreach($user as $r) 
                              @php $defaultadd = $r->selected=="1"?'checked="checked"':'';@endphp
                                 <div class="col-sm-6 mb-2 ">
                                    <h6>{{$r->address_type}}</h6>
                                    <address><input type="radio" class="form-check-input" name="address_id" data-city='{{$r->city}}' value="{{$r->id}}"  {{$defaultadd}}><b>{{$r->name}}</b><br> {{$r->address}} <br>  {{$r->city}}
                                          <br>{{$r->state}},{{$r->country}} , {{$r->pin_code}}
                                       <br><a href="{{url('/user-address-edit/'.$r->id)}}">Edit</a>&nbsp;&nbsp;<a href="{{url('/user-address-delete/'.$r->id)}}">Delete </a>
                                    </address>
                                 </div>
                                 <?php $count++ ?>
                              @endforeach 
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h3>Billing Details</h3></div>
                            <div class="row check-out">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">First Name</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Last Name</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Phone</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">Email Address</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Country</div>
                                   <input type="text" name="field-name" value="" placeholder="country">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Address</div>
                                    <input type="text" name="field-name" value="" placeholder="Street address">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">Town/City</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <div class="field-label">State / Country</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <div class="field-label">Postal Code</div>
                                    <input type="text" name="field-name" value="" placeholder="">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="checkbox" name="shipping-option" id="account-option"> &ensp;
                                    <label for="account-option">Create An Account?</label>
                                </div>
                            </div>
                        </div>

                        @endif

                        @php 
                            $total_amount=0;
                            $extra_discount = 0;
                            $extra_discount_1 = 0;
                            $shipping_percent = 0;
                            $total=0; 
                            $total1 = 0;
                            $tamount = 0;
                            $totaltype1Amount=0;
                        @endphp

                <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="checkout-details">
                                <div class="order-box">
                                    <div class="title-box">
                                        <div>Product <span>Total</span></div>
                                    </div>                                  
                                    <ul class="qty">
                                       @foreach ($result as $r)
                                        @if(!empty($r->type) && ($r->type == 1 || $r->type == 2)) 
                                            @php $data = $r->prescription; @endphp  
                                        <li>{{$r->product_name}}   ×  {{$r->quantity}} <span><i class="fa fa-inr" aria-hidden="true"></i>
                                                    @if($r->special_price != null) 
                                                        {{ $r->special_price  * $r->quantity }}
                                                    @else
                                                        {{ $r->price  * $r->quantity }}
                                                    @endif 
                                                    </span>
                                                    </li>

                                                    @if($r->special_price != null) 
                                                                    @php $total_amount+=  
                                                                        $r->special_price  * $r->quantity;   
                                                                    @endphp
                                                                @else
                                                                    @php $total_amount+=  
                                                                        $r->price  * $r->quantity;   
                                                                    @endphp
                                                                @endif 

                                                                @if($r->special_price != null && $r->extra_discount != null) 
                                                                    @php
                                                                        $extra_discount+= ($r->price * $r->quantity *  $r->extra_discount)/100; 
                                                                        $extra_discount_1 = ($r->price * $r->quantity *  $r->extra_discount)/100;
                                                                    @endphp
                                                                @elseif($r->price != null && $r->extra_discount != null) 
                                                                    @php
                                                                        $extra_discount+= ($r->price * $r->quantity *  $r->extra_discount)/100;
                                                                        $extra_discount_1 = ($r->price * $r->quantity *  $r->extra_discount)/100;
                                                                    @endphp
                                                                @endif 
                                                                
                                                                @if($r->type == 1)
                                                                                                                        
                                                                @if($r->special_price != null) 
                                                                <?php $totaltype1Amount+=  
                                                                ($r->special_price  * $r->quantity);   
                                                                ?>
                                                                @else
                                                                <?php $totaltype1Amount+=  
                                                                ($r->price  * $r->quantity); ?>
                                                                @endif                                       
                                                                <?php  $totaltype1Amount = $totaltype1Amount - $extra_discount_1; ?>		
                                                                @endif

                                                                @elseif(!empty($r->type) && $r->type == 3)  
                                                                            @php $data = $r->prescription; @endphp 
                                                                    @php $discount1 = 0 @endphp
                                                                                                            @if($r->special_price > 0)
                                                            @php $r->package_cost = $r->special_price @endphp
                                                        @endif
                                                                            @if($r->offer_discount != null)
                                                                                @php
                                                                                $discount = ($r->offer_discount * $r->package_cost) / 100;
                                                                                $discount1 = $r->package_cost - $discount;
                                                                                @endphp
                                                                            @endif
                                                <!-- product is pakage then display this code -->
                                                <li>{{$r->package_name}}   ×  {{$r->quantity}} <span><i class="fa fa-inr" aria-hidden="true"></i>
                                                            @if($r->offer_discount == null)
                                                                {{$r->quantity  *   $r->package_cost}} 
                                                            @else
                                                                {{$r->quantity  *  $discount1 }} 
                                                            @endif
                                                    </span>
                                                    </li>

                                                        @if($r->offer_discount == null) 
                                                            <?php $total_amount+=  
                                                            $r->package_cost  * $r->quantity;   
                                                            ?>
                                                            @else
                                                            <?php $total_amount+=  
                                                            $discount1  * $r->quantity;   
                                                            ?>
                                                            @endif  
                                                        @endif
									                    @endforeach
                                    </ul>
                                                   
                                                <ul class="sub-total">
                                                    <li>Subtotal <span class="count"><i class="fa fa-inr" aria-hidden="true"></i>{{$total_amount}}</span></li>
                                                <li>Discount <span class="count"><i class="fa fa-inr" aria-hidden="true"></i>0.00</span></li>
                                                <li>Share more- Save more <span class="count"><i class="fa fa-inr" aria-hidden="true"></i>0.00</span></li>

                                                <?php
                                                    $coupon = Session::get('couponData')?Session::get('couponData')['amount']:0;
                                                    $type1 = Session::get('couponData')?Session::get('couponData')['type1']:0;   
                                                    // dd($coupon);                                             
                                                ?>
                                                @if($coupon != null)
                                                    <li>Coupon<span class="count"><i class="fa fa-inr" aria-hidden="true"></i>
                                                        @if($type1 =='fixed')
                                                            <i class="fas fa-rupee-sign"></i> {{ $coupon }}
                                                            @elseif($type1 =='percentage')
                                                            {{ $coupon }}<b> % Off</b>
                                                        @endif</span> 
                                                    </li>
                                                    <li> <span class="count"><button class="btn" id="remove_coupon" title="Remove Coupon" type="button"><i class="fa fa-trash"></i></button> </span>
                                                    </li>
                                                    @endif
                                                <li>
                                                @php
                                                    $wallet = DB::table('de_wallets')->where('user_id',Auth::user()->id)->pluck('coin')->first(); 
                                                @endphp
                                                <input type="checkbox" name="shipping-option" id="account-option"> &ensp;
                                                <label for="account-option">Use D-coins(20)</label>
                                            </li>
                                           
                                            @if($coupon != null)
										@if($type1 =='fixed')
										    @php
				                                $tamount+= $total_amount - $extra_discount - $coupon;
				                                $totaltype1Amount = $totaltype1Amount - $coupon;
                                                
				                            @endphp 
                                           
				                        @elseif($type1 =='percentage')
			                        	    @php
			                        	    $disamt = $total_amount - $extra_discount;
			                                	$tamount+= $disamt - ($disamt * $coupon / 100);  
			                                	$totaltype1Amount = $totaltype1Amount - ($totaltype1Amount * $coupon/ 100); 
                                                
			                                @endphp 
				                        @endif
									@else 
                                        
									    @php
			                                $tamount+= $total_amount - $extra_discount;  
			                            @endphp 
			                        @endif   
                                    <?php //dd($extra_discount); ?>
									@php
									
									    
									  $tamount = $tamount > 0 ? $tamount : 0;

                                      
									  $totaltype1Amount = $totaltype1Amount > 0 ? $totaltype1Amount : 1;

										$shipping = DB::table('shipping_charges')->where('min','<=',  $totaltype1Amount)->where('max','>=',$totaltype1Amount)->first();
                                       
                                        if($totaltype1Amount <= 499 ){
                                            
						                     if($map_location!='notfound' ){
                                	        $shipping_percent = 125;
						                    }else{
                                               $shipping_percent = 125;
						                     }
						                }elseif($totaltype1Amount >= 500 && $totaltype1Amount <= 999){
                                            $shipping_percent = 100;
                                        }else{
						                    $shipping_percent = 0;
						                }
						                
						                if($type1totalitem == 0){
                                                                                          $shipping_percent = 0;
                                                                                        }
                                        else{}
									@endphp
									
							<li>
                            @if($copoun_amount == null)                                                     
                                    <div class="alert alert-danger alert-dismissible" id="coupon_error" style="display:none">
    											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
                            	    <div class="row">
                                        <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Enter Coupon Code" id="coupon-id">
                                        <input type="hidden" value="{{csrf_token()}}" name="_token" id="_token"> 
                                        </div>
                                        <div class="col-6">
                                        <button class="btn btn-solid myCuppon" type="button" >Apply Coupon</button>
                                        </div>
									</div>
                                    @endif
                                    </li>
                                    @if($copoun_amount != null)
												{{$result1}}
												@else
												{{$result1}}
												@endif
                                    </ul>
								
                                    @php
			                                	$total1+= $tamount + $shipping_percent;   
			                                @endphp 
                                    <ul class="total">
                                        <li>Total <span class="count"><i class="fa fa-inr" aria-hidden="true"></i>{{round($total1,2)}}</span></li>
                                        <input  name="amount" id="amount" type="hidden"  value="{{round($total1,2)}}">
                                    </ul>
                                </div>
                                <div class="payment-box">
                                    <div class="upper-box">
                                        <div class="payment-options">
                                            <ul>
                                               
                                                <li>
                                                    <div class="radio-option">
                                                        <input type="radio"  name="payment_mode"  id="payment-2" value="COD" required>
                                                        <label for="payment-2">Cash On Delivery<span class="small-text">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</span></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio-option paypal">
                                                        <input type="radio" name="payment_mode" value="ON" id="payment-3">
                                                        <label for="payment-3">Online Payment -(Credit/ debit/ UPI transfer/ netbanking/ wallet)<span class="image"><img src="../assets/images/paypal.png" alt=""></span></label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="radio-option paypal">
                                                        {{-- <input type="radio" name="payment_mode" value="ON" id="payment-3"> --}}
                                                        <label>Due to Covid-19, Return / Replacement is not permissible.</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                   

                                    @if($data != null && $url == null)                                                
                                    <div class="text-right"><a href="{{url('/upload-prescription')}}" class="btn-solid btn">Place Order</a></div>
                                    @else
        										<input type="hidden" name="prescription_id" value="{{$url}}">
        										@if('a' == 'on')
                                                <input type="button" onClick="confSubmit(this.form);" value="Place Order" class="btn-solid btn"> 
        										@else 
                                                    <input type="button" onclick="confSubmit(this.form);" value="Place Order" class="btn-solid btn"> 
        										@endif
									        @endif                                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- section end -->

<script type="text/javascript">
    @if($totaltype1Amount < 549 && $type1totalitem != 0)
        var pendingamount = {{ceil(549 - $totaltype1Amount)}};
        document.getElementById('amountPending').innerHTML = 'You add Rs.'+pendingamount+' products for free shipping.';
    @endif
    
        var checkAddress={{$addr}};
		var type2totalitem = "{{$type2totalitem}}"
   
    var sessCityName = "{{strtolower(Session::get('location_name'))}}";
    function confSubmit(form){
        
        if(checkAddress=='0') {
            alert('Please fill the shipping address.')
            return false;
        }
    	 $('#amount_error').hide();
        var amt = $('#amount').val();
    	if(amt<=10) {
            $('#amount_error').show();
            return false;
        }
    	
        if($("#field_terms").prop("checked") == false){
           $("#model-btn").click();
           return false;
        } 
        
        
        
        var cityName = $("input[name='address_id']:checked").attr('data-city').toLowerCase();
        if(cityName != sessCityName )
        {
            @if($type2totalitem > 0)
                alert('Please change the location, We are not provding the service for lab test and health package on current location')
                return false;
            @endif
           //if(confirm("Your selected address will affect lab test, health package and shipping charge.")){
               $.ajax({
                    type: "post",
                     url: "/checkcheckoutaddress",
                    dataType: "json",
                    data: {name:cityName},
                    success : function(data){
                        form.submit(); 
                    }
                });
           //}
        }else{
            form.submit();
        }
    }
    function CheckColors(val){
        var element=document.getElementById('color');
          if(val=='input'||val=={{$wallet * 0.25}})
           element.style.display='block'; 
          else  
           element.style.display='none'; 
    }  
</script>

<script type="text/javascript">
	$(document).on('click',"input[name='address_id']",function(){
		var address_id = this.value
		var user_id = "{{ Auth::user()->id }}"
		$.post("{{ url('set_default_address') }}",{address_id:address_id,user_id:user_id},function(response){
			var result = JSON.parse(response)
			if(!result.status){
				alert("Unable to set default Address")	
			}
			
		})
	})


	$(function() {
    
      var shipAddress = $("input[name='address_id']:checked").attr('data-city').toLowerCase();
      if(sessCityName!=shipAddress || type2totalitem > 0){
      	$('.cod_cls').attr( "disabled", "disabled" );
      	$('.cld_cls').attr( "disabled", "disabled" );
      } else {
      	$('.cod_cls').removeAttr("disabled");
      	$('.cld_cls').removeAttr("disabled");
      }
    
      $("input[name='address_id']").on('click', function(){
      	//alert('1111');
      	var shipAddress = $(this).attr('data-city').toLowerCase();
      if(sessCityName!=shipAddress || type2totalitem > 0){
        $('.cod_cls').attr( "disabled", "disabled" );
        $('.cld_cls').attr( "disabled", "disabled" );
      } else {
      	$('.cod_cls').removeAttr("disabled");
      	$('.cld_cls').removeAttr("disabled");
      }
      });
     // alert(shipAddress);
	  $("#coupon_question").on("click",function() {
	  	if($("#coupon_question").prop('checked') == true){
	  		var paytotal = parseFloat($('#amount').val());
	  		var wallet = parseFloat('<?php echo($wallet * 0.25); ?>');
	  		var balance = paytotal - wallet;
	  		if(balance < 0){
	  			balance = 0.0;
	  			$('#damount').html('<i class="fas fa-rupee-sign"></i> '+paytotal);
	  		}
	  		$('#gdtotal').html('<i class="fas fa-rupee-sign"></i> '+balance.toFixed(2));
	  		$('.answer').show();
	  	}else{
	  		var paytotal = parseFloat($('#amount').val());  
	  		$('#gdtotal').html('<i class="fas fa-rupee-sign"></i> '+paytotal);
	  		$('.answer').hide();
	  	}
	    
	  });
          	
        //   $('.myCuppon').click(function(){
        //     cupon = $('#coupon-id').val();
        //     token = $('#_token').val();
        //    $('#coupon_error').hide();
        //     $.ajax({
        //             type: "post",
        //             data:{'coupon_code':cupon,'_token':token},
        //             url:"{{ url('my-cart-ajax') }}",
        //             success : function(data){
		// 				// alert(data);
        //             if(data=='1') {
        //             	 window.location.reload(true);
        //             } else {
        //             	$('#coupon_error').show();
        //             }
        //             }
        //         });
        //   })
    
    	//   $('#remove_coupon').click(function(){
        //     token = $('#_token').val();
        //     $.ajax({
        //             type: "post",
        //             data:{'_token':token},
        //             url:"{{ url('remove-coupon') }}",
        //             success : function(data){
        //              window.location.reload(true);
        //             }
        //         });
        //   })


	});

	$(document).ready(function() {
		var shipAddress = $("input[name='address_id']:checked").attr('data-city').toLowerCase();
	// alert(shipAddress);
	$.ajax({
		url: "{{url('/setlocation')}}",
	  		data:"location="+shipAddress,
	  		type: 'post',
	  		success: function(response){            
	                    // window.location.reload();
	  			// alert(responce);				  
	  		}
                });
	});

	$(function() {
    
		$("input[name='address_id']").on('click', function(){
		var shipAddress = $(this).attr('data-city').toLowerCase();
		$.ajax({
		url: "{{url('/setlocation')}}",
	  		data:"location="+shipAddress,
	  		type: 'post',
	  		success: function(response){            
	                    window.location.reload();
	  			// alert(responce);				  
	  		}
                });
	});
	
	});
	
</script>