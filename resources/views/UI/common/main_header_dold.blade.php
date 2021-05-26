<style>
  .error{
    color:red;
  }

  .block-features__item-icon i {
    font-size: 45px;
    color: #121943;
  }
  .logo__image img{
    width: 125px;
  }
	#searchlocationmobile {
	width: 100%;
	/* padding: 15px 22px; */
	text-align: left;
	background-color: #fff;
	margin-top: 10px;
	padding: 16px;
}
  .downoad-app ._3G8YN {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    width: 130px;
    margin-right: 10px;
    height: 40px;
    border: none;
    background-color: #006d82;
    opacity: .95;
    border-radius: 5px;
    font-size: 12px;
    font-weight: 500;
    color: #fff;
    padding: 10px 15px;
  }
  .downoad-app ._19UrT {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-top: 10px;
  }
  .downoad-app h2{
    margin-top: 15px;
    font-size: 15px;
  }
   
			.sup-txt {    top: -10px;
			color: #f7f7f7;
			font-size: 10px;
			text-decoration: blink;
			font-weight: 500;
			background-color: #cb1818;
			position: absolute;
			padding: 10px;
			border-radius: 15px 0px;}
			
			@keyframes blink{
		0%{opacity: 0;}
		50%{opacity: .5;}
		100%{opacity: 1;}
		}

</style>

<header class="site__mobile-header">

  <div class="mobile-header">

    <div class="container">

      <div class="mobile-header__body">

        <button class="mobile-header__menu-button" type="button">

          <svg width="18px" height="14px">

            <path d="M-0,8L-0,6L18,6L18,8L-0,8ZM-0,-0L18,-0L18,2L-0,2L-0,-0ZM14,14L-0,14L-0,12L14,12L14,14Z" />

          </svg>

        </button>

        <a class="mobile-header__logo" href="{{url('/')}}">

          <!-- mobile-logo -->

          <img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid">

          <!-- mobile-logo / end -->

        </a>

        <div class="mobile-header__search mobile-search">

				<!--           <form class="mobile-search__body">

            <input type="text" class="mobile-search__input" placeholder="Search Product, labs  testing ...."> 

            <button type="submit" class="mobile-search__button mobile-search__button--search">

              <i class="fa fa-search"></i>

            </button>

            <button type="button" class="mobile-search__button mobile-search__button--close">

              <i class="fas fa-times"></i>

            </button>

            <div class="mobile-search__field"></div>

          </form> -->
        	 <form action="{{url('home-search-data')}}"  id="search_frm" method="GET" class="mobile-search__body" autocomplete="off"> 
				<span class="location-search-mobile" onclick="myFunction()"><span class="icon-map-marker" style="line-height: 48px;"></span>{{Session::get('set_location_name')}}</span>
            <input class="mobile-search__input typeahead" type="text" name="homesearch" id="homesearch" placeholder="Search Product, labs  testing...."> 

            <button type="submit" class="mobile-search__button mobile-search__button--search">

              <i class="fa fa-search"></i>

            </button>

            <button type="button" class="mobile-search__button mobile-search__button--close">

              <i class="fas fa-times"></i>

            </button>

            <div class="mobile-search__field"></div>

         </form> 

        </div>

        <div class="mobile-header__indicators">

          <div class="mobile-indicator mobile-indicator--search d-md-none">

            <button type="button" class="mobile-indicator__button"><span class="mobile-indicator__icon"><i class="fa fa-search"></i></span>

            </button>

          </div>

          <div class="mobile-indicator d-none d-md-block"><a href="#" class="mobile-indicator__button"><span class="mobile-indicator__icon"><i class="icon-user-lock"></i></span></a>

          </div>

          

          <?php  
            $session = Session::getId();   
            $cart_counting = DB::table('carts')->where('user_id',Auth::id())->count();
            $temp_cart_counting = DB::table('temp_carts')->where('session_id',$session)->count();  
          ?>
          @if(Auth::check()) 
            @if($cart_counting > 0)
            <div class="mobile-indicator"><a href="{{url('/my-cart')}}" class="mobile-indicator__button"><span class="mobile-indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="34px" height="34px" style="padding-top: 0px; padding-bottom: 5px;
            "><span class="mobile-indicator__counter">{{$cart_counting}}</span></span></a> 
            </div>
            @else
            <div class="mobile-indicator"><a href="{{url('/my-cart')}}" class="mobile-indicator__button"><span class="mobile-indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="34px" height="34px" style="padding-top: 0px; padding-bottom: 5px;
            "><span class="mobile-indicator__counter">0</span></span></a> 
            </div>
            @endif
          @else
            @if($temp_cart_counting > 0)
            <div class="mobile-indicator"><a href="{{url('/my-cart')}}" class="mobile-indicator__button"><span class="mobile-indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="34px" height="34px" style="padding-top: 0px; padding-bottom: 5px;
            "><span class="mobile-indicator__counter">{{$temp_cart_counting}}</span></span></a> 
            </div>
            @else
            <div class="mobile-indicator"><a href="{{url('/my-cart')}}" class="mobile-indicator__button"><span class="mobile-indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="34px" height="34px" style="padding-top: 0px; padding-bottom: 5px;
            "><span class="mobile-indicator__counter">0</span></span></a> 
            </div>
            @endif
          @endif

        </div>

      </div>

    </div>

  </div>

