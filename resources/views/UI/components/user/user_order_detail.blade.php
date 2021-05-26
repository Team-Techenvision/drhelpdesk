@php $page='orders' @endphp
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
               <div class="row" style="overflow-x: scroll;">
            <div class="col-sm-12">
			<div class="table-responsive">
                <table class="table cart-table ">
                    <thead>
                    <tr class="table-head">
                        <th scope="col">product</th>
                        <th scope="col">description</th>
                        <th scope="col">price</th>
                        <th scope="col">detail</th>
                        <th scope="col">status</th>
						
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                                            @$count = 1; 
                                        ?>
                                        @foreach($order as $r)
                                            <?php  
                                                if($r->type == 1 ||$r->type == 2){
                                                  $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',1)->first(); 
                                                  $single_order = DB::table('order_items')->where('order_id',$r->order_id)->first(); 
                                                  $image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
                                                  $product_category = DB::table('products')->where('products.products_id',$r->prod_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->first();   
                                                }elseif($r->type == 3){
                                                  $status = DB::table('order_status')->where('status_value',$r->order_status)->where('type',1)->first(); 
                                                  $image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first();  
                                                }
                                            ?>
                    <tr>
                        <td> <img src="{{asset($image)}}" alt="" height="150" width="180">
                        </td>
                        <td><a href="#"> order no: <span class="dark-data">{{$r->order_id}}</span> <br>{{$single_order->prod_name}}</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" value="{{$r->quantity}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="td-color"><i class="fa fa-inr" aria-hidden="true"></i> @if($product_category->special_price != null) {{$product_category->special_price}} @else {{$product_category->price}} 	@endif </h4></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><i class="fa fa-inr" aria-hidden="true"></i>  <a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h4> @if($product_category->special_price != null) {{$product_category->special_price}} @else {{$product_category->price}} 	@endif   </h4></td>
                        <td>
                        <span>Quntity: {{$r->quantity}}</span>
                            <br>                             
                        </td>
                        <td>
                        {{ucfirst($status->status_name)}} 
                        </td>                      
                    </tr>
                    @endforeach
                    </tbody>
                    <!-- <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/2.jpg" alt=""></a>
                        </td>
                        <td><a href="#">order no: <span class="dark-data">15454841</span> <br>Vega MP-01 Make Up Blender Sponge</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="td-color">₹49.00</h4></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h4>₹49.00</h4></td>
                        <td>
                            <span>Size: L</span>
                            <br>
                            <span>Quntity: 1</span>
                        </td>
                        <td>
                            <div class="responsive-data">
                                <h4 class="price">₹49.00</h4>
                                <span>Size: L</span>|<span>Quntity: 1</span>
                            </div>
                            <span class="dark-data">Delivered</span> (nov 01, 2020)
                        </td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>
                            <a href="#"><img src="../assets/images/product/3.jpg" alt=""></a>
                        </td>
                        <td><a href="#">order no: <span class="dark-data">15454841</span> <br>Lakme Insta Eye Liner</a>
                            <div class="mobile-cart-content row">
                                <div class="col-xs-3">
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="text" name="quantity" class="form-control input-number" value="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <h4 class="td-color">₹130.00</h4></div>
                                <div class="col-xs-3">
                                    <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a></h2></div>
                            </div>
                        </td>
                        <td>
                            <h4>₹130.00</h4></td>
                        <td>
                            <span>Size: L</span>
                            <br>
                            <span>Quntity: 1</span>
                        </td>
                        <td>
                            <div class="responsive-data">
                                <h4 class="price">₹130.00</h4>
                                <span>Size: L</span>|<span>Quntity: 1</span>
                            </div>
                            <span class="dark-data">Delivered</span> (nov 20, 2020)
                        </td>
                    </tr>
                    </tbody> -->
                </table>
            </div>
			</div>
        </div>
        <div class="row cart-buttons">
            <div class="col-12 pull-right"><a href="{{url('/user-order-history')}}" class="btn btn-solid btn-sm">show all orders</a></div>
        </div>
               </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->