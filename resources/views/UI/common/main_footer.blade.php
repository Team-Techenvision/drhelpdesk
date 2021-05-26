
<!-- footer section start -->
<footer>
    <div class="subscribe-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="subscribe-content">
                        <h4> <i class="fa fa-envelope-o" aria-hidden="true"></i>newsletter</h4>
                        <p>If you are going to use a passage of Lorem you need. </p>
                        <form class="form-inline subscribe-form">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Email...">
                            </div>
                            <button type="submit" class="btn btn-solid">subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-section">
        <div class="container">
            <div class="row section-t-space section-b-space">
                <div class="col-xl-4 col-lg-4 about-section">
                    <div class="footer-title footer-mobile-title">
                        <h4>about</h4>
                    </div>
                    <div class="footer-content">
                        <div class="footer-logo">
                            <img src="{{asset('images/icon/brand-logo/10.png')}}" alt="">
                        </div>
                        <p>DrHelpDesk is one easily accessible and convenient platform for meeting your Healthcare and Wellness requirements and daily needs. We stand as your Personal Digital Solution to help you procure your Healthcare and wellness – the most prized commodity for humans in a better way. </p>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 footer-link">
                    <div>
                        <div class="footer-title">
                            <h4>my account</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                            <li><a href="{{url('about-us')}}">About us</a></li>
                                <li><a href="{{url('contact-us')}}">Contact us</a></li>
                                <li><a href="{{url('term-conditions')}}">Terms & conditions</a></li>
                                <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('refund-policy')}}">Refund Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 footer-link">
                    <div>
                        <div class="footer-title">
                            <h4>quick link</h4>
                        </div>
                        <div class="footer-content">
                            <ul>
                                <li><a href="#">Share,Buy & Save</a></li>
                                @if(Auth::check()) <!---this run only after login---> 
                                <li><a href="{{url('user-profile')}}">my account</a></li>
                                @endif
                                <li><a href="{{url('user-order-history')}}">order tracking</a></li>
                                <li><a href="{{url('blog')}}">Blog</a></li>
                                <li><a href="{{url('disclaimer')}}">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 ratio_square">
                    <div class="instagram">
                        <div>
                            <div class="instagram-banner">
                                <h5>follow us <span>#drhelpdesk</span></h5>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/1.jpg')}}" alt="1" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/2.jpg')}}" alt="2" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/3.jpg')}}" alt="3" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/4.jpg')}}" alt="4" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/5.jpg')}}" alt="5" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/6.jpg')}}" alt="6" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/7.jpg')}}" alt="7" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/8.jpg')}}" alt="8" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/9.jpg')}}" alt="9" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col p-0">
                                        <a href="#">
                                            <div class="instagram-box">
                                                <div>
                                                    <img src="{{asset('images/beauty/insta/10.jpg')}}" alt="10" class=" img-fluid">
                                                </div>
                                                <div class="overlay">
                                                    <i class="fa fa-instagram"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="call-us">
                        <img src="{{asset('images/call-us.jpg')}}" alt="" class="bg-img bg-left">
                        <div class="footer-banner-content">
                            <div class="call-text">
                                <div>
                                    <h3>call us:</h3>
                                    <span class="call-no">+91-172-4017566<br>
                                         +91-9875937503 <span>(24 X 7)</span></span>
                                </div>
                            </div>
                            <div class="footer-social">
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/drhelpdesks"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <!--<li>
                                        <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    </li>-->
                                    <li>
                                        <a href="https://twitter.com/DrHelpDeskIN"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/drhelpdesk.in/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                    </li>
									 <li>
                                        <a href="https://www.google.com/maps/place/Dr.+HelpDesk+-+Delivering+Health+Digitally/@30.6757716,76.7388284,17z/data=!3m1!4b1!4m5!3m4!1s0x390fed71ecd0cc05:0x9e6ac3da2d4cde09!8m2!3d30.6757716!4d76.7410171"><i class="fa fa-google" aria-hidden="true"></i></a>
                                    </li>
                                   <!-- <li>
                                        <a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a>
                                    </li>-->
                                </ul>
                            </div>
                            <div class="address-section">
                                <h6>address</h6>
                                <p>Unit No - 401 , 4th Floor, <br>Tower - A ,
								Bestech Business Towers ,<br> Mohali, Punjab - 160066</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="footer-bottom">
                        <ul>
                            <li><a href="{{url('filter-category/14')}}">Order Medicine</a></li>
                            <!-- <li><a href="{{url('lab-tests')}}">Lab test</a></li> -->
                            <li><a href="{{url('filter-category/285')}}">Sexual wellness</a></li>
                            <li><a href="{{url('filter-category/1')}}">Cosmetic</a></li>
                            <li><a href="{{url('filter-category/18')}}">Ayurveda</a></li>
                            <li><a href="{{url('filter-category/24')}}">Mom & Baby Care</a></li>
                            <li><a href="{{url('user-order-history')}}">my order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="footer-end">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i>  2020 all rights reserved by drhelpdesk.in</p>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6 col-sm-12">
                    <div class="payment-card-bottom">
                    <ul>
                    <li>
                    <a href="#"><img src="{{asset('images/icon/visa.png')}}./assets/" alt=""></a>
                    </li>
                    <li>
                    <a href="#"><img src="{{asset('images/icon/mastercard.png')}}" alt=""></a>
                    </li>
                    <li>
                    <a href="#"><img src="{{asset('images/icon/paypal.png')}}" alt=""></a>
                    </li>
                    <li>
                    <a href="#"><img src="{{asset('images/icon/american-express.png')}}" alt=""></a>
                    </li>
                    <li>
                    <a href="#"><img src="{{asset('images/icon/discover.png')}}" alt=""></a>
                    </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->


