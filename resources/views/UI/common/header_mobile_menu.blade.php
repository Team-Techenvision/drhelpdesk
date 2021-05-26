 
<div class="mobile-menu">
  <div class="mobile-menu__backdrop"></div>
  <div class="mobile-menu__body">
    <button class="mobile-menu__close" type="button">
      <i class="fa fa-times"></i>
    </button>
    <div class="mobile-menu__panel">
      <div class="mobile-menu__panel-header">
        <div class="mobile-menu__panel-title">Menu</div>
      </div>
      <div class="mobile-menu__panel-body"> 
        <div class="mobile-menu__divider"></div>
        <div class="mobile-menu__indicators">
          <a class="mobile-menu__indicator" href="{{url('/')}}">
            <span class="mobile-menu__indicator-icon"><i class="icon-home"></i></span><span class="mobile-menu__indicator-title">Home</span> 
          </a>
          @if(Auth::check())
          @else
          <a class="mobile-menu__indicator" href="{{url('/login-user')}}">
            <span class="mobile-menu__indicator-icon"><i class="icon-user-lock"></i> </span><span class="mobile-menu__indicator-title">Account</span> 
          </a>
          @endif 
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
            <div class="indicator indicator--trigger--click"><a href="javascript:void(0);" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="35px" height="35px" style="padding-top: 0px; padding-bottom: 5px;
                ">
              <span class="indicator__counter">{{$cart1}}</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value">
              </span></a> 
            </div>
          @else <!---this run only after login when cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="35px" height="35px" style="padding-top: 0px; padding-bottom: 5px;
                "><span class="indicator__counter">0</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value"> 
                <!--<i class="fas fa-rupee-sign"></i>00.00</span>-->
                </a> 
            </div>
          @endif  
        @else <!---this run only without login time---> 
          @if(is_array($result)) <!---this run only without login temp cart not empty ---> 
            <div class="indicator indicator--trigger--click"><a href="javascript:void(0);" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="35px" height="35px" style="padding-top: 0px; padding-bottom: 5px;
                ">
              <span class="indicator__counter">{{$count }}</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value"> 
              <!--<i class="fas fa-rupee-sign"></i>-->
              <!--{{$total_amount}}.00-->
              </span></a> 
            </div>
          @else <!---this run only without login temp cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset('UI/images/logo/cart.png')}}" width="35px" height="35px" style="padding-top: 0px; padding-bottom: 5px;
                "><span class="indicator__counter">0</span> </span><span class="indicator__title">&nbsp;</span> <span class="indicator__value"> 
                <!--<i class="fas fa-rupee-sign"></i>00.00-->
                </span></a> 
            </div>
          @endif 
        @endif <!---endif to check login or without login--->
          @if(Auth::check())
          <a class="mobile-menu__indicator" href="">
            <span class="mobile-menu__indicator-icon"><i class="icon-wallet"></i> </span><span class="mobile-menu__indicator-title">Wallet</span>
          </a>
          @else
          <a class="mobile-menu__indicator" href="{{url('/login-user')}}">
            <span class="mobile-menu__indicator-icon"><i class="icon-wallet"></i> </span><span class="mobile-menu__indicator-title">Wallet</span>
          </a>
          @endif 
        </div>
        <div class="mobile-menu__divider"></div>
        <?php
          $save_more_category = DB::table('categories')->where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 
        ?> 
        <div class="header__navbar">
          <div class="header__navbar-departments">
            <div class="departments">
              <button class="departments__button" type="button"><span class="departments__button-icon"><i class="fas fa-sort-amount-down"></i> </span><span class="departments__button-title">Save More!! Care More!!</span>  <span class="departments__button-arrow"><i class="fas fa-angle-down"></i></span>
              </button>
              <div class="departments__menu">
                <div class="departments__arrow"></div>
                <div class="departments__body">
                  <?php 
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
                  $medicine = DB::table('categories')->where('categories_id',14)->first();
                  $lab = DB::table('categories')->where('categories_id',15)->first();
                  $doctor = DB::table('categories')->where('categories_id',16)->first();
                  $sexual = DB::table('categories')->where('categories_id',285)->first();
                  $cosmetic = DB::table('categories')->where('categories_id',1)->first();
                  $ayurveda = DB::table('categories')->where('categories_id',18)->first(); 
                  $pers_care = DB::table('categories')->where('categories_id',780)->first(); 
                  $mom_baby_care = DB::table('categories')->where('categories_id',24)->first(); 
                ?> 
                <?php
                  $sub_cosmetic = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_medicine = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_lab = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_doctor = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  // $sub_sexual = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_sexual = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_ayurveda = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_pers_care = DB::table('categories')->where('parent_id',$pers_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                  $sub_mom_baby_care = DB::table('categories')->where('parent_id',$mom_baby_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 

                  $sub_cosmetic1 = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  $sub_medicine1 = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  $sub_lab1 = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  $sub_doctor1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->whereNotIn('categories_id',[438,439])->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  // $sub_sexual1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->whereIn('categories_id',[438,439])->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 
                  $sub_sexual1 = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  $sub_ayurveda1 = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                  $sub_pers_care1 = DB::table('categories')->where('parent_id',$pers_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get();  
                  $sub_mom_baby_care1 = DB::table('categories')->where('parent_id',$mom_baby_care->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get();  
                ?> 
                
 				 @if($sub_medicine == null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$medicine->category_name}} <i class="fas fa-angle-down"></i></a>
                    <div class="main-menu__submenu">
                      <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                        <div class="megamenu">
                          <div class="row">
                            @foreach($sub_medicine1 as $r)
                              <?php  
                                $sub1_medicine = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
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
                  <li class="main-menu__item"><a href="{{url('filter-category/'.$medicine->categories_id)}}" class="main-menu__link">{{$medicine->category_name}}</a>
                    
                  </li>
                @endif 
  
                @if($sub_lab == null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('lab-tests')}}" class="main-menu__link">{{$lab->category_name}} </a> 
                  </li> 
                @else
                  <li class="main-menu__item"><a href="{{url('lab-tests')}}" class="main-menu__link">{{$lab->category_name}} </a> 
                  </li>
                @endif  

                @if($sub_sexual != null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$sexual->category_name}}<i class="fas fa-angle-down"></i></a>
                    <div class="main-menu__submenu">
                      <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                        <div class="megamenu">
                          <div class="row">
                            @foreach($sub_sexual1 as $r)
                              <?php  
                                $sub1_sexual = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                              ?>
                              <div class="col-6">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_sexual as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link"  href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
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
                  <li class="main-menu__item"><a href="{{url('filter-category/'.$sexual->categories_id)}}"  class="main-menu__link">{{$sexual->category_name}} </a> 
                  </li>
                @endif  
  
                @if($sub_cosmetic != null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$cosmetic->category_name}} <i class="fas fa-angle-down"></i></a>
                    <div class="main-menu__submenu">
                      <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                        <div class="megamenu">
                          <div class="row">
                            @foreach($sub_cosmetic1 as $r)
                              <?php  
                                $sub1_cosmetic = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                              ?>
                            <div class="col-6">
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
              
               @if($sub_ayurveda != null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$ayurveda->category_name}} <i class="fas fa-angle-down"></i></a>
                    <div class="main-menu__submenu">
                      <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                        <div class="megamenu">
                          <div class="row">
                            @foreach($sub_ayurveda1 as $r)
                              <?php  
                                $sub1_ayurveda = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                              ?>
                            <div class="col-6">
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
                  <li class="main-menu__item"><a href="{{url('filter-category/'.$ayurveda->categories_id)}}" class="main-menu__link">{{$ayurveda->category_name}} </a>
                    
                  </li>
                @endif  
                 
                @if($sub_pers_care != null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$pers_care->category_name}} <i class="fas fa-angle-down"></i></a>
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
                @if($sub_mom_baby_care != null)
                  <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="#" class="main-menu__link">{{$mom_baby_care->category_name}} <i class="fas fa-angle-down"></i></a>
                    <div class="main-menu__submenu">
                      <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                        <div class="megamenu">
                          <div class="row">
                            @foreach($sub_mom_baby_care1 as $r)
                              <?php  
                                $sub1_mom_baby_care = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                              ?>
                            <div class="col-6">
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
                <li class="main-menu__item"><a href="{{url('/about-us')}}" class="main-menu__link">About Us</a></li>
                <li class="main-menu__item"><a href="{{url('/contact-us')}}" class="main-menu__link">Contact Us</a></li>
                <li class="main-menu__item"><a href="{{url('/user-order-history')}}" class="main-menu__link">Track Order</a></li>
                <li class="main-menu__item"><a href="{{url('/blog')}}" class="main-menu__link">Blog</a></li>
              </ul>
            </div>
          </div> 
        </div>
        <div class="mobile-menu__spring"></div>
        <div class="mobile-menu__divider"></div>
        <a class="mobile-menu__contacts" href="tel:98759 37503">
          <div class="mobile-menu__contacts-subtitle">Free call 24/7</div>
          <div class="mobile-menu__contacts-title">+91-98759 37503</div>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- mobile-menu / end