</header>
<?php
  $city_name = DB::table('cities')->orderBy('city_name')->get();
?>
<div id="searchlocationmobile" style="display:none;">
    <p>Select a location to find out our services</p>
    <select id="deliveryLocaion"  name="deliveryLocaion"  class="js-example-placeholder-single js-states form-control">
      <option>Select a Location...</option>
      @foreach($city_name as $r2) 
        <option value="{{str_replace('"','',$r2->city_name)}}" {{strtolower(Session::get('set_location_name'))==strtolower(str_replace('"','',$r2->city_name)) ?"selected":"" }}>{{str_replace('"','',$r2->city_name)}}</option>  
      @endforeach 
    </select>
    <button type="button" id="current_loction" class="btn btn-primary btn-sm" data-to-panel="form" style="margin-top: 5px;">Current Location</button> 
</div>

<!-- site__mobile-header / end -->

<!-- site__header -->
  <?php
    $header1 = DB::table('header_contents')->where('id',1)->first();
  ?>
  <header class="site__header">
	@if(Session::get('location_name')!='no_location')
    @if(Session::get('location_name')!= 'notfound')
    @if(Session::get('location_name')=='Chandigarh')
    <div style="background-color:#1d99b6; color:white;"><marquee>{{$header1->content}}</marquee></div>
    @else
    <div style="background-color:#1d99b6; color:white;"><marquee>{{$header1->content}}</marquee></div>
    @endif
    @endif
    @endif
    <div class="header">

      <div class="header__megamenu-area megamenu-area"></div> 
      <div class="header__topbar-classic-bg hbg1"></div> 
      <div class="header__topbar-classic">

        <div class="topbar topbar--classic"> 
          <div class="topbar__item-text"><a class="topbar__link " href="{{url('/about-us')}}"><i class="fa fa-id-card-o" aria-hidden="true"></i> About Us</a> 
          </div>

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/contact-us')}}"><i class="fa fa-map-marker" aria-hidden="true"></i> Contact Us</a> 
          </div>

          @if(Auth::check())
          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/user-order-history')}}"><i class="fa fa-truck" aria-hidden="true"></i> Track Order</a>
          </div>
          @else 
          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/login-user')}}"><i class="fa fa-truck" aria-hidden="true"></i> Track Order</a>
          </div>
          @endif

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/blog')}}"><i class="fa fa-rss" aria-hidden="true"></i> Blog</a></div>
<!--           <div class="topbar__item-text"><a class="topbar__link" href="{{url('upload-prescription/1')}}"><i class="fa fa-file-text" aria-hidden="true"></i> Upload Prescription</a></div> -->
        	 @if(Auth::check())
          <div class="topbar__item-text"><a class="topbar__link" href="{{url('upload-prescription/1')}}"><i class="fa fa-file-text" aria-hidden="true"></i> Upload Prescription</a></div>
          @else 
          <div class="topbar__item-text"><a class="topbar__link" href="{{url('login-user')}}"><i class="fa fa-file-text" aria-hidden="true"></i> Upload Prescription</a></div>
          @endif


          <div class="topbar__item-spring"></div> 
          @if(Session::get('location_name')!='no_location')
            @if(Session::get('location_name')!= 'notfound')
              @if(Session::get('location_name')=='Chandigarh')
                <span style="color:#052ade;margin-top:1px;" id="rs_phoneno1"><img src="{{asset('UI/images/logo/same.png')}}">Same Day Delivery<!--Your Order Will Be deliver in 60 Min to 90 Min..!--></span>
              @else
               <span style="color:#052ade;margin-top:1px;" id="rs_phoneno1"><img src="{{asset('UI/images/logo/same.png')}}">Same Day Delivery<!--Your Order Will Be deliver in 60 Min to 90 Min..!--></span>
              @endif
            @else
              <span style="color:#052ade;margin-top:1px;" id="rs_phoneno1"><!--Your Order Will Be deliver in 24 to 48 hours..!--><img src="https://webrobotapps.com/wp-content/uploads/2018/07/delivery-aplicativos.png" width="32px" height="32px" style="padding-top: 0px; padding-bottom: 5px;
                ">Guaranteed Delivery</span>
            @endif
          @else
            <span style="color:red;margin-top:8px;" id="rs_phoneno1"></span>
          @endif 
          @if(Auth::check())
            @php
              $wallet = DB::table('de_wallets')->where('user_id',Auth::id())->first();
            @endphp 
            @if($wallet != null)
              <div class="topbar__menu">
              <a href="{{url('/user-order-history')}}">
                <button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button"><span class="topbar__button-label"><img src="{{asset('UI/images/logo/coins.png')}}" width="32px" height="32px" style="padding-top: 0px; padding-bottom: 5px;
                "></span>  <span class="topbar__button-title" style="color:red;"><!-- <i class="fas fa-rupee-sign"></i>  -->{{($wallet->coin > 0) ? $wallet->coin :'0' }}  </span> 
              </button> </a>
              </div>  
            @else
                <div class="topbar__menu">
                  <button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button"><span class="topbar__button-label"><img src="{{asset('UI/images/logo/coins.png')}}" width="32px" height="32px" style="padding-top: 0px; padding-bottom: 5px;
                "></span>  <span class="topbar__button-title"  style="color:red;"><!-- <i class="fas fa-rupee-sign"></i>  -->0  </span> 
                  </button> 
                </div>  
            @endif
          @else
            <div class="topbar__menu">
              <button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button"><span class="topbar__button-label"><img src="{{asset('UI/images/logo/coins.png')}}" width="32px" height="32px" style="padding-top: 0px; padding-bottom: 5px;
                "></span>  <span class="topbar__button-title"  style="color:red;"><!-- <i class="fas fa-rupee-sign"></i>  -->0 </span> 
              </button> 
            </div>  
          @endif 
        </div> 
      </div>
      <div class="header__navbar">
        <div class="header__navbar-departments">
          <div class="departments">
            <button class="departments__button" type="button"><span class="departments__button-icon"><i class="fas fa-sort-amount-down"></i> </span><span class="departments__button-title">Save More!! Care More!!</span>  <span class="departments__button-arrow"><i class="fas fa-angle-down"></i></span>
            </button>
            <div class="departments__menu">
              <div class="departments__arrow"></div>
              <div class="departments__body">
              	<?php
                  //$save_more_category = DB::table('categories')->where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 
                  $save_more_category = DB::table('brands')->where('status',0)->where('show_brand',1)->get(); 
                ?>
                <ul class="departments__list">
                  <li class="departments__list-padding" role="presentation"></li>
                  @foreach($save_more_category as $r)
                  <li class="departments__item">
                    <a href="{{url('product-by-brand/'.$r->id)}}" class="departments__item-link d-flex">
                      <img src="{{asset($r->image)}}" alt="">
                      <span class="d-block">{{$r->brand_name}}
                         
                      </span>                       
                    </a>
                  </li>
                  @endforeach 
                  <li class="departments__list-padding" role="presentation"></li>
                </ul>
				 
                <div class="departments__menu-container"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="header__navbar-menu">
          <div class="main-menu">
            <ul class="main-menu__list">
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
          @if($medicine != null)    
			  @if(isset($sub_medicine))
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$medicine->categories_id)}}" class="main-menu__link">{{$medicine->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_medicine1 as $r)
                            <?php  
                              $sub1_medicine = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->where('status',0)->get();  
                           ?>                         
                          <div class="col-2">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_medicine as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li> 
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$medicine->categories_id)}}" class="main-menu__link">{{$medicine->category_name}} </a>
                  
                </li>
              @endif   
            