<!--modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal newsletter-popup" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-bg">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div class="offer-content">
                                    <h2>good thing</h2>
                                    <h4>come to those who sign up for our newsleeter</h4>
                                    <form action="https://pixelstrap.us19.list-manage.com/subscribe/post?u=5a128856334b598b395f1fc9b&amp;id=082f74cbda" class="auth-form needs-validation" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank">
                                        <div class="form-group mx-sm-3">
                                            <input type="text" class="form-control" name="EMAIL" id="mce-EMAIL" placeholder="Enter your email" required="required">
                                            <button type="submit" class="btn btn-solid" id="mc-submit">subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal popup end-->


<!-- Add to cart bar -->
<div id="cart_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my cart</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <!--My cart header design start -->

        <?php
          $data1 = [];
          $session = Session::getId();  
          $r = DB::table('temp_carts')->where('session_id',$session)->select('temp_carts_id','product_id','type','quantity','attribute_id')->get(); 
          //dd($r);
          $cart = DB::table('carts')->where('user_id',Auth::id())->select('id','product_id','type','quantity','attribute_id')->get();  
           
          $cart1 = DB::table('carts')->where('user_id',Auth::id())->count();
          $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
          foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
              $data1[]=DB::table('products')->where('product_attributes.id',$r1->attribute_id)
                  ->leftJoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')
                  ->select('products.products_id','product_name' ,'price', 'special_price')
                  ->first(); 
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages') 
                ->where('id',$r1->product_id)
                ->select('id','package_name','package' ,'package_cost', 'offer_discount', 'type' , 'image','special_price') 
                ->first();
            }
            
            $temp_cart_id[$r1->product_id] = $r1->temp_carts_id; 
            $temp_cart_type[$r1->product_id] = $r1->type; 
            $temp_cart_quantity[$r1->product_id] = $r1->quantity; 
          }
           
          //dd($cart);
          
          foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
              $data1[]=DB::table('products')->where('product_attributes.id',$r2->attribute_id)->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->select('products.products_id','product_name' ,'price', 'special_price') 
                  ->first(); 
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages') 
              ->where('packages.id',$r2->product_id)
              ->select('id','package_name','package' ,'package_cost', 'offer_discount', 'type', 'image','special_price')
              ->first();
            }   
            $cart_id[$r2->product_id] = $r2->id; 
            $cart_type[$r2->product_id] = $r2->type; 
            $cart_quantity[$r2->product_id] = $r2->quantity; 
             
          }
           
           
           
           //dd($type);
            if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $temp_id =  $temp_cart_id; 
           $temp_type =  $temp_cart_type;
           $temp_quantity  =  $temp_cart_quantity;
            $result = $data1;   
            //dd($data1);
          }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
              $id =  $cart_id;
              $type = $cart_type;
              $quantity  = $cart_quantity;
              $result = $data1; 
             //dd($data1);
          }else{
            $result='Continue Shopping'; 
          }  
        ?>
        @php 
          $total_amount=0;
        @endphp

        @if(Auth::check()) <!---this run only after login---> 
          @if(is_array($result)) <!---this run only after login cart not empty ---> 
      		<?php $result = array_filter($result);?>
              <!-- {{count($result)}} -->
            <div class="cart_media">
            <ul class="cart_product">
            @php 
                      $total_amount1=0;
                      $total_amount2 =0;
                    @endphp 
                  
                    @foreach($result as $products) 
                        @php
                      $products->products_id = !empty($products->products_id)?$products->products_id:$products->id; 
                      $products->product_name = !empty($products->product_name)?$products->product_name:$products->package_name;
                    //  dd($products->price);
                      $products->price = !empty($products->price)?$products->price:$products->package_cost;
                     $products->special_price = !empty($products->special_price)?$products->special_price:null;
                     @endphp
                      @if($type[$products->products_id] == 1 || $type[$products->products_id] == 2)
                        <?php  
                          $category = DB::table('product_images')->where('type',2)->where('products_id' ,$products->products_id)->pluck('product_image')->first();  
                        ?>  
                <li>
                    <div class="media">
                        <a href="{{url('/product-detail/'.$products->products_id)}}">
                            <img alt="" class="mr-3" src="{{asset($category)}}" height="85" width="85">
                        </a>
                        <div class="media-body">
                            <a href="{{url('/product-detail/'.$products->products_id)}}">
                                <h4>{{$products->product_name}}</h4>
                            </a>
                            <h4>
                                <span>{{$quantity[$products->products_id]}} x <i class="fa fa-inr" aria-hidden="true"></i> 
                                @if(empty($products->special_price))
                                    {{ $products->price }} 
                                  @else
                                    {{ $products->special_price }} 
                                  @endif
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="{{url('/')}}" onclick="removeProduct({{$id[$products->products_id]}})">
                            <i class="ti-trash" aria-hidden="true" ></i>
                        </a>
                    </div>
                </li>

                @if(!empty($products->special_price)) 
                          <?php $total_amount1+=  
                            $products->special_price  * $quantity[$products->products_id];  
                          ?>
                        @else
                          <?php $total_amount1+=  
                          $products->price  * $quantity[$products->products_id];   
                          ?>
                        @endif 
                       
                        
                        
                      @elseif($type[$products->products_id] == 3)
                     @php $discount1 = 0 @endphp
                      @if($products->special_price > 0)
                        @php $products->package_cost = $products->special_price @endphp
                      @endif
                      
                        @if(!empty($products->offer_discount) && $products->offer_discount != null)
                        @php
                          
                          $discount = ($products->offer_discount * $products->package_cost) / 100;
                          $discount1 = $products->package_cost - $discount;
                         
                        @endphp
                        @endif

                        <li>
                    <div class="media">
                        <a href="{{url('/package-detail/'.$products->id)}}">
                            <img alt="" class="mr-3" src="{{asset($products->image)}}">
                        </a>
                        <div class="media-body">
                            <a href="{{url('/package-detail/'.$products->id)}}">
                                <h4>{{$products->package_name}}</h4>
                            </a>
                            <h4>
                                <span>{{$quantity[$products->id]}} x <i class="fa fa-inr" aria-hidden="true"></i> 
                                @if( empty($products->offer_discount))
                                     {{$products->package_cost}} * {{$quantity[$products->id]}}  
                                  @else
                                     {{ $discount1 }} * {{$quantity[$products->id]}} 
                                  @endif
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="{{url('/')}}">
                            <i class="ti-trash" aria-hidden="true" onclick="removeProduct({{$id[$products->id]}})"></i>
                        </a>
                    </div>
                </li>

                @if(!empty($products->offer_discount) && $products->offer_discount != null) 
                          <?php $total_amount1+=  
                            $discount1  * $quantity[$products->id];    
                          ?>
                        @else
                          <?php $total_amount1+=  
                            $products->package_cost  * $quantity[$products->id]; 
                          ?>
                        @endif 
                      @endif 
                    @endforeach 


                <!-- <li>
                    <div class="media">
                        <a href="#">
                            <img alt="" class="mr-3" src="{{asset('UI/images/cosmetic/2.jpg')}}">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                <h4>item name</h4>
                            </a>
                            <h4>
                                <span>1 x <i class="fa fa-inr" aria-hidden="true"></i> 299.00</span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="#">
                            <i class="ti-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="#"><img alt="" class="mr-3" src="{{asset('UI/images/cosmetic/2.jpg')}}"></a>
                        <div class="media-body">
                            <a href="#"><h4>item name</h4></a>
                            <h4><span>1 x <i class="fa fa-inr" aria-hidden="true"></i> 299.00</span></h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="#">
                            <i class="ti-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </li> -->
            </ul>
            <ul class="cart_total">
                <li>
                    <div class="total">
                        <h5>subtotal : <span><i class="fa fa-inr" aria-hidden="true"></i>{{$total_amount1}}</span></h5>
                    </div>
                </li>
                @if(Auth::check())
                <li>
                    <div class="buttons">
                        <a href="{{url('/my-cart')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">view cart</a>
                        <a href="{{url('/checkout')}}" class="btn btn-solid btn-solid-sm btn-block checkout">checkout</a>
                    </div>
                </li>
                @else
                        <a href="{{url('/guest-user')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">Checkout</a>
                @endif 
            </ul>

            @else <!---this run only after login when cart empty --->

            <h5 class="forget-class pl-3"><a href="{{url('/')}}" class="d-block">{{$result}}</a></h5>

            @endif  
           
        </div>



        @else <!---this run only without login time---> 
          @if(is_array($result)) <!---this run only without login temp cart not empty ---> 
          <div class="cart_media">
            <ul class="cart_product">
            @php 
                      $total_amount1=0;
                      $total_amount2 =0;
                    @endphp 
                    @foreach($result as $products) 
                    
                    
                     @php
                      $products->products_id = !empty($products->products_id)?$products->products_id:$products->id; 
                      $products->product_name = !empty($products->product_name)?$products->product_name:$products->package_name;
                     $products->price = !empty($products->price)?$products->price:$products->package_cost;
                     $products->special_price = !empty($products->special_price)?$products->special_price:null;
                     @endphp
                      @if($temp_type[$products->products_id] == 1 || $temp_type[$products->products_id] == 2)
                        <?php  
                          $category = DB::table('product_images')->where('type',2)->where('products_id' ,$products->products_id)->pluck('product_image')->first();  
                        ?>  
                <li>
                    <div class="media">
                        <a href="{{url('/product-detail/'.$products->products_id)}}">
                            <img alt="" class="mr-3" src="{{asset($category)}}">
                        </a>
                        <div class="media-body">
                            <a href="{{url('/product-detail/'.$products->products_id)}}">
                                <h4>{{$products->product_name}}</h4>
                            </a>
                            <h4>
                                <span>{{$temp_quantity[$products->products_id]}} x <i class="fa fa-inr" aria-hidden="true"></i> 
                                @if(empty($products->special_price))
                                    {{ $products->price }} 
                                  @else
                                    {{ $products->special_price }} 
                                  @endif
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="{{url('/')}}">
                            <i class="ti-trash" aria-hidden="true" onclick="removeProduct({{$temp_id[$products->products_id]}})"></i>
                        </a>
                    </div>
                </li>

                @if($products->special_price != null) 
                          <?php $total_amount1+=  
                          $products->special_price  * $temp_quantity[$products->products_id];   
                          ?>
                        @else
                          <?php $total_amount1+=  
                          $products->price  * $temp_quantity[$products->products_id];   
                          ?>
                        @endif 
                      @elseif($temp_type[$products->products_id] == 3)
                  
                       @php $discount1 = 0 @endphp
                      @if($products->special_price > 0)
                        @php $products->package_cost = $products->special_price @endphp
                      @endif
                  
                  
                        @if($products->offer_discount != null)
                        @php
                          
                          $discount = ($products->offer_discount * $products->package_cost) / 100;
                          $discount1 = $products->package_cost - $discount;
                         
                        @endphp
                        @endif

                        <li>
                    <div class="media">
                        <a href="{{url('/package-detail/'.$products->id)}}">
                            <img alt="" class="mr-3" src="{{asset($products->image)}}">
                        </a>
                        <div class="media-body">
                            <a href="{{url('/package-detail/'.$products->id)}}">
                                <h4>{{$products->package_name}}</h4>
                            </a>
                            <h4>
                                <span>{{$temp_quantity[$products->id]}} x <i class="fa fa-inr" aria-hidden="true"></i> 
                                @if( empty($products->offer_discount))
                                     {{$products->package_cost}}  
                                  @else
                                     {{ $discount1 }}  
                                  @endif
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="{{url('/')}}">
                            <i class="ti-trash" aria-hidden="true" onclick="removeProduct({{$temp_quantity[$products->id]}})"></i>
                        </a>
                    </div>
                </li>

                @if($products->offer_discount != null) 
                          <?php $total_amount1+=  
                          $discount1  * $temp_quantity[$products->id];   
                          ?>
                        @else
                          <?php $total_amount1+=  
                          $products->package_cost  * $temp_quantity[$products->id];   
                          ?> 
                        @endif 
                      @endif 
                    @endforeach 


              
            </ul>
            <ul class="cart_total">
                <li>
                    <div class="total">
                        <h5>subtotal : <span><i class="fa fa-inr" aria-hidden="true"></i> {{$total_amount1}}</span></h5>
                    </div>
                </li>
                @if(Auth::check())
                <li>
                    <div class="buttons">
                        <a href="{{url('/my-cart')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">view cart</a>
                        <a href="{{url('/checkout')}}" class="btn btn-solid btn-solid-sm btn-block checkout">checkout</a>
                    </div>
                </li>
                @else
                        <a href="{{url('/guest-user')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">Checkout</a>
                @endif 
            </ul>

            @else <!---this run only after login when cart empty --->

            <h5 class="forget-class pl-3"><a href="{{url('/')}}" class="d-block">{{$result}}</a></h5>

            @endif  
           
        </div>
            @endif
    </div>
