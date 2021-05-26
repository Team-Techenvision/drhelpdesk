<!DOCTYPE html>
<html lang="en">


<head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="drhelpdesk">
    <meta name="keywords" content="drhelpdesk">
    <meta name="author" content="drhelpdesk">
    
    <title>drhelpdesk</title> -->

    <!--Google font-->
    

    <!-- Icons -->
      <!-- <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome/css/font-awesome.css"> -->

    <!-- Icons -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/animate.css"> -->

    <!--Slick slider css-->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/slick.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/slick-theme.css"> -->

    <!-- Bootstrap css -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> -->

    <!-- Themify icon -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/themify-icons/themify-icons.css"> -->

    <!-- Theme css -->
    <!-- <link rel="stylesheet" type="text/css" id="color" href="../assets/css/color1.css"> -->

</head>
<body>
    <!-- loader start -->
 <div class="loader-wrapper">
    <div class=" bar">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    </div>
</div>
    <!-- loader end -->


<!-- header part start -->
<header class="header-1">
    <div class="mobile-fix-header">
    </div>
    <div class="container">
        <div class="row header-content">
            <div class="col-lg-3 col-6">
                <div class="left-part">
                    <p>free shipping on order above <i class="fas fa-rupee-sign"></i>999</p>
                </div>
            </div>
            <div class="col-lg-9 col-6">
                <div class="right-part">
                    <ul>
                        <li><a href="#">Monthly deal</a></li>
                        <li><a href="{{url('giftcardlist')}}">Gift cards</a></li>
                        <li><a href="{{url('user-order-history')}}">Track order</a></li>
                        <li><a href="#">free shipping</a></li>
                       	<li><a href="{{url('about-us')}}">About us</a></li>
                        <li><a href="{{url('blog')}}">Blog</a></li>                    
                       
                    </ul>
                </div>
            </div>
        </div>
        <div class="row header-content">
            <div class="col-12">
                <div class="header-section">                  
                    <div class="brand-logo">
                        <a href="{{url('/')}}"> <img src="{{asset('images/icon/logo.png')}}"  alt="logo"></a>
                    </div>
                    <form action="{{url('home-search-data')}}" id="search_frm" method="GET"> 
                    <div class="search-bar">
                        <input class="search__input" type="text" name="homesearch" id="homesearch" placeholder="Search a product">
                        <button class="search-icon" type="submit"></button>                        
                    </div>
                    </form>
                    <div class="nav-icon">
                        <ul>
                         
                            <li class="onhover-div search-3">
                                <div onclick="openSearch()">
                                    <i class="ti-search mobile-icon-search" ></i>
                                    <img src="{{asset('images/icon/l-1/search.png')}}" class=" img-fluid search-img" alt="">
                                </div>
                                <div id="search-overlay" class="search-overlay">
                                    <div>
                                        <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                                        <div class="overlay-content">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <form>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Search a Product">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="onhover-div wishlist-icon" onclick="openWishlist()">
                                <img src="{{asset('images/icon/l-1/wishlist.png')}}" alt=""  class="wishlist-img">
                                <i class="ti-heart mobile-icon"></i>
                                <div class="wishlist icon-detail">
                                <?php  
                                    $wish_counting = DB::table('wishlists')->where('user_id',Auth::id())->count();                                      
                                ?>

                                @if(Auth::check()) 
                                    @if($wish_counting > 0)                                   
                                    <h6 class="up-cls"><span>{{$wish_counting}} item</span></h6>
                                    @else
                                    <h6 class="up-cls"><span>0 item</span></h6>
                                    @endif
                                    @else
                                    <h6 class="up-cls"><span>0 item</span></h6>
                                    @endif                                   
                                    <h6><a href="#">wish list</a></h6>
                                </div>
                            </li>
                            <li class="onhover-div user-icon dropdown" onclick="openAccount()">							
                                <img src="{{asset('images/icon/l-1/user.png')}}" alt="" class="user-img">
                                <i class="ti-user mobile-icon"></i>
								
                                <div class="wishlist icon-detail " >
                                    <h6 class="up-cls " ><span>my account</span></h6>  
                                    @if(Auth::check())  
                                    <?php $user_id =Auth::user()->id; 
                                        // dd($user_id);
                                        $username = DB::table('users')->where('id', $user_id)->first();
                                        // dd($username);
                                    ?>                                 									
                                    <h6 ><a href="#">{{$username->name}}</a></h6>
                                    @else
                                    <h6 ><a href="#">login/sign up</a></h6>
                                    @endif
								 <div class="dropdown-menu">
								  <a class="dropdown-item" href="#">My Profile</a>
								  <a class="dropdown-item " href="#">Address Book</a>
								  <a class="dropdown-item " href="#">My Orders</a>
								   <a class="dropdown-item" href="#">My Wishlist</a>
								  <a class="dropdown-item " href="#">My Prescription</a>
								  <a class="dropdown-item " href="#">Notifications</a>
								   <a class="dropdown-item" href="#">Change Password</a>
								  <a class="dropdown-item " href="#">Log Out</a>
								</div>
                                </div>
								
                            </li>
                            <li class="onhover-div cart-icon" onclick="openCart()">
                                <img src="{{asset('images/icon/l-1/shopping-cart.png')}}" alt="" class="cart-image">
                                <i class="ti-shopping-cart mobile-icon"></i>
                                <div class="cart  icon-detail">
                                <?php  
                                    $session = Session::getId();   
                                    $cart_counting = DB::table('carts')->where('user_id',Auth::id())->count();
                                    $temp_cart_counting = DB::table('temp_carts')->where('session_id',$session)->count();  
                                ?>
                                 @if(Auth::check()) 
                                    @if($cart_counting > 0)
                                    <h6 class="up-cls"><span>{{$cart_counting}} item</span></h6>
                                    @else
                                    <h6 class="up-cls"><span>0 item</span></h6>
                                    @endif
                                    @else
                                     @if($temp_cart_counting > 0)
                                     <h6 class="up-cls"><span>{{$temp_cart_counting}} item</span></h6>
                                     @else
                                    <h6 class="up-cls"><span>0 item</span></h6>
                                    @endif
                                    @endif
                                     

                                    <h6><a href="#">my cart</a></h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
                $medicine = DB::table('categories')->where('categories_id',14)->where('status', 0)->first();
                $lab = DB::table('categories')->where('categories_id',15)->where('status', 0)->first();
                $doctor = DB::table('categories')->where('categories_id',16)->where('status', 0)->first();
                $sexual = DB::table('categories')->where('categories_id',285)->where('status', 0)->first();
                $cosmetic = DB::table('categories')->where('categories_id',1)->where('status', 0)->first();
                $ayurveda = DB::table('categories')->where('categories_id',18)->where('status', 0)->first(); 
                $pers_care = DB::table('categories')->where('categories_id',780)->where('status', 0)->first(); 
            	$mom_baby_care = DB::table('categories')->where('categories_id',24)->where('status', 0)->first();
                //dd($cosmetic);
              ?> 
            
              <?php
                  if($cosmetic != null){
                $sub_cosmetic = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  }if($medicine != null){
                $sub_medicine = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
              }if($lab != null){
                $sub_lab = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
              }if($doctor != null){
                $sub_doctor = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
              }if($sexual != null){
                 $sub_sexual = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                }if($ayurveda != null){
                  $sub_ayurveda = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                }if($pers_care != null){
                  $sub_pers_care = DB::table('categories')->where('parent_id',$pers_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                }if($mom_baby_care != null){
                  $sub_mom_baby_care = DB::table('categories')->where('parent_id',$mom_baby_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first();
                }
                else{}
                  // $sub_sexual = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
				 
        if($cosmetic != null){
                $sub_cosmetic1 = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
        }if($medicine != null){
                $sub_medicine1 = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('sub_category_name', '!=', 'Sexual Wellness')->where('status',0)->orderBy('sub_category_name')->get(); 
                }if($lab != null){
                $sub_lab1 = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
              }if($doctor != null){
                $sub_doctor1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->whereNotIn('categories_id',[438,439])->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
              }if($sexual != null){
                // $sub_sexual1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->whereIn('categories_id',[438,439])->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
                $sub_sexual1 = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
              }if($ayurveda != null){
                $sub_ayurveda1 = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
              }if($pers_care != null){
                $sub_pers_care1 = DB::table('categories')->where('parent_id',$pers_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get();  
              }if($mom_baby_care != null){
                $sub_mom_baby_care1 = DB::table('categories')->where('parent_id',$mom_baby_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get();  
              }
              else{}
             ?> 
    
    <div class="bg-class">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav id="main-nav">
                        <div class="toggle-nav">
                            <i class="ti-menu-alt"></i>
                        </div>
                        <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                            <li>
                                <div class="mobile-back text-right">
                                    Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i>
                                </div>
                            </li>
                            <li class="icon-cls"><a href="{{url('/')}}"><i class="fa fa-home home-icon" aria-hidden="true"></i></a></li>
                            <li><a href="{{url('filter-category/14')}}">Order Medicine</a> 
                                <ul>
                                @if($medicine != null)    
			                        @if(isset($sub_medicine))
                                    @foreach($sub_medicine1 as $r)
                                    <li>                                  
                                    <?php  
                                            $sub1_medicine = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->where('status',0)->get();  
                                        ?>                                    
                                        <a href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>                                                                                
                                        <ul>                                       
                                            <li>
                                            @foreach($sub1_medicine as $r1)
                                            <a href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                            @endforeach
                                            </li>
                                            <!-- <li><a href="#">application</a></li>
                                            <li><a href="#">banner</a></li>
                                            <li><a href="#">category</a></li>
                                            <li><a href="#">collection banner</a></li>     -->
                                                                                                                              
                                        </ul>                           
                                        
                                    </li>
                                    @endforeach
                                @endif
                                @endif
                                    <!-- <li>
                                        <a href="#">Anti-Allergic Drugs</a>
                                       
                                    </li>
									 <li>
                                        <a href="#">Anti-Diabetic Drugs</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">Anti-Emetic</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">Antibiotics</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">Blood Related Drugs</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">Cardiovascular Drugs</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">CNS</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li>
									 <li>
                                        <a href="#">Dermatological Drugs</a>
                                        <ul>
                                            <li><a href="#">product box</a></li>
                                            <li><a href="#">application</a></li>
                                                                                                                              
                                        </ul>
                                    </li> -->
                                </ul>							
                            </li>
                            <!-- <li><a href="{{url('lab-tests')}}">Lab Test</a>							
                                </li> -->
                            
                            <li class="mega"><a href="{{url('filter-category/1')}}">Cosmetics</a>
                                {{-- hide the mega menu for display medicine only  --}}
                            {{-- <li class=""><a href="#" >Cosmetics</a> --}}

							 <ul class="mega-menu feature-menu full-mega-menu" style="display: none;">
                                 @if($cosmetic != null)    
			                        @if(isset($sub_cosmetic)) 
                                    <li>
                                        <div class="container">
                                            <div class="row">
                                            @foreach($sub_cosmetic1 as $r)
                                            <?php  
                                            $sub1_cosmetic = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                            ?>
                                                <div class="col-xl-3 mega-box"  style="display: none;">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset($r->image)}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                @foreach($sub1_cosmetic as $r1)
                                                                    <li><a target="_blank" href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a></li>
                                                                    <!-- <li><a target="_blank" href="#">Eyes</a></li>
                                                                    <li><a target="_blank" href="#">Face</a></li>
                                                                    <li><a target="_blank" href="#">Nails</a></li>
                                                                    <li><a target="_blank" href="#">Makeup Kit</a></li>
                                                                    <li><a target="_blank" href="#">Tools & Brushes</a></li> -->
                                                                @endforeach
																</ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif 
                                                @endif
                                                 <div class="col-xl-3 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Skin</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/cos2.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">Cleanser</a></li>
                                                                    <li><a target="_blank" href="#">Toners</a></li>
                                                                    <li><a target="_blank" href="#">Moisturizer/cream</a></li>
                                                                    <li><a target="_blank" href="#">Mask</a></li>
                                                                    <li><a target="_blank" href="#">Body Care</a></li>
																	 <li><a target="_blank" href="#">Sun Care</a></li>
                                                                    <li><a target="_blank" href="#">Kits and Combos</a></li>
																	  <li><a target="_blank" href="#">Foot /Hand Care</a></li>
																	
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Hair </a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/cos3.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">Hair Styling Tools</a></li>
                                                                    <li><a target="_blank" href="#">Hair Styling</a></li>
                                                                    <li><a target="_blank" href="#">Hair Care</a></li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												 <div class="col-xl-3 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Fragrances</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/cos4.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">Women Fragrances</a></li>
                                                                    <li><a target="_blank" href="#">Men Fragrances</a></li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                               
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            {{-- @if($ayurveda != null)     --}}
			                {{-- @if(isset($sub_ayurveda))  --}}
                             {{-- <li class="mega">
                             <a href="{{url('filter-category/18')}}">Ayurveda</a>   --}}
                             {{-- hide the mega menu for display medicine only  --}}
                            {{-- <li class=""><a href="#" >Ayurveda</a>
                                <ul class="mega-menu feature-menu full-mega-menu" style="display: none;">
                                    <li>
                                        <div class="container">
                                            <div class="row">
                                            @foreach($sub_ayurveda1 as $r)
                                                < ?php  
                                                $sub1_ayurveda = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                                ?>
                                                <div class="col-xl-2 mega-box" style="display: none;">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset($r->image)}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                @foreach($sub1_ayurveda as $r1)
                                                                    <li><a target="_blank" href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a></li>
                                                                    <!-- <li><a target="_blank" href="#">televisions</a></li>
                                                                    <li><a target="_blank" href="#">refrigerator</a></li>
                                                                    <li><a target="_blank" href="#">audio devices</a></li>
                                                                    <li><a target="_blank" href="#">Air Conditioners</a></li>
                                                                    <li><a target="_blank" href="#">laptop & PC</a></li> -->
                                                                @endforeach

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                                @endif


                                                <!-- <div class="col-xl-2 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Weight Control</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/ayur2.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">woman clothes</a></li>
                                                                    <li><a target="_blank" href="#">men clothes</a></li>
                                                                    <li><a target="_blank" href="#">footewear</a></li>
                                                                    <li><a target="_blank" href="#">accessories</a></li>
                                                                    <li><a target="_blank" href="#">watches</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Diabetes Care</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/ayur3.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">beauty</a></li>
                                                                    <li><a target="_blank" href="#">personal care</a></li>
                                                                    <li><a target="_blank" href="#">natural care</a></li>
                                                                    <li><a target="_blank" href="#">men</a></li>
                                                                    <li><a target="_blank" href="#">applience</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												 <div class="col-xl-2 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">General Wellness</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/ayur4.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">beauty</a></li>
                                                                    <li><a target="_blank" href="#">personal care</a></li>
                                                                    <li><a target="_blank" href="#">natural care</a></li>
                                                                    <li><a target="_blank" href="#">men</a></li>
                                                                    <li><a target="_blank" href="#">applience</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												 <div class="col-xl-2 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Sexual Wellness</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/ayur5.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">beauty</a></li>
                                                                    <li><a target="_blank" href="#">personal care</a></li>
                                                                    <li><a target="_blank" href="#">natural care</a></li>
                                                                    <li><a target="_blank" href="#">men</a></li>
                                                                    <li><a target="_blank" href="#">applience</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                               
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                                           
                            </li> --}}
                            <li>
                                <a href="{{url('filter-category/780/783')}}">Women Hygiene</a>
                                {{-- <a href="#">Women Hygiene</a> --}}

                                <?php
                                $sub_pers_care1 = DB::table('categories')->where('parent_id',780)->where('sub_parent_id',783)->where('status',0)->get();
                                // dd($sub_pers_care1);  
                                ?>
                                  <ul style="display: none;">
                                  @foreach($sub_pers_care1 as $row)
                                    <li style="display: block;"><a href="{{url('filter-category/780/783/'.$row->categories_id)}}">{{$row->title}}</a></li>
                                @endforeach
                                </ul>	     
                            </li>
							  <li >
                                <a href="{{url('filter-category/780/784')}}">Men's Grooming</a>
                                {{-- <a href="#">Men's Grooming</a> --}}

                                <?php
                                $sub_pers_care1 = DB::table('categories')->where('parent_id',780)->where('sub_parent_id',784)->where('status',0)->get();  
                                ?>
                                <ul style="display: none;">
                                    @foreach($sub_pers_care1 as $row)
                                        <li style="display: block;"><a href="{{url('filter-category/780/784/'.$row->categories_id)}}">{{$row->title}}</a></li>
                                    @endforeach                                    
                                </ul>	     	     
                            </li>
                            @if($mom_baby_care != null)    
			                @if(isset($sub_mom_baby_care))
                            <li class="mega"><a href="{{url('filter-category/24')}}">Mom & Baby Care</a>
                            {{-- <li class="mega"><a href="#">Mom & Baby Care</a> --}}
                                <ul class="mega-menu feature-menu full-mega-menu" style="display: none;">
                                    <li>
                                        <div class="container">
                                            <div class="row">
                                            @foreach($sub_mom_baby_care1 as $r)
                                                <?php  
                                                $sub1_mom_baby_care = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                                ?>
                                                <div class="col-xl-4 mega-box" style="display: none;">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="{{url('filter-category/'.$mom_baby_care->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset($r->image)}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                @foreach($sub1_mom_baby_care as $r1) 
                                                                    <li><a target="_blank" href="{{url('filter-category/'.$mom_baby_care->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a></li>
                                                                    <!-- <li><a target="_blank" href="#">televisions</a></li>
                                                                    <li><a target="_blank" href="#">refrigerator</a></li>
                                                                    <li><a target="_blank" href="#">audio devices</a></li>
                                                                    <li><a target="_blank" href="#">Air Conditioners</a></li>
                                                                    <li><a target="_blank" href="#">laptop & PC</a></li> -->
                                                                @endforeach
                                                                
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif 
                                                @endif
                                                 <div class="col-xl-4 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Baby Care</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/mom.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">Baby Oil</a></li>
                                                                    <li><a target="_blank" href="#">Baby Powder</a></li>
                                                                    <li><a target="_blank" href="#">Baby Soaps</a></li>
                                                                    <li><a target="_blank" href="#">Cleanser</a></li>
                                                                    <li><a target="_blank" href="#">Diapers</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xl-4 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Baby Toy's</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/toys.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">beauty</a></li>
                                                                    <li><a target="_blank" href="#">personal care</a></li>
                                                                    <li><a target="_blank" href="#">natural care</a></li>
                                                                    <li><a target="_blank" href="#">men</a></li>
                                                                    <li><a target="_blank" href="#">applience</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>  --}}
                                               
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
							 <li class="mega">
                                <a href="{{url('/')}}">Pet Products</a>
								 <ul class="mega-menu feature-menu full-mega-menu">
                                    <li>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-xl-4 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Dog Food</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/pet-1.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">Food</a></li>
                                                                    {{-- <li><a target="_blank" href="#">televisions</a></li>
                                                                    <li><a target="_blank" href="#">refrigerator</a></li>
                                                                    <li><a target="_blank" href="#">audio devices</a></li>
                                                                    <li><a target="_blank" href="#">Air Conditioners</a></li>
                                                                    <li><a target="_blank" href="#">laptop & PC</a></li> --}}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-xl-4 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Pet Medicines</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/pet-2.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">woman clothes</a></li>
                                                                    <li><a target="_blank" href="#">men clothes</a></li>
                                                                    <li><a target="_blank" href="#">footewear</a></li>
                                                                    <li><a target="_blank" href="#">accessories</a></li>
                                                                    <li><a target="_blank" href="#">watches</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 mega-box">
                                                    <div class="link-section">
                                                        <div class="demo">
                                                            <div class="menu-title">
                                                                <h6><a href="#">Pet Accessories</a></h6>
                                                            </div>
                                                            <div class="menu-content">
                                                                <img src="{{asset('images/mega-menu/pet-3.jpg')}}" class="mega-menu-img  img-fluid" alt="">
                                                                <ul>
                                                                    <li><a target="_blank" href="#">beauty</a></li>
                                                                    <li><a target="_blank" href="#">personal care</a></li>
                                                                    <li><a target="_blank" href="#">natural care</a></li>
                                                                    <li><a target="_blank" href="#">men</a></li>
                                                                    <li><a target="_blank" href="#">applience</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                               
                                            </div>
                                        </div>
                                    </li>
                                </ul>
								</li>
							{{-- <li > 
                            < ?php
                            //$save_more_category = DB::table('categories')->where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 
                            $save_more_category = DB::table('brands')->where('status',0)->where('show_brand',1)->get(); 
                            ?>
                                <a href="{{url('/')}}">Shop by Brand</a>
                                <ul>
                                @foreach($save_more_category as $r)
                                    <li style="display: block;"><a href="{{url('product-by-brand/'.$r->id)}}">{{$r->brand_name}}</a></li>
                                    
                                     @endforeach 
								</ul>	     
                            </li> --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header part end -->