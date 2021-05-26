@extends('main_master') 
	@section('main_content')   
<!-- breadcrumb start -->
<section class="breadcrumb-section section-b-space" style="padding-bottom:0px !important">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
               <ol class="bread breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                              
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- breadcrumb End -->
<!-- section start -->
<section class="section-b-space ratio_square">
   <div class="collection-wrapper">
      <div class="container">
         <div class="row">
            <div class="col-sm-3 collection-filter">
            
               <!-- side-bar colleps block stat -->
               <div class="collection-filter-block">
                  <!-- brand filter start -->                 
                  <form action="{{url('home-search-data')}}" method="post">
                    @csrf           
                     <input type="hidden" name="homesearch" value="{{$form_search}}">
                     <input type="hidden" name="minpr" id="minpr" />

					<input type="hidden" name="maxpr" id="maxpr" />
                
                    @php 
					$brand1 = DB::table('brands')->where('status',0)->orderBy('brand_name', 'asc')->get(); 
					
                    @endphp
                  <!-- brand filter start -->
                  <div class="collection-collapse-block open">
                     <h3 class="collapse-block-title">brand</h3>
                     <div class="collection-collapse-block-content">
                        <div class="collection-brand-filter">
                        <?php   $i=0;  ?>
                        @foreach($brand1 as $r1) 
                        
                              @php 
                            $total_brand = DB::table('products')->where('brand',$r1->id)->get(); 
                              @endphp 
                              @if(!empty($brand2))
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input" name="brand[]" value="{{$r1->id}}" id="check_<?php echo $i; ?>" {{in_array($r1->id,$brand)?'checked':''}}>
                              <label class="custom-control-label" for="check_<?php echo $i; ?>"> {{$r1->brand_name}} </label>
                           </div>                           
                           @endif
                           <?php $i++; ?>
                                @endforeach 
                                
                           <!-- <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input" id="vera-moda">
                              <label class="custom-control-label" for="vera-moda">vera-moda</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input" id="forever-21">
                              <label class="custom-control-label" for="forever-21">forever-21</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input" id="roadster">
                              <label class="custom-control-label" for="roadster">roadster</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="checkbox" class="custom-control-input" id="only">
                              <label class="custom-control-label" for="only">only</label>
                           </div> -->
                        </div>
                     </div>
                  </div>
                  <!-- color filter start here -->
                  <!-- <div class="collection-collapse-block open">
                     <h3 class="collapse-block-title">colors</h3>
                     <div class="collection-collapse-block-content">
                        <div class="color-selector">
                           <ul>
                              <li class="color-1 active"></li>
                              <li class="color-2"></li>
                              <li class="color-3"></li>
                              <li class="color-4"></li>
                              <li class="color-5"></li>
                              <li class="color-6"></li>
                              <li class="color-7"></li>
                           </ul>
                        </div>
                     </div>
                  </div> -->
                  <!-- price filter start here -->
                  
                  <div class="collection-collapse-block border-0 open">
                     <h3 class="collapse-block-title">price</h3>
                     
                     <div class="collection-collapse-block-content">
                        <div class="collection-brand-filter">   
                                            
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="radio" class="custom-control-input" id="hundred" name="price" value="1" >
                              <label class="custom-control-label" for="hundred"> <i class="fa fa-inr" aria-hidden="true"></i>10 -  <i class="fa fa-inr" aria-hidden="true"></i>100</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="radio" class="custom-control-input" id="twohundred" name="price" value="2" >
                              <label class="custom-control-label" for="twohundred"> <i class="fa fa-inr" aria-hidden="true"></i>100 -  <i class="fa fa-inr" aria-hidden="true"></i>200</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="radio" class="custom-control-input" id="threehundred" name="price" value="3">
                              <label class="custom-control-label" for="threehundred"> <i class="fa fa-inr" aria-hidden="true"></i>200 -  <i class="fa fa-inr" aria-hidden="true"></i>300</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="radio" class="custom-control-input" id="fourhundred" name="price" value="4">
                              <label class="custom-control-label" for="fourhundred"> <i class="fa fa-inr" aria-hidden="true"></i>300 -  <i class="fa fa-inr" aria-hidden="true"></i>400</label>
                           </div>
                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                              <input type="radio" class="custom-control-input" id="fourhundredabove" name="price" value="5">
                              <label class="custom-control-label" for="fourhundredabove"> <i class="fa fa-inr" aria-hidden="true"></i>400 above</label>
                           </div>

                           <button type="submit" class="btn btn-primary btn-sm">Filter</button>

                           <button class="btn btn-secondary btn-sm" type="reset" value="reset" >Reset</button>

                        </div>
                     </div>
                  </div>
               </div>
             
               <!-- silde-bar colleps block end here -->
               <!-- side-bar single product slider start -->
               <div class="theme-card">
                  <h5 class="title-border">related product</h5>
                  <div class="offer-slider slide-1">

                  <?php $i=0; ?>
                     @foreach($data['product'] as $row)
                     <?php 
                           $product_img = DB::table('product_images')->where('products_id',$row->products_id)->where('type',2)->first(); 
                     ?>
                        @if($i==0)
                        <div>                   
                        <div class="media">
                           <a href="{{url('/product-detail/'.$row->products_id)}}"><img class="img-fluid " src="{{url($product_img->product_image)}}" alt="product"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>{{$row->product_name}}</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>
                              @if($row->special_price)                              
                              {{$row->special_price}}
                              @else
                                 {{$row->price}}
                              @endif
                              </h4>
                           </div>
                        </div> <?php $i++; ?> 
                      @else
                      <div class="media">
                           <a href="{{url('/product-detail/'.$row->products_id)}}"><img class="img-fluid " src="{{url($product_img->product_image)}}" alt="product"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>{{$row->product_name}}</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>
                              @if($row->special_price)                              
                              {{$row->special_price}}
                              @else
                                 {{$row->price}}
                              @endif
                              </h4>
                           </div>
                        </div><?php $i++;?>  
                        @if($i == 3)
                           <?php $i=0; ?>
                           </div>
                        @endif
                     @endif                    
                     @endforeach
                     <?php if($i > 0){?> </div> <?php } ?>

                          <!-- <div>
                      <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/2.jpg')}}" alt="lip2"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Wet n Wild MegaLast Liquid Catsuit Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>343.00</h4>
                           </div>
                        </div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/3.jpg')}}" alt="lip3"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Swiss Beauty Pure Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>299.00</h4>
                           </div>
                        </div> 
                        </div>-->
                     <!-- <div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/1.jpg')}}" alt="lip1"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Swiss Beauty Gel Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>149.00</h4>
                           </div>
                        </div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/2.jpg')}}" alt="lip2"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Wet n Wild MegaLast Liquid Catsuit Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>343.00</h4>
                           </div>
                        </div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/3.jpg')}}" alt="lip3"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Swiss Beauty Pure Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>299.00</h4>
                           </div>
                        </div>
                     </div> -->

                     <!-- <div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/4.jpg')}}" alt="lip4"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Maybelline New York Sensational Liquid Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>349.00</h4>
                           </div>
                        </div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/5.jpg')}}" alt="lip5"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Lakme Enrich Matte Lipstick  </h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>242.00</h4>
                           </div>
                        </div>
                        <div class="media">
                           <a href="#"><img class="img-fluid " src="{{asset('UI/images/product/sub-category/6.jpg')}}" alt="lip6"></a>
                           <div class="media-body align-self-center">
                              <a href="product-page(no-sidebar).html">
                                 <h6>Elle 18 Color Pops Matte Lipstick</h6>
                              </a>
                              <h4> <i class="fa fa-inr" aria-hidden="true"></i>100.00</h4>
                           </div>
                        </div>
                     </div> -->
                  </div>
               </div>
               <!-- side-bar single product slider end -->
            </div>
            <div class="collection-content col">
               <div class="page-main-content">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="collection-product-wrapper">
                           <div class="product-top-filter">
                              <div class="row">
                                 <div class="col-xl-12">
                                    <div class="filter-main-btn"><span class="filter-btn btn btn-solid btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span></div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12">
                                    <div class="product-filter-content">
                                       <div class="search-count">
                                          <h5>Showing {{($data['product']->currentpage()-1)*$data['product']->perpage()+1}} – {{$data['product']->currentpage()*$data['product']->perpage()}} of {{$data['product']->total()}}</h5>
                                       </div>
                                       <div class="collection-view">
                                          <ul>
                                             <li><i class="fa fa-th grid-layout-view"></i></li>
                                             <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                          </ul>
                                       </div>
                                       <div class="collection-grid-view">
                                          <ul>
                                             <li>
                                                <a href="javascript:void(0)" class="product-2-layout-view">
                                                   <ul class="filter-select">
                                                      <li></li>
                                                      <li></li>
                                                   </ul>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:void(0)" class="product-3-layout-view">
                                                   <ul class="filter-select">
                                                      <li></li>
                                                      <li></li>
                                                      <li></li>
                                                   </ul>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="javascript:void(0)" class="product-4-layout-view">
                                                   <ul class="filter-select">
                                                      <li></li>
                                                      <li></li>
                                                      <li></li>
                                                      <li></li>
                                                   </ul>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                       <div class="product-page-per-view">
                                          <select>
                                             <option value="High to low">24 Products Per Page</option>
                                             <option value="Low to High">50 Products Per Page</option>
                                             <option value="Low to High">100 Products Per Page</option>
                                          </select>
                                       </div>
                                       <div class="product-page-filter">
                                          <select id="view-option-sort" name="price_sort">
                                             <option value="">Sorting by</option>
                                             <option value="0" {{$sortP == 'asc'? 'selected':''}}>Low - High</option>
                                             <option value="1" {{$sortP == 'desc'? 'selected':''}}>High - Low</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           </form>
                           <div class="product-wrapper-grid">
                              <div class="row">
                              @foreach($data['product'] as $row)
                                 <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                       <!-- product->products_id -->
                                       <?php 
                                       $product_img = DB::table('product_images')->where('products_id',$row->products_id)->where('type',2)->first(); 
                                       ?>
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="{{url('/product-detail/'.$row->products_id)}}"><img src="{{url($product_img->product_image)}}" class=" img-fluid bg-img" alt="lip1"></a>
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             @if(Auth::id())
                                                @php 
                                                $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                                $user_id =Auth::user()->id; 
                                                if($result1 == 0){
                                             @endphp   
                                              <a href="{{url('add-wishlist/'.$row->products_id.'/'.$user_id)}}" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                              @php } else{ @endphp
                                                <a href="{{url('add-wishlist/'.$row->products_id.'/'.$user_id)}}" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                                @php } @endphp 	@endif
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                    
                                       <div class="product-info">
                                          <div>
                                             <a href="{{url('/product-detail/'.$row->products_id)}}" >
                                                <h6>{{$row->product_name}}</h6>
                                             </a>
                                             <p>The brand for every teenage girl who wants to have fun and look good at the same time is here. The brand new range of matte lipsticks from the elle 18 range is here.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp; 
                                                @if($row->special_price)
                                                <i class="fa fa-inr" aria-hidden="true"></i>{{$row->special_price}}
                                                @else
                                                <i class="fa fa-inr" aria-hidden="true"></i>{{$row->price}}
                                                @endif
                                             </h5>
                                             <h5>
                                             <h5>
                                                Earn 10 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <form action="{{url('/cart')}}" method="get">
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <!-- <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul> -->
                                                </div>
                                                <div class="size">
                                                   <!-- <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul> -->
                                                </div>
                                                <div class="addtocart_btn">
                                                   <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                                   <input type="hidden" name="quantity" class="form-control input-number" value="1"> 
                                                   <button type="submit" name="add_to_card" class="btn btn-solid">Add To Cart</button>                                                  
                                                   <!-- <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                       </form>
                                    </div>
                                 </div>
                              @endforeach

                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/2.jpg')}}" class=" img-fluid bg-img" alt="lip2"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                               <h6>Vega MP-01 Make Up Blender Sponge</h6>
                                             </a>
                                             <p>When you dye your hair, using the right brush is as important as choosing the right mehendi. For all those women looking for the perfect brush to apply your hair dye, this Vega could be your apt choice.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-inr" aria-hidden="true"></i>40.00
                                             </h5>
                                             <h5>
                                                Earn 4 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/3.jpg')}}" class=" img-fluid bg-img" alt="lip3"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                           <div>
                                             <a href="#">
                                                <h6>Lakme Insta Eye Liner</h6>
                                             </a>
                                             <p>This eyeliner is endowed with a water-resistant formula that also makes it last longer. The deep intense color of this Lakmé Insta Liner accentuates your eye makeup and adds a dash of dramatic beauty and glamour to them.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>130.00
                                             </h5>
                                             <h5>
                                                Earn 13<img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/4.jpg')}}" class=" img-fluid bg-img" alt="lip4"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Swiss Beauty Eyebrow Pencil </h6>
                                             </a>
                                             <p>Define your brows with Swiss Beauty Eyebrow Pencil - an ultra-slim pencil that is ideal for outlining and detailing your brows. It gives you natural-looking coverage for fuller arches.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>49.00
                                             </h5>
                                             <h5>
                                                Earn 4 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/5.jpg')}}" class=" img-fluid bg-img" alt="lip5"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Lakme Enrich Matte Lipstick  </h6>
                                             </a>
                                             <p>
                                                Get sensuous and beautiful lips every day with this Lakme Enrich Matte lipstick. This long-lasting lipstick contains Vitamin E that nourishes your lips, and makes them soft and supple. It also has olive extracts that hydrate your lips and prevent dryness.
                                             </p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>242.00
                                             </h5>
                                             <h5>
                                                Earn 24 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/6.jpg')}}" class=" img-fluid bg-img" alt="lip6"></a>
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Elle 18 Color Pops Matte Lipstick</h6>
                                             </a>
                                             <p>The brand for every teenage girl who wants to have fun and look good at the same time is here. The brand new range of matte lipsticks from the elle 18 range is here. Matte is in trend and we have the range to keep you trending. </p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-inr" aria-hidden="true"></i>100.00
                                             </h5>
                                             <h5>
                                                Earn 10 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/7.jpg')}}" class=" img-fluid bg-img" alt="lip7"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Schwarzkopf Professional OSiS+ Dust It - Mattifying Powder </h6>
                                             </a>
                                             <p>The Schwarzkopf OSiS Dust It adds life to dull and boring hair Kill routine- feel the difference and get natural looking hair with a cool- matt finish from OSiS Dust It Mattifying Powder</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>750.00
                                             </h5>
                                             <h5>
                                                Earn 69 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/8.jpg')}}" class=" img-fluid bg-img" alt="lip8"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">                                         
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Swiss Beauty Makeup Brushes - Pink</h6>
                                             </a>
                                             <p>Introducing Swiss Beauty 5 Sticks Makeup Brush Set. Made with imported high-quality materials and soft, tightly packed bristles it delivers exceptional blend-ability and precision.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>299.00
                                             </h5>
                                             <h5>
                                                Earn 65 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/9.jpg')}}" class=" img-fluid bg-img" alt="lip9"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Revlon Super Lustrous Leather Collection Lipstick </h6>
                                             </a>
                                             <p>Revlon Super Lustrous Lipstick is as essential as the little black dress. With 82 fabulous, fashionable shades, Revlon Super Lustrous Lipstick offers the widest range of colors, so you are sure to find one that looks gorgeous on you! Packed with mega-moisturizers and vitamins C and E for soft, smooth, sexy lips.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>699.00
                                             </h5>
                                             <h5>
                                                Earn 69 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="{{asset('UI/images/product/category/1.jpg')}}" class=" img-fluid bg-img" alt="lip10"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Elle 18 Color Pops Matte Lipstick</h6>
                                             </a>
                                             <p>The brand for every teenage girl who wants to have fun and look good at the same time is here. The brand new range of matte lipsticks from the elle 18 range is here.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-inr" aria-hidden="true"></i>100.00
                                             </h5>
                                             <h5>
                                             <h5>
                                                Earn 10 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/2.jpg" class=" img-fluid bg-img" alt="lip10"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                           <div>
                                             <a href="#">
                                               <h6>Vega MP-01 Make Up Blender Sponge</h6>
                                             </a>
                                             <p>When you dye your hair, using the right brush is as important as choosing the right mehendi. For all those women looking for the perfect brush to apply your hair dye, this Vega could be your apt choice.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;  <i class="fa fa-inr" aria-hidden="true"></i>40.00
                                             </h5>
                                             <h5>
                                                Earn 4 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/3.jpg" class=" img-fluid bg-img" alt="lip12"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Lakme Insta Eye Liner</h6>
                                             </a>
                                             <p>This eyeliner is endowed with a water-resistant formula that also makes it last longer. The deep intense color of this Lakmé Insta Liner accentuates your eye makeup and adds a dash of dramatic beauty and glamour to them.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>130.00
                                             </h5>
                                             <h5>
                                                Earn 13<img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/4.jpg" class=" img-fluid bg-img" alt="lip9"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                           <div>
                                             <a href="#">
                                                <h6>Swiss Beauty Eyebrow Pencil </h6>
                                             </a>
                                             <p>Define your brows with Swiss Beauty Eyebrow Pencil - an ultra-slim pencil that is ideal for outlining and detailing your brows. It gives you natural-looking coverage for fuller arches.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>49.00
                                             </h5>
                                             <h5>
                                                Earn 4 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/5.jpg" class=" img-fluid bg-img" alt="lip9"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Revlon Super Lustrous Leather Collection Lipstick </h6>
                                             </a>
                                             <p>Revlon Super Lustrous Lipstick is as essential as the little black dress. With 82 fabulous, fashionable shades, Revlon Super Lustrous Lipstick offers the widest range of colors, so you are sure to find one that looks gorgeous on you! Packed with mega-moisturizers and vitamins C and E for soft, smooth, sexy lips.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>699.00
                                             </h5>
                                             <h5>
                                                Earn 69 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/6.jpg" class=" img-fluid bg-img" alt="lip9"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Revlon Super Lustrous Leather Collection Lipstick </h6>
                                             </a>
                                             <p>Revlon Super Lustrous Lipstick is as essential as the little black dress. With 82 fabulous, fashionable shades, Revlon Super Lustrous Lipstick offers the widest range of colors, so you are sure to find one that looks gorgeous on you! Packed with mega-moisturizers and vitamins C and E for soft, smooth, sexy lips.</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>699.00
                                             </h5>
                                             <h5>
                                                Earn 69 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <!-- <div class="col-xl-3 col-md-4 col-6 col-grid-box">
                                    <div class="product-box">
                                       <div class="img-block">
                                          <a href="#"><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share">&nbsp;Share more- Save more</a>
                                          <a href="#"><img src="../assets/images/product/category/7.jpg" class=" img-fluid bg-img" alt="lip9"></a>
                                          <img src="{{asset('UI/images/product/d-verified.png')}}" width="75px"  alt="d-coins">
                                          <div class="cart-details">
                                             <button tabindex="0" class="addcart-box" title="Quick shop"><i class="ti-shopping-cart" ></i></button>
                                             <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>
                                             <a href="#" data-toggle="modal" data-target="#quick-view"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                             <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                          </div>
                                       </div>
                                       <div class="product-info">
                                          <div>
                                             <a href="#">
                                                <h6>Schwarzkopf Professional OSiS+ Dust It - Mattifying Powder </h6>
                                             </a>
                                             <p>The Schwarzkopf OSiS Dust It adds life to dull and boring hair Kill routine- feel the difference and get natural looking hair with a cool- matt finish from OSiS Dust It Mattifying Powder</p>
                                             <h5>
                                                <span>4.3*</span>
                                                <p class="p-txt">(43)reviews</p>
                                                &nbsp;&nbsp;&nbsp;&nbsp;   <i class="fa fa-inr" aria-hidden="true"></i>750.00
                                             </h5>
                                             <h5>
                                                Earn 69 <img src="{{asset('UI/images/product/coins.png')}}" width="25px" height="25px" alt="d-coins">
                                             </h5>
                                          </div>
                                       </div>
                                       <div class="addtocart_box">
                                          <div class="addtocart_detail">
                                             <div>
                                                <div class="color">
                                                   <h5>color</h5>
                                                   <ul class="color-variant">
                                                      <li class="light-purple active"></li>
                                                      <li class="theme-blue"></li>
                                                      <li class="theme-color"></li>
                                                   </ul>
                                                </div>
                                                <div class="size">
                                                   <h5>size</h5>
                                                   <ul class="size-box">
                                                      <li class="active">xs</li>
                                                      <li>s</li>
                                                      <li>m</li>
                                                      <li>l</li>
                                                      <li>xl</li>
                                                   </ul>
                                                </div>
                                                <div class="addtocart_btn">
                                                   <a href="javascript:void(0)"  data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="close-cart">
                                             <i class="fa fa-times" aria-hidden="true"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                           <div class="product-pagination mb-2">
                              <div class="theme-paggination-block">
                                 <div class="row">
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                       <nav aria-label="Page navigation">
                                          <ul class="pagination">
                                             <!-- <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span> <span class="sr-only">Previous</span></a></li>
                                             <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                             <li class="page-item"><a class="page-link" href="#">2</a></li>
                                             <li class="page-item"><a class="page-link" href="#">3</a></li>
                                             <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> <span class="sr-only">Next</span></a></li> -->
                                             {{ $data['product']->appends($data['page'])->links() }}
                                          </ul>
                                       </nav>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                       <div class="product-search-count-bottom">
                                          <h5>Showing {{($data['product']->currentpage()-1)*$data['product']->perpage()+1}} – {{$data['product']->currentpage()*$data['product']->perpage()}} of {{$data['product']->total()}}</h5>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- section End -->

@stop 