</div>
<!-- Add to cart bar end-->


<!-- Add to wishlist bar -->
<div id="wishlist_side" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeWishlist()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my wishlist</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeWishlist()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @if(Auth::check())
        <div class="cart_media">
            <ul class="cart_product">
            @if(Auth::check())
            @php $wishlists=DB::table('wishlists')->where('user_id',Auth::user()->id)->get(); @endphp
            @if($wishlists->count() > 0)                                         
            @foreach($wishlists as  $wishlists)
             @php   $products = DB::table('products')->leftjoin('product_attributes', 'products.products_id', '=', 'product_attributes.products_id')->where('products.products_id' , $wishlists->product_id)->first(); @endphp
             <?php 
			    $category = DB::table('product_images')->where('type',2)->where('products_id' , $products->products_id)->pluck('product_image')->first();  
							
			?>
                <li>
                    <div class="media">
                        <a href="#">
                            <img alt="" class="mr-3" src="{{asset($category)}}" height="85" width="85">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                <h4>item name</h4>
                            </a>
                            <h4>
                                <span> {{ $products->product_name }} </span>
                                <span></span>
                            </h4>
                            <h4>
                                <span>
                                @if($products->special_price == null)
                                    <i class="fa fa-inr" aria-hidden="true"></i></i>{{ $products->price }}
									@else
									<i class="fa fa-inr" aria-hidden="true"></i></i>{{ $products->special_price }} <del> <i class="fa fa-inr" aria-hidden="true"></i>{{$products->price}} </del>
									@endif
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a  onclick="removeWishlist('{{$products->products_id}}')">
                            <i class="ti-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>
                @endforeach
                @else
                    <div class="row cart-buttons">
                        <div class="col-12"><a href="{{url('/')}}" class="btn btn-solid">Your Wishlist Is Empty</a></div>
                    </div>  
                    @endif  
                @endif
                <!-- <li>
                    <div class="media">
                        <a href="#">
                            <img alt="" class="mr-3" src="../assets/images/cosmetic/2.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                <h4>item name</h4>
                            </a>
                            <h4>
                                <span>sm</span>
                                <span>, blue</span>
                            </h4>
                            <h4>
                                <span><i class="fa fa-inr" aria-hidden="true"></i> 299.00</span>
                            </h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="#">
                            <i class="ti-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="#"><img alt="" class="mr-3" src="../assets/images/cosmetic/3.jpg"></a>
                        <div class="media-body">
                            <a href="#"><h4>item name</h4></a>
                            <h4>
                                <span>sm</span>
                                <span>, blue</span>
                            </h4>
                            <h4><span><i class="fa fa-inr" aria-hidden="true"></i> 299.00</span></h4>
                        </div>
                    </div>
                    <div class="close-circle">
                        <a href="#">
                            <i class="ti-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                </li> -->
            </ul>
            <ul class="cart_total">
                <li>
                    <div class="total">
                        <!-- <h5>subtotal : <span><i class="fa fa-inr" aria-hidden="true"></i>299.00</span></h5> -->
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <a href="{{url('my-wishlist')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">view Wishlist</a>
                    </div>
                </li>
            </ul>
        </div>
        @endif

        @if(!Auth::check())
        <ul class="cart_total text-center">
                <li>
                    <div class="buttons">
                        <a href="{{url('/')}}" class="btn btn-solid btn-block btn-solid-sm view-cart">Login To Add Wishlist </a>
                    </div>
                </li>
            </ul>
        @endif
    </div>
