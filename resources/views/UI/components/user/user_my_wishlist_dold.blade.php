<?php  
$location_name = DB::table('locations')->where('location_name',$map_location)->first(); 
?>

<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current"><a href="{{url('/my-wishlist')}}" class="breadcrumb__item-link">Wishlist</a>
					</li> 
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
    
</div>

<div class="block">
	<div class="container"> 
		<div class="row cart">
 
            @if(Auth::check())
                   @if($result != null)                 
					<div class="col-sm-12 col-md-12 col-lg-12 cart__table cart-table">
                        <div id="amountPending" style="font-weight: 600;font-size: 17px;color:red;"></div>
						<table class="cart-table__table test001">
							<thead class="cart-table__head">
								<tr class="cart-table__row">										
									<th class="text-left" colspan="2">Product</th>
									<th class="text-center">Price</th>
									<th class="cart-table__column cart-table__column--remove">Action</th>
								</tr>
							</thead>
							<tbody class="cart-table__body test001">

                            @foreach($result as  $wishlists)
                          @php   $products = DB::table('products')->where('products_id' , $wishlists->product_id)->first(); @endphp
                          <?php 
							$category = DB::table('product_images')->where('type',2)->where('products_id' , $products->products_id)->pluck('product_image')->first();  
							
						?>
						    <tr>
							<td class="cart-table__column cart-table__column--image">
												<a href="{{url('/product-detail/'.$products->products_id)}}">
													<img src="{{asset($category)}}" alt="" class="img-fluid">
												</a>
											</td>
                            <td class=""><a href="{{url('/product-detail/'.$products->products_id)}}" class="cart-table__product-name">	{{ $products->product_name }}</a> 
								</td>
                                <td class="text-center">
									<i class="fas fa-rupee-sign"></i> 
									@if($products->special_price == null)
									{{ $products->price }}
									@else
									{{ $products->special_price }} <span class="product__price--old"> <i class="fas fa-rupee-sign"></i>  {{$products->price}}</span> 
									@endif
                                </td>
                                <td class="text-center"> 
												<a href="" class="text-danger" onclick="removeWishlist({{$products->products_id}})" cl><i class="icon-cross"></i></a>
											</td> 
                            </tr>
                            @endforeach
							</tbody>
							
						</table>
					</div>
				@else 
					<div class="ps-section__cart-bottom p-4 mb-4" style="text-align:center;">
                    <h4 class="text-danger">No Item In Wishlist</h4> 
						<a class="ps-btn" href="{{url('/')}}"><i class="icon-arrow-right"></i> Continue Shopping</a>
					</div>				
				@endif  
			@endif
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
