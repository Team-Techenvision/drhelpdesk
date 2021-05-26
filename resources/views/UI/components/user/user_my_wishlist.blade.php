@php $page='wishlist' @endphp
<!-- section start -->
<section class="section-b-space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
            @include('UI/components/user/userweb_sidebar')                
            </div>
            <div class="col-lg-9">
                <div class="dashboard-right wishlist-section section-b-space">
                    <div class="dashboard">
                          <div class="row" >
                          @if(Auth::check())
                          
                   @if($result->count() > 0)  
            <div class="col-sm-12">
			<div class="table-responsive" >
                <table class="table cart-table">
                    <thead>
                    <tr class="table-head">
                        <th scope="col" style="width:20%">image</th>
                        <th scope="col" style="width:30%">product name</th>
                        <th scope="col" style="width:15%">price</th>
                        <th scope="col" style="width:10%">availability</th>
                        <th scope="col" style="width:25%;">action</th>
                    </tr>
                    </thead>
                    <tbody>                    
                    @foreach($result as  $wishlists)
                          @php   $products = DB::table('products')->where('products.products_id', $wishlists->product_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->first(); @endphp
                          <?php 
							$category = DB::table('product_images')->where('type',2)->where('products_id' , $products->products_id)->pluck('product_image')->first();  
							
						?>
                    <tr>
                        <td>
                        <a href="{{url('/product-detail/'.$products->products_id)}}">
							<img src="{{asset($category)}}" alt="" class="img-fluid">
						</a>
                        </td>
                        <td> <a href="{{url('/product-detail/'.$products->products_id)}}">	{{ $products->product_name }}</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <p>in stock</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"> 
                                    <i class="fa fa-inr" aria-hidden="true"></i> 
									@if($products->special_price == null)
                                    <i class="fa fa-inr" aria-hidden="true"></i>{{ $products->price }}
									@else
									<i class="fa fa-inr" aria-hidden="true"></i>{{ $products->special_price }} <del> <i class="fa fa-inr" aria-hidden="true"></i>{{$products->price}} </del> 
									@endif
                                    </h2></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon mr-1"><i class="ti-close"></i> </a><a href="mycart.php" class="cart"><i class="ti-shopping-cart"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h2>
                            @if($products->special_price == null)
                            <i class="fa fa-inr" aria-hidden="true"></i>{{ $products->price }}
									@else
									<i class="fa fa-inr" aria-hidden="true"></i>{{ $products->special_price }} <del> <i class="fa fa-inr" aria-hidden="true"></i>{{$products->price}} </del> 
									@endif
                            </h2></td>
                        <td>
                            <p>in stock</p>
                        </td>
                        <td><a  onclick="removeWishlist({{$products->products_id}})" class="icon"><i class="ti-close"></i> </a><a class="text-center ml-2" href="{{url('cart-details/'.$products->products_id.'/'.$products->id.'/'.$products->categories)}}" class="cart"><i class="ti-shopping-cart"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>  
                                  

                    <!-- <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/2.jpg" alt=""></a>
                        </td>
                        <td><a href="#">Vega MP-01 Make Up Blender Sponge</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <p>in stock</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color">₹49.00</h2></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon mr-1"><i class="ti-close"></i> </a><a href="mycart.php" class="cart"><i class="ti-shopping-cart"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h2>₹49.00</h2></td>
                        <td>
                            <p>Out of stock</p>
                        </td>
                        <td><a href="#" class="icon mr-3"><i class="ti-close"></i> </a><a href="mycart.php" class="cart"><i class="ti-shopping-cart"></i></a></td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/3.jpg" alt=""></a>
                        </td>
                        <td><a href="#">Lakme Insta Eye Liner</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <p>in stock</p>
                                </div>
                                <div class="col-xs-3">
                                    <h2 class="td-color">₹130.00</h2></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon mr-1"><i class="ti-close"></i> </a><a href="mycart.php" class="cart"><i class="ti-shopping-cart"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h2>₹130.00</h2></td>
                        <td>
                            <p>in stock</p>
                        </td>
                        <td><a href="#" class="icon mr-3"><i class="ti-close"></i> </a><a href="mycart.php" class="cart"><i class="ti-shopping-cart"></i></a></td>
                    </tr>
                    </tbody> -->
                </table>
               
            </div>
           
			</div>
        </div>
        @else
        <div class="row cart-buttons">
            <div class="col-12"><a href="{{url('/')}}" class="btn btn-solid">continue shopping</a></div>
        </div>  
        @endif  
	@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