</div>
<!-- Add to wishlist bar end-->


<!-- My account bar -->
<div id="myAccount" class="add_to_cart right">
    <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my account</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeAccount()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        @if(Auth::check())

        <h5 class="forget-class pl-3"><a href="{{url('/user-profile')}}" class="d-block">My Profile</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/user-address')}}" class="d-block">Address Book</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/user-order-history')}}
        " class="d-block">My Orders</a></h5>       
        <h5 class="forget-class pl-3"><a href="{{url('/my-wishlist')}}" class="d-block">My Wishlist</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/my-prescription')}}" class="d-block">My Prescription</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/my-notification')}}" class="d-block">Notifications</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/user-change-password')}}" class="d-block">Change Password</a></h5>
        <h5 class="forget-class pl-3"><a href="{{url('/logout')}}" class="d-block">Log Out</a></h5>
        
        @else
        <form class="theme-form" name="login_form" method="POST" action="{{ url('user-login') }}">
            <div class="form-group">

                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="phn_or_email" required="">
            </div>
            <div class="form-group">
                <label for="review">Password</label>
                <input type="password" class="form-control" id="review" placeholder="Enter your password" name="password" required="">
            </div>
            <button type="submit" class="btn btn-solid btn-solid-sm btn-block">Login</button>
            <h5 class="forget-class"><a href="{{ url('forget-password') }}" class="d-block">forget password?</a></h5>
            <h5 class="forget-class"><a href="{{ url('registration') }}" class="d-block">new to store? Signup now</a></h5>
        </form>
        @endif
    </div>