<!--              <li class="main-menu__item"><a href="{{url('coming-soon')}}"  class="main-menu__link"><sup class="sup-txt">Coming Soon</sup>{{$medicine->category_name}}</a>
                  
              </li>  -->
              @endif

              @if($lab != null)    
			  @if(isset($sub_lab))           
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('lab-tests')}}" class="main-menu__link">{{$lab->category_name}} </a>
                  <!-- <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_lab1 as $r)
                            <?php  
                              $sub1_lab = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-2">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('lab-tests')}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_lab as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$lab->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li> 
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>-->
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('lab-tests')}}" class="main-menu__link">{{$lab->category_name}} </a>
                  
                </li>
              @endif 
              @endif



              @if($sexual != null)    
			  @if(isset($sub_sexual))                                                                              
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$sexual->categories_id)}}" class="main-menu__link">{{$sexual->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_sexual1 as $r)
                            <?php  
                              $sub1_sexual = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-4">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_sexual as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li> 
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$sexual->categories_id)}}" class="main-menu__link">{{$sexual->category_name}} </a>
                  
                </li>
              @endif 
              @endif

              @if($cosmetic != null)    
			  @if(isset($sub_cosmetic))             
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$cosmetic->categories_id)}}" class="main-menu__link">{{$cosmetic->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_cosmetic1 as $r)
                            <?php  
                              $sub1_cosmetic = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-3">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_cosmetic as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li>
                              
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$cosmetic->categories_id)}}" class="main-menu__link">{{$cosmetic->category_name}} </a>
                  
                </li>
              @endif 
              @endif

              @if($ayurveda != null)    
			  @if(isset($sub_ayurveda)) 
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$ayurveda->categories_id)}}" class="main-menu__link">{{$ayurveda->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_ayurveda1 as $r)
                            <?php  
                              $sub1_ayurveda = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-2">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_ayurveda as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li> 
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$ayurveda->categories_id)}}" class="main-menu__link"> {{$ayurveda->category_name}} </a>
                  
                </li>
              @endif  
              @endif


              @if($pers_care != null)    
			  @if(isset($sub_pers_care))              
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$pers_care->categories_id)}}" class="main-menu__link">{{$pers_care->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_pers_care1 as $r)
                            <?php  
                              $sub1_pers_care = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-6">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$pers_care->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_pers_care as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$pers_care->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li> 
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$pers_care->categories_id)}}" class="main-menu__link">{{$pers_care->category_name}} </a>
                  
                </li>
              @endif  
              @endif

              @if($mom_baby_care != null)    
			  @if(isset($sub_mom_baby_care))
            
                <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$mom_baby_care->categories_id)}}" class="main-menu__link">{{$mom_baby_care->category_name}} <i class="fas fa-angle-down"></i></a>
                  <div class="main-menu__submenu">
                    <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                      <div class="megamenu">
                        <div class="row">
                          @foreach($sub_mom_baby_care1 as $r)
                            <?php  
                              $sub1_mom_baby_care = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                            ?>
                          <div class="col-4">
                            <ul class="megamenu__links megamenu-links megamenu-links--root">
                              <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$mom_baby_care->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                <ul class="megamenu-links">
                                  @foreach($sub1_mom_baby_care as $r1) 
                                    <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$mom_baby_care->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                    </li> 
                                  @endforeach 
                                </ul>
                              </li>
                              
                            </ul>
                          </div> 
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                </li> 
              @else
                <li class="main-menu__item"><a href="{{url('filter-category/'.$mom_baby_care->categories_id)}}" class="main-menu__link">{{$mom_baby_care->category_name}} </a>
                  
                </li>
              @endif 
              @endif
            </ul>
          </div>
        </div>
		<!--         <div class="header__navbar-phone phone">
          <a href="tel:98759 37503" class="phone__body">
            <div class="phone__title"><img src="{{asset('UI/images/logo/call.png')}}" width="30px" height="30px" style="padding-top: 0px; padding-bottom: 5px;"></div>
            <div class="phone__number">+91-98759 37503</div>
          </a>
        </div> -->
      </div>
      <div class="header__logo">
        <a href="{{url('/')}}" class="logo">
          <div class="logo__image">
            <!-- logo -->
            <img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk" class="img-fluid">
            <!-- logo / end -->
          </div>
        </a>
      </div> 
      <div class="header__search">
        <div class="search"> 
          <form action="{{url('home-search-data')}}"  id="search_frm" method="GET" class="search__body" autocomplete="off">
            <div class="search__shadow"></div> 
            <input class="search__input typeahead" type="text" name="homesearch" id="homesearch" placeholder="Search Product, labs  testing...."> 
            <button class="search__button search__button--start" type="button"><span class="search__button-icon"><span class="icon-map-marker"></span></span><span id="demo" class="search__button-title">{{Session::get('set_location_name')}}</span> 
            </button> 
            <button class="search__button search__button--end" id="search_btn" type="submit"><span class="search__button-icon"><span class="fa fa-search"></span></span> 
            </button> 
            <div class="search__box"></div> 
            <div class="search__decor"> 
              <div class="search__decor-start"></div> 
              <div class="search__decor-end"></div> 
            </div>
          </form> 
          <form action="#" class="search__body">
            <div class="search__dropdown search__dropdown--vehicle-picker vehicle-picker"> 
              <div class="search__dropdown-arrow"></div> 
              <div class="vehicle-picker__panel vehicle-picker__panel--list vehicle-picker__panel--active" data-panel="list"> 
                <div class="vehicle-picker__panel-body"> 
                  <div class="vehicle-picker__text">Select a location to find out our services</div>
                  <?php
                  $cities = DB::table('cities')->orderBy('city_name')->get();
                  ?>
                  <div class="location-list">
                    <select id="deliveryLocaion"  name="deliveryLocaion" class="form-control form-control-select2">
                      <option>Select a Location...</option>
                      @foreach($cities as $r) 
                      <option value="{{str_replace('"','',$r->city_name)}}" {{strtolower(Session::get('set_location_name'))==strtolower(str_replace('"','',$r->city_name)) ?"selected":"" }}>{{str_replace('"','',$r->city_name)}}</option>  
                      @endforeach 
                    </select>
                  </div> 
                  <div class="vehicle-picker__actions"> 
                    <button type="button" id="current_loction" class="btn btn-primary btn-sm" data-to-panel="form">Current Location</button> 
                  </div>

                </div>

              </div>



            </div> 
          </form> 
        </div> 
      </div> 
      <div class="header__indicators"> 

        @if(Auth::check())
            <?php 
                $image1 = DB::table('user_details')->where('user_id',Auth::user()->id)->pluck('image')->first(); 
                // dd($image1);
            ?>
          <?php if (!empty($image1) && $image1!= null) { ?>
              <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset($image1)}}" alt="" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;"></span> </span><span class="indicator__title">Hello, {{Auth::user()->name}}</span> <span class="indicator__value">My Account</span></a> 
    <?php } else {( !empty($image1) && $image1== null)?>
      <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/user.png')}}" alt="" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;"></span> </span><span class="indicator__title">Hello, {{Auth::user()->name}}</span> <span class="indicator__value">My Account</span></a> 
  <?php  } ?>
      @else
          <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/user.png')}}" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;
                "> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">Login</span></a> 
        @endif 
          <div class="indicator__content"> 
            <div class="account-menu"> 

              @if(session('msg2') != null)

                <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                  {{session('msg2')}}

                </div>

              @endif

              @if(Auth::check() == null)

                <form name="login_form" method="POST" action="{{ url('user-login') }}" role="form"  class="account-menu__form" enctype="multipart/form-data">

                  @csrf

                  <div class="account-menu__form-title">Log In to Your Account</div>

                  <div class="form-group">

                    <label for="header-signin-email" class="sr-only">Email address</label>

                    <input id="header-signin-email" type="text" name="phn_or_email" class="form-control @error('phn_or_email') is-invalid @enderror form-control-sm" placeholder="Email Id or Contact Number" name="password" required autocomplete="current-password"> 

                    @error('phn_or_email')

                        <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>

                        </span>

                    @enderror

                  </div>

                  <div class="form-group">

                    <label for="header-signin-password" class="sr-only">Password</label>

                    <div class="account-menu__form-forgot">

                      <input id="header-signin-password" type="password" class="form-control @error('password') is-invalid @enderror form-control-sm" placeholder="Password" name="password" required autocomplete="current-password"> <a href="{{url('/forget-password')}}" class="account-menu__form-forgot-link">Forgot?</a>

                      @error('password')

                          <span class="invalid-feedback" role="alert">

                              <strong>{{ $message }}</strong>

                          </span>

                      @enderror

                    </div>
                  </div>
                    <div class="form-group">
                
                        <!--<select required="required" class="form-control form-control-sm" name="user_type">
                  <option value="">Select Type</option>
                  <option  value="2">User</option>
                  <option  value="3">Doctor</option> 
                </select>-->
                    <input type="hidden" name="user_type" value="2">
               
              </div>

                  <div class="form-group account-menu__form-button">

                    <button type="submit" class="btn btn-primary btn-sm">Login</button>

                  </div>

                  <div class="account-menu__form-link"><a href="{{url('/registration')}}">Create An Account</a>


                  <div class="footer-newsletter__social-links social-links">
                    <ul class="social-links__list">
                    <li class="social-links__item social-links__item--facebook"><a href="{{ url('/auth/redirect/facebook') }}" ><i class="fab fa-facebook-f text-white"></i></a>
                    </li>
                    <li class="social-links__item social-links__item--facebook"><a href="{{ url('/auth/redirect/google') }}" ><i class="fab fa-google text-white"></i></a>
                    </li>
                  </ul>
                  </div>
                  </div>

                </form> 

              @elseif(Auth::check())

                <?php

                  $image = DB::table('user_details')->where('user_id',Auth::user()->id)->pluck('image')->first();

                ?>

                <div class="account-menu__divider"></div>

                <a href="{{url('/')}}" class="account-menu__user">

                  <div class="account-menu__user-avatar">

