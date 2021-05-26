<?php  
$location_name = DB::table('locations')->where('location_name',$map_location)->first(); 
?>
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title">
                    <h2>cart</h2>
                </div>
            </div>
         
        </div>
    </div>
</section>
<!-- breadcrumb End -->


<!--section start-->

@if(Auth::check())
               	@if(is_array($result))
<section class="cart-section section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table cart-table table-responsive-xs striped-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">image</th>
                        <th scope="col">product name</th>
                        <th scope="col">price</th>
                        <th scope="col">quantity</th>
                        <th scope="col">action</th>
                        <th scope="col">total</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php 
									$total_amount=0; 
                                    $totaltype1Amount = 0;
									$extra_discount = 0;
									$extra_discount_1 = 0;
									$shipping_percent = 0;
									$total=0; 
								@endphp
                            	@foreach($result as  $details)
    								@if(!empty($details->type) && $details->type == 1)
    								    @if($details->special_price != null) 
                                        <?php $totaltype1Amount +=  
                                        ($details->special_price  * $details->quantity);   
                                        ?>
                                        @else
                                        <?php $totaltype1Amount +=  
                                        ($details->price  * $details->quantity); ?>
                                        @endif
                                        
                                        @if($details->special_price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@elseif($details->price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@endif 
												<?php $totaltype1Amount =  
                                        ($totaltype1Amount  - $extra_discount_1); 
                                     ?>
    								@endif
								@endforeach
								
								@foreach($result as  $details)
									
									@if(!empty($details->type) && ($details->type == 1 || $details->type == 2))
										<?php 
											$category = DB::table('product_images')->where('type',2)->where('products_id' , $details->products_id)->pluck('product_image')->first();  
										?> 
                    <tr id="record-{{$details->id}}">
                        <td>
                            <a href="{{url('/product-detail/'.$details->products_id)}}"><img src="{{asset($category)}}" alt=""></a>
                        </td>
                        <td><a href="{{url('/product-detail/'.$details->products_id)}}">{{ $details->product_name }}</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                       <div class="input-group">
                                   <div class="min">
								   <span onclick="counterUpdate(1,{{$details->id}})">
								   <i class="fa fa-minus" aria-hidden="true"></i></span> </div>
								   <input type="text" name="quantity" class="form-control" id="input-quantity-{{$details->id}}" value="{{$details->quantity}}">
                               <div class="plu">
                                <span href="javascript:void(0);" onclick="counterUpdate(2,{{$details->id}})">
							   <i class="fa fa-plus" aria-hidden="true"></i>
							   </span>
							   </div>
								</div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><i class="fa fa-inr" aria-hidden="true"></i>
                                                 
                                    </h2></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h2 ><i class="fa fa-inr" aria-hidden="true"></i>
                            <span id="price-{{$details->id}}"> 
                                    @if($details->special_price != null) 
													{{ $details->special_price}} 
													@else
													{{ $details->price}} 
													@endif
                            </span> 
                            </h2></td>

                        <td>
                        @if(!in_array($details->type, ['2', '3']))
                            <div class="qty-box">
                               <div class="input-group">
                                   <div class="min">
								   <span  onclick="counterUpdate(1,{{$details->id}})">
								   <i class="fa fa-minus" aria-hidden="true"></i></span> </div>
								   <input type="text" name="quantity" id="input-quantity-{{$details->id}}" class="form-control" value="{{$details->quantity}}">
                               <div class="plu">
                                <span onclick="counterUpdate(2,{{$details->id}})">
							   <i class="fa fa-plus" aria-hidden="true"></i>
							   </span>
							   </div>
								</div>
                            </div>
                            @endif
                        </td>
                        <td><a  onclick="removeProduct({{$details->id}})" class="icon"  ><i class="ti-close"></i></a></td>
                        <td>
                       
                            <h2 class="td-color"><i class="fa fa-inr" aria-hidden="true" ></i>
                            <span id="sub-total-{{$details->id}}">
												@if($details->special_price != null) 
												{{ $details->special_price  * $details->quantity }}
												@else
												{{ $details->price  * $details->quantity }}
												@endif

												@if($details->special_price != null) 
												<?php $total_amount+=  
												$details->special_price  * $details->quantity;   
												?>
												@else
												<?php $total_amount+=  
												$details->price  * $details->quantity;   
												?>
												@endif
                                                                                                
												@if($details->special_price != null && $details->extra_discount != null) 
												<?php
												$extra_discount+= ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@elseif($details->price != null && $details->extra_discount != null) 
												<?php
												$extra_discount+= ($details->price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@endif 
                                                </h2></td>
                    </tr>

                    <!-- pakage design start -->
                    @elseif(!empty($details->type) && $details->type == 3)
                            			@php $discount1 = 0 @endphp
                                        @if($details->special_price > 0)
                                            @php $details->package_cost = $details->special_price @endphp
                                        @endif
                            
                            
									    @if($details->offer_discount != null)
									    
											@php
					                          $discount = ($details->offer_discount * $details->package_cost) / 100;
                                                                 
					                          $discount1 = $details->package_cost - $discount;
					                        @endphp 
				                        @endif

                                        <tr id="record-{{$details->id}}">
                        <td>
                            <a href="{{url('/package-detail/'.$details->package_id)}}"><img src="{{$details->image}}" alt=""></a>
                        </td>
                        <td><a href="{{url('/package-detail/'.$details->package_id)}}">{{ $details->package_name }}</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <!-- <div class="qty-box">
                                       <div class="input-group">
                                            <div class="min">
                                            <a href="#">
                                            <i class="fa fa-minus" aria-hidden="true"></i></a> 
                                            </div>
								            <input type="text" name="quantity" class="form-control" value="1">
                                        <div class="plu">
                                            <a href="#">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
								    </div> -->
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><i class="fa fa-inr" aria-hidden="true"></i>
                                    <span id="price-{{$details->id}}">
                                                     @if($details->offer_discount == null) 
													{{ $details->package_cost}} 
													@else
													{{ $discount1}} 
													@endif
                                    </span> 
                                    </h2></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a class="icon" onclick="removeProduct({{$details->id}})" ><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h2><i class="fa fa-inr" aria-hidden="true"></i> 
                            <span id="sub-total-{{$details->id}}">
												@if($details->offer_discount == null)
			                                    	 {{$details->quantity  *   $details->package_cost}} 
			                                  	@else
			                                     	{{$details->quantity  *  $discount1 }} 
			                                  	@endif

											 	@if($details->offer_discount == null) 
						                          <?php $total_amount+=  
						                          $details->package_cost  * $details->quantity;   
						                          ?>
						                        @else
						                          <?php $total_amount+=  
						                          $discount1  * $details->quantity;   
						                          ?>
						                        @endif   
                            </h2></td>
                        </tr>
                        @endif
					@endforeach 
                    </tbody>                    
                </table>

                @php  
						$total=0;  
						$tamount = 0;
					@endphp 
                    <span style="display:none;" id="total"> {{round($total_amount ?? '',2)}}</span>

                    @if($copoun_amount != null)
											@if($type =='fixed')
												<?php
													$tamount = $total_amount - $extra_discount - $copoun_amount;
                                                    $totaltype1Amount = $totaltype1Amount - $copoun_amount;
												?>
											@elseif($type =='percentage')
												<?php
													$desdiscount = ($total_amount - $extra_discount) * $copoun_amount/ 100;
													$tamount = ($total_amount - $extra_discount) - $desdiscount;
                    								$totaltype1Amount = $totaltype1Amount - ($totaltype1Amount * $copoun_amount/ 100); 
												?>
											@endif                                      
										@else 
											<?php
												$tamount+= $total_amount - $extra_discount; 
											?>
										@endif 
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
                                            }elseif($totaltype1Amount >= 500 && $totaltype1Amount <= 999) {
                                                $shipping_percent = 100;
                                            }
                                            else{
												$shipping_percent = 0;
											}
                                                                                        
                                            if($type1totalitem == 0){
                                              $shipping_percent = 0;
                                            }
										@endphp 
										@if($shipping_percent != null)

                                        <!-- {{  round($shipping_percent,2) }} -->


                                        @elseif($shipping_percent == 0)
                                        @endif										
                    <!-- <i class="fas fa-rupee-sign"></i> {{round($extra_discount,2) }} -->

                    <?php
											$total+= $total_amount + $shipping_percent;
											?>

                <table class="table cart-table table-responsive-md">
                    <tfoot>
                    <tr>
                        <td>total price  :  </td>
                        <td>
                            <h2><i class="fa fa-inr" aria-hidden="true"></i> <span id="grand-total"> {{round($total ,2)}} </span></h2></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row cart-buttons">
            <div class="col-6"><a href="{{url('/')}}" class="btn btn-solid">continue shopping</a></div>
            <div class="col-6"><a href="{{url('/checkout')}}" class="btn btn-solid">check out</a></div>
        </div>
    </div>
    @endif  
@endif
</section>