</div>
<!-- Add to wishlist bar end-->


<!-- Add to cart modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal cart-modal" id="addtocart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body modal1">
                <div class="container-fluid p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="modal-bg addtocart">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="media">
                                    <a href="#">
                                        <img class="img-fluid  pro-img" src="../assets/images/cosmetic/4.jpg" alt="">
                                    </a>
                                    <div class="media-body align-self-center text-center">
                                        <a href="#">
                                            <h6>
                                                <i class="fa fa-check"></i>Item
                                                <span>men full sleeves</span>
                                                <span> successfully added to your Cart -</span>
                                                <span>blue,</span>
                                                <span>XS</span>
                                            </h6>
                                        </a>
                                        <div class="buttons">
                                            <a href="#" class="view-cart btn btn-solid">Your cart</a>
                                            <a href="#" class="checkout btn btn-solid">Check out</a>
                                            <a href="#" data-dismiss="modal" class="continue btn btn-solid">Continue shopping</a>
                                        </div>

                                        <div class="upsell_payment">
                                            <img src="../assets/images/payment_cart.png" class="img-fluid " alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="product-section">
                                    <div class="col-12 product-upsell text-center">
                                        <h4>Customers who bought this item also.</h4>
                                    </div>
                                    <div class="row" id="upsell_product">
                                        <div class="product-box col-sm-3 col-6">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html">
                                                        <img src="../assets/images/cosmetic/1.jpg" class="img-fluid  mb-1" alt="cotton top">
                                                    </a>
                                                </div>
                                                <div class="product-detail">
                                                    <h6><a href="#"><span>cotton top</span></a></h6>
                                                    <h4><span><i class="fa fa-inr" aria-hidden="true"></i>25</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-box col-sm-3 col-6">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html">
                                                        <img src="../assets/images/cosmetic/6.jpg" class="img-fluid  mb-1" alt="cotton top">
                                                    </a>
                                                </div>
                                                <div class="product-detail">
                                                    <h6><a href="#"><span>cotton top</span></a></h6>
                                                    <h4><span><i class="fa fa-inr" aria-hidden="true"></i>25</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-box col-sm-3 col-6">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html">
                                                        <img src="../assets/images/cosmetic/13.jpg" class="img-fluid  mb-1" alt="cotton top">
                                                    </a>
                                                </div>
                                                <div class="product-detail">
                                                    <h6><a href="#"><span>cotton top</span></a></h6>
                                                    <h4><span><i class="fa fa-inr" aria-hidden="true"></i>25</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-box col-sm-3 col-6">
                                            <div class="img-wrapper">
                                                <div class="front">
                                                    <a href="product-page.html#">
                                                        <img src="../assets/images/cosmetic/19.jpg" class="img-fluid  mb-1" alt="cotton top">
                                                    </a>
                                                </div>
                                                <div class="product-detail">
                                                    <h6><a href="#"><span>cotton top</span></a></h6>
                                                    <h4><span><i class="fa fa-inr" aria-hidden="true"></i>25</span></h4>
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
<!-- Add to cart modal popup end-->


