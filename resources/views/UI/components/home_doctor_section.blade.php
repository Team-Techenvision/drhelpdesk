<div class="block block-products-carousel" data-layout="grid-5">
  <div class="container">
    @if(session('message1') != null)
      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('message1')}}
      </div>
    @endif
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Sexual Wellness</h2>
        <div class="section-header__spring"></div>
        
        <div class="section-header__arrows">
          <div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-left"></i>
            </button>
          </div>
          <div class="arrow section-header__arrow section-header__arrow--next arrow--next">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="block-products-carousel__carousel">
      <div class="block-products-carousel__carousel-loader"></div>
      <div class="owl-carousel">
        @foreach($top_selling_product1 as $r)
          <?php 
            $category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first();  
            $percent = (($r->price - $r->special_price)*100) /$r->price ; 
          ?>
          <div class="block-products-carousel__column">
            <div class="block-products-carousel__cell">
              <div class="product-card product-card--layout--grid"> 
                <div class="product-card__image">
                  <span class="custom-badge">
                    
                    @if($r->special_price != null)
                   	@if($percent == null) 
                    @else
                    <span class="custom-label custom-label-large custom-label-success arrowed-in">  
                      {{ round($percent)}}% off 
                    </span>
                    @endif
                    @endif
                  </span>
                  <a href="{{url('/product-detail/'.$r->products_id)}}">
                    @if(file_exists(public_path($category)))
                      <img src="{{asset($category)}}" alt="">
                    @else
                      <img src="{{asset('UI/images/product_default1.png')}}" alt="">
                    @endif
                  </a> 
                </div>
                <div class="product-card__info"> 
                  <div class="product-card__name">
                    <div>
                      <div class="product-card__badges"> 
                        @if($r->featured_product != null)
                        <div class="tag-badge tag-badge--new">hot</div>
                        @endif
                        @if($r->top_selling_product != null)
                        <div class="tag-badge tag-badge--hot">sale</div>
                        @endif
                      </div>
                      <a href="{{url('/product-detail/'.$r->products_id)}}">{{$r->product_name}}</a>
                    </div>
                  </div>
                  <div class="product-card__rating"> 
                  </div>
                </div>
                <div class="product-card__footer">
                  <div class="product-card__prices">
                    <div class="product-card__prices">
                      @if($r->special_price == null)
                        <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>
                      @else
                        <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> 
                          {{$r->special_price}}.00 
                        </div>
                      @endif
                      @if($r->special_price != null)
                        <div class="product-card__price product-card__price--old"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>
                      @endif
                    </div>
                  </div>
                  @if($r->in_stock != 0)
                  @php  
                    $session = Session::getId();  
                    $data1=DB::table('temp_carts')->where('product_id',$r->products_id)->where('session_id',$session)->first(); 
                  @endphp 
                  @guest 
                    @if($data1==null) 
                      @if($r->categories =='15')
                          @if(Session::get('location_name')!='notfound')
                              <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                              
                              <span class="icon-cart-plus"></span>
                              
                              </button>
                              </a>
                          @else
                              <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                              
                              <span class="icon-cart-plus"></span>
                              
                              </button></a>
                          @endif
                      @else 
                        <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                        
                        <span class="icon-cart-plus"></span>
                        
                        </button>
                        </a>
                      @endif                     
                    @else   
                      <button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

                        <span class="icon-cart-plus" style="color:red;"></span>

                      </button>   
                    @endif  
                  @else 
                    @if($r->categories =='15')
                      @if(Session::get('location_name')!='notfound')
                          <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                          
                          <span class="icon-cart-plus"></span>
                          
                          </button></a>   
                      @else
                          <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                          
                          <span class="icon-cart-plus"></span>
                          
                          </button></a>
                      @endif
                    @else
                      <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart"> 
                      <span class="icon-cart-plus"></span> 
                      </button></a>   
                    @endif 
                  @endguest

                  @else
              <p class="text-danger "> Out of Stock </p>
              @endif 
                </div>
              </div>
            </div>
          </div>
        @endforeach 
      </div>
    </div>
  </div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>

<script>
  function buy_now(){
    document.getElementById("buy-now").style.display="block";
  }   
  var closebtns = document.getElementsByClassName("close");
  var i; 
  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function() {
      this.parentElement.style.display = 'none';
    });
  }
</script>

<!-- <div class="block block-teammates">
  <div class="container">
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Consult Top Doctors</h2>
        <div class="section-header__spring"></div>
        
        <div class="section-header__arrows">
          <div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-left"></i>
            </button>
          </div>
          <div class="arrow section-header__arrow section-header__arrow--next arrow--next">
            <button class="arrow__button" type="button">
              <i class="fas fa-angle-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="block-teammates__list">
      <div class="owl-carousel"> 
        @foreach($doctor as $r) 
        <?php
          $speciality = DB::table('categories')->where('status',0)->where('categories_id',$r->speciality)->first(); 

        $date1 = strtotime($r->experience_from);  
        $date2 = strtotime($r->experience_to);   
        $diff = abs($date2 - $date1);   
        $years = floor($diff / (365*60*60*24));   
        $months = floor(($diff - $years * 365*60*60*24) 
        / (30*60*60*24));   
        $days = floor(($diff - $years * 365*60*60*24 -  
        $months*30*60*60*24)/ (60*60*24));  
        $hours = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24) 
        / (60*60));   
        $minutes = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24  
        - $hours*60*60)/ 60);   
        $seconds = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24 
        - $hours*60*60 - $minutes*60));  
        // printf("%d years, %d months", $years, $months);  
        ?> 
        <div class="block-teammates__item teammate">
          <div class="teammate__avatar">
            <a href="{{url('/doctor-details/'.$r->user_details_id)}}"><img src="{{asset($r->image)}}" alt=""></a>
          </div>
          <a href="{{url('/doctor-details/'.$r->user_details_id)}}"><div class="teammate__info">
            <div class="teammate__name">{{$r->user_name}}</div> 
            <div class="teammate__experience"><?php printf("%d yrs", $years); ?> experience</div>
            <div class="teammate__btn">Consult Now</div>
          </div></a>
        </div>
        @endforeach 
      </div>
    </div>
  </div>
</div>

<div class="block-space block-space--layout--divider-sm d-xl-block d-none"></div> -->