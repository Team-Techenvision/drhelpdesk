@extends('main_master') 
	@section('main_content')  
<!-- home slider section start-->

<div class="">
      
    <section class="p-0 full-slider">
        <div class="slide-1 home-slider home-65">
            <?php  
            $banner = DB::table('banners')->where('page_name','homepage')->where('location','slider')->where('show_on','web')->where('status',0)->get();
            //dd($banner);
           
            
          ?> 
           @foreach($banner as $banners)           
            <div>                
                {{-- <a href="{{$banners->banner_link}}"> --}}
                <a href="#">

                    <div class="home text-center p-center">
                        <img src="{{url($banners->image)}}" class="bg-img " alt="">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                <div class="slider-contain">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
</div>
<!-- home slider section end-->
<!-- Category section start -->
<section class="category no-arrow">
    <div class="container">
        <div class="category-6">
            <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/cosmetic.png')}}" alt="">
                    <div class="category-content">
                        <h6>30% off</h6>
                        <h5>Cosmetic &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        <a href="{{url('filter-category/1')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div>
            {{-- <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/sexual.png')}}" alt="">
                    <div class="category-content">
                        <h6>10% off</h6>
                        <h5>Sexual wellness</h5>
                        <a href="{{url('filter-category/285')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div> --}}
            <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/men.png')}}" alt="">
                    <div class="category-content">
                        <h6>30% off</h6>
                        <h5>Men grooming</h5>
                        <a href="{{url('filter-category/780/784')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/women.png')}}" alt="">
                    <div class="category-content">
                        <h6>sale</h6>
                        <h5>Women hygiene</h5>
                        <a href="{{url('filter-category/780/783')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div>
            <!-- <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/lab.png')}}" alt="">
                    <div class="category-content">
                        <h6>50% off</h6>
                        <h5>Lab Test &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        <a href="{{url('filter-category/24')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div> -->
            <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/medicine.png')}}" alt="">
                    <div class="category-content">
                        <h6>20% off</h6>
                        <h5>Medicine &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        <a href="{{url('filter-category/14')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div>
            {{-- <div>
                <div class="category-block">
                    <img src="{{asset('UI/images/category/layout-1/ayurveda.png')}}" alt="">
                    <div class="category-content">
                        <h6>20% off</h6>
                        <h5>Ayurveda &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h5>
                        <a href="{{url('filter-category/18')}}" class="btn btn-solid btn-solid-sm">view more</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- Category section end -->



<!-- banner section start -->
<section class="section-b-space banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="banner-content">
                    <h6>winter sale</h6>
                    <h2>are You getting  <span>weekly deals?</span></h2>
                    <h4>always saving y money</h4>
                    <div class="banner-btn">
                        <h6>use y promo code  <span>save101</span> and getting y deal</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner section start -->


<!-- tab section start -->
<section class="section-b-space tab-layout1 ratio_square">
    <div class="theme-tab">
        <div class="drop-shadow">
            <div class="left-shadow">
                <img src="{{asset('UI/images/left.png')}}" alt="" class=" img-fluid">
            </div>
            <div class="right-shadow">
                <img src="{{asset('UI/images/right.png')}}" alt="" class=" img-fluid">
            </div>
        </div>
        <ul class="tabs">
            <li class="current">
                <a href="tab-1">hot selling</a>
            </li>
            <li class="">
                <a href="tab-2">on sale</a>
            </li>
            <li class="">
                <a href="tab-3">up to 50% off</a>
            </li>
            <li class="">
                <a href="tab4">trending </a>
            </li>
            <li class="">
                <a href="tab-5">new products</a>
            </li>
        </ul>
        <div class="tab-content-cls">
            <div id="tab-1" class="tab-content active default" >
                <div class="container">
                    <div class="row border-row1">
                        @foreach($all_product as $row)
                        <div class="col-lg-2 col-sm-4 col-6 p-0">
                        
                            <div class="product-box" id="tab-4">
                                <div class="img-block">								
                                    <a href="{{url('/product-detail/'.$row->products_id)}}">
                                        {{-- <img src="{{url($row->product_image)}}" class=" img-fluid bg-img" alt="elle"> --}}
                                        <img src="{{asset('UI/images/products/default.jpg')}}" class=" img-fluid bg-img" alt="elle">
                                    </a>
									<a href="#"  ><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share"> Share more-Save more</a>
                                    <div class="cart-details">
                                        @if(Auth::check())
                                        @php 
                                            $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                            $user_id =Auth::user()->id; 
                                            if($result1 == 0){
                                        @endphp   
                                        <a href="{{url('add-wishlist/'.$row->products_id.'/'.$row->id.'/'.$user_id)}}">  <button title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></button></a>
                                        @php 
                                            }
                                        @endphp
                                        @endif
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#quick-view" onclick="fetch_product_details('{{$row->products_id}}')"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                            <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                            
                                    </div>
                                    <?php
                                     $percent = (($row->price - $row->special_price)*100) /$row->price ; 
                                    ?>
                                        @if($row->special_price != null)
                                            @if($percent == null) 
                                            <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    
                                                    </span>
                                            @else
                                                <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    {{ round($percent)}}% off 
                                                </span>
                                            @endif
                                        @endif
                                    </span>
                                    <div class="add-btn">
                                        <a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">quick shop</a>
                                    </div>
                                </div>
                                <form action="{{url('/cart')}}" method="get">
                                <div class="product-info">
                                        <a href="{{url('/product-detail/'.$row->products_id)}}"><h6>{{$row->product_name}}</h6></a>
                                        @if($row->special_price)
                                        <h5>₹{{round($row->special_price,2)}}</h5>
                                        @else
                                        <h5>₹{{round($row->price,2)}}</h5>
                                        @endif
                                </div>
                                <div class="addtocart_box">
                                    <div class="addtocart_detail">
                                        <div>
                                            <!-- <div class="color">
                                                <h5>color</h5>
                                                <ul class="color-variant">
                                                    <li class="light-purple active"></li>
                                                    <li class="theme-blue"></li>
                                                    <li class="theme-color"></li>
                                                </ul>
                                            </div> -->
                                            <!-- <div class="size">
                                                <h5>size</h5>
                                                <ul class="size-box">
                                                    <li class="active">xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div> -->

                                            <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                            <input type="hidden" name="attribute_id" value="{{$row->id}}">
                                            <input type="hidden" name="quantity"  value="1">
                                            <div class="addtocart_btn">
                                             <button type="submit" class="button-a" >Add To cart</button>
                                                <!-- <a   data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
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
                    </div>
                </div>
            </div> 
<!----------------------------------------------------------------->

            <div id="tab-2" class="tab-content" >
                <div class="container">                   
                    <div class="row border-row1"> 
                        @foreach($sale_product as $row)
                        <div class="col-lg-2 col-sm-4 col-6 p-0">
                        
                            <div class="product-box" id="tab-4">
                                <div class="img-block">								
                                    <a href="{{url('/product-detail/'.$row->products_id)}}">
                                        {{-- <img src="{{url($row->product_image)}}" class=" img-fluid bg-img" alt="elle"> --}}
                                        <img src="{{asset('UI/images/products/default.jpg')}}" class=" img-fluid bg-img" alt="elle">
                                    </a>
									<a href="#"  ><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share"> Share more-Save more</a>
                                    <div class="cart-details">
                                        @if(Auth::check())
                                        @php 
                                            $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                            $user_id =Auth::user()->id; 
                                            if($result1 == 0){
                                        @endphp   
                                        <a href="{{url('add-wishlist/'.$row->products_id.'/'.$row->id.'/'.$user_id)}}">  <button title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></button></a>
                                        @php 
                                            }
                                        @endphp
                                        @endif
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#quick-view" onclick="fetch_product_details('{{$row->products_id}}')"  title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                            <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                            
                                    </div>
                                    <?php
                                     $percent = (($row->price - $row->special_price)*100) /$row->price ; 
                                    ?>
                                        @if($row->special_price != null)
                                            @if($percent == null) 
                                            @else
                                                <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    {{ round($percent)}}% off 
                                                </span>
                                            @endif
                                        @endif
                                    </span>
                                    <div class="add-btn">
                                        <a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">quick shop</a>
                                    </div>
                                </div>
                                <form action="{{url('/cart')}}" method="get">
                                <div class="product-info">
                                        <a href="{{url('/product-detail/'.$row->products_id)}}"><h6>{{$row->product_name}}</h6></a>
                                        @if($row->special_price)
                                        <h5>₹{{$row->special_price}}</h5>
                                        @else
                                        <h5>₹{{$row->price}}</h5>
                                        @endif
                                </div>
                                <div class="addtocart_box">
                                    <div class="addtocart_detail">
                                        <div>
                                            <!-- <div class="color">
                                                <h5>color</h5>
                                                <ul class="color-variant">
                                                    <li class="light-purple active"></li>
                                                    <li class="theme-blue"></li>
                                                    <li class="theme-color"></li>
                                                </ul>
                                            </div> -->
                                            <!-- <div class="size">
                                                <h5>size</h5>
                                                <ul class="size-box">
                                                    <li class="active">xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div> -->

                                            <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                            <input type="hidden" name="quantity"  value="1">
                                            <div class="addtocart_btn">
                                             <button type="submit" class="button-a" >Add To cart</button>
                                                <!-- <a   data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
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
                    </div>
                </div>
            </div>
<!----------------------------------------------------------------->
            <div id="tab-3" class="tab-content" >
                <div class="container">
                    <div class="row border-row1">
                        @foreach($off_product as $row)
                        <div class="col-lg-2 col-sm-4 col-6 p-0">                        
                            <div class="product-box" id="tab-4">
                                <div class="img-block">								
                                    <a href="{{url('/product-detail/'.$row->products_id)}}">
                                        {{-- <img src="{{url($row->product_image)}}" class=" img-fluid bg-img" alt="elle"> --}}
                                        <img src="{{asset('UI/images/products/default.jpg')}}" class=" img-fluid bg-img" alt="elle">
                                    </a>
									<a href="#"  ><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share"> Share more-Save more</a>
                                    <div class="cart-details">
                                        @if(Auth::check())
                                        @php 
                                            $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                            $user_id =Auth::user()->id; 
                                            if($result1 == 0){
                                        @endphp   
                                        <a href="{{url('add-wishlist/'.$row->products_id.'/'.$row->id.'/'.$user_id)}}">  <button title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></button></a>
                                        @php 
                                            }
                                        @endphp
                                        @endif
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#quick-view" onclick="fetch_product_details('{{$row->products_id}}')" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                            <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                            
                                    </div>
                                    <?php
                                     $percent = (($row->price - $row->special_price)*100) /$row->price ; 
                                    ?>
                                        @if($row->special_price != null )
                                            @if($percent == null) 
                                            <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    
                                                </span>
                                            @else
                                                <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    {{ round($percent)}}% off 
                                                </span>
                                            @endif
                                        @endif
                                    </span>
                                    <div class="add-btn">
                                        <a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">quick shop</a>
                                    </div>
                                </div>
                                <form action="{{url('/cart')}}" method="get">
                                <div class="product-info">
                                        <a href="{{url('/product-detail/'.$row->products_id)}}"><h6>{{$row->product_name}}</h6></a>
                                        @if($row->special_price)
                                        <h5>₹{{$row->special_price}}</h5>
                                        @else
                                        <h5>₹{{$row->price}}</h5>
                                        @endif
                                </div>
                                <div class="addtocart_box">
                                    <div class="addtocart_detail">
                                        <div>
                                            <!-- <div class="color">
                                                <h5>color</h5>
                                                <ul class="color-variant">
                                                    <li class="light-purple active"></li>
                                                    <li class="theme-blue"></li>
                                                    <li class="theme-color"></li>
                                                </ul>
                                            </div> -->
                                            <!-- <div class="size">
                                                <h5>size</h5>
                                                <ul class="size-box">
                                                    <li class="active">xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div> -->

                                            <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                            <input type="hidden" name="quantity"  value="1">
                                            <div class="addtocart_btn">
                                             <button type="submit" class="button-a" >Add To cart</button>
                                                <!-- <a   data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
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
                    </div>
                </div>
            </div>
<!----------------------------------------------------------------->
            <div id="tab4" class="tab-content" >
                <div class="container">
                    <div class="row border-row1">
                        @foreach($trending_product as $row)
                        <div class="col-lg-2 col-sm-4 col-6 p-0">
                        
                            <div class="product-box" id="tab-4">
                                <div class="img-block">								
                                    <a href="{{url('/product-detail/'.$row->products_id)}}">
                                        {{-- <img src="{{url($row->product_image)}}" class=" img-fluid bg-img" alt="elle"> --}}
                                        <img src="{{asset('UI/images/products/default.jpg')}}" class=" img-fluid bg-img" alt="elle">
                                    </a>
									<a href="#"  ><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share"> Share more-Save more</a>
                                    <div class="cart-details">
                                        @if(Auth::check())
                                        @php 
                                            $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                            $user_id =Auth::user()->id; 
                                            if($result1 == 0){
                                        @endphp   
                                        <a href="{{url('add-wishlist/'.$row->products_id.'/'.$row->id.'/'.$user_id)}}">  <button title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></button></a>
                                        @php 
                                            }
                                        @endphp
                                        @endif
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#quick-view" onclick="fetch_product_details('{{$row->products_id}}')"   title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                            <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                            
                                    </div>
                                    <?php
                                     $percent = (($row->price - $row->special_price)*100) /$row->price ; 
                                    ?>
                                        @if($row->special_price != null)
                                            @if($percent == null) 
                                            @else
                                                <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                    {{ round($percent)}}% off 
                                                </span>
                                            @endif
                                        @endif
                                    </span>
                                    <div class="add-btn">
                                        <a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">quick shop</a>
                                    </div>
                                </div>
                                <form action="{{url('/cart')}}" method="get">
                                <div class="product-info">
                                        <a href="{{url('/product-detail/'.$row->products_id)}}"><h6>{{$row->product_name}}</h6></a>
                                        @if($row->special_price)
                                        <h5>₹{{$row->special_price}}</h5>
                                        @else
                                        <h5>₹{{$row->price}}</h5>
                                        @endif
                                </div>
                                <div class="addtocart_box">
                                    <div class="addtocart_detail">
                                        <div>
                                            <!-- <div class="color">
                                                <h5>color</h5>
                                                <ul class="color-variant">
                                                    <li class="light-purple active"></li>
                                                    <li class="theme-blue"></li>
                                                    <li class="theme-color"></li>
                                                </ul>
                                            </div> -->
                                            <!-- <div class="size">
                                                <h5>size</h5>
                                                <ul class="size-box">
                                                    <li class="active">xs</li>
                                                    <li>s</li>
                                                    <li>m</li>
                                                    <li>l</li>
                                                    <li>xl</li>
                                                </ul>
                                            </div> -->

                                            <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                            <input type="hidden" name="quantity"  value="1">
                                            <div class="addtocart_btn">
                                             <button type="submit" class="button-a" >Add To cart</button>
                                                <!-- <a   data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
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
                    </div>
                </div>
            </div>
<!----------------------------------------------------------------->
            <div id="tab-5" class="tab-content" >
                <div class="container">
                    <div class="row border-row1">
                    @foreach($new_product as $row)
                    <div class="col-lg-2 col-sm-4 col-6 p-0">
                        
                        <div class="product-box" id="tab-4">
                            <div class="img-block">								
                                <a href="{{url('/product-detail/'.$row->products_id)}}">
                                    {{-- <img src="{{url($row->product_image)}}" class=" img-fluid bg-img" alt="elle"> --}}
                                    <img src="{{asset('UI/images/products/default.jpg')}}" class=" img-fluid bg-img" alt="elle">
                                </a>
                                <a href="#"  ><img src="{{asset('UI/images/icon/share.png')}}" class="img-fluid" alt="share"> Share more-Save more</a>
                                <div class="cart-details">
                                    @if(Auth::check())
                                    @php 
                                        $result1=DB::table('wishlists')->where('product_id',$row->products_id)->where('user_id',Auth::user()->id)->count();
                                        $user_id =Auth::user()->id; 
                                        if($result1 == 0){
                                    @endphp   
                                    <a href="{{url('add-wishlist/'.$row->products_id.'/'.$row->id.'/'.$user_id)}}">  <button title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></button></a>
                                    @php 
                                        }
                                    @endphp
                                    @endif
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#quick-view" onclick="fetch_product_details('{{$row->products_id}}')" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                                        <a href="#"  title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                                        
                                </div>
                                <?php
                                 $percent = (($row->price - $row->special_price)*100) /$row->price ; 
                                ?>
                                    @if($row->special_price != null)
                                        @if($percent == null) 
                                        @else
                                            <span class="custom-label custom-label-large custom-label-success arrowed-in text-white pl-1 pr-1" style="background-color: #121943!important;">  
                                                {{ round($percent)}}% off 
                                            </span>
                                        @endif
                                    @endif
                                </span>
                                <div class="add-btn">
                                    <a href="javascript:void(0)" class="btn btn-outline addcart-box" tabindex="0">quick shop</a>
                                </div>
                            </div>
                            <form action="{{url('/cart')}}" method="get">
                            <div class="product-info">
                                    <a href="{{url('/product-detail/'.$row->products_id)}}"><h6>{{$row->product_name}}</h6></a>
                                    @if($row->special_price)
                                    <h5>₹{{$row->special_price}}</h5>
                                    @else
                                    <h5>₹{{$row->price}}</h5>
                                    @endif
                            </div>
                            <div class="addtocart_box">
                                <div class="addtocart_detail">
                                    <div>
                                        <!-- <div class="color">
                                            <h5>color</h5>
                                            <ul class="color-variant">
                                                <li class="light-purple active"></li>
                                                <li class="theme-blue"></li>
                                                <li class="theme-color"></li>
                                            </ul>
                                        </div> -->
                                        <!-- <div class="size">
                                            <h5>size</h5>
                                            <ul class="size-box">
                                                <li class="active">xs</li>
                                                <li>s</li>
                                                <li>m</li>
                                                <li>l</li>
                                                <li>xl</li>
                                            </ul>
                                        </div> -->

                                        <input type="hidden" name="products_id" value="{{$row->products_id}}">
                                        <input type="hidden" name="quantity"  value="1">
                                        <div class="addtocart_btn">
                                         <button type="submit" class="button-a" >Add To cart</button>
                                            <!-- <a   data-toggle="modal" class="closeCartbox" data-target="#addtocart" tabindex="0">add to cart</a> -->
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
                    </div>
                </div>
            </div>
<!----------------------------------------------------------------->
        </div>
    </div>
</section>
<!-- tab section start -->


<!-- feature section start -->
{{-- <section class="upper-part">
    <div class="container">
        <div class="row partition">
            <div class="col-xl-4 col-lg-6 col-md-12">
                <div class="blog-box blog-pattern">
                    <div class="blog-white feature-sec">
                        <h2 class="title">featured offers</h2>

                        <div class="row">
                            @foreach ($top_featured_product as $row)           
                         < ?php $product_m_img = DB::table('product_images')->where('products_id',$row->products_id)->where('type',2)->first(); ?>
                            <div class="col-md-6">
                                <div class="media">
                                    <a href="{{url('/product-detail/'.$row->products_id)}}"><img class="mr-3  img-fluid" src="{{url($product_m_img->product_image)}}"  alt="Product"></a>
                                    <div class="media-body">
                                    <a href="{{url('/product-detail/'.$row->products_id)}}"><h5>{!!substr(strip_tags($row->product_name), 0,15)!!}</h5></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12 order-lg-1 order-xl-0">
                <div class="blog-box blog-pattern">
                    <div class="blog-white review-sec">
                        <h2 class="title">customer reviews</h2>
                        <!-- <div class="slide-1">                    
                            @foreach($testimonial as $row)
                            <div>                                                               
                                <div class="review-block">                                   
                                    <div class="media">
                                        <img class="mr-3" src="{{url($row->image)}}"  alt="Generic placeholder image">
                                        <div class="icon"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                                        <div class="media-body">
                                        <h6>{{ $row->name}}</h6>                                            
                                            {!!substr(strip_tags($row->description), 0,200)!!}
                                        </div>
                                    </div>
                                </div>                               
                            </div> @endforeach
                         
                        </div> -->

                        <div class="slide-1">
                            < ?php $i= 1; ?>
                            @foreach($testimonial as $row)
                        
                            < ?php if($i==1){ ?>
                               
                            <div> 
                                <div class="review-block">                                                                   
                                    <div class="media">
                                        <img class="mr-3" src="{{url($row->image)}}"  alt="User Image">
                                        <div class="icon"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                                        <div class="media-body">
                                        <h6>{{ $row->name}}</h6>                                            
                                            {!!substr(strip_tags($row->description), 0,200)!!}
                                        </div>
                                      
                                    </div>
                                </div>
                            
                            < ?php $i++; } else{ ?>
                            
                                <div class="review-block">                                                        
                                    <div class="media">
                                        <img class="mr-3" src="{{url($row->image)}}"  alt="User Image">
                                        <div class="icon"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
                                        <div class="media-body">
                                        <h6>{{ $row->name}}</h6>                                            
                                            {!!substr(strip_tags($row->description), 0,200)!!}
                                        </div>
                                        
                                    </div>
                                 </div>
                                 </div>
                             < ?php $i=1;}?>                             
                            @endforeach 
                            @if($i > 1)
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-12">
                   <div class="blog-box blog-pattern">
                    <div class="blog-white feature-sec">
                        {{-- <h2 class="title">Sexual Wellness</h2> --}}
                        
                        {{-- <div class="row">
                            @foreach ($sexual_wellness_product as $row)                       
                            < ?php $product_s_img = DB::table('product_images')->where('products_id',$row->products_id)->where('type',2)->first(); ?>
                            <div class="col-md-6">
                                <div class="media">
                                    <a href="{{url('/product-detail/'.$row->products_id)}}"><img class="mr-3  img-fluid" src="{{url($product_s_img->product_image)}}"  alt="Product"></a>
                                    <div class="media-body">
                                    <a href="{{url('/product-detail/'.$row->products_id)}}"><h5>{!!substr(strip_tags($row->product_name), 0,15)!!}</h5></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- feature section end -->




<!-- health package section start -->


{{-- <section class=" section-b-space logo2">
    <div class="container">
        <h2 class="title">Popular health packages</h2>
        <div class="logo-4 border-logo">
            @foreach ($promotional_home_page as $row)           
            <div>
                <div class="logo2-img">
                <a href="{{url($row->banner_link)}}"> 
                     <img src="{{url($row->image)}}" class="img-fluid bg-img" alt="product Ad">                          
                </a>     
                </div>                
            </div>
            @endforeach

            <!-- {{-- <div>
                <div class="logo2-img">
                     <img src="{{asset('images/banner/1.jpg')}}" class=" img-fluid bg-img" alt="">
                </div>
                
            </div>
            <div>
                <div class="logo2-img">
                     <img src="{{asset('images/banner/3a.jpg')}}" class=" img-fluid bg-img" alt="">
                </div>
                
            </div>
            <div>
                <div class="logo2-img">
                    <img src="{{asset('images/banner/2.jpg')}}" class=" img-fluid bg-img" alt="">
                </div>
                
            </div>
            <div>
                <div class="logo2-img">
                     <img src="{{asset('images/banner/3.jpg')}}" class=" img-fluid bg-img" alt="">
                </div>
             
            </div> 
        </div>
    </div>
</section> --}}
<!-- health package section end -->
<!-- detail section start -->
<section class="">
    <div class="container">
        <div class="row partition-3">
            <div class="col-xl-4 col-md-6">
                <div class="blog-box blog-pattern">
                    <div class="blog-white contact">
                        <h5>need help? contact us</h5>
                        <h3>info@drhelpdesk.in</h3>
                        <div class="contact-form">
                            <h5><span>contact us</span></h5>
                            <form class="theme-form" method="post" action="{{route('home-submit-contact-us')}}">
                                <div class="form-group">
                                    <input type="text" name="Name" class="form-control" id="exampleInputEmail1"  placeholder="name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="Number" class="form-control" id="exampleInputEmail2" placeholder="number" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="Email" class="form-control" id="exampleInputEmail2" placeholder="email" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="Message" id="exampleFormControlTextarea1" placeholder="message" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-solid btn-block">send an enquiry</button>
                            </form>

                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12 order-cls">
                <div class="blog-box blog-pattern blog">
                    <div class="blog-white">
                        <h2 class="title"> Blogs</h2>
                        <div class="slide-1">
                            <?php $i=0; ?>
                            @foreach($blog_home as $row)
                            <!-- <div>                                
                                <div class="media">
                                    <a href="#">
                                        <img src="{{url($row->blog_image)}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#">
                                            <h5>{{$row->blog_title}}</h5></a>                                           
                                            <h6>{{ $row->blog_title}}</h6>                                            
                                            <p>{!!substr(strip_tags($row->blog_description), 0,200)!!}</p>                                           
                                        </div>
                                    </div>
                                </div>
                                </div> -->
                                @if($i == 0)
                                    <div>                                
                                    <div class="media">
                                        <a href="{{url('/blog-detail/'.$row->blogs_id)}}">
                                            <img src="{{url($row->blog_image)}}" class=" img-fluid mr-3" alt=""></a>
                                        <div class="media-body blog-info blog-vertical">
                                            <div>
                                                <a href="{{url('/blog-detail/'.$row->blogs_id)}}">
                                                <h5>{{$row->blog_title}}</h5></a>                                           
                                                <h6>{{ $row->blog_title}}</h6>                                            
                                                <p>{!!substr(strip_tags($row->blog_description), 0,200)!!}</p>                                           
                                            </div>
                                        </div>
                                    </div> <?php $i++; ?>
                                @else                                
                                    <div class="media">
                                        <a href="{{url('/blog-detail/'.$row->blogs_id)}}">
                                            <img src="{{url($row->blog_image)}}" class=" img-fluid mr-3" alt=""></a>
                                        <div class="media-body blog-info blog-vertical">
                                            <div>
                                                <a href="{{url('/blog-detail/'.$row->blogs_id)}}">
                                                <h5>{{$row->blog_title}}</h5></a>                                           
                                                <h6>{{ $row->blog_title}}</h6>                                            
                                                <p>{!!substr(strip_tags($row->blog_description), 0,200)!!}</p>                                           
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?> 
                                    @if($i==3)
                                    </div> <?php $i=0; ?>
                                    @endif
                                @endif
                            @endforeach
                                @if($i > 0)
                                </div>
                                @endif
                                <!-- {{-- <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/4.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/5.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/6.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div> 
                                </div>--}} -->
                            
                            <!-- {{-- <div>
                                <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/1.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/2.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media">
                                    <a href="#"><img src="{{asset('UI/images/blog/multi-category/3.jpg')}}" class=" img-fluid mr-3" alt=""></a>
                                    <div class="media-body blog-info blog-vertical">
                                        <div>
                                            <a href="#"><h5>25 nov 2020</h5></a>
                                            <h6>by: admin, 0 comment</h6>
                                            <p>Sometimes on purpose ected hum. dummy text.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}} -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="blog-box blog-pattern">
                    <div class="blog-white app-white">
                        <h5>download the <span>drhelpdesk app</span></h5>
                        <div class="app-buttons">
                            {{-- <a href="#"><img src="{{asset('images/app/app-storw.png')}}" class=" img-fluid" alt=""></a> --}}
                            <a href="#"><img src="{{asset('images/app/play-store.png')}}" class=" img-fluid" alt=""></a>
                        </div>
                        <img src="{{asset('images/app/1.png')}}" class=" img-fluid mobile1" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- detail section end -->


<!-- logo section start -->
<section class=" section-b-space logo">
    <div class="container">
        <h2 class="title">shop by brand</h2>
        <div class="logo-4 border-logo">
            @foreach($brand as $row)
            <div>
            <div class="logo-img">
                <a href="{{url('product-by-brand/'.$row->id)}}">
                    <img src="{{asset('images/logo/1.png')}}" class=" img-fluid" alt="">
                </a> 
            </div>
                <!-- <div class="logo-img">
                    <img src="{{url('$row->image')}}" class=" img-fluid" alt="img 1">
                </div>
                <div class="logo-img">
                    <img src="{{url('$row->image')}}" class=" img-fluid" alt="img 2">
                </div> -->
            </div>
            @endforeach
            <!-- <div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/1.png')}}" class=" img-fluid" alt="">
                </div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/2.png')}}" class=" img-fluid" alt="">
                </div>
            </div>
            <div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/3.png')}}" class=" img-fluid" alt="">
                </div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/4.png')}}" class=" img-fluid" alt="">
                </div>
            </div>
            <div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/5.png')}}" class=" img-fluid" alt="">
                </div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/6.png')}}" class=" img-fluid" alt="">
                </div>
            </div>
            <div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/7.png')}}" class=" img-fluid" alt="">
                </div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/8.png')}}" class=" img-fluid" alt="">
                </div>
            </div>
            <div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/2.png')}}" class=" img-fluid" alt="">
                </div>
                <div class="logo-img">
                    <img src="{{asset('images/logo/3.png')}}" class=" img-fluid" alt="">
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- logo section end -->

@stop 