<!-- Quick-view modal popup start-->
<div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content quick-view-modal">
            <div class="modal-body">
                <form action="{{url('/cart')}}" method="get">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <div class="row">
                    <div class="col-lg-6 col-xs-12">
                        <div class="quick-view-img"><img id="model_image" src="" alt="" class="img-fluid "></div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <h2 id="model_product_title"></h2>
                            <h3><i class="fa fa-inr" aria-hidden="true"></i> <span id="model_product_price"></span> </h3>
                            <div class="border-product">
                                <h6 class="product-title">product details:</h6>
                                <p id="model_product_description" class="m-3"></p>
                            </div>
                            <div class="product-description border-product">
                                <!-- <h6 class="product-title">color:</h6>
                                <ul class="color-variant">
                                    <li class="light-purple active"></li>
                                    <li class="theme-blue"></li>
                                    <li class="theme-color"></li>
                                </ul>
                                <h6 class="product-title">size:</h6>
                                <div class="size-box">
                                    <ul class="size-box">
                                        <li class="active">xs</li>
                                        <li>s</li>
                                        <li>m</li>
                                        <li>l</li>
                                        <li>xl</li>
                                    </ul>
                                </div> -->
                                <h6 class="product-title">quantity:</h6>
                                <div class="qty-box">
                                    <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                                        <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span></div>
                                </div>
                            </div>
                            <div class="product-buttons">
                            <input type="hidden" name="products_id" id="model_product_id" value="">  
                            <input type="hidden" name="attribute_id" id="model_attribute_id" value="">
                                <button type="submit" class="btn btn-solid bg-gradient">add to cart</button>
                                <!-- <a href="product-page.html" class="btn btn-solid bg-gradient">view detail</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Quick-view modal popup end-->


<!-- tap to top -->
<div class="tap-top">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top End -->








</body>


</html>