<!--                     <img src="{{asset($image)}}" alt=""> -->
                  
                  <?php if (!empty($image) && $image != null) { ?>
                    <img src="{{asset($image)}}" alt=""> 
                      <?php } else {( !empty($image) && $image == null)?>
                        <img src="{{asset('UI/images/logo/user.png')}}" alt=""> 
                    <?php  } ?>

                  </div>

                  <div class="account-menu__user-info">

                    <div class="account-menu__user-name">{{Auth::user()->name}}</div>

                    <div class="account-menu__user-email">{{Auth::user()->email}}</div>

                  </div>

                </a>

                <div class="account-menu__divider"></div>

               @if(Auth::user()->user_type == 2)
                <ul class="account-menu__links">

                  <li><a href="{{url('/user-dashboard')}}">Dashboard</a>

                  </li>

                  <li><a href="{{url('/user-profile')}}">My Profile</a>

                  </li>

                  <li><a href="{{url('/user-booking')}}">Lab test/Health packages</a>

                  </li>

                  <li><a href="{{url('/user-order-history')}}">Order History</a>

                  </li>

                  <li><a href="{{url('/user-address')}}">My Address</a>

                  </li>
                  <li><a href="{{url('/my-wishlist')}}">My Wishlist</a>

                  </li>

                  <li><a href="{{url('/my-prescription')}}">My Prescription</a>

                  </li>

                  <!-- <li><a href="{{url('/')}}">My Packages</a>

                  </li> -->

                </ul>
                @elseif(Auth::user()->user_type == 3)
                    <ul class="account-menu__links">

                        <li><a href="{{url('/doctor-dashboard')}}">Dashboard</a>
    
                        </li>
    
                        <li><a href="{{url('/doctor-profile-setting')}}">My Profile</a>
    
                        </li>
    
                        <li><a href="{{url('/doctor-change-password')}}">Change Password</a>
    
                        </li> 
    
                        <!-- <li><a href="{{url('/')}}">My Packages</a>
    
                        </li> -->

                    </ul>
                @endif

                <div class="account-menu__divider"></div>

                <ul class="account-menu__links">

                  <li> 

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();

                      document.getElementById('logout-form').submit();">

                       Logout 

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                      {{ csrf_field() }}

                    </form>

                  </li>

                </ul> 

              @endif 
            </div>

          </div>

        </div>
        <?php
          $data1 = [];
          $session = Session::getId();  
          $r = DB::table('temp_carts')->where('session_id',$session)->select('temp_carts_id','product_id','type','quantity')->get(); 
          //dd($r);
          $cart = DB::table('carts')->where('user_id',Auth::id())->select('id','product_id','type','quantity')->get();  
           
          $cart1 = DB::table('carts')->where('user_id',Auth::id())->count();
          $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
          foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
              $data1[]=DB::table('products')->where('products_id',$r1->product_id) 
                  ->select('products_id','product_name' ,'price', 'special_price')
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
              $data1[]=DB::table('products')->where('products_id',$r2->product_id)->select('products_id','product_name' ,'price', 'special_price') 
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
            $result='Please Choose To Continue Shopping'; 
          }  
        ?>
        @php 
          $total_amount=0;
        @endphp  
      
        @if(Auth::check()) <!---this run only after login---> 
          @if(is_array($result)) <!---this run only after login cart not empty ---> 
      		<?php $result = array_filter($result);?>
            <div class="indicator indicator--trigger--click"><a href="#" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;
                ">
              <span class="indicator__counter">{{count($result)}}</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">Cart
              <!--<i class="fas fa-rupee-sign"></i>-->
              <!--{{$total_amount}}.00-->
              </span></a>
              <div class="indicator__content">
                <div class="dropcart">
                  <ul class="dropcart__list">
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
                      @if($type[$products->products_id] == 1 || $type[$products->products_id] == 2)
                        <?php  
                          $category = DB::table('product_images')->where('type',2)->where('products_id' ,$products->products_id)->pluck('product_image')->first();  
                        ?>  
                        <li class="dropcart__item">
                          <div class="dropcart__item-image">
                            <a href="{{url('/product-detail/'.$products->products_id)}}">
                              <img src="{{asset($category)}}" alt="" class="img-fluid" style="height:80px">
                            </a>
                          </div>
                          <div class="dropcart__item-info">
                            <div class="dropcart__item-name"><a href="{{url('/product-detail/'.$products->products_id)}}">{{$products->product_name}}</a>
                            </div>
                            <ul class="dropcart__item-features">
                              <!--<li>Color: Yellow</li>-->
                            </ul>
                            <div class="dropcart__item-meta">
                              <div class="dropcart__item-quantity">{{$quantity[$products->products_id]}}</div>
                              <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i> 
                                  @if(empty($products->special_price))
                                    {{ $products->price }} * {{$quantity[$products->products_id]}}
                                  @else
                                    {{ $products->special_price }} * {{$quantity[$products->products_id]}} 
                                  @endif
                                
                              </div>
                            </div>
                          </div>
                          <button type="button" class="dropcart__item-remove"> 
                            <a href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$id[$products->products_id]}})"><i class="fas fa-times"></i></a>
                          </button>
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
                        <li class="dropcart__item">
                          <div class="dropcart__item-image">
                            <a href="{{url('/package-detail/'.$products->id)}}">
                              <img src="{{asset($products->image)}}" alt="" class="img-fluid" style="height:80px">
                            </a>
                          </div>
                          <div class="dropcart__item-info">
                            <div class="dropcart__item-name"><a href="{{url('/package-detail/'.$products->id)}}">{{$products->package_name}}</a>
                            </div>
                            <ul class="dropcart__item-features">
                               
                            </ul>
                            <div class="dropcart__item-meta">
                              <div class="dropcart__item-quantity">{{$quantity[$products->id]}}</div>
                              <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i> 
                                
                                  @if( empty($products->offer_discount))
                                     {{$products->package_cost}} * {{$quantity[$products->id]}}  
                                  @else
                                     {{ $discount1 }} * {{$quantity[$products->id]}} 
                                  @endif
                                
                              </div>
                            </div>
                          </div>
                          <button type="button" class="dropcart__item-remove"> 
                            <a href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$id[$products->id]}})"><i class="fas fa-times"></i></a>
                          </button>
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
                  </ul>
                  <div class="dropcart__totals">
                    <table>
                      <tr>
                        <th>Subtotal</th>
                        <td><i class="fas fa-rupee-sign"></i> {{$total_amount1}}</td>
                      </tr>
                       
                    </table>
                  </div>
                  
                    @if(Auth::check())
                  		<div class="dropcart__actions"><a href="{{url('/my-cart')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/checkout')}}" class="btn btn-primary">Checkout</a>
                    @else
                        <a href="{{url('/guest-user')}}" class="btn btn-primary">Checkout</a>
                    @endif 
                  </div>
                </div>
              </div>
            </div>
          @else <!---this run only after login when cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;
                "><span class="indicator__counter">0</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">Cart
                <!--<i class="fas fa-rupee-sign"></i>00.00</span>-->
                </a>
                <div class="indicator__content">
                    <div class="dropcart"> 
                      <div class="dropcart__totals">
                        <table>
                          <a href="{{url('/')}}" style="color:#1d99b6; font-size:18px;">{{$result}}</a>
                        </table>
                      </div>
                      <!--<div class="dropcart__actions"><a href="{{url('/')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/')}}" class="btn btn-primary">Checkout</a>-->
                      <!--</div>-->
                    </div>
                </div>
            </div>
          @endif  
        @else <!---this run only without login time---> 
          @if(is_array($result)) <!---this run only without login temp cart not empty ---> 
            <div class="indicator indicator--trigger--click"><a href="#" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;
                ">
              <span class="indicator__counter">{{$count }}</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">Cart
              <!--<i class="fas fa-rupee-sign"></i>-->
              <!--{{$total_amount}}.00-->
              </span></a>
              <div class="indicator__content">
                <div class="dropcart">
                  <ul class="dropcart__list">
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
                        <li class="dropcart__item">
                          <div class="dropcart__item-image">
                            <a href="{{url('/product-detail/'.$products->products_id)}}">
                              <img src="{{asset($category)}}" alt="" class="img-fluid" style="height:80px;">
                            </a>
                          </div>
                          <div class="dropcart__item-info">
                            <div class="dropcart__item-name"><a href="{{url('/product-detail/'.$products->products_id)}}">{{$products->product_name}}</a>
                            </div>
                            <ul class="dropcart__item-features">
                              <!--<li>Color: Yellow</li>-->
                            </ul>
                            <div class="dropcart__item-meta">
                              <div class="dropcart__item-quantity">{{$temp_quantity[$products->products_id]}}</div>
                              <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i>  
                                  @if($products->special_price == null)
                                    {{ $products->price }} * {{$temp_quantity[$products->products_id]}} 
                                  @else
                                    {{ $products->special_price }} * {{$temp_quantity[$products->products_id]}} 
                                  @endif 
                              </div>
                            </div>
                          </div>
                          <button type="button" class="dropcart__item-remove"> 
                            <a href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$temp_id[$products->products_id]}})"><i class="fas fa-times"></i></a>
                          </button>
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
                        <li class="dropcart__item">
                          <div class="dropcart__item-image">
                            <a href="{{url('/package-detail/'.$products->id)}}">
                              <img src="{{asset($products->image)}}" alt="" class="img-fluid" style="height:80px;">
                            </a>
                          </div>
                          <div class="dropcart__item-info">
                            <div class="dropcart__item-name"><a href="{{url('/package-detail/'.$products->id)}}">{{$products->package_name}}</a>
                            </div>
                            <ul class="dropcart__item-features">
                              <!--<li>Color: Yellow</li>-->
                            </ul>
                            <div class="dropcart__item-meta">
                              <div class="dropcart__item-quantity">{{$temp_quantity[$products->id]}}</div>
                              <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i>  
                                  @if($products->offer_discount != null)
                                    {{ $discount1 }} * {{$temp_quantity[$products->id]}}   
                                  @else
                                    {{$products->package_cost}} * {{$temp_quantity[$products->id]}} 
                                  @endif 
                              </div>
                            </div>
                          </div>
                          <button type="button" class="dropcart__item-remove"> 
                            <a href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$temp_quantity[$products->id]}})"><i class="fas fa-times"></i></a>
                          </button>
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
                  <div class="dropcart__totals">
                    <table>
                      <tr>
                        <th>Subtotal</th>
                        <td><i class="fas fa-rupee-sign"></i> {{$total_amount1}}</td>
                      </tr>
                       
                    </table>
                  </div>
                  @if(Auth::check())
                    <div class="dropcart__actions"><a href="{{url('/my-cart')}}" class="btn btn-secondary">View Cart</a><a href="{{url('/login-user')}}" class="btn btn-primary">Checkout</a>
                  @else
                    <a href="{{url('/guest-user')}}" class="btn btn-primary">Checkout</a>
                  @endif
                  </div>
                </div>
              </div>
            </div>
          @else <!---this run only without login temp cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="42px" height="42px" style="padding-top: 0px; padding-bottom: 5px;
                "><span class="indicator__counter">0</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">Cart
                <!--<i class="fas fa-rupee-sign"></i>00.00-->
                </span></a>
              <div class="indicator__content">
                <div class="dropcart"> 
                  <div class="dropcart__totals">
                    <table>
                      <a href="{{url('/')}}" style="color:#1d99b6; font-size:18px;">{{$result}}</a>
                    </table>
                  </div>
                  <!--<div class="dropcart__actions"><a href="{{url('/')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/')}}" class="btn btn-primary">Checkout</a>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
          @endif 
        @endif <!---endif to check login or without login--->

                                                                                                                                    	
      
</div>                                                                                                                            
                                                                                                                                       <div id="myModal" class="modal fade">

                                                                                                                                       <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
   
  </header>
   
  
@if(session('mymsg') != null)
    <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{session('mymsg')}}
    </div>
    @endif
  <script type="text/javascript"> 

    Notification.requestPermission(function(result) {
  if (result === 'denied') {
    console.log('Permission wasn\'t granted. Allow a retry.');
    return;
  } else if (result === 'default') {
    console.log('The permission request was dismissed.');
    return;
  }
  console.log('Permission was granted for notifications');
});
  function removeProduct(id) {
    //console.log(id);
  $.ajax({
    url: "remove-product",
    data:"cart_id="+id,
    type: 'get',
    success: function(response){
      
      // alert('product successfully deleted from cart');
    }
  });
  document.getElementById('record-'+id).style.display="none";
  //for total cart amount calculation
  document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  }
  
  
  
</script> 
<script>
    function myFunction() {
      var x = document.getElementById("searchlocationmobile");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
</script>

<!-- site__header / end